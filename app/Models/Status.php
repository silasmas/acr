<?php
/**
 * Copyright (c) 2023 Xsam Technologies and/or its affiliates. All rights reserved.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Status extends Model
{
    use HasFactory, Searchable;

    const SEARCHABLE_FIELDS = ['status_name'];

    protected $fillable = ['status_name', 'status_description', 'updated_at', 'group_id'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only(self::SEARCHABLE_FIELDS);
    }

    /**
     * ONE-TO-MANY
     * One group for several statuses
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * MANY-TO-ONE
     * Several about_subjects for a status
     */
    public function about_subjects()
    {
        return $this->hasMany(AboutSubject::class);
    }

    /**
     * MANY-TO-ONE
     * Several phones for a status
     */
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    /**
     * MANY-TO-ONE
     * Several users for a status
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * MANY-TO-ONE
     * Several partners for a status
     */
    public function partners()
    {
        return $this->hasMany(Partner::class);
    }

    /**
     * MANY-TO-ONE
     * Several third party apps for a status
     */
    public function third_party_apps()
    {
        return $this->hasMany(ThirdPartyApp::class);
    }

    /**
     * MANY-TO-ONE
     * Several sellers for a status
     */
    public function sellers()
    {
        return $this->hasMany(Seller::class);
    }

    /**
     * MANY-TO-ONE
     * Several seller_users for a status
     */
    public function seller_users()
    {
        return $this->hasMany(SellerUser::class);
    }

    /**
     * MANY-TO-ONE
     * Several seller_third_party_apps for a status
     */
    public function seller_third_party_apps()
    {
        return $this->hasMany(SellerThirdPartyApp::class);
    }

    /**
     * MANY-TO-ONE
     * Several medals for a status
     */
    public function medals()
    {
        return $this->hasMany(Medal::class);
    }

    /**
     * MANY-TO-ONE
     * Several infos for a status
     */
    public function infos()
    {
        return $this->hasMany(Info::class);
    }

    /**
     * MANY-TO-ONE
     * Several comments for a status
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * MANY-TO-ONE
     * Several messages for a status
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * MANY-TO-ONE
     * Several carts for a status
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * MANY-TO-ONE
     * Several invoices for a status
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * MANY-TO-ONE
     * Several ads for a status
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    /**
     * MANY-TO-ONE
     * Several files for a status
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }

    /**
     * MANY-TO-ONE
     * Several icons for a status
     */
    public function icons()
    {
        return $this->hasMany(Icon::class);
    }

    /**
     * MANY-TO-ONE
     * Several reactions for a status
     */
    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    /**
     * MANY-TO-ONE
     * Several notifications for a status
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * MANY-TO-ONE
     * Several E-mail notifications for a status
     */
    public function email_notifications()
    {
        return $this->hasMany(EmailNotification::class);
    }

    /**
     * MANY-TO-ONE
     * Several SMS notifications for a status
     */
    public function sms_notifications()
    {
        return $this->hasMany(SmsNotification::class);
    }
}
