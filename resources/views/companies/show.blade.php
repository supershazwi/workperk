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
            <span style="font-size: 1.25rem; color: #dca419;">Open to Ideas</span>
            <p style="margin-top: 0.5rem;">Over here, we know that there's always room for improvement. We constantly look out for improvements to be done in three aspects - people, process and technology. From inventory optimisation to digital transformation projects, so long it better serves our purpose of focusing on our customer's work, we would implement the idea.</p>
            <p style="margin-top: 0.5rem;">What people should know is most of the time, our employees are the one coming up with the various initiatives. Being 'on-the-ground', they have the firsthand view of the situation and probably the best to devise a solution.</p>
          </div>
          <div style="margin-bottom: 0rem;">
            <span style="font-size: 1.25rem; color: #dca419;">Team-oriented</span>
            <p style="margin-top: 0.5rem;">A customer's equipment rental booking can go from order to fulfilment fast and it is only possible by our teamwork. From the checking of equipment availability to ensuring the items are not faulty, each task is done together as a team.</p>
            <p style="margin-top: 0.5rem;">For every decision or action we take, we consider whether it would bring about the success of the team as a whole and also the mission of the company.</p>
            <p style="margin-top: 0.5rem;">Outside of work, some of us will hold events to gather all of us to simply have a good time.</p>
            <figure class="figure" style="text-align: center; margin-bottom: 0rem;">
              <img src="https://scontent.fsin8-2.fna.fbcdn.net/v/t1.0-9/13681024_10154951204211124_5323269331142389810_n.jpg?_nc_cat=107&_nc_ht=scontent.fsin8-2.fna&oh=40f2eb014f3f0f59116a990b1a955130&oe=5D433E1A" class="figure-img img-fluid rounded" style="width: 100%; border-radius: 5px;"/>
              <figcaption class="figure-caption">The team chilling at Khamis' house for Hari Raya!</figcaption>
            </figure>
          </div>
          <div style="margin-bottom: 1rem;">
            <span style="font-size: 1.25rem; color: #dca419;">Employee First</span>
            <p style="margin-top: 0.5rem;">While there's the popular saying of "Customer comes first", at Camwerkz, we wholeheartedly believe and practise an "Employee First" culture. In order to get to a state of our customer's work being our focus, we focus on the interface between the customer and the company - which is our team.</p>
            <p style="margin-top: 0.5rem;">Especially at a time today when trust between the management and employees are amongst the lowest, the first thing we do is create an environment of trust where our team believes in what we are saying and doing. The management is always available to listen to the needs of every individual team member.</p>
            <p style="margin-top: 0.5rem;">With this, having happy and fulfilled customers is a no brainer.</p>
            <figure class="figure" style="text-align: center; margin-bottom: 0rem;">
              <img src="https://scontent-sin6-2.xx.fbcdn.net/v/t1.0-9/55575833_10158253734831124_7278478457154043904_n.jpg?_nc_cat=103&_nc_ht=scontent-sin6-2.xx&oh=15fdddf146f06d924773568f30883fa6&oe=5D454ECF" class="figure-img img-fluid rounded" style="width: 100%; border-radius: 5px;"/>
              <figcaption class="figure-caption">Hanis learning how to xxx xxx.</figcaption>
            </figure>
          </div>
          <div style="margin-bottom: 0rem;">
            <span style="font-size: 1.25rem; color: #dca419;">Open to Failures</span>
            <p style="margin-top: 0.5rem;">We encourage our team to try new things and different ways of solving a problem as a form of continuous improvement. This occasionally leads to things not working out as planned. We often use this opportunity as a way to learn what went wrong and what could have been done better.</p>
            <p style="margin-top: 0.5rem; margin-bottom: 0rem;">The only way to learn fast and well is to not be afraid of venturing into the unknown and we make sure that Camwerkz is a safe environment for our team to do that.</p>
          </div>
        </div>
      </div>  
    </div>
    <div class="col-lg-3">
      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          PERKS <span style="color: #16a085;">~${{number_format($company->value)}}</span>
        </h5>
      </div>
      <div class="card">
        <div class="card-body">
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
          @endforeach
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
            @if($company->address)
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt"></i> {{$company->address}}</li>
            @endif
            @if($company->contact)
            <li style="margin-bottom: 0rem;"><i class="fas fa-phone"></i> {{$company->contact}}</li>
            @endif
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