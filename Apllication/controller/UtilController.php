<?php


class UtilController {


    public static function saveB64ToImage($imageFile, $savePath){

        $tipoImagem = strpos($imageFile,"image/png") >= 0 ? "png" : "jpg";
        $nomeImagem = self::uuid();
        //Remove if png
        $imagem = str_replace("data:image/png;base64,","",$imageFile);
        
        //Remove if png
        $imagem = str_replace("data:image/jpeg;base64,","",$imagem);


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