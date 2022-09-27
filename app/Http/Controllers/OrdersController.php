<?php

namespace App\Http\Controllers;

use App\Mail\OrderSccusse;
use App\Mail\OrderUpdate;
use App\Models\clients;
use App\Models\Orders;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;



class OrdersController extends Controller
{

    public function ShowAll ($id) {
        $orders = Orders::where('client_id', $id)->orderBy('id', 'desc')->paginate(12);
        return response()->json($orders);
    }

    public function Show () {
        $orders = Orders::orderBy('id', 'desc')->get();
        return response()->json($orders);
    }

    public function prepareCheckouts($amount){
        $url = env('HYPER_PAY_URL_PREPARE'); //"https://test.oppwa.com/v1/checkouts" ;//env('HYPER_PAY_URL_PREPARE');
//        $expireDate = explode('/',$req->credit['expire_date']);
//        $date = [
//            'month' => $expireDate[0],
//            'year' => '20'.$expireDate[1]
//        ];
        $data = [
            'entityId' => '8ac7a4ca826e2c0d0182782fec5a31b6',
            'amount'    => $amount,//$req->total,
            'currency' => env('HYPER_PAY_CURRENCY'),
            'paymentType' => env('HYPER_PAY_PAYMENT_TYPE'),
//            'paymentBrand' => 'VISA',
//            'shopperResultUrl'=>'http://localhost:8080/Checkout/status',
//            'paymentMethod' => 'VISA',
//            'card.number' => '4111111111111111',//$req->credit['number'],
//            'card.holder' => 'cvv2',//$req->credit['name'],
//            'card.expiryMonth' => '12',//$date['month'], //12/22
//            'card.expiryYear' => '2022',//$date['year'],
//            'card.cvv' => '123',//$req->credit['security_code'],
//            'testMode'=> 'EXTERNAL',
//            'merchantTransactionId'=>'2222222',
//            'customer.email' => 'a@a.com',//$req->client['email'],
//            'billing.street1'=> "address']",
//            'billing.city'=> "city']",
//            'billing.state'=> 'state',
//            'billing.country'=> 'SA',
//            'billing.postcode'=>  'NO',
//            'customer.givenName'=>  'asdasd',
//            'customer.surname'=> 'test',
        ];
        $token = env('HYPER_PAY_TOKEN');      //env('HYPER_PAY_TOKEN'); 'OGFjN2E0Y2E4MjZlMmMwZDAxODI3ODJmNTg0ZDMxYjF8M2FtOUVkWFNzdA=='
        $response = Http::asForm()->withToken($token)->post($url,$data);

        return ['response' => json_decode($response->getBody()->getContents()), 'status' => $response->getStatusCode()];
    }

    public function getStatus(Request $req){
        $url = env('HYPER_PAY_URL_PREPARE').'/'.$req->id.'/payment';
        $data = [
            'entityId' => env('HYPER_PAY_ENTITY_ID_VISA'),
        ];
            $response = Http::asForm()->withToken(env('HYPER_PAY_TOKEN'))->get($url,$data);
            if(json_decode($response)->result->code == '000.000.000'){
//                $this->prossedToOrder($req);
                return response()->json([
                    'checkoutId' => $req->id,
                    'message' => json_decode($response)->result->description,
                    'code'    => json_decode($response)->result->code,
                    'status'  => true
                ]);
            }else {
                return response()->json([
                    'checkoutId' => $req->id,
                    'message' => json_decode($response)->result->description,
                    'code'    => json_decode($response)->result->code,
                    'status'  => false
                ]);
            }

    }

    public function hyperPay ($total) {
           $prepareStatus = $this->prepareCheckouts($total);
           if ($prepareStatus['status'] == 200){
                $checkout_id = $prepareStatus['response']->id;
                if ($checkout_id){
                    return view('welcome')->with(['checkoutId' => $checkout_id]);
                } else {
                    return response()->json([
                        'status' => false,
                        'error'  => $prepareStatus['status']
                    ]);
                }
           }else {
               return response()->json(['status' => false, 'message' => 'There Are A Problem In integration', 'error'=>$prepareStatus]);
           }

    }

    public function prossedToOrder (Request $req) {
//        return ['done' => 'prossedToOrder', 'request' => $req->products];
        DB::beginTransaction();
        $order = new Orders();
        if ($req->client['id'])
            $client = clients::find($req->client['id']);
        else
            $client = new clients();

        if ($req->newPassword)
            $client->password  = bcrypt($req->newPassword);

        $client->name      = $req->client['name'];
        $client->email     = $req->client['email'];
        $client->phone     = $req->client['phone'];
        $client->country   = $req->client['country'] ?? '';
        $client->city      = $req->client['city'] ?? '';
        $client->address   = $req->client['address'];
        $client->post_code = $req->client['post_code']?? null;
        $client->save();

        $order->client_id = $req->client['id'];

        $order->name      = $req->client['name'];
        $order->email     = $req->client['email'];
        $order->phone     = $req->client['phone'];
        $order->country   = $req->client['country']  ?? '';
        $order->city      = $req->client['city']  ?? '';
        $order->address   = $req->client['address'];
        $order->post_code = $req->client['post_code']?? null;

        $order->products  = $req->products;
        $order->status    = $req->status;
        $order->sup_total = $req->sup_total;
        $order->total     = $req->total;
        $order->shipping_cost = $req->shipping_cost;
        $order->currency  = $req->currency;

        $order->order_num = 1 ;

        $order->save();
        $userSchema = User::first();

        Notification::send($userSchema, new OrderNotification($order));

        DB::commit();

        $this->SendOrderMail ($order, 'create');

        return response()->json(['order' => $order, 'user' => $client, 'status' => true]);
    }

    public function updateOrederStatus (Request $req) {
        $order = Orders::find($req->id);
        $order->status = $req->status;
        $order->save();

        $this->SendOrderMail ($order, 'create');

        return response()->json($order);
    }

    public function trackingOrShowSingle (Request $req) {

        if ($req->id) :
            $orders = Orders::find($req->id);
            return response()->json($orders ? $orders : ['error' => "notFound"]);
        endif;

        $orders = Orders::where([
            "email" => $req->email,
            "order_num" => $req->order_num
        ])->first();

        return response()->json($orders ? $orders : ['error' => "notFound"]);
    }

    public function SendOrderMail (Orders $order, $type) {

        $details = [
            "order_num"   => $order->order_num,
            "client_info" => [
                "name" => $order->name,
                "email" => $order->email,
                "phone" => $order->phone,
            ],
            "shipping_info" => [
                "country" => $order->country,
                "city" => $order->city,
                "address" => $order->address,
                "post_code" => $order->post_code,
            ],
            "status" => $order->status,
            "products" => $order->products,
            "sup_total" => $order->sup_total,
            "total" => $order->total,
            "currency" => $order->currency,
            "shipping_cost" => $order->shipping_cost,
            "created_at" => $order->created_at,
        ];

        if ($type === 'create') :
            $client = clients::find($order->client_id);
            $client->increment('purchases_num');
            Mail::to($order->email)->send(new OrderSccusse($details));
        elseif ($type === 'update') :
            Mail::to($order->email)->send(new MyTestMail($details));
        endif;

    }

    public function delete ($id) {
        $orders = Orders::find($id);
        $orders->delete();
        return response()->json($orders);
    }
}
