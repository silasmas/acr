<?php

namespace App\Http\Controllers\API;

use stdClass;
use App\Models\Area;
use App\Models\Role;
use App\Models\Type;
use App\Models\User;
use App\Models\Group;
use App\Models\Image;
use App\Models\Status;
use App\Models\Address;
use Nette\Utils\Random;
use App\Models\RoleUser;
use Illuminate\Support\Str;
use App\Models\Neighborhood;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\User as ResourcesUser;
use App\Http\Resources\PasswordReset as ResourcesPasswordReset;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderByDesc('created_at')->get();

        return $this->handleResponse(ResourcesUser::collection($users), __('notifications.find_all_users_success'));
    }

    /**
     * Store a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get inputs
        $inputs = [
            'national_number' => $request->national_number,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'birth_city' => $request->birth_city,
            'birth_date' => $request->birth_date,
            'nationality' => $request->nationality,
            'p_o_box' => $request->p_o_box,
            'email' => $request->email,
            'phone' => $request->phone,
            'email_verified_at' => $request->email_verified_at,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'remember_token' => $request->remember_token,
            'api_token' => $request->api_token,
            'status_id' => $request->status_id
        ];
        $password_reset = null;
        $basic  = new \Vonage\Client\Credentials\Basic('89e3b822', 'f3cbb6cbe1217dd0Moses');
        $client = new \Vonage\Client($basic);

        // Validate required fields
        if ($inputs['email'] == null AND $inputs['phone'] == null) {
            return $this->handleError(__('validation.custom.email_or_phone.required'));
        }

        if ($inputs['email'] == ' ' AND $inputs['phone'] == ' ') {
            return $this->handleError(__('validation.custom.email_or_phone.required'));
        }

        if ($inputs['email'] == null AND $inputs['phone'] == ' ') {
            return $this->handleError(__('validation.custom.email_or_phone.required'));
        }

        if ($inputs['email'] == ' ' AND $inputs['phone'] == null) {
            return $this->handleError(__('validation.custom.email_or_phone.required'));
        }

        if ($inputs['password'] != null) {
            if ($inputs['confirm_password'] != $inputs['password'] OR $inputs['confirm_password'] == null) {
                return $this->handleError($inputs['confirm_password'], __('notifications.confirm_password_error'), 400);
            }

            if (preg_match('#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#', $inputs['password']) == 0) {
                return $this->handleError($inputs['password'], __('notifications.password.error'), 400);
            }

            // Update password reset in the case user want to reset his password
            $random_string = (string) random_int(1000000, 9999999);
            $password_reset = PasswordReset::create([
                'email' => $inputs['email'],
                'phone' => $inputs['phone'],
                'token' => $random_string,
                'former_password' => $inputs['password']
            ]);

            if ($password_reset->phone != null) {
                $client->sms()->send(new \Vonage\SMS\Message\SMS($password_reset->phone, 'ACR', (string) $password_reset->token));
            }

        }

        if ($inputs['password'] == null) {
            // Update password reset in the case user want to reset his password
            $random_string = (string) random_int(1000000, 9999999);
            $password_reset = PasswordReset::create([
                'email' => $inputs['email'],
                'phone' => $inputs['phone'],
                'token' => $random_string,
                'former_password' => Random::generate(10, 'a-zA-Z'),
            ]);

            $inputs['password'] = Hash::make($password_reset->former_password);

            if ($password_reset->phone != null) {
                $client->sms()->send(new \Vonage\SMS\Message\SMS($password_reset->phone, 'ACR', (string) $password_reset->token));
            }
        }

        $user = User::create($inputs);

        if ($request->role_id != null) {
            RoleUser::create([
                'role_id' => $request->role_id,
                'user_id' => $user->id
            ]);

            /*
                HISTORY AND/OR NOTIFICATION MANAGEMENT
            */
            $status_unread = Status::where('status_name', 'Non lue');
            $admin_role = Role::where('role_name', 'Adminstrateur')->first();
            $member_role = Role::where('role_name', 'Membre')->first();
            $current_role = Role::find($request->role_id);

            // If the new user is a member, send notification to 
            // all managers and a welcome notification to the new user
            if ($current_role->id == $member_role->id) {
                $manager_role = Role::where('role_name', 'Manager')->first();
                $role_users = RoleUser::where('role_id', $manager_role->id)->get();

                foreach ($role_users as $executive):
                    Notification::create([
                        'notification_url' => 'members/' . $user->id,
                        'notification_content' => $user->fistname . ' ' . $user->lastname . ' ' . __('notifications.subscribed_to_party'),
                        'status_id' => $status_unread->id,
                        'user_id' => $executive->user_id
                    ]);
                endforeach;

                Notification::create([
                    'notification_url' => 'about_us/terms_of_use',
                    'notification_content' => __('notifications.welcome_member'),
                    'status_id' => $status_unread->id,
                    'user_id' => $user->id,
                ]);
            }

            // If the new user is neither a member nor an admin, send a ordinary welcome notification
            if ($current_role->id != $member_role->id AND $current_role->id != $admin_role->id) {
                Notification::create([
                    'notification_url' => 'about_us/terms_of_use',
                    'notification_content' => __('notifications.welcome_user'),
                    'status_id' => $status_unread->id,
                    'user_id' => $user->id,
                ]);
            }
        }

        // If user want to add company address
        if ($request->number != null OR $request->street != null OR $request->neighborhood_id != null OR $request->area_id != null) {
            // Select all addresses of a same neighborhood to check unique constraint
            $addresses = Address::where('neighborhood_id', $request->neighborhood_id)->get();

            if ($request->neighborhood_id == null OR $request->neighborhood_id == ' ') {
                return $this->handleError($request->neighborhood_id, __('validation.required'), 400);
            }

            if ($request->area_id == null OR $request->area_id == ' ') {
                return $this->handleError($request->area_id, __('validation.required'), 400);
            }

            // Find area and neighborhood by their IDs to get their names
            $area = Area::find($request->area_id);
            $neighborhood = Neighborhood::find($request->neighborhood_id);

            // Check if address already exists
            foreach ($addresses as $another_address):
                if ($another_address->number == $request->number AND $another_address->street == $request->street AND $another_address->neighborhood_id == $request->neighborhood_id AND $another_address->area_id == $request->area_id) {
                    return $this->handleError(
                        __('notifications.address.number') . __('notifications.colon_after_word') . ' ' . $request->number . ', ' 
                        . __('notifications.address.street') . __('notifications.colon_after_word') . ' ' . $request->street . ', ' 
                        . __('notifications.address.neighborhood') . __('notifications.colon_after_word') . ' ' . $neighborhood->neighborhood_name . ', ' 
                        . __('notifications.address.area') . __('notifications.colon_after_word') . ' ' . $area->area_name, __('validation.custom.address.exists'), 400);
                }
            endforeach;

            Address::create([
                'number' => $request->number,
                'street' => $request->street,
                'type_id' => $request->type_id,
                'area_id' => $request->area_id,
                'neighborhood_id' => $request->neighborhood_id,
                'user_id' => $user->id
            ]);
        }

        $object = new stdClass();
        $object->password_reset = new ResourcesPasswordReset($password_reset);
        $object->user = new ResourcesUser($user);

        return $this->handleResponse($object, __('notifications.create_user_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->handleError(__('notifications.find_user_404'));
        }

        return $this->handleResponse(new ResourcesUser($user), __('notifications.find_user_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Get inputs
        $inputs = [
            'id' => $request->id,
            'national_number' => $request->national_number,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'birth_city' => $request->birth_city,
            'birth_date' => $request->birth_date,
            'nationality' => $request->nationality,
            'p_o_box' => $request->p_o_box,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'updated_at' => now(),
        ];

        if ($inputs['national_number'] != null) {
            $user->update([
                'national_number' => $request->national_number,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['firstname'] != null) {
            $user->update([
                'firstname' => $request->firstname,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['lastname'] != null) {
            $user->update([
                'lastname' => $request->lastname,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['surname'] != null) {
            $user->update([
                'surname' => $request->surname,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['gender'] != null) {
            $user->update([
                'gender' => $request->gender,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['birth_city'] != null) {
            $user->update([
                'birth_city' => $request->birth_city,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['birth_date'] != null) {
            $user->update([
                'birth_date' => $request->birth_date,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['nationality'] != null) {
            $user->update([
                'nationality' => $request->nationality,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['p_o_box'] != null) {
            $user->update([
                'p_o_box' => $request->p_o_box,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['email'] != null) {
            $user->update([
                'email' => $request->email,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['phone'] != null) {
            $user->update([
                'phone' => $request->phone,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['password'] != null) {
            if ($inputs['confirm_password'] != $inputs['password'] OR $inputs['confirm_password'] == null) {
                return $this->handleError($inputs['confirm_password'], __('notifications.confirm_password_error'), 400);
            }

            if (preg_match('#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#', $inputs['password']) == 0) {
                return $this->handleError($inputs['password'], __('notifications.password.error'), 400);
            }

            $password_reset_by_email = PasswordReset::where('email', $inputs['email'])->first();
            $password_reset_by_phone = PasswordReset::where('phone', $inputs['phone'])->first();

            if ($password_reset_by_email != null) {
                // Update password reset
                $random_string = (string) random_int(1000000, 9999999);
                $password_reset_by_email->update([
                    'token' => $random_string,
                    'former_password' => $inputs['password'],
                    'updated_at' => now(),
                ]);
            }

            if ($password_reset_by_phone != null) {
                // Update password reset
                $random_string = (string) random_int(1000000, 9999999);
                $password_reset_by_phone->update([
                    'token' => $random_string,
                    'former_password' => $inputs['password'],
                    'updated_at' => now(),
                ]);
            }

            $inputs['password'] = Hash::make($inputs['password']);

            $user->update([
                'password' => $inputs['password'],
                'updated_at' => now(),
            ]);
        }

        return $this->handleResponse(new ResourcesUser($user), __('notifications.update_user_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        $users = User::orderByDesc('created_at')->get();

        return $this->handleResponse(ResourcesUser::collection($users), __('notifications.delete_user_success'));
    }

    // ==================================== CUSTOM METHODS ====================================
    /**
     * Search a user by his firstname / national number.
     *
     * @param  int $visitor_user_id
     * @param  string $data
     * @return \Illuminate\Http\Response
     */
    public function search($data)
    {
        $users = User::where('firstname', $data)->orWhere('national_number', $data)->get();

        return $this->handleResponse(ResourcesUser::collection($users), __('notifications.find_all_users_success'));
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Get inputs
        $inputs = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if ($inputs['username'] == null OR $inputs['username'] == ' ') {
            return $this->handleError($inputs['username'], __('validation.required'), 400);
        }

        if ($inputs['password'] == null) {
            return $this->handleError($inputs['password'], __('validation.required'), 400);
        }

        if (is_numeric($inputs['username'])) {
            $user = User::where('phone', $inputs['username'])->first();

            if (!$user) {
                return $this->handleError($inputs['username'], __('auth.username'), 400);
            }

            if (!Hash::check($inputs['password'], $user->password)) {
                return $this->handleError($inputs['password'], __('auth.password'), 400);
            }

            // update "last_connection" column
            $user->update([
                'last_connection' => now(),
                'updated_at' => now()
            ]);

            return $this->handleResponse(new ResourcesUser($user), __('notifications.find_user_success'));

        } else {
            $user = User::where('email', $inputs['username'])->first();

            if (!$user) {
                return $this->handleError($inputs['username'], __('auth.username'), 400);
            }

            if (!Hash::check($inputs['password'], $user->password)) {
                return $this->handleError($inputs['password'], __('auth.password'), 400);
            }

            // update "last_connection" column
            $user->update([
                'last_connection' => now(),
                'updated_at' => now()
            ]);

            return $this->handleResponse(new ResourcesUser($user), __('notifications.find_user_success'));
        }
    }

    /**
     * Switch between user statuses.
     *
     * @param  $id
     * @param  $status_id
     * @return \Illuminate\Http\Response
     */
    public function switchStatus($id, $status_id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->handleError(__('notifications.find_user_404'));
        }

        /*
            HISTORY AND/OR NOTIFICATION MANAGEMENT
        */
        $status_ongoing = Status::where('status_name', 'En attente');
        $status_unread = Status::where('status_name', 'Non lue');
        $member_role = Role::where('role_name', 'Membre')->first();
        $user_roles = RoleUser::where('user_id', $user->id)->get();
        $is_ongoing = $user->status_id == $status_ongoing->id;

        // update "status_id" column
        $user->update([
            'status_id' => $status_id,
            'updated_at' => now()
        ]);

        // If it's a member whose accessing is accepted, send notification
        if ($is_ongoing == true) {
            foreach ($user_roles as $user_role):
                if ($user_role->id == $member_role->id) {
                    Notification::create([
                        'notification_url' => 'about_us/terms_of_use',
                        'notification_content' => __('notifications.member_joined'),
                        'status_id' => $status_unread->id,
                        'user_id' => $user->id,
                    ]);
                }
            endforeach;
        }

        return $this->handleResponse(new ResourcesUser($user), __('notifications.update_user_success'));
    }

    /**
     * Associate roles to user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function associateRoles(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->role_id != null) {
            RoleUser::create([
                'role_id' => $request->role_id,
                'user_id' => $user->id
            ]);
		}

        if ($request->roles_ids != null) {
            foreach ($request->roles_ids as $role_id):
                RoleUser::create([
                    'role_id' => $role_id,
                    'user_id' => $user->id
                ]);
            endforeach;
		}

        return $this->handleResponse(new ResourcesUser($user), __('notifications.update_user_success'));
    }

    /**
     * Withdraw roles from user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function withdrawRoles(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->role_id != null) {
            $role_user = RoleUser::where([['role_id', $request->role_id], ['user_id', $user->id]])->first();

            $role_user->delete();
        }

        if ($request->roles_ids != null) {
            foreach ($request->roles_ids as $role_id):
                $role_user = RoleUser::where([['role_id', $role_id], ['user_id', $user->id]])->first();

                $role_user->delete();
            endforeach;
        }

        return $this->handleResponse(new ResourcesUser($user), __('notifications.update_user_success'));
    }

    /**
     * Update user password in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        // Get inputs
        $inputs = [
            'former_password' => $request->former_password,
            'new_password' => $request->new_password,
            'confirm_new_password' => $request->confirm_new_password
        ];
        $user = User::find($id);

        if ($inputs['former_password'] == null) {
            return $this->handleError($inputs['former_password'], __('notifications.former_password.empty'), 400);
        }

        if ($inputs['new_password'] == null) {
            return $this->handleError($inputs['new_password'], __('notifications.new_password.empty'), 400);
        }

        if ($inputs['confirm_new_password'] == null) {
            return $this->handleError($inputs['confirm_new_password'], __('notifications.confirm_new_password'), 400);
        }

        if (Hash::check($inputs['former_password'], $user->password) == false) {
            return $this->handleError($inputs['former_password'], __('auth.password'), 400);
        }

        if ($inputs['confirm_new_password'] != $inputs['new_password']) {
            return $this->handleError($inputs['confirm_new_password'], __('notifications.confirm_new_password'), 400);
        }

        if (preg_match('#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#', $inputs['new_password']) == 0) {
            return $this->handleError($inputs['new_password'], __('notifications.new_password.error'), 400);
        }

        // Update password reset
        $password_reset_by_email = PasswordReset::where('email', $user->email)->first();
        $password_reset_by_phone = PasswordReset::where('phone', $user->phone)->first();

        if ($password_reset_by_email != null) {
            // Update password reset in the case user want to reset his password
            $password_reset_by_email->update([
                'code' => random_int(1000000, 9999999),
                'former_password' => $inputs['new_password'],
                'updated_at' => now(),
            ]);
        }

        if ($password_reset_by_phone != null) {
            // Update password reset in the case user want to reset his password
            $password_reset_by_phone->update([
                'code' => random_int(1000000, 9999999),
                'former_password' => $inputs['new_password'],
                'updated_at' => now(),
            ]);
        }

        // update "password" and "password_visible" column
        $user->update([
            'password' => Hash::make($inputs['new_password']),
            'updated_at' => now()
        ]);

        return $this->handleResponse(new ResourcesUser($user), __('notifications.update_password_success'));
    }

    /**
     * Get user api token in storage.
     *
     * @param  $email
     * @return \Illuminate\Http\Response
     */
    public function getApiToken($email)
    {
        $user = User::where('email', $email)->first();

        if (is_null($user)) {
            return $this->handleError(__('notifications.find_user_404'));
        }

        return $this->handleResponse($user->api_token, __('notifications.find_api_token_success'));
    }

    /**
     * Update user api token in storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function updateApiToken($id)
    {
        // find user by given ID
        $user = User::find($id);

        // update "api_token" column
        $user->update([
            'api_token' => Str::random(100),
            'updated_at' => now()
        ]);

        return $this->handleResponse(new ResourcesUser($user), __('notifications.update_user_success'));
    }

    /**
     * Update user avatar picture in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAvatarPicture(Request $request, $id)
    {
        $inputs = [
            'user_id' => $request->user_id,
            'image_64' => $request->image_64
        ];
        // $extension = explode('/', explode(':', substr($inputs['image_64'], 0, strpos($inputs['image_64'], ';')))[1])[1];
        $replace = substr($inputs['image_64'], 0, strpos($inputs['image_64'], ',') + 1);
        // Find substring from replace here eg: data:image/png;base64,
        $image = str_replace($replace, '', $inputs['image_64']);
        $image = str_replace(' ', '+', $image);

        // Clean avatars directory
        $file = new Filesystem;
        $file->cleanDirectory($_SERVER['DOCUMENT_ROOT'] . '/public/storage/images/users/' . $inputs['user_id'] . '/avatars');
        // Create image URL
		$image_url = 'images/users/' . $inputs['user_id'] . '/avatars/' . Str::random(50) . '.png';

		// Upload image
		Storage::url(Storage::disk('public')->put($image_url, base64_decode($image)));

        $image_type_group = Group::where('group_name', 'Type d\'image')->first();
        $avatar_type = Type::where([['type_name', 'Avatar'], ['group_id', $image_type_group->id]])->first();
        $user_avatars = Image::where([['user_id', $inputs['user_id']], ['type_id', $avatar_type->id]])->get();

        foreach ($user_avatars as $avatar):
            $avatar->delete();
        endforeach;

        Image::create([
            'image_url' => $image_url,
            'type_id' => $avatar_type->id,
            'user_id' => $inputs['user_id']
        ]);

		$user = User::find($id);

        $user->update([
            'updated_at' => now()
        ]);

        return $this->handleResponse(new ResourcesUser($user), __('notifications.update_user_success'));
    }

    /**
     * Add user image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function addImage(Request $request, $id)
    {
        $inputs = [
            'user_id' => $request->user_id,
            'image_name' => $request->image_name,
            'image_64_recto' => $request->image_64_recto,
            'image_64_verso' => $request->image_64_verso,
            'description' => $request->description
        ];

        // $extension = explode('/', explode(':', substr($inputs['image_64_recto'], 0, strpos($inputs['image_64_recto'], ';')))[1])[1];
        $replace_recto = substr($inputs['image_64_recto'], 0, strpos($inputs['image_64_recto'], ',') + 1);
        $replace_verso = substr($inputs['image_64_verso'], 0, strpos($inputs['image_64_verso'], ',') + 1);
        // Find substring from replace here eg: data:image/png;base64,
        $image_recto = str_replace($replace_recto, '', $inputs['image_64_recto']);
        $image_recto = str_replace(' ', '+', $image_recto);
        $image_verso = str_replace($replace_verso, '', $inputs['image_64_verso']);
        $image_verso = str_replace(' ', '+', $image_verso);

        // Create image URL
        $image_url_recto = 'images/users/' . $inputs['user_id'] . '/others/' . Str::random(50) . '.png';
        $image_url_verso = 'images/users/' . $inputs['user_id'] . '/others/' . Str::random(50) . '.png';

        // Upload image
        Storage::url(Storage::disk('public')->put($image_url_recto, base64_decode($image_recto)));
        Storage::url(Storage::disk('public')->put($image_url_verso, base64_decode($image_verso)));

        $image_type_group = Group::where('group_name', 'Type d\'image')->first();
        $others_type = Type::where([['type_name', 'Autres'], ['group_id', $image_type_group->id]])->first();

        Image::create([
            'image_name' => $inputs['image_name'],
            'image_url' => $image_url_recto,
            'url_verso' => $image_url_verso,
            'description' => $inputs['description'],
            'type_id' => $others_type->id,
            'user_id' => $inputs['user_id']
        ]);

		$user = User::find($id);

        $user->update([
            'updated_at' => now()
        ]);

        return $this->handleResponse(new ResourcesUser($user), __('notifications.update_user_success'));
    }
}
