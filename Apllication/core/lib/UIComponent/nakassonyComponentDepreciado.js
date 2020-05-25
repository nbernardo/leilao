
function ajax(){
    try{
        if(!xhr)
            var xhr = new XMLHttpRequest();
    }catch(err){
        alert('Não foi possivel criar o objecto de requisição ajax');
    }
    return xhr;
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
    var tiposSelect = {
        'exclusivo': '', 
        'multiplo': 'multiple'
    };
	
    tipoComponent = tipo.split("-");
    tipo = tipoComponent[0] == 'exclusivo' ? 'radio' : tipoComponent[0] == 'multiplo' ? 'checkbox' : 'grupo';
	
	
    if(tipo != "grupo"){	
        for(x=0; x<opcoes.length; x++){
            var component = document.createElement("input");
            component.setAttribute("type",tipo);
            component.setAttribute("name",componentId);
            component.setAttribute("id",componentId+"1");
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
        tagSelect.setAttribute('name', componentId);
        tagSelect.setAttribute('id', componentId+"1");
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
	
    document.getElementById(componentId).appendChild(grupo);	
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


function ajaxButton(id, value, click, url, fields, callbackPlaceID){
    
    var camposUrl = "?";
    var resultado = "";
    var callbackPlace = document.getElementById(callbackPlaceID);
    var button = document.createElement("input");
    button.setAttribute('type', 'button');
    button.setAttribute('value', value);
    
    button.onclick = function(){
        objAjax = ajax();
        var campos = fields.split(',');
        for(x=0;x<campos.length;x++){
            inputId = campos[x];
            camposUrl+=campos[x]+'='+document.getElementById(inputId).value+"&"; 
        }
        novosValores = camposUrl.split("& ");
        for(x=0;x<novosValores.length;x++){
            resultado += novosValores[x]+"&";
        }
        urlFInal = url+""+resultado.substring(0, resultado.length -1);
        objAjax.open('GET', urlFInal,true);
        objAjax.send();
        objAjax.onreadystatechange = function(){
            if(objAjax.readyState == 4 && objAjax.status == 200){
                if(objAjax.responseText.indexOf('xdebug-error') > 0){
                    textoResultado = "J&atilde; existe um projecto com o nome que pretende criar";
                    corResultado = "red";
                }else{
                    textoResultado = "Requisi&ccedil;&atilde; executado com suceso";
                    corResultado = "green";
                }
            }
            
            callbackPlace.style.color = corResultado;
            callbackPlace.style.font = "bold 12px tahoma";
            callbackPlace.innerHTML = textoResultado;
        }
    };
    
    document.getElementById(id).appendChild(button);
    
}

function defineComponent(){
	
    var hora = document.getElementsByTagName('nakassonyTime');
    var grupo = document.getElementsByTagName('nakassonyGroup');
    var input = document.getElementsByTagName('nakassonyInput');
    var mes = document.getElementsByTagName('nakassonyMonth');
    var botao = document.getElementsByTagName('nakassonyActionButton');
    var buttonAjax = document.getElementsByTagName('nakassonyAjaxButton');
    
    if(buttonAjax.length > 0){
        for(x=0; x<buttonAjax.length; x++){
            ajaxButton(buttonAjax[x].id, buttonAjax[x].getAttribute('value'), buttonAjax[x].getAttribute('click'), buttonAjax[x].getAttribute('url'), buttonAjax[x].getAttribute('fields'), buttonAjax[x].getAttribute('resultOn'));
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




function populateDataTable(xhr, tabela){
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            valor = xhr.responseText.split('-%-');
            indiceRegisto++;
            qtdRegistos[indiceRegisto] = valor.length;
            
            if(qtdRegistos[indiceRegisto] != qtdRegistos[indiceRegisto-1]){
                
                tabelaDados = tabela.getElementsByTagName('tr');
                /*
                for(x=0; x<valor.length; x++){
                    idRegisto = valor.split('-&-');
                    registosARemover[idRegisto] = idRegisto;
                    alert(registosARemover[idRegisto]);
                }
                
                for(z=0;z<registosCarregados.length; z++){
                    if(!registosARemover[registosCarregados[z]]){
                        removeRegisto[indeice] = registosCarregados[z];
                        alert("Não tem este: "+registosCarregados[z]);
                    }
                }*/
            }
            
            
            for(x=0; x<valor.length; x++){
                var linhaRegisto = elementCreate('tr');
                var campo = valor[x].split('-&-');
                
                linhaRegisto.setAttribute('id', campo[0]);
                
                for(y=0; y<campo.length - 1; y++){
                    if(!registosCarregados[campo[y]]){
                        var coluna = elementCreate('td');
                        coluna.appendChild(document.createTextNode(campo[y]));
                        linhaRegisto.appendChild(coluna);
                        registosCarregados[campo[y]] = campo[0];
                        insereLinha = "sim";
                    }else
                        insereLinha = "nao";
                }
                //alert("Insere linha: "+insereLinha);
                if(insereLinha == "sim"){
                    tabela.appendChild(linhaRegisto);
                    insereLinha = "nao";
                }
            }
        }
    }
}