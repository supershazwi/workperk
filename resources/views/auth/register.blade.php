<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Know the true worth of your job. Perks & benefits are ranked 2nd most important factor by job seekers.">
    <meta name="author" content="Shazwi Suwandi">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>WorkPerk - All company perks and benefits</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon-96x96.png">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


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
    <link href="/css/signin.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" style="text-align: center;">
      @csrf
      <a href="/" style="color: #212529;"><h5 class="my-0 mr-md-auto font-weight-normal" style="margin-bottom: 2.5rem !important;">Work<strong>Perk</strong><img class="mb-2" src="/img/logo.svg" alt="" width="24" height="24" style=" margin-left: 0.5rem;"></h5></a>
      <div class="form-group" style="text-align: left !important;">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Enter name" required>

        @if ($errors->has('name'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group" style="text-align: left !important;">
        <label for="email">Email address</label>
        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter email" required>

        @if ($errors->has('email'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group" style="text-align: left !important;">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

        @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group" style="text-align: left !important;">
        <label for="password-confirm">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>  

        
      </div>
      <button type="submit" class="btn btn-primary btn-block">Register an account</button>
      <p style="margin-top: 1rem; margin-bottom: 0rem;">By clicking 'Register an account', you agree to our <a href="#">Terms of Service</a>.</p>
      <a href="/login" class="btn btn-link btn-block">Login</a>
    </form>
  </body>
</html>