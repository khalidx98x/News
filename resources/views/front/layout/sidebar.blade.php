<div class="col-12 col-lg-4">
    <div class="sidebar-area">

        <!-- Newsletter Widget -->
        <div class="newsletter-widget mb-70">
            <h4>Sign up to <br>our newsletter</h4>
            <form action="#" method="post">
                <input type="text" name="text" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <button type="submit" class="btn w-100">Subscribe</button>
            </form>
        </div>

        <!-- Trending Articles Widget -->
        <div class="treading-articles-widget mb-70">
            <h4>Trending Articles</h4>

          @foreach ($shareData['top_viewed'] as $item)
          <!-- Single Trending Articles -->
          <div class="single-blog-post style-4">
              <!-- Post Thumb -->
              <div class="post-thumb">
                  <a href="{{ url('/details') }}/{{ $item->slug }}"><img src="{{ asset('uploads/post') }}/{{ $item->main_image }}"  alt="{{ $item->title }}"></a>
                  <span class="serial-number">01.</span>
              </div>
              <!-- Post Data -->
              <div class="post-data">
                  <a  href="{{ url('/details') }}/{{ $item->slug }}" class="post-title">
                      <h6>{{$item->title}}</h6>
                  </a>
                  <div class="post-meta">
                      <p class="post-author">By <a href="{{ url('/author') }}/{{ $item->user->id }}">{{$item->user->name}}</a></p>
                  </div>
              </div>
          </div>
          @endforeach



        </div>

        <!-- Add Widget -->
        <div class="add-widget mb-70">
            <a href="#"><img src="img/bg-img/add.png" alt=""></a>
        </div>

        <!-- Latest Comments -->
        <div class="latest-comments-widget">
            <h4>Latest Comments</h4>

            @foreach ($shareData['comments'] as $comment)
            <!-- Single Comment Widget -->
            <div class="single-comments d-flex">
                <div class="comments-thumbnail">
                    <img src="{{ asset('uploads/others/user.png ')}} ">
                </div>
                <div class="comments-text">
                    <a href="#"><span>{{$comment->name}}</span> {{$comment->comment}}</a>
                    <p>{{ date('F j,Y',strtotime( $comment->created_at )) }}</p>
                </div>
            </div>

            @endforeach


        </div>

    </div>
</div>
