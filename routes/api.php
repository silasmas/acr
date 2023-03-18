<?php
/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
use App\Models\LegalInfoSubject;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\LegalInfoSubject as ResourcesLegalInfoSubject;

/*
|--------------------------------------------------------------------------
| Default API resource
|--------------------------------------------------------------------------
 */
Route::middleware(['auth:api', 'localization'])->group(function () {

    Route::apiResource('legal_info_subject', 'App\Http\Controllers\API\LegalInfoSubjectController');
    Route::apiResource('legal_info_title', 'App\Http\Controllers\API\LegalInfoTitleController');
    Route::apiResource('legal_info_content', 'App\Http\Controllers\API\LegalInfoContentController');
    Route::apiResource('group', 'App\Http\Controllers\API\GroupController');
    Route::apiResource('status', 'App\Http\Controllers\API\StatusController');
    Route::apiResource('type', 'App\Http\Controllers\API\TypeController');
    Route::apiResource('image', 'App\Http\Controllers\API\ImageController');
    Route::apiResource('country', 'App\Http\Controllers\API\CountryController');
    Route::apiResource('address', 'App\Http\Controllers\API\AddressController');
    Route::apiResource('role', 'App\Http\Controllers\API\RoleController');
    Route::apiResource('user', 'App\Http\Controllers\API\UserController');
    Route::apiResource('role_user', 'App\Http\Controllers\API\RoleUserController');
    Route::apiResource('password_reset', 'App\Http\Controllers\API\PasswordResetController');
    Route::apiResource('message', 'App\Http\Controllers\API\MessageController');
    Route::apiResource('notification', 'App\Http\Controllers\API\NotificationController');
    Route::apiResource('news', 'App\Http\Controllers\API\NewsController');
    Route::apiResource('offer', 'App\Http\Controllers\API\OfferController');
});
/*
|--------------------------------------------------------------------------
| Custom API resource
|--------------------------------------------------------------------------
 */
