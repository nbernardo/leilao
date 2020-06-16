var productController = {editingStatus:false};
const leilaoInput = "leilaoInput";


function addLeilaoFooterDatatable(){
    
    var modalObj = document.querySelector(".productForm");
    if(!document.getElementById("listLeilaoContainer")){
        modalFooter = modalObj.querySelector(".tingle-modal-box");
        modalFooter.appendChild(createLeilaoTable());
    }else
        document.getElementById('leilaoDataTable').style.display = "";

}

function createLeilaoTable(){
    
    tableCont = document.querySelector("#leilaoDataTableContainer").innerHTML;
    newTableContainer = document.createElement("div");
    newTableContainer.id = "listLeilaoContainer";
    newTableContainer.innerHTML = tableCont;

    return newTableContainer;

}


leilaoRegistration = {
    loadLeilaoDataTable: function(){
        console.log("Carregou a table");
        addLeilaoFooterDatatable();
    },
    unloadLeilaoDataTable: function(){
        console.log("Eliminou a table");
        document.getElementById('leilaoDataTable').style.display = "none";
    },
    productInsance: "" /*new tingle.modal(modalProductFeatures)*/,
}



function registerLeilao(){


    let formValidation = new ValidationInputs();
    if(formValidation.check(leilaoInput).numberOfErrors > 0){
        return;
    }

    leilaoCreateForm = new ProwebForm();

    leilaoCreateForm.adicionaAllFields(leilaoInput);
    
    let request = new ProwebRequest();
    request.url = GATEWAY+"?controller=Leilao&method=save";
    request.debugResult = true;
    request.requestLoading("leilaoFormModal");
    request.post(null,leilaoCreateForm.result,onLeilaoRegisterSuccess);

}

function onLeilaoRegisterSuccess(result){
    //alert(result);
    
    
    //resultado = JSON.parse(result);
    //if(resultado.success != undefined){
    //    (new ProwebForm()).clearAutoFields();
    //    try{
    //        firstImage = getFirstAndclearSavedImages();
    //        resultado.lastData["mainImage"] = firstImage;            
    //    }catch(e){}

    //    let row = productTable.createProductRow(resultado.lastData);
    //    productTable.addRow(row);
        leilaoCreateForm.clearAllFields();
    //    l('#documentList').innerHTML = "";
    //}
    
}



