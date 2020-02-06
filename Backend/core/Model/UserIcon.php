<?php


/**
 * Class UserIcon
 */
class UserIcon
{
    private $id;
    private $userId;
    private $firstName;
    private $lastName;
    private $iconPath;

    function __construct($userId, $firstName, $lastName, $iconPath)
    {
        $this->id = null;
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->iconPath = $iconPath;
    }

    public static function DatabaseInitializer($id, $userId, $firstName, $lastName, $iconPath)
    {
        $userIcon = new UserIcon($userId, $firstName, $lastName, $iconPath);
        $userIcon->id = $id;

        return $userIcon;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }


    /**
     * @return mixed
     */
    public function getIconPath()
    {
        return $this->iconPath;
    }

    /**
     * @param mixed $iconPath
     */
    public function setIconPath($iconPath)
    {
        $this->iconPath = $iconPath;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }


}