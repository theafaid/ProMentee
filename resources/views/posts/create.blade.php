@extends('layouts.app')
@section('title')
    Posts
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h1 class="page-title page-brief">
                Create you post
            </h1>
        </div>
        <div class="row">
            <div class="col-md-9">
                <form>
                    <div class="form-group">
                        <div class="form-label">Post title</div>
                        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    <div class="form-group">
                        <div class="form-label">Post Body</div>
                        <textarea class="form-control" name="example-textarea-input" rows="10" placeholder="Content.."></textarea>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-label">Post type</div>
                    <div class="custom-controls-stacked">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
                            <span class="custom-control-label"><i class="fa fa-question"></i> Question</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox2" value="option2">
                            <span class="custom-control-label"><i class="fa fa-info-circle"></i> Information</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox2" value="option2">
                            <span class="custom-control-label"><i class="fa fa-tripadvisor"></i> Advice</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="example-checkbox2" value="option2">
                            <span class="custom-control-label"><i class="fa fa-lightbulb-o"></i> Idea</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-controls-stacked">
                        @foreach(resolve('User')->fieldsIds() as $field)
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
                                <span class="custom-control-label">{{$field}}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="input-group">
                    <button type="submit" class="btn btn-info">Create my post</button>
                </div>
            </div>
        </div>
    </div>
@endsection
