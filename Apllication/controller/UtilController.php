<?php


class UtilController {


    public static function saveB64ToImage($imageFile, $savePath){

        $parseFile = explode("base64,",$imageFile);
        $tipoImagem = $parseFile[0] == "data\:image/png;" || $parseFile[0] == "data:image/png;" ? "png" : "jpg";

        $nomeImagem = self::uuid();

        //Remove if png
        $imagem = str_replace("data:image/png;base64,","",$imageFile);
        $imagem = str_replace("data\:image/png;base64,","",$imagem); //Por causa do addslashes in set attribute
        
        //Remove if jpg
        $imagem = str_replace("data:image/jpeg;base64,","",$imagem);
        $imagem = str_replace("data\:image/jpeg;base64,","",$imagem);//Por causa do addslashes in set attribute


        $file = fopen("{$savePath}{$nomeImagem}.{$tipoImagem}","wb");
        fwrite($file,base64_decode($imagem));
        fclose($file);
        
        return [
                "nome" => $nomeImagem.".".$tipoImagem,
                "tipo" => $tipoImagem
            ]; 

    }


    public static function saveB64ToImageV($imageFile, $savePath){

        $tipoImagem = strpos($imageFile,"image/png") >= 0 ? "png" : "jpg";
        $nomeImagem = self::uuid();
        echo($imageFile);
        //Remove if png
        $imagem = str_replace("data\:image/jpeg;base64,","",$imageFile);
        $imagem = str_replace("data:image/jpeg;base64,","",$imagem);
        
        //Remove if png
        $imagem = str_replace("data\:image/png;base64,","",$imagem);
        $imagem = str_replace("data:image/png;base64,","",$imagem);


        $file = fopen("{$savePath}{$nomeImagem}.{$tipoImagem}","wb");
        fwrite($file,base64_decode($imagem));
        fclose($file);
        
        return [
                "nome" => $nomeImagem.".".$tipoImagem,
                "tipo" => $tipoImagem
            ]; 

    }

    public static function saveB64ToPDF($imageFile, $savePath){

        $nomeImagem = self::uuid();
        
        $imagem = str_replace("data:application/pdf;base64,","",$imageFile);
        
        $file = fopen("{$savePath}{$nomeImagem}.pdf","wb");
        fwrite($file,base64_decode($imagem));
        fclose($file);
        
        return [
                "nome" => $nomeImagem.".pdf",
                "tipo" => "pdf"
            ]; 

    }


    public static function uuid(){
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
    


}