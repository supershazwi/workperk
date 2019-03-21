@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5>Add Sub-perk to {{$perk->title}} under {{$company->name}}</h5>
    <br/>
    <form method="POST" action="/companies/{{$company->slug}}/perks/{{$perk->slug}}/add-sub-perk">
      @csrf
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Sub-perk</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Arcade Machine">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="description" id="description" maxlength="280" rows="5" placeholder="e.g. Say no more to mental blocks. No tokens needed to play video games at work."></textarea>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Add Sub-perk</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section ('footer')   
@endsection