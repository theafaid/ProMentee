@extends('layouts.app')

@section('content')
<div class="container text-center">
    <hr>
    <h2>Join ProMentee</h2>
    <p class="lead">The unique experience. Start join to your community, make friends, learn, have fun and much more .. :)</p>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create your personal account</div>

                <div class="card-body">
                    <registration-form></registration-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
