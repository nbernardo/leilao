/**
 * Dados Globais
 * @VariavelGlobal 
 *  1 - productModal -> Variavel global que vem do productRegistration.js (que cria a modal dos produtos seja para o admin ou para o vendedor)
 */

 
function callProductModal(){

    let productModal = productRegistration.productModal;
    let productContent = USER_PROFILE == 'ADMIN' ? 'productDataTableContainer' : 'produto_form';

    (new ProwebForm()).setModalFeature('productForm');
    //setModalFeature();
    productModal.setContent(document.getElementById(productContent).innerHTML);
    productModal.open();

    loadUiAdminView(USER_PROFILE)();
    loadProducts();

}

function loadUiAdminView(profile){
    let views = {
        "ADMIN" : uiAdminView,
        "VENDEDOR" : uiVendorView
    }
    return views[profile];
}


uiAdminView = function(){

    let listProdContainer = document.querySelectorAll(".tingle-modal-box__content")[1];
    let reProdBtn = document.getElementsByClassName("productForm")[0];

    reProdBtn.getElementsByTagName("button")[0].style.display = "none";
    reProdBtn.getElementsByTagName("button")[1].style.display = "none";
    listProdContainer.className = listProdContainer.className+" listProductToAdmin";
    setupAdminTab();

}

function handleAgendarButton(status){

    let productModal = productRegistration.productModal;
    
    if(status == "show"){
        productModal.addFooterBtn('Agendar', 'sendBtn leilaoRegButton', function() {
            registerLeilao();
        });
        //loadLeilaoDataTable vem de loadLeilaoDataTable.js
        leilaoRegistration.loadLeilaoDataTable();
    }

    if(status == "hide" || status == ""){
        let btn = document.querySelector(".leilaoRegButton");
        btn.parentNode.removeChild(btn);
        //loadLeilaoDataTable vem de loadLeilaoDataTable.js
        leilaoRegistration.unloadLeilaoDataTable();

    }
        


}

uiVendorView = function(){

    setupTab();
    addFooterDatatable();
    
    let prowebForm = new ProwebRequest();
    prowebForm.formRenderPlace = "prodCaracteristicas";
    prowebForm.loadFormTo("carro");

}


function addFooterDatatable(){
    
    var modalObj = document.querySelector(".productForm");
    if(!document.getElementById("listProductContainer")){
        modalFooter = modalObj.querySelector(".tingle-modal-box");
        modalFooter.appendChild(createProductTable());
    }

}


function setupAdminTab(){
    tabNav = new ProwebTab();
    tabNav.setTabsContainer("adminViews");
    tabNav.setButtonsContainer("adminNavigation");
}

/**
 * 
 * Busca, retorna e renderiza os produtos para o view seja para o admin ou para o vendedor 
 */
function loadProducts(){

    let method = USER_PROFILE == "ADMIN" ? "findAllProdutosToApprov" : "findAllProdutos";

    var getProductsRequest = new ProwebRequest();
    getProductsRequest.url = GATEWAY+"?controller=Produto&method="+method;
    getProductsRequest.debugResult = true;

    sendingForm = new ProwebForm();
    sendingForm.addProwebField("Produto.id");

    getProductsRequest.get(null,null,function(dt){
        generateTableRows(dt);
    });

}

function generateTableRows(dataString){

    let productTable = productRegistration.productTable;
    productTable.tableId = "productList";
    productTable.generateTableRows(dataString);

}
