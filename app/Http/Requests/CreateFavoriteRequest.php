<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;

class CreateFavoriteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|string|in:post,event,comment'
        ];
    }

    public function save($slug){
        switch ($this['type']){
            case 'post': $model = Post::whereSlug($slug)->firstOrFail(); break;
            case 'event': $model = Event::whereSlug($slug)->firstOrFail(); break;
            case 'comment': $model = Comment::whereSlug($slug)->firstOrFail(); break;
        }

        $model->favorites()->create([
            'user_id' => auth()->id()
        ]);

        \Cache::increment("{$this['type']}.{$model->id}.favorites");

        return response([], 201);
    }
}
