 <?php

(function () {

   $ciclo = $_REQUEST['ciclo'] + 1;

   print '<div id="outrapic'.$ciclo.'"><div style="display:flex; justify-content: left;" >
    <div class="col-md-2">';

   print '<div style="width:100px; height: 100px">
                <img src="/e-commerce/assets/images/default.jpg" id="imagePrincipal'.$ciclo.'" style="width: 100%; height:100%; border: 1px solid silver">
          </div>';
  print '</div>';

  print '<div class="col-md-2">
          <div>
              <label >Cor</label>
              <input type="color" name="colorPrincipal'.$ciclo.'" id="colorPrincipal'.$ciclo.'">
          </div>
      </div>';

    print '<div class="col-md-2">
          <div>
              <label >Tamanho</label>
              <input size="4" type="text" name="tamanhoPrincipal'.$ciclo.'" id="tamanhoPrincipal'.$ciclo.'">
          </div>
      </div> ';

  print '<div class="col-md-2">
          <div>
              <label >Qtd</label>
              <input style="width:50px" type="number" name="qtdPrincipal'.$ciclo.'" id="qtdPrincipal'.$ciclo.'">
          </div>
      </div>';

    print '<div class="col-md-2">
          <input name="field[produtos.outraimagem'.$ciclo.']" type="file" id="filePrincipal'.$ciclo.'" style="display:none" onchange="verFoto(event.target,\'imagePrincipal'.$ciclo.'\')" >
          <button type="button" id="filePrincipalBtn'.$ciclo.'" class="btn btn-primary btn-sm" > <i class="fa fa-upload"></i> Buscar </button>
    </div>';

   print '<div class="col-md-1">
        <button type="button" onclick="removePic('.$ciclo.')" class="btn btn-danger btn-sm removerPic">
                <i class="fa fa-close"></i>
        </button>
      </div>
   </div>';

   print '<div class="ln_solid"></div>
               </div>
               <div id="outrasImagens'.$ciclo.'"></div>';
    })();

?>
