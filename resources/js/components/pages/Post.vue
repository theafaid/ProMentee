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
            <comments :slug="post.slug"></comments>
        </div>

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
                        <td v-text="post.viewsCount"></td>
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
                        <td v-text="post.favoritesCount"></td>
                        <td class="text-right"><span class="text-muted">15%</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-comment text-muted"></i></td>
                        <td v-text="post.commentsCount">100</td>
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
    import Comments from '../Comments'
    import Favorite from '../Favorite'
    import Subscription from '../Subscription'

    export default {
        name: 'Post',

        components: {
            comments: Comments,
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
