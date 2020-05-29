/**
 * Author: Nakassony Venâncio Bernardo
 */
function ProwebRequest(){

    this.url = null;
    this.debugResult = false;
    modal = null;
    this.formRenderPlace = null;

    this.post = function(url, sendingForm, callBack){
        
        let xhr = new XMLHttpRequest()
        let finalURL = this.url || url;
        xhr.open('POST',finalURL,true);
        xhr.send(sendingForm || "");

        xhr.onload = function(){
            
            if(xhr.status == 404)
                alert("Erro: url \""+finalURL+"\" não encontrada");

            if(xhr.status == 500){
                alert("Erro: existe um erro interno no backend da aplicação, checa a consola do browser");
                console.log(xhr.responseText);
            }

            if(callBack != undefined && xhr.status != 404 && xhr.status != 500)
                callBack(xhr.responseText);
              
            localRequestClearLoading();

        }

        xhr.onerror = function(){
            alert("!!!Houve erro");
        }

    }


    this.get = function(url, sendingForm, callBack){
        
        let xhr = new XMLHttpRequest()
        let finalURL = this.url || url;
        xhr.open('GET',finalURL,true);
        xhr.send(sendingForm || "");

        xhr.onload = function(){
            
            if(xhr.status == 404)
                alert("Erro: url \""+finalURL+"\" não encontrada");

            if(xhr.status == 500){
                alert("Erro: existe um erro interno no backend da aplicação, checa a consola do browser");
                console.log(xhr.responseText);
            }

            if(callBack != undefined && xhr.status != 404 && xhr.status != 500)
                callBack(xhr.responseText);
              
            localRequestClearLoading();

        }

        xhr.onerror = function(){
            alert("!!!Houve erro");
        }

    }

    localRequestClearLoading = function(){
        if(modal != null){
            modal.style.display = "none";
            modal.innerHTML = "";
        }
    }

    this.requestLoading = function(modalId){
        console.log("Online 4");
        modal = document.querySelector("."+modalId);
        modal.style.display = "flex";
        modal.innerHTML = '<div class="loader"></div>';
    }

    this.requestClearLoading = function(){
        if(modal != null)
            modal.innerHTML = "";
    }


    this.loadFormTo = function(formName,place){

        let xhr = new XMLHttpRequest()
        let finalURL =  APP_ROOT_DIR+"assets/"+formName+".json";
        xhr.open('GET',finalURL,true);
        xhr.send();
        let formResult = "";
        let _prowebForm = new ProwebForm();
        let formRenderPlace = this.formRenderPlace;

        xhr.onload = function(){

            let fieldResult = JSON.parse(xhr.responseText).campos;

            for(p in fieldResult){
                
                let c = fieldResult[p];
                placeHolder = c.dica || "Digite um valor";
                errorMessage = c.erroVazio || "";
                campo = {
                    label:p,
                    fieldName:p,
                    placeHolder:placeHolder,
                    errorMessage:errorMessage,
                    tipo:c.tipo,
                    requiredClass:c.requiredClass,
                };                
                formResult += _prowebForm.prowebField(formName,campo);

            }

            l("#"+formRenderPlace).innerHTML = formResult;

        }

    }

    return this;

}
