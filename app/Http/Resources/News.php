<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class News extends JsonResource
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

        foreach ($user_images as $user_image):
            $img = $user_image;
        endforeach;

        return [
            'id' => $this->id,
            'news_title' => $this->news_title,
            'news_content' => $this->news_content,
            'external_video_url' => $this->video_url,
            'news_photo' => !empty($img) ? ($img->type->type_name == 'Autres' ? (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/public/storage/' . $img->url_recto : null) : null,
            'type' => Type::make($this->type),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
