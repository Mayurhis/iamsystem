<?php

return [

    'curd'=>[
        'add_record'    => 'Successfully Added !',
        'update_record' => 'Successfully Updated !',
        'delete_record' => 'This record has been succesfully deleted!',
        'restore_record'=> 'This record has been succesfully Restored!',
        'merge_record'  => 'This record has been succesfully Merged!',
        'approve_record'=> 'Record Successfully Approved !',
        'status_update' => 'Status successfully updated!',
        'notification_sent' => 'Notification Successfully sent!',
        'message_sent'      => 'Message Successfully sent!',
    ],

   
    'areYouSureapprove' =>  'Are you sure you want to Approve this record?',
    'areYouSurerestore' =>  'Are you sure you want to Restore this Database? It will delete your current database.',
    'deletetitle'       =>  'Delete Confirmation',
    'restoretitle'      =>  'Restore Confirmation',
    'approvaltitle'     =>  'Approval Confirmation',
    'areYouSureRestore' =>  'Are you sure you want to restore this record?',
    'error_message'     =>  'Something went wrong....please try again later!',
    'no_record_found'   =>  'No Records Found!',
    'suspened'          =>  'Your account has been suspened!',
    'invalid_email'     =>  'Invalid Email',
    'invalid_otp'       =>  'Invalid OTP',
    'invalid_pin'       =>  'Invalid PIN',
    'wrong_credentials' =>  'These credentials do not match our records!',
    'not_activate'      =>  'Your account is not activated.',
    'otp_sent_email'    =>  'We have successfully sent OTP on your Registered Email',
    'expire_otp'        =>  'OTP has been Expired',
    'verified_otp'      =>  'OTP successfully Verified.',
    'invalid_token_email'   => 'Invalid Token or Email!',
    'success'           =>  'Success',
    'register_success'  =>  'Your account created successfully! Please wait for the approval!',
    'login_success'     =>  'You have logged in successfully!',
    'logout_success'    =>  'Logged out successfully!',
    'warning_select_record' => 'Please select at least one record',
    'required_role'         => "User with the specified email doesn't have the required role.",
    
    'invalid_token'                 => 'Your access token has been expired. Please login again.',
    'not_authorized'                => 'Not Authorized to access this resource/api',
    'not_found'                     => 'Not Found!',
    'token_invalid'                 => 'Token is invalid',
    'unexpected'                    => 'Unexpected Exception. Try later',
    
    'data_retrieved_successfully'   => 'Data retrieved successfully',
    'record_retrieved_successfully' => 'Record retrieved successfully',
    'record_created_successfully'   => 'Record created successfully',
    'record_updated_successfully'   => 'Record updated successfully',
    'record_deleted_successfully'   => 'Record deleted successfully',
    'password_updated_successfully' => 'Password updated successfully',

    'account_deactivate'            => 'Your account has been deactivated. Please contact the admin.',
  

    'areYouSure'        =>  'Are you sure?',
    'conifrmSweetAlert' => [
        'logout' =>[
            'text' => 'You will be logged out!',
            'confirmButtonText' => 'Yes, log me out!',
            'cancelButtonText'  => 'No',
        ]
    ],

    'password_regex' => 'The password must contain uppercase letters A-Z, lowercase letters a-z, digits 0-9 and symbols -_!@#$%&*',
    'username_regex' => 'The username must only contain letters, numbers, and underscores.'
];
