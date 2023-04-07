<?php

namespace App\Http\Controllers\Web;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\ClientException;
use App\Http\Controllers\API\BaseController;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class AccountController extends Controller
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
        // Select user API URL
        $current_user_id = isset(request()->user_id) ? request()->user_id : Auth::user()->id;
        $url_user = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/user/' . $current_user_id;
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
            // Select user API response
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

            if ($user->data->role_user->role->role_name != 'Administrateur' AND $user->data->role_user->role->role_name != 'Développeur' AND $user->data->role_user->role->role_name != 'Manager') {
                return view('account', [
                    'current_user' => $user->data,
                    'countries' => $country->data,
                    'messages' => $messages,
                    'offer_types' => $offer_type->data,
                    'transaction_types' => $transaction_type->data
                ]);

            } else {
                return view('dashboard.account', [
                    'current_user' => $user->data,
                    'countries' => $country->data,
                    'messages' => $messages,
                    'offer_types' => $offer_type->data,
                    'transaction_types' => $transaction_type->data
                ]);
            }

        } catch (ClientException $e) {
            // If the API returns some error, return to the page and display its message
            if ($user->data->role_user->role->role_name != 'Administrateur' AND $user->data->role_user->role->role_name != 'Développeur' AND $user->data->role_user->role->role_name != 'Manager') {
                return view('dashboard.account', [
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                ]);

            } else {
                return view('account', [
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                ]);
            }
        }
    }

    /**
     * GET: Current user account
     *
     * @return \Illuminate\View\View
     */
    public function offers()
    {
        // Select user API URL
        $current_user_id = isset(request()->user_id) ? request()->user_id : Auth::user()->id;
        $url_user = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/user/' . $current_user_id;
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
            // Select user API response
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

            if ($user->data->role_user->role->role_name != 'Administrateur' AND $user->data->role_user->role->role_name != 'Développeur' AND $user->data->role_user->role->role_name != 'Manager') {
                return view('account', [
                    'current_user' => $user->data,
                    'countries' => $country->data,
                    'messages' => $messages,
                    'offer_types' => $offer_type->data,
                    'transaction_types' => $transaction_type->data
                ]);

            } else {
                return view('dashboard.account', [
                    'current_user' => $user->data,
                    'countries' => $country->data,
                    'messages' => $messages,
                    'offer_types' => $offer_type->data,
                    'transaction_types' => $transaction_type->data
                ]);
            }

        } catch (ClientException $e) {
            if ($user->data->role_user->role->role_name != 'Administrateur' AND $user->data->role_user->role->role_name != 'Développeur' AND $user->data->role_user->role->role_name != 'Manager') {
                return view('account', [
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                ]);

            } else {
                return view('dashboard.account', [
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                ]);
            }
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
    public function offerSent($amount, $currency, $code)
    {
        // Register offer API URL
        $url_offer = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/offer/store';
        // Status name to find
        $unread_status = 'Non lue';
        // Search status by name API URL
        $url_status = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/status/search/' . $unread_status;
        // Register notification API URL
        $url_notification = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/notification/store';
        // Select user API URL
        $url_user = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/user/' . request()->user_id;
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
            // Search status by name API response
            $response_status = $this::$client->request('GET', $url_status, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $status = json_decode($response_status->getBody(), false);
            // Select user API response
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

            if ($code == '0') {
                try {
                    // Register offer API response
                    $this::$client->request('POST', $url_offer, [
                        'headers' => $this::$headers,
                        'form_params' => [
                            'amount' => $amount,
                            'currency' => $currency,
                            'type_id' => 8,
                            'user_id' => request()->user_id
                        ],
                        'verify'  => false
                    ]);
                    // Register notification API response
                    $this::$client->request('POST', $url_notification, [
                        'headers' => $this::$headers,
                        'form_params' => [
                            'notification_url' => 'account/offers',
                            'notification_content' => __('notifications.processing_succeed'),
                            'status_id' => $status->data->id,
                            'user_id' => request()->user_id
                        ],
                        'verify'  => false
                    ]);

                    if ($user->data->role_user->role->role_name != 'Administrateur' AND $user->data->role_user->role->role_name != 'Développeur' AND $user->data->role_user->role->role_name != 'Manager') {
                        return view('account', [
                            'current_user' => $user->data,
                            'countries' => $country->data,
                            'messages' => $messages,
                            'offer_types' => $offer_type->data,
                            'transaction_types' => $transaction_type->data
                        ]);

                    } else {
                        return view('dashboard.account', [
                            'current_user' => $user->data,
                            'countries' => $country->data,
                            'messages' => $messages,
                            'offer_types' => $offer_type->data,
                            'transaction_types' => $transaction_type->data
                        ]);
                    }

                } catch (ClientException $e) {
                    // If the API returns some error, return to the page and display its message
                    if ($user->data->role_user->role->role_name != 'Administrateur' AND $user->data->role_user->role->role_name != 'Développeur' AND $user->data->role_user->role->role_name != 'Manager') {
                        return view('account', [
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                        ]);

                    } else {
                        return view('dashboard.account', [
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                        ]);
                    }
                }
            }

            if ($code == '1') {
                try {
                    // Register notification API response
                    $this::$client->request('POST', $url_notification, [
                        'headers' => $this::$headers,
                        'form_params' => [
                            'notification_url' => 'account/offers',
                            'notification_content' => __('notifications.process_canceled'),
                            'status_id' => $status->data->id,
                            'user_id' => request()->user_id
                        ],
                        'verify'  => false
                    ]);

                    if ($user->data->role_user->role->role_name != 'Administrateur' AND $user->data->role_user->role->role_name != 'Développeur' AND $user->data->role_user->role->role_name != 'Manager') {
                        return view('account', [
                            'current_user' => $user->data,
                            'countries' => $country->data,
                            'messages' => $messages,
                            'offer_types' => $offer_type->data,
                            'transaction_types' => $transaction_type->data
                        ]);

                    } else {
                        return view('dashboard.account', [
                            'current_user' => $user->data,
                            'countries' => $country->data,
                            'messages' => $messages,
                            'offer_types' => $offer_type->data,
                            'transaction_types' => $transaction_type->data
                        ]);
                    }

                } catch (ClientException $e) {
                    // If the API returns some error, return to the page and display its message
                    if ($user->data->role_user->role->role_name != 'Administrateur' AND $user->data->role_user->role->role_name != 'Développeur' AND $user->data->role_user->role->role_name != 'Manager') {
                        return view('account', [
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                        ]);

                    } else {
                        return view('dashboard.account', [
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                        ]);
                    }
                }
            }

            if ($code == '2') {
                try {
                    // Register offer API response
                    $this::$client->request('POST', $url_offer, [
                        'headers' => $this::$headers,
                        'form_params' => [
                            'amount' => $amount,
                            'currency' => $currency,
                            'type_id' => 8,
                            'user_id' => request()->user_id
                        ],
                        'verify'  => false
                    ]);
                    // Register notification API response
                    $this::$client->request('POST', $url_notification, [
                        'headers' => $this::$headers,
                        'form_params' => [
                            'notification_url' => 'account/offers',
                            'notification_content' => __('notifications.process_failed'),
                            'status_id' => $status->data->id,
                            'user_id' => request()->user_id
                        ],
                        'verify'  => false
                    ]);

                    if ($user->data->role_user->role->role_name != 'Administrateur' AND $user->data->role_user->role->role_name != 'Développeur' AND $user->data->role_user->role->role_name != 'Manager') {
                        return view('account', [
                            'current_user' => $user->data,
                            'countries' => $country->data,
                            'messages' => $messages,
                            'offer_types' => $offer_type->data,
                            'transaction_types' => $transaction_type->data
                        ]);

                    } else {
                        return view('dashboard.account', [
                            'current_user' => $user->data,
                            'countries' => $country->data,
                            'messages' => $messages,
                            'offer_types' => $offer_type->data,
                            'transaction_types' => $transaction_type->data
                        ]);
                    }

                } catch (ClientException $e) {
                    // If the API returns some error, return to the page and display its message
                    if ($user->data->role_user->role->role_name != 'Administrateur' AND $user->data->role_user->role->role_name != 'Développeur' AND $user->data->role_user->role->role_name != 'Manager') {
                        return view('account', [
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                        ]);

                    } else {
                        return view('dashboard.account', [
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
                        ]);
                    }
                }
            }

        } catch (ClientException $e) {
            // If the API returns some error, return to the page and display its message
            if ($user->data->role_user->role->role_name != 'Administrateur' AND $user->data->role_user->role->role_name != 'Développeur' AND $user->data->role_user->role->role_name != 'Manager') {
                return view('account', [
                    'current_user' => $user->data
                ]);

            } else {
                return view('dashboard.account', [
                    'current_user' => $user->data
                ]);
            }
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
        // $gateway = 'https://beta-cardpayment.flexpay.cd/v1.1/pay';
        $gateway = 'https://cardpayment.flexpay.cd/v1.1/pay';

        try {
            // Create response by sending request to FlexPay
            $response = $this::$client->request('POST', $gateway, [
                'headers' => array(
                    'Accept' => 'application/json'
                ),
                'json' => array(
                    // 'authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJcL2xvZ2luIiwicm9sZXMiOlsiTUVSQ0hBTlQiXSwiZXhwIjoxNzI2MTYyMjM0LCJzdWIiOiIyYmIyNjI4YzhkZTQ0ZWZjZjA1ODdmMGRmZjYzMmFjYyJ9.41n-SA4822KKo5aK14rPZv6EnKi9xJVDIMvksHG61nc',
                    'authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJcL2xvZ2luIiwicm9sZXMiOlsiTUVSQ0hBTlQiXSwiZXhwIjoxNzI2MTYxOTIzLCJzdWIiOiIyYzM2NzZkNDhkNGY4OTBhMGNiZjg4YmVjOTc1OTkyNyJ9.N7BBGQ2hNEeL_Q3gkvbyIQxcq71KtC_b0a4WsTKaMT8',
                    'merchant' => 'PROXDOC',
                    'reference' => $reference_code,
                    'amount' => $amount,
                    'currency' => $currency,
                    'description' => __('miscellaneous.bank_transaction_description'),
                    'callback_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/payment/store',
                    'approve_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offer_sent/' . $amount . '/' . $currency . '/0/?user_id=' . $user_id,
                    'cancel_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offer_sent/' . $amount . '/' . $currency . '/1/?user_id=' . $user_id,
                    'decline_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offer_sent/' . $amount . '/' . $currency . '/2/?user_id=' . $user_id,
                ),
                'verify'  => false
            ]);
            $payment = json_decode($response->getBody(), false);

            return redirect($payment->url);

        } catch (ClientException $e) {
            $baseController = new BaseController();
            $response_error = json_decode($e->getResponse()->getBody()->getContents(), false);

            return $baseController->handleError($response_error, __('notifications.error_while_processing'));
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
