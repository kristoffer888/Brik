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



        $statement = $this->database->get()->prepare("SELECT * FROM user_icons LIMIT ?, ?");
        $statement->bind_param("ii", $lmt, $limit);
        $statement->execute();

        $result = $statement->get_result();

        /**
         * @var array
         */
        $userIcons = [];

        while ($row = $result->fetch_row()) {
            $userIcons[] = $row;
        }

        $statement->close();

//        if(!$userIcons)
//            return "ERROR";

        return $userIcons;
    }
}