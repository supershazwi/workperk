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
use App\CultureImage;
use App\Job;
use App\Like;
use App\Location;
use App\Notification;
use App\Perk;
use App\Shoutout;
use App\SubPerk;
use App\User;
use App\VerifyUser;
use App\Mail\VerifyMail;

// SHOUTOUTS //


Route::post('/shoutouts/approve', function(Request $request) {
    $shoutout = Shoutout::find($request->input('shoutout_id'));

    $shoutout->approved = true;

    $shoutout->save();

    return redirect('/companies/'.$request->input('company_slug'));
});

// NOTIFICATIONS //
Route::get('/notifications', function() {
    // check if a company is created already
    $locations = Location::all();

    $notifications = Notification::where('recipient_id', Auth::id())->orderBy('created_at', 'desc')->get();

    foreach($notifications as $notification) {
        $notification->read = true;

        $notification->save();
    }

    return view('notifications.index', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
        'notifications' => $notifications,
        'locations' => $locations
    ]);

})->middleware('auth');

// JOBS //

Route::post('/jobs/add-job', function(Request $request) {
    // check if a company is created already

    $errorsArray = array();

    if($request->input('title') == null || $request->input('level') == null || $request->input('location') == null || $request->input('company') == null || $request->input('visibility') == null || $request->input('job_description') == null || $request->input('job_progression') == null || $request->input('type') == null) {

        if($request->input('title') == null) {
            array_push($errorsArray, "The title field is required.");
        }

        if($request->input('level') == null) {
            array_push($errorsArray, "The level field is required.");
        }

        if($request->input('location') == null) {
            array_push($errorsArray, "The location field is required.");
        }

        if($request->input('visibility') == null) {
            array_push($errorsArray, "The visibility field is required.");
        }

        if($request->input('company') == null) {
            array_push($errorsArray, "The company field is required.");
        }

        if($request->input('job_description') == null) {
            array_push($errorsArray, "The job description field is required.");
        }

        if($request->input('job_progression') == null) {
            array_push($errorsArray, "The job progression field is required.");
        }

        if($request->input('interview_process') == null) {
            array_push($errorsArray, "The interview process field is required.");
        }

        if($request->input('type') == null) {
            array_push($errorsArray, "The type field is required.");
        }
    }
    

    if(count($errorsArray) > 0) {
        return redirect('/jobs/add-job')->with('errorsArray', $errorsArray)->withInput();
    } 

    $job = new Job;

    $job->title = $request->input('title');
    $company = Company::find($request->input('company'));
    $job->slug = strtolower($company->name) . '-' . str_slug($request->input('title'), '-');
    $job->level = $request->input('level');
    $job->type = $request->input('type');
    $job->visible = $request->input('visibility');
    $job->location_id = $request->input('location');
    $job->company_id = $request->input('company');
    $job->user_id = Auth::id();
    $job->description = $request->input('job_description');
    $job->interview_process = $request->input('interview_process');
    $job->progression = $request->input('job_progression');

    $job->save();

    return redirect('/companies/'.$request->input('company').'/edit/jobs');

})->middleware('auth');

Route::get('/jobs/add-job', function() {
    // check if a company is created already
    $locations = Location::all();

    $companies = Company::where('user_id', Auth::id())->get();

    return view('jobs.add', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
        'locations' => $locations,
        'companies' => $companies
    ]);

})->middleware('auth');
Route::get('/jobs/{jobId}', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $job = Job::find($routeParameters['jobId']);

    if($job == null || $job->user_id != Auth::id()) {
        return redirect('/');
    }

    $company = $job->company;
    $locations = Location::select('country')->groupBy('country')->get();
    $companySubPerkDetails = CompanySubPerkDetail::where('company_id', $company->id)->get();

    $perkIdsFromSubPerkDetails = array();

    $cultureSubPerkDetails = array();

    foreach($companySubPerkDetails as $companySubPerkDetail) {
        array_push($perkIdsFromSubPerkDetails, $companySubPerkDetail->subPerk->perk->id);
        if($companySubPerkDetail->subPerk->perk_id == 15) {
            array_push($cultureSubPerkDetails, $companySubPerkDetail);
        }
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

    return view('jobs.show', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
        'locations' => $locations,
        'job' => $job,
        'companySubPerkDetails' => $companySubPerkDetails,
        'filledPerks' => $filledPerks,
        'unfilledPerks' => $unfilledPerks
    ]);
});

