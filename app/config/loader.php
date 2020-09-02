<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    array(
        'Controllers' => $config->application->controllersDir,
        'Models' => $config->application->modelsDir,
        'Modules\Feedback' => $config->application->modulesDir . 'feedback/',
    )
);

$loader->register();