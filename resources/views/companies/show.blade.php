@extends ('layouts.main')

@section ('content')
<div class="header" style="margin-bottom: 0px;">

  <!-- Image -->
  <!-- <img src="/img/photo.jpg" class="header-img-top" alt="..."> -->
  <!-- <img src="/img/Zig-Zag.svg" class="header-img-top" alt="..."> -->

  @if($company->premium)
    @if($company->cover)
      <img src="https://storage.googleapis.com/talentail-123456789/{{$company->cover}}" class="header-img-top" alt="...">
    @endif
  @endif
  
  <div class="container">

    <!-- Body -->
    @if($company->premium)
      @if($company->cover)
      <div class="header-body mt--5 mt-md--6" style="border-bottom: 0px;">
      @else
        <div class="header-body" style="border-bottom: 0px;">
      @endif
    @else
        <div class="header-body" style="border-bottom: 0px;">
    @endif
      <div class="row">
        <div class="col-auto">
          
          <!-- Avatar -->
          <div class="avatar avatar-xxl header-avatar-top">
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" alt="..." class="avatar-img rounded-circle border border-4 border-body">
          </div>

        </div>
        @if($company->premium)
          @if($company->cover)
            <div class="col mb-3 ml--3 ml-md--2" style="margin-top: 4rem;">
          @else
            <div class="col mb-3 ml--3 ml-md--2">
          @endif
        @else
            <div class="col mb-3 ml--3 ml-md--2">
        @endif
          
          <!-- Pretitle -->
          <h5 class="header-pretitle">
            {{$company->type}}
          </h5>

          <!-- Title -->
          <h1 class="header-title">
            {{$company->name}}
          </h1>

          @if($company->premium)
          <p style="margin-top: 0.5rem;">{{$company->description}}</p>
          @else
          <p style="margin-top: 0.5rem; width: 60%;">{{$company->description}}</p>
          @endif
        </div>
        @if($company->premium)

        @if($company->cover)
        <div class="col-auto" style="margin-top: 4rem;">
        @else
        <div class="col-auto">
        @endif
          <ul class="list-unstyled text-small" style="margin-bottom: 0rem !important;">
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-globe-asia"></i> <a href="{{$company->website}}">Website</a></li>
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-facebook-square"></i> <a href="{{$company->linkedin}}">LinkedIn</a></li>
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-facebook-square"></i> <a href="{{$company->facebook}}">Facebook</a></li>
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-twitter-square"></i> <a href="{{$company->twitter}}">Twitter</a></li>
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-facebook-square"></i> <a href="{{$company->youtube}}">YouTube</a></li>
          </ul>
        </div>
        @endif
      </div> <!-- / .row -->
    </div> <!-- / .header-body -->

  </div>
</div>
@if($company->premium)
<div class="container">
  <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">

    <h5 class="header-pretitle">
      JOB OPPORTUNITIES
    </h5>
  </div>
  <div class="row">
    <div class="col-lg-3">
      <div class="card">
        <div class="card-body text-center">
          <h3 class="card-title">Master Technician</h3>
          <p class="card-text" style="margin-bottom: 0.25rem;">
            Singapore
          </p>
          <p class="card-text" style="margin-bottom: 0.5rem;">
            Full-time
          </p>
          <a href="#" class="btn btn-sm btn-primary">More Info</a>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card">
        <div class="card-body text-center">
          <h3 class="card-title">Technician</h3>
          <p class="card-text" style="margin-bottom: 0.25rem;">
            Singapore
          </p>
          <p class="card-text" style="margin-bottom: 0.5rem;">
            Full-time
          </p>
          <a href="#" class="btn btn-sm btn-primary">More Info</a>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card">
        <div class="card-body text-center">
          <h3 class="card-title">IT Administrator</h3>
          <p class="card-text" style="margin-bottom: 0.25rem;">
            Singapore
          </p>
          <p class="card-text" style="margin-bottom: 0.5rem;">
            Full-time
          </p>
          <a href="#" class="btn btn-sm btn-primary">More Info</a>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card">
        <div class="card-body text-center">
          <h3 class="card-title">Intern</h3>
          <p class="card-text" style="margin-bottom: 0.25rem;">
            Singapore
          </p>
          <p class="card-text" style="margin-bottom: 0.5rem;">
            Full-time
          </p>
          <a href="#" class="btn btn-sm btn-primary">More Info</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

