@extends('front.layout.master')


@section('content')
<!-- ##### recent news Start ##### -->
<div class="hero-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-slides owl-carousel">

                    @foreach ($recent_news as $item)
                    <!-- Single Blog Post -->
                    <div class="single-blog-post d-flex align-items-center mb-50">
                        <div class="post-thumb">
                            <a href="{{ url('/details') }}/{{ $item->slug }}"><img src="{{ asset('uploads/post') }}/{{ $item->main_image }}"  alt="{{ $item->title }}"></a>
                        </div>
                        <div class="post-data">
                            <a href="{{ url('/details') }}/{{ $item->slug }}" class="post-title">
                                <h6>{{$item->title}}</h6>
                            </a>
                            <div class="post-meta">
                                <p class="post-date"><a href="#">{{ date('F j,Y',strtotime( $item->created_at )) }}</a></p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</div>


<div class="welcome-slide-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="welcome-slides owl-carousel">

                    <!-- Single Welcome Slide -->
                    <div class="single-welcome-slide">
                        <div class="row no-gutters">

                         @foreach ($hot_news as $index=> $item)
                            @if ($index ==0 || $index % 3 ==0)
                            <div class="col-12 col-lg-8">
                                <!-- Welcome Post -->
                                <div class="welcome-post">
                                    <img src="{{ asset('uploads/post') }}/{{ $item->main_image }}"  alt="{{ $item->title }}">
                                    <div class="post-content" data-animation="fadeInUp" data-duration="500ms">
                                        <a href="{{ url('/category') }}/{{ $item->category->id }}" class="tag">{{$item->category->name}}</a>
                                        <a href="{{ url('/details') }}/{{ $item->slug }}" class="post-title">{{$item->title}}</a>
                                        <p>{{ date('F j,Y',strtotime( $item->created_at )) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">

                            @else

                                <div class="welcome-posts--">
                                    <!-- Welcome Post -->
                                    <div class="welcome-post style-2">
                                        <img src="{{ asset('uploads/post') }}/{{ $item->main_image }}"  alt="{{ $item->title }}">
                                        <div class="post-content" data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">
                                            <a href="{{ url('/category') }}/{{ $item->category->id }}" class="tag tag-2">{{$item->category->name}}</a>
                                            <a href="{{ url('/details') }}/{{ $item->slug }}" class="post-title">{{$item->title}}</a>
                                            <p>{{ date('F j,Y',strtotime( $item->created_at )) }}</p>
                                        </div>
                                    </div>


                                </div>
                                @if ($index % 2 ==0)
                            </div>

                                @endif
                            @endif
                         @endforeach

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>



<div class="viral-story-blog-post section-padding-0-50">
    <div class="container">
        <div class="row">
            <!-- Blog Posts Area -->
            <div class="col-12 col-lg-8">
                <div class="row">

                    @foreach ($posts as $index => $post)

                     <!-- Single Blog Post -->
                  <div class="col-12 col-lg-6">
                      <div class="single-blog-post style-3">
                          <!-- Post Thumb -->
                          <div class="post-thumb">
                              <a href="{{ url('/details') }}/{{ $post->slug }}"><img src="{{ asset('uploads/post') }}/{{ $post->thumb_image }}"
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
</div>



@endsection
