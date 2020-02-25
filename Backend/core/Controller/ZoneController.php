<?php


namespace core\Controller;


use core\Database;
use core\Route\IRequest;

class ZoneController
{
    private static function getDB() {
        return new Database(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_NAME"));
    }

    public static function store(IRequest $request) {
        $body = $request->getBody();

        $zone = new \Zone($body["name"]);

        $zoneRepository = new \ZoneRepository(self::getDB());

        $zoneRepository->create($zone);

        return json_encode("success");
    }

    public static function getAll(IRequest $request) {
        $query = $request->getQuery();

        if(!isset($query["page"]))
            $query["page"] = 1;
        if(!isset($query["limit"]))
            $query["limit"] = 20;

        $zoneRepository = new \ZoneRepository(self::getDB());
        return json_encode($zoneRepository->getAll());
    }
}