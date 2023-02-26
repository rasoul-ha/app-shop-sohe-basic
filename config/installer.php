<?php

use Illuminate\Support\Facades\File;

return [
    'icon' => '',

    'background' => '/installer/background.jpg',

    'support_url' => '#',

    'server' => [
        'php' => [
            'name' => 'PHP Version',
            'version' => '>= 8.0.0',
            'check' => function() { return version_compare(PHP_VERSION, '8', '>');}
        ],
        'pdo' => [
            'name' => 'PDO',
            'check' => function() {return extension_loaded('pdo_mysql');}
        ],
        'mbstring' => [
            'name' => 'Mbstring extension',
            'check' => function() {return extension_loaded('mbstring');}
        ],
        'fileinfo' => [
            'name' => 'Fileinfo extension',
            'check' => function() {return extension_loaded('fileinfo');}
        ],
        'openssl' => [
            'name' => 'OpenSSL extension',
            'check' => function() { return extension_loaded('openssl');}
        ],
        'tokenizer' => [
            'name' => 'Tokenizer extension',
            'check' => function() {return extension_loaded('tokenizer'); }
        ],
        'json' => [
            'name' => 'Json extension',
            'check' => function() {return extension_loaded('json');}
        ],
        'curl' => [
            'name' => 'Curl extension',
            'check' => function() {return extension_loaded('curl');}
        ]
    ],

    'folders' => [
        'storage.framework' => [
            'name' => base_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'framework',
            'check' => function() {return chmod(dirname(__DIR__).'/storage/framework',755);}
        ],
        'storage.logs' => [
            'name' => base_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'logs',
            'check' => function() {return chmod(dirname(__DIR__).'/storage/logs',755);}
        ],
        'storage.cache' => [
            'name' => base_path().DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'cache',
            'check' => function() {return chmod(dirname(__DIR__).'/bootstrap/cache',755);}
        ],
    ],

    'database' => [
        'seeders' => true
    ],

    'commands' => [
        // 'install:create-default-languages',
        // 'install:create-default-user-roles',
        // 'install:create-default-users',
        // 'install:create-settings-keys'
    ],

    'admin_area' => [
        'user' => [
            'email' => 'demo@admin.com',
            'password' => '12345678'
            ]
    ]
];
