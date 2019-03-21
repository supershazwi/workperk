@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5>Add Sub-perk to {{$perk->title}}</h5>
    <br/>
    <form method="POST" action="/perks/{{$perk->id}}/add-sub-perk">
      @csrf
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Sub-perk</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="title" name="title" placeholder="Sub-perk title">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="description" id="description" maxlength="280" rows="5" placeholder="Sub-perk description"></textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Add Sub-perk</button>
    </form>
  </div>
</div>

@endsection

@section ('footer')   
@endsection