@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5>Edit Company</h5>
    <br/>
    <form method="POST" action="/companies/{{$company->id}}/save-company">
      @csrf
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
  </div>
</div>

@endsection

@section ('footer')   
@endsection