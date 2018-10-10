<?php

//Login Registration route

Route::Group(['namespace'=>'Modules\User\Controllers', 'middleware' => 'web'],function() {

    Route::post('/user-registration','UserRegistrationController@userRegistration')->name('user.registration');
    Route::post('/user-login','UserRegistrationController@userLogin')->name('user.login');
    Route::get('/custom-logout','UserListController@customLogout')->name('custom.logout');
    Route::get('account/verify/{email}/{verifyToken}', [
        'as' => 'account.verify',
        'uses' => 'UserRegistrationController@accountVerify'
    ]);
});
