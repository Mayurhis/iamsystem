<?php

return [

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
    ],

    'role_permission'=>[
        'admin' => [1,2,3,4,5,6],
        'auditor' => [1,2,3,4,5,6],
    ],

    'role_permission_aud'=>[
        'admin' => [1,2,3,4,5,6],
        'auditor' => [1,2,6],
    ],

    'IAMSystemSecret' => env('IAM_SECRET', null),

    'IAMSystemIssuer' => env('IAM_ISSUER', null),
    
    'IAMSystemApiUrl' => env('IAM_SYSTEM_API_URL', 'https://iam.scancheck.io:9999/api'),

    'IAMSystemToken' => env('IAM_SYSTEM_TOKEN', null),

    
];