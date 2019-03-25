@extends ('layouts.main')

@section ('content')

<div class="py-5 bg-white">
  <div class="container">
    <h5>Add Sub-perk to {{$company->name}}</h5>
    <br/>
    <form method="POST" action="/companies/{{$company->slug}}/add-sub-perk">
      @csrf
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Select Sub-perk</label>
        <div class="col-sm-10">
          <select class="js-example-basic-multiple" name="subPerkIds[]" multiple="multiple" style="width: 100%;">
            @foreach($subPerksToShow as $subPerk)
              <option value="{{$subPerk->perk->id}}_{{$subPerk->id}}">{{$subPerk->perk->title}} > {{$subPerk->title}}</option>
            @endforeach
          </select>
          <a href="#" onclick="showNewSubPerk()"><span style="font-size: 0.875rem;">Can't find what you're looking for?</span></a>
        </div>
      </div>

      <div id="addNewSubPerk" style="display: none;">
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">New Sub-perk</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Arcade Machine">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Perk Category</label>
          <div class="col-sm-10">
            <select class="js-example-basic-single" name="perkId" style="width: 100%;">
              <option value="nil">Select Perk Category</option>
              @foreach($perks as $perk)
              <option value="{{$perk->id}}">{{$perk->title}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Sub-perk Description</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="description" id="description" maxlength="280" rows="5" placeholder="e.g. Say no more to mental blocks. No tokens needed to play video games at work."></textarea>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Add Sub-perks</button>
          <a href="/companies/{{$company->slug}}" class="btn btn-light">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> 
<script type="text/javascript">
  $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
      $('.js-example-basic-single').select2();
  });

  function showNewSubPerk() {
    event.preventDefault();

    document.getElementById("addNewSubPerk").style.display = "block";
  }
</script>

@endsection

@section ('footer')   
@endsection