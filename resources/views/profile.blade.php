@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5>My Profile</h5>
    <br/>
    <form>
      <div class="form-group row" style="margin-bottom: 0rem;">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{Auth::user()->email}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{Auth::user()->password}}">
        </div>
      </div>
    </form>
    <br/>
    <a class="btn btn-danger" href="/logout">Logout</a>
  </div>
</div>

@endsection

@section ('footer')   
@endsection