<?php

namespace App\Http\Controllers\API;

use App\Models\Group;
use App\Models\Image;
use App\Models\News;
use App\Models\Notification;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\News as ResourcesNews;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class NewsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderByDesc('created_at')->get();

        return $this->handleResponse(ResourcesNews::collection($news), __('notifications.find_all_news_success'));
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
            'news_title' => $request->news_title,
            'news_content' => $request->news_content,
            'video_url' => $request->video_url,
            'type_id' => $request->type_id
        ];

        $validator = Validator::make($inputs, [
            'news_title' => ['required'],
            'type_id' => ['required']
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());       
        }

        $news = News::create($inputs);

        // In case user want to add URL like Youtube for example
        if ($request->image_url) {
            $image_type_group = Group::where('group_name', 'Type d\'image')->first();
            $others_type = Type::where('group_id', $image_type_group->id)->first();

            Image::create([
                'image_url' => $request->image_url,
                'type_id' => $others_type->id,
                'news_id' => $news->id
            ]);
        }

        /*
            HISTORY AND/OR NOTIFICATION MANAGEMENT
        */
        $news_type = Type::find($inputs['type_id']);

        if ($news_type->type_name == 'Communiqué') {
            $member_role = Role::where('role_name', 'Membre')->first();
            $role_users = RoleUser::where('role_id', $member_role->id)->get();

            foreach ($role_users as $member):
                Notification::create([
                    'notification_url' => 'communique/' . $news->id,
                    'notification_content' => __('notifications.party_published') . ' ' . __('miscellaneous.a_masculine') . ' ' . strtolower($news_type->type_name),
                    'user_id' => $member->user_id,
                ]);
            endforeach;
        }

        return $this->handleResponse(new ResourcesNews($news), __('notifications.create_news_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);

        if (is_null($news)) {
            return $this->handleError(__('notifications.find_news_404'));
        }

        return $this->handleResponse(new ResourcesNews($news), __('notifications.find_news_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        // Get inputs
        $inputs = [
            'id' => $request->id,
            'news_title' => $request->news_title,
            'news_content' => $request->news_content,
            'video_url' => $request->video_url,
            'type_id' => $request->type_id,
            'updated_at' => now()
        ];

        $validator = Validator::make($inputs, [
            'news_title' => ['required'],
            'type_id' => ['required']
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());       
        }

        $news->update($inputs);

        /*
            HISTORY AND/OR NOTIFICATION MANAGEMENT
        */
        $news_type = Type::find($inputs['type_id']);

        if ($news_type->type_name == 'Communiqué') {
            $member_role = Role::where('role_name', 'Membre')->first();
            $role_users = RoleUser::where('role_id', $member_role->id)->get();

            foreach ($role_users as $member):
                Notification::create([
                    'notification_url' => 'communique/' . $news->id,
                    'notification_content' => __('notifications.party_changed') . ' ' . __('miscellaneous.a_masculine') . ' ' . strtolower($news_type->type_name),
                    'user_id' => $member->user_id,
                ]);
            endforeach;
        }

        return $this->handleResponse(new ResourcesNews($news), __('notifications.update_news_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        $news = News::all();

        return $this->handleResponse(ResourcesNews::collection($news), __('notifications.delete_news_success'));
    }

    // ==================================== CUSTOM METHODS ====================================
    /**
     * Select all news of same type.
     *
     * @param  $type_id
     * @return \Illuminate\Http\Response
     */
    public function selectByType($type_id)
    {
        $news = News::where('type_id', $type_id)->get();

        return $this->handleResponse(ResourcesNews::collection($news), __('notifications.find_all_news_success'));
    }

    /**
     * Add news image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function addImage(Request $request, $id)
    {
        $inputs = [
            'news_id' => $request->news_id, 
            'image_64' => $request->image_64
        ];
        // $extension = explode('/', explode(':', substr($inputs['image_64'], 0, strpos($inputs['image_64'], ';')))[1])[1];
        $replace = substr($inputs['image_64'], 0, strpos($inputs['image_64'], ',') + 1);
        // Find substring from replace here eg: data:image/png;base64,
        $image = str_replace($replace, '', $inputs['image_64']);
        $image = str_replace(' ', '+', $image);

        // Clean avatars directory
        $file = new Filesystem;
        $file->cleanDirectory($_SERVER['DOCUMENT_ROOT'] . '/public/storage/images/news/' . $inputs['news_id']);
        // Create image URL
        $image_url = 'images/news/' . $inputs['news_id'] . '/' . Str::random(50) . '.png';

        // Upload image
        Storage::url(Storage::disk('public')->put($image_url, base64_decode($image)));

        $image_type_group = Group::where('group_name', 'Type d\'image')->first();
        $others_type = Type::where([['type_name', 'Autres'], ['group_id', $image_type_group->id]])->first();
        $news_images = Image::where([['user_id', $inputs['user_id']], ['type_id', $others_type->id]])->get();

        if ($news_images != null) {
            foreach ($news_images as $news_image):
                $news_image->delete();
            endforeach;
        }

        Image::create([
            'url_recto' => $image_url,
            'type_id' => $others_type->id,
            'news_id' => $inputs['news_id']
        ]);

		$news = News::find($id);

        $news->update([
            'updated_at' => now()
        ]);

        return $this->handleResponse(new ResourcesNews($news), __('notifications.update_news_success'));
    }
}
