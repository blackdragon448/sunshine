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
Route::resource('/danhsachloai', 'loaicontroller');
Route::resource('/danhsachsanpham', 'sanphamcontroller');
Route::get('/danhsachsanpham/excel', 'sanphamcontroller@excel')->name('danhsachsanpham.excel');
Route::get('/danhsachsanpham/pdf', 'sanphamcontroller@pdf')->name('danhsachsanpham.pdf');
Route::get('/danhsachsanpham/print', 'sanphamcontroller@print')->name('danhsachsanpham.print');
Route::get('/','frontendController@index')->name('frontend.home');
Route::get('/home', 'Homecontroller@index')->name('home');
Route::get('/gioi-thieu', 'frontendController@about')->name('frontend.about');
Route::get('/lien-he', 'frontendController@contact')->name('frontend.contact');
Route::post('/lien-he/goi-loi-nhan', 'frontendController@sendmailContactform')->name('frontend.contact.sendmailContactform');