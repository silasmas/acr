<?php

namespace App\Http\Controllers\API;

use App\Models\Address;
use App\Models\Area;
use App\Models\Group;
use App\Models\Image;
use App\Models\Neighborhood;
use App\Models\Notification;
use App\Models\PasswordReset;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\User as ResourcesUser;
use App\Http\Resources\PasswordReset as ResourcesPasswordReset;
use Nette\Utils\Random;

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
            'password' => Hash::make($request->password),
            'confirm_password' => $request->confirm_password,
            'remember_token' => $request->remember_token,
            'api_token' => $request->api_token,
            'user_status' => $request->user_status
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

        if ($request->password != null) {
            if ($request->confirm_password != $request->password) {
                return $this->handleError($request->confirm_password, __('notifications.confirm_password.error'), 400);
            }

            if (preg_match('#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#', $request->password) == 0) {
                return $this->handleError($request->password, __('notifications.password.error'), 400);
            }

            // Update password reset in the case user want to reset his password
            $password_reset = PasswordReset::create([
                'email' => $inputs['email'],
                'phone' => $inputs['phone'],
                'code' => random_int(1000000, 9999999),
                'former_password' => $request->password
            ]);

            if ($password_reset->phone != null) {
                $client->sms()->send(new \Vonage\SMS\Message\SMS($password_reset->phone, 'ACR', $password_reset->code));
            }

        } else {
            // Update password reset in the case user want to reset his password
            $password_reset = PasswordReset::create([
                'email' => $inputs['email'],
                'phone' => $inputs['phone'],
                'code' => random_int(1000000, 9999999),
                'former_password' => Random::generate(10, 'a-zA-Z'),
            ]);

            if ($password_reset->phone != null) {
                $client->sms()->send(new \Vonage\SMS\Message\SMS($password_reset->phone, 'ACR', $password_reset->code));
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
            $admin_role = Role::where('role_name', 'Adminstrateur')->first();
            $member_role = Role::where('role_name', 'Membre')->first();
            $current_role = Role::find($request->role_id);

            // If the new user is a member, send notification to all managers and a welcome notification that the new user
            if ($current_role->id == $member_role->id) {
                $manager_role = Role::where('role_name', 'Manager')->first();
                $role_users = RoleUser::where('role_id', $manager_role->id)->get();

                foreach ($role_users as $executive):
                    Notification::create([
                        'notification_url' => 'members/' . $user->id,
                        'notification_content' => $user->fistname . ' ' . $user->lastname . ' ' . __('notifications.subscribed_to_party'),
                        'user_id' => $executive->user_id,
                    ]);
                endforeach;

                Notification::create([
                    'notification_url' => 'about_us/terms_of_use',
                    'notification_content' => __('notifications.welcome_member'),
                    'user_id' => $user->id,
                ]);
            }

            // If the new user is neither a member nor an admin, send a ordinary welcome notification
            if ($current_role->id != $member_role->id AND $current_role->id != $admin_role->id) {
                Notification::create([
                    'notification_url' => 'about_us/terms_of_use',
                    'notification_content' => __('notifications.welcome_user'),
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

        return $this->handleResponse(array(new ResourcesPasswordReset($password_reset), new ResourcesUser($user)), __('notifications.create_user_success'));
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

        if ($inputs['firstname'] == null OR $inputs['firstname'] == ' ') {
            return $this->handleError($inputs['firstname'], __('validation.required'), 400);
        }

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
            if ($inputs['confirm_password'] != $inputs['password']) {
                return $this->handleError($inputs['confirm_password'], __('notifications.confirm_password.error'), 400);
            }

            if (preg_match('#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#', $inputs['password']) == 0) {
                return $this->handleError($inputs['password'], __('notifications.password.error'), 400);
            }

            $password_reset_by_email = PasswordReset::where('email', $inputs['email'])->first();
            $password_reset_by_phone = PasswordReset::where('phone', $inputs['phone'])->first();

            if ($password_reset_by_email != null) {
                // Update password reset in the case user want to reset his password
                $password_reset_by_email->update([
                    'code' => random_int(1000000, 9999999),
                    'former_password' => $inputs['password'],
                    'updated_at' => now(),
                ]);
            }

            if ($password_reset_by_phone != null) {
                // Update password reset in the case user want to reset his password
                $password_reset_by_phone->update([
                    'code' => random_int(1000000, 9999999),
                    'former_password' => $inputs['password'],
                    'updated_at' => now(),
                ]);
            }

            $inputs['password'] = Hash::make($inputs['password']);
        }

        $user->update($inputs);

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
     * @param  $status_name
     * @return \Illuminate\Http\Response
     */
    public function switchStatus($id, $status_name)
    {
        $user = User::find($id);

        // update "status_id" column
        $user->update([
            'user_status' => $status_name,
            'updated_at' => now()
        ]);

        /*
            HISTORY AND/OR NOTIFICATION MANAGEMENT
        */
        $member_role = Role::where('role_name', 'Membre')->first();
        $user_roles = RoleUser::where('user_id', $user->id)->get();

        foreach ($user_roles as $user_role):
            // If the new user is a member, send notification
            if ($user_role->id == $member_role->id AND $status_name == 'Activé') {
                Notification::create([
                    'notification_url' => 'about_us/terms_of_use',
                    'notification_content' => __('notifications.member_joined'),
                    'user_id' => $user->id,
                ]);
            }
        endforeach;

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
            return $this->handleError($inputs['confirm_new_password'], __('notifications.confirm_new_password.empty'), 400);
        }

        if (Hash::check($inputs['former_password'], $user->password) == false) {
            return $this->handleError($inputs['former_password'], __('auth.password'), 400);
        }

        if ($inputs['confirm_new_password'] != $inputs['new_password']) {
            return $this->handleError($inputs['confirm_new_password'], __('notifications.confirm_new_password.error'), 400);
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
            'user_id' => $request->entity_id,
            'image_64' => $request->base64image
        ];
        // $extension = explode('/', explode(':', substr($inputs['image_64'], 0, strpos($inputs['image_64'], ';')))[1])[1];
        $replace = substr($inputs['image_64'], 0, strpos($inputs['image_64'], ',') + 1);
        // Find substring from replace here eg: data:image/png;base64,
        $image = str_replace($replace, '', $inputs['image_64']);
        $image = str_replace(' ', '+', $image);

        // Create image URL
		$image_url = 'images/users/' . $inputs['user_id'] . '/avatars/' . Str::random(50) . '.png';

		// Upload image
		Storage::url(Storage::disk('public')->put($image_url, base64_decode($image)));

        $image_type_group = Group::where('group_name', 'Type d\'image')->first();

        // If the group to classify image types doesn't exists, create it before register image URL into the database
        if ($image_type_group == null) {
            $group = Group::create([
                'group_name' => 'Type d\'image',
                'group_description' => 'Grouper les types qui serviront à gérer les images.'
            ]);
            $avatar_type = Type::where('group_name', $group->id)->first();

            if ($avatar_type == null) {
                $type = Type::create([
                    'type_name' => 'Avatar',
                    'type_description' => 'Photo de profil d\'un utilisateur',
                    'group_id' => $group->id
                ]);

                Image::create([
                    'image_url' => '/' . $image_url,
                    'type_id' => $type->id,
                    'user_id' => $inputs['user_id']
                ]);

            } else {
                $avatar_type = Type::create([
                    'type_name' => 'Avatar',
                    'type_description' => 'Photo de profil d\'un utilisateur',
                    'group_id' => $group->id
                ]);

                Image::create([
                    'image_url' => '/' . $image_url,
                    'type_id' => $avatar_type->id,
                    'user_id' => $inputs['user_id']
                ]);
            }

        } else {
            $avatar_type = Type::where('group_name', $image_type_group->id)->first();

            if ($avatar_type == null) {
                $type = Type::create([
                    'type_name' => 'Avatar',
                    'type_description' => 'Photo de profil d\'un utilisateur',
                    'group_id' => $image_type_group->id
                ]);

                Image::create([
                    'image_url' => '/' . $image_url,
                    'type_id' => $type->id,
                    'user_id' => $inputs['user_id']
                ]);

            } else {
                $avatar_type = Type::create([
                    'type_name' => 'Avatar',
                    'type_description' => 'Photo de profil d\'un utilisateur',
                    'group_id' => $image_type_group->id
                ]);

                Image::create([
                    'image_url' => '/' . $image_url,
                    'type_id' => $avatar_type->id,
                    'user_id' => $inputs['user_id']
                ]);
            }
        }

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
            'user_id' => $request->entity_id,
            'image_64' => $request->base64image
        ];

        if ($inputs['image_64'] != null) {
            // $extension = explode('/', explode(':', substr($inputs['image_64'], 0, strpos($inputs['image_64'], ';')))[1])[1];
            $replace = substr($inputs['image_64'], 0, strpos($inputs['image_64'], ',') + 1);
            // Find substring from replace here eg: data:image/png;base64,
            $image = str_replace($replace, '', $inputs['image_64']);
            $image = str_replace(' ', '+', $image);

            // Create image URL
            $image_url = 'images/users/' . $inputs['user_id'] . '/others/' . Str::random(50) . '.png';

            // Upload image
            Storage::url(Storage::disk('public')->put($image_url, base64_decode($image)));

            $image_type_group = Group::where('group_name', 'Type d\'image')->first();

            // If the group to classify image types doesn't exists, create it before register image URL into the database
            if ($image_type_group == null) {
                $group = Group::create([
                    'group_name' => 'Type d\'image',
                    'group_description' => 'Grouper les types qui serviront à gérer les images.'
                ]);
                $others_type = Type::where('group_name', $group->id)->first();

                if ($others_type == null) {
                    $type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $type->id,
                        'user_id' => $inputs['user_id']
                    ]);

                } else {
                    $others_type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $others_type->id,
                        'user_id' => $inputs['user_id']
                    ]);
                }

            } else {
                $others_type = Type::where('group_name', $image_type_group->id)->first();

                if ($others_type == null) {
                    $type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $image_type_group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $type->id,
                        'user_id' => $inputs['user_id']
                    ]);

                } else {
                    $others_type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $image_type_group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $others_type->id,
                        'user_id' => $inputs['user_id']
                    ]);
                }
            }

        } else {
            // Validate required file and its mime type
            $validator = Validator::make($inputs, [
                'video' => 'required|mimes:jpg,jpeg,png,gif'
            ]);

            if ($validator->fails()) {
                return $this->handleError($validator->errors());       
            }

            // Create image URL
			$image_url = 'images/users/' . $inputs['user_id'] . '/others/' . Str::random(50) . '.' . $request->file('image')->extension();

			// Upload image
			Storage::url(Storage::disk('public')->put($image_url, $request->file('image')));

            $image_type_group = Group::where('group_name', 'Type d\'image')->first();

            // If the group to classify image types doesn't exists, create it before register image URL into the database
            if ($image_type_group == null) {
                $group = Group::create([
                    'group_name' => 'Type d\'image',
                    'group_description' => 'Grouper les types qui serviront à gérer les images.'
                ]);
                $others_type = Type::where('group_name', $group->id)->first();

                if ($others_type == null) {
                    $type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $type->id,
                        'user_id' => $inputs['user_id']
                    ]);

                } else {
                    $others_type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $others_type->id,
                        'user_id' => $inputs['user_id']
                    ]);
                }

            } else {
                $others_type = Type::where('group_name', $image_type_group->id)->first();

                if ($others_type == null) {
                    $type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $image_type_group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $type->id,
                        'user_id' => $inputs['user_id']
                    ]);

                } else {
                    $others_type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $image_type_group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $others_type->id,
                        'user_id' => $inputs['user_id']
                    ]);
                }
            }
        }

		$user = User::find($id);

        $user->update([
            'updated_at' => now()
        ]);

        return $this->handleResponse(new ResourcesUser($user), __('notifications.update_user_success'));
    }
}
