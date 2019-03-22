@extends ('layouts.main')

@section ('content')

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" alt="" class="avatar-img rounded" style="width: 5rem; height: 5rem;">
  <h1>{{$company->name}}</h1>
  <p class="lead">{{$company->description}}</p>
  <p class="lead" style="margin-bottom: 0rem;">Value: <span style="color: #16a085;">~${{number_format($company->value)}}</span></p>
</div>

<div class="py-5 bg-light" style="margin-top: 6rem;">
  <div class="container">
  	@foreach($company->perks as $perk)
    <p class="lead"><strong>{{$perk->title}}</strong></p>
    <div class="row">
      @foreach($companySubPerkDetails as $companySubPerkDetail)
	      @if($companySubPerkDetail->subPerk->perk->id == $perk->id)
		      <div class="col-md-4">
		        <div class="card mb-4 shadow-sm">
		          <div class="card-body">
		            <a href="/companies/{{$companySubPerkDetail->company->slug}}/perks/{{$companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$companySubPerkDetail->subPerk->slug}}"><p class="lead" style="margin-bottom: 0.5rem;">{{$companySubPerkDetail->subPerk->title}}</p></a>
                <span style="font-size: 0.875rem; color: #16a085;">
                  @if($companySubPerkDetail->value == 0)
                    TBC
                  @else
                    ${{number_format($companySubPerkDetail->value)}}
                  @endif
                </span> <span style="font-size: 0.875rem; margin-left: 0.5rem;">{{count($companySubPerkDetail->likes)}} Likes • {{count($companySubPerkDetail->comments)}} Comments</span>
		          </div>
		        </div>
		      </div>
	      @endif
      @endforeach
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          <div class="card-body" style="text-align: center;">
            <a href="/companies/{{$company->slug}}/perks/{{$perk->slug}}/add-sub-perk"><i class="fas fa-plus" style="line-height: 3.9rem;"></i></a>
            <!-- <span style="font-size: 0.875rem;">test</span> -->
          </div>
        </div>
      </div>
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