<?php

namespace App\Http\Controllers\Web;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Exception\ClientException;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class AccountController extends Controller
{
    public static $client;

    public function __construct()
    {
        // Client used for accessing API | Use authorization key
        $this::$client = new Client();

        $this->middleware('auth')->except(['offerSent', 'payWithCard']);
    }

    // ==================================== HTTP GET METHODS ====================================
    /**
     * GET: Current user account
     *
     * @return \Illuminate\View\View
     */
    public function account()
    {
        // Get header informations
        $headers = [
            'Accept' => 'application/json',
            'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale()
        ];
        // Select user API URL
        $url_user = '/api/user/' . Auth::user()->id;

        try {
            // Select user API response
            $response_user = $this::$client->request('GET', $url_user, [
                'headers' => $headers,
                'verify'  => false
            ]);
            $user = json_decode($response_user->getBody(), false);

            return view('account', [
                'selected_user' => $user
            ]);

        } catch (ClientException $e) {
            // If Select user API returns some error, get it,
            // return to the page and display its message
            return view('account', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
            ]);
        }
    }

    /**
     * GET: Current user account
     *
     * @return \Illuminate\View\View
     */
    public function offers()
    {
        // Get header informations
        $headers = [
            'Accept' => 'application/json',
            'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale()
        ];
        // Select user API URL
        $url_user = '/api/user/' . Auth::user()->id;

        try {
            // Select user API response
            $response_user = $this::$client->request('GET', $url_user, [
                'headers' => $headers,
                'verify'  => false
            ]);
            $user = json_decode($response_user->getBody(), false);

            return view('account', [
                'selected_user' => $user,
                'offers' => $user->data->offers
            ]);

        } catch (ClientException $e) {
            // If Select user API returns some error, get it,
            // return to the page and display its message
            return view('account', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
            ]);
        }
    }

    /**
     * GET: Current user account
     *
     * @param $amount
     * @param $user_id
     * @param $code
     * @return \Illuminate\View\View
     */
    public function offerSent($amount, $user_id, $code)
    {
        // Get header informations
        $headers = [
            'Accept' => 'application/json',
            // 'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale()
        ];
        // Register offer API URL
        $url_offer = '/api/offer/store';
        // Status name to find
        $unread_status = 'Non lue';
        // Search status by name API URL
        $url_status = '/api/status/search/' . $unread_status;
        // Register notification API URL
        $url_notification = '/api/notification/store';
        // Select user API URL
        // $url_user = '/api/user/' . Auth::user()->id;

        try {
            // Search status by name API response
            $response_status = $this::$client->request('GET', $url_status, [
                'headers' => $headers,
                'verify'  => false
            ]);
            $status = json_decode($response_status->getBody(), false);
            // Select user API response
            // $response_user = $this::$client->request('GET', $url_user, [
            //     'headers' => $headers,
            //     'verify'  => false
            // ]);
            // $user = json_decode($response_user->getBody(), false);

            if ($code == '0') {
                try {
                    // Register offer API response
                    $this::$client->request('POST', $url_offer, [
                        'headers' => $headers,
                        'form_params' => [
                            'amount' => $amount,
                            'type_id' => 8,
                            'user_id' => $user_id
                        ],
                        'verify'  => false
                    ]);
                    // Register notification API response
                    $this::$client->request('POST', $url_notification, [
                        'headers' => $headers,
                        'form_params' => [
                            'notification_url' => 'account/offers',
                            'notification_content' => __('notifications.processing_succeed'),
                            'status_id' => $status->data->id,
                            'user_id' => $user_id
                        ],
                        'verify'  => false
                    ]);

                    return view('account'/*, [
                        'selected_user' => $user,
                        'offers' => $user->data->offers
                    ]*/);

                } catch (ClientException $e) {
                    // If Select user API returns some error, get it,
                    // return to the account page and display its message
                    return view('account', [
                        'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                    ]);
                }
            }

            if ($code == '1') {
                try {
                    // Register notification API response
                    $this::$client->request('POST', $url_notification, [
                        'headers' => $headers,
                        'form_params' => [
                            'notification_url' => 'account/offers',
                            'notification_content' => __('notifications.process_canceled'),
                            'status_id' => $status->data->id,
                            'user_id' => $user_id
                        ],
                        'verify'  => false
                    ]);

                    return view('account'/*, [
                        'selected_user' => $user,
                        'offers' => $user->data->offers
                    ]*/);

                } catch (ClientException $e) {
                    // If Select user API returns some error, get it,
                    // return to the account page and display its message
                    return view('account', [
                        'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                    ]);
                }
            }

            if ($code == '2') {
                try {
                    // Register offer API response
                    $this::$client->request('POST', $url_offer, [
                        'headers' => $headers,
                        'form_params' => [
                            'amount' => $amount,
                            'type_id' => 8,
                            'user_id' => $user_id
                        ],
                        'verify'  => false
                    ]);
                    // Register notification API response
                    $this::$client->request('POST', $url_notification, [
                        'headers' => $headers,
                        'form_params' => [
                            'notification_url' => 'account/offers',
                            'notification_content' => __('notifications.process_failed'),
                            'status_id' => $status->data->id,
                            'user_id' => $user_id
                        ],
                        'verify'  => false
                    ]);

                    return view('account', /*[
                        'selected_user' => $user,
                        'offers' => $user->data->offers
                    ]*/);

                } catch (ClientException $e) {
                    // If Select user API returns some error, get it,
                    // return to the account page and display its message
                    return view('account', [
                        'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                    ]);
                }
            }

        } catch (ClientException $e) {
            // If Select user API returns some error, get it,
            // return to the page and display its message
            return view('account', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
            ]);
        }
    }

    /**
     * GET: Run payment by bank card
     *
     * @param $amount
     * @param $currency
     * @param $user_id
     * @return \Illuminate\View\View
     */
    public function payWithCard($amount, $currency, $user_id)
    {
        $reference_code = 'REF-' . ((string) random_int(10000000, 99999999)) . '-' . $user_id;
        $gateway = 'https://beta-cardpayment.flexpay.cd/v1.1/pay';

        try {
            // Create response by sending request to FlexPay
            $response = $this::$client->request('POST', $gateway, [
                'headers' => array(
                    'Accept' => 'application/json'
                ),
                'json' => array(
                    'authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJcL2xvZ2luIiwicm9sZXMiOlsiTUVSQ0hBTlQiXSwiZXhwIjoxNzI2MTYyMjM0LCJzdWIiOiIyYmIyNjI4YzhkZTQ0ZWZjZjA1ODdmMGRmZjYzMmFjYyJ9.41n-SA4822KKo5aK14rPZv6EnKi9xJVDIMvksHG61nc',
                    'merchant' => 'PROXDOC',
                    'reference' => $reference_code,
                    'amount' => $amount,
                    'currency' => $currency,
                    'description' => __('miscellaneous.bank_transaction_description'),
                    'callback_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/payment/store',
                    'approve_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offer_sent/' . $amount . '/' . $user_id . '/0',
                    'cancel_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offer_sent/' . $amount . '/' . $user_id . '/1',
                    'decline_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offer_sent/' . $amount . '/' . $user_id . '/2',
                ),
                'verify'  => false
            ]);
            $payment = json_decode($response->getBody(), false);

            return redirect($payment->url);

        } catch (ClientException $e) {
            $response_error = json_decode($e->getResponse()->getBody()->getContents(), false);

            return $this->handleError($response_error, __('notifications.error_while_processing'));
        }
    }

    /**
     * GET: View "update password" form
     *
     * @return \Illuminate\View\View
     */
    public function editPassword()
    {
        return view('account');
    }

    // ==================================== HTTP POST METHODS ====================================
    /**
     * POST: Authentication and authorization
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function updateAccount(Request $request)
    {
    }

    /**
     * POST: Update password
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function updatePassword(Request $request)
    {
    }
}
