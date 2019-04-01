@extends ('layouts.main')

@section ('content')
  <form method="POST" action="/find-companies" id="findCompaniesForm"> 
  @csrf
      <input type="hidden" id="clickedPerks" name="clickedPerks"/>
      <button type="submit" style="display: none;" id="findCompaniesButton">Submit</button>
  </form>

<div class="pricing-header text-center" style="margin-top: 3.5rem; margin-bottom: 3.5rem;">
  <h1>Find Your Ideal Company</h1>
  <h2>Indicate perks that <span class="compulsory"><strong>matter</strong></span> to you</h2>
</div>

<div class="container">
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
      <button class="btn btn-block btn-primary" onclick="submitFindCompanies()">Find Companies</button>
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
    } else {
      tags = document.getElementsByClassName('subperk');

      for (var i = 0; i < tags.length; i++) {
        if(tags[i].className == "subperk") {
          tags[i].className = "subperk text-muted";
        }
      }
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