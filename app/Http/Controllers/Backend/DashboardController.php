<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class DashboardController extends Controller
{
    public function index(UserDataTable $dataTable)
    {

        abort_if(isRolePermission('dashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // $loggedInUserDetails = session()->get('logged_in_user_detail');

        // dd($loggedInUserDetails);

        return $dataTable->render('backend.dashboard');
    }


}
