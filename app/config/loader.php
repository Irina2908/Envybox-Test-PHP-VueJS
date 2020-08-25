<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(array(
    'Controllers' => $config->application->controllersDir,
    'Models' => $config->application->modelsDir,
    'Services' => $config->application->servicesDir
));

$loader->register();