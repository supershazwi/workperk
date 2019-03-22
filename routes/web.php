<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Comment;
use App\Company;
use App\CompanySubPerkDetail;
use App\Like;
use App\Location;
use App\Perk;
use App\SubPerk;
use App\User;

// COMPANY SUB PERK DETAIL //
Route::post('/company-sub-perk-detail/{companySubPerkDetailId}/like', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $returnArray = array();

    $companySubPerkDetail = CompanySubPerkDetail::find($routeParameters['companySubPerkDetailId']);

    $like = new Like;

    $like->company_sub_perk_detail_id = $companySubPerkDetail->id;
    $like->user_id = Auth::id();

    $like->save();

    return $returnArray;
});	

Route::post('/company-sub-perk-detail/{companySubPerkDetailId}/unlike', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $returnArray = array();

    $companySubPerkDetail = CompanySubPerkDetail::find($routeParameters['companySubPerkDetailId']);

    Like::where('company_sub_perk_detail_id', $routeParameters['companySubPerkDetailId'])->where('user_id', Auth::id())->delete();

    return $returnArray;
});	

// COMPANIES //
Route::get('/companies/add-company', function() {
	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$locations = Location::all();

		return view('companies.add', [
			'locations' => $locations
		]);
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::get('/companies/{companySlug}/perks/{perkSlug}', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $company = Company::where('slug', $routeParameters['companySlug'])->first();
    $perk = Perk::where('slug', $routeParameters['perkSlug'])->first();
	$locations = Location::select('country')->groupBy('country')->get();
	
	return view('companies.managePerk', [
		'company' => $company,
		'perk' => $perk,
		'locations' => $locations
	]);
});

Route::get('/companies/{companyId}/delete-company', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		Company::destroy($routeParameters['companyId']);
		
		return redirect('/dashboard');
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::get('/companies/{companyId}/edit', function() {
	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$routeParameters = Route::getCurrentRoute()->parameters();

		$company = Company::find($routeParameters['companyId']);
		$locations = Location::select('country')->groupBy('country')->get();
		$subPerks = SubPerk::orderBy('perk_id', 'asc')->get();

		// check many to many table for sub-perks tagged to company
		$taggedSubPerkIds = array();
		$taggedSubPerkString = array();

		foreach($company->subPerks as $subPerk) {
			$taggedSubPerkIds[$subPerk->id] = true;
			array_push($taggedSubPerkString, $subPerk->perk->id . "_" . $subPerk->id);
		}

		$taggedSubPerkString = implode(',', $taggedSubPerkString);

		return view('companies.edit', [
			'company' => $company,
			'locations' => $locations,
			'subPerks' => $subPerks,
			'taggedSubPerkIds' => $taggedSubPerkIds,
			'taggedSubPerkString' => $taggedSubPerkString
		]);
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::post('/companies/{companySlug}/perks/{perkSlug}/sub-perks/{subPerkSlug}/leave-comment', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $company = Company::where('slug', $routeParameters['companySlug'])->first();
    $subPerk = SubPerk::where('slug', $routeParameters['subPerkSlug'])->first();
    $companySubPerkDetail = CompanySubPerkDetail::where('company_id', $company->id)->where('sub_perk_id', $subPerk->id)->first();

    $comment = new Comment;

    $comment->content = $request->input('content');
    $comment->company_sub_perk_detail_id = $companySubPerkDetail->id;
    $comment->user_id = Auth::id();

    $comment->save();

    return redirect('/companies/'.$company->slug.'/perks/'.$companySubPerkDetail->subPerk->perk->slug.'/sub-perks/'.$companySubPerkDetail->subPerk->slug);
});

Route::get('/companies/{companySlug}/perks/{perkSlug}/sub-perks/{subPerkSlug}/leave-comment', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $company = Company::where('slug', $routeParameters['companySlug'])->first();
   	$locations = Location::select('country')->groupBy('country')->get();
    $subPerk = SubPerk::where('slug', $routeParameters['subPerkSlug'])->first();
    $companySubPerkDetail = CompanySubPerkDetail::where('company_id', $company->id)->where('sub_perk_id', $subPerk->id)->first();

    return view('subPerks.leaveComment', [
    	'company' => $company,
    	'locations' => $locations,
    	'companySubPerkDetail' => $companySubPerkDetail
    ]);
})->middleware('auth');

Route::post('/companies/{companySlug}/perks/{perkSlug}/add-sub-perk', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

	$company = Company::where('slug', $routeParameters['companySlug'])->first();
	$perk = Perk::where('slug', $routeParameters['perkSlug'])->first();

	$subPerk = new SubPerk;

	$subPerk->title = $request->input('title');
	$subPerk->description = $request->input('description');
	$subPerk->perk_id = $perk->id;
	$subPerk->slug = str_slug($request->input('title'), '-');

	$subPerk->save();

	$company->subPerks()->attach($subPerk->id);

	return redirect('/companies/'.$company->slug.'/perks/'.$perk->slug.'/'.$subPerk->slug);
})->middleware('auth');

Route::get('/companies/{companySlug}/perks/{perkSlug}/add-sub-perk', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	$company = Company::where('slug', $routeParameters['companySlug'])->first();
	$locations = Location::select('country')->groupBy('country')->get();
	$perk = Perk::where('slug', $routeParameters['perkSlug'])->first();

	return view('companies.addSubPerk', [
		'company' => $company,
		'locations' => $locations,
		'perk' => $perk
	]);
})->middleware('auth');

