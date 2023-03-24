<?php

namespace App\Http\Controllers\Auth;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use GuzzleHttp\Exception\ClientException;

class RegisteredUserController extends Controller
{
    public static $headers;
    public static $client;

    public function __construct()
    {
        // Headers for API
        $this::$headers = [
            'Authorization' => 'Bearer '. getToken(),
            'Accept' => 'application/json',
            'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale()
        ];
        // Client used for accessing API
        $this::$client = new Client();
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Select country API URL
        $url_country = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/country';

        try {
            // Select country API response
            $response_country = $this::$client->request('GET', $url_country, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $country = json_decode($response_country->getBody(), false);

            return view('auth.register', [
                'countries' => $country->data
            ]);

        } catch (ClientException $e) {
            // If Select country API returns some error, get it,
            // return to the page and display its message
            return view('auth.register', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
            ]);
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $inputs = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        return redirect(RouteServiceProvider::HOME);
    }
}
