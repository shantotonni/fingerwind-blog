<?php

Route::Group(['prefix' => 'admin/user','namespace'=>'Modules\User\Controllers','middleware' => 'web'],function() {

    Route::get('/list', [
        'middleware' => 'acl_access:admin/user/list',
        'as' => 'user-list.index',
        'uses' => 'UserListController@index'
    ]);

    Route::get('/profile', [
        'middleware' => 'acl_access:admin/user/profile',
        'as' => 'user.profile',
        'uses' => 'UserListController@profile'
    ]);

    Route::get('/profile/show/{id}', [
        'middleware' => 'acl_access:admin/user/profile/show/{id}',
        'as' => 'user.profile.show',
        'uses' => 'UserListController@userProfileShow'
    ]);

    Route::post('/update/image/{id}', [
        'middleware' => 'acl_access:admin/user/update/image/{id}',
        'as' => 'update.image',
        'uses' => 'UserListController@updateImage'
    ]);

    Route::get('/edit/profile/{id}', [
        'middleware' => 'acl_access:admin/user/edit/profile/{id}',
        'as' => 'edit.profile',
        'uses' => 'UserListController@editProfile'
    ]);

    Route::post('/update/profile/{id}', [
        'middleware' => 'acl_access:admin/user/update/profile/{id}',
        'as' => 'update.profile',
        'uses' => 'UserListController@updateProfile'
    ]);

    Route::get('/my/article', [
        'middleware' => 'acl_access:admin/user/my/article',
        'as' => 'my.article',
        'uses' => 'UserListController@myArticle'
    ]);

    Route::get('/create', [
        //'middleware' => 'acl_access:admin/user/create',
        'as' => 'user.create',
        'uses' => 'UserListController@userCreate'
    ]);

    Route::post('/store', [
        'middleware' => 'acl_access:admin/user/create',
        'as' => 'admin.store.user',
        'uses' => 'UserListController@adminStoreUser'
    ]);

    Route::get('/profile/delete/{id}', [
        //'middleware' => 'acl_access:admin/user/profile/delete/{id}',
        'as' => 'user.profile.delete',
        'uses' => 'UserListController@userProfileDelete'
    ]);



});
