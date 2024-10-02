<?php

return [
    'groups' => [
        'web' => [
            'sanctum.csrf-cookie',
            'password.confirm',
            'verification.send',
            'verification.notice',
            'verification.verify',
            'password.request',
            'password.email',
            'password.store',
            'password.reset',
            'password.update',
            'profile.destroy',
            'profile.update',
            'profile.edit',
            'register',
            'login',
            'logout',
            'sanctum.csrf-cookie',
        ],
    ],
];
