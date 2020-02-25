<?php


namespace core\Controller;

use core\Database;
use core\Route\IRequest;

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

class UserController
{
    private static function getDB() {
        return new Database(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_NAME"));
    }

    public static function getUsers($request) {
        $userRepo = new \UserIconRepository(self::getDB());

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

        $userRepo = new \UserIconRepository(self::getDB());

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

        $userTimestampRepository = new \UserTimestampRepository(self::getDB());

        $userTimestampRepository->create($userTimestamp);

        return "success";
    }

    public static function uploadImage(IRequest $request) {
        $token = $request->getToken();

        if(!isset($token) || is_null($token))
        {
            return json_encode("error");
        }

//        echo $token;

        $body = $request->getBody();
//        $jwt = $request->getJWT();
//
//        $payload = $jwt->decode($token);
//
        $prefix = $body["user_id"];

        $targetDir = "images/";

        $file = $request->getFile("images");

        move_uploaded_file($file["tmp_name"], "C:/brik/Backend/public/" . $targetDir . $prefix . ".png");

        $userRepository = new \UserIconRepository(self::getDB());

        $userRepository->updateImage(new \UserIcon($body["user_id"], "", "", "/" . $targetDir . $prefix . ".png"));

        return json_encode(["status" => "success"]);
    }
}