<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractController
 *
 * @author Nakassony.Bernardo
 */
abstract class AbstractController {

    private static $curentController;
    private $view;

    public function setAttributes($attributes = null, $dtoToReturn = null) {
        try {
            foreach ($attributes as $field => $value) {
                //Separa as entidades dos attributos (Ex: Utilizador.Username)
                $fieldComposition = explode(".", $field);
                //Define os DTOs a serem instanciados apenas uma vez
                $dtoString = $fieldComposition[0] . "DTO";

                if (!@$dto[$dtoString]) {
                    $stringClass[] = $dtoString;
                    $dto[$dtoString] = new $dtoString;
                    if (isset($dto[$dtoString]::$relation) && !empty($dto[$dtoString]::$relation)) {
                        foreach ($dto[$dtoString]::$relation as $chave => $valor) {
                            if ($chave == 'hasOne' || $chave == 'hasMany')
                                $saveFirstEntity = true;
                            else {
                                $saveFirstEntity = false;
                                throw new Exception("Declaracao de relacionamento (" . $chave . ") inv&aacute;lida em " . $dto[$dtoString]);
                            }
                        }
                    }
                }

                if ($fieldComposition[0] . "DTO" == $dtoString) {
                    $dtoAttributes[$dtoString][$fieldComposition[1]] = $value;
                }
            }
            //die(var_dump($dtoAttributes));

            $x = 0;
            foreach ($dto as $dtoClass) {
                //Pega os metodos existentes no DTO actual
                $currentMethods = get_class_methods($dtoClass);

                //Ciclo para ir setando todos os dados enviados mesmo que nulos
                foreach ($dtoAttributes[$stringClass[$x]] as $field => $value) {

                    //Linha que executa apenas se ocorrer de nao haver um determinado metodo set
                    if (!in_array("set" . StringUtil::Capitalize($field), $currentMethods))
                        throw new Exception("N&atilde;o extste metodo set" . StringUtil::Capitalize($field) . "() para class " . $dtoClass);

                    //Execucao dos metodos set e passagem de dos respectivos valores (Parametros)
                    $valueSanitize = addslashes($value);
                    $valueSanitize = str_replace("\\\\","\\",preg_quote($valueSanitize,"-")); 
                    @$dtoClass->{set . StringUtil::Capitalize($field)}(htmlspecialchars($valueSanitize));

                    //Insere o ID para o lado Um
                    if (isset($dtoClass::$relation) && !empty($dtoClass::$relation)) {
                        foreach ($dtoClass::$relation as $chave => $field) {
                            @$dtoClass->{setId . $field}(htmlspecialchars($idObject));
                        }
                    }
                }

                if ($x == 0 && $_GET['method'] == 'save' && isset($saveFirstEntity)) {
                    $dtoClass->save();

                    $idObject = $dtoClass->getLastObject();
                }
                $x++;
            }

            return!is_null($dtoToReturn) ? $dto[$dtoToReturn] : count($dto) > 1 ? $dto : $dto[$dtoString];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function __construct($c = false) {
        try {
            if ($c == "")
                throw new Exception("N&atilde;o foi definido nenhum controller no constructor do controller actual, por favor, informe este parametro");
            if (!class_exists($c))
                throw new Exception("N&atilde;o existe nenhum controller com identificador " . $c . " verifica o string passado no constructor");
            self::$curentController = $c;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function __toString() {
        return self::$curentController;
    }

    public function methods() {
        return get_class_methods(self::$curentController);
    }

    public static function getDTO() {
        try {

            $dto = explode('Controller', self::$curentController);
            $dto = $dto[0] . "DTO";
            if (!class_exists($dto))
                throw new Exception("N&atilde;o existe nenhum DTO com identificador " . $dto);
            return new $dto;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function gridBind() {
        try {
            if (!isset($this->result) || empty($this->result))
                throw new Exception('N&atilde;o existe nenhum resultado definido');
            HTMLComponent::GenerateTable($this->result);
        } catch (Exception $e) {
            echo "<br>" . $e->getMessage();
        }
    }

    public function formBind() {
        try {
            if (!isset($this->result) || empty($this->result))
                throw new Exception('N&atilde;o existe nenhum resultado definido');
            HTMLComponent::populateForm($this->result);
        } catch (Exception $e) {
            echo "<br>" . $e->getMessage();
        }
    }

    public function divBind() {
        try {
            if (!isset($this->result) || empty($this->result))
                throw new Exception('N&atilde;o existe nenhum resultado definido');
            HTMLComponent::populateDiv($this->result);
        } catch (Exception $e) {
            echo "<br>" . $e->getMessage();
        }
    }

    public function viewDirectory($dir) {
        try {
            if (empty($dir))
                throw new Exception("Defina o directorio das views para " . $this->curentController);
            $this->view = new Smarty();
            $this->view->template_dir = $dir;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function view() {
        return $this->view;
    }


    public static function appBaseUrl(){
		return "http://" . $_SERVER['HTTP_HOST']."/";
    }
    
    public static function json($object){

        $data = !is_array($object) ? "[".json_encode($object)."]" : json_encode($object);
        $result = "{\"success\":true, \"dados\":".$data."}";

        echo $result;
        return $result;

    }

    public static function var_dump($value){

        echo "<pre>";
        print_r($value);
        echo "</pre>";
        
    }

    public static function dd($value){

        echo "<pre>";
        print_r($value);
        echo "</pre>";
        die();

    }
}

?>
