<?php

/**
 * Class UserLocation The table.
 * @author Sebastian Davaris
 */
class UserLocation
{
    private $id;
    private $userId;
    // Not sure about the locationId but will keep it for now.
    private $zone;
    private $createdAt;
    private $updatedAt;

    function __construct($id, $userId, $zone, $createdAt, $updatedAt)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->zone = $zone;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}