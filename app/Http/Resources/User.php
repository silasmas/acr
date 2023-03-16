<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user_images = Image::collection($this->images);

        return [
            'id' => $this->id,
            'national_number' => $this->national_number,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'surname' => $this->surname,
            'gender' => $this->gender,
            'birth_city' => $this->birth_city,
            'birth_date' => $this->birth_date,
            'nationality' => $this->nationality,
            'p_o_box' => $this->p_o_box,
            'email' => $this->email,
            'phone' => $this->phone,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'remember_token' => $this->remember_token,
            'api_token' => $this->api_token,
            'avatar_url' => isset($user_images[0]) 
                            ? ($user_images[0]->type->type_name == 'Avatar' 
                                ? (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/public/storage/' . $user_images[0]->url_recto 
                                : null
                                ) 
                            : 
                                ($user_images[1]->type->type_name == 'Avatar' 
                                ? (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/public/storage/' . $user_images[1]->url_recto 
                                : null
                                ),
            'identity_data' => isset($user_images[0]) 
                            ? ($user_images[0]->type->type_name == 'Pièce d\'identité' 
                                ? $user_images[0]
                                : null
                                ) 
                            : 
                                ($user_images[1]->type->type_name == 'Pièce d\'identité' 
                                ? $user_images[1] 
                                : null
                                ),
            'status' => Status::make($this->status),
            'addresses' => Address::collection($this->addresses),
            'role_users' => RoleUser::collection($this->role_users),
            'offers' => Offer::collection($this->offers),
            'payments' => Payment::collection($this->payments),
            'notifications' => Notification::collection($this->notifications),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
