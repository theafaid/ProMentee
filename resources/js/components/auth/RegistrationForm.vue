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
                                :class="{ 'is-invalid': form.errors.has('name')}"
                                :placeholder="trans('full_name')"
                                v-model="form.name">
                    </div>
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
                            :class="{ 'is-invalid': form.errors.has('email')}"
                            :placeholder="trans('email')"
                            v-model="form.email">
                    </div>
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
                            :class="{ 'is-invalid': form.errors.has('password')}"
                            :placeholder="trans('password')"
                            v-model="form.password">
                    </div>
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
                            :class="{ 'is-invalid': form.errors.has('password_confirmation')}"
                            :placeholder="trans('password_confirmation')"
                            v-model="form.password_confirmation">
                    </div>
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
                        <select name="yob" class="form-control custom-select" :class="{ 'is-invalid': form.errors.has('yob')}" v-model="form.yob">
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
                            <input type="radio" class="custom-control-input" :class="{ 'is-invalid': form.errors.has('gender')}" name="gender" value="male" v-model="form.gender">
                            <span class="custom-control-label"><i class="fa fa-male"></i> {{trans('male')}}</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" :class="{ 'is-invalid': form.errors.has('gender')}" name="gender" value="female" v-model="form.gender">
                            <span class="custom-control-label"><i class="fa fa-female"></i> {{trans('female')}}</span>
                        </label>
                    </div>
                    <has-error :form="form" field="gender"></has-error>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <button :disabled="! isValidForm" type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-user-plus"></i> {{ trans('register') }}
                </button>
            </div>
        </div>


    </form>
</template>

<script>
    export default {
        name: "RegistrationForm",

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

        computed: {
            currentYear(){
                return new Date().getFullYear();
            },

            isValidForm(){
               let form = this.form;

               return !! (form.name && this.validateEmail(form.email) && (form.password.length >= 8)
                   && (form.password == form.password_confirmation) && form.yob && (form.gender == 'male' || form.gender == 'female'));
            }
        },

        methods: {
            submit(){
                this.isValidForm ? this.register() : '';
            },

            register(){
                this.form.post(route('register'))
                    .then(res => {
                        window.location = route('home');
                    });
            },

            getYears(start,stop){
                return new Array(start-stop).fill(start).map((n,i)=>n-i);
            },

            validateEmail(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }
        }
    }
</script>
