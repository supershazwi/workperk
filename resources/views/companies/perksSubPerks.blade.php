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
        </ul>
      </div>
    </div>
    <br/>
    <br/>
    <form method="POST" action="/companies/{{$company->id}}/save-overall-perks">
      @csrf
      <table class="table bg-white">
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
              <td><input type="checkbox" checked name="overallPerkIds[]" value="{{$subPerk->perk->id}}_{{$subPerk->id}}"/></td>
              @else
              <td><input type="checkbox" name="overallPerkIds[]" value="{{$subPerk->perk->id}}_{{$subPerk->id}}"/></td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
      <input type="hidden" name="taggedSubPerkIds" value="{{$taggedSubPerkString}}"/>
      <button type="submit" class="btn btn-primary">Save Perks & Sub-perks</button>
    </form>
      <br/>
    <br/>
    <form method="POST" action="/companies/{{$company->id}}/save-company-sub-perk-details">
      @csrf
      <table class="table bg-white">
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
                  <input type="text" class="form-control" aria-describedby="basic-addon1" name="companySubPerkDetail_{{$companySubPerkDetail->id}}" value="{{$companySubPerkDetail->value}}"/>
                </div>
                @elseif($companySubPerkDetail->subPerk->type == "number")
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-describedby="basic-addon1" name="companySubPerkDetail_{{$companySubPerkDetail->id}}" value="{{$companySubPerkDetail->value}}"/>
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
                <input type="text" class="form-control" aria-describedby="basic-addon1" name="companySubPerkDetailComment_{{$companySubPerkDetail->id}}" value="{{$companySubPerkDetail->comment}}"/>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <button type="submit" class="btn btn-primary">Save Values</button>
    </form>
  </div>
</div>

<script type="text/javascript" src="/js/editormd.js"></script>
<script src="/js/languages/en.js"></script>
<script type="text/javascript">
  
  var editor2 = editormd({
      id   : "test-editormd2",
      path : "/lib/",
      height: 640,
      placeholder: "Company brief.",
      onload : function() {
          //this.watch();
          //this.setMarkdown("###test onloaded");
          //testEditor.setMarkdown("###Test onloaded");
          editor2.insertValue(document.getElementById("brief-info").innerHTML);
      }
  });

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> 
<script type="text/javascript">
  $(document).ready(function() {
      $('.js-example-basic-single').select2();
      $('.js-example-basic-single2').select2();
  });
</script>

@endsection

@section ('footer')   
@endsection