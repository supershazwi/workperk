@extends ('layouts.main')

@section ('content')
  <form method="POST" action="/find-companies" id="findCompaniesForm"> 
  @csrf
      <input type="hidden" id="clickedPerks" name="clickedPerks"/>
      <button type="submit" style="display: none;" id="findCompaniesButton">Submit</button>
  </form>

<div class="pricing-header text-center" style="margin-top: 3.5rem; margin-bottom: 3.5rem;">
  <h1 style="font-size: 2.5rem;">Find Your Ideal Company</h1>
  <p>Indicate perks that <span class="compulsory"><strong>matter</strong></span> to you</p>
</div>

<div class="container">
  @if (session('error'))
  <div class="form-group row" id="errorAlert">
    <div class="col-sm-12">
      <div class="alert alert-danger" style="text-align: center;">
        <p class="alert-heading" style="margin-bottom: 0;">{{session('error')}}</p>
      </div>
    </div>
  </div>
  @endif
  <div class="card" style=" box-shadow: none !important;">
    <div class="card-body" style="padding: 2.5rem; box-shadow: none !important;">
  <div class="row">
    <div class="col-lg-4" style="margin-bottom: 1rem; text-align: center;">
      @foreach($perks as $key=>$perk)
        @if($key % 3 == 0)
        <div style="margin-bottom: 1rem;">
          <h2 style="margin-bottom: 0.5rem;">{{$perk->title}}</h2>
          @foreach($perk->subPerks->sortBy('title') as $subPerk)
          <a href="#" onclick="toggleSubPerk()"><p style="margin-bottom: 0rem;" class="subperk" id="{{$subPerk->id}}">{{$subPerk->title}}</p></a>
          @endforeach
        </div>
        @endif
      @endforeach
    </div>  
    <div class="col-lg-4" style="margin-bottom: 1rem; text-align: center;">
      @foreach($perks as $key=>$perk)
        @if($key % 3 == 1)
        <div style="margin-bottom: 1rem;">
          <h2 style="margin-bottom: 0.5rem;">{{$perk->title}}</h2>
          @foreach($perk->subPerks->sortBy('title') as $subPerk)
          <a href="#" onclick="toggleSubPerk()"><p style="margin-bottom: 0rem;" class="subperk" id="{{$subPerk->id}}">{{$subPerk->title}}</p></a>
          @endforeach
        </div>
        @endif
      @endforeach
    </div>  
    <div class="col-lg-4" style="margin-bottom: 1rem; text-align: center;">
      @foreach($perks as $key=>$perk)
        @if($key % 3 == 2)
        <div style="margin-bottom: 1rem;">
          <h2 style="margin-bottom: 0.5rem;">{{$perk->title}}</h2>
          @foreach($perk->subPerks->sortBy('title') as $subPerk)
          <a href="#" onclick="toggleSubPerk()"><p style="margin-bottom: 0rem;" class="subperk" id="{{$subPerk->id}}">{{$subPerk->title}}</p></a>
          @endforeach
        </div>
        @endif
      @endforeach
    </div>  
  </div>
  <div class="row">
    <div class="col-lg-10 offset-lg-1">
      <button class="btn btn-block btn-primary" onclick="submitFindCompanies()" id="findCompanies" style="display: none;">Find Companies</button>
    </div>
  </div>
</div>
</div>
</div>


<script type="text/javascript">

  function toggleSubPerk() {
    event.preventDefault();

    if(event.target.className == "subperk") {
      event.target.className = "subperk compulsory";
    } else if(event.target.className == "subperk compulsory") {
      event.target.className = "subperk text-muted";
    } else if(event.target.className == "subperk text-muted") {
      event.target.className = "subperk compulsory";
    } 

    if(document.getElementsByClassName('subperk compulsory').length == 0) {
      tags = document.getElementsByClassName('subperk');

      for (var i = 0; i < tags.length; i++) {
          tags[i].className = "subperk";
      }

      document.getElementById("findCompanies").style.display = "none";
    } else {
      tags = document.getElementsByClassName('subperk');

      for (var i = 0; i < tags.length; i++) {
        if(tags[i].className == "subperk") {
          tags[i].className = "subperk text-muted";
        }
      }

      document.getElementById("findCompanies").style.display = "block";
    }

  }

  function submitFindCompanies() {
    event.preventDefault();

    let clickedPerks = document.getElementsByClassName("subperk compulsory");

    let clickedPerksArray = [];

    for (var i = 0; i < clickedPerks.length; i++) {
      clickedPerksArray.push(clickedPerks[i].id);
    }

    document.getElementById("clickedPerks").value = clickedPerksArray.toString();
    document.getElementById("findCompaniesButton").click();
  }

</script>

@endsection

@section ('footer')   
@endsection