<?php
session_start();

/**
 *  
 * UserController 
 * 
 * @author Nakassony.Bernardo
 */


class UserController extends AbstractController {

    public function update($a){

        $dto = $this->setAttributes($a);

        if($dto->getImagemPerfil() != "")
            $dto->updateWitImage();
        else
            $dto->updateAccount();
        //self::dd($dto);
        echo "Actualizando";
    }


    public function save($a)
    {
        
        $dto = $this->setAttributes($a);
        $nomeFicheiro = UtilController::saveB64ToImage($dto->getImagemPerfil(),"Pages/images/profile/");
        $dto->setImagemPerfil($nomeFicheiro['nome']);
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
       header("Location: ".self::appBaseUrl());
   }


   public function findInfo(){

        session_start();
        $dto = self::getDTO();
        $dto->setId($_SESSION['user']->id);
        $result = $dto->find('id');
        self::json($result);
   }


    public function __construct($class = __CLASS__)
    {
        parent::__construct($class);
    }


    public function userPermission(){
        
        session_start();
        if(isset($_SESSION['user'])){

            $permissions = array(
                                    "VENDEDOR" => "VENDEDOR",
                                    "COMPRADOR" => "COMPRADOR",
                                    "COMPRADOR_VENDEDOR" => "COMPRADOR_VENDEDOR",
                                    "ADMIN" => "ADMIN",
                                );

            if($permissions[$_SESSION['user']->tipoConta] == "ADMIN"){
                $this->adminPermissionView();
            }

            return $permissions[$_SESSION['user']->tipoConta];

        }
        
    }

    public function adminPermissionView(){
        echo "
                <script>
                    console.log('Logged as ADMIN');
                    document.getElementById('lkProduto').click();
                    document.getElementById('chatIframe').style.zIndex = '1002';
                    console.log('After logged as ADMIN');
                </script>
            ";
    }

}