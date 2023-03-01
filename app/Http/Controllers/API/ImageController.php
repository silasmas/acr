<?php

namespace App\Http\Controllers\API;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\Image as ResourcesImage;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class ImageController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();

        return $this->handleResponse(ResourcesImage::collection($images), __('notifications.find_all_images_success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get inputs
        $inputs = [
            'image_name' => $request->image_name,
            'image_url' => $request->image_url,
            'type_id' => $request->type_id,
            'user_id' => $request->user_id,
            'legal_info_content_id' => $request->legal_info_content_id,
            'news_id' => $request->news_id
        ];

        // Validate required fields
        if ($inputs['image_url'] == null OR $inputs['image_url'] == ' ') {
            return $this->handleError($inputs['image_url'], __('validation.required'), 400);
        }

        if ($inputs['user_id'] == null AND $inputs['legal_info_content_id'] == null AND $inputs['news_id'] == null) {
            return $this->handleError(__('validation.custom.owner.required'), 400);
        }

        if ($inputs['user_id'] == ' ' AND $inputs['legal_info_content_id'] == ' ' AND $inputs['news_id'] == ' ') {
            return $this->handleError(__('validation.custom.owner.required'), 400);
        }

        if ($inputs['type_id'] == null OR $inputs['type_id'] == ' ') {
            return $this->handleError($inputs['type_id'], __('validation.required'), 400);
        }

        if ($inputs['user_id'] != null) {
			// Select all user images to check unique constraint
			$images = Image::where('user_id', $inputs['user_id'])->get();

			// Check if image URL already exists
			foreach ($images as $another_image):
				if ($another_image->image_url == $inputs['image_url']) {
					return $this->handleError($inputs['image_url'], __('validation.custom.image_url.exists'), 400);
				}
			endforeach;
		}

		if ($inputs['legal_info_content_id'] != null) {
			// Select all legal info content images to check unique constraint
			$images = Image::where('legal_info_content_id', $inputs['legal_info_content_id'])->get();

			// Check if image URL already exists
			foreach ($images as $another_image):
				if ($another_image->image_url == $inputs['image_url']) {
					return $this->handleError($inputs['image_url'], __('validation.custom.image_url.exists'), 400);
				}
			endforeach;
		}

		if ($inputs['news_id'] != null) {
			// Select all news images to check unique constraint
			$images = Image::where('news_id', $inputs['news_id'])->get();

			// Check if image URL already exists
			foreach ($images as $another_image):
				if ($another_image->image_url == $inputs['image_url']) {
					return $this->handleError($inputs['image_url'], __('validation.custom.image_url.exists'), 400);
				}
			endforeach;
		}

        $image = Image::create($inputs);

        return $this->handleResponse(new ResourcesImage($image), __('notifications.create_image_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);

        if (is_null($image)) {
            return $this->handleError(__('notifications.find_image_404'));
        }

        return $this->handleResponse(new ResourcesImage($image), __('notifications.find_image_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        // Get inputs
        $inputs = [
            'id' => $request->id,
            'image_name' => $request->image_name,
            'image_url' => $request->image_url,
            'type_id' => $request->type_id,
            'user_id' => $request->user_id,
            'legal_info_content_id' => $request->legal_info_content_id,
            'news_id' => $request->news_id,
            'updated_at' => now()
        ];

        if ($inputs['image_url'] == null OR $inputs['image_url'] == ' ') {
            return $this->handleError($inputs['image_url'], __('validation.required'), 400);
        }

        if ($inputs['user_id'] == null AND $inputs['legal_info_content_id'] == null AND $inputs['news_id'] == null) {
            return $this->handleError(__('validation.custom.owner.required'), 400);
        }

        if ($inputs['user_id'] == ' ' AND $inputs['legal_info_content_id'] == ' ' AND $inputs['news_id'] == ' ') {
            return $this->handleError(__('validation.custom.owner.required'), 400);
        }

        if ($inputs['type_id'] == null OR $inputs['type_id'] == ' ') {
            return $this->handleError($inputs['type_id'], __('validation.required'), 400);
        }

		if ($inputs['user_id'] != null) {
			// Select all user images and specific image to check unique constraint
			$images = Image::where('user_id', $inputs['user_id'])->get();
			$current_image = Image::find($inputs['id']);

			foreach ($images as $another_image):
				if ($current_image->image_url != $inputs['image_url']) {
					if ($another_image->image_url == $inputs['image_url']) {
						return $this->handleError($inputs['image_url'], __('validation.custom.image_url.exists'), 400);
					}
				}
			endforeach;
		}

		if ($inputs['legal_info_content_id'] != null) {
			// Select all legal info content images and specific image to check unique constraint
			$images = Image::where('legal_info_content_id', $inputs['legal_info_content_id'])->get();
			$current_image = Image::find($inputs['id']);

			foreach ($images as $another_image):
				if ($current_image->image_url != $inputs['image_url']) {
					if ($another_image->image_url == $inputs['image_url']) {
						return $this->handleError($inputs['image_url'], __('validation.custom.image_url.exists'), 400);
					}
				}
			endforeach;
		}

		if ($inputs['news_id'] != null) {
			// Select all news images and specific image to check unique constraint
			$images = Image::where('news_id', $inputs['news_id'])->get();
			$current_image = Image::find($inputs['id']);

			foreach ($images as $another_image):
				if ($current_image->image_url != $inputs['image_url']) {
					if ($another_image->image_url == $inputs['image_url']) {
						return $this->handleError($inputs['image_url'], __('validation.custom.image_url.exists'), 400);
					}
				}
			endforeach;
		}

        $image->update($inputs);

        return $this->handleResponse(new ResourcesImage($image), __('notifications.update_image_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->delete();

        $images = Image::all();

        return $this->handleResponse(ResourcesImage::collection($images), __('notifications.delete_image_success'));
    }

    // ==================================== CUSTOM METHODS ====================================
    /**
     * Select all images belonging to a specific entity.
     *
     * @param  $entity
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function selectByEntity($entity, $id)
    {
        $images = Image::where($entity . '_id', $id)->get();

        return $this->handleResponse(ResourcesImage::collection($images), __('notifications.find_all_images_success'));
    }
}
