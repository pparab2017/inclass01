<?php
return [
    'propel' => [
        'database' => [
            'connections' => [
                'default' => [
                    'adapter' => 'mysql',
                    'dsn' => 'mysql:host=localhost;port=3306;dbname=inclass01',
                    'user' => 'root',
                    'password' => '123',
                    'settings' => [
                        'charset' => 'utf8',
                        'queries' => [
                            'utf8' =>'SET NAMES utf8 COLLATE utf8_unicode_ci, COLLATION_CONNECTION = utf8_unicode_ci, COLLATION_DATABASE = utf8_unicode_ci, COLLATION_SERVER = utf8_unicode_ci'
                        ]
                    ],
                    'attributes' =>[
                        //'ATTR_ERRMODE' => PDO::ERRMODE_SILENT
                        //'ATTR_ERRMODE' => PDO::ERRMODE_SILENT
                        // \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                        //\PDO::ATTR_ERRMODE => \PDO::ERRMODE_SILENT

                    ]
                ]
            ]
        ],
        'generator' => [
            'schema' => [
                'autoPackage' => true
            ]
        ]
    ]
];