<div class="container">
  
  @if($company->premium)
  <div class="row">
    <div class="col-lg-9">
      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          CULTURE
        </h5>
      </div>
      <div class="card">
        <div class="card-body">
          <div style="margin-bottom: 1rem;">
            <!-- <span style="font-size: 1.25rem; border-bottom: 5px solid #00cec9;">Employee First</span> -->
            <span style="font-size: 1.25rem; color: #dca419;">Employee First</span>
            <p style="margin-top: 0.5rem;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <figure class="figure" style="text-align: center; margin-bottom: 0rem;">
              <img src="https://scontent-sin6-2.xx.fbcdn.net/v/t1.0-9/55575833_10158253734831124_7278478457154043904_n.jpg?_nc_cat=103&_nc_ht=scontent-sin6-2.xx&oh=15fdddf146f06d924773568f30883fa6&oe=5D454ECF" class="figure-img img-fluid rounded" style="width: 100%; border-radius: 5px;"/>
              <figcaption class="figure-caption">Hanis learning how to xxx xxx.</figcaption>
            </figure>
          </div>
          <div style="margin-bottom: 1rem;">
            <span style="font-size: 1.25rem; color: #dca419;">Open to Ideas</span>
            <p style="margin-top: 0.5rem;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div style="margin-bottom: 0rem;">
            <span style="font-size: 1.25rem; color: #dca419;">Family Oriented</span>
            <p style="margin-top: 0.5rem;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <figure class="figure" style="text-align: center; margin-bottom: 0rem;">
              <img src="https://scontent-sin6-2.xx.fbcdn.net/v/t1.0-9/13690637_10154951204281124_8094295320057953484_n.jpg?_nc_cat=110&_nc_ht=scontent-sin6-2.xx&oh=5e6087a76e4d4594bf68019c0cd48a86&oe=5D44553E" class="figure-img img-fluid rounded" style="width: 100%; border-radius: 5px;"/>
              <figcaption class="figure-caption">Having our annual raya celebrations at Kamis' home.</figcaption>
            </figure>
          </div>
        </div>
      </div>  
    </div>
    <div class="col-lg-3">
      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          PERKS
        </h5>
      </div>
      <div class="card">
        <div class="card-body">
          <h3 style="margin-bottom: 0.5rem;">Food & Beverages</h3>
          <table class="table table-borderless" style="margin-bottom: 0rem;">
            <tbody>
              <tr>
                <td style="padding: 0rem;">Free Alcohol</td>
                <td style="padding: 0rem; float: right;">$1,150</td>
              </tr>
              <tr>
                <td style="padding: 0rem;">Free Meal Credits</td>
                <td style="padding: 0rem; float: right;">$3,150</td>
              </tr>
              <tr>
                <td style="padding: 0rem;">In-house Barista</td>
                <td style="padding: 0rem; float: right;">$1,200</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>  
      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          CONTACT DETAILS
        </h5>
      </div>
      <div class="card">
        <div class="card-body">
          <ul class="list-unstyled text-small" style="margin-bottom: 0rem !important;">
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt"></i> 115A Commonwealth Drive #05-07/08/09 Singapore 149596</li>
            <li style="margin-bottom: 0rem;"><i class="fas fa-phone"></i> 64744787 / 90406463</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="row">
    <div class="col-lg-12">

      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          PERKS <span style="color: #16a085;">~${{number_format($company->value)}}</span>
        </h5>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3">
    @foreach($filledPerks as $key=>$perk)
      @if($key % 4 == 0)
      <div class="card" style="margin-bottom: 1rem;">
        <div class="card-body">
          <h3 style="margin-bottom: 0.5rem;">{{$perk->title}}</h3>
          <table class="table table-borderless" style="margin-bottom: 0rem;">
            <tbody>
              @foreach($companySubPerkDetails as $companySubPerkDetail)
                @if($companySubPerkDetail->subPerk->perk->id == $perk->id)
              <tr>
                <td style="padding: 0rem;">
                  @if($companySubPerkDetail->comment)
                    <a href="#" class="comment" data-toggle="tooltip" data-placement="top" title="{{$companySubPerkDetail->comment}}" onclick="commentClick()">{{$companySubPerkDetail->subPerk->title}}</a>
                  @else
                    {{$companySubPerkDetail->subPerk->title}}
                  @endif
                </td>
                <td style="padding: 0rem; float: right;">
                  @if($companySubPerkDetail->subPerk->type == "currency")
                    @if($companySubPerkDetail->value == 0)
                      TBC
                    @else
                      ${{number_format($companySubPerkDetail->value)}}
                    @endif
                  @elseif($companySubPerkDetail->subPerk->type == "na")
                    <i class="fas fa-check"></i>
                  @elseif($companySubPerkDetail->subPerk->type == "number")
                    @if($companySubPerkDetail->value == 0)
                      TBC
                    @else
                    {{$companySubPerkDetail->value}} {{$companySubPerkDetail->subPerk->end}}
                    @endif
                  @endif
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 
      @endif
    @endforeach
    </div>
    <div class="col-lg-3">
    @foreach($filledPerks as $key=>$perk)
      @if($key % 4 == 1)
      <div class="card" style="margin-bottom: 1rem;">
        <div class="card-body">
          <h3 style="margin-bottom: 0.5rem;">{{$perk->title}}</h3>
          <table class="table table-borderless" style="margin-bottom: 0rem;">
            <tbody>
              @foreach($companySubPerkDetails as $companySubPerkDetail)
                @if($companySubPerkDetail->subPerk->perk->id == $perk->id)
              <tr>
                <td style="padding: 0rem;">
                  @if($companySubPerkDetail->comment)
                    <a href="#" class="comment" data-toggle="tooltip" data-placement="top" title="{{$companySubPerkDetail->comment}}" onclick="commentClick()">{{$companySubPerkDetail->subPerk->title}}</a>
                  @else
                    {{$companySubPerkDetail->subPerk->title}}
                  @endif
                </td>
                <td style="padding: 0rem; float: right;">
                  @if($companySubPerkDetail->subPerk->type == "currency")
                    @if($companySubPerkDetail->value == 0)
                      TBC
                    @else
                      ${{number_format($companySubPerkDetail->value)}}
                    @endif
                  @elseif($companySubPerkDetail->subPerk->type == "na")
                    <i class="fas fa-check"></i>
                  @elseif($companySubPerkDetail->subPerk->type == "number")
                    @if($companySubPerkDetail->value == 0)
                      TBC
                    @else
                    {{$companySubPerkDetail->value}} {{$companySubPerkDetail->subPerk->end}}
                    @endif
                  @endif
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 
      @endif
    @endforeach
    </div>
    <div class="col-lg-3">
    @foreach($filledPerks as $key=>$perk)
      @if($key % 4 == 2)
      <div class="card" style="margin-bottom: 1rem;">
        <div class="card-body">
          <h3 style="margin-bottom: 0.5rem;">{{$perk->title}}</h3>
          <table class="table table-borderless" style="margin-bottom: 0rem;">
            <tbody>
              @foreach($companySubPerkDetails as $companySubPerkDetail)
                @if($companySubPerkDetail->subPerk->perk->id == $perk->id)
              <tr>
                <td style="padding: 0rem;">
                  @if($companySubPerkDetail->comment)
                    <a href="#" class="comment" data-toggle="tooltip" data-placement="top" title="{{$companySubPerkDetail->comment}}" onclick="commentClick()">{{$companySubPerkDetail->subPerk->title}}</a>
                  @else
                    {{$companySubPerkDetail->subPerk->title}}
                  @endif
                </td>
                <td style="padding: 0rem; float: right;">
                  @if($companySubPerkDetail->subPerk->type == "currency")
                    @if($companySubPerkDetail->value == 0)
                      TBC
                    @else
                      ${{number_format($companySubPerkDetail->value)}}
                    @endif
                  @elseif($companySubPerkDetail->subPerk->type == "na")
                    <i class="fas fa-check"></i>
                  @elseif($companySubPerkDetail->subPerk->type == "number")
                    @if($companySubPerkDetail->value == 0)
                      TBC
                    @else
                    {{$companySubPerkDetail->value}} {{$companySubPerkDetail->subPerk->end}}
                    @endif
                  @endif
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 
      @endif
    @endforeach
    </div>
    <div class="col-lg-3">
    @foreach($filledPerks as $key=>$perk)
      @if($key % 4 == 3)
      <div class="card" style="margin-bottom: 1rem;">
        <div class="card-body">
          <h3 style="margin-bottom: 0.5rem;">{{$perk->title}}</h3>
          <table class="table table-borderless" style="margin-bottom: 0rem;">
            <tbody>
              @foreach($companySubPerkDetails as $companySubPerkDetail)
                @if($companySubPerkDetail->subPerk->perk->id == $perk->id)
              <tr>
                <td style="padding: 0rem;">
                  @if($companySubPerkDetail->comment)
                    <a href="#" class="comment" data-toggle="tooltip" data-placement="top" title="{{$companySubPerkDetail->comment}}" onclick="commentClick()">{{$companySubPerkDetail->subPerk->title}}</a>
                  @else
                    {{$companySubPerkDetail->subPerk->title}}
                  @endif
                </td>
                <td style="padding: 0rem; float: right;">
                  @if($companySubPerkDetail->subPerk->type == "currency")
                    @if($companySubPerkDetail->value == 0)
                      TBC
                    @else
                      ${{number_format($companySubPerkDetail->value)}}
                    @endif
                  @elseif($companySubPerkDetail->subPerk->type == "na")
                    <i class="fas fa-check"></i>
                  @elseif($companySubPerkDetail->subPerk->type == "number")
                    @if($companySubPerkDetail->value == 0)
                      TBC
                    @else
                    {{$companySubPerkDetail->value}} {{$companySubPerkDetail->subPerk->end}}
                    @endif
                  @endif
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 
      @endif
    @endforeach
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          LEGEND
        </h5>
      </div>
      <ul class="list-unstyled text-small" style="margin-bottom: 0rem !important;">
        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check"></i> - Available</li>
        <li style="margin-bottom: 0.5rem;">TBC - To be confirmed</a></li>
      </ul>
    </div>
  </div>
  @endif
</div>

<script type="text/javascript">
  function commentClick() {
    event.preventDefault();
  }
</script>
@endsection

@section ('footer')   
@endsection