@extends ('layouts.main')

@section ('content')

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1>{{$company->name}}</h1>
  <p class="lead">{{$company->description}}</p>
  <p class="lead" style="margin-bottom: 0rem;"><span class="badge badge-success">Value: ~$5,658</span></p>
</div>

<div class="py-5 bg-light" style="margin-top: 6rem;">
  <div class="container">
  	@foreach($company->perks as $perk)
    <p class="lead"><strong>{{$perk->title}}</strong> <a style="margin-left: 0.5rem; font-size: 1rem;" href="/companies/{{$company->slug}}/perks/{{$perk->slug}}/add-sub-perk">Add Sub-perk</a></p>
    <div class="row">
      @foreach($companySubPerkDetails as $companySubPerkDetail)
	      @if($companySubPerkDetail->subPerk->perk->id == $perk->id)
		      <div class="col-md-4">
		        <div class="card mb-4 shadow-sm">
		          <div class="card-body">
		            <a href="/companies/{{$companySubPerkDetail->company->slug}}/perks/{{$companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$companySubPerkDetail->subPerk->slug}}"><p class="lead" style="margin-bottom: 0.5rem;">{{$companySubPerkDetail->subPerk->title}}</p></a>
                <small class="badge badge-success">TBC</small> <span style="font-size: 0.875rem; margin-left: 0.5rem;">{{count($companySubPerkDetail->likes)}} Likes • {{count($companySubPerkDetail->comments)}} Comments</span>
		          </div>
		        </div>
		      </div>
	      @endif
      @endforeach
    </div>
    @if(!$loop->last)
    	<br/>
    @endif
    @endforeach
  </div>
</div>

@endsection

@section ('footer')   
@endsection