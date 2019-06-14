<template>
    <button class="btn" :class="isSubscribed ? 'btn-default text-muted' : 'btn-danger'" @click.prevent="subscribe()"><i class="fa fa-bell mr-1"></i></button>
</template>

<script>
    export default {
        name: "Subscription",

        data(){
            return {
                isSubscribed: true,
            }
        },

        methods: {
            subscribe(){
                this.isSubscribed = ! this.isSubscribed;
            }
        }
    }
</script>

<style scoped>

</style>
