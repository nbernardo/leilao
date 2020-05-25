function ajax(){
    //Função que instancia um 
    //objecto de requisição ajax
    try{
        if(!xhr)
            var xhr = new XMLHttpRequest();
    }catch(err){
        alert('Não foi possivel criar o objecto de requisição ajax');
    }
    return xhr;
}

function elementCreate(elm){
    return document.createElement(elm);
}

function formatCSS(component,type){
    
    with(component){
        if(type == 'failed'){
            style.background = 'lightpink';
            style.color = 'red';
            style.borderRadius = '6px';
            style.font = 'bold 12px tahoma';
            style.border = '1px solid red';
            style.marginTop = '10px';
            style.padding = '3px 3px';
            style.width = '400px';
            style.margin = '0px auto';
            style.textAlign = 'center';
        }else{
            style.border = 'none';
            style.background = 'none';
        }
        }

}

function dataComponent(componentId, tipo, valores){
	
    var tagSelect = document.createElement("select");
    var hora = 24;
    var minutos = 60;
    var x = 0;
	
    tipo = tipo == "h" || tipo == "H" ? hora : minutos;
	

    while(x < tipo){
        tagOption = document.createElement("option");
        numero = document.createTextNode(x);
        tagOption.appendChild(numero);
        tagSelect.appendChild(tagOption);
        x++;
    }
	
    document.getElementById(componentId).appendChild(tagSelect);
    document.getElementById(componentId).id = "";
    tagSelect.id = componentId;
    tagSelect.name = componentId;
}


function groupComponent(componentId,campos, tipo, onclickFunction, retornoTipo){
	
    var arrayCampos = campos;
    var opcoes = arrayCampos.split(",");
    var grupo = document.createElement("span");
    var localComponente = document.getElementById(componentId);
    var tiposSelect = {
        'exclusivo': '', 
        'multiplo': 'multiple'
    };
    
    localComponente.id = componentId+'1';
    tipoComponent = tipo.split("-");
    tipo = tipoComponent[0] == 'exclusivo' ? 'radio' : tipoComponent[0] == 'multiplo' ? 'checkbox' : 'grupo';
	
	
    if(tipo != "grupo"){	
        for(x=0; x<opcoes.length; x++){
            var component = document.createElement("input");
            component.setAttribute("type",tipo);
            component.setAttribute("id",componentId);
            nameField = componentId.indexOf('field') < 0 ? "field["+componentId+"]" : componentId;
            component.setAttribute("name",nameField);
            //alert(component.id);
            if(retornoTipo && retornoTipo == 'indice')
                component.setAttribute("value",x+1);
            else
                component.setAttribute("value",opcoes[x]);           
            component.setAttribute("onclick",onclickFunction);
            var rotulo = document.createTextNode(opcoes[x]);
            grupo.appendChild(component);
            grupo.appendChild(rotulo);
        }
    }else{
		
        var tagSelect = document.createElement("select");
        tagSelect.setAttribute('id', componentId);
        nameField = componentId.indexOf('field') < 0 ? "field["+componentId+"]" : componentId;
        tagSelect.setAttribute('name', nameField);
        var tagOption = document.createElement("option");
        tagOption.appendChild(document.createTextNode('SELECIONE'));
        tagOption.setAttribute('value', '');
        tagSelect.appendChild(tagOption);
        
        if(tipoComponent[1] == 'multiplo'){
            tagSelect.setAttribute('multiple','multiple');
        }
		
        for(x=0; x<opcoes.length; x++){
            var tagOption = document.createElement("option");
            tagOption.appendChild(document.createTextNode(opcoes[x]));
            if(retornoTipo && retornoTipo == 'indice')
                tagOption.setAttribute("value",x+1);
            else
                tagOption.setAttribute("value",opcoes[x]);
            tagSelect.appendChild(tagOption);
            grupo.appendChild(tagSelect);
        }
		
    }
    localComponente.appendChild(grupo);
//document.getElementById(componentId).appendChild(grupo);	
}
										   
