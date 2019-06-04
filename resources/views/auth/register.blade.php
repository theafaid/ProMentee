@extends('layouts.app')

@section('content')
<div class="container text-center">
    <hr>
    <h1>Join ProMentee</h1>
    <p class="lead">The unique experience. Start join to your community, make friends, learn, have fun and much more .. :)</p>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create your personal account</div>

                <div class="card-body">
                    <h4>Register with social providers</h4>
                    <a href="{{route('auth.social', 'github')}}" class="btn btn-dark">
                        <i class="fa fa-github"></i>
                    </a>

                    <registration-form></registration-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
