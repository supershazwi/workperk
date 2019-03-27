@extends ('layouts.main')

@section ('content')
  <form method="POST" action="/find-companies" id="findCompaniesForm"> 
  @csrf
      <input type="hidden" id="clickedPerks" name="clickedPerks"/>
      <button type="submit" style="display: none;" id="findCompaniesButton">Submit</button>
  </form>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1>Find Your Ideal Company</h1>
  <p class="lead">Indicate perks that <span class="compulsory"><strong>matter</strong></span> to you</p>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-4" style="margin-bottom: 1rem; text-align: center;">
      @foreach($perks as $key=>$perk)
        @if($key % 3 == 0)
        <div style="margin-bottom: 1rem;">
          <strong>{{$perk->title}}</strong>
          @foreach($perk->subPerks->sortBy('title') as $subPerk)
          <a href="#" onclick="toggleSubPerk()"><p style="font-size: 0.875rem; margin-bottom: 0rem;" class="subperk" id="{{$subPerk->id}}">{{$subPerk->title}}</p></a>
          @endforeach
        </div>
        @endif
      @endforeach
    </div>  
    <div class="col-lg-4" style="margin-bottom: 1rem; text-align: center;">
      @foreach($perks as $key=>$perk)
        @if($key % 3 == 1)
        <div style="margin-bottom: 1rem;">
          <strong>{{$perk->title}}</strong>
          @foreach($perk->subPerks->sortBy('title') as $subPerk)
          <a href="#" onclick="toggleSubPerk()"><p style="font-size: 0.875rem; margin-bottom: 0rem;" class="subperk" id="{{$subPerk->id}}">{{$subPerk->title}}</p></a>
          @endforeach
        </div>
        @endif
      @endforeach
    </div>  
    <div class="col-lg-4" style="margin-bottom: 1rem; text-align: center;">
      @foreach($perks as $key=>$perk)
        @if($key % 3 == 2)
        <div style="margin-bottom: 1rem;">
          <strong>{{$perk->title}}</strong>
          @foreach($perk->subPerks->sortBy('title') as $subPerk)
          <a href="#" onclick="toggleSubPerk()"><p style="font-size: 0.875rem; margin-bottom: 0rem;" class="subperk" id="{{$subPerk->id}}">{{$subPerk->title}}</p></a>
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

<div class="py-5 bg-white" style="margin-top: 4rem;">
  <div class="container">
    
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