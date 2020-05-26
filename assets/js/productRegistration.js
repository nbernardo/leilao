var productTable = null; //Data table dos produtos
var productController = {editingStatus:false};

modalFeatures = {
    footer: true,
    stickyFooter: false,
    closeMethods: [],
    
    cssClass: ['productForm'],
    onOpen: function() {
        //removeCloseButton();
        addDefaultButtons();
    },
    onClose: function() {
        removeDefaultButtons();
        productModal.setContent("");
    },
    beforeClose: function() {
        return true; // close the modal
    }
};

var productModal = new tingle.modal(modalFeatures);

function addEditButton(){

    if(productController.editingStatus == false){

        productModal.addFooterBtn('Actualizar', 'sendBtn productUpButton', function() {
            //alert("Actualizando");
            actualizar();
        });
    
        productModal.addFooterBtn('Cancelar', 'cancelBtn prodCancUpButton', function() {
            productController.editingStatus = false;
            productModal.close();
        });
        removeDefaultButtons();

    }

}

function addDefaultButtons(){

    productModal.addFooterBtn('Cadastrar', 'sendBtn productRegButton', function() {
        registerProduct();
    });
    
    productModal.addFooterBtn('Fechar', 'cancelBtn productRegBtn', function() {
        productController.editingStatus = false;
        productModal.close();
    });
    removeEditButton();
}

function removeDefaultButtons(){

    try{
        document.querySelector(".productRegButton").setAttribute("class","hideButton");
        document.querySelector(".productRegButton").setAttribute("class","hideButton");    
    }catch(e){}
    
    try{
        document.querySelector(".productRegBtn").setAttribute("class","hideButton");
        document.querySelector(".productRegBtn").setAttribute("class","hideButton");
    }catch(e){}

}

function removeEditButton(){
    try{
        document.querySelector(".prodCancUpButton").setAttribute("class","hideButton");
        document.querySelector(".prodCancUpButton").setAttribute("class","hideButton");    
    }catch(e){}
    try{
        document.querySelector(".productUpButton").setAttribute("class","hideButton");
        document.querySelector(".productUpButton").setAttribute("class","hideButton");    
    }catch(e){}
}

function registerProduct(){

    let formValidation = new ValidationInputs();
    if(formValidation.check('produtoInput').numberOfErrors > 0){
        return;
    }


    prodCreateForm = new ProwebForm();
    prodCreateForm.adicionaAllFields('produtoInput');
    prodCreateForm.adicionaExtraFields('imageInput');
    //console.log(prodCreateForm.fieldList);
    
    let request = new ProwebRequest();
    request.url = GATEWAY+"?controller=Produto&method=save";
    request.debugResult = true;
    request.requestLoading("productFormModal");
    request.post(null,prodCreateForm.result,onRegisterSuccess);

}


function generateTableRows(dataString){

    productTable = new ProwebTable();
    productTable.tableId = "productList";
    productTable.generateTableRows(dataString);

}

function onRegisterSuccess(result){
    
    //alert(result);

    resultado = JSON.parse(result);
    if(resultado.success != undefined){
        console.log("Retorno: ",resultado.lastData);
        try{
            firstImage = getFirstAndclearSavedImages();
            resultado.lastData["mainImage"] = firstImage;            
        }catch(e){}

        let row = productTable.createProductRow(resultado.lastData);
        productTable.addRow(row);
        prodCreateForm.clearAllFields();

    }
}


