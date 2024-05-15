<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Response;
use \App\DataTables\UserDataTable;

use App\Services\IAMHttpService;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;


class UserController extends BaseController
{
    private $filePath;

    public $iam;

    public function __construct()
    {
        $this->filePath = public_path('backend/json/users.json');
        $this->iam = new IAMHttpService();
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

        $languageJson = public_path('backend/json/languages.json');
        
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

            // Api
            $isUserCreated = false;
            $createdUserId = '';

            $insertRecords = [
                'aud'           => $request->aud,
                'role'          => implode(',',$request->role),
                'email'         => $request->email,
                'password'      => $request->password,
                'language'      => strtolower($request->language),
                'is_confirmed'  => $request->confirmed ? true : false,
                'type'          => $request->type,
                'metadata'      => json_decode($request->metadata,true),
            ];

            if($request->username){
                $insertRecords['username'] = $request->username;
            }

            $apiResponse = $this->iam->adminCreateUser($insertRecords);

            if ($apiResponse['code'] == 200) {
                $newUser = [
                    'ID'            => $apiResponse['response']['data']['user']['ID'],
                    'aud'           => $apiResponse['response']['data']['user']['aud'],
                    'role'          => $apiResponse['response']['data']['user']['role'],
                    'email'         => $apiResponse['response']['data']['user']['email'],
                    'username'      => $apiResponse['response']['data']['user']['username'],
                    'password'      => $request->password,
                    'language'      => strtolower($apiResponse['response']['data']['user']['language']),
                    'type'          => $apiResponse['response']['data']['user']['type'],
                    'is_confirmed'  => $apiResponse['response']['data']['user']['is_confirmed'],
                    'last_login_at'              => null,
                    'metadata'                   => null,
                    'status'                     => $apiResponse['response']['data']['user']['status'],
                    'access_token'               => $apiResponse['response']['data']['access_token'],
                    'refresh_token'              => $apiResponse['response']['data']['refresh_token'],
                    'created_at' => $apiResponse['response']['data']['user']['created_at'],
                    'updated_at' => $apiResponse['response']['data']['user']['updated_at'],
                    'deleted_at' => $apiResponse['response']['data']['user']['deleted_at'],
                ];

                $isUserCreated = true;
                $createdUserId = $apiResponse['response']['data']['user']['ID'];
                
            }else if($apiResponse['code'] == 400){
                return $this->sendErrorResponse(ucwords($apiResponse['message']),400);
            }

            if($isUserCreated){

                $updatedFields = $this->updateFormFields($createdUserId,$request->status,$request->role);
                $newUser['status'] = $updatedFields['status'] ?? null;
                $newUser['role'] = $updatedFields['role'] ?? null;

                $users[] = $newUser;
            
                file_put_contents($this->filePath, json_encode($users));
    
                return $this->sendSuccessResponse(trans('messages.curd.add_record'));

            }else{

                return $this->sendErrorResponse(trans('messages.error_message'),500);

            }
           
            
        } catch (\Exception $e) {

            // dd('Error in UserController::store (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            \Log::channel('iamsystemlog')->error('Error in UserController::store (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return $this->sendErrorResponse(trans('messages.error_message'),500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(isRolePermission('user_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            
        $apiResponse =  $this->iam->adminFindUserById($id);

        if($apiResponse['code'] == 200){

            $user = $apiResponse['response']['data']['user'];

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

        $apiResponse =  $this->iam->adminFindUserById($id);

        if($apiResponse['code'] == 200){

            $user = $apiResponse['response']['data']['user'];

            $languageJson = public_path('backend/json/languages.json');
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

                $getUserObject = $data[$index];
                $updateRecords = $this->updateFormFields($id,$request->status,$request->role);

                if(count($updateRecords) > 0){
                    $data[$index] = array_merge($data[$index], $updateRecords);
                
                    file_put_contents($this->filePath, json_encode($data));
                }
                

                return $this->sendSuccessResponse(trans('messages.curd.update_record'));
            }

        } catch (\Exception $e) {
            //   dd('Error in UserController::update (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            \Log::channel('iamsystemlog')->error('Error in UserController::update (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return $this->sendErrorResponse(trans('messages.error_message'),500);
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
        
        $apiResponse =  $this->iam->adminFindUserById($id);

        if($apiResponse['code'] == 200){

            $user = $apiResponse['response']['data']['user'];

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

                //Start Update Password 
                $updatePassword['password'] = $request->password;
                $apiResponse = $this->iam->adminUpdateUserPassword($id,$updatePassword);

                if($apiResponse['code'] == 200){
                    $input['password']   = $updatePassword['password'];

                    $data[$index] = array_merge($data[$index], $input);
                
                    file_put_contents($this->filePath, json_encode($data));
    
                    return $this->sendSuccessResponse('User Password Updated Successfully!');
                }
               //End Update Password

               return $this->sendErrorResponse(trans('messages.error_message'),500);
             
            }

        } catch (\Exception $e) {
               //   dd('Error in UserController::submitChangeUserPassword (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            \Log::channel('iamsystemlog')->error('Error in UserController::submitChangeUserPassword (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return $this->sendErrorResponse(trans('messages.error_message'),500);
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
        
        $credentialsOnly = $this->iam->checkLoginRequestCredentials($request);
         
        try{                

            $result = $this->iam->login($credentialsOnly);

            if(isset($result['code']) && $result['code'] == 200){
                
                if($result['response']){
                    $access_token = $result['response']['data']['access_token'];
                    return $this->sendSuccessResponse('Access Token Generated Successfully!',['access_token'=>$access_token]);
                }
            }
            
           return $this->sendErrorResponse('Invalid Credentials',500);
        
        } catch (\Exception $e) {
            //   dd('Error in UserController::submitChangeUserPassword (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            \Log::channel('iamsystemlog')->error('Error in UserController::submitAccessToken (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return $this->sendErrorResponse(trans('messages.error_message'),500);
        }
    }

    public function updateFormFields($userId,$status,$role){
        $updateRecords = [];

        //Start Update status 
        $status_ApiResponse = $this->iam->adminUpdateUserStatus($userId,$status);
        if($status_ApiResponse['code'] == 200){
           $updateRecords['status']   = $status;
        }else if(isset($status_ApiResponse['json_error'])){

           if(isset($status_ApiResponse['json_error']['message'])){
               $errors['status'][] = ucfirst($status_ApiResponse['json_error']['message']); 
               return $this->sendErrorResponse('Validation Error', 422, "validation_error", $errors);
           }
       }
       //End Update status

       //Start Update Role
       $userRole = implode(',',$role);
       $role_ApiResponse = $this->iam->adminUpdateUserRole($userId,$userRole);
       if($role_ApiResponse['code'] == 200){
           $updateRecords['role']     = $userRole;
       }else if(isset($role_ApiResponse['json_error'])){

           if(isset($role_ApiResponse['json_error']['message'])){
               $errors['role'][] = ucfirst($role_ApiResponse['json_error']['message']); 
               return $this->sendErrorResponse('Validation Error', 422, "validation_error", $errors);
           }
       }
       //End Update Role

       return $updateRecords;
    }


    public function showMetaDataEditor($id){
        abort_if(isRolePermission('user_metadata_editor'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $apiResponse =  $this->iam->adminFindUserById($id);

        if($apiResponse['code'] == 200){

            $user = $apiResponse['response']['data']['user'];

            return view('backend.users.metadata_editor', compact('user'));
        }else{
            return abort(404);
        }
    }

    public function submitMetaDataEditor(Request $request, $id){

        $request->validate([
            'metadata' =>['required']
        ]);

        try{

            $data = json_decode(file_get_contents($this->filePath), true);

            $input = $request->except(['_token','_method','user_id']);
    
            $index = findIndexById($data, $id);
    
            if ($index !== null) {
    
                $getUserObject = $data[$index];
                $updateRecords = [];

                //Start Update Metadata 
                $metaDataJson = $request->metadata;
                $metaData = json_decode($metaDataJson,true);
                $metaData_ApiResponse = $this->iam->adminUpdateUserMetadata($id,$metaData);
                if($metaData_ApiResponse['code'] == 200){
                    $updateRecords['metadata'] = $metaDataJson;
                }else if(isset($metaData_ApiResponse['json_error'])){

                    if(isset($metaData_ApiResponse['json_error']['message'])){
                        $errors['metadata'][] = ucfirst($metaData_ApiResponse['json_error']['message']); 
                        return $this->sendErrorResponse('Validation Error', 422, "validation_error", $errors);
                    }
                }
                //End Update Metadata
    
                if(count($updateRecords) > 0){
                    $data[$index] = array_merge($data[$index], $updateRecords);
                
                    file_put_contents($this->filePath, json_encode($data));
                }
                
                return $this->sendSuccessResponse(trans('messages.curd.update_record'));
            }

        }catch (\Exception $e) {
            //   dd('Error in UserController::submitMetaDataEditor (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            \Log::channel('iamsystemlog')->error('Error in UserController::submitMetaDataEditor (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return $this->sendErrorResponse(trans('messages.error_message'),500);
        }
    }
}
