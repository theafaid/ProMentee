@extends('layouts.app')

@section('title')
    Posts
@endsection

@section('content')

    <div class="container">
        <div class="page-header">
            <h1 class="page-title page-brief">
                Blog components
            </h1>
        </div>
        <div class="row row-cards row-deck">
            @forelse($posts as $post)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body d-flex flex-column">
                            <h4><a href="{{route('posts.show', $post->slug)}}">{{\Str::limit($post->body, 20)}}</a></h4>
                            <div class="text-muted">{{\Str::limit($post->body, 45)}}</div>
                            <div class="d-flex align-items-center pt-5 mt-auto">
                                <div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/female/29.jpg)"></div>
                                <div>
                                    <a href="./profile.html" class="text-default">Crystal Wallace</a>
                                    <small class="d-block text-muted">3 days ago</small>
                                </div>
                                <div class="ml-auto text-muted">
                                    <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    {!! __('site.empty_msg', ['name' => auth()->user()->name]) !!}
                </div>
            @endforelse
        </div>
    </div>
@endsection


