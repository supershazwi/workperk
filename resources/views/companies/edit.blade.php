@extends ('layouts.main')

@section ('content')

<div class="py-5">
  <div class="container">
    <h2><a href="/dashboard">Dashboard</a> > {{$company->name}} > Edit Company</h2>
    <div class="row align-items-center" style="margin-top: -1.5rem;">
      <div class="col">
        
        <!-- Nav -->
        <ul class="nav nav-tabs nav-overflow header-tabs">
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit" class="nav-link active">
              Company Details
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit/perks-sub-perks" class="nav-link">
              Perks, Sub-perks & Values
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies/{{$company->id}}/edit/culture" class="nav-link">
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
    <form method="POST" action="/companies/{{$company->id}}/save-company" enctype="multipart/form-data">
      @csrf
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
          <div class="avatar avatar-xxl header-avatar-top">
            <img src="https://storage.googleapis.com/talentail-123456789/{{$company->image}}" style="border: 0px !important; border-radius: 0.5rem !important;" alt="..." class="avatar-img rounded-circle border border-4 border-body">
          </div>
          <br/><br/>
          <input type="file" id="image" name="image">
          <small class="form-text text-muted">Just make sure it's a square if not it will be squished and squashed.</small>
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Cover</label>
        <div class="col-sm-10">
          <input type="file" id="cover" name="cover">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Value</label>
        <div class="col-sm-10">
          <label for="staticEmail" class="col-sm-2 col-form-label" style="padding-left: 0rem;">${{number_format($company->value)}}</label>
          <small class="form-text text-muted">This will add up as you add the perks.</small>
        </div>
      </div>
  		<div class="form-group row">
  			<label for="staticEmail" class="col-sm-2 col-form-label">Company</label>
  			<div class="col-sm-10">
  				<input type="text" class="form-control" id="name" name="name" value="{{$company->name}}">
  			</div>
  		</div>
  		<div class="form-group row">
  			<label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
  			<div class="col-sm-10">
  				<textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter description">{{$company->description}}</textarea>
  			</div>
  		</div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Location</label>
        <div class="col-sm-10">
          <select class="js-example-basic-single2" name="location" style="width: 100%;">
            <option>Select location</option>
            @foreach($locations as $location)
            @if($company->location_id == $location->id)
            <option value="{{$location->id}}" selected>{{$location->state}}, {{$location->country}}</option>
            @else
            <option value="{{$location->id}}">{{$location->state}}, {{$location->country}}</option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Industry</label>
        <div class="col-sm-10">
          <select class="js-example-basic-single" name="type" style="width: 100%;">
            <option>Select Industry</option>
            <option>Accounting</option>
            <option>Airlines/Aviation</option>
            <option>Alternative Dispute Resolution</option>
            <option>Alternative Medicine</option>
            <option>Animation</option>
            <option>Apparel & Fashion</option>
            <option>Architecture & Planning</option>
            <option>Arts & Crafts</option>
            <option>Automotive</option>
            <option>Aviation & Aerospace</option>
            <option>Banking</option>
            <option>Biotechnology</option>
            <option>Broadcast Media</option>
            <option>Building Materials</option>
            <option>Business Supplies & Equipment</option>
            <option>Capital Markets</option>
            <option>Chemicals</option>
            <option>Civic & Social Organization</option>
            <option>Civil Engineering</option>
            <option>Commercial Real Estate</option>
            <option>Computer & Network Security</option>
            <option>Computer Games</option>
            <option>Computer Hardware</option>
            <option>Computer Networking</option>
            <option>Computer Software</option>
            <option>Construction</option>
            <option>Consumer Electronics</option>
            <option>Consumer Goods</option>
            <option>Consumer Services</option>
            <option>Cosmetics</option>
            <option>Dairy</option>
            <option>Defense & Space</option>
            <option>Design</option>
            <option>E-learning</option>
            <option>Education Management</option>
            <option>Electrical & Electronic Manufacturing</option>
            <option>Entertainment</option>
            <option>Environmental Services</option>
            <option>Events Services</option>
            <option>Executive Office</option>
            <option>Facilities Services</option>
            <option>Farming</option>
            <option>Financial Services</option>
            <option>Fine Art</option>
            <option>Fishery</option>
            <option>Food & Beverages</option>
            <option>Food Production</option>
            <option>Fundraising</option>
            <option>Furniture</option>
            <option>Gambling & Casinos</option>
            <option>Glass, Ceramics & Concrete</option>
            <option>Government Administration</option>
            <option>Government Relations</option>
            <option>Graphic Design</option>
            <option>Health, Wellness & Fitness</option>
            <option>Higher Education</option>
            <option>Hospital & Health Care</option>
            <option>Hospitality</option>
            <option>Human Resources</option>
            <option>Import & Export</option>
            <option>Individual & Family Services</option>
            <option>Industrial Automation</option>
            <option>Information Services</option>
            <option>Information Technology & Services</option>
            <option>Insurance</option>
            <option>International Affairs</option>
            <option>International Trade & Development</option>
            <option>Internet</option>
            <option>Investment Banking</option>
            <option>Investment Management</option>
            <option>Judiciary</option>
            <option>Law Enforcement</option>
            <option>Law Practice</option>
            <option>Legal Services</option>
            <option>Legislative Office</option>
            <option>Leisure, Travel & Tourism</option>
            <option>Libraries</option>
            <option>Logistics & Supply Chain</option>
            <option>Luxury Goods & Jewelry</option>
            <option>Machinery</option>
            <option>Management Consulting</option>
            <option>Maritime</option>
            <option>Market Research</option>
            <option>Marketing & Advertising</option>
            <option>Mechanical Or Industrial Engineering</option>
            <option>Media Production</option>
            <option>Medical Device</option>
            <option>Medical Practice</option>
            <option>Mental Health Care</option>
            <option>Military</option>
            <option>Mining & Metals</option>
            <option>Motion Pictures & Film</option>
            <option>Museums & Institutions</option>
            <option>Music</option>
            <option>Nanotechnology</option>
            <option>Newspapers</option>
            <option>Non-profit Organization Management</option>
            <option>Oil & Energy</option>
            <option>Online Media</option>
            <option>Outsourcing/Offshoring</option>
            <option>Package/Freight Delivery</option>
            <option>Packaging & Containers</option>
            <option>Paper & Forest Products</option>
            <option>Performing Arts</option>
            <option>Pharmaceuticals</option>
            <option>Philanthropy</option>
            <option>Photography</option>
            <option>Plastics</option>
            <option>Political Organization</option>
            <option>Primary/Secondary Education</option>
            <option>Printing</option>
            <option>Professional Training & Coaching</option>
            <option>Program Development</option>
            <option>Public Policy</option>
            <option>Public Relations & Communications</option>
            <option>Public Safety</option>
            <option>Publishing</option>
            <option>Railroad Manufacture</option>
            <option>Ranching</option>
            <option>Real Estate</option>
            <option>Recreational Facilities & Services</option>
            <option>Religious Institutions</option>
            <option>Renewables & Environment</option>
            <option>Research</option>
            <option>Restaurants</option>
            <option>Retail</option>
            <option>Security & Investigations</option>
            <option>Semiconductors</option>
            <option>Shipbuilding</option>
            <option>Sporting Goods</option>
            <option>Sports</option>
            <option>Staffing & Recruiting</option>
            <option>Supermarkets</option>
            <option>Telecommunications</option>
            <option>Textiles</option>
            <option>Think Tanks</option>
            <option>Tobacco</option>
            <option>Translation & Localization</option>
            <option>Transportation/Trucking/Railroad</option>
            <option>Utilities</option>
            <option>Venture Capital & Private Equity</option>
            <option>Veterinary</option>
            <option>Warehousing</option>
            <option>Wholesale</option>
            <option>Wine & Spirits</option>
            <option>Wireless</option>
            <option>Writing & Editing</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Website</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="website" name="website" value="{{$company->website}}" placeholder="https://www.abc.com">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Facebook</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="facebook" name="facebook" value="{{$company->facebook}}" placeholder="https://www.facebook.com/abc">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Twitter</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="twitter" name="twitter" value="{{$company->twitter}}" placeholder="https://twitter.com/abc">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Instagram</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="instagram" name="instagram" value="{{$company->instagram}}" placeholder="https://instagram.com/abc">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">YouTube</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="youtube" name="youtube" value="{{$company->youtube}}" placeholder="https://www.youtube.com/user/abc">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">LinkedIn</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{$company->linkedin}}" placeholder="https://www.linkedin.com/company/abc">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="address" name="address" value="{{$company->address}}" placeholder="1 Hyper Loop, Singapore 001001">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Contact</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="contact" name="contact" value="{{$company->contact}}" placeholder="60000000">
        </div>
      </div>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Visibility</label>
        <div class="col-sm-10">
          <select class="form-control" data-toggle="select" name="visibility">
            <option value="">Select visibility</option>

            @if($company->visible)
            <option value="0">Hidden</option>
            <option value="1" selected>Public</option>
            @else
            <option value="0" selected>Hidden</option>
            <option value="1">Public</option>
            @endif
          </select>
        </div>
      </div>
  		<div class="form-group row">
  			<label for="inputPassword" class="col-sm-2 col-form-label"></label>
  			<div class="col-sm-10">
  				<button type="submit" class="btn btn-primary">Save Company</button>
          <a href="/companies/{{$company->id}}/delete-company" class="btn btn-outline-danger">Delete Company</a>
  			</div>
  		</div>
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
  });
</script>

@endsection

@section ('footer')   
@endsection