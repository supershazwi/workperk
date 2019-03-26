@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5>Leave Comment on {{$companySubPerkDetail->subPerk->title}} under {{$companySubPerkDetail->company->name}}</h5>
    <br/>
    <form method="POST" action="/companies/{{$companySubPerkDetail->company->slug}}/perks/{{$companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$companySubPerkDetail->subPerk->slug}}/comments/{{$comment->id}}">
      @csrf
      @if ($errors->has('content'))
        <div class="alert alert-danger">
            <ul style="margin-bottom: 0rem;">
                <li>You did not provide a comment.</li>
            </ul>
        </div>
      @endif
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Content</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="content" id="content" maxlength="280" rows="5" placeholder="e.g. Well what are you waiting for? Leave an awesome comment.">{{$comment->content}}</textarea>
        </div>
      </div>
      <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Post Anonymously</label>
          <div class="col-sm-10">
            @if($comment->anonymous)
            <input class="form-control" type="checkbox" name="anonymous" checked/>
            @else
            <input class="form-control" type="checkbox" name="anonymous" />
            @endif
          </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Submit Comment</button>
          <a href="/companies/{{$companySubPerkDetail->company->slug}}/perks/{{$companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$companySubPerkDetail->subPerk->slug}}/comments/{{$comment->id}}/delete-comment" class="btn btn-outline-danger">Delete Comment</a>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section ('footer')   
@endsection