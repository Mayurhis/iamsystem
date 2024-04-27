<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {

        // $loggedInUserDetails = session()->get('logged_in_user_detail');

        // dd($loggedInUserDetails);

        return view('backend.dashboard');
    }


}
