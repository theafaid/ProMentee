<template>
    <div class="card">
        <div class="card-body">
            <div class="text-wrap p-lg-6">
                <h2 class="mt-0 mb-4" v-text="post.title"></h2>
                <p v-text="post.body"></p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Post",

        props: ['data'],

        data(){
            return {
                post: this.data
            }
        }
    }
</script>
