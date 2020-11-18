<?php

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
Route::post('confirm', 'UserController@comfirm')->name('confirm');
Route::post('sign-up', 'UserController@register');
Route::get('verify_account', 'VerifyController@verify')->name('verify_account');
Route::post('verify_account', 'VerifyController@verifyPost');
Route::get('/', 'FrontController@index')->name('index');
Route::get('/faq', 'FrontController@faq')->name('faq');
Route::get('/pages/{slug}', 'ViewPageController@index')->name('pages');
Route::get('/guest_get-plan', 'FrontController@getPlan')->name('guest_get-plan');
Route::get('/guest_get-coin', 'FrontController@getCoin')->name('guest_get-coin');
Route::get('change-theme', 'FrontController@theme')->name('change-theme');
//cron job
Route::get('cron', 'CronJobController@index')->name('cron');
Route::get('auto-deposit', 'CronJobController@autoDeposit')->name('auto-deposit');
Route::get('auto-withdraw', 'CronJobController@autoWithdraw')->name('auto-withdraw');
Route::get('user_compounding', 'CronJobController@compounding')->name('compounding');
Route::get('about-us', 'ViewPageController@aboutUs')->name('about-us');
Route::get('plan', 'FrontController@plan')->name('plan');
Route::get('certificate-of-incorporation', 'FrontController@certificate')->name('certificate-of-incorporation');
Route::get('confirmation-statement', 'FrontController@cofirmation')->name('confirmation-statement');
Route::get('full-accounts', 'FrontController@full')->name('full-accounts');
Route::post('contact', 'FrontController@contact');
Route::post('sub', 'FrontController@sub');
Route::get('download-finra-cert/{slug}', 'FileController@downloadFinra')->name('download-finra-cert');
Route::get('download-sec-cert/{slug}', 'FileController@downloadSec')->name('download-sec-cert');
Auth::routes();
Route::get('btc-coin-ipn', ['as' => 'ipn.coinPay', 'uses' => 'HomeController@btcCoinIPN']);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/success', 'HomeController@success')->name('success');
Route::get('/deposit', 'HomeController@deposit')->name('deposit');
Route::post('/deposit', 'HomeController@createDeposit');
Route::get('/get-plan', 'HomeController@getPlan')->name('get-plan');
Route::get('/get-coin', 'HomeController@getCoin')->name('get-coin');
//withdraw
Route::get('/withdraw', 'HomeController@withdraw')->name('withdraw');
Route::post('/withdraw', 'HomeController@withdrawPost');
Route::post('/withdraw-fund', 'HomeController@withdrawFund')->name('withdraw-fund');
//confirm_deposit
Route::post('/confirm_deposit', 'HomeController@confirmDeposit');
//deposit list
//Route::get('/deposit_list', 'HomeController@depositList')->name('deposit_list');
//Route::get('/deposit_history', 'HomeController@depositHistory')->name('deposit_history');
Route::get('/get_history', 'HomeController@getHistory')->name('get_history');
//withdraw history
Route::get('/withdraw_history', 'HomeController@withdrawHistory')->name('withdraw_history');

