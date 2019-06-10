@extends('layouts.app')

@section('title')  {{__('site.site_name')}}@endsection
@section('content')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
    <create-post fields="{!! json_encode(resolve('User')->fieldsIds()) !!}"></create-post>
@endsection