function inputComponent(componentID, tipo, requerido){

    var input = document.createElement("input");
    input.setAttribute("id",componentID);
    input.setAttribute("name",componentID);
	
    if(requerido){
        input.onchange = function(){ 
            if(input.value.length < 1){
                input.style.background = '#FF9F9F';
            }else{
                input.style.background = '#B8F5B1';
            }
        }
		
        input.onblur = function(){
            if(input.value.length < 1){
                input.style.background = '#FF9F9F';
            }else{
                input.style.background = '#B8F5B1';
            }
        }
    }
	
    if(tipo == "data"){	
        input.onkeyup = function(){
            input.setAttribute("maxlength",10);
            if(input.value.length == 3 && input.value[2] != "/"){
                input.value = input.value.substr(0,2)+"/"+input.value.substr(2,2);
            }else if(input.value.length == 6 && input.value[5] != "/"){
                input.value = input.value.substr(0,5)+"/"+input.value.substr(5,2);	
            }
        }
    }else if(tipo == "telefone"){
        input.onkeyup = function(){
            input.setAttribute("maxlength",11);
            if(input.value.length == 4 && input.value[3] != "-"){
                input.value = input.value.substr(0,3)+"-"+input.value.substr(3,3);
            }else if(input.value.length == 8 && input.value[7] != "-"){
                input.value = input.value.substr(0,7)+"-"+input.value.substr(7,3);	
            }
        }
    }
	
    document.getElementById(componentID).appendChild(input);
}

function monthComponent(id, required){
    var meses = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
    var combo = document.createElement('select');
    var opcao = document.createElement('option');
    opcao.appendChild(document.createTextNode("SELECIONE"));
    opcao.setAttribute("value", "");
    combo.appendChild(opcao);
    if(required && required != "")
        combo.setAttribute("required", required);
		
    combo.setAttribute("id", id);
    combo.setAttribute("name", id);
    for(x=0; x< meses.length; x++){
        var opcao = document.createElement('option');
        opcao.setAttribute("value", x+1);
        opcao.appendChild(document.createTextNode(meses[x]));
        combo.appendChild(opcao);
    }
    document.getElementById(id).appendChild(combo);
}

function actionButton(id, action, value){
    var button = document.createElement('input');
    var actionValue = document.createElement('input');
    
    actionValue.setAttribute('type', 'hidden');
    actionValue.setAttribute('value', action);
    actionValue.setAttribute('name', 'actionValue['+value+']');
    
    button.setAttribute('type', 'submit');
    button.setAttribute('name', 'actionButton['+action+']');
    button.setAttribute('id', id);
    button.setAttribute('value', value);
    button.onclick = function(){
    //this.value = action;
    }
    document.getElementById(id).appendChild(button);
    document.getElementById(id).appendChild(actionValue);
}


