<?php
session_start();

/**
 *  
 * UserController 
 * 
 * @author Nakassony.Bernardo
 */


class UserController extends AbstractController {

    public function save($a)
    {
        $dto = $this->setAttributes($a);
        $nomeFicheiro = UtilController::saveB64ToImage($dto->getImagemPerfil(),"Pages/images/profile/");
        $dto->setImagemPerfil($nomeFicheiro);
        $dto->save();
   }


   public function logar($a)
   {
         $dto = $this->setAttributes($a);
         $dados = $dto->logar();
         if(password_verify($dto->getPassword(true),$dados[0]->password)){
            echo "{\"sucesso\": \"true\"}";
            $_SESSION['user'] = $dados[0];
            return;
         }

         echo "{erro: \"Utilizador ou senha errada\"}";
         return;
   }

   public function sair(){
       unset($_SESSION['user']);
       header("Location: ".self::appBaseUrl()."base.php");
   }


    public function __construct($class = __CLASS__)
    {
        parent::__construct($class);
    }
}