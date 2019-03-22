
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="WorkPerks - All company perks and benefits. Perks & benefits are ranked 2nd most important factor by job seekers.">
    <meta name="author" content="Shazwi Suwandi">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>WorkPerk - All company perks and benefits</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

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

        

    <form method="POST" action="{{ route('password.email') }}" class="form-signin" style="text-align: center;">
        @if (session('status'))
            <div class="alert alert-success" role="alert" style="margin-bottom: 2.5rem;">
                {{ session('status') }}
            </div>
        @endif
      @csrf
      <a href="/" style="color: #212529;"><h5 class="my-0 mr-md-auto font-weight-normal" style="margin-bottom: 2.5rem !important;">Work<strong>Perk</strong><img class="mb-2" src="/img/falling-star.svg" alt="" width="24" height="24" style="transform: rotate(180deg); margin-left: 0.5rem;"></h5></a>
      <div class="form-group" style="text-align: left !important;">
        <label for="exampleInputEmail1">Email address</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
    </form>
  </body>
</html>