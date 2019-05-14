@extends ('layouts.main')

@section ('content')

<form method="POST" action="/shoutouts/approve">
  @csrf
  <input type="hidden" name="shoutout_id" id="shoutoutId" />
  <input type="hidden" name="company_slug" value="{{$company->slug}}" />
  <button type="submit" style="display: none;" id="approveButton">Submit</button>
</form>


@if (!$company->visible)
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <div class="alert alert-warning text-center" style="margin-top: 1.5rem;">
        This company is currently hidden. 
        @if($company->user_id == Auth::id())
        <a href="/companies/{{$company->id}}/edit">Publicise it.</a>
        @endif
    </div>
  </div>
</div>
@endif

<div class="header" style="margin-bottom: 0px;">

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
            @if($company->cover)
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" style="border-radius: 0.5rem !important;" alt="..." class="avatar-img rounded-circle border border-4 border-body">
            @else
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" style="border-radius: 0.5rem !important;" alt="..." class="avatar-img rounded-circle border border-body">
            @endif
          </div>
          <!-- @if($company->premium)
          <span class="badge badge-secondary" style="display: block;">Premium</span>
          @endif -->

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
            @if($company->location->state == $company->location->country)
            {{$company->type}}, {{$company->location->state}}
            @else
            {{$company->type}}, {{$company->location->state}}, {{$company->location->country}}
            @endif
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
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-globe-asia"></i> <a href="{{$company->website}}" style="color: #6e84a3 !important;">Website</a></li>
            @endif
            @if($company->linkedin)
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-linkedin-square"></i> <a href="{{$company->linkedin}}" style="color: #6e84a3 !important;">LinkedIn</a></li>
            @endif
            @if($company->facebook)
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-facebook-square"></i> <a href="{{$company->facebook}}" style="color: #6e84a3 !important;">Facebook</a></li>
            @endif
            @if($company->instagram)
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-instagram"></i> <a href="{{$company->instagram}}" style="color: #6e84a3 !important;">Instagram</a></li>
            @endif
            @if($company->twitter)
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-twitter-square"></i> <a href="{{$company->twitter}}" style="color: #6e84a3 !important;">Twitter</a></li>
            @endif
            @if($company->youtube)
            <li style="margin-bottom: 0.5rem;"><i class="fab fa-youtube-square"></i> <a href="{{$company->youtube}}" style="color: #6e84a3 !important;">YouTube</a></li>
            @endif
          </ul>
        </div>
        @endif
      </div> <!-- / .row -->
    </div> <!-- / .header-body -->

  </div>
