@extends ('layouts.main')

@section ('content')
<div class="header" style="margin-bottom: 0px;">

  @if($company->premium)
    @if($company->cover)
      <img src="https://storage.googleapis.com/talentail-123456789/{{$company->cover}}" class="header-img-top" alt="...">
    @endif
  @endif
  
  <div class="container">
	@if($company->premium)
	@if($company->cover)
	<div class="header-body mt--5 mt-md--6" style="border-bottom: 0px;">
	@else
	<div class="header-body" style="border-bottom: 0px;">
	@endif
	@else
	<div class="header-body" style="border-bottom: 0px;">
	@endif
		<div class="row">
		  <div class="col-auto">
		    
		    <!-- Avatar -->
		    <div class="avatar avatar-xxl header-avatar-top">
		      <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" style="border-radius: 0.5rem !important;" alt="..." class="avatar-img rounded-circle border border-4 border-body">
		    </div>
		    @if($company->premium)
		    <span class="badge badge-secondary" style="display: block;">Premium</span>
		    @endif

		  </div>
		  @if($company->premium)
		    @if($company->cover)
		      <div class="col mb-3 ml--3 ml-md--2" style="margin-top: 4rem;">
		    @else
		      <div class="col mb-3 ml--3 ml-md--2">
		    @endif
		  @else
		      <div class="col mb-3 ml--3 ml-md--2">
		  @endif
		    
		    <!-- Pretitle -->
		    <h5 class="header-pretitle">
		      {{$company->type}}
		    </h5>

		    <!-- Title -->
		    <h1 class="header-title">
		      {{$company->name}}
		    </h1>
		    
		    <p style="margin-top: 0.5rem;">{{$company->description}}</p>
		    <!-- @if($company->premium)
		    <p style="margin-top: 0.5rem;">{{$company->description}}</p>
		    @else
		    <p style="margin-top: 0.5rem; width: 60%;">{{$company->description}}</p>
		    @endif -->
		  </div>
		  @if($company->premium)

		  @if($company->cover)
		  <div class="col-auto" style="margin-top: 4rem;">
		  @else
		  <div class="col-auto">
		  @endif
		  </div>
		  @endif
		</div> <!-- / .row -->
	</div>
  </div>
		<div class="container">
			@if (session('errorsArray'))
			    <div class="alert alert-danger text-center" id="shoutoutAlert">
			            @foreach (session('errorsArray') as $error)
			                <p style="margin-bottom: 0rem;">{{ $error }}</p>
			            @endforeach
			    </div>
			@endif
			<div class="row">
				<div class="col-lg-8">
					<form method="POST" action="/companies/{{$company->slug}}/shoutout" style="margin-bottom: 1.5rem;">
					  @csrf
					<p style="font-size: 1.25rem;">Select specific cultural value</p>
					
					<select class="js-example-basic-single" name="subPerk" style="width: 100%;">
						@if(old('subPerk'))
						<option>Select culture</option>
						@else
						<option selected>Select culture</option>
						@endif

						@foreach($company->companySubPerkDetails as $companySubPerkDetail)
						@if($companySubPerkDetail->subPerk->perk_id == 15)
							@if(old('subPerk') == $companySubPerkDetail->subPerk->id)
							<option value="{{$companySubPerkDetail->subPerk->id}}" selected>{{$companySubPerkDetail->subPerk->title}}</option>
							@else
							<option value="{{$companySubPerkDetail->subPerk->id}}">{{$companySubPerkDetail->subPerk->title}}</option>
							@endif
						@endif
						@endforeach
					</select>
					<p style="font-size: 1.25rem; margin-top: 1.5rem;">What is special about the culture here?</p>
			          <textarea class="form-control" rows="5" placeholder="" id="shoutout" name="content"></textarea>
					  <button type="submit" class="btn btn-primary">Submit Shoutout</button> <a href="/companies/{{$company->slug}}" class="btn btn-light" style="margin-left: 0.5rem;">Cancel</a>
					</form>
				</div>
				<div class="col-lg-4">
					<div class="card bg-white border">
	                    <div class="card-body">
	                      
	                      <p class="mb-2">
	                        Why give a shoutout?
	                      </p>

	                      <ul class="small pl-4 mb-0">
	                        <li>
	                          Users are able to place themselves in your shoes and view the company culture through your lenses
	                        </li>
	                        <li>
	                          Let's the company know what works well and continue improve the working environment
	                        </li>
	                        <li>
	                          Because you're awesome and you have something to share with the world
	                        </li>
	                        <li>
	                          The company profile would look prettier!
	                        </li>
	                      </ul>
	                    </div>
	                  </div>
				</div>
			</div>
		</div>
</div>
@endsection

@section ('footer')   
<script type="text/javascript">

	setTimeout(function(){ document.getElementById("shoutoutAlert").style.display = "none" }, 3000);

  $(document).ready(function() {
  	console.log('ok');
    var simplemde = new SimpleMDE({ 
      element: $("#shoutout")[0],
      toolbar: false
    });
  });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> 
<script type="text/javascript">
  $(document).ready(function() {
      $('.js-example-basic-single').select2();
  });
</script>
@endsection