Route::post('/jobs/{jobId}/edit', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

    // check if a company is created already

    $errorsArray = array();

    if($request->input('title') == null || $request->input('level') == null || $request->input('location') == null || $request->input('company') == null || $request->input('visibility') == null || $request->input('job_description') == null || $request->input('job_progression') == null || $request->input('type') == null) {

        if($request->input('title') == null) {
            array_push($errorsArray, "The title field is required.");
        }

        if($request->input('level') == null) {
            array_push($errorsArray, "The level field is required.");
        }

        if($request->input('location') == null) {
            array_push($errorsArray, "The location field is required.");
        }

        if($request->input('visibility') == null) {
            array_push($errorsArray, "The visibility field is required.");
        }

        if($request->input('company') == null) {
            array_push($errorsArray, "The company field is required.");
        }

        if($request->input('job_description') == null) {
            array_push($errorsArray, "The job description field is required.");
        }

        if($request->input('job_progression') == null) {
            array_push($errorsArray, "The job progression field is required.");
        }

        if($request->input('type') == null) {
            array_push($errorsArray, "The type field is required.");
        }
    }
    

    if(count($errorsArray) > 0) {
        return redirect('/jobs/add-job')->with('errorsArray', $errorsArray)->withInput();
    } 

    $job = Job::find($routeParameters['jobId']);

    $job->title = $request->input('title');
    $company = Company::find($request->input('company'));
    $job->slug = strtolower($company->name) . '-' . str_slug($request->input('title'), '-');
    $job->level = $request->input('level');
    $job->type = $request->input('type');
    $job->visible = $request->input('visibility');
    $job->location_id = $request->input('location');
    $job->company_id = $request->input('company');
    $job->user_id = Auth::id();
    $job->description = $request->input('job_description');
    $job->progression = $request->input('job_progression');

    $job->save();

    return redirect('/companies/'.$request->input('company').'/edit/jobs'); 

})->middleware('auth');


Route::get('/jobs/{jobId}/edit', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $locations = Location::all();

    $job = Job::find($routeParameters['jobId']);
    $companies = Company::where('user_id', Auth::id())->get();

    return view('jobs.edit', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
        'locations' => $locations,
        'companies' => $companies,
        'job' => $job
    ]);
})->middleware('auth');


// COMMENTS //
Route::post('/find-companies', function(Request $request) {


    if($request->input('clickedPerks') == null) {
        return redirect('/find-companies')->with('error', 'You have not selected any perks below. Therefore, we are unable to find companies to fit your preferences.');
    }

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
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
        'parameter' => 'findCompanies',
        'locations' => $locations,
        'rowArray' => $rowArray,
        'colArray' => $colArray
    ]);

});

Route::get('/for-companies', function() {
    $locations = Location::all();

    return view('forCompanies', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
        'parameter' => 'forCompanies',
        'locations' => $locations
    ]);
});

Route::get('/find-companies', function() {
    $locations = Location::all();
    $perks = Perk::orderBy('title', 'asc')->get();

    return view('findCompanies', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
        'parameter' => 'findCompanies',
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
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
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
Route::post('/companies/{companySlug}/shoutout', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $company = Company::where('slug', $routeParameters['companySlug'])->first();

    $errorsArray = array();

    if(request('content') == null) {
        array_push($errorsArray, "Please provide a shoutout.");
    }

    if($request->input('subPerk') == null) {
        array_push($errorsArray, "Select a specific cultural value to give a shoutout about.");
    }

    if(count($errorsArray) > 0) {
        return redirect('/companies/'.$company->slug.'/shoutout')->with('errorsArray', $errorsArray)->withInput();
    }

    $shoutout = new Shoutout;

    $shoutout->content = $request->input('content');
    $shoutout->company_id = $company->id;
    $shoutout->user_id = Auth::id();
    $shoutout->sub_perk_id = $request->input('subPerk');
    $shoutout->approved = 0;

    $shoutout->save();

    $notification = new Notification;

    $notification->message = "has submitted a shoutout on the company profile.";
    $notification->recipient_id = $company->user_id;
    $notification->user_id = Auth::id();
    $notification->url = "/companies/".$company->slug."#".$shoutout->id;
    $notification->read = 0;

    $notification->save();

    return redirect('companies/'.$company->slug.'#test');

})->middleware('auth');

Route::get('/companies/{companySlug}/shoutout', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();
    $locations = Location::all();

    $company = Company::where('slug', $routeParameters['companySlug'])->first();

    return view('companies.shoutout', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
        'locations' => $locations,
        'company' => $company
    ]);
})->middleware('auth');

