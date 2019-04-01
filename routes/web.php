<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Storage;

use App\Mail\SendResetPasswordLink;

use App\Comment;
use App\Company;
use App\CompanySubPerkDetail;
use App\Like;
use App\Location;
use App\Perk;
use App\SubPerk;
use App\User;
use App\VerifyUser;
use App\Mail\VerifyMail;

// COMMENTS //
Route::post('/find-companies', function(Request $request) {
    $locations = Location::all();

    $selectedSubPerkIds = $request->input('clickedPerks');
    $selectedSubPerkIds = explode(",", $selectedSubPerkIds);

    $companyArray = array();
    $colArray = array();
    $rowArray = array();

    foreach($selectedSubPerkIds as $selectedSubPerkId) {
        $selectedSubPerk = SubPerk::find($selectedSubPerkId);

        array_push($colArray, $selectedSubPerk);

        foreach($selectedSubPerk->companies as $company) {
            if(empty($companyArray[$company->id])) {
                $companyArray[$company->id] = 1;
            } else {
                $companyArray[$company->id] += 1;
            }
        }
    }

    // dd($companyArray);

    arsort($companyArray);

    // dd($companyArray);

    $companyIdArray = array_keys($companyArray);

    foreach($companyIdArray as $key=>$companyId) {
        if(empty($rowArray[$key])) {
            $rowArray[$key] = array();
        }
        array_push($rowArray[$key], Company::find($companyId));

        foreach($colArray as $subPerk) {
            $companySubPerkDetail = CompanySubPerkDetail::where('company_id', $companyId)->where('sub_perk_id', $subPerk->id)->first();

            if($companySubPerkDetail) {
                if($companySubPerkDetail->subPerk->type == "currency") {
                    if($companySubPerkDetail->value == 0) {
                        array_push($rowArray[$key], "TBC");
                    } else {
                        array_push($rowArray[$key], "$" . number_format($companySubPerkDetail->value));
                    }
                } elseif($companySubPerkDetail->subPerk->type == "na") {
                    array_push($rowArray[$key], "Available");
                } elseif($companySubPerkDetail->subPerk->type == "number") {
                    if($companySubPerkDetail->value == 0) {
                        array_push($rowArray[$key], "TBC");
                    } else {
                        array_push($rowArray[$key], $companySubPerkDetail->value . " " . $companySubPerkDetail->subPerk->end);
                    }
                }
            } else {
                array_push($rowArray[$key], "Unavailable");
            }

            // if($companySubPerkDetail == null) {
            //     array_push($rowArray[$key], "Unavailable");
            // } elseif ($companySubPerkDetail->value == -1) {
            //     array_push($rowArray[$key], "Available");
            // } elseif ($companySubPerkDetail->value == 0) {
            //     array_push($rowArray[$key], "TBC");
            // } elseif ($companySubPerkDetail->value > 0) {
            //     array_push($rowArray[$key], "$" . number_format($companySubPerkDetail->value));
            // }
            
        }
    }

    return view('findCompaniesResult', [
        'locations' => $locations,
        'rowArray' => $rowArray,
        'colArray' => $colArray
    ]);

});

Route::get('/find-companies', function() {
    $locations = Location::all();
    $perks = Perk::orderBy('title', 'asc')->get();

    return view('findCompanies', [
        'locations' => $locations,
        'perks' => $perks
    ]);
});

Route::get('/companies/{companySlug}/perks/{perkSlug}/sub-perks/{subPerkSlug}/comments/{commentId}/delete-comment', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $comment = Comment::find($routeParameters['commentId']);

    if($comment->user_id == Auth::id()) {
    	Comment::destroy($routeParameters['commentId']);
    	
    	return redirect('/companies/'.$routeParameters['companySlug'].'/perks/'.$routeParameters['perkSlug'].'/sub-perks/'.$routeParameters['subPerkSlug']);
    } else {
    	return redirect('/');
    }
})->middleware('auth');

