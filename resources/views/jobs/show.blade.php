@extends ('layouts.main')

@section ('content')
<div class="header" style="margin-bottom: 0rem;">
  @if($job->company->premium)
    @if($job->company->cover)
      <img src="https://storage.googleapis.com/talentail-123456789/{{$job->company->cover}}" class="header-img-top" alt="...">
    @endif
  @endif

  <div class="container" style="">
    @if (!$job->company->visible)
        <div class="alert alert-warning text-center">
          This company is currently hidden.
        </div>
    @endif

  </div>
</div>

<div class="container">
<div class="row">
  <div class="col-lg-9">
    <div class="header-body" style="padding-bottom: 0rem; border-bottom: 0px;">
    <h5 class="header-pretitle">
      JOB OPPORTUNITY
    </h5>
    </div>
    <div class="card" style="box-shadow: none !important;">
      <div class="card-body" style="box-shadow: none !important;">
        <h1>{{$job->title}}</h1>
        <p>{{$job->level}} - {{$job->type}} - {{$job->location->state}}, {{$job->location->country}}</p>
        <div style="margin-top: 0.5rem; margin-bottom: -1rem;">
          @parsedown($job->description)
        </div>
      </div>
    </div>

    <div class="header-body" style="padding-bottom: 0rem; border-bottom: 0px; padding-top: 0rem;">
    <h5 class="header-pretitle">
      JOB PROGRESSION
    </h5>
    </div>
    <div class="card" style="box-shadow: none !important;">
      <div class="card-body" style="box-shadow: none !important;">
        <div style="margin-bottom: -1rem;">
          @parsedown($job->progression)
        </div>
      </div>
    </div>

    <div class="header-body" style="padding-bottom: 0rem; border-bottom: 0px; padding-top: 0rem;">
    <h5 class="header-pretitle">
      INTERVIEW PROCESS
    </h5>
    </div>
    <div class="card" style="box-shadow: none !important;">
      <div class="card-body" style="box-shadow: none !important;">
        <div style="margin-bottom: -1rem;">
          @parsedown($job->interview_process)
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="header-body" style="padding-bottom: 0rem; border-bottom: 0px;">
    <h5 class="header-pretitle">
      COMPANY DETAILS
    </h5>
    </div>
    <div class="card" style="box-shadow: none !important;">
      <div class="card-body" style="box-shadow: none !important;">
        <img src="https://storage.googleapis.com/talentail-123456789/{{$job->company->image}}" alt="" class="avatar-img rounded" style="width: 2.5rem; height: 2.5rem; margin-bottom: 0.25rem;">
        <br/> 
        <a href="/companies/{{$job->company->slug}}"><span style="font-size: 1.25rem;">{{$job->company->name}}</span></a>
        <p>{{$job->company->type}}</p>
        <div style="margin-top: 0.5rem;">
          @parsedown($job->company->description)
        </div>
        <hr/>
        <a href="/jobs/{{$job->id}}/apply" class="btn btn-primary btn-block">Apply to Job Opportunity</a>
      </div>
    </div>

    <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          PERKS VALUE <span style="color: #16a085;">~${{number_format($job->company->value)}}</span>
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

      @if($job->company->contact || $job->company->address)
      <div class="header-body" style="padding-top: 0rem; padding-bottom: 0rem; border-bottom: 0px;">
        <h5 class="header-pretitle">
          CONTACT DETAILS
        </h5>
      </div>
      <div class="card" style="box-shadow: none !important;">
        <div class="card-body" style="box-shadow: none !important;">
          <ul class="list-unstyled text-small" style="margin-bottom: 0rem !important;">
            @if($job->company->address)
            <li style="margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt"></i> {{$job->company->address}}</li>
            @endif
            @if($job->company->contact)
            <li style="margin-bottom: 0rem;"><i class="fas fa-phone"></i> {{$job->company->contact}}</li>
            @endif
          </ul>
        </div>
      </div>
      @endif
      
    </div>


</div>
</div>

<div class="container">
  
</div>

<script type="text/javascript">
  function commentClick() {
    event.preventDefault();
  }
</script>
@endsection

@section ('footer')   
@endsection