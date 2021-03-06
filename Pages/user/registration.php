<div id="contact_form" class="contact_form" style="display:none;">

    <h3>
        Criação de nova conta
    </h3>
    <hr/>

    <form method="post" action="controllerGateway.php?controller=User&method=save" id="formContainer" class="formContainer">

        <section class="formSection">

            <div class="field-group">
                <label>Nome completo *</label>
                <div class="inputContent">
                    <input class="processInput registrationInput" placeholder="Nome completo" type="text" id="userName" name="field[User.nome]"/>
                    <div class="validationErro">Digite o nome completo</div>
                </div>
            </div>

            <div class="field-group">
                <label>Telefone *</label>
                <div class="inputContent">
                    <input class="processInput registrationInput" placeholder="Número de telefone móvel" type="text" id="userPhone" name="field[User.telefone]"/>
                    <div class="validationErro">Inform o seu numero de telefone</div>
                </div>
            </div>

            <div class="field-group">
                <label>Tipo de conta *</label>
                <div class="inputContent">
                    <select class="processInput registrationInput leilaoStyle ajustedCombo" id="tipoConta" name="field[User.tipoConta]">
                        <option value="">Selecione</option>
                        <option value="COMPRADOR">Comprador</option>
                        <option value="VENDEDOR">Vendedor</option>
                        <option value="COMPRADOR_VENDEDOR">Comprador e Vendedor</option>
                    </select>
                    <div class="validationErro">Selecione o tipo de conta</div>
                </div>
            </div>

            <div class="field-group">
                <label>Email *</label>
                <div class="inputContent">
                    <input id="userEmail" class="processInput registrationInput"  placeholder="Email pessoal" type="text" name="field[User.email]"/>
                    <div class="validationErro">Digite o email</div>
                </div>
            </div>

            <div class="field-group">
                <label>Senha *</label>
                <div class="inputContent">
                    <input class="processInput registrationInput"  placeholder="Senha de acesso ao perfil" type="password" id="userPassword" name="field[User.password]"/>
                    <div class="validationErro">Digite a senha</div>
                </div>
            </div>

            <div class="field-group">
                <label>Confirmação da Senha *</label>
                <div class="inputContent">
                    <input class="processInput registrationInput"  placeholder="Confirmação da senha de acesso ao perfil" type="password" id="confUserPassword" />
                    <div class="validationErro">Confirme a sua senha</div>
                </div>
            </div>

            <input 
                type="hidden"
                value=""
                class="processInput"
                name="field[User.imagemPerfil]"
                id="User.imagemPerfil"
            />

        </section>
        
        <section class="formSection">

            <input 
                type="file" 
                style="display:none;"
                id="imagemPerfil" 
                name="imagemPerfil">
            <img 
                 src="../../assets/images/silueta.png" 
                 width="150" 
                 alt="Local da imagem"
                 id="imageLocal"
                 height="200"
            >
            <button type="button" onclick="selectFile()" class="sendBtn imgSelect">
                Selecionar
            </button>
        </section>

    </form>
    
</div>


<div id="login_form" class="contact_form" style="display:none;">

    <h3>
        Efectue o seu Login 
    </h3>
    <hr/>

    <form id="formLoginContainer" class="formContainer">

        <section class="formSection">

            <div class="field-group">
                <label>Nome completo *</label>
                <div class="inputContent">
                    <input onkeyup="enterPressLogin()" class="processInput loginInput" placeholder="Conta de email" type="text" id="userName" name="field[User.email]"/>
                    <div class="validationErro">Informe o seu email</div>
                </div>
            </div>

            <div class="field-group">
                <label>Senha *</label>
                <div class="inputContent">
                    <input onkeyup="enterPressLogin()" class="processInput loginInput" placeholder="Senha de acesso" type="password" id="userPassword" name="field[User.password]"/>
                    <div class="validationErro">Digite a senha</div>
                </div>
            </div>
            <div class="validationErro" id="userOrPasswordWrong">Utilizador ou senha inválida</div>

    </form>
    
</div>

