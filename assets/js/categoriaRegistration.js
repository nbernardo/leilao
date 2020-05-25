modalFeatures = {
    footer: true,
    stickyFooter: false,
    closeMethods: [],
    
    cssClass: ['prodCategoria'],
    onOpen: function() {
        //removeCloseButton();
    },
    onClose: function() {
        catModal.setContent("");
    },
    beforeClose: function() {
        return true; // close the modal
    }
};

var catModal = new tingle.modal(modalFeatures);
catModal.addFooterBtn('Cadastrar', 'sendBtn productRegButton', function() {

    registerCategoria();

});

function registerCategoria(){

    let formValidation = new ValidationInputs();
    if(formValidation.check('categoriaInput').numberOfErrors > 0){
        return;
    }


    catCreateForm = new ProwebForm();
    catCreateForm.adicionaAllFields('categoriaInput');
    console.log(catCreateForm.fieldList);
    
    let request = new ProwebRequest();
    request.url = GATEWAY+"?controller=Produto&method=saveCategoria";
    request.debugResult = true;
    request.requestLoading("categoruaFormModal");
    request.post(null,catCreateForm.result,onCatRegisterSuccess);

}

categoriaTable = null;

function generateCatTableRows(dataString){

    categoriaTable = new ProwebTable();
    categoriaTable.tableId = "categoriaList";
    categoriaTable.generateCatTableRows(dataString);

}

function onCatRegisterSuccess(result){
    
    resultado = JSON.parse(result);
    if(resultado.success != undefined){

        let row = categoriaTable.createCategoriaRow(resultado.dados[0]);
        categoriaTable.addRow(row);
        catCreateForm.clearAllFields();

    }
    
}


catModal.addFooterBtn('Fechar', 'cancelBtn', function() {
    catModal.close();
});

function callCategoriaModal(){

    setCatModalFeature();
    catModal.setContent(document.getElementById('formCategoriaContainer').innerHTML);
    
    catModal.open();

    addCatFooterDatatable();
    loadCatProducts();

}

function addCatFooterDatatable(){

    var modalObj = document.querySelector(".prodCategoria");
    if(!document.getElementById("listCategoriaContainer")){
        modalFooter = modalObj.querySelector(".tingle-modal-box");
        modalFooter.appendChild(createCategoriaTable());
    }

}


function setCatModalFeature(){

    var modalObj = document.querySelector(".prodCategoria");
    var modalWindow = modalObj.getElementsByClassName("tingle-modal-box");
    modalWindow[0].style.position = "absolute";
    modalWindow[0].style.top = "0";
    modalWindow[0].style.left = "0";
    modalWindow[0].style.height = "100%";
    modalWindow[0].style.width = "35%";
    modalWindow[0].style.borderRadius = "0px";

}

function removeCloseButton(){
    document.querySelector(".tingle-modal__close").style.display = "none";
}



function createCategoriaTable(){
    
    tableCont = document.querySelector("#catDataTableContainer").innerHTML;
    let newTableContainer = document.createElement("div");
    newTableContainer.id = "listCategoriaContainer";
    newTableContainer.innerHTML = tableCont;

    return newTableContainer;

}

function loadCatProducts(data){

    var getProductsRequest = new ProwebRequest();
    getProductsRequest.url = GATEWAY+"?controller=Produto&method=findCetegorias";
    getProductsRequest.debugResult = true;

    sendingForm = new ProwebForm();
    sendingForm.addProwebField("Produto.id");

    getProductsRequest.get(null,null,function(dt){
        generateCatTableRows(dt);
    });

}
