
function verFoto(source, id){
    var reader = new FileReader();
    reader.onload = function () {
        //document.getElementById(id).width = w;
        //document.getElementById(id).height = h;
        document.getElementById(id).src = reader.result;
    }
    console.log(reader.result);
    reader.readAsDataURL(source.files[0]);
}
