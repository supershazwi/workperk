@extends ('layouts.main')

@section ('content')

<div class="py-5">
  <div class="container">
    <h2><a href="/profile">Profile</a> <span style="text-decoration: underline; margin-left: 1rem;">Claim Company</span> <a href="/companies/add-company" style="margin-left: 1rem;">Create Company</a> <a href="/dashboard" style="margin-left: 1rem;">Dashboard</a>
    </h2>
    <p class="lead"><strong>All Companies</strong></p>
    <div class="row">
      @foreach($companies->sortBy('name') as $company)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm"style="text-align: center;">
          <div class="card-body">
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" alt="" class="avatar-img rounded" style="width: 2.5rem; height: 2.5rem; margin-bottom: 0.25rem;">
            <a href="/companies/{{$company->slug}}"><p class="lead" style="margin-bottom: 0rem;">{{$company->name}}</p></a>
            <p style="margin-bottom: 0.5rem; font-size: 0.875rem;">{{$company->location->state}}, {{$company->location->country}}</p>
            <button class="btn btn-sm btn-primary">Claim</button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection

@section ('footer')   
@endsection