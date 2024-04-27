<?php

return [

    'user_roles'=>[
        'admin',
        'auditor'
    ],

    'IAMSystemApiUrl' => env('IAM_SYSTEM_API_URL', 'https://iam.scancheck.io:9999/api'),
    'IAMSystemToken' => env('IAM_SYSTEM_TOKEN', null),

    
];