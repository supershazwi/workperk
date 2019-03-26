@extends ('layouts.main')

@section ('content')

<input type="hidden" id="companySubPerkDetailId" value="{{$companySubPerkDetail->id}}" />
<input type="hidden" id="userId" value="{{Auth::id()}}" />

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1>{{$subPerk->title}}</h1>
  <p class="lead"><a href="/companies/{{$company->slug}}">{{$company->name}}</a> > {{$subPerk->perk->title}}</p>
  <div style="margin-top: 2.5rem;">
    @if(Auth::user())
    @if($likeClicked)
  	<a href="#" onclick="likeUnlike()" id="likeButton" class="btn btn-sm btn-primary" style="margin-bottom: 0.25rem;">{{count($companySubPerkDetail->likes)}} Likes</a>
    @else
    <a href="#" onclick="likeUnlike()" id="likeButton" class="btn btn-sm btn-outline-primary" style="margin-bottom: 0.25rem;">{{count($companySubPerkDetail->likes)}} Likes</a>
    @endif
    @else
    <a href="/login" class="btn btn-sm btn-outline-primary" style="margin-bottom: 0.25rem;">{{count($companySubPerkDetail->likes)}} Likes</a>
    @endif
  	<a href="/companies/{{$company->slug}}/perks/{{$companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$companySubPerkDetail->subPerk->slug}}/leave-comment" class="btn btn-sm btn-outline-primary" style="margin-bottom: 0.25rem;">Comment</a>
  </div>
</div>

@if(count($companySubPerkDetail->comments) != 0)
<div class="py-5 bg-light" style="margin-top: 6rem;">
  <div class="container">
    <p class="lead"><strong>{{count($companySubPerkDetail->comments)}} Comments</strong></p>
    <div class="row">
      @foreach($companySubPerkDetail->comments as $comment)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            @if(Auth::id() == $comment->user_id && $comment->user_id != 0)
            <a href="/companies/{{$company->slug}}/perks/{{$companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$companySubPerkDetail->subPerk->slug}}/comments/{{$comment->id}}"><p>{{$comment->content}}</p></a>
            @else
            <p>{{$comment->content}}</p>
            @endif
            @if($comment->user_id == 0)
            <footer class="blockquote-footer">Anonymous User, {{$comment->created_at->diffForHumans()}}</footer>
            @else
            @if($comment->anonymous) 
            @if(Auth::id() == $comment->user_id)
            <footer class="blockquote-footer">Anonymous User (You), {{$comment->created_at->diffForHumans()}}</footer>
            @else
            <footer class="blockquote-footer">Anonymous User, {{$comment->created_at->diffForHumans()}}</footer>
            @endif
            @else
            <footer class="blockquote-footer">{{$comment->user->name}}, {{$comment->created_at->diffForHumans()}}</footer>
            @endif
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@else
<div class="py-5 bg-light" style="margin-top: 6rem;">
  <div class="container">
    <p class="lead" style="margin-bottom: 0rem;"><strong>Share more details about this perk!</p>
  </div>
</div>
@endif
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>

<script type="text/javascript">
  function likeUnlike() {
    event.preventDefault();

    let className = event.target.className;
    let companySubPerkDetailId = document.getElementById("companySubPerkDetailId").value;
    let userId = document.getElementById("userId").value;

    

    if(className == 'btn btn-sm btn-primary') {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      // if i click this, it will like
      jQuery.ajax({
         url: "/company-sub-perk-detail/"+companySubPerkDetailId+"/unlike",
         method: 'post',
         data: {
            companySubPerkDetailId: companySubPerkDetailId,
            userId: userId
         },
         success: function(result){
          document.getElementById('likeButton').className = "btn btn-sm btn-outline-primary";
          let innerLikeValue = document.getElementById('likeButton').innerHTML;
          let innerLikeValueArray = innerLikeValue.split(" ");
          document.getElementById('likeButton').innerHTML = (parseInt(innerLikeValueArray[0]) - 1) + " Likes";
         }
       });
    } else {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      // if i click this, it will like
      jQuery.ajax({
         url: "/company-sub-perk-detail/"+companySubPerkDetailId+"/like",
         method: 'post',
         data: {
            companySubPerkDetailId: companySubPerkDetailId,
            userId: userId
         },
         success: function(result){
          document.getElementById('likeButton').className = "btn btn-sm btn-primary";
          let innerLikeValue = document.getElementById('likeButton').innerHTML;
          let innerLikeValueArray = innerLikeValue.split(" ");
          document.getElementById('likeButton').innerHTML = (parseInt(innerLikeValueArray[0]) + 1) + " Likes";
         }
       });
    }
   } 

</script>

@endsection

@section ('footer')   
@endsection