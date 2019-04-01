@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h2>Edit Company</h2>
    <br/>
    <form method="POST" action="/companies/{{$company->id}}/save-company" enctype="multipart/form-data">
      @csrf
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
          <input type="file" id="image" name="image">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Value</label>
        <div class="col-sm-10">
          <label for="staticEmail" class="col-sm-2 col-form-label" style="padding-left: 0rem;">${{number_format($company->value)}}</label>
        </div>
      </div>
  		<div class="form-group row">
  			<label for="staticEmail" class="col-sm-2 col-form-label">Company</label>
  			<div class="col-sm-10">
  				<input type="text" class="form-control" id="name" name="name" value="{{$company->name}}">
  			</div>
  		</div>
  		<div class="form-group row">
  			<label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
  			<div class="col-sm-10">
  				<textarea class="form-control" name="description" id="description" maxlength="280" rows="5" placeholder="Enter description">{{$company->description}}</textarea>
  			</div>
  		</div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Location</label>
        <div class="col-sm-10">
          <select class="custom-select" name="location">
            <option>Select location</option>
            @foreach($locations as $location)
            @if($company->location_id == $location->id)
            <option value="{{$location->id}}" selected>{{$location->state}}, {{$location->country}}</option>
            @else
            <option value="{{$location->id}}">{{$location->state}}, {{$location->country}}</option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Premium</label>
        <div class="col-sm-10">
          @if($company->premium)
          <input type="checkbox" checked name="premium" />
          @else
          <input type="checkbox" name="premium" />
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Cover</label>
        <div class="col-sm-10">
          <input type="file" id="cover" name="cover">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="type" name="type" value="{{$company->type}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Website</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="website" name="website" value="{{$company->website}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Facebook</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="facebook" name="facebook" value="{{$company->facebook}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Twitter</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="twitter" name="twitter" value="{{$company->twitter}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Instagram</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="instagram" name="instagram" value="{{$company->instagram}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">YouTube</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="youtube" name="youtube" value="{{$company->youtube}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">LinkedIn</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{$company->linkedin}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="address" name="address" value="{{$company->address}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Contact</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="contact" name="contact" value="{{$company->contact}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Brief</label>
        <div class="col-sm-10">
          <div id="test-editormd2" style="border-radius: 0.5rem;">
            <textarea style="display:none;" name="brief"></textarea>
          </div>
          <div id="brief-info" style="display: none;">{{$company->brief}}</div>
        </div>
      </div>
  		<div class="form-group row">
  			<label for="inputPassword" class="col-sm-2 col-form-label"></label>
  			<div class="col-sm-10">
  				<button type="submit" class="btn btn-primary">Save Company</button>
          <a href="/companies/{{$company->id}}/delete-company" class="btn btn-outline-danger">Delete Company</a>
  			</div>
  		</div>
    </form>
    <br/>
    <form method="POST" action="/companies/{{$company->id}}/save-overall-perks">
      @csrf
      <table class="table">
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
      <br/>
      <input type="hidden" name="taggedSubPerkIds" value="{{$taggedSubPerkString}}"/>
      <button type="submit" class="btn btn-primary">Save Perks & Sub-perks</button>
    </form>
    <br/>
    <form method="POST" action="/companies/{{$company->id}}/save-company-sub-perk-details">
      @csrf
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Sub-perk</th>
            <th scope="col">Value</th>
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
                @else
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-describedby="basic-addon1" name="companySubPerkDetail_{{$companySubPerkDetail->id}}" value="{{$companySubPerkDetail->value}}"/>
                </div>
                @endif
              </td>
              <td>
                <input type="text" class="form-control" aria-describedby="basic-addon1" name="companySubPerkDetailComment_{{$companySubPerkDetail->id}}" value="{{$companySubPerkDetail->comment}}"/>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <br/>
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

@endsection

@section ('footer')   
@endsection