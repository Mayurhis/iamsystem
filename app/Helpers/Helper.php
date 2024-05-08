<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


if (!function_exists('authValues')) {
    /**
     * Get a specific value from a nested array using dot notation.
     *
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    function authUserDetail(string $key, $default = null)
    {
        $loggedInUserDetails = session()->get('logged_in_user_detail');

        if($loggedInUserDetails){

            $keys = explode('.', $key);

            foreach ($keys as $nestedKey) {
                if (!isset($loggedInUserDetails[$nestedKey])) {
                    return $default;
                }

                $loggedInUserDetails = $loggedInUserDetails[$nestedKey];
            }

            return $loggedInUserDetails;
        }
    }
}

if (!function_exists('findIndexById')) {

    function findIndexById($array, $id) {
        foreach ($array as $index => $element) {
            if (isset($element['id']) && $element['id'] == $id) {
                return $index;
            }
        }
        return null;
    }
}


if (!function_exists('isRolePermission')) {

    function isRolePermission($permissionTitle){

        $authUser = session()->get('logged_in_user_detail');

        if($authUser){
            $userType = '';
            $isAudSet =  isset($user['data']['user']['aud']) ? $user['data']['user']['aud'] : '';

            if(isset($authUser['data']['user'])){
    
                if(isset($authUser['data']['user']['type'])){
                   $userType = $authUser['data']['user']['type'];
                   $userType = in_array($userType,config('constant.user_roles')) ? $userType : null;
                }

            }

            $roles = config('constant.user_roles');
            if(in_array($userType,$roles)){

                $rolePermission = ($userType !== 'admin' && $isAudSet)
                ? config('constant.role_permission_aud.'.$userType)
                : config('constant.role_permission.'.$userType);
               
                $permissions = config('constant.permissions');
                $permissionId = array_search($permissionTitle, $permissions); 

                if(in_array($permissionId,$rolePermission)){
                    return false;
                }else{
                    return true;
                }
            }


        }
      
    }
}


if (!function_exists('convertDateTimeFormat')) {
	function convertDateTimeFormat($value,$type='date')
	{
		$changeFormatValue = Carbon::parse($value);

		$result = null;
		switch ($type) {
			case 'time':
				$result = $changeFormatValue->format(config('constant.time_format'));
				break;

			case 'datetime':
				$result = $changeFormatValue->format(config('constant.datetime_format'));
				break;

			default:
				$result =  $changeFormatValue->format(config('constant.date_format'));
				break;
		}

		return $result;

	}
}
