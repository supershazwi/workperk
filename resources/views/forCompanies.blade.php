@extends ('layouts.main')

@section ('content')

<div class="container">
  <div class="row align-items-center">
      <div class="col-lg-7" style="margin-bottom: 7.5rem;" id="colhangout">
        <h1 style="margin-top: 7.5rem; font-size: 2.5rem; margin-bottom: 1rem;" id="h1hangout">Employees value company culture more than anything</h1>
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
      <div class="col-lg-6" id="hangout" style="margin-bottom: 0rem; padding: 1.5rem;">
        <a href="/img/lets-change-the-world-together.png"><img src="/img/lets-change-the-world-together.png" style="width: 100%; border-radius: 0.5rem;"/></a>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <h1 style="margin-top: 1.5rem; font-size: 2.5rem; margin-bottom: 1rem;">Give users a glimpse of your company's ways of working</h1>
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

<div class="container" style="margin-bottom: 3rem;">
  <div class="row align-items-top text-center">
      <div class="col-lg-8 offset-lg-2" style="margin-bottom: 0rem;">
        <h1 style="margin-top: 1.5rem; font-size: 2.5rem; margin-bottom: 1rem;">It's not about having the right culture because there isn't one.</h1>
        <p>It's about establishing <span class="compulsory"><strong>culture-fit</strong></span> between the company and its employees.</p>
      </div>
  </div>
</div>

@if(!Auth::id())
<div class="pt-7 pb-7 bg-dark">
  <div class="container-fluid">
    <div class="row justify-content-center text-center">
      <div class="col-md-10 col-lg-8 col-xl-6">
        
        <h1 class="display-3 text-center text-white">
          Register to create your profile for free today
        </h1>

        <a href="/register" class="btn btn-primary mr-auto" style="margin-top: 1.5rem;">Register an account</a>

      </div>
    </div> <!-- / .row -->
  </div>
</div>
@endif
@endsection

@section ('footer')   
@endsection