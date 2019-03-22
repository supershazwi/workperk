@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5>Edit Perk</h5>
    <br/>
    <form method="POST" action="/perks/{{$perk->id}}/save-perk">
      @csrf
  		<div class="form-group row">
  			<label for="staticEmail" class="col-sm-2 col-form-label">Perk</label>
  			<div class="col-sm-10">
  				<input type="text" class="form-control" id="title" name="title" value="{{$perk->title}}">
  			</div>
  		</div>
  		<div class="form-group row">
  			<label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
  			<div class="col-sm-10">
  				<textarea class="form-control" name="description" id="description" maxlength="280" rows="5" placeholder="Enter description">{{$perk->description}}</textarea>
  			</div>
  		</div>
  		<div class="form-group row">
  			<label for="inputPassword" class="col-sm-2 col-form-label"></label>
  			<div class="col-sm-10">
  				<button type="submit" class="btn btn-primary">Save Perk</button>
          <a href="/perks/{{$perk->id}}/delete-perk" class="btn btn-outline-danger">Delete Perk</a>
  			</div>
  		</div>
    </form>
    <br/>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Sub-perk</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($perk->subPerks as $key=>$subPerk)
        <tr>
          <th scope="row">{{$key+1}}</th>
          <td>{{$subPerk->title}}</td>
          <td>{{$subPerk->description}}</td>
          <td><a href="/sub-perks/{{$subPerk->id}}/edit">Edit</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <br/>
    <a href="/perks/{{$perk->id}}/add-sub-perk" class="btn btn-primary">Add Sub-perk</a>
  </div>
</div>

@endsection

@section ('footer')   
@endsection