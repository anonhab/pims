<?php

namespace App\Http\Controllers\police_commisioner;
use App\Models\Prisoner;

use App\Http\Controllers\Controller;
use App\Models\Request;

class CommisinerControler extends Controller
{
    public function dashboard() {   
        return view('police_commisioner.dashboard');
        }
        public function release_prisoner() {   
            return view('police_commisioner.release_form');
            }
            public function releasedprisoners() {  
                $releasedPrisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
                return view('police_commisioner.Released_Prisoners',compact('releasedPrisoners'));
                }
                
                public function ExecuteRequests() {   
                    $approvedRequests = Request::where('status', 'approved')->orWhere('status', 'pending')->get();
                    return view('police_commisioner.process_requests',compact('approvedRequests'));
                    }
            
}
