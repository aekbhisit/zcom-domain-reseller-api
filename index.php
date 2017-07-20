<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Bangkok');
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
if(!isset($_SESSION)){
	session_start();
}
require 'Slim/Slim.php';
require 'apps/lib/config.inc.php';
require 'apps/lib/database.php';
\Slim\Slim::registerAutoloader();
/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim(array(
	'mode' => 'production'
));
// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => false
    ));
});
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => false,
        'debug' => true
    ));
});
/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
/////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////// FUNCTION //////////////////////////////////////////////
///////////////////////////////////// Group API /////////////////////////////////////////////
$app->group('/domains', function () use ($app) {
    require ('apps/module/domains/control.php');
});
/////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
//$app->run();