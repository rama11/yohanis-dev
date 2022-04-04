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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard','DashboardController@index')->name('dashboard');
Route::get('/dashboard/getData','DashboardController@getData')->name('dashboard/getData');

Route::get('/time-sheet','TimeSheetController@index')->name('time-sheet');
Route::get('/time-sheet/getData','TimeSheetController@getData')->name('time-sheet/getData');
Route::get('/time-sheet/getParameter','TimeSheetController@getParameter')->name('time-sheet/getParameter');
Route::get('/time-sheet/getParameterPID','TimeSheetController@getParameterPID')->name('time-sheet/getParameterPID');
Route::get('/time-sheet/addActivity','TimeSheetController@addActivity')->name('time-sheet/addActivity');
Route::get('/time-sheet/getDataUnsubmited','TimeSheetController@getDataUnsubmited')->name('time-sheet/getDataUnsubmited');
Route::get('/time-sheet/deleteActivity','TimeSheetController@deleteActivity')->name('time-sheet/deleteActivity');
Route::get('/time-sheet/getActivityEdit','TimeSheetController@getActivityEdit')->name('time-sheet/getActivityEdit');
Route::get('/time-sheet/editActivity','TimeSheetController@editActivity')->name('time-sheet/editActivity');
Route::get('/time-sheet/submitActivity','TimeSheetController@submitActivity')->name('time-sheet/submitActivity');
Route::get('/time-sheet/getDataUnapproved','TimeSheetController@getDataUnapproved')->name('time-sheet/getDataUnapproved');
Route::get('/time-sheet/approveAllActivity','TimeSheetController@approveAllActivity')->name('time-sheet/approveAllActivity');
Route::get('/time-sheet/commentActivity','TimeSheetController@commentActivity')->name('time-sheet/commentActivity');
Route::get('/time-sheet/getCommentActivity','TimeSheetController@getCommentActivity')->name('time-sheet/getCommentActivity');

Route::get('/reporting','ReportingController@index')->name('reporting');
Route::get('/reporting/getParameter','ReportingController@getParameter')->name('reporting/getParameter');
Route::get('/reporting/generate/reportUser','ReportingController@generateReportUser')->name('reporting/generate/reportUser');
Route::get('/reporting/generate/reportCustomer','ReportingController@generateReportCustomer')->name('reporting/generate/reportCustomer');
Route::get('/reporting/generate/reportCustomerID','ReportingController@generateReportCustomerID')->name('reporting/generate/reportCustomerID');
Route::get('/reporting/generate/reportApproved','ReportingController@generateReportApproved')->name('reporting/generate/reportApproved');

Route::get('/setting','SettingController@index')->name('setting');
Route::get('/setting/getUsers','SettingController@getUsers')->name('setting/getUsers');
Route::get('/setting/addUsers','SettingController@addUsers')->name('setting/addUsers');
Route::get('/setting/getEachUser','SettingController@getEachUser')->name('setting/getEachUser');
Route::get('/setting/editUser','SettingController@editUser')->name('setting/editUser');
Route::get('/setting/deleteUser','SettingController@deleteUser')->name('setting/deleteUser');

Route::get('/setting/getCustomer','SettingController@getCustomer')->name('setting/getCustomer');
Route::get('/setting/getEachCustomer','SettingController@getEachCustomer')->name('setting/getEachCustomer');
Route::get('/setting/editCustomer','SettingController@editCustomer')->name('setting/editCustomer');
Route::get('/setting/deleteCustomer','SettingController@deleteCustomer')->name('setting/deleteCustomer');
Route::get('/setting/addCustomer','SettingController@addCustomer')->name('setting/addCustomer');

Route::get('/setting/getCustomerID','SettingController@getCustomerID')->name('setting/getCustomerID');
Route::get('/setting/getEachCustomerID','SettingController@getEachCustomerID')->name('setting/getEachCustomerID');
Route::get('/setting/editCustomerID','SettingController@editCustomerID')->name('setting/editCustomerID');
Route::get('/setting/deleteCustomerID','SettingController@deleteCustomerID')->name('setting/deleteCustomerID');
Route::get('/setting/addCustomerID','SettingController@addCustomerID')->name('setting/addCustomerID');
Route::get('/setting/getParameter','TimeSheetController@getParameter')->name('setting/getParameter');
