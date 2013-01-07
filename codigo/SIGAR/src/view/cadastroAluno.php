<?php
	include "validaSession.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Cadastrar Aluno</title>
  <meta name="description" content="" />
  <meta name="author" content="Fellype" />

  <meta name="viewport" content="width=device-width; initial-scale=1.0" />

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico" />
  <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/estilo.css" rel="stylesheet" media="screen">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/base.js"></script>
</head>

<body>
        <div class="container">
            <img src="img/logo.png" vspace="50"/>
            <p class="status">Logado como:<b> <?php echo $ObjSessao->getUsuario();?> | <a href= "logoff.php" >Sair</b></a></p>
            <div id="sysBox">
                <div class="inner">
                    <br/>
                    <a href="#"><span class="selected">Cadastrar Alunos</span></a>
                    <a href="pesquisaAluno.php"><span class="normal">Pesquisar Alunos</span></a>
                    <div class="content">
                        <div>
                            <form name="form1" action="controler.php" method="post">
                                    <b>Dados do Aluno</b>
                                    <hr/>
                                    Nome: <input type="text" name="txtNome" size="10" maxlength="50"><br>
                                    Sexo: <input type="radio" name="sexo" value="m"> Masculino
                                                       <input type="radio" name="sexo" value="f"> Feminino<br/><br/>
                                    Data de Nascimento: <input type="text" name="dataNasc" size="10" maxlength="10" onkeyup="mascaraData(this);"><br>
                                    Email: <input type="text" name="email" size="10" maxlength="50"><br>
                                    Telefone Residencial: <input type="text"  name="telResidencial" size="10" maxlength="14" onkeypress="mascara(this, mtel );"><br>
                                    Telefone Celular: <input type="text"  name="telCelular" size="10" maxlength="14" onkeypress="mascara(this, mtel );"><br>
                                    Ano Escolar: <select name="anoEscolar">
                                    <option value="1ef">1º ano do Ensino Fundamental</option>
                                    <option value="2ef">2º ano do Ensino Fundamental</option>
                                    <option value="3ef">3º ano do Ensino Fundamental</option>
                                    <option value="4ef">4º ano do Ensino Fundamental</option>
                                    <option value="5ef">5º ano do Ensino Fundamental</option>
                                    <option value="6ef">6º ano do Ensino Fundamental</option>
                                    <option value="7ef">7º ano do Ensino Fundamental</option>
                                    <option value="8ef">8º ano do Ensino Fundamental</option>
                                    <option value="9ef">9º ano do Ensino Fundamental</option>
                                    <option value="1em">1º ano do Ensino Médio</option>
                                    <option value="2em">2ºano do Ensino Médio</option>
                                    <option value="3em">3º ano do Ensino Médio</option>
                                    <option value= "outros"> Outros</option>
                                    </select><br/>
                                    Escola: <input type="text" name="escola" size="10" maxlength="10"><br/>
                                    Endereco: <input type="text" name="endereco"><br/>
                                    Nº: <input type="text" name="numero"><br/>
                                    Complemento: <input type="text" name="complemento"><br/>
                                    Bairro: <input type="text" name="bairro"><br/>
                                    Cidade: <input type="text" name="cidade"><br/>
                                    UF: <input type="text" name="uf"><br/>
                                    CEP: <input type="text" name="cep"><br/>
                                    Refencia: <input type="text" name="referencia"><br/><br/>
									<b>Dados do Responsável</b>
                                    <hr/>
                                    Nome: <input type="text" name="txtNomeResp" size="10" maxlength="50"><br/>
                                    Parentesco: <input type="radio" name="parentesco" value="pai"> Pai
                                    <input type="radio" name="parentesco" value="mae"> Mae
                                    <input type="radio" name="parentesco" value="outro"> Outro<br/><br/>
                                    CPF <input type="text" name="cpfResp" size="10" maxlength="10"><br/>
                                    Email: <input type="text" name="emailResp" size="10" maxlength="50"><br/>
                                    Telefone Residencial: <input type="text" name="telResResp" size="10" maxlength="14" onkeypress="mascara(this, mtel );"><br>
                                    Telefone Celular: <input type="text"  name="telCelResp" size="10" maxlength="14" onkeypress="mascara(this, mtel );"><br>
                                    Telefone Trabalho: <input type="text" name="telTrabResp" size="10" maxlength="14" onkeypress="mascara(this, mtel );"><br>
                                    Mesmo endereço do Aluno?: <input type="radio" name="parentesco" value="pai"> Sim
                                    <input type="radio" name="parentesco" value="mae"> Não<br/><br/>
									<input type="submit" name="enviar" value="Enviar" />
                                    <input type="reset" name="limpar" value="Limpar" />
                                    <input type="button" value="Fechar" onClick="fechaJanela()">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
</body>
</html>