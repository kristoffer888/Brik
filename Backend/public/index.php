<?php

include_once ("../core/Router.php");
include_once ("../core/Route/Request.php");
include_once ("../core/Controller/UserController.php");
include_once ("../core/Controller/DefaultController.php");

use core\Route\Request;
use core\Router;
use core\Controller\UserController;

$router = new Router(new Request);

$router->get("/", function ($request) {
    return file_get_contents("./pages/index.file");
});

$router->get("/lol", "core\Controller\DefaultController::index");

$router->get("/user", "core\Controller\UserController::getUser");