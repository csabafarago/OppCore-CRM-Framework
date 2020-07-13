<?php

return [
    'mysql_config' => [
        'localhost' => [
            'username' => 'root',
            'password' => 'secret',
            'batabase' => 'opp_core',
        ],
        'production' => [
            'username' => '',
            'password' => '',
            'batabase' => '',
        ]
    ],
    'site_config' => [
        'languages' => ['en'],
        'default_language' => 'en',
    ],
    'page_data' => [
        'page_title' => [
            'hu' => 'Pelda',
            'en' => 'Example',
        ]
    ],
    //Registration field config
    //0 Turned off (database cololumn will null, when this option set)
    //1 Not requered
    //2 Required
    'registration_fields_config' => [
        'email'     => '2',
        'username'  => '2',
        'first_name'  => '2',
        'last_name'  => '2',
    ],
    'authentication_settings' => [
        //Login credential field optional values: email, username
        'login_field_type' => 'username',
        //Set user activated on register complete, otherwise need to acivate via email verification
        'activate_on_register_complete' => true
    ],
    'security' => [
        //Important
        //to change login url you must set the same url name in
        // - Backend/Controlpanel
        // - Frontend/Authentication
        //otherwise system may case unexpected behaviors
        'administration_link' => ['en-admin', 'hu-admin'],
        'login_url' => ['login','bejelentkezes'],
    ]
];
