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
                        <li class="breadcrumb-item">Blog Deatail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        @if (isset($blog))
            <div class="row">
                <div class="col-sm-12">
                    <div class="blog-single">
                        <div class="blog-box blog-details">
                            {{-- <img class="img-fluid w-100" src="/user/assets/images/blog/blog-single.jpg" alt="blog-main"> --}}
                            <img class="img-fluid w-100" src="{{$blog->img}}" alt="blog-main">
                            <div class="blog-details">
                                <ul class="blog-social">
                                    <li>25 July 2023</li>
                                    <li><i class="icofont icofont-thumbs-up"></i>02<span>Hits</span></li>
                                    <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                                </ul>
                                <h4>{{$blog->title}}</h4>
                                <div class="single-blog-content-top">
                                    {!! $blog->content !!}
                                </div>
                            </div>
                        </div>
                        <section class="comment-box">
                            <h4>Comment</h4>
                            <hr>
                            <ul>
                                <li>
                                    <div class="media align-self-center"><img class="align-self-center"
                                            src="/user/assets/images/blog/comment.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6 class="mt-0">Jolio Mark<span> ( Designer )</span></h6>
                                                </div>
                                                <div class="col-md-8">
                                                    <ul class="comment-social float-start float-md-end">
                                                        <li><i class="icofont icofont-thumbs-up"></i>02 Hits</li>
                                                        <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p>There are many variations of passages of Lorem Ipsum available, but the
                                                majority
                                                have suffered alteration in some form, by injected humour, or randomised
                                                words
                                                which don't look even slightly believable. If you are going to use a passage
                                                of
                                                Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
                                                the
                                                middle of text.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <div class="media"><img class="align-self-center"
                                                    src="/user/assets/images/blog/9.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <h6 class="mt-0">Jolio Mark<span> ( Designer )</span></h6>
                                                        </div>
                                                    </div>
                                                    <p>There are many variations of passages of Lorem Ipsum available, but
                                                        the
                                                        majority have suffered alteration in some form, by injected humour,
                                                        or
                                                        randomised words which don't look even slightly believable. If you
                                                        are
                                                        going to use a passage of Lorem Ipsum, you need to be sure there
                                                        isn't
                                                        anything embarrassing hidden in the middle of text.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="media"><img class="align-self-center" src="/user/assets/images/blog/4.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6 class="mt-0">Jolio Mark<span> ( Designer )</span></h6>
                                                </div>
                                                <div class="col-md-8">
                                                    <ul class="comment-social float-start float-md-end">
                                                        <li><i class="icofont icofont-thumbs-up"></i>02 Hits</li>
                                                        <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p>There are many variations of passages of Lorem Ipsum available, but the
                                                majority
                                                have suffered alteration in some form, by injected humour, or randomised
                                                words
                                                which don't look even slightly believable. If you are going to use a passage
                                                of
                                                Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
                                                the
                                                middle of text.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img class="align-self-center" src="/user/assets/images/blog/12.png" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6 class="mt-0">Jolio Mark<span> ( Designer )</span></h6>
                                                </div>
                                                <div class="col-md-8">
                                                    <ul class="comment-social float-start float-md-end">
                                                        <li><i class="icofont icofont-thumbs-up"></i>02 Hits</li>
                                                        <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p>There are many variations of passages of Lorem Ipsum available, but the
                                                majority
                                                have suffered alteration in some form, by injected humour, or randomised
                                                words
                                                which don't look even slightly believable. If you are going to use a passage
                                                of
                                                Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
                                                the
                                                middle of text.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img class="align-self-center" src="/user/assets/images/blog/14.png"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6 class="mt-0">Jolio Mark<span> ( Designer )</span></h6>
                                                </div>
                                                <div class="col-md-8">
                                                    <ul class="comment-social float-start float-md-end">
                                                        <li><i class="icofont icofont-thumbs-up"></i>02 Hits</li>
                                                        <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p>There are many variations of passages of Lorem Ipsum available, but the
                                                majority
                                                have suffered alteration in some form, by injected humour, or randomised
                                                words
                                                which don't look even slightly believable. If you are going to use a passage
                                                of
                                                Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
                                                the
                                                middle of text.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
@section('js')
@endsection
