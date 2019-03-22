@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5><a href="/profile">Profile</a> <a href="/likes" style="margin-left: 1rem;">Likes</a> <span style="margin-left: 1rem; text-decoration: underline;">Comments</span></h5>
    <br/>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Comment</th>
          <th scope="col">Sub-perk</th>
          <th scope="col">Company</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>
        @foreach($comments as $key=>$comment)
        <tr>
          <th scope="row">{{$key+1}}</th>
          <td>{{$comment->content}}</td>
          <td><a href="/companies/{{$comment->companySubPerkDetail->company->slug}}/perks/{{$comment->companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$comment->companySubPerkDetail->subPerk->slug}}">{{$comment->companySubPerkDetail->subPerk->title}}</a></td>
          <td>{{$comment->companySubPerkDetail->company->name}}</td>
          <td>{{$comment->created_at->diffForHumans()}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

@section ('footer')   
@endsection