Route::get('/companies/{companySlug}', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	$company = Company::where('slug', $routeParameters['companySlug'])->first();
	$locations = Location::select('country')->groupBy('country')->get();
	$companySubPerkDetails = CompanySubPerkDetail::where('company_id', $company->id)->get();

	return view('companies.show', [
		'company' => $company,
		'locations' => $locations,
		'companySubPerkDetails' => $companySubPerkDetails
	]);
});

Route::post('/companies/add-company', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$company = new Company;

		$company->name = $request->input('name');
		$company->description = $request->input('description');
		$company->location_id = $request->input('location');
		$company->slug = str_slug($request->input('name'), '-');

		$company->save();
		
		return redirect('/companies/'.$company->id.'/edit');
	} else {
		redirect('/');
	}
})->middleware('auth');

// PERKS & SUB-PERKS//
Route::get('/companies/{companySlug}/perks/{perkSlug}/sub-perks/{subPerkSlug}', function() {
	$routeParameters = Route::getCurrentRoute()->parameters();

	$locations = Location::select('country')->groupBy('country')->get();
	$subPerk = SubPerk::where('slug', $routeParameters['subPerkSlug'])->first();
	$company = Company::where('slug', $routeParameters['companySlug'])->first();
	$companySubPerkDetail = CompanySubPerkDetail::where('company_id', $company->id)->where('sub_perk_id', $subPerk->id)->first();
	$likeClicked = Like::where('company_sub_perk_detail_id', $companySubPerkDetail->id)->where('user_id', Auth::id())->first();

	return view('companies.showSubPerk', [
		'locations' => $locations,
		'subPerk' => $subPerk,
		'company' => $company,
		'likeClicked' => $likeClicked,
		'companySubPerkDetail' => $companySubPerkDetail
	]);
});

