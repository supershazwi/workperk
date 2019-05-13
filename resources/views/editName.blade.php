@extends ('layouts.main')

@section ('content')

<div class="py-5">
  <div class="container">
    @if (session('success'))
    <div class="form-group row" id="successAlert">
      <div class="col-sm-12">
        <div class="alert alert-success" style="text-align: center;">
          <p class="alert-heading" style="margin-bottom: 0;">Name successfully updated!</p>
        </div>
      </div>
    </div>
    @endif
    @if (session('error'))
      <div class="form-group row">
        <div class="col-sm-12">
          <div class="alert alert-danger" style="text-align: center;">
            <p class="alert-heading" style="margin-bottom: 0;">{{session('error')}}</p>
          </div>
        </div>
      </div>
    @endif
    <h2><a href="/profile" style="text-decoration: underline;">Profile</a> 
      <a href="/claim" style="margin-left: 1rem;">Claim Company</a> <a href="/companies/add-company" style="margin-left: 1rem;">Create Company</a> <a href="/jobs/add-job" style="margin-left: 1rem;">Create Job</a> <a href="/dashboard" style="margin-left: 1rem;">Dashboard</a>
    </h2>
    <p class="lead"><strong>Edit Name</strong></p>
    <br/>
    <form method="POST" action="/profile/edit-name">
      @csrf
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label"></label>
        <div class="col-sm-4">
          <button type="submit" class="btn btn-primary">Update Name</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script type="text/javascript">
  setTimeout(function(){ document.getElementById("successAlert").style.display = "none" }, 3000);
</script>
@endsection

@section ('footer')   
@endsection