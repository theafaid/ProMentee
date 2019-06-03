<template>
    <form @submit.prevent="submit" @keydown="form.onKeydown($event)">
        <div class="form-group">
            <label>Email</label>
            <input v-model="form.email" type="text" name="email"
                   class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
            <has-error :form="form" field="email"></has-error>
        </div>

        <div class="form-group">
            <label>Password</label>
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
                    email: '',
                    password: '',
                    remember: ''
                })
            }
        },

        computed: {
            isValidForm(){
                return !! (this.form.email && this.form.password);
            }
        },

        methods: {
            submit(){
                this.isValidForm ? this.login() : '';
            },

            login(){
                this.form.post('/login')
                    .then(res => {
                        window.location = "/home";
                    });
            }
        }

    }
</script>
