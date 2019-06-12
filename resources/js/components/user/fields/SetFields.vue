<template>
    <form-wizard
        :title="trans('set_fields_title', {name: name})"
        :subtitle="trans('set_fields_subtitle')"
        errorColor="rgb(255, 65, 65)"
        :nextButtonText="trans('next')"
        :backButtonText="trans('back')"
        :finishButtonText="trans('confirm_set_fields_button')"
        shape="circle"
        color="#20a0ff"
        @on-complete="setFields()">
        <tab-content
            :title="trans('edu_fields')"
            icon="fa fa-graduation-cap"
            :before-change="hasSelectedEduFields">
            <h6 class="wizard-title" v-html="trans('select_edu_fields_title')"></h6><br>
            <div class="row">
                <div class="col-md-3 col-xs-6" v-for="(field, index) in eduFields">
                    <div id="accordion">
                        <div class="card shadowing">
                            <div class="card-header collapsed" :id="'heading-'+index+'edu'" data-toggle="collapse" :data-target="'#collapse-'+index" aria-expanded="false" :aria-controls="'#collapse-'+index">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">{{field.name[locale]}}</button>
                                </h5>
                            </div>
                            <div :id="'collapse-'+index" class="collapse" :aria-labelledby="'heading-'+index+'edu'" data-parent="#accordion">
                                <div class="card-body">
                                    <label class="custom-control custom-checkbox" v-for="subfield in field.children">
                                        <input type="checkbox" class="custom-control-input" name="example-inline-checkbox1" value="option1" @click="addField(subfield, 'edu')">
                                        <span class="custom-control-label">{{subfield.name[locale]}}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </tab-content>

        <tab-content
            :title="trans('entmt_fields')"
            icon="fa fa-music"
            :before-change="hasSelectedEntmtFields">
            <h6 class="wizard-title" v-html="trans('select_entmt_fields_title')"></h6><br>
            <div class="row">
                <div class="col-md-3 col-xs-6" v-for="(field, index) in entmtFields">
                    <div id="accordion">
                        <div class="card shadowing">
                            <div class="card-header" :id="'heading-'+index+'entmt'" data-toggle="collapse" :data-target="'#collapse-'+index" aria-expanded="false" :aria-controls="'#collapse-'+index">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">{{field.name[locale]}}</button>
                                </h5>
                            </div>
                            <div :id="'collapse-'+index" class="collapse" :aria-labelledby="'heading-'+index+'entmt'" data-parent="#accordion">
                                <div class="card-body">
                                    <label class="custom-control custom-checkbox" v-for="subfield in field.children">
                                        <input type="checkbox" class="custom-control-input" name="example-inline-checkbox1" value="option1" @click="addField(subfield, 'entmt')">
                                        <span class="custom-control-label">{{subfield.name[locale]}}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </tab-content>

        <tab-content
            :title="trans('confirmation')"
            icon="fa fa-check">

            <h6 class="wizard-title" v-html="trans('confirm_set_fields_brief')"></h6><hr>
           <div class="row">
               <div class="col-md-6">
                   <div id="accordion">
                       <div class="card shadowing">
                           <div class="card-header">
                               <h2 class="card-title">{{('your_selected_edu_fields')}}</h2>
                           </div>
                           <table class="table card-table">
                               <tbody>
                               <tr v-for="field in selectedEduFields">
                                   <td v-text="field.name"></td>
                               </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
               <div class="col-md-6">
                   <div id="accordion">
                       <div class="card">
                           <div class="card-header">
                               <h2 class="card-title">{{trans('your_selected_entmt_fields')}}</h2>
                           </div>
                           <table class="table card-table">
                               <tbody>
                               <tr v-for="field in selectedEntmtFields">
                                   <td v-text="field.name"></td>
                               </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
           </div>
        </tab-content>
    </form-wizard>
</template>
<script>
    import {FormWizard, TabContent} from 'vue-form-wizard'
    if(Promentee.dir == 'ltr'){
        require('vue-form-wizard/dist/vue-form-wizard.min.css')
    }else{
        require('vue-form-wizard/dist/vue-form-wizard-rtl.min.css')

    }

    export default {
        name: 'SetFields',
        components: {
            FormWizard,
            TabContent
        },

        data(){
            return {
                eduFields: [],
                entmtFields: [],
                selectedEduFields: [],
                selectedEntmtFields: [],
                name: Promentee.user.name,
                locale: Promentee.user.locale
            }
        },

        created(){
            // Fetch all main fields
            axios.get(route('setFields'))
                .then(({data}) => {
                    this.eduFields   = data.mainEduFields;
                    this.entmtFields = data.mainEntmtFields;
                })
        },

        methods: {
            addField(field, type){
                let selected = this[this.getKey(type)]; // get selected (edu, entmt) fields

                if(this.pluck(selected, 'id').includes(field.id)){
                    // remove from selected
                    for (var i =0; i < selected.length; i++) {
                        if (selected[i].id === field.id) {
                            selected.splice(i, 1);
                        }
                    }
                }else{
                    // push to selected
                    selected.push({name: field.name[this.locale], id: field.id})
                }
            },

            setFields(){
                axios.post(route('user.fields.store'), {
                    eduFields: this.pluck(this.selectedEduFields, 'id'), // selected edu fields
                    entmtFields: this.pluck(this.selectedEntmtFields, 'id') // selected entmt fields
                }).then(({data}) => {
                    window.location = route('home');
                }).catch(error => this.error()); // User has change something
            },

            // check if user has selected edu fields (min: 1, max: 3)
            hasSelectedEduFields(){
                let fields = this.selectedEduFields;

                return !! (fields.length > 0 && fields.length <= 3) ;
            },

            // check if user has selected entmt fields (min:1, max: unlimited)
            hasSelectedEntmtFields(){
                return !! this.selectedEntmtFields.length;
            },

            getKey(type){
                // selectedEduFields || selectedEntmtFields
                return `selected${type.charAt(0).toUpperCase() + type.slice(1)}Fields`;
            },

            pluck(array, key){
                return array.map(o => o[key]);
            },

            error(){
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!, Please try again later',
                })
            }
        }
    }
</script>

<style>
    .shadowing{
        box-shadow: 5px 5px 25px 0px rgba(46, 61, 73, 0.2);
    }
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
