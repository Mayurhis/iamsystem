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
