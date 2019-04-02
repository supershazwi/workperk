<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="A platform for career newcomers or switchers to gain the necessary work experience by attempting real world projects.">

  <!-- Libs CSS -->
  <!-- build:css /fonts/feather/feather.min.css -->
  <link rel="stylesheet" href="/fonts/feather/feather.css">
  <!-- endbuild -->
  <link rel="stylesheet" href="/highlight.js/styles/vs2015.css">
  <link rel="stylesheet" href="/quill/dist/quill.core.css">
  <link rel="stylesheet" href="/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="/css/custom.css">
  <link rel="stylesheet" href="/flatpickr/dist/flatpickr.min.css">

  <link rel="stylesheet" type="text/css" href="/css/editormd.css" />

  <!-- Theme CSS -->
  <!-- build:css /css/theme.min.css -->
  <link rel="stylesheet" href="/css/theme.css" id="stylesheetLight">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <!-- endbuild -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

  <meta name="google-site-verification" content="OJantCXfGuTlfFzI5XMc9vihxeFMsqGDhFqiON_qcws" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
  
  <script>var colorScheme = 'light';</script>
  <title>WorkPerk</title>

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-136900548-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-136900548-1');
  </script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light" id="topnav">
    <div class="container">

      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Brand -->
      <a class="navbar-brand order-lg-first" href="/">
        Work<strong>Perk</strong><img class="mb-2" src="/img/logo.svg" alt="" width="24" height="24" style="margin-left: 0.5rem;">
      </a>

      
      <div class="navbar-user order-lg-last">
        @if(Auth::id())
          <div class="navbar-user">
            <!-- Dropdown -->
            <div class="dropdown">
          
              <!-- Toggle -->
              <a href="/profile" class="avatar avatar-sm" role="button">
                @if(Auth::user()->avatar)
                 <img src="https://storage.googleapis.com/talentail-123456789/{{Auth::user()->avatar}}" alt="..." class="avatar-img rounded-circle">
                @else
                <img src="https://api.adorable.io/avatars/150/{{Auth::user()->email}}.png" alt="..." class="avatar-img rounded-circle border border-4 border-body">
                @endif
              </a>

            </div>
          </div>
        @else
          <!-- <a class="btn btn-primary mr-auto" href="/login">
              Login
          </a> -->
        @endif
    </div>

      <!-- Collapse -->
      <div class="collapse navbar-collapse mr-auto" id="navbar">

        <!-- Navigation -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
               <a class="nav-link" href="/find-companies">
                 Find Your Ideal Company
               </a>
           </li>
        </ul>
      </div>

    </div> <!-- / .container -->
  </nav>
  <!-- <div class="main-content bg-fixed-bottom" style="background-image: url(/img/illustrations/sticky.svg);"> -->
  <div class="main-content">
    @yield('content')
    <div class="container">
      <div class="row" style="margin-top: 3.5rem; margin-bottom: 3.5rem;">
        <div class="col-12 col-lg-12">
          
          <!-- Card -->
          <div class="card card-inactive"  style="margin-bottom: 0rem;">
            <div class="card-body" style="background: white; border-radius: 0.5rem;">
                <div class="row">
                    <div class="col-lg-5">
                        <h3>WorkPerk</h3>
                        <p style="margin-bottom: 0; font-size: .875rem;">At WorkPerk, we make it easier for you to compare perks and cultural values across different companies so that you can find the right company to work at.</p>
                    </div>
                    <div class="col-lg-3">
                        <!-- <a target="_blank" href="https://www.instagram.com/talentail/"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" href="https://fb.me/talentail" style="margin-left: 0.5rem;"><i class="fab fa-facebook"></i></a> -->
                        <!-- <p class="" style="margin-top: .65rem; margin-bottom: 0; font-size: .875rem;">7 Temasek Boulevard</p> -->
                        <p class="" style="margin-bottom: 0; font-size: .875rem;">7 Temasek Boulevard</p>
                        <p class="" style="margin-bottom: 0; font-size: .875rem;">#12-07 Suntec Tower One</p>
                        <p class="" style="margin-bottom: 0; font-size: .875rem;">Singapore 038987</p>
                    </div>
                    <div class="col-lg-2">
                        <a href="/about" style="font-size: .875rem;">About</a><br />
                        <a href="/terms-and-conditions" style="font-size: .875rem;">Terms & Conditions</a><br />
                        <a href="/privacy-policy" style="font-size: .875rem;">Privacy Policy</a><br />
                    </div>
                </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div> <!-- / .main-content -->
  @include('scripts.javascript')
</body>
</html>