@extends ('layouts.main')

@section ('content')

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1>{{$perk->title}} <sup><span class="badge badge-primary" style="font-size: 0.875rem;">Perk</span></sup></h1>
  <p class="lead">{{$perk->description}}</p>
  <div style="margin-top: 2.5rem;">
    @foreach($perk->subPerks as $subPerk)
      <a href="/sub-perks/{{$subPerk->slug}}" class="btn btn-sm btn-warning" style="margin-bottom: 0.25rem;">{{$subPerk->title}}</a>
    @endforeach
  </div>
</div>

<div class="py-5 bg-light" style="margin-top: 6rem;">
  <div class="container">
    <p class="lead">Companies with <strong>{{$perk->title}} perks</strong></p>
    <div class="row">
      @foreach($perk->companies as $company)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" alt="" class="avatar-img rounded" style="width: 2.5rem; height: 2.5rem; margin-bottom: 0.25rem;">
            <a href="/companies/{{$company->slug}}"><p class="lead" style="margin-bottom: 0.5rem;">{{$company->name}}</p></a>
            @foreach($subPerks[$company->id] as $key=>$subPerk)
              @if($key < 3)
              <button class="btn btn-sm btn-warning" disabled style="margin-bottom: 0.25rem; font-size: 0.75rem;">{{$subPerk->title}}</button>
              @endif
            @endforeach
            @if(count($subPerks[$company->id]) > 3)
              <button class="btn btn-sm btn-warning" disabled style="margin-bottom: 0.25rem; font-size: 0.75rem;">+{{count($subPerks[$company->id]) - 3}} more</button>
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