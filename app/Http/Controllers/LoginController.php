<?php

    namespace App\Http\Controllers;

    use App\Models\bills;
    use App\Models\clients;
    use App\Models\Orders;
    use App\Models\products;
    use App\Models\staffs;
    use App\Models\trader;
    use App\Models\User;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    class LoginController extends Controller
    {

        public function CreateUser ( Request $req ) {

            $user = new User;

            if ($req->hasFile('img')) :
                $imgpath = $req->file('img')->store('public/img');
                $user->img = substr($imgpath, 7);
            endif;

            $user->name     = $req->name;
            $user->email    = $req->email;
            $user->password = bcrypt($req->password);
            $user->active   = $req->active;
            $user->save();

            return response($user);

        }

        public function UpdateUser ( Request $req  ) {

            $validator = $req->validate( [
                'password' => 'required'
            ] ) ;

            $user = User::find($req->id);

            if ($req->hasFile('img')) :
                Storage::delete('public/'.$user->img);
                $user->img = substr($req->file('img')->store('public/img'), 7);
            endif;

            $user->name   = $req->name;
            $user->email  = $req->email;
            $user->active = $req->active;
            if ( $req->password != "undefined" ) :
                $validator['password'] = bcrypt($validator['password']);
                $user->password = $validator['password'];
            endif;
            $user->save();

            return response($user);
        }

        public function Login ( Request $req ) {
            if ($req->tab === "Stuff")
                return ( new staffsController )->Login($req);

            $validator = $req->validate ( [
                'email' => 'required',
                'password' => 'required'
            ] ) ;

            $credentials = $req->only('email', 'password');

            if (!Auth::attempt( $credentials ) ):

                return response([ 'login' => false, 'message' => 'Invalid login credentionls.', 'user' => $validator ]);

            endif;

            $user = Auth::user();
            $user->last_login = now();
            $user->save();

            return response( [ 'login' => true, 'user' => $user, 'tab' => $req->tab ] );
        }

        public function Users () {

            $user = User::get();

            return response( $user );

        }

        public function dashboard () {

            $dashboard  = [];
            $orders     = new Orders();
            $clients    = new clients();
            $bills      = new bills();
            $books      = new products();

            $dashboard['orders']['data']  = $orders->where('status', 'pending')->get();
            $dashboard['orders']['count'] = $orders->count();
            $dashboard['orders']['link']  = '/Orders';
            $dashboard['orders']['background']  = '#19a185';

            $dashboard['clients']['data']   = $clients->orderBy('purchases_num', 'DESC')->limit(10)->get();
            $dashboard['clients']['count']  = $clients->count();
            $dashboard['clients']['link']   = '/Clients';
            $dashboard['clients']['background']  = '#605ca8';

            $dashboard['bills']['data']   = $bills->orderBy('id', 'DESC')->limit(10)->get();
            $dashboard['bills']['count']  = $bills->count();
            $dashboard['bills']['link']   = '/Bills';
            $dashboard['bills']['background']  = '#de524a';

            $dashboard['books']['data']  = $books->orderBy('id', 'DESC')->limit(10)->get();
            $dashboard['books']['count'] = $books->count();
            $dashboard['books']['link']  = '/Products';
            $dashboard['books']['background']  = '#f1b740';


            return response( $dashboard );

        }

        public function FindUser ( $id ) {

            $user = User::find($id);

            return response( $user );

        }

        public function Activation ( Request $req) {

            $user = User::find($req->id);

            $user->active = $req->activation;

            $user->save();

            return response( $user );

        }

        public function Delete ( $id ) {
            $user = User::find($id);
            if ($user->img != null) :
                Storage::delete('public/'.$user->img);
            endif;
            $user->delete();
            return response($user);
        }

        public function download (  ) {
            return response()->download(public_path('/storage/win/Packaged.zip'));
        }


    }
