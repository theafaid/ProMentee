@extends('layouts.app')

@section('title')
    {{__('site.join_to_site')}} - {{__('site.site_motto')}}
@endsection

@section('content')
<div class="container text-center">

    <div class="page-brief">
        <h1>{{__('site.join_to_site')}}</h1>
        <p>{{__('site.site_motto')}}<br> {{__('site.site_description')}}</p>
        <img src="{{asset('design/assets/images/site/logo.png')}}">
    </div><br>

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create your personal account</div>

                <div class="card-body">
{{--                    <h4>Register with social providers</h4>--}}
{{--                    <a href="{{route('auth.social', 'github')}}" class="btn btn-dark">--}}
{{--                        <i class="fa fa-github"></i>--}}
{{--                    </a>--}}

                    <registration-form></registration-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
