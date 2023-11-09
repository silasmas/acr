<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class PasswordResetLinkController extends Controller
{
    public static $headers;
    public static $client;

    public function __construct()
    {
        // Headers for API
        $this::$headers = [
            'Authorization' => 'Bearer uWNJB6EwpVQwSuL5oJ7S7JkSkLzdpt8M1Xrs1MZITE1bCEbjMhscv8ZX2sTiDBarCHcu1EeJSsSLZIlYjr6YCl7pLycfn2AAQmYm',
            'Accept' => 'application/json',
            'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale(),
        ];
        // Client used for accessing API
        $this::$client = new Client();
    }

    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        // Select all countries API URL
        $url_country = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/country';

        try {
            // Select all countries API response
            $response_country = $this::$client->request('GET', $url_country, [
                'headers' => $this::$headers,
                'verify' => false
            ]);
            $country = json_decode($response_country->getBody(), false);

            return view('auth.forgot-password', [
                'countries' => $country->data,
            ]);

        } catch (ClientException $e) {
            // If the API returns some error, return to the page and display its message
            return view('auth.login', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
            ]);
        }
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): View
    {
        // inputs
        $inputs = [
            'phone' => $request->phone_code . $request->phone_number
        ];
        // Password reset API URL
        $url_password_reset = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/password_reset/search_by_phone/' . $inputs['phone'];

        try {
            // Password reset API response
            $response_password_reset = $this::$client->request('GET', $url_password_reset, [
                'headers' => $this::$headers,
                'verify' => false
            ]);
            $password_reset = json_decode($response_password_reset->getBody(), false);

            return view('auth.check-token', [
                'phone' => $password_reset->data->phone,
                'password' => $password_reset->data->former_password,
                'token' => $password_reset->data->token,
                'redirect' => 'password_reset'
            ]);

        } catch (ClientException $e) {
            // If the API returns some error, return to the page and display its message
            return view('auth.forgot-password', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
            ]);
        }
    }
}
