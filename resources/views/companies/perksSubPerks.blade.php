@extends ('layouts.main')

@section ('content')

<div class="py-5">
  <div class="container">
    <h2><a href="/dashboard">Dashboard</a> > {{$company->name}} > Edit Company</h2>
    <div class="row align-items-center" style="margin-top: -1.5rem;">
      <div class="col">
        
        <!-- Nav -->
        <ul class="nav nav-tabs nav-overflow header-tabs">
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit" class="nav-link ">
              Company Details
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit/perks-sub-perks" class="nav-link active">
              Perks, Sub-perks & Values
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit/culture" class="nav-link">
              Write-up On Culture
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit/jobs" class="nav-link">
              Jobs Management
            </a>
          </li>
        </ul>
      </div>
    </div>
    <br/>
    <br/>
    <form method="POST" action="/companies/{{$company->id}}/save-overall-perks">
      @csrf
      <table id="example" class="table bg-white">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Sub-perk</th>
            <th scope="col">Perk</th>
            <th scope="col">Select</th>
          </tr>
        </thead>
        <tbody>
          @foreach($subPerks as $key=>$subPerk) 
            <tr>
              <th scope="row">{{$key+1}}</th>
              <td>{{$subPerk->title}}</td>
              <td>{{$subPerk->perk->title}}</td>
              @if(!empty($taggedSubPerkIds[$subPerk->id]) && $taggedSubPerkIds[$subPerk->id] == true)
              <td><input type="checkbox" checked value="{{$subPerk->perk->id}}_{{$subPerk->id}}" onclick="toggleSelect(this.value)"/></td>
              @else
              <td><input type="checkbox" value="{{$subPerk->perk->id}}_{{$subPerk->id}}" onclick="toggleSelect(this.value)"/></td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
      <input type="hidden" name="overallPerkIds" id="overallPerkIds" />
      <input type="hidden" name="overallPerkIdsArray" id="overallPerkIdsArray" value="{{$taggedSubPerkString}}"/>
      <input type="hidden" name="taggedSubPerkIds" value="{{$taggedSubPerkString}}"/>
      <div style="margin-top: 0.5rem;">
      <button type="submit" class="btn btn-primary" style="display: none;" id="savePerks">Save Perks & Sub-perks</button>
    </div>
      
    </form>
      <button onclick="savePerks()" class="btn btn-primary">Save Perks & Sub-perks</button>      <span style="margin-left: 0.5rem;">Can't find a sub-perk? <a href="/companies/{{$company->id}}/add-sub-perk">Add a Sub-perk</a></span>

      <br/>
    <br/>
    <form method="POST" action="/companies/{{$company->id}}/save-company-sub-perk-details">
      @csrf
      <table id="example2" class="table bg-white">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Sub-perk</th>
            <th scope="col">Value (Enter annual worth)</th>
            <th scope="col">Comment</th>
          </tr>
        </thead>
        <tbody>
          @foreach($companySubPerkDetails as $key=>$companySubPerkDetail) 
            <tr>
              <th scope="row">{{$key+1}}</th>
              <td>{{$companySubPerkDetail->subPerk->title}}</td>
              <td>
                @if($companySubPerkDetail->subPerk->type == "currency")
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">$</span>
                  </div>
                  <input type="text" class="form-control" aria-describedby="basic-addon1" id="companySubPerkDetail_{{$companySubPerkDetail->id}}" value="{{$companySubPerkDetail->value}}" onblur="leaveValue(this)"/>
                </div>
                @elseif($companySubPerkDetail->subPerk->type == "number")
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-describedby="basic-addon1" id="companySubPerkDetail_{{$companySubPerkDetail->id}}" value="{{$companySubPerkDetail->value}}" onblur="leaveValue(this)"/>
                </div>
                @else
                <div class="input-group mb-3">
                  Available
                </div>
                @endif
              </td>
              <td>
                @if($companySubPerkDetail->subPerk->perk_id == 15)
                Elaborate further in <a href="/companies/{{$company->id}}/edit/culture"><i>Write-up On Culture</i></a>
                @else
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="companySubPerkDetailComment_{{$companySubPerkDetail->id}}" value="{{$companySubPerkDetail->comment}}" onblur="leaveComment(this)"/>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @foreach($companySubPerkDetails as $key=>$companySubPerkDetail)
        @if($companySubPerkDetail->subPerk->perk_id != 15)
          <input type="hidden" id="companySubPerkDetail2_{{$companySubPerkDetail->id}}" name="companySubPerkDetail_{{$companySubPerkDetail->id}}" value="{{$companySubPerkDetail->value}}"/>
          <input type="hidden" id="companySubPerkDetailComment2_{{$companySubPerkDetail->id}}" name="companySubPerkDetailComment_{{$companySubPerkDetail->id}}" value="{{$companySubPerkDetail->comment}}"/>
          @endif
        @endforeach
      <button type="submit" class="btn btn-primary" style="margin-top: 0.5rem;">Save Values</button>
    </form>
  </div>
</div>

<script type="text/javascript">
  function toggleSelect(value) {
    var overallPerkIdsArray = document.getElementById("overallPerkIdsArray").value.split(',');

    if(overallPerkIdsArray.indexOf(value) == -1) {
      overallPerkIdsArray.push(value);
    } else {
      overallPerkIdsArray.splice(overallPerkIdsArray.indexOf(value), 1);
    }
      
    document.getElementById("overallPerkIdsArray").value = overallPerkIdsArray.join();
  }

  function savePerks() {
    event.preventDefault();

    document.getElementById("overallPerkIds").value = document.getElementById("overallPerkIdsArray").value.split(',');

    document.getElementById("savePerks").click();
  }

  function leaveValue(obj) {
    var string = obj.id.split('_');
    document.getElementById("companySubPerkDetail2_"+string[1]).value = obj.value;
  }

  function leaveComment(obj) {
    var string = obj.id.split('_');
    document.getElementById("companySubPerkDetailComment2_"+string[1]).value = obj.value;
  }

</script>

@endsection

@section ('footer')  
<script type="text/javascript">
  $(document).ready(function() {
      $('#example').DataTable();
      $('#example2').DataTable();
  });
</script> 
@endsection