Route::post('/companies/{companyId}/save-overall-perks', function(Request $request) {
	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$routeParameters = Route::getCurrentRoute()->parameters();
		$originalTaggedSubPerkIds = $request->input('taggedSubPerkIds');
		$company = Company::find($routeParameters['companyId']);

		$overallPerkIdArray = $request->input('overallPerkIds');

		if($overallPerkIdArray == null) {
			$company->perks()->detach();
			$company->subPerks()->detach();
			$companySubPerkDetails = CompanySubPerkDetail::where('company_id', $company->id)->get();
			foreach($companySubPerkDetails as $companySubPerkDetail) {
				Like::where('company_sub_perk_detail_id', $companySubPerkDetail->id)->delete();
				Comment::where('company_sub_perk_detail_id', $companySubPerkDetail->id)->delete();
				CompanySubPerkDetail::destroy($companySubPerkDetail->id);
			}

			return redirect('/companies/'.$routeParameters['companyId'].'/edit');
		}

		$futureSubPerkIdArray = array();
		$futurePerkIdArray = array();
		$originalSubPerkIdArray = array();
		$originalPerkIdArray = array();

		foreach($overallPerkIdArray as $overallPerkId) {
			$string = explode('_', $overallPerkId);
			array_push($futurePerkIdArray, $string[0]);
			array_push($futureSubPerkIdArray, $string[1]);
		}

		$originalTaggedSubPerkIds = explode(',', $originalTaggedSubPerkIds);

		foreach($originalTaggedSubPerkIds as $originalTaggedSubPerkId) {
			if($originalTaggedSubPerkId != "") {
				$string = explode('_', $originalTaggedSubPerkId);
				array_push($originalPerkIdArray, $string[0]);
				array_push($originalSubPerkIdArray, $string[1]);
			}
		}

		if($originalPerkIdArray) {
			$originalPerkIdArray = array_unique($originalPerkIdArray);
		}

		// check if missing in originalTaggedSubPerkIds, remove everything
		foreach($originalTaggedSubPerkIds as $originalTaggedSubPerkId) {
			if($originalTaggedSubPerkId != "") {
				$originalString = explode('_', $originalTaggedSubPerkId);

				// need to check original subperk and future subperk
				if(!in_array($originalString[1], $futureSubPerkIdArray)) {
					// $company->perks()->detach($originalString[0]);
					$company->subPerks()->detach($originalString[1]);

					$companySubPerkDetail = CompanySubPerkDetail::where('company_id', $company->id)->where('sub_perk_id', $originalString[1])->first();
					Like::where('company_sub_perk_detail_id', $companySubPerkDetail->id)->delete();
					Comment::where('company_sub_perk_detail_id', $companySubPerkDetail->id)->delete();
					CompanySubPerkDetail::destroy($companySubPerkDetail->id);
				}
			}
		}

		// remove perk id where necessary

		if($futurePerkIdArray) {
			$futurePerkIdArray = array_unique($futurePerkIdArray);
		}

		// check for added stuff
		foreach($futureSubPerkIdArray as $key=>$futureSubPerkId) {
			if(!in_array($futureSubPerkId, $originalSubPerkIdArray)) {
				$companySubPerkDetail = new CompanySubPerkDetail;

				$companySubPerkDetail->company_id = $company->id;
				$companySubPerkDetail->sub_perk_id = $futureSubPerkId;
				$companySubPerkDetail->value = 0;

				$companySubPerkDetail->save();
				$company->subPerks()->attach($futureSubPerkId);
			}
		}

		// if futureperkid does not exist in the many to many table, add it
		foreach($futurePerkIdArray as $futurePerkId) {
			if(!in_array($futurePerkId, $originalPerkIdArray)) {
				$company->perks()->attach($futurePerkId);
			}
		}

		// detach perk id
		foreach($originalPerkIdArray as $originalPerkId) {
			if(!in_array($originalPerkId, $futurePerkIdArray)) {
				$company->perks()->detach($originalPerkId);
			}
		}

		return redirect('/companies/'.$routeParameters['companyId'].'/edit');
	} else {
		return redirect('/');
	}
})->middleware('auth');



