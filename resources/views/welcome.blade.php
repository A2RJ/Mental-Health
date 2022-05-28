<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome-5.5/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('magnific-popup/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/tooplate-infinite-loop.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/select2/css/select2.min.css', ENV('SSL_FLAG')) }}">
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/select2/css/select2-bootstrap.min.css', ENV('SSL_FLAG')) }}">
  </head>

  <body>    
    <!-- Hero section -->
    <section id="infinite" class="text-white tm-font-big tm-parallax">
      <!-- Navigation -->
      <nav class="navbar navbar-expand-md tm-navbar" id="tmNav">              
        <div class="container">   
          <div class="tm-next">
              <a href="#" onclick="redirecPage('id')" class="navbar-brand">{{ env('APP_NAME') }}</a>
          </div>             
            
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars navbar-toggler-icon"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="#infinite">@lang('welcome.navbar.home')</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="#whatwedo">@lang('welcome.navbar.whatwedo')</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="#contact">@lang('welcome.navbar.contact')</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-{{ $flag }}"> </span> {{ $country }}</a>
                <div class="dropdown-menu" aria-labelledby="dropdown-lang">
                    <a class="dropdown-item" href="#" onclick="redirecPage('id')"><span class="flag-icon flag-icon-id"> </span> Indonesia</a>
                    <a class="dropdown-item" href="#" onclick="redirecPage('en')"><span class="flag-icon flag-icon-us"> </span> English</a>
                    <a class="dropdown-item" href="#" onclick="redirecPage('cn')"><span class="flag-icon flag-icon-cn"> </span> 中文（简体）</a>
                </div>
            </li>                    
            </ul>
          </div>        
        </div>
      </nav>
      
      <div class="text-center tm-hero-text-container">
        <div class="tm-hero-text-container-inner">
            <h2 class="tm-hero-title">@lang('welcome.title')</h2>
            <p class="tm-hero-subtitle">
              @lang('welcome.subtitle')
            </p>
        </div>        
      </div>

      <div class="tm-next tm-intro-next">
        <a href="#whatwedo" class="text-center tm-down-arrow-link">
          <i class="fas fa-2x fa-arrow-down tm-down-arrow"></i>
        </a>
      </div>      
    </section>

    <section id="whatwedo" class="tm-section-pad-top">
      
      <div class="container">

            <div class="row tm-content-box"><!-- first row -->
                <div class="col-lg-12 col-xl-12">
                    <div class="tm-intro-text-container">
                        <h2 class="text-dark mb-4 tm-section-title">@lang('welcome.whatwedo')
                          {{-- <a href="#" title=""><span class="fa fa-recycle"></span></a> --}}
                        </h2>
                    </div>
                </div>

                @if(Session::get('step') == null || Session::get('step') == '')
                  @include('step-1')

                @elseif(Session::get('step') == 'step-2')
                  @include('step-2')

                @elseif(Session::get('step') == 'step-3')
                  @include('step-3')

                @elseif(Session::get('step') == 'finish')
                  @include('step-4')
                @endif

            </div>

        </div>
      
    </section>
    
    <section id="testimonials" style="display: none;"></section>
    <section id="gallery" style="display: none;"></section>

    <!-- Contact -->
    <section id="contact" class="tm-section-pad-top tm-parallax-2">
    
      <div class="container tm-container-contact">
        
        <div class="row">
            
            <div class="text-center col-12">
                <h2 class="tm-section-title mb-4">@lang('welcome.navbar.contact')</h2>
                <p class="mb-5">
                  
                </p><br>
            </div>
            
            <div class="col-sm-12 col-md-6">
              <form action="#" method="get">
                <input id="name" name="name" type="text" placeholder="@lang('welcome.footer.email.name')" class="tm-input" required />
                <input id="email" name="email" type="email" placeholder="@lang('welcome.footer.email.email')" class="tm-input" required />
                <textarea id="message" name="message" rows="8" placeholder="@lang('welcome.footer.email.message')" class="tm-input" required></textarea>
                <button type="submit" class="btn tm-btn-submit">@lang('welcome.footer.email.submit')</button>
              </form>
            </div>
            
            <div class="col-sm-12 col-md-6">
                
                <div class="contact-item">
                  <a rel="nofollow" href="mailto:info@mental-tracker.com" class="item-link">
                      <i class="far fa-2x fa-envelope mr-4"></i>
                      <span class="mb-0">mental-tracker.com</span>
                  </a>              
                </div>
                
                <div class="contact-item">
                  <a rel="nofollow" href="https://www.google.com/maps" class="item-link">
                      <i class="fas fa-2x fa-map-marker-alt mr-4"></i>
                      <span class="mb-0">@lang('welcome.footer.location')</span>
                  </a>              
                </div>
                
                <div class="contact-item">
                  <a rel="nofollow" href="tel:0100200340" class="item-link">
                      <i class="fas fa-2x fa-phone-square mr-4"></i>
                      <span class="mb-0">255-662-5566</span>
                  </a>              
                </div>
                
                <div class="contact-item">&nbsp;</div>
            
            </div>
            
            
        </div><!-- row ending -->
        
      </div>

        <footer class="text-center small tm-footer">
          <p class="mb-0">
          Copyright &copy; {{ date('Y') }} Company Name 
        </footer>

    </section>
    
    <script src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('slick/slick.min.js') }}"></script>
    <script src="{{ asset('magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/easing.min.js') }}"></script>
    <script src="{{ asset('js/jquery.singlePageNav.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/select2/js/select2.min.js', ENV('SSL_FLAG')) }}"></script>
    <script>

      function getOffSet(){
        var _offset = 450;
        var windowHeight = window.innerHeight;

        if(windowHeight > 500) {
          _offset = 400;
        } 
        if(windowHeight > 680) {
          _offset = 300
        }
        if(windowHeight > 830) {
          _offset = 210;
        }

        return _offset;
      }

      function setParallaxPosition($doc, multiplier, $object){
        var offset = getOffSet();
        var from_top = $doc.scrollTop(),
          bg_css = 'center ' +(multiplier * from_top - offset) + 'px';
        $object.css({"background-position" : bg_css });
      }

      // Parallax function
      // Adapted based on https://codepen.io/roborich/pen/wpAsm        
      var background_image_parallax = function($object, multiplier, forceSet){
        multiplier = typeof multiplier !== 'undefined' ? multiplier : 0.5;
        multiplier = 1 - multiplier;
        var $doc = $(document);
        // $object.css({"background-attatchment" : "fixed"});

        if(forceSet) {
          setParallaxPosition($doc, multiplier, $object);
        } else {
          $(window).scroll(function(){          
            setParallaxPosition($doc, multiplier, $object);
          });
        }
      };

      var background_image_parallax_2 = function($object, multiplier){
        multiplier = typeof multiplier !== 'undefined' ? multiplier : 0.5;
        multiplier = 1 - multiplier;
        var $doc = $(document);
        $object.css({"background-attachment" : "fixed"});
        
        $(window).scroll(function(){
          if($(window).width() > 768) {
            var firstTop = $object.offset().top,
                pos = $(window).scrollTop(),
                yPos = Math.round((multiplier * (firstTop - pos)) - 186);              

            var bg_css = 'center ' + yPos + 'px';

            $object.css({"background-position" : bg_css });
          } else {
            $object.css({"background-position" : "center" });
          }
        });
      };
      
      function redirecPage(languages)
      {
        var url = "{{ \Request::url() }}/?lang=";
        window.location.replace(url+languages);
      }

      $(function(){
        // Hero Section - Background Parallax
        background_image_parallax($(".tm-parallax"), 0.30, false);
        background_image_parallax_2($("#contact"), 0.80);   
        background_image_parallax_2($("#testimonials"), 0.80);   
        
        // Handle window resize
        window.addEventListener('resize', function(){
          background_image_parallax($(".tm-parallax"), 0.30, true);
        }, true);

        // Detect window scroll and update navbar
        $(window).scroll(function(e){          
          if($(document).scrollTop() > 120) {
            $('.tm-navbar').addClass("scroll");
          } else {
            $('.tm-navbar').removeClass("scroll");
          }
        });

        // Close mobile menu after click 
        // $('#tmNav a').on('click', function(e){
        //   $('.navbar-collapse').removeClass('show'); 
        // });

        // Scroll to corresponding section with animation
        $('#tmNav').singlePageNav({
          'easing': 'easeInOutExpo',
          'speed': 600
        });        
        
        // Add smooth scrolling to all links
        // https://www.w3schools.com/howto/howto_css_smooth_scroll.asp
        $("a").on('click', function(event) {
          if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;

            $('html, body').animate({
              scrollTop: $(hash).offset().top
            }, 600, 'easeInOutExpo', function(){
              window.location.hash = hash;
            });
          } // End if
        });

        $('.select2').select2();
      });
    </script>
  </body>
</html>