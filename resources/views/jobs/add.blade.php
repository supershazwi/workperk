
@extends ('layouts.main')

@section ('content')

<div class="py-5">
  	<div class="container">
	    <h2><a href="/profile">Profile</a> 
	      <a href="/claim" style="margin-left: 1rem;">Claim Company</a> <a href="/companies/add-company" style="margin-left: 1rem;">Create Company</a> <span style="text-decoration: underline; margin-left: 1rem;">Create Job</span> <a href="/dashboard" style="margin-left: 1rem;">Dashboard</a>
	    </h2>
	    <br/>
	    @if (session('errorsArray'))
	        <div class="alert alert-danger">
	            <ul style="margin-bottom: 0rem;">
	                @foreach (session('errorsArray') as $error)
	                    <li>{{ $error }}</li>
	                @endforeach
	            </ul>
	        </div>
	    @endif
	    @if (count($companies) == 0)
	    <div class="form-group row">
	      <div class="col-sm-12">
	        <div class="alert alert-warning" style="text-align: center;">
	          <p class="alert-heading" style="margin-bottom: 0;">You have yet to claim a company or create a company. Please do so before adding a job.</p>
	        </div>
	      </div>
	    </div>
	    @endif
    	
    	<form method="POST" action="/jobs/add-job" enctype="multipart/form-data">
    	  @csrf
	      <div class="card">
	        <div class="card-body">
        		<div class="row">
	        		<div class="col-lg-4">
	        			<div class="form-group">
	        			  <label style="font-size: 1.25rem;">
	        			    Title
	        			  </label>
	        			  <input type="text" name="title" class="form-control" id="title" placeholder="Enter job title" value="{{ old('title') }}" autofocus>
	        			</div>
	        		</div>  
	        		<div class="col-lg-4">
	        			<div class="form-group">
	        			  <label style="font-size: 1.25rem;">
	        			    Type
	        			  </label>
			                <select class="form-control" data-toggle="select" name="type">
			                  <option value="">Select type</option>
			                  <option value="Contract">Contract</option>
			                  <option value="Part-time">Part-time</option>
			                  <option value="Full-time">Full-time</option>
			                </select>
	        			</div>
	        		</div>   	
	        		<div class="col-lg-4">
	        			<div class="form-group">
	        			  <label style="font-size: 1.25rem;">
	        			    Level
	        			  </label>
			                <select class="form-control" data-toggle="select" name="level">
			                  <option value="">Select level</option>
			                  <option value="Associate">Associate</option>
			                  <option value="Junior">Junior</option>
			                  <option value="Mid">Mid</option>
			                  <option value="Senior">Senior</option>
			                </select>
	        			</div>
	        		</div>  	
         	 	</div>
        		<div class="row">
	        		<div class="col-lg-4">
	        			<div class="form-group">
	        			  <label style="font-size: 1.25rem;">
	        			    Location
	        			  </label>
			                <select class="form-control" data-toggle="select" name="location">
		        			    @if(old('location'))
		        			    <option value="">Select location</option>
		        			    @else
		        			    <option selected value="">Select location</option>
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
	        		<div class="col-lg-4">
	        			<div class="form-group">
	        			  <label style="font-size: 1.25rem;">
	        			    Visibility
	        			  </label>
			                <select class="form-control" data-toggle="select" name="visibility">
			                  <option value="">Select visibility</option>
			                  <option value="0">Hidden</option>
			                  <option value="1">Public</option>
			                </select>
	        			</div>
	        		</div>   	
	        		<div class="col-lg-4">
	        			<div class="form-group">
	        			  <label style="font-size: 1.25rem;">
	        			    Company
	        			  </label>
	    						@if (count($companies) == 0)
	    							<p>Please claim a company or create a company.</p>
	    						@else
					                <select class="form-control" data-toggle="select" name="company">
				                  		<option value="">Select company</option>
		    							@foreach($companies as $company)
				                  			<option value="{{$company->id}}">{{$company->name}}</option>
		    							@endforeach
					                </select>
	    						@endif
	        			</div>
	        		</div>  	
         	 	</div>
	          	<p style="font-size: 1.25rem;">Job Description</p>
	          	<textarea class="form-control" name="job_description" id="jobDescription" rows="5" placeholder="Elaborate on the job description."></textarea>
	        	
	        	<p style="font-size: 1.25rem;">Job Progression</p>
	          	<textarea class="form-control" name="job_progression" id="jobProgression" rows="5" placeholder="Elaborate on the job progression. What's in store for an employee in this position in terms of promotions, opportunities, etc."></textarea>

	        </div>
	      </div>
    	  <button type="submit" class="btn btn-primary">Create Job</button>
    	</form>
	</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
      var simplemde = new SimpleMDE({ 
        element: document.getElementById("jobDescription"),
        toolbar: ["unordered-list", "ordered-list"]
      });

      var simplemde2 = new SimpleMDE({ 
        element: document.getElementById("jobProgression"),
        toolbar: ["unordered-list", "ordered-list"]
      });
  });
</script>

@endsection

@section ('footer')   
@endsection