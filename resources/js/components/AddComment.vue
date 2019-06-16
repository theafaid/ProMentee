<template>
    <div data-v-4aa6d95f="" class="input-group">
        <input
            @keyup.enter="add"
            v-model="form.body"
            type="text"
            placeholder="Write your comment"
            class="form-control">
    </div>
</template>

<script>
    export default {
        name: "AddComment",

        data(){
            return {
               form: new Form({
                   body: ''
               })
            }
        },

        methods: {
            add(){
                this.form.post(route('comments.store', {slug: 'sit', 'type':'post'}))
                    .then(({data}) => {
                        this.form.reset();
                        this.$emit('newCommentReceived', data);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
