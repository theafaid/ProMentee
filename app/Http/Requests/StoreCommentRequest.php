<?php

namespace App\Http\Requests;

use App\Event;
use App\Post;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'type' => 'required|string|in:post,event',
            'body' => 'required|string|max:10000',
        ];
    }

    public function store($slug){

        $model = $this['type'] == 'post' ? Post::whereSlug($slug)->firstOrFail() : Event::whereSlug($slug)->firstOrFail();

        $model->createComment($this['body']);

        \Cache::increment("{$this['type']}.{$model->id}.comments");

        return response([], 201);
    }
}
