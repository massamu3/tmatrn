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
    return view('dashboard');
})->middleware('auth');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
// Route::get('/system-management/{option}', 'SystemMgmtController@index');
Route::get('/profile', 'ProfileController@index');

Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
Route::resource('user-management', 'UserManagementController');

Route::resource('employee-management', 'EmployeeManagementController');
Route::post('employee-management/search', 'EmployeeManagementController@search')->name('employee-management.search');


Route::resource('system-management/designation', 'DesignationController');
Route::post('system-management/designation/search', 'DesignationController@search')->name('designation.search');



Route::resource('transaction-management', 'TransactionManagementController');
Route::post('transaction-management/search', 'TransactionManagementController@search')->name('transaction-management.search');

Route::resource('academiclevel-management', 'AcademiclevelManagementController');
Route::post('academiclevel-management/search', 'AcademiclevelManagementController@search')->name('academiclevel-management.search');

Route::resource('plan-management', 'PlanManagementController');
Route::post('plan-management/search', 'PlanManagementController@search')->name('plan-management.search');

Route::resource('trn1-management/program', 'ProgramController');
Route::post('trn1-management/program/search', 'ProgramController@search')->name('program.search');


Route::resource('progressive-management', 'ProgressiveManagementController');
Route::post('progressive-management/search', 'ProgressiveManagementController@search')->name('progressive-management.search');


Route::resource('certificate-management', 'CertificateManagementController');
Route::post('certificate-management/search', 'CertificateManagementController@search')->name('certificate-management.search');

Route::resource('trn1-management/school', 'SchoolController');
Route::post('trn1-management/school/search', 'SchoolController@search')->name('school.search');


Route::resource('system-management/status', 'StatusController');
Route::post('system-management/status/search', 'StatusController@search')->name('status.search');



Route::resource('system-management/station', 'StationController');
Route::post('system-management/station/search', 'StationController@search')->name('station.search');

Route::resource('system-management/division', 'DivisionController');
Route::post('system-management/division/search', 'DivisionController@search')->name('division.search');

Route::resource('system-management/section', 'SectionController');
Route::post('system-management/section/search', 'SectionController@search')->name('section.search');

Route::get('system-management/report', 'ReportController@index');
Route::post('system-management/report/search', 'ReportController@search')->name('report.search');
Route::post('system-management/report/excel', 'ReportController@exportExcel')->name('report.excel');
Route::post('system-management/report/pdf', 'ReportController@exportPDF')->name('report.pdf');
Route::get('avatars/{name}', 'EmployeeManagementController@load');