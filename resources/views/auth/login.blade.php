@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Sign in to Promentee
                </div>
                <div class="card-body">
                    <login-form></login-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