Route::post('/companies/{companySlug}/perks/{perkSlug}/sub-perks/{subPerkSlug}/comments/{commentId}', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

	$validator = Validator::make($request->all(), [
	    'content' => 'required'
	]);

	if($validator->fails()) {
	    return redirect('/companies/'.$routeParameters['companySlug'].'/perks/'.$routeParameters['perkSlug'].'/sub-perks/'.$routeParameters['subPerkSlug'].'/comments/'.$routeParameters['commentId'])
	                ->withErrors($validator)
	                ->withInput();
	}


    $company = Company::where('slug', $routeParameters['companySlug'])->first();
    $subPerk = SubPerk::where('slug', $routeParameters['subPerkSlug'])->first();
    $companySubPerkDetail = CompanySubPerkDetail::where('company_id', $company->id)->where('sub_perk_id', $subPerk->id)->first();

    $comment = Comment::find($routeParameters['commentId']);

    if($request->input('anonymous')) {
    	$comment->anonymous = true;
    } else {
    	$comment->anonymous = false;
    }

    $comment->content = $request->input('content');
    $comment->save();

    return redirect('/companies/'.$company->slug.'/perks/'.$companySubPerkDetail->subPerk->perk->slug.'/sub-perks/'.$companySubPerkDetail->subPerk->slug);


})->middleware('auth');

Route::get('/companies/{companySlug}/perks/{perkSlug}/sub-perks/{subPerkSlug}/comments/{commentId}', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();
	$comment = Comment::find($routeParameters['commentId']);

    if($comment->user_id == Auth::id()) {
    	$subPerk = SubPerk::where('slug', $routeParameters['subPerkSlug'])->first();
    	$company = Company::where('slug', $routeParameters['companySlug'])->first();
    	$companySubPerkDetail = CompanySubPerkDetail::where('company_id', $company->id)->where('sub_perk_id', $subPerk->id)->first();

    	$locations = Location::all();

    	return view('comments.show', [
    		'comment' => $comment,
    		'locations' => $locations,
    		'companySubPerkDetail' => $companySubPerkDetail
    	]);
    } else {
    	return redirect('/companies/'.$routeParameters['companySlug'].'/perks/'.$routeParameters['perkSlug'].'/sub-perks/'.$routeParameters['subPerkSlug']);
    }

})->middleware('auth');

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
	$locations = Location::all();

	return view('companies.add', [
		'locations' => $locations
	]);
});

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
		return redirect('/');
	}
})->middleware('auth');

Route::get('/companies/{companyId}/edit', function() {
	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$routeParameters = Route::getCurrentRoute()->parameters();

		$company = Company::find($routeParameters['companyId']);
		$locations = Location::all();
		$subPerks = SubPerk::orderBy('perk_id', 'asc')->get();

		// check many to many table for sub-perks tagged to company
		$taggedSubPerkIds = array();
		$taggedSubPerkString = array();

		foreach($company->subPerks as $subPerk) {
			$taggedSubPerkIds[$subPerk->id] = true;
			array_push($taggedSubPerkString, $subPerk->perk->id . "_" . $subPerk->id);
		}

		$taggedSubPerkString = implode(',', $taggedSubPerkString);

		$companySubPerkDetails = CompanySubPerkDetail::where('company_id', $company->id)->get();

		return view('companies.edit', [
			'company' => $company,
			'locations' => $locations,
			'subPerks' => $subPerks,
			'taggedSubPerkIds' => $taggedSubPerkIds,
			'taggedSubPerkString' => $taggedSubPerkString,
			'companySubPerkDetails' => $companySubPerkDetails
		]);
	} else {
		return redirect('/');
	}
})->middleware('auth');

Route::post('/companies/{companySlug}/perks/{perkSlug}/sub-perks/{subPerkSlug}/leave-comment', function(Request $request) {
	$routeParameters = Route::getCurrentRoute()->parameters();

	$validator = Validator::make($request->all(), [
	    'content' => 'required'
	]);

	if($validator->fails()) {
	    return redirect('/companies/'.$routeParameters['companySlug'].'/perks/'.$routeParameters['perkSlug'].'/sub-perks/'.$routeParameters['subPerkSlug'].'/leave-comment')
	                ->withErrors($validator)
	                ->withInput();
	}


    $company = Company::where('slug', $routeParameters['companySlug'])->first();
    $subPerk = SubPerk::where('slug', $routeParameters['subPerkSlug'])->first();
    $companySubPerkDetail = CompanySubPerkDetail::where('company_id', $company->id)->where('sub_perk_id', $subPerk->id)->first();

    $comment = new Comment;

    $comment->content = $request->input('content');
    $comment->company_sub_perk_detail_id = $companySubPerkDetail->id;
    $comment->anonymous = false;
    if(Auth::id()) {
    	if($request->anonymous) {
    		$comment->anonymous = true;
    	} 
			$comment->user_id = Auth::id();
    } else {
    	$comment->user_id = 0;
    	$comment->anonymous = true;
    }

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
});

