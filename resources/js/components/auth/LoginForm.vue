<template>
    <form @submit.prevent="submit" @keydown="form.onKeydown($event)">
        <div class="form-group">
            <label>{{trans('email_or_username')}}</label>
            <input v-model="form.loginName" type="text" name="loginName"
                   class="form-control" :class="{ 'is-invalid': form.errors.has('email') || form.errors.has('username') }">
            <has-error :form="form" field="username"></has-error>
            <has-error :form="form" field="email"></has-error>
            <has-error :form="form" field="loginName"></has-error>
        </div>

        <div class="form-group">
            <label>{{trans('password')}}</label>
            <input v-model="form.password" type="password" name="password"
                   class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
            <has-error :form="form" field="password"></has-error>
        </div>

        <button :disabled="! isValidForm" type="submit" class="btn btn-primary">Log In</button>
    </form>
</template>

<script>
    export default {
        name: "LoginForm",

        data(){
            return {
                form: new Form({
                    loginName: '',
                    password: '',
                    remember: ''
                })
            }
        },

        computed: {
            isValidForm(){
                return !! (this.form.loginName && this.form.password);
            }
        },

        methods: {
            submit(){
                this.isValidForm ? this.login() : '';
            },

            login(){
                this.form.post(route('login'))
                    .then(res => {
                        window.location = "/home";
                    });
            }
        }

    }
</script>
