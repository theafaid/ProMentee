<script>
    window.Swal = require('sweetalert2');

    window.Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    export default {
        name: "Alert",

        data(){
            return {
                loading: false
            }
        },

        methods:{
            startLoading(title, body = null){

                this.loading = true;

                Swal.fire({
                    title: title,
                    html: body,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
            },

            stopLoading(){
                this.loading = false;
                Swal.close();
            },

            toast(type = 'success', text){
                Toast.fire({
                    type: type,
                    title: text
                });
            },

            dialog(type = 'error', title = 'Oops...' , text = 'Something went wrong'){
                Swal.fire({
                    type: type,
                    title: title,
                    text: text,
                })
            }
        }
    }
</script>
