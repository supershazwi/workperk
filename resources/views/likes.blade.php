@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h2><a href="/profile">Profile</a> <span style="margin-left: 1rem; text-decoration: underline;">Likes</span> <a href="/comments" style="margin-left: 1rem;">Comments</a>
    @if(Auth::user()->email == "supershazwi@gmail.com")
        <a href="/dashboard" style="margin-left: 1rem;">Dashboard</a>
      @endif
    </h2>
    <br/>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Sub-perk</th>
          <th scope="col">Company</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>
        @foreach($likes as $key=>$like)
        <tr>
          <th scope="row">{{$key+1}}</th>
          <td><a href="/companies/{{$like->companySubPerkDetail->company->slug}}/perks/{{$like->companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$like->companySubPerkDetail->subPerk->slug}}">{{$like->companySubPerkDetail->subPerk->title}}</a></td>
          <td>{{$like->companySubPerkDetail->company->name}}</td>
          <td>{{$like->created_at->diffForHumans()}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

@section ('footer')   
@endsection