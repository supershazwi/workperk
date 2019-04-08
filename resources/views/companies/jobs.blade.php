@extends ('layouts.main')

@section ('content')

<div class="py-5">
  <div class="container">
    <h2><a href="/dashboard">Dashboard</a> > {{$company->name}} > Edit Company</h2>
    <div class="row align-items-center" style="margin-top: -1.5rem;">
      <div class="col">
        
        <!-- Nav -->
        <ul class="nav nav-tabs nav-overflow header-tabs">
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit" class="nav-link ">
              Company Details
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit/perks-sub-perks" class="nav-link ">
              Perks, Sub-perks & Values
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit/culture" class="nav-link">
              Write-up On Culture
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit/jobs" class="nav-link active">
              Jobs Management
            </a>
          </li>
        </ul>
      </div>
    </div>
    <br/>
    <br/>
    <table class="table bg-white">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Type</th>
          <th scope="col">Level</th>
          <th scope="col">Location</th>
          <th scope="col">Visible</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($jobs as $key=>$job) 
          <tr>
            <th scope="row">{{$key+1}}</th>
            <td>{{$job->title}}</td>
            <td>{{$job->type}}</td>
            <td>{{$job->level}}</td>
            <td>{{$job->location->state}}, {{$job->location->country}}</td>
            @if($job->visible)
            <td>Public</td>
            @else
            <td>Hidden</td>
            @endif
            <td><a href="/jobs/{{$job->id}}/edit">Edit</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

@section ('footer')   
@endsection