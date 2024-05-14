<?php

return [

    'remember_me_expire_time' => env('REMEMBER_ME_EXPIRE_TIME'),

    'user_roles'=>[
        'admin',
        'auditor'
    ],

    'permissions' =>[
       1 => 'dashboard_access',
       2 => 'user_access',
       3 => 'user_create',
       4 => 'user_edit',
       5 => 'user_delete',
       6 => 'user_view',
       7 => 'user_change_password',
       8 => 'user_create_access_token',
       9 => 'user_metadata_editor',
    ],

    'role_permission'=>[
        'admin' => [1,2,3,4,6,7,8,9],
        'auditor' => [1,2,6],
    ],

    'role_permission_aud'=>[
        'admin' => [1,2,3,4,6,7,8,9],
        'auditor' => [1,2,6],
    ],

    'date_format'     => 'd-m-Y',
    'datetime_format' => 'd-m-Y H:i',
    'time_format'     => 'H:i:s',

    'default'=>[
        'user_image'=>'backend/images/user.jpg',
    ],

    'timeout_time' => env('TIMEOUT_DURATION_IN_MINUTES',5),

    'IAMSystemSecret' => env('IAM_SECRET', null),

    'IAMSystemIssuer' => env('IAM_ISSUER', null),
    
    'IAMSystemApiUrl' => env('IAM_SYSTEM_API_URL', 'https://iam.scancheck.io:9999/api'),

    'IAMSystemToken' => env('IAM_SYSTEM_TOKEN', null),


    'password_min_length' => env('PASSWORD_MIN_LENGTH',6),
    'password_regex'      => "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[$\-_!@#$%&*])[A-Za-z\d$\-_!@#$%&*]+$/",

    'two_factor_auth_code_length' => env('TWO_FACTOR_AUTH_CODE_LENGTH',6),

    'userStatus'=>[
        'active',
        'locked',
        'deleted',
        'pending',
    ],

    'userType'=>[
        'user',
        'merchant',
        'system',
        'admin',
        'machine'
    ],
    
];