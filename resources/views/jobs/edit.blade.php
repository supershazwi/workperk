
@extends ('layouts.main')

@section ('content')

<div class="py-5">
  <div class="container">
    <h2><a href="/dashboard">Dashboard</a> > {{$job->company->name}} > Edit Company</h2>
    <div class="row align-items-center" style="margin-top: -1.5rem;">
      <div class="col">
        
        <!-- Nav -->
        <ul class="nav nav-tabs nav-overflow header-tabs">
          <li class="nav-item">
            <a href="/companies/{{$job->company->id}}/edit" class="nav-link ">
              Company Details
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$job->company->id}}/edit/perks-sub-perks" class="nav-link ">
              Perks, Sub-perks & Values
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$job->company->id}}/edit/culture" class="nav-link">
              Write-up On Culture
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$job->company->id}}/edit/jobs" class="nav-link active">
              Jobs Management
            </a>
          </li>
        </ul>
      </div>
    </div>
    <br/>
    <br/>

        	<form method="POST" action="/jobs/{{$job->id}}/edit" enctype="multipart/form-data">
        	  @csrf
    	      <div class="card">
    	        <div class="card-body">
            		<div class="row">
    	        		<div class="col-lg-4">
    	        			<div class="form-group">
    	        			  <label style="font-size: 1.25rem;">
    	        			    Title
    	        			  </label>
    	        			  <input type="text" name="title" class="form-control" id="title" placeholder="Enter job title" value="{{$job->title}}" autofocus>
    	        			</div>
    	        		</div>  
    	        		<div class="col-lg-4">
    	        			<div class="form-group">
    	        			  <label style="font-size: 1.25rem;">
    	        			    Type
    	        			  </label>
    			                <select class="form-control" data-toggle="select" name="type">
    			                  <option value="">Select type</option>
    			                  @if($job->type == "Contract")
    			                  <option value="Contract" selected>Contract</option>
    			                  @else
    			                  <option value="Contract">Contract</option>
    			                  @endif

    			                  @if($job->type == "Part-time")
    			                  <option value="Part-time" selected>Part-time</option>
    			                  @else
    			                  <option value="Part-time">Part-time</option>
    			                  @endif

    			                  @if($job->type == "Full-time")
    			                  <option value="Full-time" selected>Full-time</option>
    			                  @else
    			                  <option value="Full-time">Full-time</option>
    			                  @endif
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
    			                  @if($job->level == "Associate")
    			                  <option value="Associate" selected>Associate</option>
    			                  @else
    			                  <option value="Associate">Associate</option>
    			                  @endif

    			                  @if($job->level == "Junior")
    			                  <option value="Junior" selected>Junior</option>
    			                  @else
    			                  <option value="Junior">Junior</option>
    			                  @endif

    			                  @if($job->level == "Mid")
    			                  <option value="Mid" selected>Mid</option>
    			                  @else
    			                  <option value="Mid">Mid</option>
    			                  @endif

    			                  @if($job->level == "Senior")
    			                  <option value="Senior" selected>Senior</option>
    			                  @else
    			                  <option value="Senior">Senior</option>
    			                  @endif
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
    		        			    <option value="">Select location</option>
    		        			    @foreach($locations as $location)
    		        			    @if($location->id == $job->location_id)
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

    			                  @if($job->visible)
    			                  <option value="0">Hidden</option>
    			                  <option value="1" selected>Public</option>
    			                  @else
    			                  <option value="0" selected>Hidden</option>
    			                  <option value="1">Public</option>
    			                  @endif
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
    		    								@if($company->id == $job->company_id)
    				                  			<option value="{{$company->id}}" selected>{{$company->name}}</option>
    		    								@else
    				                  			<option value="{{$company->id}}">{{$company->name}}</option>
    				                  			@endif
    		    							@endforeach
    					                </select>
    	    						@endif
    	        			</div>
    	        		</div>  	
             	 	</div>
    	          	<p style="font-size: 1.25rem;">Job Description</p>
    	          	<textarea class="form-control" name="job_description" id="jobDescription" rows="5" placeholder="Elaborate on the job description.">{{$job->description}}</textarea>
    	        	
    	        	<p style="font-size: 1.25rem;">Job Progression</p>
    	          	<textarea class="form-control" name="job_progression" id="jobProgression" rows="5" placeholder="Elaborate on the job progression. What's in store for an employee in this position in terms of promotions, opportunities, etc.">{{$job->progression}}</textarea>

    	        </div>
    	      </div>
        	  <button type="submit" class="btn btn-primary">Save Job</button>
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