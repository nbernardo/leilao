<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerUtil
 *
 * @author Nakassony.Bernardo
 */
class FactoryController {

    //put your code here

    private $controller;
    private $attributes;
    private $controllerFile;
    private $dto;

    /*
     * O Constructor da class define o
     * controlle A ser instanciado
     */

    public function __construct($data) {
        try {
            //Se por acaso não haver um parametro controller
            //na URL (action) do form, é gerado uma exceção
            if (!@$_GET['controller'])
                throw new Exception("N&atilde;o existe nenhum controller definido");

            //Pega a Entity principal (parametro controller de URL[action] do form)
            $entity = $_GET['controller'];
            //Define o controller a ser instanciado
            $controller = $entity . "Controller";
            //Define o DTO a ser instanciado
            $this->dto = $entity . "DTO";
            //Define o ficheiro onde se encontra o controller e ser instanciado
            $this->controllerFile = file_exists('Apllication/controller/' . $controller . ".php");
            //Verifica se existe o controller indicado na URL (action) do form
            //Caso não existe o ficheiro do controller, uma exceção é gerada
            if (!$this->controllerFile)
                throw new Exception("N&atilde;o existe nenhum Controller com identificador " . $controller);
            //Instancia o controller
            $this->controller = new $controller; //$controller;
            //Pega os dados a serem passados para o metodo a ser executado
            $this->attributes = $data;
        } catch (Exception $e) {
            echo "<br>" . $e->getMessage();
        }
    }

    public function getCurrentController() {
        return $this->controller;
    }

    public function executeMethod($show = false) {
        try {
            //Verifica a existência de um methodo na URL (action) do form
            //Se por acaso não houver o metodo, uma exceção é gerada
            if (!@$_GET['method'] && !(isset($_GET['actionButton']) || isset($_POST['actionButton'])))
                throw new Exception("N&atilde;o existe nenhum metodo a ser executado");


            $_GET['method'] = $this->defineMethod();
            //Verifica se existe o metodo referenciado na URL (action) do form
            //Se por acaso não existir o metodo para o controller insanciado, uma exceção é gerada
            if (@$this->controller->methods()) {
                if (!in_array($_GET['method'], $this->controller->methods()))
                    throw new Exception("N&atilde;o existe nenhum m&eacute;todo " . $_GET['method'] . "() para o controller referenciado " . $this->controller);
            }
            //Confirma a existencia a do controller e sua existência
            //Caso a confirmação seja false, uma exceção é gerada
            else if ((!@$_GET['controller'] || !$this->controllerFile) && isset($_GET['method']))
                throw new Exception("N&atilde;o existe nenhum m&eacute;todo " . $_GET['method'] . "() para o controller referenciado");

            //Retorna o metodo a ser executado e $show for true 
            //e não executa 
            if ($show)
                return $_GET['method'];
            
            //Executa o method
            $this->controller->{$_GET['method']}($this->attributes);
            
        } catch (Exception $e) {
            echo "<br>" . $e->getMessage();
        }
    }

    private function defineMethod() {

        if (isset($_GET['Submit']) || isset($_POST['Submit']) || isset($_GET['submit']) || isset($_POST['submit'])) {
            $_GET['method'] = $_GET['method'];
        } else if (isset($_GET['actionValue'])) {
            $method = array_keys(@$_GET['actionButton']);
            $_GET['method'] = $method[0];
        } else if (isset($_POST['actionValue'])) {
            $method = array_keys($_POST['actionButton']);
            @$_GET['method'] = $method[0];
        }
        return $_GET['method'];
    }

    public function execute($method) {
        //Separa um determinado method enviado pelo 
        //nakassonyActionButton a partir da view (Ex: dto.find)
        $method = explode(".", $method);

        //Verifica se existe referência de dto na action enviada (Ex: dto.get) 
        if (count($method) > 1 && ($method[0] == "dto" || $method[0] == "DTO")) {

            //Instancia o DTO no qual o metho será executado
            $this->dto = new $this->dto;
            //Executa o method existente no DTO
            return $this->dto->$method[0];
            
        } else {
            
            //Executa o metodo para a objeco gerato pelo FactoryController
            $this->controller->$method[0]($this->attributes);
        }
    }

}

?>
