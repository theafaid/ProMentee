<template>
    <button class="btn" :class="isFavorited ? 'btn-default text-muted' : 'btn-info'" @click.prevent="favorite()"><i class="fa fa-heart mr-1"></i></button>
</template>

<script>
    export default {
        name: "Favorite",

        data(){
            return {
                isFavorited: true,
            }
        },

        methods: {
            favorite(){
                this.isFavorited = ! this.isFavorited;
            }
        }
    }
</script>

<style scoped>

</style>
