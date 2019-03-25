@extends ('layouts.main')

@section ('content')

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1>{{$subPerk->title}} <sup><span class="badge badge-warning" style="font-size: 0.875rem;">Sub-perk</span></sup></h1>
  <p class="lead">{{$subPerk->description}}</p>
</div>

<div class="py-5 bg-light" style="margin-top: 6rem;">
  <div class="container">
    <p class="lead">Companies with <strong>{{$subPerk->title}} sub-perks</strong></p>
    <div class="row">
      @foreach($subPerk->companies as $company)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <a href="/companies/{{$company->slug}}"><p class="lead">{{$company->name}}</p></a>
            <p style="margin-bottom: 0rem; margin-top: 1rem; font-size: 0.875rem;">Perks Value: <span style="color: #16a085;">~${{number_format($company->value)}}</span></p>
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