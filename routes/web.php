<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\SubadminController;
use App\Http\Controllers\admin\BlogsController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\UpgradingPriceController;

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

//Non-Logged-in user
Route::group(['middleware' => ['guest']],function(){
    Route::view('admin','admin/auth/login')->name('login1');
    Route::view('admin/login','admin/auth/login')->name('login');
    Route::view('admin/forgot-password', 'admin/auth/forgot-password')->name('admin.forgotpassword');
    Route::post('admin/recover-password', [Admincontroller::class, 'recover_password_func'])->name('admin.recover-password');
    Route::post('admin/reset-password', [Admincontroller::class,'reset_password_func'] )->name('admin.reset-password');

    
});

Route::get('/reset-password/{token}', function (string $token) {
        return view('admin/auth/reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');


Route::post('admin/user_login', [AdminController::class,'admin_login_func'] )->name('admin.login');

///////Logged-in user(Admin)/////////
Route::group(['middleware' => ['auth']],function(){
    Route::view('admin/dashboard','admin/dashboard')->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class,'admin_logout_func'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class,'get_admin_info_func'])->name('admin.getinfo');
    Route::post('admin/update_admin_info', [Admincontroller::class,'update_admin_generalinfo'])->name('update_admin_info');
    Route::post('admin/update_password', [Admincontroller::class,'update_admin_password_func'])->name('update_admin_password');
    Route::post('admin/upload-images',[AdminController::class,'storeImage'])->name('admin.uploadimage');
    
    Route::get('admin/all-user', [UsersController::class, 'get_users_list'])->name('all_user');
    Route::post('admin/insert-users', [UsersController::class,'insert_users'])->name('admin.insertuser');
    Route::get('admin/delete-users/{id}',[UsersController::class,'delete_users'])->name('admin.deleteuser');
    Route::post('admin/edit-users', [UsersController::class,'edit_users'])->name('admin.editusers');
    Route::post('admin/check-email-existance',[UsersController::class, 'check_email_existance'])->name('admin.checkemailexistance');

    // Route::view('admin/all-subadmin', 'admin.subadmin.index')->name('admin.all_subadmin');
    Route::get('admin/all-subadmin', [SubadminController::class,'get_subadmin_list'])->name('admin.all_subadmin');
    Route::post('admin/insert-subadmin',[SubadminController::class, 'insert_subadmin'])->name('admin.insertsubadmin');
    Route::post('admin/check-subadminuser-existance',[SubadminController::class,'check_subadmin_user_existance'])->name('admin.checksubadminuser');
    Route::post('admin/edit-subadmin', [SubadminController::class, 'edit_subadmin'])->name('admin.edtsubadmin');
    Route::get('admin/delete-subadmin/{id}',[SubadminController::class, 'delete_subadmin'])->name('admin.deletesubadmin');


    Route::get('admin/all-blogs',[BlogsController::class,'all_blogs_list'])->name('all_blog');
    Route::post('admin/insert-blog', [BlogsController::class, 'insert_blog'])->name('insertblog');
    Route::post('admin/edit-blog', [BlogsController::class, 'edit_blog'])->name('editblog');
    Route::delete('admin/delete-blog/{id}', [BlogsController::class, 'delete_blog'])->name('deleteblog');

    // ********************pages********************
    Route::get('admin/pages/privacy',[PagesController::class,'privacy'])->name('privacy');
    Route::post('admin/pages/privacy',[PagesController::class,'insert_privacy'])->name('insert_privacy');
    
    Route::get('admin/pages/terms_conditions',[PagesController::class,'terms_conditions'])->name('terms_conditions');
    Route::post('admin/pages/terms_conditions',[PagesController::class,'insert_conditions'])->name('insert_conditions');

    // ***************************** FAQS ********************
    Route::get('admin/pages/faq', [FAQController::class, 'faq'])->name('faq.index');
    Route::post('admin/pages/faq', [FAQController::class, 'store'])->name('faq.store');
    Route::get('admin/pages/faq_delete{id}', [FAQController::class, 'faq_delete'])->name('faq_delete');
    Route::post('admin/pages/faq_edit', [FAQController::class, 'faq_edit'])->name('faq_edit');


    Route::get('admin/pages/upgrading_price', [UpgradingPriceController::class, 'upgrading_price'])->name('upgrading_price');
    Route::get('admin/dropdown', [UpgradingPriceController::class, 'index']);
    Route::post('admin/fetch-states', [UpgradingPriceController::class, 'fetchState']);
    Route::post('admin/fetch-cities', [UpgradingPriceController::class, 'fetchCity']);

    Route::post('admin/pages/upgrading_price', [UpgradingPriceController::class, 'price_insert'])->name('admin.pricing');

});
