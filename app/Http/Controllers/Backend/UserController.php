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
    public $iam;

    public function __construct()
    {
        $this->iam = new IAMHttpService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,UserDataTable $dataTable)
    {
        abort_if(isRolePermission('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try{

            return $dataTable->render('backend.users.index');

        }catch (\Exception $e) {    
            return abort(500);
        }
     
    }

    public function getData(Request $request)
    {
        abort_if(isRolePermission('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try{
          
            if ($request->ajax()) {

                $nextStartRecord = 0;
                $filterParameters = [];
                
                $audString = authUserDetail('data.user.aud');
                if($audString){
                    $filterParameters['aud'] = $audString;
                }

                $offset = $request->start;
                if($offset){
                    $nextStartRecord = $offset;
                    $filterParameters['offset'] = $offset;
                }

             
                $limit = $request->length;
                if($limit){
                    $filterParameters['limit'] = $limit;
                }

              
                $columns = $request->columnNames;

                //Start Sort by
                $orders = $request->order;
                if($orders){
                    if(count($orders) > 0){
                        $sortArr = [];
                        foreach ($orders as $keyIndex => $order) {
    
                            $columnIndex = (int)$order['column'];

                            if($columns[$columnIndex] == 'audience'){
                                $columnName = 'aud';
                            }else{
                                $columnName = $columns[$columnIndex];
                            }
    
                            $sortDir = ($order['dir'] == 'asc') ? '+' : '-';
    
                            $sortArr[$keyIndex] = $sortDir.$columnName;
                        }
    
                        if(count($sortArr) > 0){
                            $filterParameters['sort'] = implode(',',$sortArr);
                        }
                    }
                }
                //End Sort by

                //Start Column Search Parameter

                if($request->email){
                    $filterParameters['email[like]'] = $request->email.'*';
                }

                if($request->username){
                    $filterParameters['username[like]'] = '*'.$request->username.'*';
                }

                if($request->status){
                    $filterParameters['status'] = $request->status;
                }

                if($request->is_confirmed){
                    $filterParameters['is_confirmed'] = strtolower($request->is_confirmed) == 'yes' ? true : false;
                }

                if($request->language){
                    $filterParameters['language[like]'] = $request->language.'*';
                }

                if($request->aud){
                    $filterParameters['aud[like]'] = $request->aud.'*';
                }

                // if($request->metadata){
                //     $filterParameters['metadata'] = $request->metadata;
                // }

                if($request->type){
                    $filterParameters['type[in]'] = $request->type;
                }

                if ($request->created_at) {
                    // $filterParameters['created_at[lte]'] = Carbon::parse($request->created_at)->format('Y-m-d H:i');
                    $filterParameters['created_at'] = $request->created_at;

                }

                if ($request->updated_at) {
                    $filterParameters['updated_at'] = $request->updated_at;
                }

                if ($request->last_login_at) {
                    $filterParameters['last_login_at'] = $request->last_login_at;
                }

                //End Column search Parameter

                // dd($filterParameters);
                
                $users = [];
                $apiResponse =  $this->iam->adminUserList($filterParameters);

                if($apiResponse['code'] == 200){
                    $users = $apiResponse['response']['data']['users'];
                    if($users){
                        $nextStartRecord = (int)$request->initialStart + (int)$offset;
                    }
                }

                $getRecords = collect($users);

                $viewHtml = view('backend.users.partials.user-table-records',compact('getRecords','offset','orders'))->render();
                
                return response()->json(['success' => true, 'htmlView' => $viewHtml,'offset'=>$nextStartRecord],200);               
            }

           
        }catch (\Exception $e) {    

            dd($e->getCode() .'='.$e->getMessage() . ' at line ' . $e->getLine());

            \Log::channel('iamsystemlog')->error('Error in UserController::getData (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return $this->sendErrorResponse(trans('messages.error_message'),500);
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
            $insertRecords = [
                'aud'           => $request->aud,
                'role'          => $request->role,
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

                return $this->sendSuccessResponse(trans('messages.curd.add_record'));
                
            }else if($apiResponse['code'] == 400){

                $message = isset($apiResponse['json_error']) ? isset($apiResponse['json_error']['message']) ? ucwords($apiResponse['json_error']['message']): ucwords($apiResponse['message']) : ucwords($apiResponse['message']);

                return $this->sendErrorResponse($message,400);

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

            $input = $request->except(['_token','_method']);

            $apiResponse = $this->iam->adminUpdateUser($id,$input);

            if ($apiResponse['code'] == 200) {

                return $this->sendSuccessResponse(trans('messages.curd.update_record'));
                
            }else if($apiResponse['code'] == 400){

                $message = isset($apiResponse['json_error']) ? isset($apiResponse['json_error']['message']) ? ucwords($apiResponse['json_error']['message']): ucwords($apiResponse['message']) : ucwords($apiResponse['message']);
                
                return $this->sendErrorResponse($message,400);

            }else{

                return $this->sendErrorResponse(trans('messages.error_message'),500);
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

            //Start Update Password 
            $updatePassword['password'] = $request->password;
            $apiResponse = $this->iam->adminUpdateUserPassword($id,$updatePassword);

            if($apiResponse['code'] == 200){
                return $this->sendSuccessResponse(trans('messages.updated_successfully',['module_name'=>'User password']));
            }
            //End Update Password

            return $this->sendErrorResponse(trans('messages.error_message'),500);
             
        } catch (\Exception $e) {
               //   dd('Error in UserController::submitChangeUserPassword (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            \Log::channel('iamsystemlog')->error('Error in UserController::submitChangeUserPassword (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return $this->sendErrorResponse(trans('messages.error_message'),500);
        }
    }
    
    
    public function showCreateAccessToken($id){
        abort_if(isRolePermission('user_create_access_token'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $apiResponse =  $this->iam->adminFindUserById($id);

        if($apiResponse['code'] == 200){

            $user = $apiResponse['response']['data']['user'];

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

            $input = $request->except(['_token','_method']);
    
            //Start Update Metadata 
            $metaDataJson = $request->metadata;

            $metaData = json_decode($metaDataJson,true);

            $metaData_ApiResponse = $this->iam->adminUpdateUserMetadata($id,$metaData);

            if($metaData_ApiResponse['code'] == 200){

                return $this->sendSuccessResponse(trans('messages.curd.update_record'));
                
            }else if(isset($metaData_ApiResponse['json_error'])){

                if(isset($metaData_ApiResponse['json_error']['message'])){
                    $errors['metadata'][] = ucfirst($metaData_ApiResponse['json_error']['message']); 
                    return $this->sendErrorResponse('Validation Error', 422, "validation_error", $errors);
                }
            }
            //End Update Metadata
    

        }catch (\Exception $e) {
            //   dd('Error in UserController::submitMetaDataEditor (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            \Log::channel('iamsystemlog')->error('Error in UserController::submitMetaDataEditor (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return $this->sendErrorResponse(trans('messages.error_message'),500);
        }
    }

    public function userForceLogout($id){
        abort_if(isRolePermission('user_force_logout'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try{          
            $apiResponse = $this->iam->adminUserForcelogout($id);

            if($apiResponse['code'] == 200){
                return redirect()->back()->with('success',trans('messages.user_logout_success'));
            }else{
                return redirect()->back()->with('error',trans('messages.error_message'));
            }

        }catch (\Exception $e) {
            //   dd('Error in UserController::userForceLogout (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());

            \Log::channel('iamsystemlog')->error('Error in UserController::userForceLogout (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return redirect()->back()->with('error',trans('messages.error_message'));
        }

    }
}
