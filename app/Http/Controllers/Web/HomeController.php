<?php

namespace App\Http\Controllers\Web;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\ClientException;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class HomeController extends Controller
{
    public static $client;

    public function __construct()
    {
        // Client used for accessing API | Use authorization key
        $this::$client = new Client();

        $this->middleware('auth')->except(['changeLanguage', 'index', 'notification', 'news', 'newsDatas', 'communique', 'works', 'donate', 'aboutUs', 'aboutParty', 'aboutApp', 'termsOfUse', 'privacyPolicy', 'help', 'faq']);
    }

    // ==================================== HTTP GET METHODS ====================================
    /**
     * GET: Change language
     *
     * @param  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLanguage($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }

    /**
     * GET: View dashboard
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (!empty(Auth::user())) {
            $headers = [
                'Authorization' => 'Bearer '. Auth::user()->api_token,
                'Accept' => 'application/json',
                'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale()
            ];
            // Select current user API URL
            $url_user = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/user/' . Auth::user()->id;
            // Select all received messages API URL
            $url_message = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/message/inbox/' . Auth::user()->id;

            try {
                // Select current user API response
                $response_user = $this::$client->request('GET', $url_user, [
                    'headers' => $headers,
                    'verify'  => false
                ]);
                $user = json_decode($response_user->getBody(), false);

                // Select all received messages API response
                $response_message = $this::$client->request('GET', $url_message, [
                    'headers' => $headers,
                    'verify'  => false
                ]);
                $messages = json_decode($response_message->getBody(), false);

                return view('home', [
                    'user' => $user,
                    'messages' => $messages,
                ]);

            } catch (ClientException $e) {
                // If Select all received API returns some error, get it,
                // return to the page and display its message
                return view('home', [
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                ]);
            }

        } else {
            // Get header informations
            $headers = [
                'Authorization' => 'Bearer uWNJB6EwpVQwSuL5oJ7S7JkSkLzdpt8M1Xrs1MZITE1bCEbjMhscv8ZX2sTiDBarCHcu1EeJSsSLZIlYjr6YCl7pLycfn2AAQmYm',
                'Accept' => 'application/json',
                'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale()
            ];
            // Select country API URL
            $url_country = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/country';

            try {
                // Select country API response
                $response_country = $this::$client->request('GET', $url_country, [
                    'headers' => $headers,
                    'verify'  => false
                ]);
                $country = json_decode($response_country->getBody(), false);

                return view('welcome', [
                    'countries' => $country->data
                ]);

            } catch (ClientException $e) {
                // If Select country API returns some error, get it,
                // return to the page and display its message
                return view('welcome', [
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                ]);
            }
        }
    }

    /**
     * Display the About page.
     *
     * @return \Illuminate\View\View
     */
    public function aboutUs()
    {
        return view('about_us');
    }

    /**
     * Display the Help page.
     *
     * @return \Illuminate\View\View
     */
    public function help()
    {
        return view('help');
    }
}
