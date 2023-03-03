<?php

namespace App\Http\Controllers\API;

use App\Models\LegalInfoContent;
use App\Models\Image;
use App\Models\Group;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LegalInfoContent as ResourcesLegalInfoContent;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class LegalInfoContentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $legal_info_contents = LegalInfoContent::all();

        return $this->handleResponse(ResourcesLegalInfoContent::collection($legal_info_contents), __('notifications.find_all_legal_info_contents_success'));
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
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'legal_info_title_id' => $request->legal_info_title_id
        ];
        // Select all contents of a same title to check unique constraint
        $legal_info_contents = LegalInfoContent::where('legal_info_title_id', $inputs['legal_info_title_id'])->get();

        // Validate required fields
        if ($inputs['content'] == null OR $inputs['content'] == ' ') {
            return $this->handleError($inputs['content'], __('validation.required'), 400);
        }

        if ($inputs['legal_info_title_id'] == null OR $inputs['legal_info_title_id'] == ' ') {
            return $this->handleError($inputs['legal_info_title_id'], __('validation.required'), 400);
        }

        // Check if content already exists
        foreach ($legal_info_contents as $another_legal_info_content):
            if ($another_legal_info_content->content == $inputs['content']) {
                return $this->handleError($inputs['content'], __('validation.custom.content.exists'), 400);
            }
        endforeach;

        $legal_info_content = LegalInfoContent::create($inputs);

        return $this->handleResponse(new ResourcesLegalInfoContent($legal_info_content), __('notifications.create_legal_info_content_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $legal_info_content = LegalInfoContent::find($id);

        if (is_null($legal_info_content)) {
            return $this->handleError(__('notifications.find_legal_info_content_404'));
        }

        return $this->handleResponse(new ResourcesLegalInfoContent($legal_info_content), __('notifications.find_legal_info_content_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LegalInfoContent  $legal_info_content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LegalInfoContent $legal_info_content)
    {
        // Get inputs
        $inputs = [
            'id' => $request->id,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'legal_info_title_id' => $request->legal_info_title_id,
            'updated_at' => now()
        ];
        // Select all contents of a same title and current content to check unique constraint
        $legal_info_contents = LegalInfoContent::where('legal_info_title_id', $inputs['legal_info_title_id'])->get();
        $current_legal_info_content = LegalInfoContent::find($inputs['id']);

        // Validate required fields
        if ($inputs['content'] == null OR $inputs['content'] == ' ') {
            return $this->handleError($inputs['content'], __('validation.required'), 400);
        }

        if ($inputs['legal_info_title_id'] == null OR $inputs['legal_info_title_id'] == ' ') {
            return $this->handleError($inputs['legal_info_title_id'], __('validation.required'), 400);
        }

        foreach ($legal_info_contents as $another_legal_info_content):
            if ($current_legal_info_content->content != $inputs['content']) {
                if ($another_legal_info_content->content == $inputs['content']) {
                    return $this->handleError($inputs['content'], __('validation.custom.content.exists'), 400);
                }
            }
        endforeach;

        $legal_info_content->update($inputs);

        return $this->handleResponse(new ResourcesLegalInfoContent($legal_info_content), __('notifications.update_legal_info_content_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LegalInfoContent  $legal_info_content
     * @return \Illuminate\Http\Response
     */
    public function destroy(LegalInfoContent $legal_info_content)
    {
        $legal_info_content->delete();

        $legal_info_contents = LegalInfoContent::all();

        return $this->handleResponse(ResourcesLegalInfoContent::collection($legal_info_contents), __('notifications.delete_legal_info_content_success'));
    }

    // ==================================== CUSTOM METHODS ====================================
    /**
     * Search a content of legal info by a string.
     *
     * @param  string $data
     * @return \Illuminate\Http\Response
     */
    public function search($data)
    {
        $legal_info_contents = LegalInfoContent::where('content', $data)->get();

        return $this->handleResponse(ResourcesLegalInfoContent::collection($legal_info_contents), __('notifications.find_all_legal_info_contents_success'));
    }

    /**
     * Add legal info content image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function addImage(Request $request, $id)
    {
        $inputs = [
            'legal_info_content_id' => $request->entity_id,
            'image_64' => $request->base64image
        ];

        if ($inputs['image_64'] != null) {
            // $extension = explode('/', explode(':', substr($inputs['image_64'], 0, strpos($inputs['image_64'], ';')))[1])[1];
            $replace = substr($inputs['image_64'], 0, strpos($inputs['image_64'], ',') + 1);
            // Find substring from replace here eg: data:image/png;base64,
            $image = str_replace($replace, '', $inputs['image_64']);
            $image = str_replace(' ', '+', $image);

            // Create image URL
            $image_url = 'images/users/' . $inputs['user_id'] . '/others/' . Str::random(50) . '.png';

            // Upload image
            Storage::url(Storage::disk('public')->put($image_url, base64_decode($image)));

            $image_type_group = Group::where('group_name', 'Type d\'image')->first();

            // If the group to classify image types doesn't exists, create it before register image URL into the database
            if ($image_type_group == null) {
                $group = Group::create([
                    'group_name' => 'Type d\'image',
                    'group_description' => 'Groupe les images selon les types'
                ]);
                $others_type = Type::where('group_name', $group->id)->first();

                if ($others_type == null) {
                    $type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $type->id,
                        'user_id' => $inputs['user_id']
                    ]);

                } else {
                    $others_type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $others_type->id,
                        'user_id' => $inputs['user_id']
                    ]);
                }

            } else {
                $others_type = Type::where('group_name', $image_type_group->id)->first();

                if ($others_type == null) {
                    $type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $image_type_group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $type->id,
                        'user_id' => $inputs['user_id']
                    ]);

                } else {
                    $others_type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $image_type_group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $others_type->id,
                        'user_id' => $inputs['user_id']
                    ]);
                }
            }

        } else {
            // Validate required file and its mime type
            $validator = Validator::make($inputs, [
                'image' => 'required|mimes:jpg,jpeg,png,gif,mp4,ogx,oga,ogv,ogg,webm'
            ]);

            if ($validator->fails()) {
                return $this->handleError($validator->errors());       
            }

            // Create image URL
			$image_url = 'images/users/' . $inputs['user_id'] . '/others/' . Str::random(50) . '.' . $request->file('image')->extension();

			// Upload image
			Storage::url(Storage::disk('public')->put($image_url, $request->file('image')));

            $image_type_group = Group::where('group_name', 'Type d\'image')->first();

            // If the group to classify image types doesn't exists, create it before register image URL into the database
            if ($image_type_group == null) {
                $group = Group::create([
                    'group_name' => 'Type d\'image',
                    'group_description' => 'Groupe les images selon les types'
                ]);
                $others_type = Type::where('group_name', $group->id)->first();

                if ($others_type == null) {
                    $type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $type->id,
                        'user_id' => $inputs['user_id']
                    ]);

                } else {
                    $others_type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $others_type->id,
                        'user_id' => $inputs['user_id']
                    ]);
                }

            } else {
                $others_type = Type::where('group_name', $image_type_group->id)->first();

                if ($others_type == null) {
                    $type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $image_type_group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $type->id,
                        'user_id' => $inputs['user_id']
                    ]);

                } else {
                    $others_type = Type::create([
                        'type_name' => 'Autres',
                        'type_description' => 'Autres types d\'image (Scan de carte d\'électeur, d\'identité, etc.)',
                        'group_id' => $image_type_group->id
                    ]);

                    Image::create([
                        'image_url' => '/' . $image_url,
                        'type_id' => $others_type->id,
                        'user_id' => $inputs['user_id']
                    ]);
                }
            }
        }

		$legal_info_content = LegalInfoContent::find($id);

        $legal_info_content->update([
            'updated_at' => now()
        ]);

        return $this->handleResponse(new ResourcesLegalInfoContent($legal_info_content), __('notifications.update_legal_info_content_success'));
	}
}
