<script>
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
            }
        }
    }
</script>
