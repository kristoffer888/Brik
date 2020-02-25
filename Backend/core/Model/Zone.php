<?php


class Zone
{
    private $id;

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    private $name;

    function __construct($name)
    {
        $this->id = null;
        $this->name = $name;
    }

    public static function DatabaseInitializer($id, $name) {
        $zone = new Zone($name);
        $zone->id = $id;

        return $zone;
    }
}