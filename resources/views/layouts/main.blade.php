<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Know the additional worth of your job. Perks & benefits are ranked 2nd most important factor by job seekers.">
    <meta name="author" content="Shazwi Suwandi">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>WorkPerk - All company perks and benefits</title>

    <link rel="canonical" href="https://workperk.io">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon-96x96.png">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:title" content="WorkPerk - All company perks and benefits"/>
    <meta property="og:url" content="https://workperk.io/"/>
    <meta property="og:image" content="https://storage.googleapis.com/talentail-123456789/avatars/WhShxExFavx32thcM1zWLwdpjkwv9TreIK5fqrIn.png"/>
    <meta property="og:description" content="Know the additional worth of your job. Perks & benefits are ranked 2nd most important factor by job seekers."/>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="/css/pricing.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/masonry.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
    window.addEventListener("load", function(){
    window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "#007bff"
        },
        "button": {
          "background": "#fff",
          "text": "#007bff"
        }
      },
      "theme": "classic"
    })});
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-136900548-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-136900548-1');
    </script>

  </head>
  <body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=695661370849079&autoLogAppEvents=1"></script>
    <header>
      <div class="navbar navbar-white bg-transparent">
        <div class="container d-flex justify-content-between">
          <a href="/" style="color: #212529;"><h5 class="navbar-brand d-flex align-items-center">
            Work<strong>Perk</strong><img class="mb-2" src="/img/logo.svg" alt="" width="24" height="24" style="margin-left: 0.5rem;">
          </h5></a>
          <div>
            <a href="/find-companies" style="margin-right: 1rem;">Find Your Ideal Company</a>
            <a href="/companies/add-company" style="margin-right: 1rem;">Add Company</a>
            @if(Auth::id())
              @if(Auth::user()->email == "supershazwi@gmail.com")
                <a href="/dashboard" style="margin-right: 1rem;">Dashboard</a>
              @endif
              <!-- <a href="#" style="margin-right: 1rem;" onclick="showSelectCountry()">Singapore</a> -->
              @if(Auth::user()->verified)
              <a href="/profile">{{Auth::user()->name}}</a>
              @else
              <a href="/profile">{{Auth::user()->name}} <sup><span class="badge badge-light">Unverified</span></sup></a>
              @endif
            @else
              <!-- <button class="btn btn-link" onclick="showSelectCountry()">Singapore</button> -->
              <a class="btn btn-primary" href="/login">Login</a>
            @endif
          </div>
        </div>
      </div>
    </header>
    <div id="content">
      @yield('content')
      <div class="py-5 bg-white">
        <div class="container">
          <footer class="">
            <div class="row">
              <div class="col-12 col-md">
                <img class="mb-2" src="/img/logo.svg" alt="" width="24" height="24" style="">
                <small class="d-block mb-3 text-muted">&copy; 2019</small>
              </div>
              <div class="col-6 col-md">
                <h5>WorkPerk</h5>
                <ul class="list-unstyled text-small" style="margin-bottom: 0rem !important;">
                  <li><a class="text-muted" href="/about" style="font-size: 0.875rem;">About</a></li>
                  <li><a class="text-muted" href="/privacy-policy" style="font-size: 0.875rem;">Privacy Policy</a></li>
                  <li><a class="text-muted" href="/terms-conditions" style="font-size: 0.875rem;">Terms & Conditions</a></li>
                </ul>
              </div>
              <div class="col-6 col-md">
                <ul class="list-unstyled text-small" style="margin-bottom: 0rem !important;">
                  <li><a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-text="You should check out the work done at WorkPerk if you would like to explore companies by their perks and culture values!" data-url="https://www.workperk.io" data-via="hello_workperk" data-hashtags="knowuradditionalworth" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>
                  <li><div class="fb-share-button" data-href="https://workperk.io" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fworkperk.io%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div></li>
                </ul>
                
                
              </div>
              <div class="col-6 col-md">
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
    <!-- <div id="selectCountry" style="display: none; text-align: center;">
      <div class="py-5 bg-white">
        <div class="container">
          <div class="row">
            <div class="col-lg-12" style="margin-bottom: 2.5rem;">
              <a href="#" onclick="hideSelectCountry()"><h1><i class="fas fa-times"></i></h1></a>
            </div>
          </div>
          <div class="row">
            @foreach($locations as $location)
            <div class="col-lg-3" style="margin-bottom: 2.5rem;">
              <a href="#"><h2>{{$location->country}}</h2></a>
            </div>
            @endforeach
          </div>
          <div class="row">
            <div class="col-lg-12" style="margin-bottom: 2.5rem;">
              <a href="#" onclick="hideSelectCountry()"><h1><i class="fas fa-times"></i></h1></a>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <script src="/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>

    <script type="text/javascript">
        
        function showSelectCountry() {
          event.preventDefault();
          document.getElementById("content").style.display = "none";
          document.getElementById("selectCountry").style.display = "block";
        }

        function hideSelectCountry() {
          event.preventDefault();
          document.getElementById("content").style.display = "block";
          document.getElementById("selectCountry").style.display = "none";
        }

    </script>
  </body>
</html>