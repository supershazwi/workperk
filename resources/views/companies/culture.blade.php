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
    <form method="POST" action="/companies/{{$company->id}}/save-culture" enctype="multipart/form-data">
      @csrf
      @foreach($companySubPerkDetails as $companySubPerkDetail)
        @if($companySubPerkDetail->subPerk->perk_id == 15)
          <div class="card">
            <div class="card-body">
              <p style="font-size: 1.25rem; color: #dca419;">{{$companySubPerkDetail->subPerk->title}}</p>
              <textarea class="form-control" name="subPerk_{{$companySubPerkDetail->subPerk->id}}" id="subPerk_{{$companySubPerkDetail->subPerk->id}}" rows="5" placeholder="Elaborate more on '{{$companySubPerkDetail->subPerk->title}}'.">{{$companySubPerkDetail->comment}}</textarea>

              @if($companySubPerkDetail->image)
                <img src="https://storage.googleapis.com/talentail-123456789/{{$companySubPerkDetail->image}}" style="margin-top: 1rem; width: 30%; border: 0px !important; border-radius: 0.5rem !important;" alt="..." class="avatar-img rounded-circle border border-4 border-body">
                <br/>
              @endif

              <input type="file" id="image_{{$companySubPerkDetail->subPerk->id}}" name="image_{{$companySubPerkDetail->subPerk->id}}" style="margin-top: 1rem;">
            </div>
          </div>
        @endif
      @endforeach
      <button type="submit" class="btn btn-primary">Save Write-up</button>
    </form>
  </div>
</div>

<script type="text/javascript" src="/js/editormd.js"></script>
<script src="/js/languages/en.js"></script>
<script type="text/javascript">
  
  var editor2 = editormd({
      id   : "test-editormd2",
      path : "/lib/",
      height: 640,
      placeholder: "Company brief.",
      onload : function() {
          //this.watch();
          //this.setMarkdown("###test onloaded");
          //testEditor.setMarkdown("###Test onloaded");
          editor2.insertValue(document.getElementById("brief-info").innerHTML);
      }
  });

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> 
<script type="text/javascript">
  $(document).ready(function() {
      $('.js-example-basic-single').select2();
      $('.js-example-basic-single2').select2();

      let companyCultureSubPerkDetailsId = document.getElementById("companyCultureSubPerkDetailsId").value;

      var array = companyCultureSubPerkDetailsId.split(",");

      for (var i = 0; i < array.length; i++) {
        var simplemde = new SimpleMDE({ 
          element: $("#subPerk_" + array[i])[0],
          toolbar: false
        });

      }
  });
</script>

<script>

</script>

@endsection

@section ('footer')   
@endsection