<?php

use Phalcon\Mvc\Application;

// Configuration
$config = include __DIR__ . "/../app/config/config.php";

// Auto-loader
include __DIR__ . "/../app/config/loader.php";

// Dependencies and Services
include __DIR__ . "/../app/config/services.php";

// Routes
include __DIR__ . "/../app/config/routes.php";

//starting application
$application = new Application($di);
try {
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ' . $e->getMessage();
}