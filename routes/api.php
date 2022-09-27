<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use AmrShawky\LaravelCurrency\Facade\Currency;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\staffsController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\collectionsController;
use App\Http\Controllers\BranchsController;
use App\Http\Controllers\TraderController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\dailyRestrictionsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ExternalOrdersController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CreditAndDebitNotesController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\AttendingLeavinsController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\Roles;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CoponeOffersController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/download/dashboard',          [LoginController::class, 'download']);

///////////////////////////////////////////////////////////////////////
/////////////////////// Admin /////////////////////////////////////////
/// //////////////////////////////////////////////////////////////////
Route::get('/Admin/Users',          [LoginController::class, 'Users']);
Route::get('/Admin/dashboard',      [LoginController::class, 'dashboard']);
Route::post('/Admin/Login',         [LoginController::class, 'Login']);
Route::post('/Admin/Activation',    [LoginController::class, 'Activation']);
Route::post('/Admin/Create/user',   [LoginController::class, 'CreateUser']);
Route::post('/Admin/Update/User',   [LoginController::class, 'UpdateUser']);
Route::post('/Admin/FindUser/{id}', [LoginController::class, 'FindUser']);
Route::delete('/Admin/User/{id}',   [LoginController::class, 'Delete']);

//////////////////// Roles Permissions ///////////////////////

Route::get('/showRolls',                 [Roles::class, 'showRolls']);
Route::get('/showPermission',            [Roles::class, 'showPermission']);
Route::post('/updateOrInsertRole',       [Roles::class, 'updateOrInsertRole']);
Route::post('/deleteRole',               [Roles::class, 'deleteRole']);
Route::post('/updateOrInsertPermission', [Roles::class, 'updateOrInsertPermission']);
Route::post('/deletePermission',         [Roles::class, 'deletePermission']);
Route::post('/assignPermissionToRoll',   [Roles::class, 'assignPermissionToRoll']);
Route::post('/revokePermissionToRoll',   [Roles::class, 'revokePermissionToRoll']);
Route::post('/giveRollStaff',            [Roles::class, 'giveRollStaff']);
Route::post('/revokeRollStaff',          [Roles::class, 'revokeRollStaff']);

//////////////////// Stuff ///////////////////////

Route::post('/Createstaffs',        [staffsController::class, 'Createstaffs']);
Route::get('/stuff',                [staffsController::class, 'showAll']);
Route::post('/stuff/report',        [staffsController::class, 'report']);
Route::get('/stuff/showDropdone',   [staffsController::class, 'showDropdone']);
Route::get('/stuff/Findstaffs/{id}',[staffsController::class, 'Findstaffs']);
Route::delete('/stuff/{id}',        [staffsController::class, 'Delete']);

///////////////////// Clients //////////////////////

Route::get('Account/show',      [ClientsController::class, 'show']);
Route::get('Account/showList',  [ClientsController::class, 'showList']);
Route::post('Account/Register', [ClientsController::class, 'Register']);
Route::post('Account/report',    [ClientsController::class, 'report']);


Route::post('Account/mailConfirmation', [ClientsController::class, 'mailConfirmation']);
Route::post('Account/resendMail',       [ClientsController::class, 'resendMail']);
Route::post('Account/resetPassword',    [ClientsController::class, 'resetPassword']);
Route::post('Account/updatPassword',    [ClientsController::class, 'updatPassword']);


Route::post('Account/Login',    [ClientsController::class, 'Login']);
Route::post('Account/Update',   [ClientsController::class, 'Update']);
Route::post('Account/Delete',   [ClientsController::class, 'delete']);



///////////////////// Category //////////////////////
Route::get('cat',                [CatController::class, 'index']);
Route::get('list',               [CatController::class, 'showCatsInDropdownList']);
Route::get('catList',            [CatController::class, 'catsDropDownMohsen']);
Route::post('create/cat',        [CatController::class, 'store']);
Route::post('edit/cat',          [CatController::class, 'update']);
Route::delete('delete/cat/{id}', [CatController::class, 'delete']);

///////////////////// Category //////////////////////
//Route::get('Collections/Home',                      [collectionsController::class, 'Home']);
Route::get('collections/All',                      [collectionsController::class, 'collections']);
//Route::get('Collections/products',                  [collectionsController::class, 'products']);
Route::get('Collections/getSingelCollections/{id}',      [collectionsController::class, 'getSingelCollections']);
Route::get('getCollectionWithProductsViewForDash',  [collectionsController::class, 'getCollectionWithProductsViewForDash']);
Route::get('productsForCreateCollectionsDash',      [collectionsController::class, 'productsForCreateCollectionsDash']);
Route::post('CreatCollections',                     [collectionsController::class, 'CreatCollections']);
Route::post('EditCollections',                      [collectionsController::class, 'EditCollections']);
Route::delete('delete/Collections/{id}',                 [collectionsController::class, 'deleteCollections']);