Route::group(['middleware' => ['api', 'localization']], function () {
    Route::resource('user', 'App\Http\Controllers\API\UserController');
    Route::resource('payment', 'App\Http\Controllers\API\PaymentController');

    // User
    Route::get('user/get_api_token/{email}', 'App\Http\Controllers\API\UserController@getApiToken')->name('user.api.get_api_token');
    Route::post('user/login', 'App\Http\Controllers\API\UserController@login')->name('user.api.login');
    Route::post('payment/store', 'App\Http\Controllers\API\PaymentController@store')->name('payment.api.store');
});
Route::group(['middleware' => ['api', 'auth:api', 'localization']], function () {
    Route::resource('legal_info_title', 'App\Http\Controllers\API\LegalInfoTitleController');
    Route::resource('legal_info_content', 'App\Http\Controllers\API\LegalInfoContentController');
    Route::resource('group', 'App\Http\Controllers\API\GroupController');
    Route::resource('status', 'App\Http\Controllers\API\StatusController');
    Route::resource('type', 'App\Http\Controllers\API\TypeController');
    Route::resource('country', 'App\Http\Controllers\API\CountryController');
    Route::resource('role', 'App\Http\Controllers\API\RoleController');
    Route::resource('user', 'App\Http\Controllers\API\UserController');
    Route::resource('password_reset', 'App\Http\Controllers\API\PasswordResetController');
    Route::resource('message', 'App\Http\Controllers\API\MessageController');
    Route::resource('notification', 'App\Http\Controllers\API\NotificationController');
    Route::resource('news', 'App\Http\Controllers\API\NewsController');
    Route::resource('payment', 'App\Http\Controllers\API\PaymentController');

    // LegalInfoTitle
    Route::get('legal_info_title/search/{data}', 'App\Http\Controllers\API\LegalInfoTitleController@search')->name('legal_info_title.api.search');
    // LegalInfoContent
    Route::get('legal_info_content/search/{data}', 'App\Http\Controllers\API\LegalInfoContentController@search')->name('legal_info_content.api.search');
    Route::put('legal_info_content/add_image/{id}', 'App\Http\Controllers\API\LegalInfoContentController@addImage')->name('legal_info_content.api.add_image');
    // Group
    Route::get('group/search/{data}', 'App\Http\Controllers\API\GroupController@search')->name('group.api.search');
    // Status
    Route::get('status/search/{data}', 'App\Http\Controllers\API\StatusController@search')->name('status.api.search');
    Route::get('status/find_by_group/{group_name}', 'App\Http\Controllers\API\StatusController@findByGroup')->name('status.api.find_by_group');
    // Type
    Route::get('type/search/{data}', 'App\Http\Controllers\API\TypeController@search')->name('type.api.search');
    Route::get('type/find_by_group/{group_name}', 'App\Http\Controllers\API\TypeController@findByGroup')->name('type.api.find_by_group');
    // Country
    Route::get('country/search/{data}', 'App\Http\Controllers\API\CountryController@search')->name('country.api.search');
    // Role
    Route::get('role/search/{data}', 'App\Http\Controllers\API\RoleController@search')->name('role.api.search');
    // User
    Route::get('user/search/{data}', 'App\Http\Controllers\API\UserController@search')->name('user.api.search');
    Route::put('user/switch_status/{id}/{status_id}', 'App\Http\Controllers\API\UserController@switchStatus')->name('user.api.switch_status');
    Route::put('user/associate_roles/{id}', 'App\Http\Controllers\API\UserController@associateRoles')->name('user.api.associate_roles');
    Route::put('user/withdraw_roles/{id}', 'App\Http\Controllers\API\UserController@withdrawRoles')->name('user.api.withdraw_roles');
    Route::put('user/update_password/{id}', 'App\Http\Controllers\API\UserController@updatePassword')->name('user.api.update_password');
    Route::put('user/update_api_token/{id}', 'App\Http\Controllers\API\UserController@updateApiToken')->name('user.api.update_api_token');
    Route::put('user/update_avatar_picture/{id}', 'App\Http\Controllers\API\UserController@updateAvatarPicture')->name('user.api.update_avatar_picture');
    Route::put('user/add_image/{id}', 'App\Http\Controllers\API\UserController@addImage')->name('user.add_image');
    // PasswordReset
    Route::get('password_reset/search_by_email/{data}', 'App\Http\Controllers\API\PasswordResetController@searchByEmail')->name('password_reset.api.search_by_email');
    Route::get('password_reset/search_by_phone/{data}', 'App\Http\Controllers\API\PasswordResetController@searchByPhone')->name('password_reset.api.search_by_phone');
    // Message
    Route::get('message/search/{data}', 'App\Http\Controllers\API\MessageController@search')->name('message.api.search');
    Route::get('message/inbox/{entity}', 'App\Http\Controllers\API\MessageController@inbox')->name('message.api.inbox');
    Route::get('message/outbox/{user_id}', 'App\Http\Controllers\API\MessageController@outbox')->name('message.api.outbox');
    Route::get('message/answers/{message_id}', 'App\Http\Controllers\API\MessageController@answers')->name('message.api.answers');
    // Notification
    Route::get('notification/select_by_user/{user_id}', 'App\Http\Controllers\API\NotificationController@selectByUser')->name('notification.api.select_by_user');
    Route::put('notification/switch_status/{id}/{status_id}', 'App\Http\Controllers\API\NotificationController@switchStatus')->name('notification.api.switch_status');
    Route::put('notification/mark_all_read/{user_id}', 'App\Http\Controllers\API\NotificationController@markAllRead')->name('notification.api.mark_all_read');
    // News
    Route::get('news/select_by_type/{type_id}', 'App\Http\Controllers\API\NewsController@selectByType')->name('news.api.select_by_type');
    Route::put('news/add_image/{id}', 'App\Http\Controllers\API\NewsController@addImage')->name('news.api.add_image');
    // Payment
    Route::get('payment', 'App\Http\Controllers\API\PaymentController@index')->name('payment.api.index');
    Route::get('payment/find_by_phone/{phone_number}', 'App\Http\Controllers\API\PaymentController@findByPhone')->name('payment.api.find_by_phone');
    Route::put('payment/switch_status/{status_id}/{id}', 'App\Http\Controllers\API\PaymentController@switchStatus')->name('payment.api.switch_status');

    // Functions created directly here
    Route::get('about_subject/about_app', function () {
        $baseController = new BaseController();
        $legal_info_subject = LegalInfoSubject::where('subject_name', 'L\'application ACR')->first();

        if (is_null($legal_info_subject)) {
            return $baseController->handleError(__('notifications.find_legal_info_subject_404'));
        }

        return $baseController->handleResponse(new ResourcesLegalInfoSubject($legal_info_subject), __('notifications.find_legal_info_subject_success'));

    });
    Route::get('about_subject/about_party', function () {
        $baseController = new BaseController();
        $legal_info_subject = LegalInfoSubject::where('subject_name', 'A propos du parti ACR')->first();

        if (is_null($legal_info_subject)) {
            return $baseController->handleError(__('notifications.find_legal_info_subject_404'));
        }

        return $baseController->handleResponse(new ResourcesLegalInfoSubject($legal_info_subject), __('notifications.find_legal_info_subject_success'));

    });
    Route::get('about_subject/terms', function () {
        $baseController = new BaseController();
        $legal_info_subject = LegalInfoSubject::where('subject_name', 'Conditions d\'utilisation')->first();

        if (is_null($legal_info_subject)) {
            return $baseController->handleError(__('notifications.find_legal_info_subject_404'));
        }

        return $baseController->handleResponse(new ResourcesLegalInfoSubject($legal_info_subject), __('notifications.find_legal_info_subject_success'));

    });
    Route::get('about_subject/privacy_policy', function () {
        $baseController = new BaseController();
        $legal_info_subject = LegalInfoSubject::where('subject_name', 'Politique de confidentialité')->first();

        if (is_null($legal_info_subject)) {
            return $baseController->handleError(__('notifications.find_legal_info_subject_404'));
        }

        return $baseController->handleResponse(new ResourcesLegalInfoSubject($legal_info_subject), __('notifications.find_legal_info_subject_success'));

    });
    Route::get('about_subject/help_center', function () {
        $baseController = new BaseController();
        $legal_info_subject = LegalInfoSubject::where('subject_name', 'Centre d\'assistance et d\'aide')->first();

        if (is_null($legal_info_subject)) {
            return $baseController->handleError(__('notifications.find_legal_info_subject_404'));
        }

        return $baseController->handleResponse(new ResourcesLegalInfoSubject($legal_info_subject), __('notifications.find_legal_info_subject_success'));

    });
    Route::get('about_subject/faq', function () {
        $baseController = new BaseController();
        $legal_info_subject = LegalInfoSubject::where('subject_name', 'FAQ')->first();

        if (is_null($legal_info_subject)) {
            return $baseController->handleError(__('notifications.find_legal_info_subject_404'));
        }

        return $baseController->handleResponse(new ResourcesLegalInfoSubject($legal_info_subject), __('notifications.find_legal_info_subject_success'));

    });
});
