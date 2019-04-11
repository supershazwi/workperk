@extends ('layouts.main')

@section ('content')

<div class="py-5">
  <div class="container">
  <h2>Add Sub-perk to {{$company->name}}</h2>
    <br/>
    <form method="POST" action="/companies/{{$company->id}}/add-sub-perk">
      @csrf
      @if (session('errorsArray'))
          <div class="alert alert-danger" id="errors">
              <ul style="margin-bottom: 0rem;">
                  @foreach (session('errorsArray') as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <!-- <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Select Sub-perk</label>
        <div class="col-sm-10">
          <select class="js-example-basic-multiple" name="subPerkIds[]" multiple="multiple" style="width: 100%;">
            @foreach($subPerksToShow as $subPerk)
              <option value="{{$subPerk->perk->id}}_{{$subPerk->id}}">{{$subPerk->perk->title}} > {{$subPerk->title}}</option>
            @endforeach
          </select>
          <a href="#" onclick="showNewSubPerk()"><span style="font-size: 0.875rem;">Can't find what you're looking for?</span></a>
        </div>
      </div> -->

      <div id="addNewSubPerk">
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Sub-perk Title</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Arcade Machine" value="{{ old('title') }}">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Perk Category</label>
          <div class="col-sm-10">
            <select class="js-example-basic-single" name="perkId" style="width: 100%;">
              @if(old('perkId'))
              <option>Select Perk Category</option>
              @else
              <option selected>Select Perk Category</option>
              @endif
              @foreach($perks as $perk)
              @if($perk->id == old('perkId'))
              <option value="{{$perk->id}}" selected>{{$perk->title}}</option>
              @else
              <option value="{{$perk->id}}">{{$perk->title}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Sub-perk Description</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="description" id="description" maxlength="280" rows="5" placeholder="e.g. Say no more to mental blocks. No tokens needed to play video games at work.">{{old('description')}}</textarea>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Add Sub-perk</button>
          <a href="/companies/{{$company->id}}/edit/perks-sub-perks" class="btn btn-light">Cancel</a>
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

      if(document.getElementById('errors') != null) {
        document.getElementById("addNewSubPerk").style.display = "block";
      }
  });

  function showNewSubPerk() {
    event.preventDefault();

    document.getElementById("addNewSubPerk").style.display = "block";
  }
</script>

@endsection

@section ('footer')   
@endsection