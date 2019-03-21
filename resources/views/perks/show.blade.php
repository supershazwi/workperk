@extends ('layouts.main')

@section ('content')

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1>{{$perk->title}}</h1>
  <p class="lead">{{$perk->description}}</p>
  <div style="margin-top: 2.5rem;">
    @foreach($perk->sub_perks as $subPerk)
      <a href="/sub-perks/{{$subPerk->slug}}" class="btn btn-sm btn-outline-primary" style="margin-bottom: 0.25rem;">{{$subPerk->title}}</a>
    @endforeach
  </div>
</div>

<div class="py-5 bg-light" style="margin-top: 6rem;">
  <div class="container">
    <p class="lead"><strong>Companies</strong></p>
    <div class="row">
      @foreach($perk->companies as $company)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <a href="/companies/{{$company->slug}}"><p class="lead">{{$company->name}}</p></a>
            <ul class="list-unstyled text-small" style="margin-bottom: 0rem !important;">
              <li style="margin-bottom: 0.5rem;">Training & Development <br> <span style="font-size: 0.875rem;">$700 - $1500/year</span></li>
              <li style="margin-bottom: 0.5rem;">Flexible Hours <br> <span style="font-size: 0.875rem;">2 - 8 hours/day</span></li>
              <li style="margin-bottom: 0.5rem;">Vacation Time <br> <span style="font-size: 0.875rem;">Unlimited</span></li>
              <li><span style="float: right; font-size: 0.875rem;">25 more</span></li>
            </ul>
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