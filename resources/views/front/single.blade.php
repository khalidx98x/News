@extends('front.layout.master')


@section('content')

<!-- ##### Viral News Breadcumb Area Start ##### -->
<div class="viral-news-breadcumb-area section-padding-50">
    <div class="container h-100">
        <div class="row h-100 align-items-center">

            <!-- Breadcumb Area -->
            <div class="col-12 col-md-4">
                <h3>Articles</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href=href="{{ url('/category') }}/{{ $post->category->id }}">{{$post->category->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
                    </ol>
                </nav>
            </div>

            <!-- Add Widget -->
            <div class="col-12 col-md-8">
                <div class="add-widget">
                    <a href="#"><img src="img/bg-img/add2.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Viral News Breadcumb Area End ##### -->

<!-- ##### Blog Area Start ##### -->
<div class="blog-area section-padding-100">
    <div class="container">
        @include('partials.messages')
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="blog-posts-area">

                    <!-- Single Featured Post -->
                    <div class="single-blog-post-details">
                        <div class="post-thumb">
                            <img src="{{ asset('uploads/post') }}/{{ $post->main_image }}" alt="">
                        </div>
                        <div class="post-data">
                            <a href="{{ url('/category') }}/{{ $post->category_id }}" class="post-catagory">{{$post->category->name}}</a>
                            <h2 class="post-title">{{$post->title}}</h2>
                            <div class="post-meta">

                                <!-- Post Details Meta Data -->
                                <div class="post-details-meta-data mb-50 d-flex align-items-center justify-content-between">
                                    <!-- Post Author & Date -->
                                    <div class="post-authors-date">
                                        <p class="post-author">By <a href="{{ url('/author') }}/{{ $post->user->id }}">{{$post->user->name}}</a></p>
                                        <p class="post-date">{{ date('F j,Y',strtotime( $post->created_at )) }}</p>
                                    </div>
                                    <!-- View Comments -->
                                    <div class="view-comments">
                                        <p class="views">{{$post->view_count}} views count</p>
                                        <a href="#comments" class="comments">{{$post->comments_count}} comments</a>
                                    </div>
                                </div>

                                {!!$post->description!!}
                             </div>
                        </div>

                    </div>

                    <!-- Related Articles Area -->
                    <div class="related-articles-">
                        <h4 class="mb-70">Related Articles</h4>

                        <div class="row">
                           @foreach ($related_news as $item)
                           <!-- Single Post -->
                           <div class="col-12">
                               <div class="single-blog-post style-3 style-5 d-flex align-items-center mb-50">
                                   <!-- Post Thumb -->
                                   <div class="post-thumb">
                                       <a "{{ url('/details') }}/{{ $item->slug }}"><img src="{{ asset('uploads/post') }}/{{ $item->thumb_image }}"
                                        alt="{{ $item->title }}"></a>
                                   </div>
                                   <!-- Post Data -->
                                   <div class="post-data">
                                    <a href="{{ url('/category') }}/{{ $item->category->id }}" class="post-catagory">{{$item->category->name}}</a>
                                    <a href="{{ url('/details') }}/{{ $item->slug }}" class="post-title">
                                        <h6>{{$item->title}}</h6>
                                    </a>
                                    <div class="post-meta">
                                        <p class="post-author">By <a href="{{ url('/author') }}/{{ $item->user->id }}">{{$item->user->name}}</a></p>
                                        <p class="post-date">{{ date('F j,Y',strtotime( $item->created_at )) }}</p>
                                    </div>
                                </div>
                               </div>
                           </div>

                           @endforeach

                        </div>
                    </div>
                    <!-- Comment Area Start -->
                    <div class="comment_area clearfix" id="comments">
                        @if ($post->comments_count <=0)
                        <h4 class="title mb-70">No comments </h4>
                        @else
                        <h4 class="title mb-70">{{$post->comments_count}} comment</h4>
                        <ol>
                            @foreach ($post->comments as $comment)
                            @if($comment->status === 1)
                            <!-- Single Comment Area -->
                            <li class="single_comment_area">
                                <!-- Comment Content -->
                                <div class="comment-content d-flex">
                                    <!-- Comment Author -->
                                    <div class="comment-author">
                                        <img  src="{{ asset('uploads/others/user.png ')}} ">
                                    </div>
                                    <!-- Comment Meta -->
                                    <div class="comment-meta">
                                        <a href="#" class="post-author">{{$comment->name}}</a>
                                        <a href="#" class="post-date">{{ date('F j,Y',strtotime( $comment->created_at )) }}</a>
                                        <p>{{$comment->comment}}</p>
                                    </div>
                                </div>
                            </li>
                            @endif

                            @endforeach

                              </ol>
                        @endif


                    </div>

                    <div class="post-a-comment-area">
                        <h4 class="mb-70">Leave a comment</h4>

                        <!-- Reply Form -->
                        <div class="contact-form-area">
                            <form action="{{route('postcomment.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name*">
                                    </div>

                                    <div class="col-12">
                                        <textarea  class="form-control" name="comment" id="comment" cols="30" rows="10" placeholder="Message"></textarea>
                                    </div>

                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <div class="col-12">
                                        <button class="btn viral-btn mt-30" type="submit">Submit Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            @include('front.layout.sidebar')
        </div>
    </div>
</div>
@endsection
