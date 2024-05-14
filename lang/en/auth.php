<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'failed_unauthorised' => 'You are not authorized to access this portal.', 
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    
    'messages' => [
        'account_approval'=> 'Please wait for approval to access your account.',
        'jwt_token_invalid' => 'Jwt Token is invalid, so you are logout forcefully!',
        'login' => [
            'success'               => 'Login Successful.',
            'failed'                => 'Invalid Credentials! Please try again.',
        ],
        'logout' => [
            'success'               => 'Successfully logged out.',
        ],
        'forgot_password' => [
            'success'               => 'We have sent email with reset password link. Please check your inbox!.',
            'success_update'        => 'You are changed your password successful.',
            'otp_sent'              => 'We have sent email with OTP. Please check your inbox!.',
            'validation'            => [
                'phone_number_not_found'=> "We can't find a user with that phone number.",
				'verified_phone_number' => 'This password reset phone number is verified.',
				'email_not_found'       => "We can't find a user with that e-mail address.",
                'incorrect_password'    => 'Incorrect current password! Please try again.',
                'invalid_otp'           => 'This password reset otp is invalid.',
                'expire_otp'            => 'This password reset otp is expired.',
                'verified_otp'          => 'This password reset otp is verified.',				
                'expire_request'        => 'This password reset request is expired.',
				'invalid_request'       => 'This password reset request is invalid.',
                'invalid_token_email'   => 'Invalid Token or Email!',
            ],
        ],
        'refresh'   => [
            'token' => [
                'not_provided' => 'Token not provided.',
            ],
            'status' => 'Ok',
        ],

        // '2fa_success' => 'A verification code has been sent to your email. Please check your inbox and enter the code below to complete the login process.',
        '2fa_success' => 'Welcome! To complete your login, please enter the verification code sent to email. Verification Code: :verification_code',
        '2fa_failed' => 'Invalid verification code. Please try again.',

    ],

    'unauthorize'  => 'You are not authorized to perform this action.',

    'loginPage'=>[
        'title' => 'Admin Login',
        'fields' => [
            'email' => 'Username or Email Address',
            'email_placeholder' => 'Enter Username or Email Address',

            'password' => 'Password',
            'password_placeholder' => 'Enter Password',

        ],
    ],

    'forgetPasswordPage'=>[
        'title' => 'Recover Password',
        'fields' => [
            'email' => 'Email Address',
            'email_placeholder' => 'Enter Email Address',
        ],
    ],

    'resetPasswordPage'=>[
        'title' => 'Reset Password',
        'fields' => [
            'new_password' => 'New Password',
            'new_password_placeholder' => 'Enter New Password',

            'confirm_password' => 'Confirm Password',
            'confirm_password_placeholder' => 'Enter Confirm Password',
        ],
    ],


    'changePassword'=>[
        'title' => 'Change Password',
        'fields' => [
            'current_password'=> 'Current Password',
            'current_password_placeholder'=> 'Enter Current Password',

            'new_password' => 'New Password',
            'new_password_placeholder' => 'Enter New Password',

            'confirm_password' => 'Confirm Password',
            'confirm_password_placeholder' => 'Enter Confirm Password',
        ],
    ],

    'profile' => [
        'title' => 'Profile',
        'about' => 'About',
        'change_email_address' => 'Change Email Address',
        'change_username' => 'Change Username',
        'new_email' => 'New Email Address',
        'new_email_placeholder' => 'Enter New Email Address',
        'confirm_email' => 'Email address confirmation',
        'confirm_email_placeholder' => 'Enter Email address confirmation',
        
        'new_username' => 'New Username',
        'new_username_placeholder' => 'Enter New Username',
        'confirm_username' => 'Username confirmation',
        'confirm_username_placeholder' => 'Enter Username Confirmation',
    ],

    
    '2faPage'=>[
        'title' => 'Two-Factor Authentication',
        'fields' => [
            'code' => 'Verification Code',
            'code_placeholder' => 'Enter Verification Code',
        ],
    ],

];
