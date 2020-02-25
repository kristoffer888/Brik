<?php


class UserTimestamp
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var integer
     */
    private $userId;
    /**
     * @var mixed
     */
    private $placedAt;

    private $removedAt;
    /**
     * @var string
     */
    private $zoneId;

    function __construct($userId, $zoneId)
    {
        $this->userId = $userId;
        $this->zoneId = $zoneId;
    }

    public static function databaseInitializer($id, $userId, $createdAt, $removedAt, $zoneId) {
        $userTimestamp = new UserTimestamp($userId, $zoneId);
        $userTimestamp->id = $id;
        $userTimestamp->placedAt = $createdAt;
        $userTimestamp->removedAt = $removedAt || null;

        return $userTimestamp;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getPlacedAt(): DateTime
    {
        return $this->placedAt;
    }

    /**
     * @return mixed
     */
    public function getRemovedAt()
    {
        return $this->removedAt;
    }

    /**
     * @param mixed $removedAt
     */
//    public function setRemovedAt($removedAt)
//    {
//        $this->removedAt = $removedAt;
//    }

    /**
     * @return string
     */
    public function getZoneId(): string
    {
        return $this->zoneId;
    }

    /**
     * @param string $zoneId
     */
    public function setZoneId(string $zoneId)
    {
        $this->zoneId = $zoneId;
    }
}