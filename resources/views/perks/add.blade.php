@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5>Add Perk</h5>
    <br/>
    <form method="POST" action="/perks/add-perk">
      @csrf
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Perk</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="title" name="title" placeholder="Perk title">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="description" id="description" maxlength="280" rows="5" placeholder="Perk description"></textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Add Perk</button>
    </form>
  </div>
</div>

@endsection

@section ('footer')   
@endsection