<?php


class UserTimestampRepository
{
    /**
     * @var \core\Database
     */
    private $database;

    function __construct(\core\Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param UserTimestamp $userTimestamp
     */
    public function create(UserTimestamp $userTimestamp) {
        $userid = $userTimestamp->getUserId();
        $zoneId = $userTimestamp->getZoneId();

        $this->UpdateRemovedAt($userTimestamp);

        $statement = $this->database->get()->prepare("INSERT INTO user_timestamps(user_id, zone_id) VALUES(?, ?)");
        $statement->bind_param("ii", $userid, $zoneId);
        $statement->execute();

        $statement->close();

    }

    public function UpdateRemovedAt(UserTimestamp $userTimestamp) {
        $userId = $userTimestamp->getUserId();

        $statement = $this->database->get()->prepare("UPDATE user_timestamps SET removed_at=NOW() WHERE user_id = ? ORDER BY id DESC LIMIT 1");
        $statement->bind_param("i", $userId);
        $statement->execute();

        $statement->close();

    }

    public function getAll($page = 1, $limit = 20) {
        $page--;
        $lmt = $limit * $page;

        $statement = $this->database->get()->prepare("SELECT user_timestamps.id, user_timestamps.placed_at, user_timestamps.removed_at, user_icons.id, user_icons.first_name, user_icons.last_name, user_icons.icon_path, zones.name FROM user_timestamps INNER JOIN user_icons ON user_timestamps.user_id = user_icons.id INNER JOIN zones ON zones.id = user_timestamps.zone_id LIMIT ?, ?");
        $statement->bind_param("ii", $lmt, $limit);
        $statement->execute();

        $result = $statement->get_result();

        /**
         * @var array
         */
        $userTimestamps = [];

        while ($row = $result->fetch_row()) {
            $userTimestamps[] = $row;
        }

        $statement->close();

        return $userTimestamps;
    }

    public function getAllFromZone($zone, $page = 1, $limit = 20) {
        $page--;
        $lmt = $limit * $page;
//ORDER BY user_timestamps.placed_at

//Old SQL
//SELECT user_timestamps.id, MAX(user_timestamps.placed_at) AS placed_at, user_timestamps.removed_at, user_icons.id, user_icons.first_name, user_icons.last_name, user_icons.icon_path, zones.name AS zone FROM user_timestamps INNER JOIN user_icons ON user_timestamps.user_id = user_icons.id INNER JOIN zones ON zones.id = user_timestamps.zone_id WHERE user_timestamps.zone_id = ? AND user_timestamps.removed_at IS NULL GROUP BY user_icons.id  LIMIT ?, ?
//Page skal starte på 0
        $statement = $this->database->get()->prepare("SELECT user_icons.id, user_icons.first_name, user_icons.last_name, user_icons.icon_path, zones.name AS zone, user_timestamps.id AS timestamp_id, MAX(user_timestamps.placed_at) AS placed_at, user_timestamps.removed_at AS removed_at FROM user_timestamps INNER JOIN user_icons ON user_timestamps.user_id = user_icons.id INNER JOIN zones ON zones.id = user_timestamps.zone_id WHERE user_timestamps.zone_id = ? AND user_timestamps.removed_at IS NULL GROUP BY user_icons.first_name, user_icons.id, removed_at, timestamp_id LIMIT ?, ?");
        $statement->bind_param("iii", $zone, $lmt, $limit);
        $statement->execute();

        $result = $statement->get_result();

        /**
         * @var array
         */
        $userTimestamps = [];

        while ($row = $result->fetch_assoc()) {

            //if(!array_key_exists($row["id"], $userTimestamps))
                //$userTimestamps[$row["id"]] = $row;
            $userTimestamps[] = $row;
        }

        $statement->close();

        return $userTimestamps;
    }

    public function getOne($id) {
        $statement = $this->database->get()->prepare("SELECT ut.id, ut.zone_id, ut.placed_at, ut.removed_at, ui.first_name, ui.last_name, ui.icon_path, z.name FROM user_timestamps ut INNER JOIN user_icons ui ON ut.user_id = ui.id AND ut.user_id = ? INNER JOIN zones z ON z.id = ut.zone_id ORDER BY ut.id DESC");
        $statement->bind_param("i", strval($id));
        $statement->execute();

        $result = $statement->get_result();



        $statement->close();

        return ($result->fetch_row());
    }
}