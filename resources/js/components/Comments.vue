<template>
    <div>
        <div v-if="! loaded">
            <button @click.prevent="viewComments" class="btn btn-block btn-outline-secondary">
                View Comments
            </button>
        </div>
        <div v-if="loaded" class="card">
            <div class="card-body">
                <h3>Comments</h3>
                <ul class="list-group card-list-group">
                    <comment v-for="(comment, index) in comments" :data="comment" :key="index"></comment>
                </ul>
            </div>
            <div class="card-footer">
                <add-comment @newCommentReceived="add"></add-comment>
            </div>
        </div>
    </div>
</template>

<script>
    import Comment from './Comment'
    import AddComment from './AddComment'

    export default {
        name: "Comments",

        components: {
            comment: Comment,
            addComment: AddComment
        },

        props: ['slug'],

        data(){
            return {
                slug: this.slug,
                loaded: false,
                comments: []
            }
        },

        methods: {
            viewComments(){
                this.loaded = true;
                axios.get(route('comments.index', {slug: this.slug}))
                    .then(({data}) => {
                        this.comments = data;
                    });
            },

            add(data){
                this.comments.push(data);
            }
        }
    }
</script>

<style scoped>

</style>
