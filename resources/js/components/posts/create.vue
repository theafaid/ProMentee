<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input v-model="form.title" type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea v-model="form.body" class="form-control" id=""></textarea>
                        </div>
                        <div class="form-group">
                            <select v-model="form.type">
                                <option value="advice">advice</option>
                                <option value="request">request</option>
                                <option value="idea">idea</option>
                                <option value="information">information</option>
                                <option value="other">advice</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select v-model="form.field_id">
                                <option v-for="field in f" :value="field">{{field}}</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click.prevent="publish()">Post</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "create",

        props: ['fields'],

        data(){
            return {
                f: JSON.parse(this.fields),
                form: new Form({
                    title: '',
                    body: '',
                    type: '',
                    field_id: ''
                })
            }
        },

        methods: {
            publish(){
                this.form.post(route('posts.store'))
                    .then(res => {
                        alert(res.data.msg);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
