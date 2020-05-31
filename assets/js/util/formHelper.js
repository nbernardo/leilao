autoFields = {campos:{}};

function ProwebForm(){

    this.result = null;
    this.fieldList = {};
    this.allFields = null;
    existingForm = null;

    getForm = function(){
        if(existingForm == null)
            existingForm = new FormData();
        return existingForm;
    }

    this.addProwebField = function(name,value){
        let form = getForm();
        form.append("field["+name+"]",value);
        this.fieldList["field["+name+"]"] = value;
        this.result = form;
        return form;
    }


    getFields = function(_class){
        return document.querySelectorAll('.'+_class);
    }
    
    
    this.adicionaAllFields = function(_fields){
        sendingForm = getForm();
        this.allFields = getFields(_fields);
        for(_field of this.allFields){
            if(_field.name != undefined && _field.value != ""){
                this.fieldList[_field.id] = _field.value;
                sendingForm.append(_field.name,_field.value);
            }
        }
        this.result = sendingForm;
    }
    

    this.processAutoFields = function(backgendField){
        
        let sendingForm = getForm();
        let allFields = getFields("prowebAutoInput");

        if(allFields.length > 0){
            
            allFields.forEach(f => {
                autoFields.campos[f.id] = f.value;
            });

        }
        sendingForm.append(backgendField,JSON.stringify(autoFields));
        this.result = sendingForm;
    }


    this.clearAllFields = function(){
        
        for(_field of this.allFields){
            _field.value = "";
            _field.type = "text";
        }     
    }

    this.adicionaExtraFields = function(_fields){
        
        let allFields = getFields(_fields);
        for(_field of allFields){
            if(_field.name != undefined && _field.value != ""){
                this.fieldList[_field.id] = _field.value;
                if(_field.type == "file")
                    this.result.append(_field.name,_field.files[0],_field.files[0].name);
                else
                    this.result.append(_field.name,_field.value);
            }
        }
        return this.result;
    }


    this.prowebComboBox = function(formName,fieldName,placeHolder,tipo,requiredInput){
        return `
            <select 
                    data-type="${tipo}"
                    id="__autoField${fieldName}" 
                    class="${requiredInput} ${formName}Input prowebAutoInput leilaoStyle"
                    >
                <option value="">${placeHolder}</option>
            </select>
        `;
    }
    
    
    this.prowebInputText = function(formName,fieldName,placeHolder,tipo,requiredInput){
        return `
            <input 
                data-type="${tipo}"
                type="text"
                placeholder="${placeHolder}"
                class="${requiredInput} ${formName}Input prowebAutoInput"
                id="__autoField${fieldName}"
            />
        `;
    }
    
    this.uiComponent = function(){
        return {
                'text' : this.prowebInputText, 
                'combo' : this.prowebComboBox
        };
    }


    this.prowebField = function(formName,
                                {label,fieldName,placeHolder,errorMessage,tipo,requiredClass}
                                ){

        requiredInput = "";
        if(requiredClass != undefined && requiredClass != "")
            requiredInput = requiredClass; 
    
        if(errorMessage != ""){
            errorMessage = `<div class="validationErro">${errorMessage}</div>`;
            required = ""
        }

        let tipoComp = tipo || "text";
        
        return `    
                <div class="field-group">
                    <label>${label.replace(/\_/g," ")}</label>
                    <div class="inputContent">
                        ${this.uiComponent()[tipoComp](formName,fieldName,placeHolder,tipoComp,requiredInput)}
                        ${errorMessage}
                    </div>
                </div>
        `;
    
    }

    /**
     * Limpa todas as fields geradas acutomaticamente
     */
    this.clearAutoFields = function(){
        let fields = document.querySelectorAll('.prowebAutoInput');
        fields.forEach(f => {
            f.value = "";
        });
    }


    return this;

}


