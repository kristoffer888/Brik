<?php


namespace core\Controller;

use core\Database;
use core\Route\IRequest;

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

class UserController
{

    public static function getUsers($request) {
        $userRepo = new \UserIconRepository(new Database(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_NAME")));

        $query = $request->getQuery();

        if(!isset($query["page"]))
            $query["page"] = 1;

        if(!isset($query["limit"]))
            $query["limit"] = 20;

        $userIcons = $userRepo->getAll($query["page"], $query["limit"]);

        return json_encode($userIcons);
    }

    /**
     * @param IRequest $request
     * @return string
     */
    public static function store($request) {

        $body = $request->getBody();

        $userIcon = new \UserIcon($body["user_id"], $body["first_name"], $body["last_name"], $body["icon"]);

        $userRepo = new \UserIconRepository(new Database(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_NAME")));

        $userRepo->create($userIcon);

        return "success";
    }

    /**
     * @param IRequest $request
     */
    public static function generateToken($request) {
        $jwt = $request->getJWT();
        $body = $request->getBody();

        return $jwt->encode([ "user_id" => $body["user_id"] ]);
    }

    /**
     * @param IRequest $request
     */
    public static function onPostRequest($request) {
        $jwt = $request->getJWT();

        $payload = $jwt->decode($request->getToken());

//        return json_encode($payload);

        $body = $request->getBody();

        $zoneId = $body["zone_id"];


        $userTimestamp = new \UserTimestamp($payload["user_id"], $zoneId);

        $userTimestampRepository = new \UserTimestampRepository(new Database(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_NAME")));

        $userTimestampRepository->create($userTimestamp);

        return "success";
    }
}