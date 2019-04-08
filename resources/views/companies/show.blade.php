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
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" style="border-radius: 0.5rem !important;" alt="..." class="avatar-img rounded-circle border border-4 border-body">
          </div>
          @if($company->premium)
          <span class="badge badge-secondary" style="display: block;">Premium</span>
          @endif

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
          
          <p style="margin-top: 0.5rem;">{{$company->description}}</p>
          <!-- @if($company->premium)
          <p style="margin-top: 0.5rem;">{{$company->description}}</p>
          @else
          <p style="margin-top: 0.5rem; width: 60%;">{{$company->description}}</p>
          @endif -->
        </div>
        @if($company->premium)

        @if($company->cover)
        <div class="col-auto" style="margin-top: 4rem;">
        @else
        <div class="col-auto">
        @endif
          <ul class="list-unstyled text-small" style="margin-bottom: 0rem !important;">
            @if($company->website)
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-globe-asia"></i> <a href="{{$company->website}}">Website</a></li>
            @endif
            @if($company->linkedin)
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-linkedin-square"></i> <a href="{{$company->linkedin}}">LinkedIn</a></li>
            @endif
            @if($company->facebook)
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-facebook-square"></i> <a href="{{$company->facebook}}">Facebook</a></li>
            @endif
            @if($company->instagram)
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-instagram"></i> <a href="{{$company->instagram}}">Instagram</a></li>
            @endif
            @if($company->twitter)
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-twitter-square"></i> <a href="{{$company->twitter}}">Twitter</a></li>
            @endif
            @if($company->youtube)
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-youtube-square"></i> <a href="{{$company->youtube}}">YouTube</a></li>
            @endif
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
      <div class="card" style="box-shadow: none !important;">
        <div class="card-body text-center" style="box-shadow: none !important;">
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
      <div class="card" style="box-shadow: none !important;">
        <div class="card-body text-center" style="box-shadow: none !important;">
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
      <div class="card" style="box-shadow: none !important;">
        <div class="card-body text-center" style="box-shadow: none !important;">
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
      <div class="card" style="box-shadow: none !important;">
        <div class="card-body text-center" style="box-shadow: none !important;">
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
      <div class="card" style="box-shadow: none !important;">
        <div class="card-body" style="box-shadow: none !important;">
          @foreach($cultureSubPerkDetails as $cultureSubPerkDetail)
            @if($cultureSubPerkDetail->subPerk->perk_id == 15)
            @if($loop->last)
            <div style="margin-bottom: 0rem !important;">
            @else
            <div style="margin-bottom: 1rem;">
            @endif
              <span style="font-size: 1.25rem; color: #dca419;">{{$cultureSubPerkDetail->subPerk->title}}</span>
              <!-- <p style="margin-top: 0.5rem; margin-bottom: 0rem;">{{$cultureSubPerkDetail->comment}}</p> -->
              @parsedown($cultureSubPerkDetail->comment)
              @if($cultureSubPerkDetail->image)
              <figure class="figure" style="text-align: center; margin-bottom: 0rem;">
                <img src="https://storage.googleapis.com/talentail-123456789/{{$cultureSubPerkDetail->image}}" class="figure-img img-fluid rounded" style="width: 100%; border-radius: 5px; margin-bottom: 0rem; margin-top: 1rem;"/>
              </figure>
              @endif
            </div>
            @endif
          @endforeach
        </div>
      </div>  
    </div>
    <div class="col-lg-3">
      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          <!-- PERKS VALUE <span style="color: #16a085;">~${{number_format($company->value)}}</span> -->
          PERKS
        </h5>
      </div>
      <div class="card" style="box-shadow: none !important;">
        <div class="card-body" style="box-shadow: none !important;">
          @foreach($filledPerks as $key=>$perk)
          @if(!$loop->last)
          <div style="margin-bottom: 1rem;">
          @else
          <div>
          @endif
            <h3 style="margin-bottom: 0.25rem;">{{$perk->title}}</h3>
            <table class="table table-borderless" style="margin-bottom: 0rem;">
              <tbody>
                @foreach($companySubPerkDetails as $companySubPerkDetail)
                  @if($companySubPerkDetail->subPerk->perk->id == $perk->id)
                    <tr>
                      <td style="padding: 0rem;">
                        @if($companySubPerkDetail->comment && $companySubPerkDetail->subPerk->perk_id != 15)
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
          @endforeach
        </div>
      </div>  
      @if($company->contact || $company->address)
      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          CONTACT DETAILS
        </h5>
      </div>
      <div class="card" style="box-shadow: none !important;">
        <div class="card-body" style="box-shadow: none !important;">
          <ul class="list-unstyled text-small" style="margin-bottom: 0rem !important;">
            @if($company->address)
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt"></i> {{$company->address}}</li>
            @endif
            @if($company->contact)
            <li style="margin-bottom: 0rem;"><i class="fas fa-phone"></i> {{$company->contact}}</li>
            @endif
          </ul>
        </div>
      </div>
      @endif
    </div>
  </div>
  @else
  <div class="row">
    <div class="col-lg-12">

      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          <!-- PERKS VALUE <span style="color: #16a085;">~${{number_format($company->value)}}</span> -->
          PERKS
        </h5>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3">
    @foreach($filledPerks as $key=>$perk)
      @if($key % 4 == 0)
      <div class="card" style="margin-bottom: 1rem; box-shadow: none !important;">
        <div class="card-body" style="box-shadow: none !important;">
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
      <div class="card" style="margin-bottom: 1rem; box-shadow: none !important;">
        <div class="card-body" style="box-shadow: none !important;">
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
      <div class="card" style="margin-bottom: 1rem; box-shadow: none !important;">
        <div class="card-body" style="box-shadow: none !important;">
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
      <div class="card" style="margin-bottom: 1rem; box-shadow: none !important;">
        <div class="card-body" style="box-shadow: none !important;">
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