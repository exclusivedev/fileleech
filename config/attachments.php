<?php

return [
    // The model which creates the attachments aka the User model
    'models' => [
        /**
         * Attacher model
         */
        'attacher' => \App\Models\User::class,
        /**
         * Attachment model
         */
        'attachment' => \ExclusiveDev\FileLeech\Models\Attachment::class
    ],    
    'route' => [
        'root' => 'api',
        'group' => 'attachments'
    ],
    'policy_prefix' => 'attachments',
    'testing' => [
        'seeding' => [
            'attachable' => '\App\Post',
            'attacher' => '\App\User'
        ]
    ],
    'storage' => [
        'disk' => 'local',
        'path' => 'attachments'
    ],
    /**
     * Only for API
     *
     * @example ['get']['preprocessor']['user'] => App\UseCases\AttachmentPreprocessor\User::class
     */
    'api' => [
        'get' => [
            'preprocessor' => [
                'user' => null,
                'attachment' => null
            ]
        ]
    ]
];