<?php
$url = $_SERVER['DOCUMENT_ROOT'] . "/SIGAR/codigo/SIGAR/src";
    require $url.'/view/ValidaSession.php';
    require_once $url.'/controller/AgendamentoCtrl.php';
    $agendamentoCtrl = new AgendamentoCtrl();
    //$idAgendamento = 20;
    $idAgendamento = $_GET['idAgendamento'];
    
      if (isset($_POST['btnEnviar'])) {
        $agendamentoCtrl->listarAgendamentoEspec($idAgendamento);
        $agedamentoAtual = utf8_encode(mysql_result($agendamentoCtrl->getRes(),0,'status'));
        $novoStatus = $_POST['novoStatus'];
        
        if($agedamentoAtual==$novoStatus)
            echo "<script type='text/javascript'>alert('O status atual já é o desejado!');</script>";
        
        if($agedamentoAtual=="Marcado" && $novoStatus=="Cancelado"){
             $agendamentoCtrl->alterarStatus($idAgendamento, $novoStatus);
             echo "<script type='text/javascript'>alert('Status alterado com sucesso!');</script>";
        }   
        if($agedamentoAtual=="Marcado" && $novoStatus=="Confirmado"){
            $agendamentoCtrl->alterarStatus($idAgendamento, $novoStatus);
            echo "<script type='text/javascript'>alert('Status alterado com sucesso!');</script>";
        }
        if($agedamentoAtual=="Confirmado" && $novoStatus=="Cancelado"){
            $agendamentoCtrl->alterarStatus($idAgendamento, $novoStatus);
            echo "<script type='text/javascript'>alert('Status alterado com sucesso!');</script>";
        }
        if($agedamentoAtual=="Confirmado" && $novoStatus=="Marcado"){
            echo "<script type='text/javascript'>alert('Você não pode alterar o Status atual para (Marcado)!');</script>";
        }
        if($agedamentoAtual=="Cancelado" && $novoStatus=="Marcado"){
            echo "<script type='text/javascript'>alert('Você não pode alterar o Status atual para (Marcado)!');</script>";
        }
        if($agedamentoAtual=="Cancelado" && $novoStatus=="Confirmado"){
            echo "<script type='text/javascript'>alert('Você não pode alterar o Status atual para (Confirmado)!');</script>";
        }
        
        
    }
?>
<html lang="en">
<head>
  <meta charset="utf-8" />

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Alterar Status</title>
  <meta name="description" content="" />

  <meta name="viewport" content="width=device-width; initial-scale=1.0" />

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="../img/favicon.ico" />
  <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
  <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="../css/estilo.css" rel="stylesheet" media="screen">
  <script src="../js/jquery-latest.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.valid8.js" type="text/javascript" charset="utf-8"></script>
  <script src="../js/jquery.maskedinput-1.3.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="../js/jquery.quicksearch.js"></script>
  <script src="../js/base.js"></script>
  <script src="../js/formCadastroProfessor.js"></script>
  <link href="../css/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />

</head>
<body>
    <div id="boxes">
    <div id="dialog" class="window">
        <a href="#" class="close" />Fechar</a>
        <div id="ajaxContainer">
        </div>
    </div>
<div id="mask"></div>
</div>
        <div class="container">
            <a href="../TelaPrincipal.php"><img src="../img/logo.png" vspace="50"/></a>
            <p class="status">Logado como:<b> <?php echo $ObjSessao->getUsuario();?> | <a href= "../Logoff.php" >Sair</b></a></p>
            <div id="sysBox">
                <div class="inner">
                    <br/>
                    <a href="GerenciarAulasMarcadas.php"><span class="selected">    Gerenciar Aulas       </span></a>
                    <!--<a href="#"><span class="selected"> Pesquisar Professor</span></a>-->
                    <div class="content">
                        <form id="DispTest" class="spaces" name="form1" action="AlterarStatusAgendamento.php?idAgendamento=<?php echo $idAgendamento; ?>" method="post">
                        <div class="spaces">
                            <div class="row-fluid show-grid">
                           <div class="span6">
                           <b>Status Atual:</b><br>
                                    <?php
                                     $agendamentoCtrl->listarAgendamentoEspec($idAgendamento);
                                    ?>
                                <input name="statusAtual" type="text" disabled value="<?php echo utf8_encode(mysql_result($agendamentoCtrl->getRes(),0,'status')); ?>" /><br>
                                    <br/>
                                          
                            </div>
                            <div class="span6">
                            
                            <b>Selecione o novo Status:</b>
                            <br/>
                            <input name="novoStatus" type="radio" value="Marcado" /> Marcado <br>
                            <input name="novoStatus" type="radio" value="Confirmado" /> Confirmado <br>
                            <input name="novoStatus" type="radio" value="Cancelado" /> Cancelado <br>
                            </div>
                            <br/>
                            <div class="span6">
                            </div>
                           
                        </div>
                             <input id="cadEnvDisp2" type="submit" name="btnEnviar" value="Enviar" />
                        </div>
                            </form>
                    </div>
                </div>
            </div>
            
        </div>
</body>
</html>

