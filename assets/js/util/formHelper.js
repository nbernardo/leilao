

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

    this.clearAllFields = function(){
        
        for(_field of this.allFields){
            console.log("Limpar campo: ",_field.id);
            _field.value = "";
        }     
    }

    this.adicionaExtraFields = function(_fields){
        
        let allFields = getFields(_fields);
        for(_field of allFields){
            if(_field.name != undefined && _field.value != ""){
                this.fieldList[_field.id] = _field.value;
                this.result.append(_field.name,_field.value);
            }
        }
        return this.result;
    }
    return this;

}


