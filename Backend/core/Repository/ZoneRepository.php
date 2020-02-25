<?php


class ZoneRepository
{
    /**
     * @var \core\Database
     */
    private $database;

    function __construct(\core\Database $database)
    {
        $this->database = $database;
    }

    public function create(Zone $zone) {
        $name = $zone->getName();

        $statement = $this->database->get()->prepare("INSERT INTO zones(name) VALUES(?)");
        $statement->bind_param("s", $name);
        $statement->execute();

        $statement->close();
    }

    public function getAll() {
        $statement = $this->database->get()->prepare("SELECT * FROM zones");
        $statement->execute();

        $result = $statement->get_result();

        $zones = [];

        while ($row = $result->fetch_row()) {
            $zones[] = $row;
        }

        $statement->close();

        return $zones;
    }
}