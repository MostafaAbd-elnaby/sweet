<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get( 'em', function () {
    return view( 'emails.mailverify' );
} );

Route::get( 'order', function () {
    return view( 'emails.order' );
} );

Route::get( 'orderUpdate', function () {
    return view( 'emails.orderUpdate' );
} );
Route::get( 'resetPassword', function () {
    return view( 'emails.resetPassword' );
} );

Route::get( 'paymentForm/{total}', [OrdersController::class, 'hyperPay'])->name('hyper.pay');