function ajaxButton(id, value, click, url, fields, callbackPlaceID, definedController, method, dumpResult){
    
    var callbackPlace = document.getElementById(callbackPlaceID);
    var button = document.createElement("input");
    button.setAttribute('type', 'button');
    button.setAttribute('value', value);
    
    button.onclick = function(){
        objAjax = ajax();
        var camposUrl = "?";
        var resultado = "";
        var controller = "";
        var dumpResultValue = "";
        var campos = fields.split(',');
        
        if(definedController != null){

            controller = 'controller='+definedController;
            method = '&method='+method;
            for(x=0;x<campos.length;x++){
                inputId = campos[x];
                camposUrl+='field['+campos[x]+']='+document.getElementById(inputId).value+"&"; 
            }
        }else{
            for(x=0;x<campos.length;x++){
                inputId = campos[x];
                camposUrl+=campos[x]+'='+document.getElementById(inputId).value+"&"; 
            }
        }
        
        novosValores = camposUrl.split("& ");
        for(x=0;x<novosValores.length;x++){
            resultado += novosValores[x]+"&";
        }
        
        resultado = resultado.substr(0, resultado.length - 1)+''+controller+''+method;
        
        if(url == null){
            urlFInal = "../../controllerGateway.php"+resultado;
        }else{
            urlFInal = url+""+resultado.substring(0, resultado.length -1);
        }

        objAjax.open('GET', urlFInal,true);
        objAjax.send();
        objAjax.onreadystatechange = function(){

            if(objAjax.readyState == 4 && objAjax.status == 200){
                dumpResultValue = dumpResult == "true" ? objAjax.responseText : "";
                if(objAjax.responseText.indexOf('Alert:') >= 0 || objAjax.responseText.indexOf('Erro:') >= 0){
                    textoResultado = "<font color='red'><b>Ocorreu um ao executar requisi&ccedil;&atilde;o</b></font><br><br>"+dumpResultValue;
                    formatCSS(callbackPlace, 'normal');
                }else if(objAjax.responseText.indexOf('setUpMessage=') >= 0){
                    if(document.getElementById('pwClientMSG')){
                        var divMSG = document.getElementById('pwClientMSG');
                        formatCSS(divMSG, 'failed');
                        divMSG.innerHTML = objAjax.responseText.substr(13, objAjax.responseText.length-1);
                    }else
                        alert(objAjax.responseText.substr(13, objAjax.responseText.length-1));
                }else{
                    formatCSS(callbackPlace, 'normal');
                    textoResultado = "<font color='green'><b>Requisi&ccedil;&atilde; executado com suceso</b></font><br><br>"+dumpResultValue;
                }
            }
            
            callbackPlace.style.font = "12px tahoma";
            callbackPlace.innerHTML = textoResultado;
            
        }

    };
    
    document.getElementById(id).appendChild(button);
    
}

pId= "";
pFields = "";
pController = "";
pMethod = "";
pIsAjax = "";
pPoll = "";
pGateway = "";
chamadaSincrona = 0;

function dataTable(id, fields, controller, method, isAjax, pool, link, filter, filterValue, gateway){
    
    if(chamadaSincrona == 0){
    
        pId = id != null ? id : "";
        pFields = fields != null ? fields : "";
        pController = controller != null ? controller : "";
        pMethod = method != null ? method : "";
        pIsAjax = isAjax != null ? isAjax : "";
        pPoll = pool != null ? pool : "";
        pLink = link != null ? link : "";
        pGateway = gateway == null ? "../../controllerGateway.php?controller=" : gateway+"?controller=" ;
    }
    
    if(filter == "true"){
        caixa = elementCreate('input');
        caixa.setAttribute('id', filterValue);
        caixa.onkeyup = function(){
            alert(caixa.value);
        }
        document.getElementById(id).appendChild(caixa);
    }
    
    if(isAjax == "true"){
        setTimeout('dataTable("'+pId+'","'+pFields+'","'+pController+'","'+pMethod+'","'+pIsAjax+'","'+pPoll+'")', 1000); 
    }

    var url = pGateway+''+controller+'&requi=ajax&method='+method+'&link='+link;
    var xhr = ajax();
    xhr.open('GET', url, true);
    xhr.send();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            valor = xhr.responseText;
        //valor = valor.split("</tr>");
        //alert(valor);
        }

        document.getElementById(id).innerHTML = valor;
    }
}

dId= "";
dFields = "";
dController = "";
dMethod = "";
dIsAjax = "";
dPoll = "";
dGateway = "";
dDivValue = "";
dTitle = "";
dSource = "";
chamadaSincrona1 = 0;