Route::post('/companies/{companySlug}/add-sub-perk', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $errorsArray = array();

    if($request->input('title') != null || $request->input('description') != null || $request->input('perkId') != "Select Perk Category") {
    	if($request->input('title') == null) {
    		array_push($errorsArray, "The sub-perk title field is required.");
    	}

    	if($request->input('description') == null) {
    		array_push($errorsArray, "The sub-perk description field is required.");
    	}

    	if($request->input('perkId') == "Select Perk Category") {
    		array_push($errorsArray, "The perk category field is required.");
    	}
    }
    

    if(count($errorsArray) > 0) {
    	return redirect('/companies/'.$routeParameters['companySlug'].'/add-sub-perk')->with('errorsArray', $errorsArray)->withInput();
    }

	$company = Company::where('slug', $routeParameters['companySlug'])->first();

    if($request->input("subPerkIds")) {
    	$subPerkIdsArray = $request->input("subPerkIds");

    	$perkIdArray = array();

    	foreach($subPerkIdsArray as $subPerkIds) {
    		$string = explode('_', $subPerkIds);

    		$company->subPerks()->attach($string[1]);

    		array_push($perkIdArray, $string[0]);

    		$companySubPerkDetail = new CompanySubPerkDetail;

    		$companySubPerkDetail->company_id = $company->id;
    		$companySubPerkDetail->sub_perk_id = $string[1];
    		$companySubPerkDetail->value = 0;

    		$companySubPerkDetail->save();
    	}

    	$attachedPerksToCompany = array();

    	if($company->perks()) {
    		foreach($company->perks as $companyPerk) {
    			array_push($attachedPerksToCompany, $companyPerk->id);
    		}
    	}

    	foreach($perkIdArray as $perkId) {
    		if(!in_array($perkId, $attachedPerksToCompany)) {
    			if (!$company->perks->contains($perkId)) {
    				$company->perks()->attach($perkId);
    			}
    		}
    	}
    }

    if($request->input('title') != null) {
    	$subPerk = new SubPerk;

    	$subPerk->title = $request->input('title');
    	$subPerk->description = $request->input('description');
    	$subPerk->perk_id = $request->input('perkId');
    	$subPerk->slug = str_slug($request->input('title'), '-');
        $subPerk->type = "currency";

    	$subPerk->save();

    	$attachedPerksToCompany = array();

    	if($company->perks()) {
    		foreach($company->perks as $companyPerk) {
    			array_push($attachedPerksToCompany, $companyPerk->id);
    		}
    	}

    	if(!in_array($request->input('perkId'), $attachedPerksToCompany)) {
    		if (!$company->perks->contains($request->input('perkId'))) {
    			$company->perks()->attach($request->input('perkId'));
    		}
    	}

    	$company->subPerks()->attach($subPerk->id);

    	$companySubPerkDetail = new CompanySubPerkDetail;

    	$companySubPerkDetail->company_id = $company->id;
    	$companySubPerkDetail->sub_perk_id = $subPerk->id;
    	$companySubPerkDetail->value = 0;

    	$companySubPerkDetail->save();
    }

	return redirect('/companies/'.$company->slug);
});

Route::get('/companies/{companySlug}/add-sub-perk', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	$company = Company::where('slug', $routeParameters['companySlug'])->first();
	$locations = Location::select('country')->groupBy('country')->get();
	$perks = Perk::orderBy('title', 'asc')->get();
	
	$companySubPerkDetails = CompanySubPerkDetail::where('company_id', $company->id)->get();

	$subPerkIdsFromCompanySubPerkDetailsArray = array();

	foreach($companySubPerkDetails as $companySubPerkDetail) {
		array_push($subPerkIdsFromCompanySubPerkDetailsArray, $companySubPerkDetail->sub_perk_id);
	}

	$subPerks = SubPerk::orderBy('title', 'asc')->get();

	$subPerksToShow = array();

	foreach($subPerks as $subPerk) {
		if(!in_array($subPerk->id, $subPerkIdsFromCompanySubPerkDetailsArray)) {
			array_push($subPerksToShow, $subPerk);
		}
	}

	return view('companies.addSubPerk', [
		'company' => $company,
		'locations' => $locations,
		'perks' => $perks,
		'subPerksToShow' => $subPerksToShow
	]);
});

