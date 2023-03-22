<?php
/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */

use App\Http\Controllers\Web\APIController;
use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Web\CountryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LegalInfoController;
use App\Http\Controllers\Web\MessageController;
use App\Http\Controllers\Web\MiscellaneousController;
use App\Http\Controllers\Web\PartyController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
|--------------------------------------------------------------------------
| ROUTES FOR EVERY ROLES
|--------------------------------------------------------------------------
*/
// Generate symbolic link
Route::get('/symlink', function () {
    return view('symlink');
});

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/language/{locale}', [HomeController::class, 'changeLanguage'])->name('change_language');
// Account
Route::get('/account', [AccountController::class, 'account'])->name('account');
Route::get('/update_password', [AccountController::class, 'editPassword'])->name('account.update.password');
Route::post('/account', [AccountController::class, 'updateAccount']);
Route::post('/update_password', [AccountController::class, 'updatePassword']);
// Message
Route::get('/message', [MessageController::class, 'receivedMessages'])->name('message.inbox');
Route::get('/message/{id}', [MessageController::class, 'showMessage'])->whereNumber('id')->name('message.datas');
Route::get('/message_sent', [MessageController::class, 'sentMessages'])->name('message.outbox');
Route::get('/message_drafts', [MessageController::class, 'draftsMessages'])->name('message.draft');
Route::get('/message_spams', [MessageController::class, 'spamsMessages'])->name('message.spams');
Route::get('/message_new', [MessageController::class, 'newMessage'])->name('message.new');
Route::get('/message_search/{data}', [MessageController::class, 'search'])->name('message.search');
Route::get('/message_delete/{id}', [MessageController::class, 'deleteMessage'])->name('message.delete');
Route::post('/message', [MessageController::class, 'storeMessage']);
Route::post('/message/{id}', [MessageController::class, 'updateMessage'])->whereNumber('id');
// Notification
Route::get('/notification', [HomeController::class, 'notification'])->name('notification.home');

/*
|--------------------------------------------------------------------------
| ROUTES FOR EVERY ROLES EXCEPT "Administrateur" AND "Développeur"
|--------------------------------------------------------------------------
*/
// About us
Route::get('/about', [HomeController::class, 'aboutUs'])->name('about.home');
Route::get('/about/party', [HomeController::class, 'aboutParty'])->name('about.party');
Route::get('/about/app', [HomeController::class, 'aboutApplication'])->name('about.app');
Route::get('/about/terms_of_use', [HomeController::class, 'termsOfUse'])->name('about.terms_of_use');
Route::get('/about/privacy_policy', [HomeController::class, 'privacyPolicy'])->name('about.privacy_policy');
Route::get('/about/help', [HomeController::class, 'help'])->name('about.help');
Route::get('/about/faq', [HomeController::class, 'faq'])->name('about.faq');

/*
|--------------------------------------------------------------------------
| ROUTES FOR "Administrateur"
|--------------------------------------------------------------------------
*/
// Home
Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
// Legal info
Route::get('/legal_info', [LegalInfoController::class, 'index'])->name('legal_info.home');
Route::get('/legal_info/{id}', [LegalInfoController::class, 'show'])->whereNumber('id')->name('legal_info.datas');
Route::get('/legal_info/{entity}', [LegalInfoController::class, 'indexEntity'])->name('legal_info.entity.home');
Route::get('/legal_info/{entity}/{id}', [LegalInfoController::class, 'showEntity'])->whereNumber('id')->name('legal_info.entity.datas');
Route::get('/legal_info/search/{data}', [LegalInfoController::class, 'search'])->name('legal_info.search');
Route::get('/legal_info/{entity}/search/{data}', [LegalInfoController::class, 'searchEntity'])->name('legal_info.entity.search');
Route::get('/legal_info/delete/{id}', [LegalInfoController::class, 'delete'])->name('legal_info.delete');
Route::get('/legal_info/{entity}/delete/{id}', [LegalInfoController::class, 'deleteEntity'])->name('legal_info.entity.delete');
Route::post('/legal_info', [LegalInfoController::class, 'store']);
Route::post('/legal_info/{id}', [LegalInfoController::class, 'update'])->whereNumber('id');
Route::post('/legal_info/{entity}', [LegalInfoController::class, 'storeEntity']);
Route::post('/legal_info/{entity}/{id}', [LegalInfoController::class, 'updateEntity'])->whereNumber('id');
// Country
Route::get('/country', [CountryController::class, 'index'])->name('country.home');
Route::get('/country/{id}', [CountryController::class, 'show'])->whereNumber('id')->name('country.datas');
Route::get('/country/search/{data}', [CountryController::class, 'search'])->name('country.search');
Route::get('/country/delete/{id}', [CountryController::class, 'delete'])->name('country.delete');
Route::post('/country', [CountryController::class, 'store']);
Route::post('/country/{id}', [CountryController::class, 'update'])->whereNumber('id');
// Miscellaneous
Route::get('/miscellaneous', [MiscellaneousController::class, 'index'])->name('miscellaneous.home');
Route::get('/miscellaneous/{id}', [MiscellaneousController::class, 'show'])->whereNumber('id')->name('miscellaneous.datas');
Route::get('/miscellaneous/{entity}', [MiscellaneousController::class, 'indexEntity'])->name('miscellaneous.entity.home');
Route::get('/miscellaneous/{entity}/{id}', [MiscellaneousController::class, 'showEntity'])->whereNumber('id')->name('miscellaneous.entity.datas');
Route::get('/miscellaneous/search/{data}', [MiscellaneousController::class, 'search'])->name('miscellaneous.search');
Route::get('/miscellaneous/{entity}/search/{data}', [MiscellaneousController::class, 'searchEntity'])->name('miscellaneous.entity.search');
Route::get('/miscellaneous/delete/{id}', [MiscellaneousController::class, 'delete'])->name('miscellaneous.delete');
Route::get('/miscellaneous/{entity}/delete/{id}', [MiscellaneousController::class, 'deleteEntity'])->name('miscellaneous.entity.delete');
Route::post('/miscellaneous', [MiscellaneousController::class, 'store']);
Route::post('/miscellaneous/{id}', [MiscellaneousController::class, 'update'])->whereNumber('id');
Route::post('/miscellaneous/{entity}', [MiscellaneousController::class, 'storeEntity']);
Route::post('/miscellaneous/{entity}/{id}', [MiscellaneousController::class, 'updateEntity'])->whereNumber('id');