function divComponent(id, fields, controller, method, isAjax, pool, link, divValue, gateway, title, source){
    
    if(chamadaSincrona1 == 0){
    
        dId = id != null ? id : "";
        dFields = fields != null ? fields : "";
        dController = controller != null ? controller : "";
        dMethod = method != null ? method : "";
        dIsAjax = isAjax != null ? isAjax : "";
        dPoll = pool != null ? pool : "";
        dLink = link != null ? link : "";
        dGateway = gateway == null ? "../../controllerGateway.php?controller=" : gateway+"?controller=";
        dDivValue = divValue != null ? divValue : "";
        dTitle = title != null ? title : "";
        dSource = source != null ? source : "";
        
    }
    
    if(isAjax == "true"){
        setTimeout('dataTable("'+dId+'","'+dFields+'","'+dController+'","'+dMethod+'","'+dIsAjax+'","'+dPoll+'","'+dLink+'","'+dDivValue+'","'+dGateway+'","'+dTitle+'","'+dSource+'")', 1000); 
    }
    
    var url = dGateway+''+controller+'&requi=ajax&method='+method+'&link='+link+'&value='+divValue+'&title='+title+'&src='+source;
    var xhr = ajax();
    xhr.open('GET', url, true);
    xhr.send();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            valor = xhr.responseText;
        //valor = valor.split("</tr>");
        //alert(valor);
        }

        document.getElementById(id).innerHTML = valor;
    }
}

function searchInput(id,controller,method,value){
    
    var textInput = elementCreate('input');
    var button = elementCreate('input');
    textInput.setAttribute('name', id);
    var idField = id.substr(6, id.length-3).split("]");
    textInput.setAttribute('id', idField[0]);
    button.setAttribute('type', 'button');
    button.setAttribute('value', value);
    input = function(x,value){
        
        elm = document.getElementsByName('field['+controller+'.'+x+']');
        if(elm[0])
            elm[0].value = value;
    }
    
    document.getElementById(id).appendChild(textInput);
    document.getElementById(id).appendChild(button);
    
    button.onclick = function(){
        var xhr = ajax();
        var url = '../../controllerGateway.php?controller='+controller+'&requi=ajax&method='+method+'&'+textInput.name+'='+textInput.value;
        xhr.open('GET', url, true);
        xhr.send();
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                resultado = xhr.responseText.split('-&-');
                for(x=0; x< resultado.length; x++){
                    dado = resultado[x].split('=');
                    input(dado[0],dado[1]);
                }
            //document.getElementById('lugar').innerHTML = resultado;
            }
        }
    }
    
}

timerValue = 0;
vIdTimer = "";
vMaxTimer = "";
vMinTimer = "";
vStepTimer = "";
vStyleTimer = "";
vNormalColor = "";
chamadaTimer = 0;

function timerComponent(id,max,min,step,style,normalColor){
    
    if(chamadaTimer == 0){
        
        vIdTimer = id;
        vMaxTimer = max;
        vMinTimer = min != "null" ? min : 0;
        vStepTimer = step != "null" ? step : 1;
        vStyleTimer = style;
        vNormalColor = normalColor;
        chamadaTimer = 1;
        var divTimer = document.createElement('div');
        var divContainer = document.createElement('div');
        divContainer.appendChild(divTimer);
        divContainer.style.border = "1px solid black";
        divContainer.style.width = vMaxTimer+"px";
        divContainer.style.height = "20px";
        divTimer.style.height = "20px";
        divTimer.style.width = vMinTimer+"px";
        divTimer.style.background = "green";
    }
    
    divTimer.setAttribute('id', id);
    
    if((timerValue < vMaxTimer) && vMaxTimer > vMinTimer){
        timerValue += vStepTimer;
    }
    
    setTimeout('timerComponent("'+vIdTimer+'","'+vMaxTimer+'","'+vMinTimer+'","'+vStepTimer+'","'+vStyleTimer+'","'+vNormalColor+'")', 1000);
    divTimer.style.width = timerValue+"px";
    document.getElementById(id).appendChild(divContainer);
}

