@extends ('layouts.main')

@section ('content')

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" alt="" class="avatar-img rounded" style="width: 5rem; height: 5rem;">
  <h1 style="margin-top: 0.5rem;">{{$company->name}}</h1>
  <p>{{$company->location->state}}, {{$company->location->country}}</p>
  <p class="lead">{{$company->description}}</p>
  <p class="lead" style="margin-bottom: 0rem;">Perks Value: 
    <span style="color: #16a085;">
    @if($company->value == 0)
    TBC
    @else
    ~${{number_format($company->value)}}
    @endif
  </span></p>
</div>

<div class="py-5 bg-light" style="margin-top: 6rem; padding-bottom: 2rem !important;">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-3" style="">
                @foreach($filledPerks as $key=>$perk)
                @if($key % 4 == 0)
        <div class="card shadow-sm" style="margin-bottom: 1rem;">
          <div class="card-body">
                <p style="font-weight: bold; margin-bottom: 0.25rem;">{{$perk->title}} <a href="/companies/{{$company->slug}}/add-sub-perk"><i class="fas fa-plus" style="margin-left: 0.5rem;"></i></a></p>
                @foreach($companySubPerkDetails as $companySubPerkDetail)
                  @if($companySubPerkDetail->subPerk->perk->id == $perk->id)
                    <a href="/companies/{{$companySubPerkDetail->company->slug}}/perks/{{$companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$companySubPerkDetail->subPerk->slug}}"><p style="margin-bottom: 0rem;">{{$companySubPerkDetail->subPerk->title}}</p></a>
                    <span style="font-size: 0.875rem; color: #16a085;">
                      @if($companySubPerkDetail->subPerk->type == "currency")
                        @if($companySubPerkDetail->value == 0)
                          TBC
                        @else
                          ${{number_format($companySubPerkDetail->value)}}
                        @endif
                      @elseif($companySubPerkDetail->subPerk->type == "na")
                        
                      @elseif($companySubPerkDetail->subPerk->type == "number")
                        @if($companySubPerkDetail->value == 0)
                          TBC
                        @else
                        {{$companySubPerkDetail->value}} {{$companySubPerkDetail->subPerk->end}}
                        @endif
                      @endif
                    </span>
                  @endif
                @endforeach
        </div>
      </div>
                @endif
                @endforeach
              </div>
              <div class="col-lg-3" style="">
                @foreach($filledPerks as $key=>$perk)
                @if($key % 4 == 1)
        <div class="card shadow-sm" style="margin-bottom: 1rem;">
          <div class="card-body">
                <p style="font-weight: bold; margin-bottom: 0.25rem;">{{$perk->title}} <a href="/companies/{{$company->slug}}/add-sub-perk"><i class="fas fa-plus" style="margin-left: 0.5rem;"></i></a></p>
                @foreach($companySubPerkDetails as $companySubPerkDetail)
                  @if($companySubPerkDetail->subPerk->perk->id == $perk->id)
                    <a href="/companies/{{$companySubPerkDetail->company->slug}}/perks/{{$companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$companySubPerkDetail->subPerk->slug}}"><p style="margin-bottom: 0rem;">{{$companySubPerkDetail->subPerk->title}}</p></a>
                    <span style="font-size: 0.875rem; color: #16a085;">
                      @if($companySubPerkDetail->subPerk->type == "currency")
                        @if($companySubPerkDetail->value == 0)
                          TBC
                        @else
                          ${{number_format($companySubPerkDetail->value)}}
                        @endif
                      @elseif($companySubPerkDetail->subPerk->type == "na")
                        
                      @elseif($companySubPerkDetail->subPerk->type == "number")
                        @if($companySubPerkDetail->value == 0)
                          TBC
                        @else
                        {{$companySubPerkDetail->value}} {{$companySubPerkDetail->subPerk->end}}
                        @endif
                      @endif
                    </span>
                  @endif
                @endforeach
                </div>
      </div>
                @endif
                @endforeach
              </div>
              <div class="col-lg-3" style="">
                @foreach($filledPerks as $key=>$perk)
                @if($key % 4 == 2)
                <div class="card shadow-sm" style="margin-bottom: 1rem;">
          <div class="card-body">
                <p style="font-weight: bold; margin-bottom: 0.25rem;">{{$perk->title}} <a href="/companies/{{$company->slug}}/add-sub-perk"><i class="fas fa-plus" style="margin-left: 0.5rem;"></i></a></p>
                @foreach($companySubPerkDetails as $companySubPerkDetail)
                  @if($companySubPerkDetail->subPerk->perk->id == $perk->id)
                    <a href="/companies/{{$companySubPerkDetail->company->slug}}/perks/{{$companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$companySubPerkDetail->subPerk->slug}}"><p style="margin-bottom: 0rem;">{{$companySubPerkDetail->subPerk->title}}</p></a>
                    <span style="font-size: 0.875rem; color: #16a085;">
                      @if($companySubPerkDetail->subPerk->type == "currency")
                        @if($companySubPerkDetail->value == 0)
                          TBC
                        @else
                          ${{number_format($companySubPerkDetail->value)}}
                        @endif
                      @elseif($companySubPerkDetail->subPerk->type == "na")
                        
                      @elseif($companySubPerkDetail->subPerk->type == "number")
                        @if($companySubPerkDetail->value == 0)
                          TBC
                        @else
                        {{$companySubPerkDetail->value}} {{$companySubPerkDetail->subPerk->end}}
                        @endif
                      @endif
                    </span>
                  @endif
                @endforeach
              </div></div>
                @endif
                @endforeach
              </div>
              <div class="col-lg-3" style="">
                @foreach($filledPerks as $key=>$perk)
                @if($key % 4 == 3)
                <div class="card shadow-sm" style="margin-bottom: 1rem;">
          <div class="card-body">
                <p style="font-weight: bold; margin-bottom: 0.25rem;">{{$perk->title}} <a href="/companies/{{$company->slug}}/add-sub-perk"><i class="fas fa-plus" style="margin-left: 0.5rem;"></i></a></p>
                @foreach($companySubPerkDetails as $companySubPerkDetail)
                  @if($companySubPerkDetail->subPerk->perk->id == $perk->id)
                    <a href="/companies/{{$companySubPerkDetail->company->slug}}/perks/{{$companySubPerkDetail->subPerk->perk->slug}}/sub-perks/{{$companySubPerkDetail->subPerk->slug}}"><p style="margin-bottom: 0rem;">{{$companySubPerkDetail->subPerk->title}}</p></a>
                    <span style="font-size: 0.875rem; color: #16a085;">
                      @if($companySubPerkDetail->subPerk->type == "currency")
                        @if($companySubPerkDetail->value == 0)
                          TBC
                        @else
                          ${{number_format($companySubPerkDetail->value)}}
                        @endif
                      @elseif($companySubPerkDetail->subPerk->type == "na")
                        
                      @elseif($companySubPerkDetail->subPerk->type == "number")
                        @if($companySubPerkDetail->value == 0)
                          TBC
                        @else
                        {{$companySubPerkDetail->value}} {{$companySubPerkDetail->subPerk->end}}
                        @endif
                      @endif
                    </span>
                  @endif
                @endforeach
              </div></div>
                @endif
                @endforeach
              </div>
            </div>
          </div>
    </div>
  </div>
</div>

@endsection

@section ('footer')   
@endsection