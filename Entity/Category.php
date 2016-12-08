<?php

require_once("Utility.php");

/**
 * Created by PhpStorm.
 * User: pach
 * Date: 04/12/16
 * Time: 21:40
 */
class Category extends Utility
{
    protected $id;
    protected $name;
    const TABLE = "categories";

    public function __construct($data = [])
    {
        !isset($data["id"])?:$this->id = $data["id"];
        !isset($data["name"])?:$this->name = $data["name"];
        !isset($data["count"])?:$this->count = $data["count"];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    public static function AllwithCount()
    {

        $stmt = parent::Connect()->query("
                  SELECT c.id,c.name,COUNT(n.id) count
                  FROM categories c
                  LEFT JOIN news n ON n.category_id = c.id
                  GROUP BY c.id
                  ORDER BY count DESC
                  ");

        while ($temp = $stmt->fetchObject(get_called_class())) {
            $temps[] = $temp;
        }

        return $temps;
    }
}
