<?php

namespace App\Http\Controllers\police_commisioner;

use App\Http\Controllers\Controller;
class CommisinerControler extends Controller
{
    public function dashboard() {   
        return view('police_commisioner.dashboard');
        }
}
