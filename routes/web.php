<?php
/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */

use App\Http\Controllers\Web\APIController;
use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Web\ContinentController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LegalInfoController;
use App\Http\Controllers\Web\MessageController;
use App\Http\Controllers\Web\MiscellaneousController;
use App\Http\Controllers\Web\PartyController;
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
Route::get('/account/update_password', [AccountController::class, 'editPassword'])->name('account.update.password');
Route::get('/account/albums', [AccountController::class, 'account'])->name('account.albums');
Route::get('/account/albums/new', [AccountController::class, 'newAlbum'])->name('account.album.new');
Route::get('/account/albums/{id}', [AccountController::class, 'albumDatas'])->whereNumber('id')->name('account.album.datas');
Route::get('/account/albums/images/{id}', [AccountController::class, 'imageDatas'])->whereNumber('id')->name('account.album.image.datas');
Route::post('/account', [AccountController::class, 'updateAccount'])->name('account');
Route::post('/account/update_password', [AccountController::class, 'updatePassword'])->name('account.update.password');
// Notification
Route::get('/notification', [HomeController::class, 'notification'])->name('notification.home');
// Message
Route::get('/message', [MessageController::class, 'receivedMessages'])->name('message.inbox');
Route::get('/message/sent', [MessageController::class, 'sentMessages'])->name('message.outbox');
Route::get('/message/drafts', [MessageController::class, 'draftsMessages'])->name('message.draft');
Route::get('/message/spams', [MessageController::class, 'spamsMessages'])->name('message.spams');
Route::get('/message/{id}', [MessageController::class, 'showMessage'])->whereNumber('id')->name('message.datas');
Route::get('/message/new', [MessageController::class, 'newMessage'])->name('message.new');
Route::get('/message/search/{data}', [MessageController::class, 'search'])->name('message.search');
Route::get('/message/delete/{id}', [MessageController::class, 'deleteMessage'])->name('message.delete');
Route::post('/message/create', [MessageController::class, 'storeMessage'])->name('message.create');
Route::post('/message/{id}', [MessageController::class, 'updateMessage'])->whereNumber('id')->name('message.datas');

/*
|--------------------------------------------------------------------------
| ROUTES FOR EVERY ROLES EXCEPT "Super administrateur" AND "Développeur"
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
Route::post('/legal_info', [LegalInfoController::class, 'store'])->name('legal_info.home');
Route::post('/legal_info/{id}', [LegalInfoController::class, 'update'])->whereNumber('id')->name('legal_info.datas');
Route::post('/legal_info/{entity}', [LegalInfoController::class, 'storeEntity'])->name('legal_info.entity.home');
Route::post('/legal_info/{entity}/{id}', [LegalInfoController::class, 'updateEntity'])->whereNumber('id')->name('legal_info.entity.datas');
// Continent
Route::get('/continent', [ContinentController::class, 'index'])->name('continent.home');
Route::get('/continent/{id}', [ContinentController::class, 'show'])->whereNumber('id')->name('continent.datas');
Route::get('/continent/{entity}', [ContinentController::class, 'indexEntity'])->name('continent.entity.home');
Route::get('/continent/{entity}/{id}', [ContinentController::class, 'showEntity'])->whereNumber('id')->name('continent.entity.datas');
Route::get('/continent/search/{data}', [ContinentController::class, 'search'])->name('continent.search');
Route::get('/continent/{entity}/search/{data}', [ContinentController::class, 'searchEntity'])->name('continent.entity.search');
Route::get('/continent/delete/{id}', [ContinentController::class, 'delete'])->name('continent.delete');
Route::get('/continent/{entity}/delete/{id}', [ContinentController::class, 'deleteEntity'])->name('continent.entity.delete');
Route::post('/continent', [ContinentController::class, 'store'])->name('continent.home');
Route::post('/continent/{id}', [ContinentController::class, 'update'])->whereNumber('id')->name('continent.datas');
Route::post('/continent/{entity}', [ContinentController::class, 'storeEntity'])->name('continent.entity.home');
Route::post('/continent/{entity}/{id}', [ContinentController::class, 'updateEntity'])->whereNumber('id')->name('continent.entity.datas');
// Miscellaneous
Route::get('/miscellaneous', [MiscellaneousController::class, 'index'])->name('miscellaneous.home');
Route::get('/miscellaneous/{id}', [MiscellaneousController::class, 'show'])->whereNumber('id')->name('miscellaneous.datas');
Route::get('/miscellaneous/{entity}', [MiscellaneousController::class, 'indexEntity'])->name('miscellaneous.entity.home');
Route::get('/miscellaneous/{entity}/{id}', [MiscellaneousController::class, 'showEntity'])->whereNumber('id')->name('miscellaneous.entity.datas');
Route::get('/miscellaneous/search/{data}', [MiscellaneousController::class, 'search'])->name('miscellaneous.search');
Route::get('/miscellaneous/{entity}/search/{data}', [MiscellaneousController::class, 'searchEntity'])->name('miscellaneous.entity.search');
Route::get('/miscellaneous/delete/{id}', [MiscellaneousController::class, 'delete'])->name('miscellaneous.delete');
Route::get('/miscellaneous/{entity}/delete/{id}', [MiscellaneousController::class, 'deleteEntity'])->name('miscellaneous.entity.delete');
Route::post('/miscellaneous', [MiscellaneousController::class, 'store'])->name('miscellaneous.home');
Route::post('/miscellaneous/{id}', [MiscellaneousController::class, 'update'])->whereNumber('id')->name('miscellaneous.datas');
Route::post('/miscellaneous/{entity}', [MiscellaneousController::class, 'storeEntity'])->name('miscellaneous.entity.home');
Route::post('/miscellaneous/{entity}/{id}', [MiscellaneousController::class, 'updateEntity'])->whereNumber('id')->name('miscellaneous.entity.datas');

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

require __DIR__.'/auth.php';
