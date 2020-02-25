<?php


class UserIconRepository
{
    /**
     * @var \core\Database
     */
    private $database;

    function __construct(\core\Database $database)
    {
        $this->database = $database;
    }

    public function create(UserIcon $userIcon) {
        $firstName = $userIcon->getFirstName();
        $lastName = $userIcon->getLastName();
        $iconPath = $userIcon->getIconPath();
        $userId = $userIcon->getUserId();

        $statement = $this->database->get()->prepare("INSERT INTO user_icons(first_name, last_name, icon_path, user_id) VALUES(?, ?, ?, ?)");
        $statement->bind_param("sssi", $firstName, $lastName, $iconPath, $userId);
        $statement->execute();

        $statement->close();
    }

    public function getAll($page = 1, $limit = 20) {


        $page--;
        $lmt = $limit * $page;



        $statement = $this->database->get()->prepare("SELECT * FROM user_icons");
        $statement->execute();

        $result = $statement->get_result();

        /**
         * @var array
         */
        $userIcons = [];

        while ($row = $result->fetch_assoc()) {
            $userIcons[] = $row;
        }

        $statement->close();

//        if(!$userIcons)
//            return "ERROR";

        return $userIcons;
    }

    public function updateImage(UserIcon $userIcon) {
        $id = $userIcon->getUserId();
        $iconPath = $userIcon->getIconPath();

        $statement = $this->database->get()->prepare("UPDATE user_icons SET icon_path = ? WHERE user_id = ?");
        $statement->bind_param("si", $iconPath, $id);
        $statement->execute();

        $statement->close();
    }

    // funktion til at hente en bestemt user fra user-input
    public function getAUser($id){
        $userId = $id;

        $stmt = $this->database->get()->prepare("SELECT * FROM user_icons WHERE user_id = ? ");
        $stmt->bind_param("i",$userId);  // i = param type: integer
        $stmt->execute();
        $result = $stmt->get_result();

        $output = [];

        while ($row = $result->fetch_row()) {
            $output[] = $row;
        }

        $stmt->close();
        return $output;
    }
}