Route::get('/earnings', 'HomeController@earnings')->name('earnings');
Route::get('/referals', 'HomeController@referals')->name('referals');
Route::get('/referallinks', 'HomeController@referalsLink')->name('referallinks');
Route::get('/edit_account', 'HomeController@edit')->name('edit_account');
Route::post('/edit_account', 'HomeController@editPost');
//compouding status
Route::get('/user-compounding/enable', 'HomeController@compoundEnable');
Route::get('/user-compounding/disable', 'HomeController@compoundDisable');
//adimn
Route::group(['middleware' => 'can:isAdmin'], function () {
    //user reffer
    Route::get('/user-referrals/{id}', 'AdminController@userRef')->name('user-referrals');
    
//    user-logout
    //settigs
    Route::get('/settings', 'AdminController@setting')->name('settings');
    Route::get('/mailing', 'AdminController@mailing')->name('mailing');
    Route::post('/mailing', 'AdminController@mailingPost');
    Route::post('/settings', 'AdminController@settingPost');
    //compounding
    Route::get('/compounding', 'AdminController@compounding')->name('compounding');
    Route::post('/compounding', 'AdminController@postCompounding');
//users
    Route::get('/users', 'AdminController@users')->name('users');
    Route::post('add-user', 'AdminController@create');
    Route::post('edit-user', 'AdminController@edit')->name('edit-user');
    Route::post('delete-user', 'AdminController@delete')->name('delete-user');
    Route::get('view-user/{id}', 'AdminController@viewUser')->name('view-user');
    Route::get('user-login/{id}', 'AdminController@login')->name('user-login');

//deposit
    Route::get('/manage-deposit', 'AdminController@deposit')->name('manage-deposit');
    Route::post('/delete-deposit', 'AdminController@deleteDeposit')->name('delete-deposit');
    Route::post('/confirm-deposit', 'AdminController@confirm')->name('confirm-deposit');
//withdraw
    Route::get('/manage-withdraw', 'AdminController@withdraw')->name('manage-withdraw');
    Route::post('/delete-withdraw', 'AdminController@deleteWithdraw')->name('delete-withdraw');
    Route::post('/confirm-withdraw', 'AdminController@confirmWithdraw')->name('confirm-withdraw');
    Route::post('/reject-withdraw', 'AdminController@rejectWithdraw')->name('reject-withdraw');
//plan
    Route::get('/plan-setting', 'AdminController@planSetting')->name('plan-setting');
    Route::post('/delete-plan', 'AdminController@deletePlan')->name('delete-plan');
    Route::post('/edit-plan', 'AdminController@editPlan')->name('edit-plan');
    Route::post('/add-plan', 'AdminController@addPlan')->name('add-plan');
//compound
    Route::get('/compound-setting', 'AdminController@compoundSetting')->name('compound-setting');
    Route::post('/delete-compound', 'AdminController@deleteCompound')->name('delete-compound');
    Route::post('/edit-compound', 'AdminController@editCompound')->name('edit-compound');
    Route::post('/add-compound', 'AdminController@addCompound')->name('add-compound');
    //coin setting
    Route::get('/coin-setting', 'AdminController@coinSetting')->name('coin-setting');
    Route::post('/delete-coin', 'AdminController@deleteCoin')->name('delete-coin');
    Route::post('/edit-coin', 'AdminController@editCoin')->name('edit-coin');
    Route::post('/add-coin', 'AdminController@addCoin')->name('add-coin');
    //fund
    Route::post('/fund', 'AdminController@fund')->name('fund');
    //homepage
    Route::get('/homepage', 'AdminController@homepage')->name('homepage');
    Route::post('/homepage', 'AdminController@homepagePost');
// verify user
 Route::post('/verify-user', 'AdminController@userVerify');
    
    //faq
    Route::get('/faqs', 'FaqController@index')->name('faqs');
    Route::post('/add-faqs', 'FaqController@create');
    Route::post('/edit-faqs', 'FaqController@edit');
    Route::post('/delete-faqs', 'FaqController@delete');
    //benefits
    Route::get('/benefits', 'BenefitController@index')->name('benefits');
    Route::post('/add-benefits', 'BenefitController@create');
    Route::post('/edit-benefits', 'BenefitController@edit');
    Route::post('/delete-benefits', 'BenefitController@delete');
    //get started
    Route::get('/getstarts', 'GetStartedController@index')->name('getstarts');
    Route::post('/add-getstarts', 'GetStartedController@create');
    Route::post('/edit-getstarts', 'GetStartedController@edit');
    Route::post('/delete-getstarts', 'GetStartedController@delete');
    //social
     Route::get('/socials', 'SocialController@index')->name('socials');
    Route::post('/add-socials', 'SocialController@create');
    Route::post('/edit-socials', 'SocialController@edit');
    Route::post('/delete-socials', 'SocialController@delete');
       //pages
       Route::get('/pages', 'PageController@index')->name('pages');
       Route::post('/add-page', 'PageController@create');
       Route::post('/edit-page', 'PageController@edit');
       Route::post('/delete-page', 'PageController@delete');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/user_dashboard', 'HomeController@indexData')->name('user_dashboard');
Route::get('/user-logout', 'HomeController@logOut')->name('user-logout');
Route::get('/2fa/enable', 'Google2FAController@enableTwoFactor');
Route::get('/2fa/disable', 'Google2FAController@disableTwoFactor');
Route::get('/2fa/validate', 'Auth\LoginController@getValidateToken');
Route::post('/2fa/validate', ['middleware' => 'throttle:5', 'uses' => 'Auth\LoginController@postValidateToken']);
