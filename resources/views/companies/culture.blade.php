@extends ('layouts.main')

@section ('content')

<input type="hidden" id="companyCultureSubPerkDetailsId" value="{{$companyCultureSubPerkDetailsId}}" />

<div class="py-5">
  <div class="container">
    <h2><a href="/dashboard">Dashboard</a> > {{$company->name}} > Edit Company</h2>
    <div class="row align-items-center" style="margin-top: -1.5rem;">
      <div class="col">
        
        <!-- Nav -->
        <ul class="nav nav-tabs nav-overflow header-tabs">
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit" class="nav-link ">
              Company Details
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit/perks-sub-perks" class="nav-link ">
              Perks, Sub-perks & Values
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit/culture" class="nav-link active">
              Write-up On Culture
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit/jobs" class="nav-link">
              Jobs Management
            </a>
          </li>
        </ul>
      </div>
    </div>
    <br/>
    <br/>
    @if(empty($companyCultureSubPerkDetailsId))
    <div class="card">
      <div class="card-body text-center" style="padding-top: 10rem; padding-bottom: 10rem;">
        <span style="font-size: 2.5rem;">🤨</span> 
        <h2 style="margin-bottom: 0rem;">You need to <a href="/companies/{{$company->id}}/edit/perks-sub-perks" style="color: #2c7be5;">tag culture values</a> to your company.</h2>
      </div>
    </div>
    @else
    <form method="POST" action="/companies/{{$company->id}}/save-culture" enctype="multipart/form-data">
      @csrf
      @foreach($companySubPerkDetails as $key=>$companySubPerkDetail)
        @if($companySubPerkDetail->subPerk->perk_id == 15)
          <div class="card">
            <div class="card-body">
              <p style="font-size: 1.25rem; color: #dca419;">{{$companySubPerkDetail->subPerk->title}}</p>
              <textarea class="form-control" name="subPerk_{{$companySubPerkDetail->subPerk->id}}" id="subPerk_{{$companySubPerkDetail->subPerk->id}}" rows="5" placeholder="Elaborate more on '{{$companySubPerkDetail->subPerk->title}}'.">{{$companySubPerkDetail->comment}}</textarea>

              @if(count($companySubPerkDetail->cultureImages) > 0)
                <div class="row" style="padding-left: 9.5px; padding-right: 9.5px;">
                  @foreach($companySubPerkDetail->cultureImages as $cultureImage)
                  <div class="col-lg-4" style="height: 200px; padding: 2.5px;">
                    <img src="https://storage.googleapis.com/talentail-123456789/{{$cultureImage->url}}" style="border: 1px solid #ddd;margin-top: 1rem; width: 100%; object-fit: cover; height: 100%;" alt="...">
                  </div>
                  @endforeach
                </div>
                <br/>
              @endif

              <p style="margin-bottom: 0rem;">Attach Image(s)</p>
              <input type="file" id="image_{{$companySubPerkDetail->subPerk->id}}" name="image_{{$companySubPerkDetail->subPerk->id}}[]" style="margin-top: 1rem;" multiple>

              <p style="margin-bottom: 1rem; margin-top: 1rem;">Links</p>
              <div id="links_{{$companySubPerkDetail->subPerk->id}}">
              </div>
              <button onclick="addLink(this.value)" value="{{$companySubPerkDetail->subPerk->id}}" class="btn btn-primary btn-sm">Add Link</button>
            </div>
          </div>
        @endif
      @endforeach
      <button type="submit" class="btn btn-primary">Save Write-up</button>
    </form>
    @endif
  </div>
</div>
@endsection

@section ('footer')   
<script type="text/javascript">
  $(document).ready(function() {
      let companyCultureSubPerkDetailsId = document.getElementById("companyCultureSubPerkDetailsId").value;

      var array = companyCultureSubPerkDetailsId.split(",");

      for (var i = 0; i < array.length; i++) {
        var simplemde = new SimpleMDE({ 
          element: $("#subPerk_" + array[i])[0],
          toolbar: false
        });

      }
  });

  function addLink(value) {
    event.preventDefault();
    newCounter = document.getElementsByClassName("counter-"+value).length + 1;

    document.getElementById("links_"+value).innerHTML += "<div class='form-group'><label for='title' class='counter-" + value + "'>Title</label><input type='text' class='form-control' name='title_" + value + "_" + newCounter + "' placeholder='Enter title'></div><div class='form-group'><label for='source'>Source</label><input type='text' class='form-control' name='source_" + value + "_" + newCounter + "' placeholder='Enter source'></div><div class='form-group'><label for='link'>Link</label><input type='text' class='form-control' name='link_" + value + "_" + newCounter + "' placeholder='Enter link'></div><div class='form-group'><p style='margin-bottom: 0rem;'>Attach Image</p><input type='file' name='image_" + value + "_" + newCounter + "' style='margin-top: 1rem;'></div>"
  }
</script>
@endsection