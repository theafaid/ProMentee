@extends('layouts.app')

@section('title')
    {{__('site.site_name')}} - {{__('javascript.login')}}
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
                    <login-form></login-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
