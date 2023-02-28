<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class City extends Model
{
    use HasFactory, Searchable;

    const SEARCHABLE_FIELDS = ['city_name'];

    protected $fillable = ['city_name', 'updated_at', 'province_id'];

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
     * One province for several cities
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * MANY-TO-ONE
     * Several areas for a city
     */
    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