Route::post('/companies/{companyId}/unclaim', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $company = Company::find($routeParameters['companyId']);

    $company->user_id = null;

    $company->save();

    return redirect('/claim')->with('claimed', 'You have unclaimed ' . $company->name . '.');
});

Route::post('/companies/{companyId}/claim', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $company = Company::find($routeParameters['companyId']);

    $company->user_id = Auth::id();

    $company->save();

    return redirect('/claim')->with('claimed', 'You have claimed ' . $company->name . '. Please go to the dashboard to view it.');
});

Route::get('/companies/add-company', function() {
	$locations = Location::all();

	return view('companies.add', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
		'locations' => $locations
	]);
});

Route::get('/companies/{companySlug}/perks/{perkSlug}', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $company = Company::where('slug', $routeParameters['companySlug'])->first();
    $perk = Perk::where('slug', $routeParameters['perkSlug'])->first();
	$locations = Location::select('country')->groupBy('country')->get();
	
	return view('companies.managePerk', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
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

Route::get('/companies/{companyId}/edit/perks-sub-perks', function() {
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

        return view('companies.perksSubPerks', [
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
            'company' => $company,
            'locations' => $locations,
            'subPerks' => $subPerks,
            'taggedSubPerkIds' => $taggedSubPerkIds,
            'taggedSubPerkString' => $taggedSubPerkString,
            'companySubPerkDetails' => $companySubPerkDetails
        ]);
})->middleware('auth');

Route::get('/companies/{companyId}/edit/jobs', function() {
        $routeParameters = Route::getCurrentRoute()->parameters();

        $company = Company::find($routeParameters['companyId']);
        $locations = Location::all();

        $jobs = Job::where('company_id', $company->id)->get();


        return view('companies.jobs', [
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
            'company' => $company,
            'jobs' => $jobs,
            'locations' => $locations
        ]);
})->middleware('auth');

Route::get('/companies/{companyId}/edit/culture', function() {
        $routeParameters = Route::getCurrentRoute()->parameters();

        $company = Company::find($routeParameters['companyId']);
        $companySubPerkDetails = CompanySubPerkDetail::where('company_id', $routeParameters['companyId'])->get();
        $locations = Location::all();

        $companyCultureSubPerkDetails = array();
        $companyCultureSubPerkDetailsId = array();

        foreach($companySubPerkDetails as $companySubPerkDetail) {
            if($companySubPerkDetail->subPerk->perk_id == 15) {
                array_push($companyCultureSubPerkDetails, $companySubPerkDetail);
                array_push($companyCultureSubPerkDetailsId, $companySubPerkDetail->subPerk->id);
            }
        }

        $companyCultureSubPerkDetailsId = implode(",", $companyCultureSubPerkDetailsId);

        return view('companies.culture', [
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
            'company' => $company,
            'companySubPerkDetails' => $companySubPerkDetails,
            'companyCultureSubPerkDetailsId' => $companyCultureSubPerkDetailsId,
            'locations' => $locations
        ]);
})->middleware('auth');

Route::get('/companies/{companyId}/edit', function() {
		$routeParameters = Route::getCurrentRoute()->parameters();

		$company = Company::find($routeParameters['companyId']);
		$locations = Location::all();

		return view('companies.edit', [
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
			'company' => $company,
			'locations' => $locations
		]);
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
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
    	'company' => $company,
    	'locations' => $locations,
    	'companySubPerkDetail' => $companySubPerkDetail
    ]);
});

Route::post('/companies/{companyId}/add-sub-perk', function(Request $request) {
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
    	return redirect('/companies/'.$routeParameters['companyId'].'/add-sub-perk')->with('errorsArray', $errorsArray)->withInput();
    }

	$company = Company::find($routeParameters['companyId']);
    
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

	return redirect('/companies/'.$company->id.'/edit/perks-sub-perks');
});

