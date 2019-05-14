@extends ('layouts.main')

@section ('content')
<div class="py-5">
  <div class="container">
    <div class="form-group row" id="emailSent" style="display: none;" >
      <div class="col-sm-12">
        <div class="alert alert-primary" style="text-align: center;">
          <p class="alert-heading" style="margin-bottom: 0;">We sent you an activation code. Check your email and click on the link to verify.</p>
        </div>
      </div>
    </div>
    <h2><span style="text-decoration: underline;">Profile</span> 
      @if(Auth::user()->company_id == 0)<a href="/claim" style="margin-left: 1rem;">Claim Company</a>@endif <a href="/companies/add-company" style="margin-left: 1rem;">Create Company</a> <a href="/jobs/add-job" style="margin-left: 1rem;">Create Job</a> <a href="/dashboard" style="margin-left: 1rem;">Dashboard</a>
    </h2>
    <br/>
    @if (session('verified'))
    <div class="form-group row" id="successAlert">
      <div class="col-sm-12">
        <div class="alert alert-primary" style="text-align: center;">
          <p class="alert-heading" style="margin-bottom: 0;">{{session('verified')}}</p>
        </div>
      </div>
    </div>
    @endif
    @if (session('status'))
    <div class="form-group row" id="successAlert">
      <div class="col-sm-12">
        <div class="alert alert-primary" style="text-align: center;">
          <p class="alert-heading" style="margin-bottom: 0;">{{session('status')}}</p>
        </div>
      </div>
    </div>
    @endif
    <div class="form-group row" id="uploadingAlert" style="display: none;">
      <div class="col-sm-12">
        <div class="alert alert-primary" style="text-align: center;">
          <p class="alert-heading" style="margin-bottom: 0;">Uploading avatar.</p>
        </div>
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 0rem;">
      <label for="staticEmail" class="col-sm-2 col-form-label">Avatar</label>
      <div class="col-sm-10">
        <div>
          @if(Auth::user()->provider != null)
          <img src="{{Auth::user()->avatar}}" alt="..." class="avatar-img" style="border-radius: 0.5rem; width: 96px; height: 96px;">
          @elseif(Auth::user()->avatar)
           <img src="https://storage.googleapis.com/talentail-123456789/{{Auth::user()->avatar}}" alt="..." class="avatar-img" style="border-radius: 0.5rem; width: 96px; height: 96px;">
          @else
          <img src="https://api.adorable.io/avatars/150/{{Auth::user()->email}}.png" alt="..." class="avatar-img" style="border-radius: 0.5rem; width: 96px; height: 96px;">
          @endif
        </div>
        <form method="POST" action="/profile" id="avatarForm" enctype="multipart/form-data">
          @csrf
          <input type="file" id="avatar" name="avatar" class="font-control-file" style="margin-top: 1rem;" onchange="uploadAvatar()"> 
          <button type="submit" style="display: none;" id="uploadAvatarButton">Submit</button> 
        </form>
        <small class="form-text text-muted">Please make sure it's a square!</small>
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 0rem;">
      <label for="staticName" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" id="staticName" value="{{Auth::user()->name}}"> <a href="/profile/edit-name">Edit Name</a>
      </div>
    </div>
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

  function uploadAvatar() {
    document.getElementById('uploadAvatarButton').click();
    document.getElementById('uploadingAlert').style.display = 'block';
  }
</script>

<script type="text/javascript">
  setTimeout(function(){ document.getElementById("successAlert").style.display = "none" }, 3000);
</script>
@endsection

@section ('footer')   
@endsection