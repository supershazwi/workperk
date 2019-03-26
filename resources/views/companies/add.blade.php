@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5>Add Company</h5>
    <br/>
    <form method="POST" action="/companies/add-company" enctype="multipart/form-data">
      @csrf
      @if (session('errorsArray'))
          <div class="alert alert-danger">
              <ul style="margin-bottom: 0rem;">
                  @foreach (session('errorsArray') as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
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
          <input type="text" class="form-control" id="name" name="name" placeholder="Company name" value="{{ old('name') }}">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="description" id="description" maxlength="280" rows="5" placeholder="Company description">{{ old('description') }}</textarea>
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Location</label>
        <div class="col-sm-10">
            <select class="js-example-basic-single" name="location" style="width: 100%;">
              @if(old('location'))
              <option>Select location</option>
              @else
              <option selected>Select location</option>
              @endif
              @foreach($locations as $location)
              @if($location->id == old('location'))
              <option value="{{$location->id}}" selected>{{$location->state}}, {{$location->country}}</option>
              @else
              <option value="{{$location->id}}">{{$location->state}}, {{$location->country}}</option>
              @endif
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> 
<script type="text/javascript">
  $(document).ready(function() {
      $('.js-example-basic-single').select2();
  });
</script>

@endsection

@section ('footer')   
@endsection