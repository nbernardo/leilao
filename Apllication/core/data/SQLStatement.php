<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SQLStatement
 *
 * @author CNTIP021
 */
class SQLStatement {

    public $query;

    public function __construct(AbstractDTO $dto) {
        $this->realDTO = $dto;
        $this->dto = substr($dto, 0, strlen($dto) - 3);
        $this->query = "SELECT " . substr($dto->getAttributes(), 2, count($dto->getAttributes()) - 3);
    }

    public function join($statement, $show = false) {
        
        $innerTable = array();
        $innerRows = explode(",", $statement);
        $joinString = "";
        
        foreach ($innerRows as $x => $innerRow) {
            $row = explode(".", $innerRow);
            if (!in_array(trim($row[0]), $innerTable))
                $innerTable[trim($row[0])] = trim($row[0]);
        }

        foreach ($innerTable as $x => $class) {
            try {
                if (!class_exists(StringUtil::Capitalize($class . 'DTO')))
                    throw new Exception('Não existe nenhuma class identificada por: ' . $class . '<br>');
                else
                    $classes[$x] = StringUtil::Capitalize($class . 'DTO');
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
        }

        foreach ($classes as $class) {
            foreach ($class::$relation as $relation) {
                if ($relation == strtolower($this->dto)) {
                    $class = strtolower(substr($class,0,strlen($class)-3));
                    $joinString .= " INNER JOIN ".$class." ON ".$class.".id".StringUtil::Capitalize($this->dto)."=".strtolower($this->dto).".id";
                }
            }
        }
        $query = $this->query . ", " . $statement." FROM ".strtolower($this->dto).$joinString;
        if($show)
            return $query;
        try {
            $query = $this->realDTO->Connection()->query($query);
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}

?>
