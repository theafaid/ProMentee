@extends('layouts.app')

@section('content')
<div class="container">
    <post :data="{{$post}}"></post>
</div>
@endsection
