@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5>Add Company</h5>
    <br/>
    <form method="POST" action="/companies/add-company" enctype="multipart/form-data">
      @csrf
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
          <input type="file" id="image" name="image" class="font-control-file">    
          <small class="form-text text-muted">Just make sure it's a square if not it will be squished and squashed.</small>
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Company</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="name" name="name" placeholder="Company name">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="description" id="description" maxlength="280" rows="5" placeholder="Company description"></textarea>
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Location</label>
        <div class="col-sm-10">
          <select class="custom-select" name="location">
            <option selected>Select location</option>
            @foreach($locations as $location)
            <option value="{{$location->id}}">{{$location->state}}, {{$location->country}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Add Company</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section ('footer')   
@endsection