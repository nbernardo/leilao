function ProwebTable(){

    this.tableId = null;

    this.generateTableRows = function(dataString = []){

        dataString = dataString.replace("<br>","");
        dataResult = JSON.parse(dataString);
        console.log(dataString);
        
        let tableRows = "";

        dataResult.forEach(a => {
            tableRows += generateProductRow(a);
        });

        document.getElementById(this.tableId).innerHTML = tableRows;
    
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
        let descricao = "";//curObject.descricao;
        //let obj = eval(JSON.stringify(rowData)); 

        return `
            <tr align="center" class="dataRow">
                <td>
                    <div>X</div>
                    <div>
                        <a href="#" 
                           id="viewProdLink${id}"
                           onclick="editarProduto('${nome}','${preco}','${descricao}','${id}','${categoria}')">Modificar</a>
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
                        <div>X</div>
                        <div>
                            <a 
                                href="#"
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