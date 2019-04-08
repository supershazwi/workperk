@extends ('layouts.main')

@section ('content')

<div class="container">
  <div class="row align-items-center">
      <div class="col-lg-7" style="margin-bottom: 7.5rem;">
        <h1 style="margin-top: 7.5rem; font-size: 2.5rem; margin-bottom: 2.5rem;">Employees value company culture more than anything</h1>
        <p>Users now expect to see a company’s culture even before looking at a job’s description.</p>
        
      </div>
      <div class="col-lg-5" id="hangout">
        <img src="/img/winners.svg" style="width: 100%;"/>
      </div>
  </div>
</div>

<div class="pt-7 pb-8 bg-dark bg-ellipses">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-6">
        
        <!-- Title -->
        <h1 class="display-3 text-center text-white">
          Plans & Pricing
        </h1>
        
        <!-- Text -->
        <p class="lead text-center text-muted">
          We have plans and prices that fit your business perfectly. Make showcasing your culture a priority today.
        </p>

      </div>
    </div> <!-- / .row -->
  </div>
</div>

<!-- CONTENT -->
<div class="container-fluid">
  <div class="row mt--7">
    <div class="col-12 col-lg-4 offset-lg-2">
      
      <!-- Card -->
      <div class="card" style=" box-shadow: none !important;">
        <div class="card-body" style=" box-shadow: none !important;">
          
          <!-- Title -->
          <h6 class="text-uppercase text-center text-muted my-4">
            Basic plan
          </h6>
          
          <!-- Price -->
          <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-auto">
              <div class="h2 mb-0">$</div>
            </div>
            <div class="col-auto">
              <div class="display-2 mb-0">0</div>
            </div>
          </div> <!-- / .row -->
          
          <!-- Period -->
          <div class="h6 text-uppercase text-center text-muted">
            per month
          </div>

          <div class="text-center mb-5">
            <small style="color: transparent !important;">.</small>
          </div>

          <!-- Features -->
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

          <!-- Button -->
          <a href="#!" class="btn btn-block btn-light">
            Select Basic
          </a>

        </div>
      </div>

    </div>
    <div class="col-12 col-lg-4">
      
      <!-- Card -->
      <div class="card" style=" box-shadow: none !important;">
        <div class="card-body" style=" box-shadow: none !important;">
          
          <!-- Title -->
          <h6 class="text-uppercase text-center text-muted my-4">
            Premium plan
          </h6>
          
          <!-- Price -->
          <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-auto">
              <div class="h2 mb-0">$</div>
            </div>
            <div class="col-auto">
              <!-- <div class="display-2 mb-0"><span style="text-decoration: line-through;">300</span> 0</div> -->
              <div class="display-2 mb-0">300</div>
            </div>
          </div> <!-- / .row -->
          
          <!-- Period -->
          <div class="h6 text-uppercase text-center text-muted">
            per month
          </div>

          <div class="text-center mb-5">
            <small>Save $600 if billed annually</small>
          </div>

          <!-- Features -->
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

          <!-- Button -->
          <a href="#!" class="btn btn-block btn-primary">
            Select Premium
          </a>

        </div>
      </div>

    </div>
  </div> <!-- / .row -->
</div>

@endsection

@section ('footer')   
@endsection