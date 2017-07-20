<?php
header('Access-Control-Allow-Origin: *');
/*
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);*/
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
class MyMiddleware extends \Slim\Middleware
{
public $myRoute;
    public function call()
    {
                //The Slim application
                $app = $this->app;
                $this->app->hook('slim.before.dispatch', array($this, 'onBeforeDispatch'));
                //The Environment object
                $env = $app->environment;
                //The Request object
                $req = $app->request;
                $method = $req->getMethod();
                $return['operations'] = array('method'=> $req->getMethod(),"summary" =>'',"type"=>'',"nickname"=>'',"parameters"=>array());
                if($method == "POST"){
                        $parameters = json_decode($env->offsetGet('slim.input'));
                        $return['operations']['parameters'] = $parameters;
                }
                //The Response object
                $res = $app->response;
                $body = $res->getBody();
                $this->return = $return;
                //call the next middleware
                $this->next->call();
    }
         public function onBeforeDispatch()
    {
        $route = $this->app->router()->getCurrentRoute();
        $this->myRoute = $route;
         $return['path'] = $route->getPattern();
                $return = $this->return;
                if($return['operations']['method'] == "GET"){
                        $refFunc = new ReflectionFunction($route->callable);
                        foreach ($refFunc->getParameters()  as $refParameter) {
                                $return['operations']['parameters'] = array();
                                $return['operations']['parameters']['name'] = $refParameter->name;
                                $return['operations']['parameters']['required'] = $refParameter->isOptional();
                        }
                }
                echo json_encode($return);
    }
}
$app->add(new MyMiddleware);