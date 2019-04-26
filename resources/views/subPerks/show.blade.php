@extends ('layouts.main')

@section ('content')
<div class="container">
<div class="pricing-header text-center" style="margin-top: 5rem; margin-bottom: 1.125rem;">
  <h1>{{$subPerk->title}} <sup><span class="badge badge-warning" style="font-size: 0.875rem;">Sub-perk</span></sup></h1>
  <p>{{$subPerk->description}}</p>
</div>
</div>

<div class="py-5" style="margin-top: 6rem;">
  <div class="container">
    <p class="lead">Companies with <strong>{{$subPerk->title}} sub-perks</strong></p>
    <div class="row">
      @foreach($subPerk->companies as $company)
      @if($company->visible)
      <div class="col-md-4">
        <div class="card mb-4" style="text-align: center; box-shadow: none !important;">
          <div class="card-body" style=" box-shadow: none !important;">
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" alt="" class="avatar-img rounded" style="width: 2.5rem; height: 2.5rem; margin-bottom: 0.25rem;">
            <a href="/companies/{{$company->slug}}"><p class="lead" style="margin-bottom: 0rem;">{{$company->name}}</p></a>
            @if($company->location->state == $company->location->country)
            <p style="margin-bottom: 0.5rem; font-size: 0.875rem;">{{$company->location->state}}</p>
            @else
            <p style="margin-bottom: 0.5rem; font-size: 0.875rem;">{{$company->location->state}}, {{$company->location->country}}</p>
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