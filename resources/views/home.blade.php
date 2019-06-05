@extends('layouts.app')

@section('title')  {{__('site.site_name')}}@endsection
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Cards
        </h1>
    </div>

     <div class="row">
         <div class="col-md-12">
             <select-categories inline-template>
                 <form-wizard title="Choose three areas you specialize in or want to join">
                     <tab-content title="Select 3 Education Fields">
                         <div class="row">
                             @foreach(\App\Field::where('parent_id', null)->where('type', 'edu')->get() as $key => $mainCategory)
                                 <div class="col-md-4 col-xs-6">
                                     <div id="accordion">
                                         <div class="card">
                                             <div class="card-header" id="heading-{{$key}}">
                                                 <h5 class="mb-0">
                                                     <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapse-{{$key}}">
                                                         {{$mainCategory->name}}
                                                     </button>
                                                 </h5>
                                             </div>
                                             <div id="collapse-{{$key}}" class="collapse" aria-labelledby="heading-{{$key}}" data-parent="#accordion">
                                                 <div class="card-body">
                                                     @foreach($mainCategory->children as $key => $subcategory)
                                                         <label class="custom-control custom-checkbox">
                                                             <input type="checkbox" class="custom-control-input" name="example-inline-checkbox1" value="option1" checked="">
                                                             <span class="custom-control-label">{{$subcategory->name}}</span>
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
                     <tab-content title="select entertainement categories">

                     </tab-content>
                     <tab-content title="Last step">

                     </tab-content>
                 </form-wizard>
             </select-categories>
         </div>
     </div>
</div>
@endsection
