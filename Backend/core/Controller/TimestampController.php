<?php


namespace core\Controller;


use Ahc\Jwt\JWTException;
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

        try {
            $payload = $jwt->decode($token);
        }
        catch (JWTException $exception) {
            return json_encode($exception->getMessage());
        }

        //echo json_encode($payload["user_id"]);

        $userTimestampRepository = new \UserTimestampRepository(new Database(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_NAME")));

        return json_encode(($userTimestampRepository->getOne($payload["user_id"])));
    }

    /**
     * @param IRequest $request
     * @return false|string
     */
    public static function getZoneTimestamps($request) {

        $query = $request->getQuery();

        $userTimestampRepository = new \UserTimestampRepository(new Database(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_NAME")));

        return json_encode(($userTimestampRepository->getAllFromZone($query["zone"], $query["page"] | 1, $query["limit"] | 20)));
    }
}