///////////////////// Product //////////////////////

Route::get('product/product/{id}',            [productsController::class, 'product']);
Route::get('product/test',                    [productsController::class, 'getFilterData']);
Route::get('product/shop-print-product',      [productsController::class, 'getShopPrintProduct']);
Route::post('product/show',                   [productsController::class, 'show']);
Route::post('product/stokeRange',             [productsController::class, 'stokeRange']);
Route::get('product/show/where/branch/{id}',  [productsController::class, 'showWhereBranch']);
Route::post('product/search',                 [productsController::class, 'search']);
Route::post('product/searchName',             [productsController::class, 'searchName']);
Route::get('dorpdownlists',                   [productsController::class, 'dorpdownlists']);
Route::get('updateDorpdownlists/{tableName}', [productsController::class, 'updateDorpdownlists']);
Route::post('/createProduct',                 [productsController::class, 'createProduct']);
Route::post('/products/Activation',           [productsController::class, 'activation']);
Route::post('/updatePrice',                   [productsController::class, 'updatePrice']);
Route::post('/updatePrice_sale',              [productsController::class, 'updatePrice_sale']);
Route::post('/updateStoke',                   [productsController::class, 'updateStoke']);
Route::post('/fileImport',                    [productsController::class, 'fileImport']);
Route::get('products/fileExport/{data}',      [productsController::class, 'fileExport']);
Route::get('products/getColumnNams',          [productsController::class, 'getColumnNams']);
Route::get('products/productTrakers/{id}',           [productsController::class, 'productTrakers']);
Route::get('products/fileExportProductTraking/{id}', [productsController::class, 'fileExportProductTraking']);
Route::delete('/product/delete/{id}',         [productsController::class, 'delete']);
// Comments
Route::get('/ProductComments/{id}',            [productsController::class, 'ProductComments']);
Route::post('/createOrUpdateProductsComments', [productsController::class, 'createOrUpdateProductsComments']);

///////////////////// CouponOffersController //////////////////////
Route::get('CouponOffers/show',            [CoponeOffersController::class, 'showOffre_Copone']);
Route::post('CouponOffers/createOrUpdate',   [CoponeOffersController::class, 'createOrUpdateOffreOrCopone']);
Route::post('CouponOffers/checkCoupon',   [CoponeOffersController::class, 'checkCoupon']);
Route::delete('CouponOffers/delete/{id}',  [  CoponeOffersController::class, 'delete']);

//Route::post('CouponOffers/trnasfer',        [CoponeOffersController::class, 'trnasfer']);

///////////////////// Branchs //////////////////////

Route::get('Branchs/show',     [BranchsController::class, 'show']);
Route::post('Branchs/create',  [BranchsController::class, 'create']);
Route::post('Branchs/trnasfer',[BranchsController::class, 'trnasfer']);
Route::post('Branchs/delete',  [BranchsController::class, 'delete']);


///////// Brand //////////

Route::get('/brand/show',            [BrandController::class, 'show']);
Route::post('/brand/CreateOrUpdate', [BrandController::class, 'CreateOrUpdate']);
Route::post('/brand/delete',         [BrandController::class, 'delete']);

///////// trader //////////

Route::get('/trader/show', [TraderController::class, 'show']);
Route::post('/trader/Account_statement', [TraderController::class, 'Account_statement']);
Route::post('/trader/create',        [TraderController::class, 'create']);
Route::post('/trader/purchase',      [TraderController::class, 'purchaseProduct']);
Route::delete('/trader/delete/{id}', [TraderController::class,  'delete']);

/////////// Credit And Debit Notes //////////

Route::get('/CreditAndDebitNotes/showAll',            [CreditAndDebitNotesController::class, 'showAll']);
Route::get('/CreditAndDebitNotes/showForTrader/{id}', [CreditAndDebitNotesController::class, 'showForTrader']);
Route::post('/CreditAndDebitNotes/createCredit',      [CreditAndDebitNotesController::class, 'createCredit']);
Route::delete('/CreditAndDebitNotes/delete',          [CreditAndDebitNotesController::class, 'delete']);

/////////// Biils //////////

