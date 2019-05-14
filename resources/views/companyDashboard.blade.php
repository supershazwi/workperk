@extends ('layouts.main')

@section ('content')

<div class="py-5">
  <div class="container">
    <h2><a href="/profile">Profile</a> <a href="/claim" style="margin-left: 1rem;">Claim Company</a> <a href="/companies/add-company" style="margin-left: 1rem;">Create Company</a> <a href="/jobs/add-job" style="margin-left: 1rem;">Create Job</a> <span style="text-decoration: underline; margin-left: 1rem;">Dashboard</span>
    </h2>
    <br/>
    @if(Auth::user()->company_id != null)
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
        <tr>
          <th scope="row">1</th>
          <td>{{$company->name}}</td>
          <td>{{$company->location->state}}, {{$company->location->country}}</td>
          <td><a href="/companies/{{$company->id}}/edit">Edit</a> | <a href="/companies/{{$company->slug}}">View</a></td>
        </tr>
      </tbody>
    </table>
    @else
    <div class="form-group row">
        <div class="col-sm-12">
          <div class="alert alert-warning" style="text-align: center;">
            <p class="alert-heading" style="margin-bottom: 0;">You have yet to claim a company or create a company. Please do so before adding a job.</p>
          </div>
        </div>
      </div>
    @endif
  </div>
</div>

@endsection

@section ('footer')   
@endsection