<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-wrap p-lg-6">
                        <h2 class="mt-0 mb-4" v-text="post.title"></h2>
                        <p v-text="post.body"></p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    <ul class="list-group card-list-group">
                        <li class="list-group-item py-5">
                            <div class="media">
                                <div class="media-object avatar avatar-md mr-4" style="background-image: url(demo/faces/male/16.jpg)"></div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <small class="float-right text-muted">4 min</small>
                                        <h5>Peter Richards</h5>
                                    </div>
                                    <div>
                                        Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras
                                        justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus.
                                    </div>
                                    <ul class="media-list">
                                        <li class="media mt-4">
                                            <div class="media-object avatar mr-4" style="background-image: url(demo/faces/female/17.jpg)"></div>
                                            <div class="media-body">
                                                <strong>Debra Beck: </strong>
                                                Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus
                                                auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.
                                            </div>
                                        </li>
                                        <li class="media mt-4">
                                            <div class="media-object avatar mr-4" style="background-image: url(demo/faces/male/32.jpg)"></div>
                                            <div class="media-body">
                                                <strong>Jack Ruiz: </strong>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit
                                                amet risus.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item py-5">
                            <div class="media">
                                <div class="media-object avatar avatar-md mr-4" style="background-image: url(demo/faces/male/16.jpg)"></div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <small class="float-right text-muted">12 min</small>
                                        <h5>Peter Richards</h5>
                                    </div>
                                    <div>
                                        Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis
                                        parturient montes, nascetur ridiculus mus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item py-5">
                            <div class="media">
                                <div class="media-object avatar avatar-md mr-4" style="background-image: url(demo/faces/male/16.jpg)"></div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <small class="float-right text-muted">34 min</small>
                                        <h5>Peter Richards</h5>
                                    </div>
                                    <div>
                                        Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam
                                        venenatis vestibulum. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                    </div>
                                    <ul class="media-list">
                                        <li class="media mt-4">
                                            <div class="media-object avatar mr-4" style="background-image: url(demo/faces/male/26.jpg)"></div>
                                            <div class="media-body">
                                                <strong>Wayne Holland: </strong>
                                                Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus
                                                auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <textarea type="text" class="form-control" rows="6" placeholder="Write your comment"></textarea>
                        <!--                        <div class="input-group-append">-->
                        <!--                            <button type="button" class="btn btn-secondary">-->
                        <!--                                <i class="fe fe-camera"></i>-->
                        <!--                            </button>-->
                        <!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- comments -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Post Details</h4>
                </div>
                <table class="table card-table">
                    <tbody>
                    <tr>
                        <td><i class="fa fa-user text-muted"></i></td>
                        <td v-text=""><a href="/profile" v-text="post.user.name"></a></td>
                        <td class="text-right"><span class="text-muted">15%</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-list-alt text-muted"></i></td>
                        <td v-text=""><a href="/field" v-text="post.field.name[locale]"></a></td>
                        <td class="text-right"><span class="text-muted">15%</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-clock-o text-muted"></i></td>
                        <td v-text=""><a href="/field" v-text="post.created_at"></a></td>
                        <td class="text-right"><span class="text-muted">15%</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-list text-muted"></i></td>
                        <td v-text=""><a href="/field" v-text="post.type"></a></td>
                        <td class="text-right"><span class="text-muted">15%</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-eye text-muted"></i></td>
                        <td v-text="">100</td>
                        <td class="text-right"><span class="text-muted">15%</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-bell text-muted"></i></td>
                        <td v-text="">100</td>
                        <td class="text-right"><span class="text-muted">15%</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-trophy text-muted"></i></td>
                        <td v-text="">100</td>
                        <td class="text-right"><span class="text-muted">15%</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-heart text-muted"></i></td>
                        <td v-text="">100</td>
                        <td class="text-right"><span class="text-muted">15%</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-comment text-muted"></i></td>
                        <td v-text="">100</td>
                        <td class="text-right"><span class="text-muted">15%</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card">
                <div class="card-header">Actions</div>
                <div class="card-body">
                    <favorite></favorite>
                    <subscribe></subscribe>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <span class="avatar avatar-xxl mr-5" style="background-image: url(demo/faces/male/21.jpg)"></span>
                        <div class="media-body">
                            <h4 class="m-0">Juan Hernandez</h4>
                            <p class="text-muted mb-0">Webdeveloper</p>
                            <ul class="social-links list-inline mb-0 mt-2">
                                <li class="list-inline-item">
                                    <a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="1234567890"><i class="fa fa-phone"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="@skypename"><i class="fa fa-skype"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <span class="avatar avatar-xxl mr-5" style="background-image: url(demo/faces/male/21.jpg)"></span>
                        <div class="media-body">
                            <h4 class="m-0">Juan Hernandez</h4>
                            <p class="text-muted mb-0">Webdeveloper</p>
                            <ul class="social-links list-inline mb-0 mt-2">
                                <li class="list-inline-item">
                                    <a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="1234567890"><i class="fa fa-phone"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="@skypename"><i class="fa fa-skype"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Favorite from '../Favorite'
    import Subscription from '../Subscription'

    export default {
        name: 'Post',

        components: {
            favorite: Favorite,
            subscribe: Subscription
        },

        props: ['data'],

        data(){
            return {
                locale: Promentee.user.locale,
                post: this.data,
            }
        }
    }
</script>
