<?php


namespace core\Controller;


use core\Route\IRequest;

class DefaultController
{
    /**
     * @param IRequest $request
     * @return false|string
     */
    public static function index($request) {
        return json_encode($request->getQuery());
    }
}