Route::get('/companies/{companySlug}', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	$company = Company::where('slug', $routeParameters['companySlug'])->first();
	$locations = Location::select('country')->groupBy('country')->get();
	$companySubPerkDetails = CompanySubPerkDetail::where('company_id', $company->id)->get();

	$perkIdsFromSubPerkDetails = array();

	foreach($companySubPerkDetails as $companySubPerkDetail) {
		array_push($perkIdsFromSubPerkDetails, $companySubPerkDetail->subPerk->perk->id);
	}

	$perks = Perk::orderBy('title', 'asc')->get();

	$filledPerks = array();
	$unfilledPerks = array();

	foreach ($perks as $key => $perk) {
		if(in_array($perk->id, $perkIdsFromSubPerkDetails)) {
			array_push($filledPerks, $perk);
		} else {
			array_push($unfilledPerks, $perk);
		}
	}

	return view('companies.show', [
		'company' => $company,
		'locations' => $locations,
		'companySubPerkDetails' => $companySubPerkDetails,
		'filledPerks' => $filledPerks,
		'unfilledPerks' => $unfilledPerks
	]);
});

Route::post('/companies/{companyId}/save-company', function(Request $request) {
    // dd('hi');
    $routeParameters = Route::getCurrentRoute()->parameters();

	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$company = Company::find($routeParameters['companyId']);

		$company->name = $request->input('name');
		$company->description = $request->input('description');
		$company->location_id = $request->input('location');
		$company->slug = str_slug($request->input('name'), '-');
		if(request('image')) {
		    $company->image = Storage::disk('gcs')->put('/avatars', request('image'), 'public');
		}

		$company->save();
		
		return redirect('/companies/'.$company->id.'/edit');
	} else {
		return redirect('/');
	}
})->middleware('auth');

Route::post('/companies/add-company', function(Request $request) {

	$errorsArray = array();

	if($request->input('name') == null) {
		array_push($errorsArray, "The name field is required.");
	}

	if(request('image') == null) {
		array_push($errorsArray, "The image field is required.");
	}

	if($request->input('location') == "Select location") {
		array_push($errorsArray, "The location field is required.");
	}

	if(count($errorsArray) > 0) {
		return redirect('/companies/add-company')->with('errorsArray', $errorsArray)->withInput();
	}

    $routeParameters = Route::getCurrentRoute()->parameters();

    $company = new Company;

    $company->name = $request->input('name');
    $company->description = $request->input('description');
    $company->location_id = $request->input('location');
    $company->slug = str_slug($request->input('name'), '-');

    if(request('image')) {
        $company->image = Storage::disk('gcs')->put('/avatars', request('image'), 'public');
    }

    $company->value = 0;

    $company->save();

    if(Auth::id() != null) {
		if(Auth::user()->email == 'supershazwi@gmail.com') {
			return redirect('/companies/'.$company->id.'/edit');
		} else {
			return redirect('/companies/'.$company->slug);
		} 
	} else {
		return redirect('/companies/'.$company->slug);
	}
});

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

Route::post('/companies/{companyId}/save-company-sub-perk-details', function(Request $request) {
	if(Auth::user()->email == 'supershazwi@gmail.com') {
		$routeParameters = Route::getCurrentRoute()->parameters();

		$companySubPerkDetails = CompanySubPerkDetail::where('company_id', $routeParameters['companyId'])->get();

		$companyValue = 0;
        
		foreach($companySubPerkDetails as $companySubPerkDetail) {
			$companySubPerkDetail->value = $request->input('companySubPerkDetail_'.$companySubPerkDetail->id);
            $companySubPerkDetail->comment = $request->input('companySubPerkDetailComment_'.$companySubPerkDetail->id);

			$companySubPerkDetail->save();

            if($companySubPerkDetail->subPerk->type=="currency" && $companySubPerkDetail->value != -1) {
			    $companyValue += $companySubPerkDetail->value;
            }
		}

		$company = Company::find($routeParameters['companyId']);

		$company->value = $companyValue;

		$company->save();

		return redirect('/companies/'.$routeParameters['companyId'].'/edit');
	} else {
		return redirect('/');
	}
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
				if (!$company->perks->contains($futurePerkId)) {
					$company->perks()->attach($futurePerkId);
				}
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
		return redirect('/');
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
		return redirect('/');
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
        $subPerk->type = "currency";

		$subPerk->save();
		
		return redirect('/sub-perks/'.$subPerk->id);
	} else {
		return redirect('/');
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
		return redirect('/');
	}
});

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
			return redirect('/');
		}
	}
});

