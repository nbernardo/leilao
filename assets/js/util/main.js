function createSpinner(){

    _spiner = document.createElement("div");
    _spiner.className = "loader"; 
    return _spiner;

}

function l(id){
    return document.querySelector(id);
}

function newElement(el){
    return document.createElement(el);
}

function createChatContainer(){

    let chatDiv = newElement("div");
    chatDiv.id = "chat";
    chatDiv.style.width = "300px";
    chatDiv.style.height = "37px";
    chatDiv.style.background = "white";
    chatDiv.style.position = "fixed";
    chatDiv.style.bottom = "0";
    chatDiv.style.right = "50px";
    chatDiv.style.zIndex = "10";
    chatDiv.style.boxShadow = "0px 1px 7px #0e8ce4";
    chatDiv.style.borderTopLeftRadius = "6px";
    chatDiv.style.borderTopRightRadius = "6px";
    chatDiv.style.overflow = "hidden";
    //37px
    chatDiv.innerHTML = chatView();

    document.body.appendChild(chatDiv);
    

}

function minimizeChat(){
    if(l("#chat").style.height == "37px")
        l("#chat").style.height = "400px";
    else
        l("#chat").style.height = "37px";
}

function chatSendMessage(){
    let pressedKey = event.keyCode || event.charCode;

    if(pressedKey == 13 && event.ctrlKey){
        console.log("Helo");
        l('#textLocal').value = l('#textLocal').value+"\r\n";
        //l('#textLocal').value = l('#textLocal').value+"<br>Ola"
    }

    else if(pressedKey == 13){

        //if(!event.ctrlKey){
            event.preventDefault();
            let message = l('#textLocal').value;

        if(message.length != ""){

            let messageContainer = newElement("div");
            messageContainer.className = "myMessage";
            messageContainer.innerHTML = message;
            l("#messagesLocal").appendChild(messageContainer);
            
            l('#textLocal').value = "";

        }
            
        //}
        //while(document.getElementById('textLocal').firstChild){
//            //console.log("Chamou");
            //document.getElementById('textLocal').removeChild(document.getElementById('textLocal').firstChild);
            document.getElementById('textLocal').innerHTML = document.getElementById('textLocal').innerHTML.substr(0,0);
            //document.getElementById('textLocal').removeChild(document.getElementById('textLocal').firstChild);
            //l('#textLocal').removeChild(l('#textLocal').firstChild);
        //}
 //       //document.getElementById('textLocal').removeChild(document.getElementById('textLocal').firstChild);

    }
}


function chatView(){

    return `

        <div class="chatTitle" onclick="minimizeChat()">
            <span>
                Chat - <span id="nomePessoaChat">Nome pessoa</span>
            </span>
            <span class="minimize">--</span>
        </div>
        <div id="messagesLocal"></div>
        <textarea id="textLocal" onkeypress="chatSendMessage()" contentEditable="true"></textarea>
        <button type="button">Enviar</button>
    `

}

//createChatContainer();