<?php

namespace App\Http\Controllers\Backend;

use Gate;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{
    private $filePath;

    public function __construct()
    {
        // Set the path to the JSON file
        $this->filePath = storage_path('app/users.json');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd(authUserDetail('data.user'));

        try{

            return $dataTable->render('backend.users.index');

        }catch (\Exception $e) {    
            return abort(500);
        }
     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()) {
            try{                
               
                $viewHTML = view('backend.users.create')->render();
                
                $data['htmlView'] = $viewHTML;
                return $this->sendSuccessResponse(trans('messages.record_retrieved_successfully'), $data);
            } 
            catch (\Exception $e) {
                // dd($e);
                $this->sendErrorResponse(trans('messages.error_message'),500);
            }
        }
        return $this->sendErrorResponse(trans('messages.error_message'),400);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_prefix'   => ['required'],
            'first_name'    => ['required'],
            'middle_name'   => [],
            'last_name'     => ['required'],
            'dob'           => ['required'],
            'email'         => ['required'],
            'phone'         => ['required'],
            'gender'        => ['required'],
            // 'address_line_one' => ['required'],
            // 'address_line_two' => ['required'],
            // 'post_code'        => ['required'],
            // 'city'             => ['required'],
            // 'region'           => ['required'],
            // 'country_of_residence' => ['required'],
        ]);

        try{                

            $users = json_decode(file_get_contents($this->filePath), true);

            $lastId = 0;
            if($users){
                $lastId = count($users) > 0 ? $users[count($users) - 1]['id'] : 0;
            }

            $newUserId = $lastId + 1;

            $newUser = $request->except('_token');
            $newUser['id'] = $newUserId;

            if($request->middle_name){
                $newUser ['name'] = ucwords($request->name_prefix.' '.$request->first_name.' '.$request->middle_name.' '.$request->last_name);
            }else{
                $newUser ['name'] = ucwords($request->name_prefix.' '.$request->first_name.' '.$request->last_name);
            }

            $newUser = array('id' => $newUser['id']) + $newUser;

            $users[] = $newUser;
            
            file_put_contents($this->filePath, json_encode($users));

            return $this->sendSuccessResponse(trans('messages.curd.add_record'));
            
        } catch (\Exception $e) {
            // dd($e);
            $this->sendErrorResponse(trans('messages.error_message'),500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('backend.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
