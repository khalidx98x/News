<!-- Main Footer Area -->
<footer class="footer-area">
    <div class="main-footer-area">
        <div class="container">
            <div class="row">
    
                <!-- Footer Widget Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="footer-widget-area">
                        <!-- Footer Logo -->
                        <div class="footer-logo">
                            <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
                        </div>
                        <!-- Footer Nav -->
                        <div class="footer-nav">
                            <ul>
                                @foreach($shareData['categories'] as $category)
                                <li><a href="{{ url('/category') }}/{{ $category->id }}">{{ $category->name }}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
    
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Newsletter Widget -->
                    <div class="newsletter-widget">
                        <h4>Sign up to <br>our newsletter</h4>
                        <form action="#" method="post">
                            <input type="text" name="text" placeholder="Name">
                            <input type="email" name="email" placeholder="Email">
                            <button type="submit" class="btn w-100">Subscribe</button>
                        </form>
                    </div>
                </div>
    
                <!-- Footer Widget Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="footer-widget-area">
                        <!-- Widget Title -->
                        <h4 class="widget-title">Most viewed articles</h4>
    
                        @foreach ($shareData['top_viewed'] as $item)
                        <!-- Single Latest Post -->
                        <div class="single-blog-post style-2 d-flex align-items-center">
                            <!-- Post Thumb -->
                  <div class="post-thumb">
                      <a href="{{ url('/details') }}/{{ $item->slug }}"><img src="{{ asset('uploads/post') }}/{{ $item->main_image }}"  alt="{{ $item->title }}"></a>
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
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Footer Area -->
    <div class="bottom-footer-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Copywrite -->
                    <p><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </div>
    </footer>
    