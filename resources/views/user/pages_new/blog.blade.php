@extends('user.master_new')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Blog</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home" data-bs-original-title="" title=""> <svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg></a></li>
                        <li class="breadcrumb-item">Blog</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="app_blog">
        <div class="row">
            <div class="col-xl-6 set-col-12 box-col-12">
                <div class="card">
                    <div class="blog-box blog-shadow">
                        <a v-bind:href="'/home/blog-detail/' + blog1.id">
                            {{-- <img class="img-fluid" src="/user/assets/images/blog/blog.jpg" alt=""> --}}
                            <img class="img-fluid" v-bind:src="blog1.img" alt="">

                        </a>
                        <div class="blog-details">
                            <a v-bind:href="'/home/blog-detail/' + blog1.id">
                                <h4>@{{ blog1.title }}</h4>
                            </a>
                            <ul class="blog-social">
                                <li><i class="icofont icofont-thumbs-up"></i>02 Hits</li>
                                <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 set-col-12 box-col-12">
                <template v-for="(value, key) in blog23">
                    <div class="card">
                        <div class="blog-box blog-list row">
                            <div class="col-sm-5">
                                <a v-bind:href="'/home/blog-detail/' + value.id">
                                    {{-- <img class="img-fluid sm-100-w" src="/user/assets/images/blog/blog-2.jpg" alt=""> --}}
                                    <img class="img-fluid sm-100-w" v-bind:src="value.img" alt="">
                                </a>
                            </div>
                            <div class="col-sm-7">
                                <div class="blog-details pt-3">
                                    <a v-bind:href="'/home/blog-detail/' + value.id">
                                        <h6>@{{ value.title }}</h6>
                                    </a>
                                    <div class="blog-bottom-content">
                                        <ul class="blog-social">
                                            <li>by: Admin</li>
                                            <li>0 Hits</li>
                                        </ul>
                                        <hr>
                                        <p class="mt-0">@{{ getShortContent(value.short_description) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

            </div>
            <template v-for="(value, key) in listBlog">
                <div class="col-md-6 col-xl-3 box-col-6">
                    <div class="card">
                        <div class="blog-box blog-grid text-center">
                            {{-- <img class="img-fluid top-radius-blog" src="/user/assets/images/blog/blog-5.jpg" alt=""> --}}
                            <img class="img-fluid top-radius-blog" v-bind:src="value.img" alt="">
                            <div class="blog-details-main">
                                <ul class="blog-social">
                                    <li>29 May 2023</li>
                                    <li>by: Admin</li>
                                    <li>0 Hits</li>
                                </ul>
                                <hr>
                                <a v-bind:href="'/home/blog-detail/' + value.id">
                                    <h6 class="blog-bottom-details">@{{ getShortTitle(value.title) }}</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app_blog',
            data: {
                listBlog: [],
                blog1: {},
                blog23: [],
                blogsub: [],
            },
            created() {
                this.loadBlog();
            },
            methods: {
                loadBlog() {
                    axios
                        .get('/home/get-data-blog')
                        .then((res) => {
                            this.listBlog = res.data.data;
                            this.blog1 = this.listBlog[0];
                            this.blog23.push(this.listBlog[1], this.listBlog[2]);
                            console.log(this.blog1);
                            console.log(this.blog23);
                        });
                },
                getShortContent(content) {
                    var str = ((content.length < 60) ? content : ((content.slice(0, 60)) + '...'));
                    return str;
                },
                getShortTitle(content) {
                    var str = ((content.length < 40) ? content : ((content.slice(0, 40)) + '...'));
                    return str;
                },
            },

        });
    </script>
@endsection
