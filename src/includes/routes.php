<?php

/*

This file is part of Mustard.

Mustard is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Mustard is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Mustard.  If not, see <http://www.gnu.org/licenses/>.

*/

Route::group([
    'middleware' => 'web',
    'prefix'     => config('mustard.uri_base'),
    'namespace'  => 'Hamjoint\Mustard\Http\Controllers',
], function () {
    Route::group([
        'middleware' => 'auth',
    ], function () {
        Route::get('account', 'AccountController@index');
        Route::get('account/password', 'AccountController@showChangePasswordForm');
        Route::post('account/password', 'AccountController@changePassword');
        Route::get('account/email', 'AccountController@showChangeEmailForm');
        Route::post('account/email', 'AccountController@changeEmail');
        Route::get('account/notifications', 'AccountController@showChangeNotificationsForm');
        Route::post('account/notifications', 'AccountController@changeNotifications');
        Route::get('account/close', 'AccountController@showCloseAccountForm');
        Route::post('account/close', 'AccountController@closeAccount');

        Route::get('inventory', ['uses' => 'InventoryController@getIndex']);
        Route::get('inventory/watching', ['uses' => 'InventoryController@getWatching']);
        Route::get('inventory/selling', ['uses' => 'InventoryController@getSelling']);
        Route::get('inventory/scheduled', ['uses' => 'InventoryController@getScheduled']);
        Route::get('inventory/ended', ['uses' => 'InventoryController@getEnded']);

        Route::get('sell', 'ItemController@getNew');
        Route::get('item/new', 'ItemController@getNew');
        Route::get('item/edit/{id}', 'ItemController@getEdit');
        Route::get('item/relist/{id}', 'ItemController@getRelist');
        Route::get('item/end/{id}', 'ItemController@getEnd');
        Route::post('item/new', 'ItemController@postNew');
        Route::post('item/edit', 'ItemController@postEdit');
        Route::post('item/end', 'ItemController@postEnd');
        Route::post('item/cancel', 'ItemController@postCancel');
        Route::post('item/watch', 'ItemController@postWatch');
        Route::post('item/unwatch', 'ItemController@postUnwatch');

        Route::get('admin', 'AdminController@index');
        Route::get('admin/dashboard', 'AdminController@showDashboard');
        Route::get('admin/categories', 'AdminController@showCategoriesTable');
        Route::post('admin/categories/new', 'AdminController@createCategory');
        Route::post('admin/categories/update', 'AdminController@updateCategory');
        Route::post('admin/categories/delete', 'AdminController@deleteCategory');
        Route::post('admin/categories/sort', 'AdminController@sortCategories');
        Route::get('admin/items', 'AdminController@showItemsTable');
        Route::get('admin/items/edit', 'AdminController@showEditItemForm');
        Route::post('admin/items/edit', 'AdminController@editItem');
        Route::get('admin/items/end', 'AdminController@showEndItemForm');
        Route::post('admin/items/end', 'AdminController@endItem');
        Route::get('admin/users', 'AdminController@showUsersTable');
        Route::get('admin/users/edit', 'AdminController@showUserForm');
        Route::post('admin/users/edit', 'AdminController@editUser');
        Route::post('admin/users/reset-password', 'AdminController@resetUserPassword');
        Route::get('admin/item-conditions', 'AdminController@showItemConditionsTable');
        Route::post('admin/item-conditions/new', 'AdminController@createItemCondition');
        Route::post('admin/item-conditions/update', 'AdminController@updateItemCondition');
        Route::post('admin/item-conditions/delete', 'AdminController@deleteItemCondition');
        Route::post('admin/item-conditions/sort', 'AdminController@sortItemConditions');
        Route::get('admin/listing-durations', 'AdminController@showListingDurationsTable');
        Route::post('admin/listing-durations/new', 'AdminController@createListingDuration');
        Route::post('admin/listing-durations/update', 'AdminController@updateListingDuration');
        Route::post('admin/listing-durations/delete', 'AdminController@deleteListingDuration');
        Route::post('admin/listing-durations/sort', 'AdminController@sortListingDurations');
        Route::get('admin/mailout', 'AdminController@showMailoutForm');
        Route::post('admin/mailout', 'AdminController@sendMailout');
        Route::get('admin/settings', 'AdminController@showSettingsTable');
        Route::post('admin/settings', 'AdminController@updateSettings');
    });

    Route::get('buy', ['uses' => 'ListingController@getIndex']);
    Route::get('buy/{categories}', ['uses' => 'ListingController@getIndex'])->where('categories', '(.+)');

    Route::get('item/{id}/{slug?}', ['uses' => 'ItemController@getIndex'])->where('id', '[0-9]+');

    Route::get('user/{id}', ['uses' => 'UserController@getIndex']);

    Route::get('', 'MetaController@getIndex');
});
