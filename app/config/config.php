<?php

return new \Phalcon\Config(array(
    'storage' => array(
        'database' => array(
            'default' => array(
                'adapter' => 'Mysql',
                'host' => 'localhost',
                'port' => 3306,
                'username' => 'root',
                'password' => '',
                'dbname' => 'envybox_test',
            )
        ),
        'file' => array(
            'feedback' => __DIR__ . '/../../output/feedback/'
        )
    ),
    'application' => array(
        'baseUri' => '/',
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'modelsDir' =>      __DIR__ . '/../../app/models/',
        'viewsDir' =>       __DIR__ . '/../../app/views/',
        'servicesDir' =>    __DIR__ . '/../../app/services/',
    )
));