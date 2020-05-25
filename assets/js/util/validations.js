/**
 * Validação (se vazio) de inputs com a class requiredInput
 */
function ValidationInputs(){

    this.numberOfErrors = 0;

    this.check = function(requiredInput){

        this.numberOfErrors = 0;
        inputs = document.querySelectorAll("."+requiredInput);
        
        for(field in inputs){
            if(curField = document.getElementById(inputs[field].id)){
                errorMessage = curField.parentNode.getElementsByTagName("div")[0];
                if(curField.value == ""){
                    curField.style.borderColor = "red";
                    this.displayError(errorMessage);
                    this.numberOfErrors++; 
                }else{
                    curField.style.borderColor = "black";
                    this.hideError(errorMessage);
                    if(curField.dataset.type == "number"){
                        this.numberOfErrors = parseInt(this.numberOfErrors) + checkNumber(curField);
                    }
                }
                    
                
            }
        }
        return this;
    }

    checkNumber = function(_input){
        let trueVal = 0;
        let falseVal = 1;
        let invalidMessage = curField.parentNode.querySelector(".invaliTypeError");
        if(/^[0-9]{0,}$/.test(_input.value) == false){
            _input.style.borderColor = "red";
              
            try{
                invalidMessage.style.display = "block";
            }catch(e){}
            return falseVal;

        }else{
            try{
                invalidMessage.style.display = "none";
            }catch(e){}
        }
        return trueVal;

    }


    this.displayError = function(errorContainer){
        try{
            errorContainer.style.display = "block"
        }catch(e){}
    }

    this.hideError = function(errorContainer){
        try{
            errorContainer.style.display = "none"
        }catch(e){}
    }


    return this;
  }

  