Route::get('/perks/{perkSlug}', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	$perk = Perk::where('slug', $routeParameters['perkSlug'])->first();

	$subPerks = array();

	foreach($perk->companies as $company) {
		foreach($company->subPerks as $subPerk) {
			if($subPerk->perk_id == $perk->id) {
				if(empty($subPerks[$company->id])) {
					$subPerks[$company->id] = array();
				}
				array_push($subPerks[$company->id], $subPerk);
			}
		}
	}

	$locations = Location::select('country')->groupBy('country')->get();
	return view('perks.show', [
		'perk' => $perk,
		'locations' => $locations,
		'subPerks' => $subPerks
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
		return redirect('/');
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
		return redirect('/');
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
		return redirect('/');
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
		return redirect('/');
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
		return redirect('/');
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
		return redirect('/');
	}
})->middleware('auth');

// MISC //
Route::get('/about', function() {
	$locations = Location::select('country')->groupBy('country')->get();

	return view('about', [
		'locations' => $locations
	]);
});

Route::post('/password/send-email', function(Request $request) {
    $emailArray['email'] = $request->input('email');

    $user = User::where('email', $request->input('email'))->first();

    if(!$user) {
        return redirect('/password/reset')->with('error', 'User not found.');
    }

    $url = url(config('app.url').route('password.reset', str_random(40), false));

    Mail::to($request->input('email'))->send(new SendResetPasswordLink($user, $url));

    return redirect('password/reset')->with('sent', 'We have e-mailed your password reset link!');

});

Route::get('/likes', function() {
	$locations = Location::select('country')->groupBy('country')->get();
	$likes = Like::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

	return view('likes', [
		'locations' => $locations,
		'likes' => $likes
	]);
})->middleware('auth');

Route::get('/comments', function() {
	$locations = Location::select('country')->groupBy('country')->get();
	$comments = Comment::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

	return view('comments', [
		'locations' => $locations,
		'comments' => $comments
	]);
})->middleware('auth');

Route::post('/user/verify-by-id/{userId}', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $returnArray = array();

    $user = User::find($routeParameters['userId']);

    VerifyUser::where('user_id', $routeParameters['userId'])->delete();

   	$verifyUser = VerifyUser::create([
   	    'user_id' => $user->id,
   	    'token' => str_random(40)
   	]);

   	Mail::to($user->email)->send(new VerifyMail($user));

    return $returnArray;
});

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

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
		return redirect('/');
	}
})->middleware('auth');

Route::post('/profile/edit-password', function (Request $request) {
	$user = Auth::user();

	$validator = Validator::make($request->all(), [
	    'password-current' => 'required',
	    'password-new' => 'required',
	    'password-new-confirm' => 'required'
	]);

	if($validator->fails()) {
	    return redirect('/profile/edit-password')
	                ->withErrors($validator)
	                ->withInput();
	} else {
	    $userdata = array(
	        'email'     => $user->email,
	        'password'  => $request->input('password-current')
	    );

	    if(Auth::attempt($userdata)) {
	        $newPassword = $request->input('password-new');
	        $newPasswordConfirm = $request->input('password-new-confirm');

	        if($newPassword == $newPasswordConfirm) {
	            $user->password = Hash::make($newPassword);
	            $user->save();

	            return redirect('/profile/edit-password')->with('success', 'Password updated.');
	        } else {
	            return redirect('/profile/edit-password')->with('error', 'The new password and the new password confirmation do not match.');
	        }
	    } else {
	        return redirect('/profile/edit-password')->with('error', 'The current password entered does not match.');
	    }
	}
})->middleware('auth');

Route::get('/profile/edit-password', function () {
	$locations = Location::select('country')->groupBy('country')->get();

    return view('editPassword', [
    	'locations' => $locations
    ]);
})->middleware('auth');

Route::get('/profile', function () {
	$locations = Location::select('country')->groupBy('country')->get();

    return view('profile', [
    	'locations' => $locations
    ]);
})->middleware('auth');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', function () {
	$perks = Perk::orderBy('title', 'asc')->get();

	$availablePerks = array();

	foreach($perks as $perk) {
		if(count($perk->companies) > 0) {
			array_push($availablePerks, $perk);
		}
	}

	$companies = Company::orderBy('value', 'desc')->get();
	$locations = Location::select('country')->groupBy('country')->get();

    return view('index', [
    	'perks' => $availablePerks,
    	'companies' => $companies,
    	'locations' => $locations
    ]);
});

Auth::routes(['verify' => true]);