Route::post('/perks/add-perk', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$perk = new Perk;

		$perk->title = $request->input('title');
		$perk->description = $request->input('description');
		$perk->slug = str_slug($request->input('title'), '-');

		$perk->save();
		
		return redirect('/perks/'.$perk->id.'/edit');
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::get('/perks/add-perk', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$locations = Location::select('country')->groupBy('country')->get();

		return view('perks.add', [
			'locations' => $locations
		]);
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::post('/perks/{perkId}/add-sub-perk', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$subPerk = new SubPerk;

		$subPerk->title = $request->input('title');
		$subPerk->description = $request->input('description');
		$subPerk->perk_id = $routeParameters['perkId'];
		$subPerk->slug = str_slug($request->input('title'), '-');

		$subPerk->save();
		
		return redirect('/sub-perks/'.$subPerk->id);
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::get('/perks/{perkId}/add-sub-perk', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$perk = Perk::find($routeParameters['perkId']);
		$locations = Location::select('country')->groupBy('country')->get();
		
		return view('subPerks.add', [
			'perk' => $perk,
			'locations' => $locations
		]);
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::get('/sub-perks/{subPerkSlugOrId}', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	$subPerk = SubPerk::where('slug', $routeParameters['subPerkSlugOrId'])->first();
	$locations = Location::select('country')->groupBy('country')->get();

	if($subPerk) {
		return view('subPerks.show', [
			'subPerk' => $subPerk,
			'locations' => $locations
		]);
	} else {
		if(Auth::user()->email == "supershazwi@gmail.com") {
			$subPerk = SubPerk::find($routeParameters['subPerkSlugOrId']);

			return view('subPerks.edit', [
				'subPerk' => $subPerk,
				'locations' => $locations
			]);
		} else {
			redirect('/');
		}
	}
});

Route::get('/perks/{perkSlug}', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	$perk = Perk::where('slug', $routeParameters['perkSlug'])->first();
	$locations = Location::select('country')->groupBy('country')->get();
	return view('perks.show', [
		'perk' => $perk,
		'locations' => $locations
	]);
});

Route::get('/perks/{perkId}/delete-perk', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$perk = Perk::find($routeParameters['perkId']);

		$perk->subPerks()->delete();

		Perk::destroy($routeParameters['perkId']);
		
		return redirect('/dashboard');
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::get('/sub-perks/{subPerkId}/delete-sub-perk', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$subPerk = SubPerk::find($routeParameters['subPerkId']);

		$perkId = $subPerk->perk_id;

		SubPerk::destroy($routeParameters['subPerkId']);
		
		return redirect('/perks/'.$perkId.'/edit');
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::post('/sub-perks/{subPerkId}/save-sub-perk', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$subPerk = SubPerk::find($routeParameters['subPerkId']);

		$subPerk->title = $request->input('title');
		$subPerk->description = $request->input('description');
		$subPerk->slug = str_slug($request->input('title'), '-');

		$subPerk->save();
		
		return redirect('/perks/'.$subPerk->perk->id.'/edit');
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::post('/perks/{perkId}/save-perk', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$perk = Perk::find($routeParameters['perkId']);

		$perk->title = $request->input('title');
		$perk->description = $request->input('description');
		$perk->slug = str_slug($request->input('title'), '-');

		$perk->save();
		
		return redirect('/perks/'.$perk->id.'/edit');
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::get('/sub-perks/{subPerkId}/edit', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$subPerk = SubPerk::find($routeParameters['subPerkId']);
		$locations = Location::select('country')->groupBy('country')->get();

		return view('subPerks.edit', [
			'subPerk' => $subPerk,
			'locations' => $locations
		]);
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::get('/perks/{perkId}/edit', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$perk = Perk::find($routeParameters['perkId']);
		$locations = Location::select('country')->groupBy('country')->get();

		return view('perks.edit', [
			'perk' => $perk,
			'locations' => $locations
		]);
	} else {
		redirect('/');
	}
})->middleware('auth');

// MISC //
Route::get('/privacy-policy', function() {
	$locations = Location::select('country')->groupBy('country')->get();

	return view('privacy', [
		'locations' => $locations
	]);
});

Route::get('/terms-conditions', function() {
	$locations = Location::select('country')->groupBy('country')->get();

	return view('terms', [
		'locations' => $locations
	]);
});

// ADMIN //
Route::get('/dashboard', function() {
	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$perks = Perk::all();
		$companies = Company::all();
		$locations = Location::select('country')->groupBy('country')->get();

		return view('dashboard', [
			'perks' => $perks,
			'companies' => $companies,
    		'locations' => $locations
		]);
	} else {
		redirect('/');
	}
})->middleware('auth');

Route::get('/profile', function () {
	$locations = Location::select('country')->groupBy('country')->get();

    return view('profile', [
    	'locations' => $locations
    ]);
})->middleware('auth');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', function () {
	$perks = Perk::all();
	$companies = Company::all();
	$locations = Location::select('country')->groupBy('country')->get();

    return view('index', [
    	'perks' => $perks,
    	'companies' => $companies,
    	'locations' => $locations
    ]);
});

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Auth::routes(['verify' => true]);