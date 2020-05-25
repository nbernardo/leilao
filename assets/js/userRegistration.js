modalFeatures = {
    footer: true,
    stickyFooter: false,
    closeMethods: ['overlay', 'button', 'escape'],
    closeLabel: "Close",
    cssClass: ['custom-class-1', 'custom-class-2'],
    onOpen: function() {
        document.querySelector('.tingle-modal-box__footer').style.display = '';
        document.getElementById("formContainer").flexDirection = "column";
    },
    onClose: function() {
        registrationModal.setContent("");
    },
    beforeClose: function() {
        return true; // close the modal
        return false; // nothing happens
    }
};

var registrationModal = new tingle.modal(modalFeatures);
registrationModal.addFooterBtn('Registar', 'sendBtn', function() {

    // ValidationInputs() vem do ficheiro validations.js
    let formValidation = new ValidationInputs();
    if(formValidation.check('registrationInput').numberOfErrors > 0){
        return;
    }
    //alert("Outro Chamous");

    let form = new ProwebForm();
    form.adicionaAllFields('processInput');
    formProcessingLoader("formContainer");

    form.addProwebField("User.imagemPerfil",document.getElementById("User.imagemPerfil").value);

    let request = new ProwebRequest();
    request.url = "controllerGateway.php?controller=User&method=save";
    request.debugResult = true;
    request.post(null,form.result,onRegisterSuccess);

});

registrationModal.addFooterBtn('Fachar', 'cancelBtn', function() {
    registrationModal.close();
});

function regModal(){
    registrationModal.setContent(document.getElementById('contact_form').innerHTML);
    registrationModal.open();
}

function selectFile(){

    let imagemPerfil = document.getElementById("imagemPerfil");

    imagemPerfil.click();

    imagemPerfil.onchange = function(){
    
    reader = new FileReader();
    reader.onload = function(){
        let actualImage = reader.result;
        document.getElementById("imageLocal").src = actualImage;
        document.getElementById("User.imagemPerfil").value = actualImage;
    }
    reader.readAsDataURL(imagemPerfil.files[0]);
    
    }

}

function onRegisterSuccess(result){

    console.log(result);
    //alert(result);

    let container = document.getElementsByClassName('tingle-modal-box__content');
    let _form = document.getElementById("formContainer");

    let successText = document.createElement("h3");
    successText.innerHTML = "Conta criada com sucesso";
    successText.style.textAlign = "center";
    successText.style.color = "green";

    let emailText = document.createElement("h5");
    emailText.innerHTML = "Confmirma o seu email para a actiação da conta";
    emailText.style.textAlign = "center";

    document.querySelector('.tingle-modal-box__footer').style.display = 'none';

    _form.innerHTML = "";
    _form.style.display = "";
    _form.style.flexDirection = "column";
    _form.appendChild(successText);
    _form.appendChild(emailText);

}

function formProcessingLoader(formId){
    _formContent = document.getElementById(formId).innerHTML;
    document.getElementById(formId).style.justifyContent = "center";
    document.getElementById(formId).innerHTML = `<div class="loader"></div>`;
    
}


modalFeaturesLogin = {
    footer: true,
    stickyFooter: false,
    closeMethods: ['overlay', 'button', 'escape'],
    closeLabel: "Close",
    cssClass: ['custom-class-1', 'custom-class-2'],
    onOpen: function() {
        document.querySelector('.tingle-modal-box__footer').style.display = '';
    },
    onClose: function() {
        loginModal.setContent("");
    },
    beforeClose: function() {
        return true; // close the modal
        return false; // nothing happens
    }
};

var loginModal = new tingle.modal(modalFeaturesLogin);
loginModal.addFooterBtn('Logar', 'sendBtn mainLoginBtn', function() {
    document.getElementById("userOrPasswordWrong").style.display = "none";
    // ValidationInputs() vem do ficheiro validations.js
    let loginFormValidation = new ValidationInputs();
    if(loginFormValidation.check('loginInput').numberOfErrors > 0){
        return;
    }

    loginForm = new ProwebForm();
    loginForm.adicionaAllFields('loginInput');
    formProcessingLoader("formLoginContainer");

    let request = new ProwebRequest();
    request.url = "controllerGateway.php?controller=User&method=logar";
    request.debugResult = true;
    request.post(null,loginForm.result,loginProcess);

});

loginModal.addFooterBtn('Cancelar', 'cancelBtn', function() {
    loginModal.close();
});



function loginModalShow(){
    loginModal.setContent(document.getElementById('login_form').innerHTML);
    loginModal.open();
}

function loginProcess(result){

    try{
        let resultado = JSON.parse(result);
        if(resultado.sucesso != undefined)
            window.location.reload();
    }catch(e){
        document.getElementById('formLoginContainer').innerHTML = _formContent;
        document.getElementById("userName").value = loginForm.fieldList.userName;
        wrongUser = document.getElementById("userOrPasswordWrong");
        wrongUser.style.display = "block";
        wrongUser.style.paddingTop = "20px";
    }
    
}

function enterPressLogin(){
    
    pressedKey = event.keyCode || event.charCode;
    let loginButton = document.querySelector(".mainLoginBtn");
    if(pressedKey == 13)
        loginButton.click();

}
