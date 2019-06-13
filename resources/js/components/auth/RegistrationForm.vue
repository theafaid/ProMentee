<template>
    <form @submit.prevent="submit" @keydown="form.onKeydown($event)">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                          <i class="fe fe-user"></i>
                        </span>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                v-validate="'required|alpha_spaces'"
                                :class="{ 'is-invalid': form.errors.has('name')}"
                                :placeholder="trans('full_name')"
                                v-model="form.name">
                    </div>
                    <span class="input-err">{{ errors.first('name') }}</span>
                    <has-error :form="form" field="name"></has-error>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                          <i class="fe fe-mail"></i>
                        </span>
                            <input
                                type="text"
                                name="email"
                                class="form-control"
                                v-validate="'required|email'"
                                :class="{ 'is-invalid': form.errors.has('email')}"
                                :placeholder="trans('email')"
                                v-model="form.email">
                    </div>
                    <span class="input-err">{{ errors.first('email') }}</span>
                    <has-error :form="form" field="email"></has-error>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-icon">
                    <span class="input-icon-addon">
                      <i class="fe fe-lock"></i>
                    </span>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            v-validate="'required|min:8'"
                            :class="{ 'is-invalid': form.errors.has('password')}"
                            :placeholder="trans('password')"
                            v-model="form.password">
                    </div>
                    <span class="input-err">{{ errors.first('password') }}</span>
                    <has-error :form="form" field="password"></has-error>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-icon">
                    <span class="input-icon-addon">
                      <i class="fe fe-lock"></i>
                    </span>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            v-validate="'required'"
                            :class="{ 'is-invalid': form.errors.has('password_confirmation')}"
                            :placeholder="trans('password_confirmation')"
                            v-model="form.password_confirmation">
                    </div>
                    <span class="input-err">{{ errors.first('password_confirmation') }}</span>
                    <has-error :form="form" field="password_confirmation"></has-error>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-icon">
                    <span class="input-icon-addon">
                      <i class="fe fe-calendar"></i>
                    </span>
                        <select name="yob" class="form-control custom-select" v-validate="'required|numeric'" :class="{ 'is-invalid': form.errors.has('yob')}" v-model="form.yob">
                            <option value="">{{trans('yob')}}</option>
                            <option v-for="year in getYears(currentYear-6, currentYear-96)" :value="year">{{year}}</option>
                        </select>
                    </div>
                    <has-error :form="form" field="yob"></has-error>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="custom-controls-stacked">
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" :class="{ 'is-invalid': form.errors.has('gender')}" v-validate="'required'" name="gender" value="male" v-model="form.gender">
                            <span class="custom-control-label"><i class="fa fa-male"></i> {{trans('male')}}</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" :class="{ 'is-invalid': form.errors.has('gender')}" v-validate="'required'" name="gender" value="female" v-model="form.gender">
                            <span class="custom-control-label"><i class="fa fa-female"></i> {{trans('female')}}</span>
                        </label>
                    </div>
                    <has-error :form="form" field="gender"></has-error>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button :disabled="! isValidForm || loading" type="submit" class="btn btn-outline-success btn-block">
                    {{ trans('register') }} <i class="fa fa-user-plus"></i>
                </button>
            </div>
        </div>


    </form>
</template>

<script>
    import Alert from '../../mixins/Alert';

    export default {
        name: "RegistrationForm",

        mixins: [Alert],

        data(){
            return {
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    yob: '',
                    gender: false
                })
            }
        },

        created(){
            this.$validator.localize(Promentee.user.locale, {
                messages: require(`vee-validate/dist/locale/${window.Promentee.locale}`).messages,

            });
            this.$validator.localize(Promentee.user.locale);
        },

        computed: {
            currentYear(){
                return new Date().getFullYear();
            },

            isValidForm(){
                return !! (! this.errors.all().length);
            }
        },

        methods: {
            submit(){
                if(this.isValidForm){
                    this.startLoading(
                        this.trans('registering'),
                        this.trans('registration_wait_msg')
                    );
                    this.register();
                }
            },

            register(){
                this.form.post(route('register'))
                    .then(({data}) => {
                        window.location = data.redirectTo;
                    }).
                    catch(error => this.stopLoading());
            },

            getYears(start,stop){
                return new Array(start-stop).fill(start).map((n,i)=>n-i);
            },
        }
    }
</script>
