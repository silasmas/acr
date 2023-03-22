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

        $this->middleware('auth');
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
            'Authorization' => 'Bearer '. $_COOKIE['acr-devref'],
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
            // return to the account page and display its message
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
            'Authorization' => 'Bearer '. $_COOKIE['acr-devref'],
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
            // return to the account page and display its message
            return view('account', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
            ]);
        }
    }

    /**
     * GET: Current user account
     *
     * @param $user_id
     * @param $code
     * @return \Illuminate\View\View
     */
    public function offerSent($offer_type_id, $amount, $user_id, $code)
    {
        // Get header informations
        $headers = [
            'Authorization' => 'Bearer '. $_COOKIE['acr-devref'],
            'Accept' => 'application/json',
            'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale()
        ];
        // Register offer API URL
        $url_offer = '/api/offer';
        // Status name to find
        $unread_status = 'Non lue';
        // Search status by name API URL
        $url_status = '/api/status/search/' . $unread_status;
        // Register notification API URL
        $url_notification = '/api/notification';
        // Select user API URL
        $url_user = '/api/user/' . Auth::user()->id;

        try {
            // Search status by name API response
            $response_status = $this::$client->request('GET', $url_status, [
                'headers' => $headers,
                'verify'  => false
            ]);
            $status = json_decode($response_status->getBody(), false);
            // Select user API response
            $response_user = $this::$client->request('GET', $url_user, [
                'headers' => $headers,
                'verify'  => false
            ]);
            $user = json_decode($response_user->getBody(), false);

            if ($code == '0') {
                try {
                    // Register offer API response
                    $this::$client->request('POST', $url_offer, [
                        'headers' => $headers,
                        'form_params' => [
                            'amount' => $amount,
                            'type_id' => $offer_type_id,
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

                    return view('account', [
                        'selected_user' => $user,
                        'offers' => $user->data->offers
                    ]);

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

                    return view('account', [
                        'selected_user' => $user,
                        'offers' => $user->data->offers
                    ]);

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

                    return view('account', [
                        'selected_user' => $user,
                        'offers' => $user->data->offers
                    ]);

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
            // return to the account page and display its message
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
    public function payWithCard($offer_type_id, $amount, $currency, $user_id)
    {
        $reference_code = 'REF-' . ((string) random_int(10000000, 99999999)) . '-' . $user_id;
        $gateway = 'https://cardpayment.flexpay.cd/v2/pay';

        try {
            // Create response by sending request to FlexPay
            $response = $this::$client->request('POST', $gateway, [
                'headers' => array(
                    'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJcL2xvZ2luIiwicm9sZXMiOlsiTUVSQ0hBTlQiXSwiZXhwIjoxNzI2MTYyMjM0LCJzdWIiOiIyYmIyNjI4YzhkZTQ0ZWZjZjA1ODdmMGRmZjYzMmFjYyJ9.41n-SA4822KKo5aK14rPZv6EnKi9xJVDIMvksHG61nc',
                    'Accept' => 'application/json'
                ),
                'json' => array(
                    'merchant' => 'PROXDOC',
                    'reference' => $reference_code,
                    'amount' => $amount,
                    'currency' => $currency,
                    'description' => __('miscellaneous.bank_transaction_description'),
                    'callback_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/payment/store',
                    'approve_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offers/' . $offer_type_id . '/' . $amount . '/' . $user_id . '/0',
                    'cancel_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offers/' . $offer_type_id . '/' . $amount . '/' . $user_id . '/1',
                    'decline_url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/account/offers/' . $offer_type_id . '/' . $amount . '/' . $user_id . '/2',
                ),
                'verify'  => false
            ]);
            $payment = json_decode($response->getBody(), false);

            return Redirect::action($gateway, [
                'code' => $payment->code,
                'message' => $payment->message,
                'code' => $payment->code,
                'orderNumber' => $payment->orderNumber,
                'url' => $payment->url,
            ]);

        } catch (ClientException $e) {
            $response_error = json_decode($e->getResponse()->getBody()->getContents(), false);

            return $this->handleError($response_error, __('notifications.error_while_processing'));
        }
    }

    /**
     * GET: View "send_offer" form
     *
     * @return \Illuminate\View\View
     */
    public function sendOffer()
    {
        return view('send_offer');
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
        // Get form datas
        $inputs = [
            'id' => $request->user_id,
            'firstname' => $request->register_firstname,
            'lastname' => $request->register_lastname,
            'surname' => $request->register_surname,
            'gender' => $request->register_gender,
            'email' => $request->register_email,
            'status_id' => $request->status_id,
            'roles_ids' => $request->roles,
            'phone_code' => $request->phone_code,
            'phone' => $request->phone,
            'service_id' => $request->service_id
        ];
        // Get header informations
        $headers = [
            'Authorization' => 'Bearer '. Auth::user()->api_token,
            'Accept' => 'application/json',
            'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale()
        ];
        // Update user API URL
        $url = '/api/user/' . $inputs['id'];
        // FIND THE SERVICE TO ASSOCIATE WITH THE PHONE NUMBER
        $phone_service_group = 'Service téléphonique';
        $service_mpesa = 'M-Pesa';
        $service_orangemoney = 'Orange money';
        $service_airtelmoney = 'Airtel money';
        $service_afrimoney = 'Afrimoney';
        // Select service by name with group API URL
        $url_service_mpesa = '/api/service/search_with_group/' . $phone_service_group . '/' . $service_mpesa;
        $url_service_orangemoney = '/api/service/search_with_group/' . $phone_service_group . '/' . $service_orangemoney;
        $url_service_airtelmoney = '/api/service/search_with_group/' . $phone_service_group . '/' . $service_airtelmoney;
        $url_service_afrimoney = '/api/service/search_with_group/' . $phone_service_group . '/' . $service_afrimoney;

        // DEFINE THE SERVICE BY REFERRING TO THE PHONE NUMBER
        // - - - - - - - - - M-PESA
        if (substr($inputs['phone'], 0, 3) == '081' OR substr($inputs['phone'], 0, 3) == '082') {
            try {
                // Select service by name with group API response
                $response_service_mpesa = $this::$client->request('GET', $url_service_mpesa, [
                    'headers' => $headers,
                    'form_params' => $inputs,
                    'verify'  => false
                ]);
                $service_mpesa = json_decode($response_service_mpesa->getBody(), false);

                if ($service_mpesa->data != null) {
                    // Change service ID
                    $inputs['service_id'] = $service_mpesa->data->id;

                    try {
                        // Update user API response
                        $response = $this::$client->request('PUT', $url, [
                            'headers' => $headers,
                            'form_params' => $inputs,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'updated_account_message' => $user->message
                        ]);

                    } catch (ClientException $e) {
                        // If API returns some error, get it,
                        // return to the update_account page and display its message
                        $response = $this::$client->request('GET', $url, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                            'inputs' => $inputs
                        ]);
                    }

                } else {
                    // Find group by its name API URL
                    $url_groups = '/api/group/search/' . $phone_service_group;

                    try {
                        // Find group by its name API response
                        $response_groups = $this::$client->request('GET', $url_groups, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $groups = json_decode($response_groups->getBody(), false);

                        foreach ($groups->data as $group):
                            // Create service API URL
                            $url_service_mpesa = '/api/service';

                            try {
                                // Find group by its name API response
                                $response_service_mpesa = $this::$client->request('POST', $url_service_mpesa, [
                                    'headers' => $headers,
                                    'form_params' => [
                                        'service_name' => 'M-Pesa',
                                        'provider' => 'Vodacom',
                                        'group_id' => $group->id
                                    ],
                                    'verify'  => false
                                ]);
                                $service_mpesa = json_decode($response_service_mpesa->getBody(), false);

                                // Change service ID
                                $inputs['service_id'] = $service_mpesa->data->id;

                                try {
                                    // Update user API response
                                    $response = $this::$client->request('PUT', $url, [
                                        'headers' => $headers,
                                        'form_params' => $inputs,
                                        'verify'  => false
                                    ]);
                                    $user = json_decode($response->getBody(), false);

                                    return view('account', [
                                        'user' => $user,
                                        'updated_account_message' => $user->message
                                    ]);

                                } catch (ClientException $e) {
                                    // If API returns some error, get it,
                                    // return to the update_account page and display its message
                                    $response = $this::$client->request('GET', $url, [
                                        'headers' => $headers,
                                        'verify'  => false
                                    ]);
                                    $user = json_decode($response->getBody(), false);

                                    return view('account', [
                                        'user' => $user,
                                        'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                                        'inputs' => $inputs
                                    ]);
                                }

                            } catch (ClientException $e) {
                                // If API returns some error, get it,
                                // return to the update_account page and display its message
                                $response = $this::$client->request('GET', $url, [
                                    'headers' => $headers,
                                    'verify'  => false
                                ]);
                                $user = json_decode($response->getBody(), false);

                                return view('account', [
                                    'user' => $user,
                                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                                    'inputs' => $inputs
                                ]);
                            }
                        endforeach;

                    } catch (ClientException $e) {
                        // If API returns some error, get it,
                        // return to the update_account page and display its message
                        $response = $this::$client->request('GET', $url, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                            'inputs' => $inputs
                        ]);
                    }
                }

            } catch (ClientException $e) {
                // If API returns some error, get it,
                // return to the update_account page and display its message
                return view('account', [
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                ]);
            }

        // - - - - - - - - - ORANGE MONEY
        } else if (substr($inputs['phone'], 0, 3) == '080' OR substr($inputs['phone'], 0, 3) == '084' OR substr($inputs['phone'], 0, 3) == '085' OR substr($inputs['phone'], 0, 3) == '088' OR substr($inputs['phone'], 0, 3) == '089') {
            try {
                // Select service by name with group API response
                $response_service_orangemoney = $this::$client->request('GET', $url_service_orangemoney, [
                    'headers' => $headers,
                    'form_params' => $inputs,
                    'verify'  => false
                ]);
                $service_orangemoney = json_decode($response_service_orangemoney->getBody(), false);

                if ($service_orangemoney->data != null) {
                    // Change service ID
                    $inputs['service_id'] = $service_orangemoney->data->id;

                    try {
                        // Update user API response
                        $response = $this::$client->request('PUT', $url, [
                            'headers' => $headers,
                            'form_params' => $inputs,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'updated_account_message' => $user->message
                        ]);

                    } catch (ClientException $e) {
                        // If API returns some error, get it,
                        // return to the update_account page and display its message
                        $response = $this::$client->request('GET', $url, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                            'inputs' => $inputs
                        ]);
                    }

                } else {
                    // Find group by its name API URL
                    $url_groups = '/api/group/search/' . $phone_service_group;

                    try {
                        // Find group by its name API response
                        $response_groups = $this::$client->request('GET', $url_groups, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $groups = json_decode($response_groups->getBody(), false);

                        foreach ($groups->data as $group):
                            // Create service API URL
                            $url_service_orangemoney = '/api/service';

                            try {
                                // Find group by its name API response
                                $response_service_orangemoney = $this::$client->request('POST', $url_service_orangemoney, [
                                    'headers' => $headers,
                                    'form_params' => [
                                        'service_name' => 'Orange money',
                                        'provider' => 'Orange',
                                        'group_id' => $group->id
                                    ],
                                    'verify'  => false
                                ]);
                                $service_orangemoney = json_decode($response_service_orangemoney->getBody(), false);

                                // Change service ID
                                $inputs['service_id'] = $service_orangemoney->data->id;

                                try {
                                    // Update user API response
                                    $response = $this::$client->request('PUT', $url, [
                                        'headers' => $headers,
                                        'form_params' => $inputs,
                                        'verify'  => false
                                    ]);
                                    $user = json_decode($response->getBody(), false);

                                    return view('account', [
                                        'user' => $user,
                                        'updated_account_message' => $user->message
                                    ]);

                                } catch (ClientException $e) {
                                    // If API returns some error, get it,
                                    // return to the update_account page and display its message
                                    $response = $this::$client->request('GET', $url, [
                                        'headers' => $headers,
                                        'verify'  => false
                                    ]);
                                    $user = json_decode($response->getBody(), false);

                                    return view('account', [
                                        'user' => $user,
                                        'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                                        'inputs' => $inputs
                                    ]);
                                }

                            } catch (ClientException $e) {
                                // If API returns some error, get it,
                                // return to the update_account page and display its message
                                $response = $this::$client->request('GET', $url, [
                                    'headers' => $headers,
                                    'verify'  => false
                                ]);
                                $user = json_decode($response->getBody(), false);

                                return view('account', [
                                    'user' => $user,
                                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                                    'inputs' => $inputs
                                ]);
                            }
                        endforeach;

                    } catch (ClientException $e) {
                        // If API returns some error, get it,
                        // return to the update_account page and display its message
                        $response = $this::$client->request('GET', $url, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                            'inputs' => $inputs
                        ]);
                    }
                }

            } catch (ClientException $e) {
                // If API returns some error, get it,
                // return to the update_account page and display its message
                return view('account', [
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                ]);
            }

        // - - - - - - - - - AIRTEL MONEY
        } else if (substr($inputs['phone'], 0, 3) == '099') {
            try {
                // Select service by name with group API response
                $response_service_airtelmoney = $this::$client->request('GET', $url_service_airtelmoney, [
                    'headers' => $headers,
                    'form_params' => $inputs,
                    'verify'  => false
                ]);
                $service_airtelmoney = json_decode($response_service_airtelmoney->getBody(), false);

                if ($service_airtelmoney->data != null) {
                    // Change service ID
                    $inputs['service_id'] = $service_airtelmoney->data->id;

                    try {
                        // Update user API response
                        $response = $this::$client->request('PUT', $url, [
                            'headers' => $headers,
                            'form_params' => $inputs,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'updated_account_message' => $user->message
                        ]);

                    } catch (ClientException $e) {
                        // If API returns some error, get it,
                        // return to the update_account page and display its message
                        $response = $this::$client->request('GET', $url, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                            'inputs' => $inputs
                        ]);
                    }

                } else {
                    // Find group by its name API URL
                    $url_groups = '/api/group/search/' . $phone_service_group;

                    try {
                        // Find group by its name API response
                        $response_groups = $this::$client->request('GET', $url_groups, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $groups = json_decode($response_groups->getBody(), false);

                        foreach ($groups->data as $group):
                            // Create service API URL
                            $url_service_airtelmoney = '/api/service';

                            try {
                                // Find group by its name API response
                                $response_service_airtelmoney = $this::$client->request('POST', $url_service_airtelmoney, [
                                    'headers' => $headers,
                                    'form_params' => [
                                        'service_name' => 'Airtel money',
                                        'provider' => 'Airtel',
                                        'group_id' => $group->id
                                    ],
                                    'verify'  => false
                                ]);
                                $service_airtelmoney = json_decode($response_service_airtelmoney->getBody(), false);

                                // Change service ID
                                $inputs['service_id'] = $service_airtelmoney->data->id;

                                try {
                                    // Update user API response
                                    $response = $this::$client->request('PUT', $url, [
                                        'headers' => $headers,
                                        'form_params' => $inputs,
                                        'verify'  => false
                                    ]);
                                    $user = json_decode($response->getBody(), false);

                                    return view('account', [
                                        'user' => $user,
                                        'updated_account_message' => $user->message
                                    ]);

                                } catch (ClientException $e) {
                                    // If API returns some error, get it,
                                    // return to the update_account page and display its message
                                    $response = $this::$client->request('GET', $url, [
                                        'headers' => $headers,
                                        'verify'  => false
                                    ]);
                                    $user = json_decode($response->getBody(), false);

                                    return view('account', [
                                        'user' => $user,
                                        'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                                        'inputs' => $inputs
                                    ]);
                                }

                            } catch (ClientException $e) {
                                // If API returns some error, get it,
                                // return to the update_account page and display its message
                                $response = $this::$client->request('GET', $url, [
                                    'headers' => $headers,
                                    'verify'  => false
                                ]);
                                $user = json_decode($response->getBody(), false);

                                return view('account', [
                                    'user' => $user,
                                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                                    'inputs' => $inputs
                                ]);
                            }
                        endforeach;

                    } catch (ClientException $e) {
                        // If API returns some error, get it,
                        // return to the update_account page and display its message
                        $response = $this::$client->request('GET', $url, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                            'inputs' => $inputs
                        ]);
                    }
                }

            } catch (ClientException $e) {
                // If API returns some error, get it,
                // return to the update_account page and display its message
                return view('account', [
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                ]);
            }

        // - - - - - - - - - AFRIMONEY
        } else if (substr($inputs['phone'], 0, 3) == '090') {
            try {
                // Select service by name with group API response
                $response_service_afrimoney = $this::$client->request('GET', $url_service_afrimoney, [
                    'headers' => $headers,
                    'form_params' => $inputs,
                    'verify'  => false
                ]);
                $service_afrimoney = json_decode($response_service_afrimoney->getBody(), false);

                if ($service_afrimoney->data != null) {
                    // Change service ID
                    $inputs['service_id'] = $service_afrimoney->data->id;

                    try {
                        // Update user API response
                        $response = $this::$client->request('PUT', $url, [
                            'headers' => $headers,
                            'form_params' => $inputs,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'updated_account_message' => $user->message
                        ]);

                    } catch (ClientException $e) {
                        // If API returns some error, get it,
                        // return to the update_account page and display its message
                        $response = $this::$client->request('GET', $url, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                            'inputs' => $inputs
                        ]);
                    }

                } else {
                    // Find group by its name API URL
                    $url_groups = '/api/group/search/' . $phone_service_group;

                    try {
                        // Find group by its name API response
                        $response_groups = $this::$client->request('GET', $url_groups, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $groups = json_decode($response_groups->getBody(), false);

                        foreach ($groups->data as $group):
                            // Create service API URL
                            $url_service_afrimoney = '/api/service';

                            try {
                                // Find group by its name API response
                                $response_service_afrimoney = $this::$client->request('POST', $url_service_afrimoney, [
                                    'headers' => $headers,
                                    'form_params' => [
                                        'service_name' => 'Afrimoney',
                                        'provider' => 'Africell',
                                        'group_id' => $group->id
                                    ],
                                    'verify'  => false
                                ]);
                                $service_afrimoney = json_decode($response_service_afrimoney->getBody(), false);

                                // Change service ID
                                $inputs['service_id'] = $service_afrimoney->data->id;

                                try {
                                    // Update user API response
                                    $response = $this::$client->request('PUT', $url, [
                                        'headers' => $headers,
                                        'form_params' => $inputs,
                                        'verify'  => false
                                    ]);
                                    $user = json_decode($response->getBody(), false);

                                    return view('account', [
                                        'user' => $user,
                                        'updated_account_message' => $user->message
                                    ]);

                                } catch (ClientException $e) {
                                    // If API returns some error, get it,
                                    // return to the update_account page and display its message
                                    $response = $this::$client->request('GET', $url, [
                                        'headers' => $headers,
                                        'verify'  => false
                                    ]);
                                    $user = json_decode($response->getBody(), false);

                                    return view('account', [
                                        'user' => $user,
                                        'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                                        'inputs' => $inputs
                                    ]);
                                }

                            } catch (ClientException $e) {
                                // If API returns some error, get it,
                                // return to the update_account page and display its message
                                $response = $this::$client->request('GET', $url, [
                                    'headers' => $headers,
                                    'verify'  => false
                                ]);
                                $user = json_decode($response->getBody(), false);

                                return view('account', [
                                    'user' => $user,
                                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                                    'inputs' => $inputs
                                ]);
                            }
                        endforeach;

                    } catch (ClientException $e) {
                        // If API returns some error, get it,
                        // return to the update_account page and display its message
                        $response = $this::$client->request('GET', $url, [
                            'headers' => $headers,
                            'verify'  => false
                        ]);
                        $user = json_decode($response->getBody(), false);

                        return view('account', [
                            'user' => $user,
                            'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                            'inputs' => $inputs
                        ]);
                    }
                }

            } catch (ClientException $e) {
                // If API returns some error, get it,
                // return to the update_account page and display its message
                return view('account', [
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                ]);
            }

        } else {
            try {
                // API response
                $response = $this::$client->request('PUT', $url, [
                    'headers' => $headers,
                    'form_params' => $inputs,
                    'verify'  => false
                ]);
                $user = json_decode($response->getBody(), false);

                return view('account', [
                    'user' => $user,
                    'updated_account_message' => $user->message
                ]);

            } catch (ClientException $e) {
                // If API returns some error, get it,
                // return to the update_account page and display its message
                $response = $this::$client->request('GET', $url, [
                    'headers' => $headers,
                    'verify'  => false
                ]);
                $user = json_decode($response->getBody(), false);

                return view('account', [
                    'user' => $user,
                    'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                    'inputs' => $inputs
                ]);
            }
        }
    }

    /**
     * POST: Update password
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function updatePassword(Request $request)
    {
        // Get form datas
        $inputs = [
            'id' => $request->user_id,
            'former_password' => $request->former_password,
            'new_password' => $request->new_password,
            'confirm_new_password' => $request->confirm_new_password
        ];
        // Get header informations
        $headers = [
            'Authorization' => 'Bearer '. Auth::user()->api_token,
            'Accept' => 'application/json',
            'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale()
        ];
        // Update password API URL
        $url_update = '/api/user/update_password/' . $inputs['id'];

        try {
            // API response
            $response = $this::$client->request('PUT', $url_update, [
                'headers' => $headers,
                'form_params' => $inputs,
                'verify'  => false
            ]);
            $user = json_decode($response->getBody(), false);

            return Redirect::route('account', [
                'updated_password_message' => $user->message
            ]);

        } catch (ClientException $e) {
            // If Update password API returns some error, get it,
            // return to the update_password page and display its message
            return view('account', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false),
                'inputs' => $inputs
            ]);
        }
    }
}