function callProductModal(){

    setModalFeature();
    productModal.setContent(document.getElementById('produto_form').innerHTML);
    setupTab();
    productModal.open();

    addFooterDatatable();
    loadProducts();

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

function reverseImagesOrder(imagesArray){
    images = [];
    for(image of imagesArray){
        images.push(image);
    }
    return images.reverse();
}

function renderAllImages(){

    imgs = reverseImagesOrder(inputImagemProduct.files);    

    if(imgs.length > 0 && productController.editingStatus == false){
        document.getElementById("imagensProduto").innerHTML = "";
    }

    for(x = 0; x < imgs.length; x++){
        
        var reader = new FileReader();
        file = imgs[x];
        let index = x;

        reader.onloadend = (function(file,index,reader){
                
            return function(){
                createAndAddImage(file,index,reader);
            }
                
        })(file,index,reader);
        reader.readAsDataURL(file);
        
    }

}

function createImageInput(index,value,){

    let imageInput = document.createElement("input");
    imageInput.id = "imageInput"+index;
    imageInput.type = "hidden";
    imageInput.name = "imageInput[]";

    imageInput.value = value;
    imageInput.setAttribute("class","imageInput");

    return imageInput;

}



function createFirstImageInput(index){

    let firstInputContainer = document.createElement("div");
    let firstInput = document.createElement("input");
    firstInput.type = "radio";
    firstInput.value = index;
    firstInputContainer.className = "firstImageInput";
    firstInputContainer.appendChild(firstInput);
    firstInputContainer.appendChild(document.createTextNode(" Imagem Principal"));

    firstInput.onclick = function(){
        let imageInputs = document.querySelectorAll(".firstImageInput");
        imageInputs.forEach((ii) => {
            if(ii.value != this.value)
                ii.checked = false;
        });
        //alert();
    }

    return firstInputContainer;
}

function createAndAddImage(file,index,reader){
    
    var image = new Image();
    var button = document.createElement("button");
    let _div = document.createElement("div");
    
    button.type = "button";
    button.innerHTML = "Excluir";
    button.setAttribute("class","btnExcluir");
    button.onclick = function(){
        handleRemovedImage(index);
    }

    image.title = file.name;
    image.src = /^image/.test(file.type) ? reader.result : "";
    
    if(file.idProduto == undefined){
        var imageInput = createImageInput(index,image.src);
        _div.appendChild(imageInput);
    }
    
    let firstInputContainer = createFirstImageInput(index);
    
    image.setAttribute("class","itemProductImage");
    
    let imageContainer = document.createElement("div");
    imageContainer.setAttribute("class","imageContainer");

    _div.id = "divAddedImagem"+index;
    imageContainer.appendChild(firstInputContainer);
    imageContainer.appendChild(image);
    imageContainer.appendChild(button);
    _div.appendChild(imageContainer);
    document.getElementById("imagensProduto").appendChild(_div);

}

function handleRemovedImage(index){
    document.getElementById("divAddedImagem"+index).style.display = "none";
    document.getElementById("imageInput"+index).name = "";
    document.getElementById("imageInput"+index).value = "";    
}

function generateImage(_file){

    reader = new FileReader();
    reader.onload = function(){
        //console.log(reader.result);
        let actualImage = reader.result;
        let img = document.createElement("img");
        img.src = actualImage;
        img.width = "100";
        document.getElementById("imagensProduto").appendChild(img);
        //document.getElementById("User.imagemPerfil").value = actualImage;
    }
    reader.readAsDataURL(_file);

}

function selectProductFile(){

    inputImagemProduct = document.getElementById('inputImagemProduct');
    inputImagemProduct.click();

    inputImagemProduct.onchange = function(){
        renderAllImages();
    }
}



function setModalFeature(){

    var modalObj = document.querySelector(".productForm");
    var modalWindow = modalObj.getElementsByClassName("tingle-modal-box")
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

function getFirstAndclearSavedImages(){
    let firstImage = document.querySelector(".imageInput").value;
    var removeBtns = document.querySelectorAll(".btnExcluir");
    for(btn of removeBtns){
        btn.click();
    }
    return firstImage;
}

function setupTab(){
    tabNav = new ProwebTab();
    tabNav.setTabsContainer("formProduto");
    tabNav.setButtonsContainer("productNavigation");
}

function createProductTable(){
    
    tableCont = document.querySelector("#productDataTableContainer").innerHTML;
    newTableContainer = document.createElement("div");
    newTableContainer.id = "listProductContainer";
    newTableContainer.innerHTML = tableCont;

    return newTableContainer;

}

function loadProducts(data){

    var getProductsRequest = new ProwebRequest();
    getProductsRequest.url = GATEWAY+"?controller=Produto&method=findAllProdutos";
    getProductsRequest.debugResult = true;

    sendingForm = new ProwebForm();
    sendingForm.addProwebField("Produto.id");

    getProductsRequest.get(null,null,function(dt){
        generateTableRows(dt);
    });

}



function ProdutoController(){

    this.editingStatus = false;
    this.designacao = document.querySelector("#produtoNome");
    this.preco = document.querySelector("#produtoPreco");
    this.categoria = document.querySelector("#produtoCategoria");
    this.descricao = document.querySelector("#produtoDescricao");


    this.editar = function(produto){

        console.log("Cat : "+JSON.stringify(produto));

        this.editingStatus = true;
        this.designacao.value = produto.nome;
        this.preco.value = produto.preco.replace(/,/g,"").replace(/\./g,"");
        this.descricao.value = "";//produto.descricao; 
        this.idProduct = produto.id;
        this.categoria.value = produto.categoria;
        aditingImages(produto.id);

    }

    aditingImages = function(idProduct){

        let prodCreateForm = new ProwebForm();
        prodCreateForm.addProwebField('ProdutosImagem.fk_produto',idProduct);
        
        let request = new ProwebRequest();
        request.url = GATEWAY+"?controller=Produto&method=findImagens";
        request.debugResult = true;
        request.requestLoading("productFormModal");
        request.post(null,prodCreateForm.result,function(r){

            let resultado = JSON.parse(r);
            if(resultado.dados != undefined){
                resultado.dados.forEach((i,x) => {

                    let imagem = {"result" :  APP_ROOT_DIR+"assets/product_image/"+i.imagem};
                    let file = {"type": "image", "name": "Imagem produto", "idProduto": idProduct};

                    createAndAddImage(file,x,imagem);

                });
            } 
        });
    }


    this.actualizar = function(){
        updateResult = {success: false};
        let formValidation = new ValidationInputs();
        if(formValidation.check('produtoInput').numberOfErrors > 0){
            return;
        }
    
        let setResult = function(r){ updateResult = r; }

        prodCreateForm = new ProwebForm();
        prodCreateForm.adicionaAllFields('produtoInput');
        prodCreateForm.adicionaExtraFields('imageInput');
        prodCreateForm.addProwebField('Produto.id',this.idProduct);
        
        let request = new ProwebRequest();
        request.url = GATEWAY+"?controller=Produto&method=update";
        request.debugResult = true;
        request.requestLoading("productFormModal");
        request.post(null,prodCreateForm.result,(result) => {
            
            if(result = JSON.parse(result)){
                
                productController.editingStatus = false;
                addDefaultButtons();

                prodCreateForm.clearAllFields();
                this.updateViewProduct(prodCreateForm.fieldList,result.preco);        
            }
        });
        return updateResult;
    }

    this.updateViewProduct = function(form,preco){
        //l("#viewProdImagem"+this.idProduct).value = "";
        l("#viewProdNome"+this.idProduct).innerHTML = form.produtoNome;
        l("#viewProdPreco"+this.idProduct).innerHTML = preco;
        let prodId = this.idProduct;
        l("#viewProdLink"+this.idProduct).onclick = function(){
            editarProduto(form.produtoNome,form.produtoPreco,form.produtoDescricao,prodId,form.produtoCategoria);
        }
    }

    return this;

}

function editarProduto(nome,preco,descricao,id,categoria){
    let obj = {
        nome: nome,
        preco: preco,
        descricao: descricao,
        id : id,
        categoria : categoria
    }
    document.getElementById("imagensProduto").innerHTML = "";    
    //removeDefaultButtons();
    addEditButton();

    //console.log(cur);
    productController = new ProdutoController();
    productController.editar(obj);
}

function actualizar(){
    if(productController.actualizar().success){

    }
}
//productNavigation