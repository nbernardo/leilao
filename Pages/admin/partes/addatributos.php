<?php

(function () {

  $ciclo = $_REQUEST['ciclo'] + 1;

  print '<div id="attr'.$ciclo.'" style="display:flex; justify-content: left;">';

 print '<div class="col-md-4">
         <div>
             <label >Atributo</label>
             <input type="text" name="atributo'.$ciclo.'" placeholder="" id="atributo'.$ciclo.'">
         </div>
     </div>';

   print '<div class="col-md-4">
         <div>
             <label >Valor</label>
             <input type="text" name="valor'.$ciclo.'" id="valor'.$ciclo.'">
         </div>
     </div> ';

  print '<div class="col-md-2">
       <button type="button" onclick="removeAttr('.$ciclo.')" class="btn btn-danger btn-sm removerPic">
            <i class="fa fa-close"></i>
       </button>
     </div>
  </div>';

  print '<div class="ln_solid"> </div>
         <div id="outroattr'.$ciclo.'"></div>
         </div>';
   })();

?>
