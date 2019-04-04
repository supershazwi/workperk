@extends ('layouts.main')

@section ('content')

<div class="py-5">
  <div class="container">
    <h2><a href="/profile">Profile</a> <a href="/claim" style="margin-left: 1rem;">Claim Company</a> <a href="/companies/add" style="margin-left: 1rem;">Create Company</a> <span style="text-decoration: underline; margin-left: 1rem;">Dashboard</span>
    </h2>
    <br/>
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
          <td><a href="/companies/{{$company->id}}/edit">Edit</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <br/>
    <table class="table bg-white" style="margin-top: 1rem;">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Perk</th>
          <th scope="col">Description</th>
          <th scope="col">Sub-perk</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($perks as $key=>$perk)
        <tr>
          <th scope="row">{{$key+1}}</th>
          <td>{{$perk->title}}</td>
          <td>{{$perk->description}}</td>
          <td>{{count($perk->subPerks)}}</td>
          <td><a href="/perks/{{$perk->id}}/edit">Edit</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <br/>
    <a href="/perks/add-perk" class="btn btn-primary">Add Perk</a>
  </div>
</div>

@endsection

@section ('footer')   
@endsection