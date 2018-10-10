<?php

// middleware
Route::Group(['namespace'=>'Modules\User\Controllers','middleware' => 'web'],function() {

    /*Role */
    Route::get('admin/user/role', [
        // 'middleware' => 'acl_access:admin/user/role',
        'as' => 'user.role',
        'uses' => 'RoleController@index'
    ]);
    Route::any('admin/user/store-role', [
        //'middleware' => 'acl_access:admin/user/store-role',
        'as' => 'user.store.role',
        'uses' => 'RoleController@store_role'
    ]);
    Route::any('admin/user/view-role/{slug}', [
        //'middleware' => 'acl_access:admin/user/view-role/{slug}',
        'as' => 'user.view.role',
        'uses' => 'RoleController@show'
    ]);
    Route::any('admin/user/edit-role/{slug}', [
        // 'middleware' => 'acl_access:admin/user/edit-role/{slug}',
        'as' => 'user.edit.role',
        'uses' => 'RoleController@edit'
    ]);
    Route::any('admin/user/update-role/{slug}', [
        // 'middleware' => 'acl_access:admin/user/update-role/{slug}',
        'as' => 'user.update.role',
        'uses' => 'RoleController@update'
    ]);
    Route::get('admin/user/delete-role/{slug}', [
        //'middleware' => 'acl_access:admin/user/delete-role/{slug}',
        'as' => 'user.delete.role',
        'uses' => 'RoleController@destroy'
    ]);
    Route::get('admin/user/role-search', [
        // 'middleware' => 'acl_access:admin/user/role-search',
        'as' => 'user.role.search',
        'uses' => 'RoleController@search_role'
    ]);


    /*Permission */
    Route::get('admin/user/permission', [
        // 'middleware' => 'acl_access:admin/user/permission',
        'as' => 'user.index.permission',
        'uses' => 'PermissionController@index'
    ]);
    Route::any('admin/user/store-permission', [
        //  'middleware' => 'acl_access:admin/user/store-permission',
        'as' => 'user.store.permission',
        'uses' => 'PermissionController@store'
    ]);
    Route::get('admin/user/view-permission/{id}', [
        // 'middleware' => 'acl_access:admin/user/view-permission/{id}',
        'as' => 'user.view.permission',
        'uses' => 'PermissionController@show'
    ]);
    Route::get('admin/user/edit-permission/{id}', [
        // 'middleware' => 'acl_access:admin/user/edit-permission/{id}',
        'as' => 'user.edit.permission',
        'uses' => 'PermissionController@edit'
    ]);
    Route::any('admin/user/update-permission/{id}', [
        // 'middleware' => 'acl_access:admin/user/update-permission/{id}',
        'as' => 'user.update.permission',
        'uses' => 'PermissionController@update'
    ]);
    Route::get('admin/user/delete-permission/{id}', [
        //'middleware' => 'acl_access:admin/user/delete-permission/{id}',
        'as' => 'user.delete.permission',
        'uses' => 'PermissionController@destroy'
    ]);
    Route::post('admin/user/delete-all-role-permission', [
        #'middleware' => 'acl_access:admin/user/delete-role-permission/{id}',
        'as' => 'user.delete.all.role.permission',
        'uses' => 'RolePermissionController@destroy_all'
    ]);
    Route::get('admin/user/route-in-permission', [
        // 'middleware' => 'acl_access:admin/user/route-in-permission',
        'as' => 'route.in.permission',
        'uses' => 'PermissionController@route_in_permission'
    ]);
    Route::get('admin/user/permission-search', [
        // 'middleware' => 'acl_access:admin/user/permission-search',
        'as' => 'user.permission.search',
        'uses' => 'PermissionController@search_permission'
    ]);


    /*User Role*/
    Route::get('admin/user/role-user', [
        // 'middleware' => 'acl_access:admin/user/role-user',
        'as' => 'user.index.role.user',
        'uses' => 'RoleUserController@index'
    ]);

    Route::get('admin/user/delete-role-user/{id}', [
        //  'middleware' => 'acl_access:admin/user/delete-role-user/{id}',
        'as' => 'user.delete.user.role',
        'uses' => 'RoleUserController@destroy'
    ]);

    Route::get('admin/user/search-user-role', [
        //  'middleware' => 'acl_access:admin/user/search-user-role',
        'as' => 'user.search.user.role',
        'uses' => 'RoleUserController@search_user_role'
    ]);

    Route::post('admin/user/add-user-role', [
        // 'middleware' => 'acl_access:admin/user/add-user-role',
        'as' => 'user.add.user.role',
        'uses' => 'RoleUserController@store_role'
    ]);

    Route::any('admin/user/edit-user-role/{id}', [
        // 'middleware' => 'acl_access:admin/user/edit-user-role/{id}',
        'as' => 'user.edit.role.user',
        'uses' => 'RoleUserController@edit'
    ]);

    Route::any('admin/user/update-user-role/{id}', [
        //  'middleware' => 'acl_access:admin/user/update-user-role/{id}',
        'as' => 'user.add.user.role_edit',
        'uses' => 'RoleUserController@update'
    ]);

    Route::any('admin/user/delete-user-role/{id}', [
        //'middleware' => 'acl_access:admin/user/delete-user-role/{id}',
        'as' => 'user.delete.role.user',
        'uses' => 'RoleUserController@delete'
    ]);

    Route::any('admin/user/delete-all-user-role', [
        // 'middleware' => 'acl_access:admin/user/delete-all-user-role',
        'as' => 'user.delete.all.user.role',
        'uses' => 'RoleUserController@delete_all'
    ]);


    /*Role Permission */
    Route::get('admin/user/role-permission', [
        //'middleware' => 'acl_access:admin/user/role-permission',
        'as' => 'user.index.role.permission',
        'uses' => 'RolePermissionController@index'
    ]);

    Route::post('admin/user/add-permission-role', [
        // 'middleware' => 'acl_access:admin/user/add-permission-role',
        'as' => 'user.add.role.permission',
        'uses' => 'RolePermissionController@create'
    ]);

    Route::any('admin/user/store-role-permission', [
        // 'middleware' => 'acl_access:admin/user/store-role-permission',
        'as' => 'user.store.role.permission',
        'uses' => 'RolePermissionController@store'
    ]);

    Route::any('admin/user/view-role-permission/{id}', [
        //   'middleware' => 'acl_access:admin/user/view-role-permission/{id}',
        'as' => 'user.view.role.permission',
        'uses' => 'RolePermissionController@show'
    ]);

    Route::get('admin/user/edit-role-permission/{id}', [
        // 'middleware' => 'acl_access:admin/user/edit-role-permission/{id}',
        'as' => 'user.edit.role.permission',
        'uses' => 'RolePermissionController@edit'
    ]);

    Route::any('admin/user/update-role-permission/{id}', [
        'middleware' => 'acl_access:admin/user/update-role-permission/{id}',
        'as' => 'user.update.role.permission',
        'uses' => 'RolePermissionController@update'
    ]);

    /* Delete Permission */
    Route::get('admin/user/delete-role-permission/{id}', [
        //  'middleware' => 'acl_access:admin/user/delete-role-permission/{id}',
        'as' => 'user.delete.role.permission',
        'uses' => 'RolePermissionController@destroy'
    ]);

    Route::get('admin/user/search-role-permission', [
        //'middleware' => 'acl_access:admin/user/search-role-permission',
        'as' => 'user.search.role.permission',
        'uses' => 'RolePermissionController@search_permission_role'
    ]);


});

