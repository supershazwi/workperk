@extends ('layouts.main')

@section ('content')

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1>Know Your Job's Additional Worth</h1>
  <p class="lead">Perks & benefits are ranked 2<sup>nd</sup> most important factor by job seekers<sup><a href="https://www.glassdoor.com/employers/blog/salary-benefits-survey/">*</a></sup></p>
  <div style="margin-top: 2.5rem;">
    @foreach($perks as $perk)
      <a href="/perks/{{$perk->slug}}" class="btn btn-sm btn-primary" style="margin-bottom: 0.25rem;">{{$perk->title}}</a>
    @endforeach
  </div>
</div>

<div class="py-5 bg-light" style="margin-top: 6rem;">
  <div class="container">
    <p class="lead"><strong>All Companies</strong></p>
    <div class="row">
      @foreach($companies as $company)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm"style="text-align: center;">
          <div class="card-body">
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
            <p style="margin-bottom: 0rem; margin-top: 0.5rem; font-size: 0.875rem;">Perks Value: <span style="color: #16a085;">~${{number_format($company->value)}}</span></p>
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