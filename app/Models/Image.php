<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = ['image_name', 'image_url', 'updated_at', 'type_id', 'user_id', 'legal_info_content_id', 'news_id'];

    /**
     * ONE-TO-MANY
     * One type for several images
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * ONE-TO-MANY
     * One user for several images
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ONE-TO-MANY
     * One legal info content for several images
     */
    public function legal_info_content()
    {
        return $this->belongsTo(LegalInfoContent::class);
    }

    /**
     * ONE-TO-MANY
     * One news for several images
     */
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
