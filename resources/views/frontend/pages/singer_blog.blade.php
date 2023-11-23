@extends('frontend.layout')
@section('frontend-content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Blog Details</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Blog Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Single Blog Post Area -->
    <section class="singl-blog-post-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <!-- Blog Details Area -->
                    @if (!empty($single_blog))
                        <div class="blog-details-area mb-50">
                            <!-- Image -->
                            <img class="mb-30" src="{{ $single_blog->getImage() }}" alt="blog-img">

                            <!-- Blog Title -->
                            <h3 class="mb-30">{{ $single_blog->name }}</h3>

                            <!-- Bar Area -->
                            <div class="status-bar mb-15">
                                <a href="#"><i class="icofont-user-male"></i> Jannatun</a>
                                <a href="#"><i class="icofont-ui-clock"></i> 16 Sep, 19</a>
                                <a href="#"><i class="icofont-tags"></i> Handbags</a>
                                <a href="#"><i class="icofont-speech-comments"></i> 3 Comments</a>
                            </div>

                            {!! $single_blog->content !!}
                        </div>
                    @endif


                    <div class="comments-area">
                        <div class="comment_area mb-50 clearfix">
                            <h5 class="mb-4">3 Comments</h5>

                            <ol>
                                <!-- Single Comment Area -->
                                <li class="single_comment_area">
                                    <div class="comment-wrapper clearfix">
                                        <div class="comment-meta">
                                            <div class="comment-author-img">
                                                <img class="img-circle" src="img/partner-img/tes-1.png" alt="">
                                            </div>
                                        </div>
                                        <div class="comment-content">
                                            <h5 class="comment-author"><a href="#">Lim Jannat</a></h5>
                                            <p>This post is very helpful. I like your fashion tips. Keep up awesome job!</p>
                                            <a href="#" class="reply">Reply</a>
                                        </div>
                                    </div>
                                    <ul class="children">
                                        <li class="single_comment_area">
                                            <div class="comment-wrapper clearfix">
                                                <div class="comment-meta">
                                                    <div class="comment-author-img">
                                                        <img class="img-circle" src="img/partner-img/tes-2.png"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="comment-content">
                                                    <h5 class="comment-author"><a href="#">Nazrul Islam</a></h5>
                                                    <p>Thanks for your valuable feedback @Lim Jannat. Stay with us.</p>
                                                    <a href="#" class="reply">Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                <li class="single_comment_area">
                                    <div class="comment-wrapper d-flex clearfix">
                                        <div class="comment-meta">
                                            <div class="comment-author-img">
                                                <img class="img-circle" src="img/partner-img/tes-3.png" alt="">
                                            </div>
                                        </div>
                                        <div class="comment-content">
                                            <h5 class="comment-author"><a href="#">Naznin Ritu</a></h5>
                                            <p>Great post about treanding fashion 2019. Thank you.</p>
                                            <a href="#" class="reply">Reply</a>
                                        </div>
                                    </div>
                                    <ul class="children">
                                        <li class="single_comment_area">
                                            <div class="comment-wrapper clearfix">
                                                <div class="comment-meta">
                                                    <div class="comment-author-img">
                                                        <img class="img-circle" src="img/partner-img/tes-2.png"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="comment-content">
                                                    <h5 class="comment-author"><a href="#">Nazrul Islam</a></h5>
                                                    <p>Thanks for your valuable feedback @Naznin Ritu, Stay with us.</p>
                                                    <a href="#" class="reply">Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ol>
                        </div>

                        <div class="contact_from mb-50">
                            <h5 class="mb-4">Leave a Comment</h5>

                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group mb-30">
                                            <input type="text" class="form-control" name="author" value=""
                                                placeholder="Name" tabindex="1">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group mb-30">
                                            <input type="text" class="form-control" name="email" value=""
                                                placeholder="Email" tabindex="2">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-30">
                                            <input type="text" class="form-control" name="url" value=""
                                                placeholder="Website (Optional)" tabindex="3">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-30">
                                            <textarea class="form-control" name="comment" cols="30" rows="7" placeholder="Comment" tabindex="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Submit Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                </div>
            </div>
        </div>
    </section>
    <!-- Single Blog Post Area -->
@endsection
