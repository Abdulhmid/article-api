<!DOCTYPE HTML>
<html>
    <head>
        <title>Interior design Website Template | Home :: {{ config('app.name', 'Tokayu') }}</title>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"  media="all" />
        <link href="{{ asset('css/style2.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/tsc_carousel_hor.css') }}" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="{{ asset('js/modernizr.custom.28468.js') }}"></script>
    </head>
    <body>
        <!---start-wrap---->
        <!---start-header---->
          <div class="header">
            <div class="wrap">
                <div class="logo">
                    <a href="{!! url('/') !!}"><span>To</span>kayu</a>
                </div>
                <div class="social-icons">
                    <ul>
                        <li><a href="#"><img src="images/facebook.png" title="facebook" /></a></li>
                        <li><a href="#"><img src="images/twitter.png" title="twitter" /></a></li>
                        <li><a href="#"><img src="images/google.png" title="googlrpluse "/></a></li>
                        <li><a href="#"><img src="images/feed.png" title="Rssfeed" /></a></li>
                        <div class="clear"> </div>
                    </ul>
                </div>
                <div class="clear"> </div>
            </div>
        </div>
        <!---End-header---->
        <!-----start-content-slider---->
        <div class="content-slider">
            <div class="image-slider">
        <!----image-slider---->
         <div class="container">
            <div id="da-slider" class="da-slider">
                <div class="da-slide">
                    <h2>Easy management </h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <a href="#" class="da-link">Read more</a>
                    <div class="da-img"><img src="images/02.png" alt="image01" /></div>
                </div>
                <div class="da-slide">
                    <h2>Revolution</h2>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                    <a href="#" class="da-link">Read more</a>
                    <div class="da-img"><img src="images/02.png" alt="image01" /></div>
                </div>
                <div class="da-slide">
                    <h2>Warm welcome</h2>
                    <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.</p>
                    <a href="#" class="da-link">Read more</a>
                    <div class="da-img"><img src="images/03.png" alt="image01" /></div>
                </div>
                <div class="da-slide">
                    <h2>Quality Control</h2>
                    <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                    <a href="#" class="da-link">Read more</a>
                    <div class="da-img"><img src="images/02.png" alt="image01" /></div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.cslider.js"></script>
        <script type="text/javascript">
            $(function() {
            
                $('#da-slider').cslider({
                    autoplay    : true,
                    bgincrement : 450
                });
            
            });
        </script>   
        <!----end-image-slider---->
        </div>
        <div class="top-nav">
            <ul>
                <li class="item1"><a href="index.html">Home</a></li>
                <li class="item2"><a href="about.html">About</a></li>
                <li class="item3"><a href="services.html">Services</a></li>
                <li class="item4"><a href="products.html">Products</a></li>
                <li class="item5"><a href="contact.html">Contact</a></li>
            </ul>
        </div>
        <div class="clear"> </div>
        </div>
        <div class="clear"> </div>
        <div class="content">
            <div class="wrap">
            <div class="grids">
                <div class="grid1">
                    <span> </span>
                    <h3>Live Help</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.when an make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p>
                    <a href="#">ReadMore</a>
                </div>
                <div class="grid1 second-grid">
                    <span> </span>
                    <h3>Custom design</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.when an make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p>
                    <a href="#">ReadMore</a>
                </div>
                <div class="grid1 last-grid">
                    <span> </span>
                    <h3>Quality Control</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.when an make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p>
                    <a href="#">ReadMore</a>
                </div>
                <div class="clear"> </div>
            </div>
            </div>
        
        <div class="clear"> </div>
        <div class="wrap">
        <div class="new-deigns">
            <h3>Latest-Collections</h3>
        <!-- DC Horizontal Carousel:Light Start -->
        <div class="tsc_carousel_hor">
          <div class="l-carousel">
            <ul class="carousel">
                @foreach(QueryHelper::resultProduct() as $key => $value)
                    <li> 
                        <a href="#"><img src="{!! $value->image_thumbnail !!}" width="175" height="115" border="0" /></a>
                        <h4><a href="#">{!! $value->name !!}</a></h4>
                        <p>{!! $value->sub_name !!}</p>
                    </li>
                @endforeach
            </ul>
          </div>
          <div class="clear"> </div>
            <script type="text/javascript" src="{{ asset('js/tsc_jqcarousel.js') }}"></script>
            <script type="text/javascript">
              $(function() {jQuery('.tsc_carousel_hor .carousel').jcarousel({scroll:1});});
            </script>
        <!-- DC Horizontal Carousel:Light End -->
        </div>
        </div>
        </div>
        </div>
        <div class="clear"> </div>
        <div class="footer">
            <p> Admin <a href="http://tokayu.com/">Tokayu</a></p>
            <p style="display:none;">
                Design by & Thanks <a href="http://w3layouts.com/">
            W3layouts</a></p>
        </div>
        <!---End-wrap---->
    </body>
</html>
