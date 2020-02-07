<?php


namespace core\Controller;


use core\Database;
use core\Route\IRequest;

class TimestampController
{
    /**
     * @param IRequest $request
     * @return string
     */
    public static function store($request) {

        $jwt = $request->getJWT();

        $token = $request->getToken();

        if(!isset($token) || is_null($token) || strlen($token) < 5) {

            return "errored: Authorization header not set!";
        }

        $payload = $jwt->decode($token);

        $body = $request->getBody();

        $zoneId = $body["zone_id"];


        $userTimestamp = new \UserTimestamp($payload["user_id"], $zoneId);

        $userTimestampRepository = new \UserTimestampRepository(new Database(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_NAME")));

        $userTimestampRepository->create($userTimestamp);

        return "success";
    }

    /**
     * @param IRequest $request
     * @return string
     */
    public static function getUserTimestamp($request) {
        $jwt = $request->getJWT();

        $token = $request->getToken();

        if(!isset($token) || is_null($token) || strlen($token) < 5) {

            return "errored: Authorization header not set!";
        }

        $payload = $jwt->decode($token);

        //echo json_encode($payload["user_id"]);

        $userTimestampRepository = new \UserTimestampRepository(new Database(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_NAME")));

        return json_encode(($userTimestampRepository->getOne($payload["user_id"])));
    }
}