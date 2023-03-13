<?php

namespace App\Http\Resources;

use stdClass;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class Image extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $object = new stdClass();

        if ($this->type_id == 5) {
            $object->avatar = [
                'id' => $this->id,
                'image_name' => $this->image_name,
                'image_url' => $this->image_url != null ? $_SERVER['DOCUMENT_ROOT'] . '/public/storage/' . $this->image_url : null,
                'url_verso' => $this->url_verso != null ? $_SERVER['DOCUMENT_ROOT'] . '/public/storage/' . $this->url_verso : null,
                'description' => $this->description,
                'type' => Type::make($this->type),
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
                'user_id' => $this->user_id,
                'legal_info_content_id' => $this->legal_info_content_id,
                'news_id' => $this->news_id
            ];

            return $object;

        } else {
            $object->other = [
                'id' => $this->id,
                'image_name' => $this->image_name,
                'image_url' => $this->image_url != null ? $_SERVER['DOCUMENT_ROOT'] . '/public/storage/' . $this->image_url : null,
                'url_verso' => $this->url_verso != null ? $_SERVER['DOCUMENT_ROOT'] . '/public/storage/' . $this->url_verso : null,
                'description' => $this->description,
                'type' => Type::make($this->type),
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
                'user_id' => $this->user_id,
                'legal_info_content_id' => $this->legal_info_content_id,
                'news_id' => $this->news_id
            ];

            return $object;
        }
    }
}
