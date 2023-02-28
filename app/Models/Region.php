<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class Region extends Model
{
    use HasFactory, Searchable;

    const SEARCHABLE_FIELDS = ['region_name'];

    protected $fillable = ['region_name', 'region_description', 'updated_at', 'continent_id'];

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
     * One continent for several countries
     */
    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }

    /**
     * MANY-TO-ONE
     * Several countries for a continent
     */
    public function countries()
    {
        return $this->hasMany(Country::class);
    }
}
