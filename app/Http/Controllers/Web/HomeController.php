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
    public static $headers;
    public static $client;

    public function __construct()
    {
        // Headers for API
        $this::$headers = [
            'Authorization' => 'Bearer uWNJB6EwpVQwSuL5oJ7S7JkSkLzdpt8M1Xrs1MZITE1bCEbjMhscv8ZX2sTiDBarCHcu1EeJSsSLZIlYjr6YCl7pLycfn2AAQmYm',
            'Accept' => 'application/json',
            'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale()
        ];
        // Client used for accessing API
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
            // Select current user API URL
            $url_user = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/user/' . Auth::user()->id;
            // Select all countries API URL
            $url_country = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/country';
            // Select all received messages API URL
            $url_message = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/message/inbox/' . Auth::user()->id;
            // Select types by group name API URL
            $offer_type_group = 'Type d\'offre';
            $transaction_type_group = 'Type de transaction';
            $url_offer_type = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/type/find_by_group/' . $offer_type_group;
            $url_transaction_type = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/type/find_by_group/' . $transaction_type_group;

            try {
                // Select current user API response
                $response_user = $this::$client->request('GET', $url_user, [
                    'headers' => $this::$headers,
                    'verify'  => false
                ]);
                $user = json_decode($response_user->getBody(), false);
                // Select countries API response
                $response_country = $this::$client->request('GET', $url_country, [
                    'headers' => $this::$headers,
                    'verify'  => false
                ]);
                $country = json_decode($response_country->getBody(), false);
                // Select all received messages API response
                $response_message = $this::$client->request('GET', $url_message, [
                    'headers' => $this::$headers,
                    'verify'  => false
                ]);
                $messages = json_decode($response_message->getBody(), false);
                // Select types by group name API response
                $response_offer_type = $this::$client->request('GET', $url_offer_type, [
                    'headers' => $this::$headers,
                    'verify'  => false
                ]);
                $offer_type = json_decode($response_offer_type->getBody(), false);
                $response_transaction_type = $this::$client->request('GET', $url_transaction_type, [
                    'headers' => $this::$headers,
                    'verify'  => false
                ]);
                $transaction_type = json_decode($response_transaction_type->getBody(), false);

                if (isset(request()->user_role)) {
                    if (request()->user_role == 'admin') {
                        return view('dashboard', [
                            'current_user' => $user->data,
                            'countries' => $country->data,
                            'messages' => $messages,
                            'offer_types' => $offer_type->data,
                            'transaction_types' => $transaction_type->data
                        ]);

                    } else if (request()->user_role == 'developer') {
                        return view('dashboard', [
                            'current_user' => $user->data,
                            'countries' => $country->data,
                            'messages' => $messages,
                            'offer_types' => $offer_type->data,
                            'transaction_types' => $transaction_type->data
                        ]);

                    } else if (request()->user_role == 'manager') {
                        return view('dashboard', [
                            'current_user' => $user->data,
                            'countries' => $country->data,
                            'messages' => $messages,
                            'offer_types' => $offer_type->data,
                            'transaction_types' => $transaction_type->data
                        ]);

                    } else {
                        return view('welcome', [
                            'current_user' => $user->data,
                            'countries' => $country->data,
                            'messages' => $messages,
                            'offer_types' => $offer_type->data,
                            'transaction_types' => $transaction_type->data
                        ]);
                    }

                } else {
                    return view('welcome', [
                        'current_user' => $user->data,
                        'countries' => $country->data,
                        'messages' => $messages,
                        'offer_types' => $offer_type->data,
                        'transaction_types' => $transaction_type->data
                ]);
                }

            } catch (ClientException $e) {
                // If the API returns some error, return to the page and display its message
                return view('welcome', [
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                ]);
            }

        } else {
            // Select all countries API URL
            $url_country = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/country';
            // Select types by group name API URL
            $offer_type_group = 'Type d\'offre';
            $transaction_type_group = 'Type de transaction';
            $url_offer_type = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/type/find_by_group/' . $offer_type_group;
            $url_transaction_type = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/type/find_by_group/' . $transaction_type_group;

            try {
                // Select all countries API response
                $response_country = $this::$client->request('GET', $url_country, [
                    'headers' => $this::$headers,
                    'verify'  => false
                ]);
                $country = json_decode($response_country->getBody(), false);
                // Select types by group name API response
                $response_offer_type = $this::$client->request('GET', $url_offer_type, [
                    'headers' => $this::$headers,
                    'verify'  => false
                ]);
                $offer_type = json_decode($response_offer_type->getBody(), false);
                $response_transaction_type = $this::$client->request('GET', $url_transaction_type, [
                    'headers' => $this::$headers,
                    'verify'  => false
                ]);
                $transaction_type = json_decode($response_transaction_type->getBody(), false);

                return view('welcome', [
                    'countries' => $country->data,
                    'offer_types' => $offer_type->data,
                    'transaction_types' => $transaction_type->data
                ]);

            } catch (ClientException $e) {
                // If the API returns some error, return to the page and display its message
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
    public function dashboard()
    {
        // Select current user API URL
        $url_user = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/user/' . Auth::user()->id;
        // Select all received messages API URL
        $url_message = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/message/inbox/' . Auth::user()->id;

        try {
            // Select current user API response
            $response_user = $this::$client->request('GET', $url_user, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $user = json_decode($response_user->getBody(), false);

            // Select all received messages API response
            $response_message = $this::$client->request('GET', $url_message, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $messages = json_decode($response_message->getBody(), false);

            return view('dashboard', [
                'current_user' => $user->data,
                'messages' => $messages,
            ]);

        } catch (ClientException $e) {
            // If the API returns some error, return to the page and display its message
            return view('welcome', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
            ]);
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
