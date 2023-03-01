<?php
/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Default API resource
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:api', 'localization'])->group(function () {
    Route::apiResource('legal_info_subject', 'App\Http\Controllers\API\LegalInfoSubjectController');
    Route::apiResource('legal_info_title', 'App\Http\Controllers\API\LegalInfoTitleController');
    Route::apiResource('legal_info_content', 'App\Http\Controllers\API\LegalInfoContentController');
    Route::apiResource('type', 'App\Http\Controllers\API\TypeController');
    Route::apiResource('image', 'App\Http\Controllers\API\ImageController');
    Route::apiResource('group', 'App\Http\Controllers\API\GroupController');
    Route::apiResource('continent', 'App\Http\Controllers\API\ContinentController');
    Route::apiResource('region', 'App\Http\Controllers\API\RegionController');
    Route::apiResource('country', 'App\Http\Controllers\API\CountryController');
    Route::apiResource('province', 'App\Http\Controllers\API\ProvinceController');
    Route::apiResource('city', 'App\Http\Controllers\API\CityController');
    Route::apiResource('area', 'App\Http\Controllers\API\AreaController');
    Route::apiResource('neighborhood', 'App\Http\Controllers\API\NeighborhoodController');
    Route::apiResource('address', 'App\Http\Controllers\API\AddressController');
    Route::apiResource('role', 'App\Http\Controllers\API\RoleController');
    Route::apiResource('user', 'App\Http\Controllers\API\UserController');
    Route::apiResource('role_user', 'App\Http\Controllers\API\RoleUserController');
    Route::apiResource('password_reset', 'App\Http\Controllers\API\PasswordResetController');
    Route::apiResource('message', 'App\Http\Controllers\API\MessageController');
    Route::apiResource('notification', 'App\Http\Controllers\API\NotificationController');
    Route::apiResource('news', 'App\Http\Controllers\API\NewsController');
});
/*
|--------------------------------------------------------------------------
| Custom API resource
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['api', 'localization']], function () {
    Route::resource('user', 'App\Http\Controllers\API\UserController');

    Route::get('user/get_api_token/{email}', 'App\Http\Controllers\API\UserController@getApiToken')->name('user.get_api_token');
    Route::post('user/login', 'App\Http\Controllers\API\UserController@login')->name('user.login');
});
Route::group(['middleware' => ['api', 'auth:api', 'localization']], function () {
    Route::resource('legal_info_subject', 'App\Http\Controllers\API\LegalInfoSubjectController');
    Route::resource('legal_info_title', 'App\Http\Controllers\API\LegalInfoTitleController');
    Route::resource('legal_info_content', 'App\Http\Controllers\API\LegalInfoContentController');
    Route::resource('type', 'App\Http\Controllers\API\TypeController');
    Route::resource('image', 'App\Http\Controllers\API\ImageController');
    Route::resource('group', 'App\Http\Controllers\API\GroupController');
    Route::resource('region', 'App\Http\Controllers\API\RegionController');
    Route::resource('country', 'App\Http\Controllers\API\CountryController');
    Route::resource('province', 'App\Http\Controllers\API\ProvinceController');
    Route::resource('city', 'App\Http\Controllers\API\CityController');
    Route::resource('area', 'App\Http\Controllers\API\AreaController');
    Route::resource('neighborhood', 'App\Http\Controllers\API\NeighborhoodController');
    Route::resource('role', 'App\Http\Controllers\API\RoleController');
    Route::resource('user', 'App\Http\Controllers\API\UserController');
    Route::resource('message', 'App\Http\Controllers\API\MessageController');
    Route::resource('notification', 'App\Http\Controllers\API\NotificationController');
    Route::resource('news', 'App\Http\Controllers\API\NewsController');

    // LegalInfoSubject
    Route::get('legal_info_subject/search/{data}', 'App\Http\Controllers\API\LegalInfoSubjectController@search')->name('legal_info_subject.search');
    Route::put('legal_info_subject/switch_status/{id}/{data}', 'App\Http\Controllers\API\LegalInfoSubjectController@switchStatus')->name('legal_info_subject.switch_status');
    // LegalInfoTitle
    Route::get('legal_info_title/search/{data}', 'App\Http\Controllers\API\LegalInfoTitleController@search')->name('legal_info_title.search');
    // LegalInfoContent
    Route::get('legal_info_content/search/{data}', 'App\Http\Controllers\API\LegalInfoContentController@search')->name('legal_info_content.search');
    Route::put('legal_info_content/add_image/{id}', 'App\Http\Controllers\API\LegalInfoContentController@addImage')->name('legal_info_content.add_image');
    // Type
    Route::get('type/search/{data}', 'App\Http\Controllers\API\TypeController@search')->name('type.search');
    // Image
    Route::get('image/select_by_entity/{entity}/{id}', 'App\Http\Controllers\API\ImageController@selectByEntity')->name('image.select_by_entity');
    // Group
    Route::get('group/search/{data}', 'App\Http\Controllers\API\GroupController@search')->name('group.search');
    // Region
    Route::get('region/search/{data}', 'App\Http\Controllers\API\RegionController@search')->name('region.search');
    // Country
    Route::get('country/search/{data}', 'App\Http\Controllers\API\CountryController@search')->name('country.search');
    Route::put('country/associate_languages/{id}', 'App\Http\Controllers\API\CountryController@associateLanguages')->name('country.associate_languages');
    Route::put('country/withdraw_languages/{id}', 'App\Http\Controllers\API\CountryController@withdrawLanguages')->name('country.withdraw_languages');
    // Province
    Route::get('province/search/{data}', 'App\Http\Controllers\API\ProvinceController@search')->name('province.search');
    Route::get('province/search_with_country/{country_name}/{data}', 'App\Http\Controllers\API\ProvinceController@searchWithCountry')->name('province.search_with_country');
    // City
    Route::get('city/search/{data}', 'App\Http\Controllers\API\CityController@search')->name('city.search');
    Route::get('city/search_with_province/{province_name}/{data}', 'App\Http\Controllers\API\CityController@searchWithProvince')->name('city.search_with_province');
    // Area
    Route::get('area/search/{data}', 'App\Http\Controllers\API\AreaController@search')->name('area.search');
    Route::get('area/search_with_city/{city_name}/{data}', 'App\Http\Controllers\API\AreaController@searchWithCity')->name('area.search_with_city');
    // Neighborhood
    Route::get('neighborhood/search/{data}', 'App\Http\Controllers\API\NeighborhoodController@search')->name('neighborhood.search');
    Route::get('neighborhood/search_with_area_and_city/{area_name}/{city_name}/{data}', 'App\Http\Controllers\API\NeighborhoodController@searchWithAreaAndCity')->name('neighborhood.search_with_area_and_city');
    // Role
    Route::get('role/search/{data}', 'App\Http\Controllers\API\RoleController@search')->name('role.search');
    // User
    Route::get('user/search/{data}', 'App\Http\Controllers\API\UserController@search')->name('user.search');
    Route::put('user/switch_status/{id}/{status_name}', 'App\Http\Controllers\API\UserController@switchStatus')->name('user.switch_status');
    Route::put('user/associate_roles/{id}', 'App\Http\Controllers\API\UserController@associateRoles')->name('user.associate_roles');
    Route::put('user/withdraw_roles/{id}', 'App\Http\Controllers\API\UserController@withdrawRoles')->name('user.withdraw_roles');
    Route::put('user/update_password/{id}', 'App\Http\Controllers\API\UserController@updatePassword')->name('user.update_password');
    Route::put('user/update_api_token/{id}', 'App\Http\Controllers\API\UserController@updateApiToken')->name('user.update_api_token');
    Route::put('user/update_avatar_picture/{id}', 'App\Http\Controllers\API\UserController@updateAvatarPicture')->name('user.update_avatar_picture');
    Route::put('user/add_image/{id}', 'App\Http\Controllers\API\UserController@addImage')->name('user.add_image');
    // Message
    Route::get('message/search/{data}', 'App\Http\Controllers\API\MessageController@search')->name('message.search');
    Route::get('message/inbox/{entity}', 'App\Http\Controllers\API\MessageController@inbox')->name('message.inbox');
    Route::get('message/outbox/{user_id}', 'App\Http\Controllers\API\MessageController@outbox')->name('message.outbox');
    Route::get('message/answers/{message_id}', 'App\Http\Controllers\API\MessageController@answers')->name('message.answers');
    // Notification
    Route::get('notification/select_by_user/{user_id}', 'App\Http\Controllers\API\NotificationController@selectByUser')->name('notification.select_by_user');
    Route::get('notification/select_unread_by_user/{user_id}', 'App\Http\Controllers\API\NotificationController@selectUnreadByUser')->name('notification.select_unread_by_user');
    Route::get('notification/switch_status/{id}', 'App\Http\Controllers\API\NotificationController@switchStatus')->name('notification.switch_status');
    // News
    Route::get('news/select_by_type/{type_id}', 'App\Http\Controllers\API\NewsController@selectByType')->name('news.select_by_type');
});