Route::get('/bills/show',     [BillsController::class, 'show']);
Route::post('/bills/filter',  [BillsController::class, 'filter']);
Route::post('/bill/create',   [BillsController::class, 'create']);
Route::post('/bill/delete',   [BillsController::class, 'delete']);

/////////// Daily Restrictions //////////

Route::get('/dailyRestrictions/show',   [dailyRestrictionsController::class, 'show']);
Route::get('/dailyRestrictions/capital',   [dailyRestrictionsController::class, 'capital']);
Route::post('/dailyRestrictions/filter', [dailyRestrictionsController::class, 'filter']);
Route::post('/dailyRestrictions/add', [dailyRestrictionsController::class, 'add']);
Route::post('dailyRestrictions/edit/trader', [dailyRestrictionsController::class, 'edit_trader']);
Route::post('dailyRestrictions/delete',  [dailyRestrictionsController::class, 'delete']);


/////////// Orders //////////

Route::get('orders/ShowAll/{id}', [OrdersController::class, 'ShowAll']);
Route::get('orders/ShowAll', [OrdersController::class, 'Show']);
Route::post('orders/trackingOrShowSingle', [OrdersController::class, 'trackingOrShowSingle']);
Route::post('orders/create', [OrdersController::class, 'prossedToOrder']);
Route::post('checkout/status', [OrdersController::class, 'getStatus']);
Route::post('orders/updateOrederStatus', [OrdersController::class, 'updateOrederStatus']);
Route::delete('orders/delete/{id}', [OrdersController::class, 'delete']);

/////////// External Orders //////////

Route::get('external-orders/show/{status}', [ExternalOrdersController::class, 'show']);
Route::post('external-orders/create', [ExternalOrdersController::class, 'create']);
Route::post('external-orders/image_design', [ExternalOrdersController::class, 'image_design']);
Route::post('external-orders/updateStatus', [ExternalOrdersController::class, 'updateStatus']);
Route::delete('external-orders/delete/{id}', [ExternalOrdersController::class, 'delete']);

/////////// Settings //////////

Route::post('Settings/test', [SettingsController::class, 'test']);
Route::get('Settings/show',     [SettingsController::class, 'Show']);
Route::post('Settings/setting', [SettingsController::class, 'setting']);


/////////// departments //////////

Route::get('departments/show',            [DepartmentsController::class, 'show']);
Route::get('departments/showDropdown',    [DepartmentsController::class, 'showDropdown']);
Route::post('departments/createOrUpdate', [DepartmentsController::class, 'createOrUpdate']);
Route::post('departments/delete',         [DepartmentsController::class, 'delete']);

/////////// rewards //////////

Route::get('rewards/show/{id}',            [RewardsController::class, 'show']);
Route::post('rewards/createOrUpdate', [RewardsController::class, 'createOrUpdate']);
Route::post('rewards/delete',         [RewardsController::class, 'delete']);

/////////// discounts //////////

Route::get('discounts/show/{id}',       [DiscountsController::class, 'show']);
Route::post('discounts/createOrUpdate', [DiscountsController::class, 'createOrUpdate']);
Route::post('discounts/delete',         [DiscountsController::class, 'delete']);

/////////// departments //////////

Route::get('assets/show',            [AssetsController::class, 'show']);
Route::post('assets/createOrUpdate', [AssetsController::class, 'createOrUpdate']);
Route::post('assets/delete',         [AssetsController::class, 'delete']);

/////////// Attending And leaving //////////

Route::get('AttendingLeaving/show/{id}',   [AttendingLeavinsController::class, 'show']);
Route::post('AttendingLeaving/leaveTime',  [AttendingLeavinsController::class, 'leaveTime']);
Route::post('AttendingLeaving/attendTime', [AttendingLeavinsController::class, 'attendTime']);
Route::post('AttendingLeaving/update',     [AttendingLeavinsController::class, 'update']);
Route::post('AttendingLeaving/delete',     [AttendingLeavinsController::class, 'delete']);

/////////// Holidays //////////

Route::get('holidays/show/{id}',       [HolidaysController::class, 'show']);
Route::get('holidays/show-data/{id}',       [HolidaysController::class, 'showData']);
Route::post('holidays/createOrupdate', [HolidaysController::class, 'createOrupdate']);
Route::post('holidays/delete',         [HolidaysController::class, 'delete']);

Route::get('change/{from}/{to}', function ($from , $to) {
    return Currency::convert()
        ->from($from)
        ->to($to)
        ->get();
});
Route::get('download', function () {
    if (isset($_GET['url'])) {
        $path = storage_path('app/public/'.$_GET['url']);
        return response()->download($path);
    }
});
