@extends ('layouts.main')

@section ('content')

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1>Know Your True Worth</h1>
  <p class="lead">Perks & benefits are ranked 2<sup>nd</sup> most important factor by job seekers<sup><a href="https://www.glassdoor.com/employers/blog/salary-benefits-survey/">*</a></sup></p>
  <div style="margin-top: 2.5rem;">
    @foreach($perks as $perk)
      <a href="/perks/{{$perk->slug}}" class="btn btn-sm btn-outline-primary" style="margin-bottom: 0.25rem;">{{$perk->title}}</a>
    @endforeach
  </div>
</div>

<div class="py-5 bg-light" style="margin-top: 6rem;">
  <div class="container">
    <p class="lead"><strong>Companies</strong></p>
    <div class="row">
      @foreach($companies as $company)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <a href="/companies/{{$company->slug}}"><p class="lead">{{$company->name}}</p></a>
            @foreach($company->perks as $perk)
              <span class="badge badge-light">{{$perk->title}}</span>
            @endforeach
            <p style="margin-bottom: 0rem; margin-top: 1rem;"><span class="badge badge-success">Value: ~$5,658</span></p>
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