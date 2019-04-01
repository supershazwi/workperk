@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <div class="form-group row" id="emailSent" style="display: none;" >
      <div class="col-sm-12">
        <div class="alert alert-primary" style="text-align: center;">
          <p class="alert-heading" style="margin-bottom: 0;">We sent you an activation code. Check your email and click on the link to verify.</p>
        </div>
      </div>
    </div>
    <h2><span style="text-decoration: underline;">Profile</span> <a href="/likes" style="margin-left: 1rem;">Likes</a> <a href="/comments" style="margin-left: 1rem;">Comments</a>

      @if(Auth::user()->email == "supershazwi@gmail.com")
        <a href="/dashboard" style="margin-left: 1rem;">Dashboard</a>
      @endif
    </h2>
    <br/>
    @if (session('verified'))
    <div class="form-group row" id="successAlert">
      <div class="col-sm-12">
        <div class="alert alert-success" style="text-align: center;">
          <p class="alert-heading" style="margin-bottom: 0;">{{session('verified')}}</p>
        </div>
      </div>
    </div>
    @endif
    <div class="form-group row" style="margin-bottom: 0rem;">
      <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{Auth::user()->email}}">
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 0rem;">
      <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <label for="inputPassword" class="col-sm-2 col-form-label" style="padding-left: 0rem;">
          <a href="/profile/edit-password">Edit Password</a>
        </label>
      </div>
    </div>
    @if(!Auth::user()->verified)
    <div class="form-group row" style="margin-bottom: 0rem;">
      <label for="inputPassword" class="col-sm-2 col-form-label">Status</label>
      <div class="col-sm-10">
        <label for="inputPassword" class="col-sm-2 col-form-label" style="padding-left: 0rem;">
          <a href="#" onclick="verifyAccount()" id="{{Auth::id()}}">Verify Account</a>
        </label>
      </div>
    </div>
    @endif
    <br/>
    <a class="btn btn-danger" href="/logout" style="margin-top: 1rem;">Logout</a>
  </div>
</div>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>

<script type="text/javascript">
  function verifyAccount() {
    event.preventDefault();

    let userId = event.target.id;

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    jQuery.ajax({
       url: "/user/verify-by-id/"+userId,
       method: 'post',
       data: {
          userId: userId
       },
       success: function(result){
          document.getElementById("emailSent").style.display = "block";
       }
     });
  } 
</script>

<script type="text/javascript">
  setTimeout(function(){ document.getElementById("successAlert").style.display = "none" }, 3000);
</script>
@endsection

@section ('footer')   
@endsection