Route::get('/companies/{companyId}/add-sub-perk', function() {
    $routeParameters = Route::getCurrentRoute()->parameters();

	$company = Company::find($routeParameters['companyId']);
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
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
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

    $cultureSubPerkDetails = array();

    $showCulturePerks = true;

	foreach($companySubPerkDetails as $companySubPerkDetail) {
		array_push($perkIdsFromSubPerkDetails, $companySubPerkDetail->subPerk->perk->id);
        if($companySubPerkDetail->subPerk->perk_id == 15) {
            array_push($cultureSubPerkDetails, $companySubPerkDetail);

            if($companySubPerkDetail->comment == null) {
                $showCulturePerks = false;
            }
        }
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
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
		'company' => $company,
		'locations' => $locations,
		'companySubPerkDetails' => $companySubPerkDetails,
		'filledPerks' => $filledPerks,
		'unfilledPerks' => $unfilledPerks,
        'cultureSubPerkDetails' => $cultureSubPerkDetails,
        'showCulturePerks' => $showCulturePerks
	]);
});

Route::post('/companies/{companyId}/save-company', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

		$company = Company::find($routeParameters['companyId']);

		$company->name = $request->input('name');
		$company->description = $request->input('description');
		$company->location_id = $request->input('location');
		$company->slug = str_slug($request->input('name'), '-');
		if(request('image')) {
		    $company->image = Storage::disk('gcs')->put('/avatars', request('image'), 'public');
		}
        if(request('cover')) {
            $company->cover = Storage::disk('gcs')->put('/avatars', request('cover'), 'public');
        }
        $company->premium = true;

        $company->website = $request->input('website');
        $company->facebook = $request->input('facebook');
        $company->twitter = $request->input('twitter');
        $company->instagram = $request->input('instagram');
        $company->youtube = $request->input('youtube');
        $company->linkedin = $request->input('linkedin');
        $company->address = $request->input('address');
        $company->contact = $request->input('contact');
        $company->brief = $request->input('brief');
        $company->type = $request->input('type');
        $company->instagram = $request->input('instagram');
        $company->visible = $request->input('visibility');

		$company->save();
		
		return redirect('/companies/'.$company->id.'/edit');
	
})->middleware('auth');

Route::post('/companies/add-company', function(Request $request) {

	$errorsArray = array();

    if(request('image') == null) {
        array_push($errorsArray, "The image field is required.");
    }

	if($request->input('name') == null) {
		array_push($errorsArray, "The name field is required.");
	}

    if($request->input('description') == null) {
        array_push($errorsArray, "The description field is required.");
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
    $company->visible = false;

    if(request('image')) {
        $company->image = Storage::disk('gcs')->put('/avatars', request('image'), 'public');
    }

    $company->value = 0;
    $company->user_id = Auth::id();

    $company->save();

    return redirect('/companies/'.$company->id.'/edit');
    
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
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
		'locations' => $locations,
		'subPerk' => $subPerk,
		'company' => $company,
		'likeClicked' => $likeClicked,
		'companySubPerkDetail' => $companySubPerkDetail
	]);
});

Route::post('/companies/{companyId}/save-company-sub-perk-details', function(Request $request) {
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

		return redirect('/companies/'.$routeParameters['companyId'].'/edit/perks-sub-perks');
});

Route::post('/companies/{companyId}/save-culture', function(Request $request) {
    $routeParameters = Route::getCurrentRoute()->parameters();

    $cultureSubPerks = SubPerk::where('perk_id', 15)->get();

    foreach($cultureSubPerks as $subPerk) {
        if($request->input('subPerk_'.$subPerk->id)) {
            $companySubPerkDetail = CompanySubPerkDetail::where("company_id", $routeParameters['companyId'])->where('sub_perk_id', $subPerk->id)->first();

            $companySubPerkDetail->comment = $request->input('subPerk_'.$subPerk->id);

            $companySubPerkDetail->save();
        }

        if(request('image_'.$subPerk->id)) {
            $companySubPerkDetail = CompanySubPerkDetail::where("company_id", $routeParameters['companyId'])->where('sub_perk_id', $subPerk->id)->first();

            $images = request('image_'.$subPerk->id);
            foreach($images as $image) {
                $cultureImage = new CultureImage;

                $cultureImage->url = Storage::disk('gcs')->put('/avatars', $image, 'public');
                $cultureImage->type = "image";
                $cultureImage->company_sub_perk_detail_id = $companySubPerkDetail->id;
                $cultureImage->user_id = Auth::id();

                $cultureImage->save();
            }
        
        }
    }

    return redirect('/companies/'.$routeParameters['companyId'].'/edit/culture');
});

