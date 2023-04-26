<?php

namespace App\Http\Controllers\Web;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\ClientException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class PartyController extends Controller
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

        $this->middleware('auth');
    }

    // ==================================== HTTP GET METHODS ====================================
    /**
     * GET: Members list
     *
     * @param  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function members()
    {
        // Select current user API URL
        $url_user = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/user/' . Auth::user()->id;
        // Select all countries API URL
        $url_country = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/country';
        // Select all received messages API URL
        $url_message = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/message/inbox/' . Auth::user()->id;
        // Select all roles API URL
        $url_roles = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/role';
        // Select all users by not role API URL
        $developer_role = 'Développeur';
        $url_not_developer = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/user/find_by_not_role/' . $developer_role;

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
            // Select all roles API response
            $response_roles = $this::$client->request('GET', $url_roles, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $roles = json_decode($response_roles->getBody(), false);
            // Select all users by not role API response
            $response_not_developer = $this::$client->request('GET', $url_not_developer, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $not_developer = json_decode($response_not_developer->getBody(), false);

            return view('dashboard.member', [
                'current_user' => $user->data,
                'countries' => $country->data,
                'messages' => $messages->data,
                'roles' => $roles->data,
                'users_not_developer' => $not_developer->data
            ]);

        } catch (ClientException $e) {
            // If the API returns some error, return to the page and display its message
            return view('dashboard.member', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
            ]);
        }
    }

    /**
     * GET: About a member
     *
     * @param  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function memberDatas($id)
    {
        // Select current user API URL
        $url_user = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/user/' . Auth::user()->id;
        // Select all countries API URL
        $url_country = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/country';
        // Select all received messages API URL
        $url_message = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/message/inbox/' . Auth::user()->id;
        // Select all roles API URL
        $url_roles = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/role';
        // Select a member API URL
        $url_member = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/user/' . $id;
        // Select address by type and user API URL
        $legal_address_type = 'Adresse légale';
        $residence_type = 'Résidence actuelle';
        $url_legal_address = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/address/search/' . $legal_address_type . '/ ' . $id;
        $url_residence = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/address/search/' . $residence_type . '/ ' . $id;

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
            // Select all roles API response
            $response_roles = $this::$client->request('GET', $url_roles, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $roles = json_decode($response_roles->getBody(), false);
            // Select a member API response
            $response_member = $this::$client->request('GET', $url_member, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $member = json_decode($response_member->getBody(), false);
            // Select address by type and user API response
            $response_legal_address = $this::$client->request('GET', $url_legal_address, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $legal_address = json_decode($response_legal_address->getBody(), false);
            $response_residence = $this::$client->request('GET', $url_residence, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $residence = json_decode($response_residence->getBody(), false);
            $qr_code = QrCode::format('png')->merge((!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/assets/img/favicon/android-icon-96x96.png', 0.2, true)->size(135)->generate($member->data->phone);
            // $qr_code = QrCode::size(135)->generate($member->data->phone);

            return view('dashboard.member', [
                'current_user' => $user->data,
                'countries' => $country->data,
                'messages' => $messages->data,
                'roles' => $roles->data,
                'selected_member' => $member->data,
                'legal_address' => $legal_address->data,
                'residence' => $residence->data,
                'qr_code' => $qr_code
            ]);

        } catch (ClientException $e) {
            // If the API returns some error, return to the page and display its message
            return view('dashboard.member', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
            ]);
        }
    }

    /**
     * GET: Print card page
     *
     * @param  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function printCard($id)
    {
        // Select a member API URL
        $url_member = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/user/' . $id;
        $residence_type = 'Résidence actuelle';
        $url_residence = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/api/address/search/' . $residence_type . '/ ' . $id;

        try {
            // Select a member API response
            $response_member = $this::$client->request('GET', $url_member, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $member = json_decode($response_member->getBody(), false);
            // Select address by type and user API response
            $response_residence = $this::$client->request('GET', $url_residence, [
                'headers' => $this::$headers,
                'verify'  => false
            ]);
            $residence = json_decode($response_residence->getBody(), false);
            $qr_code = QrCode::format('png')->merge((!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/assets/img/favicon/android-icon-96x96.png', 0.2, true)->size(135)->generate($member->data->phone);
            // $qr_code = QrCode::size(135)->generate($member->data->phone);

            return view('dashboard.print_card', [
                'selected_member' => $member->data,
                'residence' => $residence->data,
                'qr_code' => $qr_code
            ]);

        } catch (ClientException $e) {
            // If the API returns some error, return to the page and display its message
            return view('dashboard.print_card', [
                'response_error' => json_decode($e->getResponse()->getBody()->getContents(), false)
            ]);
        }
    }
}
