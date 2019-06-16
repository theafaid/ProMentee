<template>
<!--    <li class="list-group-item py-5">-->
<!--        <div class="media">-->
<!--            <div class="media-object avatar avatar-md mr-4" style="background-image: url(demo/faces/male/16.jpg)"></div>-->
<!--            <div class="media-body">-->
<!--                <div class="media-heading">-->
<!--                    <small class="float-right text-muted">4 min</small>-->
<!--                    <h5>Peter Richards</h5>-->
<!--                </div>-->
<!--                <div>-->
<!--                    Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras-->
<!--                    justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Cum sociis natoque penatibus et magnis dis parturient montes,-->
<!--                    nascetur ridiculus mus.-->
<!--                </div>-->
<!--                <ul class="media-list">-->
<!--                    <li class="media mt-4">-->
<!--                        <div class="media-object avatar mr-4" style="background-image: url(demo/faces/female/17.jpg)"></div>-->
<!--                        <div class="media-body">-->
<!--                            <strong>Debra Beck: </strong>-->
<!--                            Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus-->
<!--                            auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="media mt-4">-->
<!--                        <div class="media-object avatar mr-4" style="background-image: url(demo/faces/male/32.jpg)"></div>-->
<!--                        <div class="media-body">-->
<!--                            <strong>Jack Ruiz: </strong>-->
<!--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit-->
<!--                            amet risus.-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </li>-->
    <li class="list-group-item py-5">
        <div class="media">
            <div class="media-object avatar avatar-md mr-4" style="background-image: url(demo/faces/male/16.jpg)"></div>
            <div class="media-body">
                <div class="media-heading">
                    <small class="float-right text-muted">12 min</small>
                    <h5>
                        <a href="/profile" v-text="comment.creator.name"></a>
                    </h5>
                </div>
                <div v-text="comment.body"></div>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        name: "Comment",

        props: ['data'],

        data(){
            return {
                comment: this.data
            }
        }
    }
</script>

<style scoped>

</style>
