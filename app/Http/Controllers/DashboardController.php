<?php

namespace App\Http\Controllers;

use App\Models\Educations;
use App\Models\Experiences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $currentUserId;
    public function __construct() {
        $this->currentUserId = Auth::user()->id ;
    }
    public function show_cv_data() {
        //$currentUserId = Auth::user()->id ;
        $currentUserXp = DB::table('experiences')->select('*')->where('user_id', $this->currentUserId)->get();
        
        $currentUserEducation = DB::table('educations')->select('*')->where('user_id', $this->currentUserId)->get();
        
        return view('dashboard', ['experiences' => $currentUserXp, 'educations' => $currentUserEducation]);
    }

    public function destroy($type, $id)
    {
        $type === 'exp' ? Experiences::select('*')->where('id', $id)->delete() : Educations::select('*')->where('id', $id)->delete();        
        return redirect('dashboard');
    }
}
