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
                }).then(res => {
                    alert(res.data.msg);
                }).catch(error => {
                    alert(error.response.data.msg);
                });
                return ;
                // window.location = route('home');
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
