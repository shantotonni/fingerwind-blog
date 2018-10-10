<?php

//Article route


Route::Group(['prefix' => 'admin/article','namespace'=>'Modules\Article\Controllers', 'middleware' => 'web'],function() {

    Route::get('/', [
        'middleware' => 'acl_access:admin/article',
        'as' => 'article.index',
        'uses' => 'ArticleController@index'
    ]);

    Route::get('/create', [
        'middleware' => 'acl_access:admin/article/create',
        'as' => 'article.create',
        'uses' => 'ArticleController@create'
    ]);


    Route::post('/store', [
        'middleware' => 'acl_access:admin/article/store',
        'as' => 'article.store',
        'uses' => 'ArticleController@store'
    ]);


    Route::get('/show/{id}', [
        'middleware' => 'acl_access:admin/article/show/{id}',
        'as' => 'article.show',
        'uses' => 'ArticleController@show'
    ]);

    Route::get('/edit/{id}', [
        'middleware' => 'acl_access:admin/article/edit/{id}',
        'as' => 'article.edit',
        'uses' => 'ArticleController@edit'
    ]);


    Route::post('/update/{id}', [
        'middleware' => 'acl_access:admin/article/update/{id}',
        'as' => 'article.update',
        'uses' => 'ArticleController@update'
    ]);


    Route::get('/delete/{id}', [
        'middleware' => 'acl_access:admin/article/delete/{id}',
        'as' => 'article.delete',
        'uses' => 'ArticleController@delete'
    ]);

    Route::get('/active/{id}/{active}', [
        'middleware' => 'acl_access:admin/article/active/{id}/{active}',
        'as' => 'article.active',
        'uses' => 'ArticleController@active'
    ]);

    Route::get('/inactive/{id}/{inactive}', [
        'middleware' => 'acl_access:admin/article/inactive/{id}/{inactive}',
        'as' => 'article.inactive',
        'uses' => 'ArticleController@inactive'
    ]);

    Route::get('/article-mail/{id}', [
        'middleware' => 'acl_access:admin/article/article-mail/{id}',
        'as' => 'article.mail',
        'uses' => 'ArticleController@articleMail'
    ]);

    Route::post('/article/mail-send/{id}', [
        'middleware' => 'acl_access:admin/article/article/mail-send/{id}',
        'as' => 'article.mail.send',
        'uses' => 'ArticleController@articleMailSend'
    ]);

    Route::get('/user-send-mail-list/{id}', [
        'middleware' => 'acl_access:admin/article/user-send-mail-list/{id}',
        'as' => 'user.send.mail.list',
        'uses' => 'ArticleController@userSendMailList'
    ]);

    Route::get('/mail-delete/{id}', [
        'middleware' => 'acl_access:admin/article/mail-delete/{id}',
        'as' => 'mail.delete',
        'uses' => 'ArticleController@mailDelete'
    ]);

});

