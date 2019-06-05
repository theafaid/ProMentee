<template>
    <form-wizard title="Now it's time to Set your fields that will never change ever" subtitle="Remember that you want to be very specialized :)" shape="tab" color="#20a0ff">
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
</template>

<script>
    import {FormWizard, TabContent} from 'vue-form-wizard'
    import 'vue-form-wizard/dist/vue-form-wizard.min.css'

    export default {
        name: 'SelectFields',

        components: {
            FormWizard,
            TabContent
        },

        data(){
            return {
                eduFields: [],
                entmtFields: []
            }
        },

        methods: {
            addField(fieldId, type){
                type == 'edu' ? this.eduFields.push(fieldId) : this.entmtFields.push(fieldId);
            },

            setFields(){
                axios.post(route('user.fields.store'), {
                    eduFields: this.eduFields,
                    entmtFields: this.entmtFields
                });

                window.location = route('home');
            },

            onComplete: function() {
                alert('Yay. Done!');
            },
            validateFirstStep() {
                alert('here');
                return new Promise((resolve, reject) => {
                    this.$refs.ruleForm.validate((valid) => {
                        resolve(valid);
                    });
                })

            }
        }
    }
</script>

<style>
    /*.vue-form-wizard .wizard-progress-bar {*/
    /*    float: right;*/
    /*}*/

    /*.vue-form-wizard .wizard-card-footer .wizard-footer-left {*/
    /*    float: right;*/
    /*}*/

    /*.vue-form-wizard .wizard-card-footer .wizard-footer-right {*/
    /*    float: left;*/
    /*}*/
</style>
