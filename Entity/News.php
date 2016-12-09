<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/core/ORM.php");
/**
 * Created by PhpStorm.
 * User: pach
 * Date: 04/12/16
 * Time: 23:42
 */
class News extends ORM
{
    protected $id;
    protected $title;
    protected $description;
    protected $category_id;
    const TABLE = "news";

    public function __construct($data = [])
    {
        !isset($data["id"])?:$this->id = $data["id"];
        !isset($data["title"])?:$this->title = $data["title"];
        !isset($data["description"])?:$this->description = $data["description"];
        !isset($data["category_id"])?:$this->category_id = $data["category_id"];
        !isset($data["cname"])?:$this->cname = $data["cname"];
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->description;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public static function AllwithCname($id = "%")
    {

        $stmt = parent::Connect()->query("
                 SELECT c.id,c.title,c.description,c.category_id,n.name cname
                 FROM news c LEFT JOIN categories n
                 ON c.category_id = n.id
                 WHERE c.category_id LIKE '$id'
                 GROUP BY c.id
                 ORDER BY cname DESC

                  ");

        while ($temp = $stmt->fetchObject(get_called_class())) {
            $temps[] = $temp;
        }

        return $temps;;
    }
}
