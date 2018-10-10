<?php

//front route


Route::Group(['namespace'=>'Modules\Web\Controllers', 'middleware' => ['web']],function() {

    Route::get('/','FrontController@index')->name('front.home');
    Route::get('/single-article/{id}','FrontController@singleArticle')->name('single.article');
    Route::get('/category-by-post/{id}','FrontController@categoryByPost')->name('category_by_post');
    Route::get('/post-search','FrontController@postSearch')->name('post_search');
    Route::post('/user-subscribe','FrontController@subscribe')->name('user.subscribe');

    //article view count route
    Route::post('/article-view-count','FrontController@articleViewCount')->name('article.view.count');

    //Front page route

    Route::get('/about-us','FrontController@aboutUs')->name('about_us');
    Route::get('/privacy-policy','FrontController@privacyPolicy')->name('privacy.policy');
    Route::get('/contact-us','FrontController@contactUs')->name('contact_us');
//contact form submit route
    Route::post('/contact-form-store','FrontController@contactFormStore')->name('contact.form.store');

    //voting and bookmark and comment Route
    Route::post('/user-voting','VotingController@userVoting')->name('user.voting');
    Route::post('/user-comment/{id}','VotingController@userComment')->name('user.comment');
    Route::post('/user-bookmark','VotingController@userBookmark')->name('user.bookmark');
    Route::get('/user-bookmark-list','VotingController@userBookmarkList')->name('user.bookmark.list');

    //user profile route
    Route::get('/user-profile','UserProfileController@userProfile')->name('front.user.profile');
    Route::get('/user-profile-edit/{id}','UserProfileController@userProfileEdit')->name('front.user.profile.edit');
    Route::post('/user-profile-update/{id}','UserProfileController@userProfileUpdate')->name('front.user.profile.update');

//user article route
    Route::get('/user-article', [
        'as' => 'user.article',
        'uses' => 'UserProfileController@userArticle'
    ]);

    Route::get('/user-create-article','UserProfileController@userCreateArticle')->name('user.create.article');
    Route::post('/user-article-store','UserProfileController@userArticleStore')->name('user.article.store');
    Route::get('/user-article-edit/{id}','UserProfileController@userArticleEdit')->name('user.article.edit');
    Route::post('/user-article-update/{id}','UserProfileController@userArticleUpdate')->name('user.article.update');
    Route::get('/user-article-delete/{id}','UserProfileController@userArticleDelete')->name('user.article.delete');


    //writer all article route

    Route::get('/user-all-article/{id}','FrontController@userAllArticle')->name('user_all_article');




});

