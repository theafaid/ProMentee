@extends('layouts.app')

@section('title')
    ProMentee - {{__('javascript.login')}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{__('site.signin_to_promentee')}}
                </div>
                <div class="card-body">
                    <div class="page-brief text-center">
                        <img src="{{asset('/design/assets/images/site/logo.png')}}">
                    </div>
                    <login-form></login-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
