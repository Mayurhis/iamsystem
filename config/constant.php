<?php

return [

    'user_roles'=>[
        'admin',
        'auditor'
    ],


    'IAMSystemSecret' => env('IAM_SECRET', null),

    'IAMSystemIssuer' => env('IAM_ISSUER', null),
    
    'IAMSystemApiUrl' => env('IAM_SYSTEM_API_URL', 'https://iam.scancheck.io:9999/api'),

    'IAMSystemToken' => env('IAM_SYSTEM_TOKEN', null),

    
];