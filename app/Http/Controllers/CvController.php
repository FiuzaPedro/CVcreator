<?php

namespace App\Http\Controllers;

use App\Models\Educations;
use App\Models\Experiences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    public function renderCV(Request $request)
    {           
        // dd($request);
        $splitTechs = explode(',', $request->techskills);
        $splitSofts = explode(',', $request->softskills);
        
        if(!empty($request->expDate) &&  count($request->expDate) > 0 ) {
            for ($i=0; $i < count($request->expDate); $i++) { 
                Experiences::insert([
                    [
                        'user_id' => Auth::user()->id,
                        'exp_date' => $request->expDate[$i],
                        'workplace' => $request->workplace[$i],
                        'position' => $request->position[$i],
                        'description' => $request->jobdescription[$i] 
                    ]
                ]);    
            }
        }
        
        if(!empty($request->educationDate) &&  count($request->educationDate) > 0 ) {
            for ($i=0; $i < count($request->educationDate); $i++) { 
                Educations::insert([
                    [
                        'user_id' => Auth::user()->id,
                        'edu_date' => $request->educationDate[$i],                        
                        'location' => $request->location[$i],                        
                    ]
                ]);    
            }
        }

        //Experiences values to retrieve
        $expDate = Experiences::select('exp_date')->where('user_id', Auth::user()->id)->get()->pluck('exp_date')->toArray();        
        $workplace = Experiences::select('workplace')->where('user_id', Auth::user()->id)->get()->pluck('workplace')->toArray();
        $position = Experiences::select('position')->where('user_id', Auth::user()->id)->get()->pluck('position')->toArray();
        $description = Experiences::select('description')->where('user_id', Auth::user()->id)->get()->pluck('description')->toArray();
        //Educations values to retrieve
        $educationDate = Educations::select('edu_date')->where('user_id', Auth::user()->id)->get()->pluck('edu_date')->toArray();
        $location = Educations::select('location')->where('user_id', Auth::user()->id)->get()->pluck('location')->toArray();
        
        return view(
            'cv',
            [
                'name' => $request->name,                
                'role' => $request->role,                
                'imgSrc' => $request->imgSrc,
                'about' => $request->about,
                'softskills' => $splitSofts,
                'techskills' => $splitTechs,
                'expDate' => $expDate,
                'workplace' => $workplace,
                'position' => $position,
                'jobdescription' => $description,
                'educationDate' => $educationDate,
                'location' => $location,
                'ptLevel' => $request->ptLevel,
                'ukLevel' => $request->ukLevel,
                'frLevel' => $request->frLevel,
                'deLevel' => $request->deLevel
            ]
        );
    }
}
