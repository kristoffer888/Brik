<?php

include_once ("../autoload.php");

include_once ("../core/Router.php");
include_once ("../core/Route/Request.php");
include_once ("../core/Controller/UserController.php");
include_once ("../core/Controller/DefaultController.php");
include_once ("../core/Controller/TimestampController.php");
include_once ("../core/Database.php");
include_once ("../core/Repository/UserIconRepository.php");
include_once ("../core/Repository/UserTimestampRepository.php");
include_once ("../core/Model/UserIcon.php");
include_once ("../core/Model/UserTimestamp.php");

include_once ("../core/jwt/ValidatesJWT.php");
include_once ("../core/jwt/JWT.php");
include_once ("../core/jwt/JWTException.php");

use core\Route\Request;
use core\Router;
use core\Controller\UserController;

use Ahc\Jwt\JWT;



$router = new Router(new Request);

$router->get(env("BASE_URL") . "/", function ($request) {
//    global $jwt;
//
//
//    $token = $jwt->encode([ "virus" => true ]);
//    $payload = $jwt->decode($token);
//
//    return $token . "\r\n" . json_encode($payload); //file_get_contents("../pages/index.file");
    return "INDEX";
});

$router->get(env("BASE_URL") . "/lol", "core\Controller\DefaultController::index");

$router->get(env("BASE_URL") . "/users", "core\Controller\UserController::getUsers");

$router->post(env("BASE_URL") . "/users", "core\Controller\UserController::store");

$router->post(env("BASE_URL") . "/users/token", "core\Controller\UserController::generateToken");

$router->post(env("BASE_URL") . "/register", "core\Controller\TimestampController::store");

$router->get(env("BASE_URL") . "/timestamps", "core\Controller\TimestampController::getUserTimestamp");