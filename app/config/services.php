<?php

use Phalcon\Mvc\View;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\Router;
use Phalcon\Db\Adapter\Pdo\Factory as DbFactory;

//DI
$di = new FactoryDefault();

// The URL component is used to generate all kind of urls in the application
$di->setShared(
    'url', 
    function () use ($config) {
        $url = new Url();
        $url->setBaseUri($config->application->baseUri);
        return $url;
    }
);

// Config
$di->setShared(
    'config', 
    function () use ($config) {
        return $config;
    }
);

//Setup default Database connection
$di->set(
    'db', 
    function () use ($config) {
        return DbFactory::load($config->storage->database->default);
    }
);

// Setup view component
$di->setShared(
    'view', 
    function () use ($config) {
        $view = new View();
        $view->setViewsDir($config->application->viewsDir);
        return $view;
    }
);

// Setup Router
$di->setShared(
    'router', 
    function() {
        $router = new \Phalcon\Mvc\Router(false);

        $router->removeExtraSlashes(true);

        $router->add('/', array(
            'namespace' => 'Controllers',
            'controller' => "Index"
        ));

        $router->add('/:action', array(
            'namespace' => 'Controllers',
            'controller' => 'Index',
            'action' => 1
        ));

        $router->add('/:controller/:action', array(
            'namespace' => 'Controllers',
            'controller' => 1,
            'action' => 2
        ));

        return $router;
    }
);