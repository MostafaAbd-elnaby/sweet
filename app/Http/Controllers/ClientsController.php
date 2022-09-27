<?php

namespace App\Http\Controllers;

//use App\Mail\mailverify;
//use App\Mail\OrderSccusse;
//use App\Mail\ResetPassword;
use App\Models\clients;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Class ClientsController
 * @package App\Http\Controllers
 */
class ClientsController extends Controller
{

   public function report( Request $req )
   {
       $rang = [$req->from, $req->to];
       $products = Orders::where('client_id', $req->id)->whereBetween('day', $rang)->get();
       $products = collect($products)->pluck('products')->toArray();
       $arr = [];
       for($i = 0; $i < count($products) ; $i++) {
            $el = $products[$i];
            for ($x = 0; $x < count($el) ; $x++) {
                $arr[] = $el[$x];
            }
       }
       $ids = collect($arr)->pluck('id')->toArray();
       $ids = array_count_values($ids);
       $report = [];
        foreach ( $arr as $key => $val ) {
            $holder = [];
            $qu = 0;
            for ($i = 0; $i < $ids[$val['id']] ; $i++) {
                $qu += $val['qu'];
                $holder = [
                    "name_ar" => $val['name_ar'],
                    "id" => $val['id'],
                    "price" => $val['price'],
                    "qu" => $qu,
                    "img" => $val['img'],
                    "total" => $qu * $val['price'],
                ];
            }
            $report[] = $holder;
        }
       return response()->json(collect($report)->unique());
   }

    public function Register( Request $req)
    {
        DB::beginTransaction();
        $isNotExssitEmailAddress = clients::where('email', $req->email)->first();
        if ($isNotExssitEmailAddress)
            return response()->json(['email' => true]);

        $randomNumber = random_int(1000, 9999);

        $Client = new clients();

        $Client->name  = $req->name;
        $Client->email = $req->email;
        $Client->phone = $req->phone;
        $Client->code  = $randomNumber;
        $Client->password = bcrypt($req->password);
        $Client->active = 0;
        $Client->save();
        $Client = clients::find($Client->id);

        $details = [
            "code" => $randomNumber
        ];

//         Mail::to($Client->email)->send(new mailverify($details));
        DB::commit();

        return response()->json(['user' => $Client]);
    }

    public function mailConfirmation ( Request $req) {

        $Client = clients::where(['id' => $req->id, 'code' => $req->code ])->first();

        // Check user url for update password
        if ($req->check && $Client) :
            return response()->json(['authorized' => true]);
        elseif ($req->check && !$Client) :
            return response()->json(['authorized' => false]);
        endif;


        if ($Client) :
            $Client->active = 1;
            $Client->save();
            return response()->json(['user' => $Client]);
        endif;

        return response()->json(['user' => false]);

    }

    public function resendMail ( Request $req) {
        $Client = clients::where('email', $req->email)->first();

        $randomNumber = random_int(1000, 9999);

        $Client->code  = $randomNumber;
        $Client->active = 0;
        $Client->save();

        $details = [
            "code" => $randomNumber
        ];

        Mail::to($Client->email)->send(new mailverify($details));

        return response()->json(['user' => $Client]);

    }

    public function resetPassword ( Request $req ) {

        $Client = clients::where('email', $req->email)->first();

        if (!$Client)
            return response()->json(['email' => true, 'password' => false]);

        $randomNumber = random_int(1000, 9999);

        $Client->code  = $randomNumber;
        $Client->active = 0;
        $Client->save();

        $details = [
            "id" => $Client->id,
            "code" => $randomNumber
        ];

        Mail::to($Client->email)->send(new ResetPassword($details));

        return response()->json(['password' => true, 'email' => false]);

    }

    public function updatPassword ( Request $req ) {

        $Client = clients::find($req->id);

        $Client->password  = bcrypt($req->newPassword);
        $Client->active  = 1;
        $Client->save();

        return response()->json(['user' => $Client]);
    }

    public function Login( Request $req)
    {

        $validator = $req->validate ( [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $req->only('email', 'password');

        if (!Auth::guard('clients')->attempt( $credentials ) ):

            return response([ 'login' => false, 'message' => 'Invalid login credentionls.', 'clients' => $validator ]);

        endif;

        $clients = Auth::guard('clients')->user();

        return response( [ 'login' => true, 'user' => $clients ] );

    }

    public function show () {
        $client = clients::orderBy('id', 'DESC')->paginate(20);
        return response()->json($client);
    }
    public function showList () {
        $client = clients::select(['id AS value', 'name As label'])->orderBy('id', 'DESC')->get();
        return response()->json($client);
    }

    public function Update( Request $req)
    {
        if ( $req->id )
            $client = clients::find($req->id);
        else
            $client = new clients();
        if ($req->newPassword)
            $client->password  = bcrypt($req->newPassword);
        $client->name      = $req->name;
        $client->email     = $req->email;
        $client->phone     = $req->phone;
        $client->country   = $req->country;
        $client->city      = $req->city;
        $client->address   = $req->address;
        $client->governorate = $req->governorate;
        $client->post_code = $req->post_code;
        $client->save();

        if ( $req->dash )
            return response()->json(clients::orderBy('id', 'DESC')->paginate(20));
        else
            return response( [ 'login' => true, 'user' => $client ] );
    }

    public function delete ( Request $req ) {
        $client = clients::find($req->id);
        $client->delete();
        return response()->json($client);
    }
}