Route::post('/companies/{companyId}/save-overall-perks', function(Request $request) {
		$routeParameters = Route::getCurrentRoute()->parameters();
		$originalTaggedSubPerkIds = $request->input('taggedSubPerkIds');
		$company = Company::find($routeParameters['companyId']);

		$overallPerkIdArray = explode(",", $request->input('overallPerkIds'));

		if($overallPerkIdArray == null) {
			$company->perks()->detach();
			$company->subPerks()->detach();
			$companySubPerkDetails = CompanySubPerkDetail::where('company_id', $company->id)->get();
			foreach($companySubPerkDetails as $companySubPerkDetail) {
				Like::where('company_sub_perk_detail_id', $companySubPerkDetail->id)->delete();
				Comment::where('company_sub_perk_detail_id', $companySubPerkDetail->id)->delete();
				CompanySubPerkDetail::destroy($companySubPerkDetail->id);
			}

			return redirect('/companies/'.$routeParameters['companyId'].'/edit/perks-sub-perks');
		}

		$futureSubPerkIdArray = array();
		$futurePerkIdArray = array();
		$originalSubPerkIdArray = array();
		$originalPerkIdArray = array();

		foreach($overallPerkIdArray as $overallPerkId) {
			$string = explode('_', $overallPerkId);
            if(!empty($string[0])) {
    			array_push($futurePerkIdArray, $string[0]);
    			array_push($futureSubPerkIdArray, $string[1]);
            }
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

		return redirect('/companies/'.$routeParameters['companyId'].'/edit/perks-sub-perks');
	
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
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
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
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
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
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
			'subPerk' => $subPerk,
			'locations' => $locations
		]);
	} else {
		if(Auth::user()->email == "supershazwi@gmail.com") {
			$subPerk = SubPerk::find($routeParameters['subPerkSlugOrId']);

			return view('subPerks.edit', [
                'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
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
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
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
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
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
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
			'perk' => $perk,
			'locations' => $locations
		]);
	} else {
		return redirect('/');
	}
})->middleware('auth');

// MISC //
// Route::get('/shopping-cart', function() {
//     $locations = Location::select('country')->groupBy('country')->get();

//     return view('shoppingCart', [
//         'locations' => $locations
//     ]);
// });

Route::get('/about', function() {
	$locations = Location::select('country')->groupBy('country')->get();

	return view('about', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
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
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
		'locations' => $locations,
		'likes' => $likes
	]);
})->middleware('auth');

Route::get('/comments', function() {
	$locations = Location::select('country')->groupBy('country')->get();
	$comments = Comment::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

	return view('comments', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
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
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
		'locations' => $locations
	]);
});

Route::get('/terms-conditions', function() {
	$locations = Location::select('country')->groupBy('country')->get();

	return view('terms', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
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
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
			'perks' => $perks,
			'companies' => $companies,
    		'locations' => $locations
		]);
	} else {
        $perks = Perk::all();
        $companies = Company::where('user_id', Auth::id())->get();
        $locations = Location::select('country')->groupBy('country')->get();

		return view('companyDashboard', [
            'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
            'perks' => $perks,
            'companies' => $companies,
            'locations' => $locations
        ]);
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
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
    	'locations' => $locations
    ]);
})->middleware('auth');

Route::post('/profile', function (Request $request) {
    $locations = Location::select('country')->groupBy('country')->get();

    if($request->avatar) {
        $user = Auth::user();
        $user->avatar = Storage::disk('gcs')->put('/avatars', request('avatar'), 'public');
        $user->save();
    }

    return redirect('profile');
})->middleware('auth');

Route::get('/profile', function () {
	$locations = Location::select('country')->groupBy('country')->get();

    return view('profile', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
    	'locations' => $locations
    ]);
})->middleware('auth');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/claim', function () {
    $companies = Company::orderBy('value', 'desc')->get();
    $locations = Location::select('country')->groupBy('country')->get();

    return view('claim', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
        'companies' => $companies,
        'locations' => $locations
    ]);
});

Route::get('/', function () {
	$perks = Perk::orderBy('title', 'asc')->get();

	$availablePerks = array();

	foreach($perks as $perk) {
		if(count($perk->companies) > 0) {
			array_push($availablePerks, $perk);
		}
	}

	$companies = Company::orderBy('value', 'desc')->where('visible', true)->get();
	$locations = Location::select('country')->groupBy('country')->get();

    return view('index', [
        'notificationCount' => Notification::where('recipient_id', Auth::id())->where('read', 0)->count(),
    	'perks' => $availablePerks,
    	'companies' => $companies,
    	'locations' => $locations
    ]);
});

Auth::routes(['verify' => true]);