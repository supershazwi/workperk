@extends ('layouts.main')

@section ('content')

<div class="py-5">
  <div class="container">
    @if (session('claimed'))
    <div class="alert alert-primary" role="alert" style="text-align: center;" id="successAlert">
      <h4 class="alert-heading" style="margin-bottom: 0;">{{session('claimed')}}</h4>
    </div>
    @endif
    <h2><a href="/profile">Profile</a> @if(Auth::user()->company_id == 0)<span style="text-decoration: underline; margin-left: 1rem;">Claim Company</span>@endif <a href="/companies/add-company" style="margin-left: 1rem;">Create Company</a> <a href="/jobs/add-job" style="margin-left: 1rem;">Create Job</a> <a href="/dashboard" style="margin-left: 1rem;">Dashboard</a>
    </h2>
    @if(Auth::user()->company_id != 0)
    <p class="lead"><strong>Claimed Company</strong></p>
    <div class="row">
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm"style="text-align: center;">
          <div class="card-body">
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" alt="" class="avatar-img rounded" style="width: 2.5rem; height: 2.5rem; margin-bottom: 0.25rem;">
            <a href="/companies/{{$company->slug}}"><p class="lead" style="margin-bottom: 0rem;">{{$company->name}}</p></a>
            <p style="margin-bottom: 0.5rem; font-size: 0.875rem;">{{$company->location->state}}, {{$company->location->country}}</p>
            <form method="POST" action="/companies/{{$company->id}}/unclaim" enctype="multipart/form-data">
              @csrf
              <button class="btn btn-sm btn-danger" type="submit">Unclaim</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @else
    <p class="lead"><strong>All Companies</strong></p>
    <div class="row">
      @foreach($companies->sortBy('name') as $company)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm"style="text-align: center;">
          <div class="card-body">
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" alt="" class="avatar-img rounded" style="width: 2.5rem; height: 2.5rem; margin-bottom: 0.25rem;">
            <a href="/companies/{{$company->slug}}"><p class="lead" style="margin-bottom: 0rem;">{{$company->name}}</p></a>
            <p style="margin-bottom: 0.5rem; font-size: 0.875rem;">{{$company->location->state}}, {{$company->location->country}}</p>
            @if($company->user_id)
              @if($company->user_id == Auth::id())
            <form method="POST" action="/companies/{{$company->id}}/unclaim" enctype="multipart/form-data">
              @csrf
              <button class="btn btn-sm btn-danger" type="submit">Unclaim</button>
            </form>
              @else
            <button class="btn btn-sm btn-primary" disabled>Claimed</button>
            @endif
            @else
            <form method="POST" action="/companies/{{$company->id}}/claim" enctype="multipart/form-data">
              @csrf
              <button class="btn btn-sm btn-primary" type="submit">Claim</button>
            </form>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</div>
<script type="text/javascript">
  setTimeout(function(){ document.getElementById("successAlert").style.display = "none" }, 3000);
</script>
@endsection

@section ('footer')   
@endsection