function defineComponent(){
	
    var hora = document.getElementsByTagName('nakassonyTime');
    var grupo = document.getElementsByTagName('nakassonyGroup');
    var input = document.getElementsByTagName('nakassonyInput');
    var mes = document.getElementsByTagName('nakassonyMonth');
    var botao = document.getElementsByTagName('nakassonyActionButton');
    var buttonAjax = document.getElementsByTagName('nakassonyAjaxButton');
    var tabela = document.getElementsByTagName('nakassonyTable');
    var div = document.getElementsByTagName('nakassonyDiv');
    var search = document.getElementsByTagName('nakassonySearch');
    var timer = document.getElementsByTagName('nakassonyTimer');

    if(timer.length > 0){
        for(x=0; x<timer.length; x++){
            timerComponent(timer[x].id, timer[x].getAttribute('max'), timer[x].getAttribute('min'), timer[x].getAttribute('step'),
                timer[x].getAttribute('style'),timer[x].getAttribute('normalColor'));
        }
    }
    
    if(search.length > 0){
        for(x=0; x<search.length; x++){
            searchInput(search[x].id, search[x].getAttribute('controller'), search[x].getAttribute('method'), search[x].getAttribute('value'));
        }
    }

    if(div.length > 0){
        for(x=0; x<div.length; x++){
            divComponent(div[x].id, div[x].getAttribute('fields'), div[x].getAttribute('controller'), div[x].getAttribute('method')
                ,div[x].getAttribute('reverseAjax'), div[x].getAttribute('pooling'), div[x].getAttribute('link'), div[x].getAttribute('value'),
                div[x].getAttribute('gateway'),div[x].getAttribute('title'),div[x].getAttribute('source'));
        }
    }
    

    if(tabela.length > 0){
        for(x=0; x<tabela.length; x++){
            dataTable(tabela[x].id, tabela[x].getAttribute('fields'), tabela[x].getAttribute('controller'), tabela[x].getAttribute('method')
                ,tabela[x].getAttribute('reverseAjax'), tabela[x].getAttribute('pooling'), tabela[x].getAttribute('link'), tabela[x].getAttribute('filter'),
                tabela[x].getAttribute('filterValue'),tabela[x].getAttribute('gateway'));
        }
    }
    
    if(buttonAjax.length > 0){
        for(x=0; x<buttonAjax.length; x++){
            ajaxButton(buttonAjax[x].id, buttonAjax[x].getAttribute('value'), buttonAjax[x].getAttribute('click'), 
                buttonAjax[x].getAttribute('url'), buttonAjax[x].getAttribute('fields'), buttonAjax[x].getAttribute('resultOn'), 
                buttonAjax[x].getAttribute('controller'), buttonAjax[x].getAttribute('method'), buttonAjax[x].getAttribute('dumpResult'));
        }
    }

    if(botao.length > 0){
        for(x=0; x< botao.length; x++){
            actionButton(botao[x].id, botao[x].getAttribute("action"), botao[x].getAttribute("value"));
        }
    }
    
    if(hora.length > 0){
        for(x=0; x < hora.length; x++){
            dataComponent(hora[x].id, hora[x].getAttribute("tipo"));
        }
    }
    
    if(mes.length > 0){
        for(x=0; x < mes.length; x++){
            monthComponent(mes[x].id,mes[x].getAttribute("required"));
        }
    }
	
    if(grupo.length > 0){
        for(x=0; x < grupo.length + 1; x++){
            groupComponent(grupo[x].id, grupo[x].getAttribute("valores"), grupo[x].getAttribute("tipo"), grupo[x].getAttribute("click"), grupo[x].getAttribute("retorno"), grupo[x].getAttribute("resultOn"));
        }
    }
	
    if(input.length > 0){
        for(x=0; x < input.length; x++){
            inputComponent(input[x].id, input[x].getAttribute("tipo"), input[x].getAttribute("requerido"));
        }
    }
}
