@extends('layouts.app')

@section('title')  {{__('site.site_name')}}@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <set-fields></set-fields>
            </div>
        </div>
    </div>
@endsection
