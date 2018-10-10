<?php
//Category route

Route::Group(['prefix'=>'admin/category','namespace'=>'Modules\category\Controllers','middleware' => 'web'],function() {

    Route::get('/', [
        'middleware' => 'acl_access:admin/category',
        'as' => 'category.index',
        'uses' => 'CategoryController@index'
    ]);

    Route::get('/create', [
        'middleware' => 'acl_access:admin/category/create',
        'as' => 'category.create',
        'uses' => 'CategoryController@create'
    ]);


    Route::post('/store', [
        'middleware' => 'acl_access:admin/category/store',
        'as' => 'category.store',
        'uses' => 'CategoryController@store'
    ]);


    Route::get('/show/{id}', [
        'middleware' => 'acl_access:admin/category/show/{id}',
        'as' => 'category.show',
        'uses' => 'CategoryController@show'
    ]);

    Route::get('/edit/{id}', [
        'middleware' => 'acl_access:admin/category/edit/{id}',
        'as' => 'category.edit',
        'uses' => 'CategoryController@edit'
    ]);


    Route::post('/update/{id}', [
        'middleware' => 'acl_access:admin/category/update',
        'as' => 'category.update',
        'uses' => 'CategoryController@update'
    ]);

    Route::post('/delete', [
        'middleware' => 'acl_access:admin/category/delete',
        'as' => 'category.delete',
        'uses' => 'CategoryController@delete'
    ]);


});
