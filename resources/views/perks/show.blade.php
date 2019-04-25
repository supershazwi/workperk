@extends ('layouts.main')

@section ('content')

<div class="container">
<div class="pricing-header text-center" style="margin-top: 5rem; margin-bottom: 1.125rem;">
  <h1>{{$perk->title}} <sup><span class="badge badge-primary" style="font-size: 0.875rem;">Perk</span></sup></h1>
  <p>{{$perk->description}}</p>
</div>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="padding-top: 0.5rem !important; padding-bottom: 0rem !important;">
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
    @foreach($perk->subPerks->sortBy('title') as $subPerk)
      @if(count($subPerk->companies) > 0)
      <a href="/sub-perks/{{$subPerk->slug}}" class="btn btn-sm btn-warning" style="margin-bottom: 0.25rem;">{{$subPerk->title}}</a>
      @endif
    @endforeach
  </div>
  </div>
</div>
</div>

<div class="py-5" style="margin-top: 6rem;">
  <div class="container">
    <p class="lead">Companies with <strong>{{$perk->title}} perks</strong></p>
    <div class="row">
      @foreach($perk->companies as $company)
      @if($company->visible)
      <div class="col-md-4">
        <div class="card mb-4" style="text-align: center; box-shadow: none !important;">
          <div class="card-body" style=" box-shadow: none !important;">
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" alt="" class="avatar-img rounded" style="width: 2.5rem; height: 2.5rem; margin-bottom: 0.25rem;">
            <a href="/companies/{{$company->slug}}"><p class="lead" style="margin-bottom: 0rem;">{{$company->name}}</p></a>
            <p style="margin-bottom: 0.5rem; font-size: 0.875rem;">{{$company->location->state}}, {{$company->location->country}}</p>
            @foreach($subPerks[$company->id] as $key=>$subPerk)
              @if($key < 3)
              <button class="btn btn-sm btn-warning" disabled style="margin-bottom: 0.25rem; font-size: 0.75rem;">{{$subPerk->title}}</button>
              @endif
            @endforeach
            @if(count($subPerks[$company->id]) > 3)
              <button class="btn btn-sm btn-warning" disabled style="margin-bottom: 0.25rem; font-size: 0.75rem;">+{{count($subPerks[$company->id]) - 3}} more</button>
            @endif
            <!-- <p style="margin-bottom: 0rem; margin-top: 0.5rem; font-size: 0.875rem;">Perks Value: <span style="color: #16a085;">~${{number_format($company->value)}}</span></p> -->
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</div>

@endsection

@section ('footer')   
@endsection