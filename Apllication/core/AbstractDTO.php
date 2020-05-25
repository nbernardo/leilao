<?php

require_once('util/databasefileimport.php');

//require($_SERVER['DOCUMENT_ROOT'] ."/Apllication/core/data/Connection.php");

/**
 * Description of AbstractDTO
 *
 * @author Nakassony.Bernardo
 */
abstract class AbstractDTO {

    private $childClass;
    private $methods;
    const TOSELECT = "select";

    public function __construct($stringClass) {
        $this->childClass = $stringClass;
        $this->defineTable();
        $this->methods = get_class_methods($this->childClass);
    }

    private function defineTable() {
        if (!isset($this->table)) {
            $table = explode('DTO', $this->childClass);
            $table = strtolower(substr($table[0], 0, 1)) . substr($table[0], 1, strlen($table[0]) - 1);
            $this->table = $table;
        }
    }

    public function attributes($dto) {
        return implode(array_keys(get_object_vars($dto)), ",");
    }

    public static function Connection() {
        return Connection::getInstance();
    }

    public function __toString() {
        return $this->childClass;
    }

    private function attrUpdate() {
        return array_keys(get_class_vars($this->childClass));
    }

    public function getAttributes() {
        $attrs = array_keys(get_class_vars($this->childClass));

        foreach ($attrs as $x => $attr) {
            $newAttrs[$x] = $this->table.".".$attr;
            $idField = !empty($this->id) && $this->id > 0 ?  'id,' : '';
            //$newAttrs[$x] = $attr;
            if ($attr == 'id' || $attr == 'relation' || $attr == 'table' || $attr == 'childClass' || $attr == 'methods')
                unset($newAttrs[$x]);
        }
        return " ({$idField}" . implode(", ", $newAttrs) . ") ";
    }

    public function getGetMethods($all = false ) {
        $methods = $this->methods;
        $idField = !empty($this->id) && $this->id > 0 ?  "'".$this->id."'," : '';
        foreach ($methods as $method) {
            if (substr($method, 0, 3) == 'get' && $method != 'getGetMethods'
                    && $method != 'getAttributes' && $method != 'getId' && $method != 'getLastObject'
                    && $method != 'getTable' && $method != 'getAddedRecord')
                $newMethods[] = "'" . $this->$method() . "'";
        }
        return " ({$idField}" . implode(', ', $newMethods) . ") ";
    }

    public function save($showQuery = false) {
        try {
            $queryString = "INSERT INTO " . $this->table . $this->getAttributes() . " VALUES " . $this->getGetMethods();
            if ($showQuery)
                return $queryString;
                #$this->Connection()->query($queryString);
                $stmt = $this->Connection()->prepare($queryString);
                $rs = $stmt->execute();
                    return $rs;
                #echo "Dados '" . $this->table . "' armazenados com sucesso<br>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function find($by = null, $show = false) {
        $findBy = !is_null($by) ? " WHERE ".$this->defineParameter($by) : "";
        try {
            $queryString = "SELECT ".$this->table.".id, ".  substr($this->getAttributes(), 2,  strlen($this->getAttributes())-4)." FROM " . $this->table.$findBy;
            if($show)
                return $queryString;
            $query = $this->Connection()->query($queryString);
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findUnion($by = null, $show = false) {
        //$findBy = !is_null($by) ? " WHERE ".$this->defineParameter($by) : "";
        return new SQLStatement($this);
    }

    public function delete($by = null, $show = false) {

        $deleteBy = $this->defineParameter($by);

        try {
            $queryString = "DELETE FROM " . $this->table . " WHERE " . $deleteBy;
            if($show)
                return $queryString;
            $this->Connection()->query($queryString);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($by = null, $show = false) {
        foreach ($this->attrUpdate() as $attr) {
            if ($attr != "childClass" && $attr != "table" && $attr != "id" && $attr != "methods" && $attr != "relation")
                $fields[] = $attr . '="' . $this->{'get' . StringUtil::Capitalize($attr)}() . '"';
        }

        $updateBy = $this->defineParameter($by);

        $queryString = "UPDATE " . $this->table . " SET " . implode(",", $fields) . " WHERE " . $updateBy;
        if ($show) {
            return $queryString;
        }
        try {
            $this->Connection()->query($queryString);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $queryString;
    }

    public function exist($by = null, $show = false){
        $by = !is_null($by) ? $by : 'id';
        $result = $this->find($by,$show);
        if($show)
            return $result;
        return count($result) > 0 ? true : false;
    }

    public function getLastObject() {
        try {

            $queryString = "SELECT id FROM " . $this->table . " ORDER BY id DESC LIMIT 1";
            $query = $this->Connection()->query($queryString);
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            return $result[0]->id;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getId() {
        return empty($this->id) ? $this->getLastObject() : $this->id;
    }

    public function defineParameter($by) {
        if (!is_null($by)) {
            if (!in_array('get' . StringUtil::Capitalize($by), $this->methods))
                die("N&atilde;o existe nenhuma propriedade '" . $by . "' para o DTO " . $this->childClass);
            $updateBy = $by . "='" . $this->{'get' . StringUtil::Capitalize($by)}() . "'";
        }else
            $updateBy = 'id=' . $this->getId();
        return $updateBy;
    }

    public function getAddedRecord() {
        try {

            $queryString = "SELECT * FROM " . $this->table . " WHERE unique_id = '".$this->getUnique_id()."'";
            $query = $this->Connection()->query($queryString);
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            return $result[0];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>
