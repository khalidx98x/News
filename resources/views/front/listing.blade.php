@extends('front.layout.master')

@section('content')


<!-- ##### Viral News Breadcumb Area Start ##### -->
<div class="viral-news-breadcumb-area section-padding-50">
    <div class="container h-100">
        <div class="row h-100 align-items-center">

            <!-- Breadcumb Area -->
            <div class="col-12 col-md-4">
                <h3>{{$page_name}}</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('homepage')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$page_name}}</li>
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

<!-- ##### Blog Post Area Start ##### -->
<div class="viral-story-blog-post section-padding-0-50">


    @if (!count($posts) > 0)
<h2 class="text-center">No News yet !!</h2>
@else
<!-- Catagory Featured Post -->
<div class="catagory-featured-post section-padding-100">
    <div class="container">
        <div class="row">
            <!-- Catagory Thumbnail -->
            <div class="col-12 col-md-7">
                <div class="cata-thumbnail">
                    <a href="#"><img src="{{ asset('uploads/post') }}/{{ $posts[0]->main_image }}"  alt="{{ $posts[0]->title }}"></a>
                </div>
            </div>
            <!-- Catagory Content -->
            <div class="col-12 col-md-5">
                <div class="cata-content">
                    <a href="{{ url('/category') }}/{{ $posts[0]->category_id }}" class="post-catagory">{{$posts[0]->category->name}}</a>
                    <a href="{{ url('/details') }}/{{ $posts[0]->slug }}">
                        <h2>{{$posts[0]->title}}</h2>
                    </a>
                    <div class="post-meta">
                        <p class="post-author">By <a href="{{ url('/author') }}/{{ $posts[0]->user->id }}">{{$posts[0]->user->name}}</a></p>
                        <p class="post-date">{{ date('F j,Y',strtotime( $posts[0]->created_at )) }}</p>
                    </div>
                    <p class="post-excerp"> {{$posts[0]->short_description}}</p>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Blog Posts Area -->
        <div class="col-12 col-lg-8">
            <div class="row">


                <!-- Single Blog Post -->
                @foreach ($posts as $index => $post)

                @if($index!=0)
                    <!-- Single Blog Post -->
                    <div class="col-12 col-lg-6">
                        <div class="single-blog-post style-3">
                            <!-- Post Thumb -->
                            <div class="post-thumb">
                                <a href="{{ url('/details') }}/{{ $post->slug }}">
                                    <img src="{{ asset('uploads/post') }}/{{ $post->thumb_image }}"
                                  alt="{{ $post->title }}"></a>
                            </div>
                            <!-- Post Data -->
                            <div class="post-data">
                                <a href="{{ url('/category') }}/{{ $post->category->id }}" class="post-catagory">{{$post->category->name}}</a>
                                <a href="{{ url('/details') }}/{{ $post->slug }}" class="post-title">
                                    <h6>{{$post->title}}</h6>
                                </a>
                                <div class="post-meta">
                                    <p class="post-author">By <a href="{{ url('/author') }}/{{ $post->user->id }}">{{$post->user->name}}</a></p>
                                    <p class="post-date">{{ date('F j,Y',strtotime( $post->created_at )) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                @endforeach



            </div>

            <div class="row">
                <div class="col-12">
                    <div class="viral-news-pagination">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                              {{$posts->links()}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Area -->
        @include('front.layout.sidebar')
    </div>
</div>
    @endif


</div>

@endsection
