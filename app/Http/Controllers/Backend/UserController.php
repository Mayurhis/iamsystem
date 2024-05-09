<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Response;
use \App\DataTables\UserDataTable;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;


class UserController extends BaseController
{
    private $filePath;

    public function __construct()
    {
        $this->filePath = storage_path('app/users.json');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        abort_if(isRolePermission('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try{

            return $dataTable->render('backend.users.index');

        }catch (\Exception $e) {    
            return abort(500);
        }
     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(isRolePermission('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backend.users.create');     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try{                

            $users = json_decode(file_get_contents($this->filePath), true);

            $lastId = 0;
            if($users){
                $lastId = count($users) > 0 ? $users[count($users) - 1]['id'] : 0;
            }

            $newUserId = $lastId + 1;

            $newUser = [
                'id'            => $newUserId,
                'aud'           => $request->aud,
                'role'          => 'customer',
                'email'         => $request->email,
                'username'      => $request->username,
                'password'      => $request->password,
                'language'      => strtolower($request->language),
                'type'          => $request->type,
                'is_confirmed'  => $request->confirmed ? 1 : 0,
                'confirmed_at'  => $request->confirmed ? now() : null,
                'invited_at'    => null,
                'confirmation_token'         => null,
                'confirmation_sent_at'       => null,
                'email_change_token'         => null,
                'email_change_sent_at'       => null,
                'last_login_at'              => null,
                'metadata'                   => null,
                'status'                     => $request->status,
                'created_at' => now(),
                'updated_at' => null,
                'deleted_at' => null,
            ];
            
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
        abort_if(isRolePermission('user_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $data = json_decode(file_get_contents($this->filePath), true);
        
        $index = findIndexById($data, $id);

        if ($index !== null) {

            $user = $data[$index] ?? null;

            return view('backend.users.show', compact('user'));
        }else{
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        abort_if(isRolePermission('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = json_decode(file_get_contents($this->filePath), true);
        
        $index = findIndexById($data, $id);

        if ($index !== null) {

            $user = $data[$index] ?? null;

            return view('backend.users.edit', compact('user'));
        }else{
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try{                

            $data = json_decode(file_get_contents($this->filePath), true);

            $input = $request->except(['_token','_method']);            ;

            $index = findIndexById($data, $id);

            if ($index !== null) {

                $input['is_confirmed'] = $request->confirmed ? 1 : 0;
                $input['confirmed_at'] = $request->confirmed ? now() : null;

                $input['updated_at'] = now();

                $data[$index] = array_merge($data[$index], $input);
                
                file_put_contents($this->filePath, json_encode($data));

                return $this->sendSuccessResponse(trans('messages.curd.update_record'));
            }

        } catch (\Exception $e) {
            // dd($e);
            $this->sendErrorResponse(trans('messages.error_message'),500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
