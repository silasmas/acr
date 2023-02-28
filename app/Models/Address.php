<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'street', 'updated_at', 'type_id', 'neighborhood_id', 'area_id', 'user_id'];

    /**
     * ONE-TO-MANY
     * One type for several addresses
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * ONE-TO-MANY
     * One neighborhood for several addresses
     */
    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    /**
     * ONE-TO-MANY
     * One area for several addresses
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * ONE-TO-MANY
     * One user for several addresses
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