/*
|--------------------------------------------------------------------------
| ROUTES FOR "Développeur"
|--------------------------------------------------------------------------
*/
// Home
Route::get('/developer', [HomeController::class, 'developer'])->name('developer');
// API
Route::get('/apis', [APIController::class, 'index'])->name('apis.home');
Route::get('/apis/{entity}', [APIController::class, 'apisEntity'])->name('apis.entity');

/*
|--------------------------------------------------------------------------
| ROUTES FOR "Manager"
|--------------------------------------------------------------------------
*/
// Home
Route::get('/manager', [HomeController::class, 'manager'])->name('manager');
// Party
Route::get('/members', [PartyController::class, 'members'])->name('party.member.home');
Route::get('/members/{id}', [PartyController::class, 'memberDatas'])->whereNumber('id')->name('party.member.datas');
Route::get('/members/new', [PartyController::class, 'memberAdd'])->name('party.member.new');
Route::get('/members/on_going', [PartyController::class, 'memberOnGoing'])->name('party.member.on_going');
Route::get('/managers', [PartyController::class, 'managers'])->name('party.managers');
Route::get('/managers/new', [PartyController::class, 'managerAdd'])->name('party.manager.new');
Route::get('/managers/{id}', [PartyController::class, 'managerDatas'])->whereNumber('id')->name('party.manager.datas');

/*
|--------------------------------------------------------------------------
| ROUTES FOR "Membre"
|--------------------------------------------------------------------------
*/
// Home
Route::get('/news', [HomeController::class, 'news'])->name('news.home');
Route::get('/news/{id}', [HomeController::class, 'newsDatas'])->whereNumber('id')->name('news.datas');
Route::get('/communique', [HomeController::class, 'communique'])->name('communique.home');
Route::get('/communique/{id}', [HomeController::class, 'communiqueDatas'])->whereNumber('id')->name('communique.datas');
Route::get('/works', [HomeController::class, 'works'])->name('works');
Route::get('/donate', [HomeController::class, 'donate'])->name('donate');
// Account
Route::get('/send_offer/{offer_type_id}/{amount}/{currency}/{user_id}', /* [AccountController::class, 'payWithCard'] */ function ($offer_type_id, $amount, $currency, $user_id) {
    $reference_code = 'REF-' . ((string) random_int(10000000, 99999999)) . '-' . $user_id;

    return Redirect::route('account.send_offer', [
        'authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJcL2xvZ2luIiwicm9sZXMiOlsiTUVSQ0hBTlQiXSwiZXhwIjoxNzI2MTYyMjM0LCJzdWIiOiIyYmIyNjI4YzhkZTQ0ZWZjZjA1ODdmMGRmZjYzMmFjYyJ9.41n-SA4822KKo5aK14rPZv6EnKi9xJVDIMvksHG61nc',
        'merchant' => 'PROXDOC',
        'reference' => $reference_code,
        'amount' => $amount,
        'currency' => $currency,
        'description' => __('miscellaneous.bank_transaction_description'),
        'callback_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/payment/store',
        'approve_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offers/' . $offer_type_id . '/' . $amount . '/' . $user_id . '/0',
        'cancel_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offers/' . $offer_type_id . '/' . $amount . '/' . $user_id . '/1',
        'decline_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offers/' . $offer_type_id . '/' . $amount . '/' . $user_id . '/2',
    ]);

})->whereNumber(['amount', 'user_id'])->name('account.pay_with_card');
// 2. He is redirected to the page which will send a POST to FlexPay
Route::get('/send_offer', /* [AccountController::class, 'sendOffer'] */ function () {
    return view('send_offer');
})->name('account.send_offer');
// 3. FlexPay redirects it to this URL to approve, cancel or send an error
Route::get('/offers/{offer_type_id}/{amount}/{user_id}/{code}', [AccountController::class, 'offerSent'])->whereNumber(['offer_type_id', 'amount', 'user_id', 'code'])->name('account.offer_sent');
Route::get('/offers', [AccountController::class, 'offers'])->name('account.offers');

require __DIR__.'/auth.php';
