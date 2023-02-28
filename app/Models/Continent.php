<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class Continent extends Model
{
    use HasFactory;

    protected $fillable = ['continent_name', 'continent_abbreviation', 'updated_at'];

    /**
     * MANY-TO-ONE
     * Several regions for a continent
     */
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
