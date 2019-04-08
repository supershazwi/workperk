@extends ('layouts.main')

@section ('content')

<div class="py-5">
  <div class="container">
    <h2><a href="/profile">Profile</a> <a href="/claim" style="margin-left: 1rem;">Claim Company</a> <a href="/companies/add-company" style="margin-left: 1rem;">Create Company</a> <a href="/jobs/add-job" style="margin-left: 1rem;">Create Job</a> <span style="text-decoration: underline; margin-left: 1rem;">Dashboard</span>
    </h2>
    <br/>
    @if(count($companies) > 0)
    <table class="table bg-white">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Company</th>
          <th scope="col">Location</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($companies as $key=>$company)
        <tr>
          <th scope="row">{{$key+1}}</th>
          <td>{{$company->name}}</td>
          <td>{{$company->location->state}}, {{$company->location->country}}</td>
          <td><a href="/companies/{{$company->id}}/edit">Edit</a> | <a href="/companies/{{$company->slug}}">View</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
    <div class="card">
      <div class="card-body text-center" style="padding-top: 10rem; padding-bottom: 10rem;">
        <span style="font-size: 2.5rem;">🤨</span> 
        <h2 style="margin-bottom: 0rem;">You have yet to claim a company or create a company.</h2>
      </div>
    </div>
    @endif
  </div>
</div>

@endsection

@section ('footer')   
@endsection