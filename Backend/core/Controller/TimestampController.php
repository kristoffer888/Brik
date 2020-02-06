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

        $userTimestampRepository = new \UserTimestampRepository(new Database("localhost", "root", "Aa123456&", "brik"));

        $userTimestampRepository->create($userTimestamp);

        return "success";
    }

    /**
     * @param IRequest $request
     * @return string
     */
    public function getUserTimestamp($request) {
        $jwt = $request->getJWT();

        $token = $request->getToken();

        if(!isset($token) || is_null($token) || strlen($token) < 5) {

            return "errored: Authorization header not set!";
        }

        $payload = $jwt->decode($token);
        $body = $request->getBody();

        $userTimestampRepository = new \UserTimestampRepository(new Database("localhost", "root", "Aa123456&", "brik"));

        return $userTimestampRepository->getOne($payload["user_id"]);
    }
}