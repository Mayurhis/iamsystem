<?php

return [
    'datatable' => [
        'show' => 'Show',
        'entries' => 'entries',
        'showing' => 'Showing',
        'to' => 'to',
        'of'    => 'of',
        'search' => 'Search',
        'previous' => 'Previous',
        'next' => 'Next',
        'first' => 'First',
        'last'  => 'Last',
        'data_not_found' => 'Data not found',
        'processing'   => 'Processing...',
    ],

    'pageTitles'=>[
        'dashboard'     => 'Dashboard',
        'user'          => 'Users',
        'add_user'      => 'Add User',
        'edit_user'     => 'Edit User',
        'view_user'     => 'Show User',
        'user_detail'   => 'User Details',
    ],

    'sidebar'=>[
        'dashboard' => 'Dashboard',
        'brands'    => 'Brands',
        'users'     => 'Users',
        'kyc_request' => 'KYC Request',
        'logout'      => 'Logout',
    ],

    'dashboard' =>  [
        'title'          => 'Dashboard',
        'title_singular' => 'Dashboard',
        'fields'         => []
    ],

    'profile' =>  [
        'title'          => 'Profile',
        'title_singular' => 'Profile',
        'fields'         => [
            'email'      => 'Email',
            'username'   => 'Username',
            'status'     => 'Status',
        ]
    ],


    'user' =>  [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'aud'           => 'Aud',
            'role'          => 'Role',
            'email'         => 'Email',
            'username'      => 'Username',
            'password'      => 'Password',
            'type'          => 'Type',
            'language'      => 'Language',
            'is_confirmed'  => 'Confirmed',
            'confirmed_at'  => 'ConfirmedAt',
            'invited_at'    => 'InvitedAt',
            'confirmation_token'         => 'Confirmation Token',
            'confirmation_sent_at'       => 'ConfirmationSentAt',
            'email_change_token'         => 'Email Change Token',
            'email_change_sent_at'       => 'EmailChangeSentAt',
            'last_login_at'              => 'Last Login At',
            'metadata'                   => 'MetaData',
            'status'                     => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ],
    ],



];
