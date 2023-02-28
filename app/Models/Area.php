<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class Area extends Model
{
    use HasFactory, Searchable;

    const SEARCHABLE_FIELDS = ['area_name'];

    protected $fillable = ['area_name', 'updated_at', 'city_id'];

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
     * One city for several areas
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * MANY-TO-ONE
     * Several neighborhoods for an area
     */
    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }

    /**
     * MANY-TO-ONE
     * Several addresses for an area
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
