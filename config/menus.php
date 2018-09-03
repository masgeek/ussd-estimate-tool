<?php

$dashboard = [
    'url' => '/dashboard',
    'icon' => 'icon-home4',
    'active' => false,
    'title' => 'Dashboard',
    'data' => [

    ]
];

$sms = [
    'url' => '/sms',
    'icon' => 'icon-bubble-lines3',
    'active' => false,
    'title' => 'SmsApiChannel',
    'data' => [

    ]
];

$events =[
    'url' => '',
    'icon' => 'icon-calendar5',
    'active' => false,
    'title' => 'Events',
    'data' => [
        [
            'url' => '/event/add',
            'active' => false,
            'title' => 'Add new'
        ],
        [
            'url' => '/event/all',
            'active' => false,
            'title' => 'View all'
        ],
    ]
];

$users =[
    'url' => '',
    'icon' => 'icon-Users',
    'active' => false,
    'title' => 'Users',
    'data' => [
        [
            'url' => '/students',
            'active' => false,
            'title' => 'Users'
        ],
        [
            'url' => '/staff',
            'active' => false,
            'title' => 'Staff'
        ]
    ]
];


$invoices =[
    'url' => '/invoices',
    'icon' => 'icon-calculator',
    'active' => false,
    'title' => 'Invoices',
    'data' => [

    ]
];

$clients =[
    'url' => '/clients',
    'icon' => 'icon-users4',
    'active' => false,
    'title' => 'Clients',
    'data' => [

    ]
];
$school = [
    'url' => '/profile/school',
    'icon' => 'icon-office',
    'active' => false,
    'title' => 'School profile',
    'data' => []
];

return [

    'owner' =>[
        'config'=>[
            'base_url' =>''
        ],
        'data'=>[
            'dashboard'=>$dashboard,
            'sms'=>$sms,
            'events'=>$events,
            'Users'=>$users,
            'invoices'=>$invoices,
            'school'=>$school
        ]
    ],
    'admin' =>[
        'config'=>[
            'base_url' =>'/admin'
        ],
        'data'=>[
            'dashboard'=>$dashboard,
            'sms'=>$sms,
            'clients'=>$clients,
            'invoices'=>$invoices
            ]
    ],
    //School categories
    'categories' =>[
        [
            "name"=>'primary',
            "value"=>'Primary School'
        ],[
            "name"=>'high-school',
            "value"=>'High School'
        ],[
            "name"=>'college',
            "value"=>'College'
        ],
    ],
    //School categories
    'type' =>[
        [
            "name"=>'public',
            "value"=>'Public'
        ],[
            "name"=>'private',
            "value"=>'Private'
        ],
    ]


];
