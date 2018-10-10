<?php

Route::Group(['namespace'=>'Modules\User\Controllers','middleware' => 'web'],function() {


    //dashboard route
    Route::get('/admin/dashboard', 'DashboardController@index')->name('home')->middleware('acl_access:admin/dashboard');
    Route::get('/admin/access-control', 'DashboardController@accessControl')->name('access.control')->middleware('acl_access:admin/access-control');



});