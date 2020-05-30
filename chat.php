<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="assets/js/socket.io.js"></script>
    <script>
        
        SOCK_CHAT = oi.connect("http://localhost:9005");

        function enviar(){

            if(event.keyCode == 13){
                SOCK_CHAT.emit("message", document.querySelector("#mensagem").value);
                document.querySelector("#mensagem").value = "";
            }

        }
        

    </script>

</head>
<body>
    
    <input type="text" id="mensagem" onkeypress="enviar()">
    
</body>
</html>