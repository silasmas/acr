<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Laravel\Scout\Searchable;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class Neighborhood extends Model
{
    use HasFactory/*, Searchable*/;

    // const SEARCHABLE_FIELDS = ['neighborhood_name'];

    protected $fillable = ['neighborhood_name', 'updated_at', 'area_id'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    // public function toSearchableArray()
    // {
    //     return $this->only(self::SEARCHABLE_FIELDS);
    // }

    /**
     * ONE-TO-MANY
     * One area for several neighborhoods
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * MANY-TO-ONE
     * Several addresses for a neighborhood
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
