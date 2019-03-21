@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5>Edit Sub-perk</h5>
    <br/>
    <form method="POST" action="/sub-perks/{{$subPerk->id}}/save-sub-perk">
      @csrf
  		<div class="form-group row">
  			<label for="staticEmail" class="col-sm-2 col-form-label">Sub-perk</label>
  			<div class="col-sm-10">
  				<input type="text" class="form-control" id="title" name="title" value="{{$subPerk->title}}">
  			</div>
  		</div>
  		<div class="form-group row">
  			<label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
  			<div class="col-sm-10">
  				<textarea class="form-control" name="description" id="description" maxlength="280" rows="5" placeholder="Enter description">{{$subPerk->description}}</textarea>
  			</div>
  		</div>
  		<div class="form-group row">
  			<label for="inputPassword" class="col-sm-2 col-form-label"></label>
  			<div class="col-sm-10">
  				<button type="submit" class="btn btn-primary">Save Sub-perk</button>
          <a href="/sub-perks/{{$subPerk->id}}/delete-sub-perk" class="btn btn-outline-danger">Delete Sub-perk</a>
  			</div>
  		</div>
    </form>
  </div>
</div>

@endsection

@section ('footer')   
@endsection