@extends('layouts.app')

@section('title')  {{__('site.site_name')}}@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <select-fields inline-template>
                    <form-wizard title="Now it's time to Set your fields that will never change ever" subtitle="Remember that you want to be very specialized :)" shape="tab" color="#20a0ff" @on-complete="setFields()">
                        <tab-content title="Select 3 Education Fields" icon="fa fa-graduation-cap">
                            <div class="row">
                                @foreach($mainEduFields as $key => $mainField)
                                    <div class="col-md-3 col-xs-6">
                                        <div id="accordion">
                                            <div class="card">
                                                <div class="card-header" id="heading-{{$key}}">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapse-{{$key}}">
                                                            {{$mainField->name}}
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapse-{{$key}}" class="collapse" aria-labelledby="heading-{{$key}}" data-parent="#accordion">
                                                    <div class="card-body">
                                                        @foreach($mainField->children as $key => $subfield)
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="example-inline-checkbox1" value="option1" @click="addField({{$subfield->id}}, '{{$subfield->type}}')">
                                                                <span class="custom-control-label">{{$subfield->name}}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </tab-content>

                        <tab-content title="select entertainement categories" icon="fa fa-film">
                            <div class="row">
                                @foreach($mainEntmtFields as $key => $mainField)
                                    <div class="col-md-3 col-xs-6">
                                        <div id="accordion">
                                            <div class="card">
                                                <div class="card-header" id="heading-{{$key}}">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapse-{{$key}}">
                                                            {{$mainField->name}}
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapse-{{$key}}" class="collapse" aria-labelledby="heading-{{$key}}" data-parent="#accordion">
                                                    <div class="card-body">
                                                        @foreach($mainField->children as $key => $subfield)
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="example-inline-checkbox1" value="option1" @click="addField({{$subfield->id}}, {{$subfield->type}})">
                                                                <span class="custom-control-label">{{$subfield->name}}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </tab-content>
                        <tab-content title="Last step" icon="fa fa-check">

                        </tab-content>
                    </form-wizard>
                </select-fields>
            </div>
        </div>
    </div>
@endsection