</div>
@if($company->premium && count($company->jobs) > 0)
<div class="container">
  <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">

    <h5 class="header-pretitle">
      JOB OPPORTUNITIES
    </h5>
  </div>
  <div class="row">
    @foreach($company->jobs as $job)
    @if($job->visible)
    <div class="col-lg-3">
      <div class="card" style="box-shadow: none !important;">
        <div class="card-body text-center" style="box-shadow: none !important;">
          <a href="/jobs/{{$job->id}}"><h3 class="card-title">{{$job->title}}</h3></a>
          <p class="card-text" style="margin-bottom: 0.25rem;">
            {{$job->location->state}}, {{$job->location->country}}
          </p>
          <p class="card-text" style="margin-bottom: 0rem;">
            {{$job->type}}
          </p>
        </div>
      </div>
    </div>
    @elseif(!$job->visible && $job->company->user_id == Auth::id())
    <div class="col-lg-3">
      <div class="card" style="box-shadow: none !important;">
        <div class="card-body text-center" style="box-shadow: none !important;">
          <a href="/jobs/{{$job->id}}"><h3 class="card-title">{{$job->title}}</h3></a>
          <span class="badge badge-danger" style="margin-bottom: 0.25rem;">Hidden</span>
          <p class="card-text" style="margin-bottom: 0.25rem;">
            {{$job->location->state}}, {{$job->location->country}}
          </p>
          <p class="card-text" style="margin-bottom: 0rem;">
            {{$job->type}}
          </p>
        </div>
      </div>
    </div>
    @endif
    @endforeach
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
        <div class="card-body" style="box-shadow: none !important; padding-bottom: 0.5rem;">
          @if(count($cultureSubPerkDetails) == 0 || $showCulturePerks == false)
          <div style="margin-bottom: 1rem !important;" class="text-center">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <span class="fe fe-alert-octagon mr-4" style="font-size: 2.5rem !important;"></span>
                <p style="margin-bottom: 0rem;">Are you from {{$company->name}}? We'd be a ton grateful if you register with us, claim this page and complete the profile.</p>
              </div>
            </div>
          </div>
          @else
          @foreach($cultureSubPerkDetails as $cultureSubPerkDetail)
            @if($cultureSubPerkDetail->subPerk->perk_id == 15)
            @if($loop->last)
            <div style="margin-bottom: 1rem !important;">
            @else
            <div style="margin-bottom: 1rem;">
            @endif
              <span style="font-size: 1.25rem; color: #dca419; font-weight: bold;">{{$cultureSubPerkDetail->subPerk->title}}</span>
              <!-- <h1 style="color: #dca419;">{{$cultureSubPerkDetail->subPerk->title}}</h1> -->
              <!-- <p style="margin-top: 0.5rem; margin-bottom: 0rem;">{{$cultureSubPerkDetail->comment}}</p> -->
              <div style="margin-top: 0.5rem; margin-bottom: 0rem;">
                @parsedown($cultureSubPerkDetail->comment)
              </div>
              <!-- @if($cultureSubPerkDetail->image)
              <figure class="figure" style="text-align: center; margin-bottom: 0rem;">
                <img src="https://storage.googleapis.com/talentail-123456789/{{$cultureSubPerkDetail->image}}" class="figure-img img-fluid rounded" style="width: 100%; border-radius: 5px; margin-bottom: 0rem; margin-top: 0.5rem;"/>
              </figure>
              @endif -->

              @if(count($cultureSubPerkDetail->cultureImages) == 1)
                <figure class="figure" style="text-align: center; margin-bottom: 0rem;">
                  <img src="https://storage.googleapis.com/talentail-123456789/{{$cultureSubPerkDetail->image}}" class="figure-img img-fluid rounded" style="width: 100%; border-radius: 5px; margin-bottom: 0rem; margin-top: 0.5rem;"/>
                </figure>
              @elseif(count($cultureSubPerkDetail->cultureImages) > 0)
                <div class="row" style="padding-left: 9.5px; padding-right: 9.5px;">
                  @foreach($cultureSubPerkDetail->cultureImages as $cultureImage)
                  <div class="col-lg-3" style="height: 190px; padding: 2.5px;">
                    
                    <a href="https://storage.googleapis.com/talentail-123456789/{{$cultureImage->url}}" class="thumbnail gallery">
                      <img src="https://storage.googleapis.com/talentail-123456789/{{$cultureImage->url}}" style="border: 1px solid #ddd;margin-top: 0rem; width: 100%; object-fit: cover; height: 100%;" alt="...">
                    </a>
                  </div>
                  @endforeach
                  <!-- <a href="https://player.vimeo.com/video/33110953" data-featherlight="iframe" data-featherlight-iframe-frameborder="0" data-featherlight-iframe-allow="autoplay; encrypted-media" data-featherlight-iframe-allowfullscreen="true" data-featherlight-iframe-style="display:block;border:none;height:85vh;width:85vw;">
                      <img src="https://storage.googleapis.com/talentail-123456789/{{$cultureImage->url}}" style="border: 1px solid #ddd;margin-top: 0rem; width: 100%; object-fit: cover; height: 100%;" alt="...">
                    </a> -->
                </div>
              @endif
            </div>
            @endif
          @endforeach
          @endif
        </div>
      </div>  

      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        @if(count($company->shoutouts) > 0)
        <h5 class="header-pretitle">
          SHOUTOUTS
        </h5>
        @endif
        @foreach($company->shoutouts->sortByDesc('created_at') as $shoutout)
        <div class="card" style="box-shadow: none !important;">
          <div class="card-body">
            
            <!-- Header -->
            <div class="mb-3">
              <div class="row align-items-top">
                <div class="col-auto">
                  
                  <!-- Avatar -->
                  <a href="#!" class="avatar" id="{{$shoutout->id}}">
                    @if($shoutout->user->provider != null)
                    <img src="{{$shoutout->user->avatar}}" alt="..." class="avatar-img" style="border-radius: 0.5rem;">
                    @elseif($shoutout->user->avatar)
                     <img src="https://storage.googleapis.com/talentail-123456789/{{$shoutout->user->avatar}}" alt="..." class="avatar-img" style="border-radius: 0.5rem;">
                    @else
                    <img src="https://api.adorable.io/avatars/150/{{$shoutout->user->email}}.png" alt="..." class="avatar-img" style="border-radius: 0.5rem;">
                    @endif
                  </a>

                </div>
                <div class="col ml-n2">

                  <!-- Title -->
                  <h4 class="card-title mb-1">
                    {{$shoutout->user->name}}
                  </h4>

                  <!-- Time -->
                  <p class="card-text small text-muted">
                    <span class="fe fe-clock"></span> <time>{{$shoutout->created_at->diffForHumans()}}</time>
                  </p>
                  
                </div>
                <div class="col-auto">
                  @if(!$shoutout->approved)
                    @if($company->user_id == Auth::id())
                      <btn class="btn btn-sm btn-primary" id="shoutout_{{$shoutout->id}}" onclick="approve(this.id)">Approve</btn>
                    @else
                      <span class="badge badge-light">Awaiting approval</span>
                    @endif
                  @else
                    <span class="badge badge-warning">{{$shoutout->subPerk->title}}</span>
                  @endif      
                </div>
              </div> <!-- / .row -->
            </div>

            <!-- Text -->
            <p style="margin-bottom: 0rem;">
              {{$shoutout->content}}
            </p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="col-lg-3">
      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          GIVE A SHOUTOUT!
        </h5>
        <div class="card" style="box-shadow: none !important;">
          <div class="card-body" style="box-shadow: none !important;">
            @if(empty($cultureSubPerkDetails))
            <btn class="btn btn-block btn-primary disabled">I'll do it!</btn>
            <small class="form-text text-muted" style="margin-bottom: 0rem; margin-top: 0.5rem;">You can only give a shoutout once the company's culture is populated.</small>
            @else
            <a href="/companies/{{$company->slug}}/shoutout" class="btn btn-block btn-primary">I'll do it!</a>
            @endif
          </div>
        </div>
      </div>
      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          PERKS <!-- VALUE <span style="color: #16a085;">~${{number_format($company->value)}}</span> -->
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
          PERKS VALUE <span style="color: #16a085;">~${{number_format($company->value)}}</span>
          <!-- PERKS -->
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

  function approve(id) {
    event.preventDefault();

    var value = id.split("_");

    document.getElementById("shoutoutId").value = value[1];
    document.getElementById("approveButton").click();
  }
</script>
@endsection

@section ('footer')   
<script src="//code.jquery.com/jquery-latest.js"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.gallery.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
      $(document).ready(function(){
        $('.gallery').featherlightGallery({
          gallery: {
            fadeIn: 300,
            fadeOut: 300
          },
          openSpeed:    300,
          closeSpeed:   300
        });
      })
</script>

@endsection