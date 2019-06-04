@extends('layouts.app')

@section('title')  {{__('site.site_name')}}@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">

            <select-categories inline-template>
                <form-wizard title="Choose three areas you specialize in or want to join">
                    <tab-content title="Select 3 Education Fields">

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

