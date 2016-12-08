<?php

/**
 * Created by PhpStorm.
 * User: pach
 * Date: 05/12/16
 * Time: 17:28
 */
abstract class Utility
{
    /**
     * @return PDO|string
     */
    protected static function Connect()
    {
        try {
            $db = new PDO("mysql:host=localhost;dbname=phpoop", "elpach", "aze");
            return $db;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @return array of objects
     */
    public static function All()
    {

        $stmt = self::Connect()->query("SELECT * FROM " . static::TABLE . "
                                        ORDER BY ID DESC");

        while ($temp = $stmt->fetchObject(get_called_class())) {
            $temps[] = $temp;
        }
        return $temps;
    }

    /**
     * @param array $value
     * @return bool
     */
    public static function Create($value = [])
    {
        $placeholders = "";
        foreach ($value as $ind => $vv) {
            $fields[] = $ind;
            $data[] = $vv;
            $placeholders .= "?,";
        }
        $sql = "INSERT INTO " . static::TABLE . " (" . implode(",", $fields) . ") VALUES (" . trim($placeholders, ',') . ")";
        $stmt = self::Connect()->prepare($sql);
        if (!$stmt->execute($data)) {
            return false;
        }
        return true;
    }

    /**
     * @param $id
     * @return array|bool
     */
    public static function Find($id)
    {
        $stmt = self::Connect()->prepare("SELECT * FROM " . static::TABLE . " WHERE id=? LIMIT 1");
        if (!$stmt->execute([$id])) {
            return false;
        }
        return $stmt->fetchObject(get_called_class());
    }

    /**
     * @param string $col
     * @param string $op
     * @param $value
     * @return array|bool
     */
    public static function Where($col = "id", $op = "=", $value)
    {
        $sql = "SELECT * FROM " . static::TABLE . " WHERE " . $col . " " . $op . "? ORDER BY 'id' DESC ";
        $stmt = self::Connect()->prepare($sql);

        if (!$stmt->execute([$value])) {
            return false;
        }
        while ($temp = $stmt->fetchObject(get_called_class())) {
            $temps[] = $temp;
        }
        return $temps;
    }
//here
    /**
     * @param $id
     * @return bool
     */
    public static function Delete($id)
    {
        $stmt = self::Connect()->prepare("DELETE FROM " . static::TABLE . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        if (!$stmt->execute()) {
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public function Destroy()
    {
        $stmt = self::Connect()->prepare("DELETE FROM " . static::TABLE . " WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        if (!$stmt->execute()) {
            return false;
        }
        unset($this);
        return true;
    }

    /**
     * @param array $value
     * @return mixed bool/object
     */
    public function Update($value = [])
    {
        foreach ($value as $ind => $vv) {
            $fields[] = $ind . " = ? ";
            $values[] = $vv;
        }
        if (isset($value["id"])) {
            $this->id = $value["id"];
        }
        $values[] = $this->id;

        $sql = "UPDATE " . static::TABLE . " SET " . implode(", ", $fields) . " WHERE id = ?";
        $stmt = self::Connect()->prepare($sql);

        if (!$stmt->execute($values)) {
            return false;
        }
        return true;
    }

    /**
     * @param array $value
     * @return mixed
     */
    public static function Edit($value = [])
    {
        $class = get_called_class();
        $data = new $class(["id" => $value["id"]]);
        unset($value["id"]);
        return $data->Update($value);
    }

    public static function Search($field,$input)
    {
        $stmt = self::Connect()->prepare("SELECT * FROM " . static::TABLE . " WHERE ". $field." LIKE ?");

        if (!$stmt->execute(["%$input%"])) {
            return false;
        }
        while ($temp = $stmt->fetchObject(get_called_class())) {
            $temps[] = $temp;
        }
        return $temps;
    }

}
