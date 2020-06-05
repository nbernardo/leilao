function ProwebTable(){

    this.tableId = null;

    this.generateTableRows = function(dataString = []){

        dataString = dataString.replace("<br>","");
        dataResult = JSON.parse(dataString);

        let tableRows = "";

        dataResult.forEach(a => {

            let curObject = a;
            let id = a.id;
            let nome = a.nome;
            let preco = a.preco.substr(0,curObject.preco.length - 2);
            let categoria = a.fk_categoria;
            let descricao = `${a.descricao}`;
            let imagem = a.imagem;
            let statusDesc = a.status == 1 ? "<span class='approvedProd'>Aprovado</span>" : "<span class='pendingProd'>Pendente</span>";
            console.log(descricao);
            tableRows += generateProductRow1(id,nome,preco,categoria,descricao,imagem,a.status,statusDesc);
        });

        document.getElementById(this.tableId).innerHTML = tableRows;
    
    }

    generateProductRow1 = function(id,nome,preco,categoria,descricao,imagem,status,statusDesc){
        
        let editLink = `    
        <a href="#"
            data-descricao="${descricao}" 
            id="viewProdLink${id}"
            onclick="editarProduto('${nome}','${preco}','${descricao}','${id}','${categoria}')"
            >
            Modificar
        </a>
        `;

        let approvLink = `Aprovar<br/><input type="checkbox" value="${id}" onclick="approvProduct('${id}')"/>`;

        showLink = USER_PROFILE == "ADMIN" ? approvLink : editLink;

        return `
            <tr align="center" id="approvingProduct${id}" class="dataRow">
                <td>
                    <div></div>
                    <div>
                        ${showLink}
                    </div>
                </td>
                <td>
                    <img 
                        id="viewProdImagem${id}"
                        class="productTableImage" 
                        src="${APP_ROOT_DIR}assets/product_image/${imagem}"
                    >
                </td>
                <td id="viewProdNome${id}">${nome}</td>
                <td id="viewStatus${id}">${statusDesc}</td>
                <td id="viewProdPreco${id}">${preco} AKZ</td>
            </tr>
        `;
    }

    this.generateCatTableRows = function(dataString = []){

        dataString = dataString.replace("<br>","");
        dataResult = JSON.parse(dataString).dados;
                
        let tableRows = "";

        dataResult.forEach(a => {
            tableRows += generateCatRow(a);
        });

        document.getElementById(this.tableId).innerHTML = tableRows;
    
    }

    generateProductRow = function(rowData){
        
        let curObject = rowData;
        let id = curObject.id;
        let nome = curObject.nome;
        let preco = curObject.preco.substr(0,curObject.preco.length - 2);
        let categoria = curObject.fk_categoria;
        let descricao = curObject.descricao;
        //let obj = eval(JSON.stringify(rowData)); 

        let editLink = `    
            <a href="#"
                data-descricao="${descricao}" 
                id="viewProdLink${id}"
                onclick="editarProduto('${nome}','${preco}','${descricao}','${id}','${categoria}')"
                >
                Modificar
            </a>
        `;

        let approvLink = `Aprovar<br/><input type="checkbox" value="${id}"/>`;

        showLink = USER_PROFILE == "ADMIN" ? approvLink : editLink;

        return `
            <tr align="center" class="dataRow">
                <td>
                    <div></div>
                    <div>
                        ${approvLink}
                    </div>
                </td>
                <td>
                    <img 
                        id="viewProdImagem${id}"
                        class="productTableImage" 
                        src="${APP_ROOT_DIR}assets/product_image/${rowData.imagem}"
                    >
                </td>
                <td id="viewProdNome${id}">${rowData.nome}</td>
                <td id="viewProdPreco${id}">${rowData.preco} AKZ</td>
            </tr>
        `;
    }

    generateCatRow = function(rowData){
        return `
            <tr align="center" class="dataRow">
                <td>X</td>
                <td>${rowData.id}</td>
                <td>${rowData.nome}</td>
            </tr>
        `;
    }

    this.createProductRow = function(rowData){
        //console.log(rowData);
        let row = document.createElement("tr");
        let imagem = '<img <img class="productTableImage" alt="Sem imagem">';
        row.setAttribute("class","dataRow");
        if(rowData.mainImage != undefined)
            imagem = `<img class="productTableImage" src="${rowData.mainImage}">`;

        row.innerHTML = `
                    <td>
                        <div></div>
                        <div>
                            <a 
                                href="#"
                                data-descricao="${rowData.descricao}"
                                id="viewProdLink${rowData.id}"
                                onclick="editarProduto('${rowData.nome}','${rowData.preco}','${rowData.descricao}','${rowData.id}','${rowData.fk_categoria}')"
                            >Modificar</a>
                        </div>
                    </td>
                    <td>${imagem}</td>
                    <td>${rowData.nome}</td>
                    <td>${rowData.preco} AKZ</td>
        `;
        return row;
    }

    this.createCategoriaRow = function(rowData){
        let row = document.createElement("tr");
        row.setAttribute("class","dataRow");
        row.innerHTML = `
                    <td>
                        X
                        <a href="#">Modificar</a>
                    </td>
                    <td>${rowData.id}</td>
                    <td>${rowData.nome}</td>
        `;
        return row;
    }



    this.addRow = function(row){
        document.getElementById(this.tableId).appendChild(row);
    }


}