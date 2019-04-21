@extends ('layouts.main')

@section ('content')

<div class="container">
  <div class="row align-items-center">
      <div class="col-lg-7" style="margin-bottom: 7.5rem;">
        <h1 style="margin-top: 7.5rem; font-size: 2.5rem; margin-bottom: 1rem;">Discover companies by their culture and perks</h1>
        <p>Click each one of the perk categories below or go straight to <a href="/find-companies"><i>Find Your Ideal Company</i></a></p>
        @foreach($perks as $perk)
          <a href="/perks/{{$perk->slug}}" class="btn btn-sm btn-primary" style="margin-bottom: 0.25rem;">{{$perk->title}}</a>
        @endforeach
      </div>
      <div class="col-lg-5" id="hangout">
        <img src="/img/hangout.svg" style="width: 100%;"/>
      </div>
  </div>
</div>

<div class="py-5">
  <div class="container">
    <p class="lead"><strong>All Companies</strong></p>
    <div class="row">
      @foreach($companies as $company)
      <div class="col-md-4">
        <div class="card mb-4" style="text-align: center; box-shadow: none !important;">
          <div class="card-body" style=" box-shadow: none !important;">
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" alt="" class="avatar-img rounded" style="width: 2.5rem; height: 2.5rem; margin-bottom: 0.25rem;">
            <a href="/companies/{{$company->slug}}"><p class="lead" style="margin-bottom: 0rem;">{{$company->name}}</p></a>
            <p style="margin-bottom: 0.5rem; font-size: 0.875rem;">{{$company->location->state}}, {{$company->location->country}}</p>
            @foreach($company->perks as $key=>$perk)
              @if($key < 3)
              <button class="btn btn-sm btn-primary" disabled style="margin-bottom: 0.25rem; font-size: 0.75rem;">{{$perk->title}}</button>
              @endif
            @endforeach
            @if(count($company->perks) > 3)
              <button class="btn btn-sm btn-primary" disabled style="margin-bottom: 0.25rem; font-size: 0.75rem;">+{{count($company->perks) - 3}} more</button>
            @endif
            <!-- <p style="margin-bottom: 0rem; margin-top: 0.5rem; font-size: 0.875rem;">Perks Value: 
              @if($company->value == 0)
              <span style="color: #16a085;">TBC</span>
              @else
              <span style="color: #16a085;">~${{number_format($company->value)}}</span>
              @endif
            </p> -->
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection

@section ('footer')   
@endsection