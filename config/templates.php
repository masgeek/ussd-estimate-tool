<?php

return [
    'general' => [
        'fee' => [
            'payment' => 'We have [type] Sh [amount] as [description] for your [rship] [student]. ',
            'balance' => 'The new fee balance is sh [balance]. ',
            'overpayment' => 'The is an over payment of Sh [balance]. ',
            'zero-balance' => 'There is no outstanding fee balance. '
        ],
        'students' => [
            'link-to-parent' => '[school] has listed [student] as a student under you. '
        ]
    ],

    'sms' => [
        'parent' => [
            'linked' => 'We have listed [student] as a student under you. To download our android app visit http://bit.ly/schoolApp',
            'added' => 'We have registered you as a parent in our new school management system. Visit http://bit.ly/schoolApp to download our android app and get instant access to exam results, fee payment records.'
        ],
    ],

    'email' => [
        'parent' => [
            'added' => 'You have been registered as a parent by [school]. We have created an account for you, follow the link below to download our mobile app.',
            'linked' => '[school] has listed their student **[student]** of admission number **[adm_no]** as a student under you. 
            Follow the link below to download our mobile app and get instant access to fee statements, fee structures, exam results, upcoming events,
            reminders, announcements and other features.'
        ],

        'sign-up' => [
            'Welcome to the Bunifu Schools family. We have created an account for your.',
            'Your one time password is **[password]**, for your security change your password as soon as possible.',
            'To get started activate your account by clicking on the button below.'
        ]

    ],

    'download-link' => 'http://bit.ly/schoolApp'

];
