<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <title>
      @php $title = Cache::remember('title', 3600, function () { return \DB::table('system_settings')->first(); }); @endphp
      {{ $title->application_name; }} - Portfolio
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="EXILEDNONAME">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Teko:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/frontend/portfolio/main/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/frontend/portfolio/main/css/fontawesome-all.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/frontend/portfolio/main/css/animate.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/frontend/portfolio/main/css/hover.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/frontend/portfolio/main/css/jarallax.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/frontend/portfolio/main/css/custom-animate.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/frontend/portfolio/main/css/flaticon.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/frontend/portfolio/main/css/style.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/frontend/portfolio/main/css/responsive.css">
    <link rel="stylesheet" id="jssDefault" href="https://pixydrops.com/linoorhtml/css/colors/color-default.css">
    <link rel="shortcut icon" id="fav-shortcut" type="image/x-icon" href="{{ env('APP_URL') }}/assets/frontend/portfolio/main/images/favicon.png">
    <link rel="icon" href="{{ env('APP_URL') }}/assets/frontend/portfolio/main/images/favicon.png" id="fav-icon" type="image/x-icon">
  </head>

  <body>
    <div class="page-wrapper">
      <div class="preloader">
        <div class="icon"></div>
      </div>

      <section class="portfolio-masonary demo-gallery">
        <div class="auto-container">
          <div class="sec-title text-center"><h2> PORTFOLIOS </h2></div>
          <div class="portfolio-masonary__filter-wrapper mixitup-gallery justify-content-center">
            <ul class="filter-btns clearfix filters has-dynamic-filter-counter portfolio-masonary__filters">
              <li class="filter" data-role="button" data-filter=".all">All</li>
              <li class="filter" data-role="button" data-filter=".social-media"> Social Media </li>
              <li class="filter" data-role="button" data-filter=".photograph"> Photograph </li>
              <li class="filter" data-role="button" data-filter=".trip"> Trip </li>
            </ul>
          </div>

          <div class="row filter-list dynamic-filter-count-layout">

            <div class="col-md-6 col-lg-4 mix all social-media">
              <div class="portfolio-masonary__box-outer">
                <span class="portfolio-masonary__box__new"> New </span>
                <div class="portfolio-masonary__box">
                  <img width="370" height="426" src="{{ env('APP_URL') }}/assets/frontend/portfolio/main/images/demo-2.jpg" alt="">
                  <div class="portfolio-masonary__box-content">
                    <a target="_blank" href="https://smm.exilednoname.com/" class="link"><i class="flaticon-right-arrow"></i></a>
                    <p> SOCIAL MEDIA </p>
                    <h4><a target="_blank" href="https://smm.exilednoname.com/"> SOCIAL MEDIA MARKETING </a></h4>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 mix all photograph">
              <div class="portfolio-masonary__box-outer">
                <div class="portfolio-masonary__box">
                  <img width="370" height="426" src="{{ env('APP_URL') }}/assets/frontend/portfolio/main/images/demo-1.jpg" alt="">
                  <div class="portfolio-masonary__box-content">
                    <a target="_blank" href="{{ URL::Current() }}/photographs" class="link"><i class="flaticon-right-arrow"></i></a>
                    <p> PHOTOGRAPH </p>
                    <h4><a target="_blank" href="/demo-1"> PHOTOGRAPH & PORTFOLIO </a></h4>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 mix all trip">
              <div class="portfolio-masonary__box-outer">
                <span class="portfolio-masonary__box__new"> New </span>
                <div class="portfolio-masonary__box">
                  <img width="370" height="426" src="https://pixydrops.com/linoorhtml/images/update-15-08-2024/demo/home-12.jpg" alt="">
                  <div class="portfolio-masonary__box-content">
                    <a target="_blank" href="#" class="link"><i class="flaticon-right-arrow"></i></a>
                    <p> TRIP </p>
                    <h4><a target="_blank" href="#"> TRIP & ADVENTURE</a></h4>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

    </div>

    <a href="index.html#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>

    <script src="{{ env('APP_URL') }}/assets/frontend/portfolio/main/js/jquery.js"></script>
    <script src="{{ env('APP_URL') }}/assets/frontend/portfolio/main/js/popper.min.js"></script>
    <script src="{{ env('APP_URL') }}/assets/frontend/portfolio/main/js/bootstrap.min.js"></script>
    <script src="{{ env('APP_URL') }}/assets/frontend/portfolio/main/js/TweenMax.js"></script>
    <script src="{{ env('APP_URL') }}/assets/frontend/portfolio/main/js/wow.js"></script>
    <script src="{{ env('APP_URL') }}/assets/frontend/portfolio/main/js/mixitup.js"></script>
    <script src="{{ env('APP_URL') }}/assets/frontend/portfolio/main/js/jquery.easing.min.js"></script>
    <script src="{{ env('APP_URL') }}/assets/frontend/portfolio/main/js/jarallax.min.js"></script>
    <script src="{{ env('APP_URL') }}/assets/frontend/portfolio/main/js/custom-script.js"></script>

  </body>

</html>
