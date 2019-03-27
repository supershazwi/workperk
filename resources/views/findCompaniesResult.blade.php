@extends ('layouts.main')

@section ('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1>Find Your Ideal Company</h1>
  <p class="lead">Indicate perks that <span class="compulsory"><strong>matter</strong></span> to you</p>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
    	<div class="table-responsive">
	    	<table class="table">
	    	  <thead class="thead-dark">
	    	    <tr>
	    	      <th scope="col">Company</th>
	    	      @foreach($colArray as $col)
	    	      	<th scope="col">{{$col->title}}</th>
	    	      @endforeach
	    	    </tr>
	    	  </thead>
	    	  <tbody style="font-size: 0.875rem;">
	    	    @foreach($rowArray as $row)
	    	    <tr>
	    	    	@foreach($row as $key=>$rowDetail)
	    	    		@if($key == 0) 
	    	    			<th scope="row"><a href="/companies/{{$rowDetail->slug}}">{{$rowDetail->name}}</a></th>
	    	    		@else
	    	    			@if(is_int($rowDetail)) 
	    	    			<td style="background-color: #00b894;">${{number_format($rowDetail)}}</td>
	    	    			@elseif($rowDetail == "Available" || $rowDetail == "TBC")
	    	    			<td style="background-color: #00b894;">{{$rowDetail}}</td>
	    	    			@else
	    	    			<td style="background-color: #ff7675;">{{$rowDetail}}</td>
	    	    			@endif
	    	    		@endif
	    	    	@endforeach
	    	    </tr>
	    	    @endforeach
	    	  </tbody>
	    	</table>
	    </div>
    </div>
  </div>
</div>

<div class="container" style="margin-top: 2.5rem;">
	<div class="row">
	  <div class="col-lg-10 offset-lg-1">
	    <a href="/find-companies" class="btn btn-block btn-primary">Find Again</a>
	  </div>
	</div>
</div>

<div class="py-5 bg-white" style="margin-top: 4rem;">
  <div class="container">
    
  </div>
</div>

@endsection

@section ('footer')   
@endsection