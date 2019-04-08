@extends ('layouts.main')

@section ('content')

<div class="container">
  <div class="row align-items-center">
      <div class="col-lg-7" style="margin-bottom: 7.5rem;" id="colhangout">
        <h1 style="margin-top: 7.5rem; font-size: 2.5rem; margin-bottom: 2.5rem;" id="h1hangout">Employees value company culture more than anything</h1>
        <p>Users now expect to see a company’s culture even before looking at a job’s description.</p>
        <a href="/img/lets-change-the-world-together.png" style="display: none;" id="samplepic1">View Sample Profile</a>
      </div>
      <div class="col-lg-5" id="hangout">
        <img src="/img/winners.svg" style="width: 100%;"/>
      </div>
  </div>
</div>

<div class="container">
  <div class="row align-items-top">
      <div class="col-lg-6" id="hangout" style="margin-bottom: 7.5rem; padding: 1.5rem;">
        <a href="/img/lets-change-the-world-together.png"><img src="/img/lets-change-the-world-together.png" style="width: 100%; border-radius: 0.5rem;"/></a>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <h1 style="margin-top: 1.5rem; font-size: 2.5rem; margin-bottom: 2.5rem;">Give users a glimpse of your company's way of working</h1>
        <ul id="ulhangout" style="padding-left: 1.2rem;">
          <li>Stop wasting time on qualifying a candidate only to have him/her be incompatible with the company's culture</li>
          <li style="margin-top: 1rem;">Increase your team's productivity by attracting candidates who are in sync</li>
          <li style="margin-top: 1rem;">Offer something more than just a job description</li>
          <li style="margin-top: 1rem;">Employees tend to enjoy their work when their needs and values are in line with what is set in the company</li>
        </ul>
        <a href="/img/lets-change-the-world-together.png" style="display: none;" id="samplepic2">View Sample Profile</a>
      </div>
  </div>
</div>

@if(!Auth::id())
<div class="pt-7 pb-7 bg-dark">
  <div class="container-fluid">
    <div class="row justify-content-center text-center">
      <div class="col-md-10 col-lg-8 col-xl-6">
        
        <!-- Title -->
        <!-- <h1 class="display-3 text-center text-white">
          Plans & Pricing
        </h1> -->

        <h1 class="display-3 text-center text-white">
          Register to create your profile for free today
        </h1>

        <a href="/register" class="btn btn-primary mr-auto" style="margin-top: 1.5rem;">Register an account</a>
        
        <!-- Text -->
        <!-- <p class="lead text-center text-muted">
          We have plans and prices that fit your business perfectly. Make showcasing your culture a priority today.
        </p> -->

      </div>
    </div> <!-- / .row -->
  </div>
</div>
@endif

<!-- CONTENT -->
<!-- <div class="container-fluid">
  <div class="row mt--7">
    <div class="col-12 col-lg-4 offset-lg-2">
      
      <div class="card" style=" box-shadow: none !important;">
        <div class="card-body" style=" box-shadow: none !important;">
          
          <h6 class="text-uppercase text-center text-muted my-4">
            Basic plan
          </h6>
          
          <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-auto">
              <div class="h2 mb-0">$</div>
            </div>
            <div class="col-auto">
              <div class="display-2 mb-0">0</div>
            </div>
          </div> 
          
          <div class="h6 text-uppercase text-center text-muted">
            per month
          </div>

          <div class="text-center mb-5">
            <small style="color: transparent !important;">.</small>
          </div>

          <div class="mb-3">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                <small>Basic Profile</small> <i class="fe fe-check-circle text-success"></i>
              </li>
              <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                <small>Perks & Benefits Listing</small> <i class="fe fe-check-circle text-success"></i>
              </li>
              <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                <small>24/7 Support</small> <i class="fe fe-check-circle text-success"></i>
              </li>
            </ul>
          </div>

          <a href="#!" class="btn btn-block btn-light">
            Select Basic
          </a>

        </div>
      </div>

    </div>
    <div class="col-12 col-lg-4">
      
      <div class="card" style=" box-shadow: none !important;">
        <div class="card-body" style=" box-shadow: none !important;">
          
          <h6 class="text-uppercase text-center text-muted my-4">
            Premium plan
          </h6>
          
          Price
          <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-auto">
              <div class="h2 mb-0">$</div>
            </div>
            <div class="col-auto">
              <div class="display-2 mb-0">300</div>
            </div>
          </div> 
          
          <div class="h6 text-uppercase text-center text-muted">
            per month
          </div>

          <div class="text-center mb-5">
            <small>Save $600 if billed annually</small>
          </div>

          <div class="mb-3">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                <small>Premium Profile</small> <i class="fe fe-check-circle text-success"></i>
              </li>
              <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                <small>Culture Write-up</small> <i class="fe fe-check-circle text-success"></i>
              </li>
              <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                <small>Perks & Benefits Listing</small> <i class="fe fe-check-circle text-success"></i>
              </li>
              <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                <small>Unlimited Job Postings</small> <i class="fe fe-check-circle text-success"></i>
              </li>
              <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                <small>Auto-update of Premium Features</small> <i class="fe fe-check-circle text-success"></i>
              </li>
              <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                <small>24/7 Support</small> <i class="fe fe-check-circle text-success"></i>
              </li>
            </ul>
          </div>

          <a href="#!" class="btn btn-block btn-primary">
            Select Premium
          </a>

        </div>
      </div>

    </div>
  </div>
</div>
 -->
@endsection

@section ('footer')   
@endsection