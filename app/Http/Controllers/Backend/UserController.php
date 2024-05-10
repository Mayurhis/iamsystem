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

        $languageJson = storage_path('app/languages.json');
        $languages = json_decode(file_get_contents($languageJson));
        
        return view('backend.users.create',compact('languages'));     
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
                'role'          => $request->role ?? null,
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
                'metadata'                   => $request->metadata ?? null,
                'status'                     => $request->status,
                'created_at' => now(),
                'updated_at' => null,
                'deleted_at' => null,
            ];
            

            // Api
            // postRequest($url, $body = null, $params = "", $formType = '', $formData = '')
            // $url = $this->getApiUrl().'/users';
            // $result = $this->postRequest($url, $newUser);

            // dd($result);

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

            //Api
            $url = $this->getApiUrl().'/user/email/'.$user['email'];
           
            $apiResponse  = $this->IAMGetRequest($url);

            if($apiResponse['code'] == 200){

                $user = $apiResponse['response']['data']['user'];

                return view('backend.users.show', compact('user'));
            }else{
                return abort(404);
            }
            
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
            
            $languageJson = storage_path('app/languages.json');
            $languages = json_decode(file_get_contents($languageJson));

            return view('backend.users.edit', compact('user','languages'));
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

            $input = $request->except(['_token','_method','user_id']);

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
    
    public function changeUserPassword($id){
        abort_if(isRolePermission('user_change_password'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $data = json_decode(file_get_contents($this->filePath), true);
        
        $index = findIndexById($data, $id);

        if ($index !== null) {

            $user = $data[$index] ?? null;
            
            $languageJson = storage_path('app/languages.json');
            $languages = json_decode(file_get_contents($languageJson));

            return view('backend.users.change-user-password', compact('user'));
        }else{
            return abort(404);
        }
    }
    
    public function submitChangeUserPassword(Request $request,$id){
        $request->validate([
            'password'=>[
                'required',
                'string',
                'min:'.config('constant.password_min_length'),
                'regex:'.config('constant.password_regex')
            ]
        ],[
            'password.regex' => trans('messages.password_regex'),
        ]);
        
        try{                

            $data = json_decode(file_get_contents($this->filePath), true);

            $input = $request->except(['_token','_method','user_id']);

            $index = findIndexById($data, $id);

            if ($index !== null) {

                $input['password'] = $request->password;

                $input['updated_at'] = now();

                $data[$index] = array_merge($data[$index], $input);
                
                file_put_contents($this->filePath, json_encode($data));

                return $this->sendSuccessResponse('User Password Updated Successfully!');
            }

        } catch (\Exception $e) {
            // dd($e);
            $this->sendErrorResponse(trans('messages.error_message'),500);
        }
    }
    
    
    public function showCreateAccessToken($id){
        abort_if(isRolePermission('user_create_access_token'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = json_decode(file_get_contents($this->filePath), true);
        
        $index = findIndexById($data, $id);

        if ($index !== null) {

            $user = $data[$index] ?? null;

            return view('backend.users.create_access_token', compact('user'));
        }else{
            return abort(404);
        }
    }
    
    public function submitAccessToken(Request $request, $id){
        
        
        $credentialsOnly = $request->validate([
            'email'    => ['required','email','regex:/^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,4}$/i'],
            'password' => ['required'],
        ]);
        
         
        try{                

            $url = $this->getApiUrl().'/login';
            $result = $this->IAMPostRequest($url, $credentialsOnly);

            if(isset($result['code']) && $result['code'] == 200){
                
                if($result['response']){
                    $access_token = $result['response']['data']['access_token'];
                    return $this->sendSuccessResponse('Access Token Generated Successfully!',['access_token'=>$access_token]);
                }
            }
            
           return $this->sendErrorResponse('Invalid Credentials',500);
        
        } catch (\Exception $e) {
            // dd($e);
            return $this->sendErrorResponse(trans('messages.error_message'),500);
        }
    }
}
