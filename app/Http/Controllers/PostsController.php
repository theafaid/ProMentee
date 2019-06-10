<?php

namespace App\Http\Controllers;

use App\Cacheable\CacheableUsersRelations;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('fieldsSet');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::feed(request('type'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string|max:45',
            'body' => 'required|string|min:20|max:10000',
            'type' => 'required|string|in:advice,information,request,idea,other',
            'field_id' => 'required|numeric|exists:fields,id|in:'.implode(',', resolve('User')->fieldsIds())
        ]);

        \App\Post::create([
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'slug' => \Str::slug($data['title']),
            'body' => $data['body'],
            'type' => $data['type'],
            'field_id' => $data['field_id']
        ]);

        return response(['msg' => __('javascript.post_created')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
