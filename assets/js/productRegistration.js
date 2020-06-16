var productController = {editingStatus:false};
const prodValidateInput = "produtoInput";

modalProductFeatures = {
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
        productRegistration.productModal.setContent("");
    },
    beforeClose: function() {
        return true; // close the modal
    }
};


productRegistration = {
    productModal: new tingle.modal(modalProductFeatures),
    productTable: new ProwebTable(),
}

function addEditButton(){

    let productModal = productRegistration.productModal;

    if(productController.editingStatus == false){

        productModal.addFooterBtn('Actualizar', 'sendBtn productUpButton', function() {
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

    let productModal = productRegistration.productModal;
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
    if(formValidation.check(prodValidateInput).numberOfErrors > 0){
        return;
    }

    prodCreateForm = new ProwebForm();

    prodCreateForm.adicionaAllFields('produtoInput');
    prodCreateForm.adicionaExtraFields('imageInput');
    prodCreateForm.adicionaExtraFields('docInput');
    prodCreateForm.processAutoFields("field[ProdutoAtributo.valor]");
    
    //console.log(prodCreateForm.fieldList);
    
    let request = new ProwebRequest();
    request.url = GATEWAY+"?controller=Produto&method=save";
    request.debugResult = true;
    request.requestLoading("productFormModal");
    request.post(null,prodCreateForm.result,onRegisterSuccess);

}

function onRegisterSuccess(result){
    //alert(result);
    
    resultado = JSON.parse(result);
    if(resultado.success != undefined){
        (new ProwebForm()).clearAutoFields();
        try{
            firstImage = getFirstAndclearSavedImages();
            resultado.lastData["mainImage"] = firstImage;            
        }catch(e){}

        let row = productRegistration.productTable.createProductRow(resultado.lastData);
        productRegistration.productTable.addRow(row);
        prodCreateForm.clearAllFields();
        l('#documentList').innerHTML = "";

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

docInputIndex = 0;
function selectProductDocs(){
    createDocInput(++docInputIndex);
}

function createDocInput(index){

    let fileIndex = index;
    let docInput = document.createElement("input");
    docInput.id = "docInput"+fileIndex;
    docInput.type = "file";
    docInput.style.display = "none";
    docInput.name = "docInput[]";

    docInput.setAttribute("class","docInput");

    document.querySelector("#novSection").appendChild(docInput);
    
    docInput.onchange = function(){
        addDocFile(docInput, fileIndex);
    } 
    
    docInput.click();

}

function addDocFile(_input, index){
    
    let inputDocProduct = _input;
    let listFiles = "";
    let files = inputDocProduct.files;

    for(file in files){

        if(/^application\/pdf/.test(files[file].type)){

            let row = document.createElement("tr");
            row.className = "productTableImageHead";

            row.innerHTML = `
                    <td style="font-weight:initial;"><a href="#" onclick="alert('${index}')">X</a></td>
                    <td style="font-weight:initial;">${files[file].name}</td>
                    <td style="font-weight:initial;">${files[file].size} Kb</td>
            `;
            l('#documentList').appendChild(row);
        }

    }

}


function removeCloseButton(){
    document.querySelector(".tingle-modal__close").style.display = "none";
}

function getFirstAndclearSavedImages(){
    
    let firstImage;

    try{
        firstImage = document.querySelector(".imageInput").value;
    }catch(e){}
    
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
    
    tableCont = document.querySelector("#leilaoDataTableContainer").innerHTML;
    newTableContainer = document.createElement("div");
    newTableContainer.id = "listProductContainer";
    newTableContainer.innerHTML = tableCont;

    return newTableContainer;

}


function ProdutoController(){

    this.editingStatus = false;
    this.designacao = document.querySelector("#produtoNome");
    this.preco = document.querySelector("#produtoPreco");
    this.categoria = document.querySelector("#produtoCategoria");
    this.descricao = document.querySelector("#produtoDescricao");


    this.editar = function(produto){

        //console.log("Cat : "+JSON.stringify(produto));

        this.editingStatus = true;
        this.designacao.value = produto.nome;
        this.preco.value = produto.preco.replace(/,/g,"").replace(/\./g,"");
        this.descricao.value = produto.descricao; 
        this.idProduct = produto.id;
        this.categoria.value = produto.categoria;
        (new ProwebForm()).clearAutoFields();
        findAllData(produto.id);

    }

    loadAutoField = function(autoData){
        console.log(autoData);
        try{
            let fields = JSON.parse(autoData[0].valor.replace(/&quot;/g,"\""));
            
            for(c in fields.campos){
                try{
                    l('#'+c).value = fields.campos[c];
                }catch(e){}
                
            }
        }catch(e){}
        
    }

    addImages = function(imagens,idProduct){

        if(imagens != undefined || imagens != ""){
            imagens.forEach((i,x) => {

                let imagem = {"result" :  APP_ROOT_DIR+"assets/product_image/"+i.imagem};
                let file = {"type": "image", "name": "Imagem produto", "idProduto": idProduct};
                createAndAddImage(file,x,imagem);
            });
        }

    }

    findAllData = function(idProduct){

        let prodCreateForm = new ProwebForm();
        prodCreateForm.addProwebField('ProdutosImagem.fk_produto',idProduct);
        prodCreateForm.addProwebField('ProdutoAtributo.fk_produto',idProduct);
        
        let request = new ProwebRequest();
        request.url = GATEWAY+"?controller=Produto&method=findImagens";
        request.debugResult = true;
        request.requestLoading("productFormModal");
        request.post(null,prodCreateForm.result,function(r){
            
            let resultado = JSON.parse(r);

            addImages(resultado.imagens,idProduct);
            loadAutoField(resultado.atributo);
            loadDocs(resultado.docs);
            

            //alert(r); 
        });
    }


    loadDocs = function(docs){

        l('#documentList').innerHTML = "";

        for(doc in docs){
            console.log(docs[doc]);
            let row = document.createElement("tr");
            row.className = "productTableImageHead";
            row.id = "docLine"+docs[doc].id;

            row.innerHTML = `
                    <td style="font-weight:initial;"><a href="#" onclick="alert('${docs[doc].id}')">X</a></td>
                    <td style="font-weight:initial;"><a href="${APP_ROOT_DIR}/assets/product_doc/${docs[doc].nome}" download>${docs[doc].nome}</a></td>
                    <td style="font-weight:initial;"><!--  Kb --></td>
            `;
            l('#documentList').appendChild(row);
        }

    }


    this.actualizar = function(){
        
        let formValidation = new ValidationInputs();
        if(formValidation.check(prodValidateInput).numberOfErrors > 0){
            return;
        }
    
        prodCreateForm = new ProwebForm();
        prodCreateForm.adicionaAllFields('produtoInput');
        prodCreateForm.adicionaExtraFields('imageInput');
        prodCreateForm.addProwebField('Produto.id',this.idProduct);
        prodCreateForm.processAutoFields("field[ProdutoAtributo.valor]");
        
        let request = new ProwebRequest();
        request.url = GATEWAY+"?controller=Produto&method=update";
        request.debugResult = true;
        request.requestLoading("productFormModal");
        request.post(null,prodCreateForm.result,(result) => {
            
            if(result = JSON.parse(result)){
                
                productController.editingStatus = false;
                addDefaultButtons();

                prodCreateForm.clearAllFields();
                prodCreateForm.clearAutoFields();
                getFirstAndclearSavedImages();
                this.updateViewProduct(prodCreateForm.fieldList,result.preco);        
            }
        });
    }

    this.updateViewProduct = function(form,preco){
        //l("#viewProdImagem"+this.idProduct).value = "";
        l("#viewProdNome"+this.idProduct).innerHTML = form.produtoNome;
        l("#viewProdPreco"+this.idProduct).innerHTML = preco;
        let prodId = this.idProduct;
        l("#viewProdLink"+this.idProduct).onclick = function(){
            
            editarProduto(form.produtoNome,
                          form.produtoPreco,
                          form.produtoDescricao,
                          prodId,
                          form.produtoCategoria);
        }
    }
    

    return this;

}

function editarProduto(nome,preco,descricao,id,categoria){

    console.log("Resgatando: ",descricao);
    let obj = {
        nome: nome,
        preco: preco,
        descricao: document.getElementById("viewProdLink"+id).dataset.descricao,
        id : id,
        categoria : categoria
    }
    document.getElementById("imagensProduto").innerHTML = "";    
    addEditButton();

    productController = new ProdutoController();
    productController.editar(obj);
}

function actualizar(){
    if(productController.actualizar()){

    }
}
//productNavigation


function approvProduct(id){

    let request = new ProwebRequest();
    request.url = GATEWAY+"?controller=Produto&method=approve&field[Produto.id]="+id;
    request.debugResult = true;
    request.requestLoading("productFormModal");
    request.post(null,null,function(r){
        
        let result = JSON.parse(r);
        if(result.success == true){
            request.requestClearLoading();
            document.getElementById('approvingProduct'+id).style.display = "none";
        }

    });
    

}