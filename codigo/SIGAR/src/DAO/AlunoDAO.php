<?php

require_once "C:/xampp/htdocs/SIGAR/codigo/SIGAR/src/model/Endereco.class.php";
require_once "C:/xampp/htdocs/SIGAR/codigo/SIGAR/src/utils/Conexao.class.php";

class AlunoDAO  {
    
    protected $_res;
    
    public function salvarAluno(Aluno $aluno, Responsavel $responsavel, User $user) {
        //Cria a conexão com o banco de dados
        $obj_conecta = new bd();
            $obj_conecta->conecta();
            $obj_conecta->seleciona_bd();
        
        $sql= "INSERT INTO `pessoa` (`idPessoa`, `nome`, `email`, `telefoneResidencial`, `telefoneCelular`, `sexo`, `dataNascimento`, `cpf`) VALUES
            (NULL,  '".$aluno->getNome()."', '".$aluno->getEmail()."', '".$aluno->getTelefoneResidencial()."', '".$aluno->getCelular()."', '".$aluno->getSexo()."', '".$aluno->getNascimento()."', '".$aluno->getCpf()."');";
        mysql_query($sql);
        $idPessoaAluno = mysql_insert_id();
        
        $sql= "INSERT INTO `usuario` (`idUsuario`, `login`, `senha`, `idPessoa`) VALUES 
        (NULL, '".$user->getLogin()."', '".$user->getSenha()."', '.$idPessoaAluno.');";
        mysql_query($sql);
        $idUsuarioAluno = mysql_insert_id();
        
        $sql= "INSERT INTO `pessoa` (`idPessoa`, `nome`, `email`, `telefoneResidencial`, `telefoneCelular`, `sexo`, `dataNascimento`, `cpf`) VALUES
        (NULL,  '".$responsavel->getNome()."', '".$responsavel->getEmail()."', '".$responsavel->getTelefoneResidencial()."', '".$responsavel->getCelular()."', '".$responsavel->getSexo()."', 
            '".$responsavel->getNascimento()."', '".$responsavel->getCpf()."');";
        mysql_query($sql);
        $idPessoaResponsavel = mysql_insert_id();
        
        $sql = "INSERT INTO `responsavel` (`idResponsavel`, `categoria`, `telefoneTrabalho`, `idPessoa`) VALUES 
        (NULL, '".$responsavel->getCategoria()."', '".$responsavel->getTelTrabalho()."', '.$idPessoaResponsavel.');";
        mysql_query($sql);
        $idResponsavel = mysql_insert_id();
         
        $sql = "INSERT INTO `aluno` (`idAluno`, `anoEscolar`, `escola`, `idResponsavel`, `idUsuario`) VALUES 
        (NULL, '".$aluno->getAnoEscolar()."', '".$aluno->getEscola()."', '".$idResponsavel."', '".$idUsuarioAluno."');";
        mysql_query($sql);
      
        $enderecoAluno = $aluno->getEndereco();
        
        $enderecoResponsavel = $responsavel->getEndereco();
        
        $sql = "INSERT INTO `endereco` (`idendereco`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `referencia`, `uf`) VALUES 
        (NULL, '".$enderecoAluno->getCep()."', '".$enderecoAluno->getLogradouro()."', 
            ".$enderecoAluno->getNumeroCasa().", '".$enderecoAluno->getComplemento()."', '".$enderecoAluno->getBairro()."', '".$enderecoAluno->getCidade()."', '".$enderecoAluno->getReferencia()."', '".$enderecoAluno->getUf()."');";
        mysql_query($sql);
        $idEnderecoAluno = mysql_insert_id();
        
        $sql= "INSERT INTO `endereco_pessoa` (`idEndereco_Pessoa`, `idEndereco`, `idPessoa`) VALUES 
        (NULL, '".$idEnderecoAluno."', '".$idPessoaAluno."');";
        mysql_query($sql);
        
        $sql = "INSERT INTO `endereco` (`idendereco`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `referencia`, `uf`) VALUES 
        (NULL, '".$enderecoResponsavel->getCep()."', '".$enderecoResponsavel->getLogradouro()."', ".$enderecoResponsavel->getNumeroCasa().", '".$enderecoResponsavel->getComplemento()."', 
            '".$enderecoResponsavel->getBairro()."', '".$enderecoResponsavel->getCidade()."', '".$enderecoResponsavel->getReferencia()."', '".$enderecoResponsavel->getUf()."');";
        mysql_query($sql);
        $idEnderecoResponsavel = mysql_insert_id();
        
        $sql= "INSERT INTO `endereco_pessoa` (`idEndereco_Pessoa`, `idEndereco`, `idPessoa`) VALUES 
        (NULL, '". $idEnderecoResponsavel."', '".$idPessoaResponsavel."');";
        mysql_query($sql);
        
        $linha = mysql_affected_rows();

        return $linha;
    }
    
        public function listarAlunos(){
            //Cria a conexão com o banco de dados
            $obj_conecta = new bd();
                $obj_conecta->conecta();
                $obj_conecta->seleciona_bd();
                
            /*
            $sql = "SELECT  `pessoa`.`nome` ,  `pessoa`.`email` ,  `aluno`.`escola` ,`pessoa`.`dataNascimento`, `pessoa`.`sexo`, `pessoa`.`telefoneResidencial` , `aluno`.`anoEscolar` 
            FROM  `pessoa` ,  `aluno` ,  `usuario` 
            WHERE  `aluno`.`idUsuario` =  `usuario`.`idUsuario` 
            AND  `usuario`.`idPessoa` =  `pessoa`.`idPessoa` "; 
            */
             
            $sql = "SELECT  `pessoa`.* ,  `aluno`.* 
            FROM  `pessoa` ,  `aluno` ,  `usuario` 
            WHERE  `aluno`.`idUsuario` =  `usuario`.`idUsuario` 
            AND  `usuario`.`idPessoa` =  `pessoa`.`idPessoa` "; 
            
            $res=mysql_query($sql);

            if(mysql_num_rows($res)==0)
                $res="Nada encontrado!";

            $obj_conecta->fechaConexao();

            return $res;
        }
        
         public function listarAluno($alunoID){
            //Cria a conexão com o banco de dados
            $obj_conecta = new bd();
                $obj_conecta->conecta();
                $obj_conecta->seleciona_bd();
                
            /*
            $sql = "SELECT  `pessoa`.`nome` ,  `pessoa`.`email` ,  `aluno`.`escola` ,`pessoa`.`dataNascimento`, `pessoa`.`sexo`, `pessoa`.`telefoneResidencial` , `aluno`.`anoEscolar` 
            FROM  `pessoa` ,  `aluno` ,  `usuario` 
            WHERE  `aluno`.`idUsuario` =  `usuario`.`idUsuario` 
            AND  `usuario`.`idPessoa` =  `pessoa`.`idPessoa` "; 
            */
             
            $sql = "SELECT `pessoa`.* , `aluno`.* , `endereco`.*, `responsavel`.*
                    FROM `pessoa` , `aluno` , `usuario` , `endereco`, `responsavel`
                    WHERE `aluno`.`idUsuario` = `usuario`.`idUsuario` 
                    AND `usuario`.`idPessoa` = `pessoa`.`idPessoa` 
                    AND `aluno`.`idResponsavel` = `responsavel`.`idResponsavel` 
                    AND `endereco`.`idEndereco` IN (SELECT `idEndereco` FROM `endereco_pessoa` WHERE `endereco_pessoa`.`idPessoa` = `pessoa`.`idPessoa`)
                    AND `aluno`.`idAluno` = $alunoID "; 
                      
            $res= mysql_query($sql);

            if(mysql_num_rows($res)==0)
                $res="Nada encontrado!";
            else
                $res = mysql_fetch_array ($res);

            $obj_conecta->fechaConexao();

            return $res;
        }
    
    
        
        public function alterarAluno($idPessoaAluno,Aluno $aluno, User $user, Responsavel $responsavel){
                $obj_conecta = new bd();
                $obj_conecta->conecta();
                $obj_conecta->seleciona_bd();

                $sql ="SELECT  `usuario`.`idUsuario` FROM  `usuario`,  `pessoa` WHERE  `usuario`.`idPessoa` = `pessoa`.`idPessoa` AND `pessoa`.`idPessoa`= ".$idPessoaAluno." ;";
                $idUsuario = mysql_query($sql);
                    if(mysql_num_rows($idUsuario)==0)
                    {
                        $idUsuario="Nada encontrado!++++";
                    }


                $sql = "UPDATE `aluno` SET  `anoEscolar` =  '".$aluno->getAnoEscolar()."',`escola` =  '".$aluno->getEscola()."' WHERE  `aluno`.`idUsuario` =".$idPessoaAluno."; "; 

                $alteraTabAluno = mysql_query($sql);
                
                if($alteraTabAluno){
                     //echo "Tabela aluno alterado com sucesso+++++";
                }
                else {
                      echo "ERRO alteração tabela aluno+++++++++";         
                }


                $sql = "UPDATE `usuario` SET  `login` =  '".$user->getLogin()."', `senha` = '".$user->getSenha()."' WHERE  `usuario`.`idPessoa` = ".$idPessoaAluno.";";

                $alteraTabUsuario = mysql_query($sql);
                
                if($alteraTabUsuario){
                     //echo "<br> Tabela Usuario alterado com sucesso <br>";
                }
                else {
                      echo "<br> ERRO alteração tabela USUARIO <br>";         
                }
     
                $sql = "UPDATE  `pessoa` SET  `nome` =  '".$aluno->getNome()."', `email` =  '".$aluno->getEmail()."', 
                    `telefoneResidencial` =  '".$aluno->getTelefoneResidencial()."', `telefoneCelular` =  '".$aluno->getCelular()."', `sexo` =  '".$aluno->getSexo()."', `dataNascimento` =  '".$aluno->getNascimento()."', 
                        `cpf` =  'NULL' WHERE  `pessoa`.`idPessoa` =".$idPessoaAluno." ;";

               $alteraTabPessoa = mysql_query($sql);
                
                if($alteraTabPessoa){
                     //echo "<br>Tabela Pessoa alterado com sucesso........IDPESSOAaLUNO=[".$idPessoaAluno."]<br>";
                }
                else {
                      echo "<br>ERRO alteração tabela PESSOA......IDPESSOAaLUNO=[".$idPessoaAluno."]<br>";         
                }
                
                echo "<br>IdPessoaAluno = [".$idPessoaAluno."] <br><br>";
                
                $this->alterarEndereco($idPessoaAluno, $aluno); 
                
                $sql ="SELECT  `aluno`.`idAluno` FROM  `usuario`, `aluno` WHERE  `usuario`.`idUsuario` = `aluno`.`idUsuario` AND `usuario`.`idPessoa`= ".$idPessoaAluno." ;";
                $resultadoAluno = mysql_query($sql);
                $idAluno = 0;
                while($aux = mysql_fetch_array($resultadoAluno)){
                    $idAluno = $aux['idAluno'];
                }
                
                if(mysql_num_rows($resultadoAluno)==0)
                {
                      echo "<br> NENHUM ALUNO encontrado! <br>";
                }
                else{
                    echo "<br> IDALUNO=".$idAluno." <br>";
                }
                $sql = "SELECT  `pessoa`.`idPessoa` FROM  `responsavel`,  `pessoa`, aluno WHERE  `responsavel`.`idPessoa` = `pessoa`.`idPessoa` AND `responsavel`.`idResponsavel`= `aluno`.`idResponsavel` AND `aluno`.`idAluno`= ".$idAluno." ;";
                $resultadoResponsavel = mysql_query($sql);
                $idPessoaResponsavel = 0;
                while($aux = mysql_fetch_array($resultadoResponsavel)){
                    $idPessoaResponsavel = $aux['idPessoa'];
                }
                
                echo "<br> IdPessoaResponsavel = [".$idPessoaResponsavel."] <br><br>";
                
                $this->alterarResponsavel($idPessoaResponsavel,$responsavel);
                
                $linha = mysql_affected_rows();

                return $linha;

        }



        public function alterarEndereco($idPessoaAluno,Aluno $aluno){
                
                $obj_conecta = new bd();
                $obj_conecta->conecta();
                $obj_conecta->seleciona_bd();
                
                echo "<br> Chegou no metodo IdPessoaAluno = [".$idPessoaAluno."] <br><br>";
                
                $sql = "SELECT `endereco_pessoa`.`idEndereco` FROM `endereco_pessoa` WHERE `endereco_pessoa`.`idPessoa` = ".$idPessoaAluno.";";
                $resulltadoEndereco = mysql_query($sql);
                $idEndereco = 0;
                while($aux = mysql_fetch_array($resulltadoEndereco)){
                    $idEndereco = $aux['idEndereco'];
                }
                
                if(mysql_num_rows($resulltadoEndereco)==0)
                {
                      echo "<br> NENHUM ENDERECO encontrado! POSSIVELIDENDERECO=".$idEndereco." <br>";
                }
                else{
                    echo "<br> IDENDERECO=".$idEndereco." <br> ";
                }
                
                $enderecoAluno = $aluno->getEndereco();

                $sql = "UPDATE `sigar`.`endereco` SET `cep` = '".$enderecoAluno->getCep()."',`logradouro` = '".$enderecoAluno->getLogradouro()."',`numero` = ".$enderecoAluno->getNumeroCasa().",`complemento` = '".$enderecoAluno->getComplemento()."',`bairro` = '".$enderecoAluno->getBairro()."',`cidade` = '".$enderecoAluno->getCidade()."',`referencia` = '".$enderecoAluno->getReferencia()."',`uf` = '".$enderecoAluno->getUf()."' WHERE `endereco`.`idendereco` = ".$idEndereco.";"; 
                
                echo "<br>Comando ALTERA SQL: ".$sql." <br><br>";
                $alteraTabEndereco = mysql_query($sql);
                if($alteraTabEndereco){
                     echo "<br> Tabela ENDERECO alterado com sucesso <br>";
                }
                else {
                      echo "<br> ERRO alteração tabela ENDERECO <br>";         
                }


        }


        //Metodo a ser  vai associar a nova pessoa ao Endereço já existente

        public function inserirMesmoEndereco($idPessoa,$idEndereco){

                $sql = "UPDATE  `sigar`.`endereco_pessoa` SET  `idEndereco` =  `".$idEndereco."`, `idPessoa` = ".$Pessoa." WHERE  `endereco_pessoa`.`idPessoa` =".$idPessoa."; "; 

        }

        //Fazer o alterar endereco responsavel
        public function alterarResponsavel($idPessoaResponsavel,  Responsavel $responsavel){
                $obj_conecta = new bd();
                $obj_conecta->conecta();
                $obj_conecta->seleciona_bd();
                
                echo "<br> Chegou no metodo IdPessoaResponsavel = [".$idPessoaResponsavel."] <br><br>";

                $sql = "UPDATE  `sigar`.`responsavel` SET  `categoria` =  '".$responsavel->getCategoria()."', `telefoneTrabalho` =  '".$responsavel->getTelTrabalho()."' WHERE  `responsavel`.`idPessoa` =".$idPessoaResponsavel.";";

                $alteraTabResponsavel = mysql_query($sql);
                if($alteraTabResponsavel){
                     echo "<br> Tabela RESPONSAVEL alterado com sucesso <br>";
                }
                else {
                      echo "<br> ERRO alteração tabela RESPONSAVEL <br>";         
                }


                $sql = "UPDATE  `pessoa` SET  `nome` =  '".$responsavel->getNome()."', `email` =  '".$responsavel->getEmail()."', `telefoneResidencial` =  '".$responsavel->getTelefoneResidencial()."', 
                    `telefoneCelular` =  '".$responsavel->getCelular()."', `sexo` =  '".$responsavel->getSexo()."', `dataNascimento` =  '".$responsavel->getNascimento()."', `cpf` =  '".$responsavel->getCpf()."' WHERE  `pessoa`.`idPessoa` = ".$idPessoaResponsavel.";";

                $alteraTabPessoaResp = mysql_query($sql);
                if($alteraTabPessoaResp){
                     echo " <br> Tabela PESSOARESPONSAVEL alterado com sucesso <br>";
                }
                else {
                      echo "<br> EROO alteração tabela PESSOARESPONSAVEL <br>";         
                }

        }



        public function deletarAluno($idPessoaAluno){
                $obj_conecta = new bd();
                $obj_conecta->conecta();
                $obj_conecta->seleciona_bd();

                $sql ="SELECT  `aluno`.`idAluno` FROM  `usuario`, `aluno` WHERE  `usuario`.`idUsuario` = `aluno`.`idUsuario` AND `usuario`.`idPessoa`= ".$idPessoaAluno." ;";

                $idAluno = mysql_query($sql);

                $sql = "DELETE FROM `sigar`.`aluno` WHERE `aluno`.`idAluno` = ".$idAluno.";"; 

                $deleta = mysql_query($sql);

                        if($deleta){

                        }
                        else {
                                echo "Dados tabela aluno deletado com sucesso";
                        }

                $sql = "DELETE FROM `sigar`.`usuario` WHERE `usuario`.`idPessoa` = ".$idPessoaAluno.";"; 
                $deleta = mysql_query($sql);

                        if($deleta){

                        }
                        else {
                                echo "Dados tabela usuario deletado com sucesso";
                        }

                $sql = "SELECT  `endereco_pessoa`.`idEndereco_Pessoa` FROM  `sigar`.`endereco_pessoa` WHERE  `endereco_pessoa`.`idPessoa` =".$idPessoaAluno.";";
                $idEnderecoPessoa = mysql_query($sql);

                $sql = "SELECT  `endereco_pessoa`.`idEndereco` FROM  `sigar`.`endereco_pessoa` WHERE  `endereco_pessoa`.`idPessoa` =".$idPessoaAluno.";";

                $idEndereco = mysql_query($sql);

                $sql = "DELETE FROM `sigar`.`endereco_pessoa` WHERE `endereco_pessoa`.`idEndereco_Pessoa` = ".$idEnderecoPessoa." ;" ;

                $deleta = mysql_query($sql);

                        if($deleta){

                        }
                        else {
                                echo "Dados tabela endereco deletado com sucesso";
                        }

                $sql = "DELETE FROM `sigar`.`pessoa` WHERE `pessoa`.`idPessoa` = ".$idPessoaAluno." ;";

                $deleta = mysql_query($sql);

                        if($deleta){

                        }
                        else {
                                echo "Dados tabela PESSOA deletado com sucesso";
                        }

                $idPessoaResponsavel = mysql_query("SELECT  `pessoa`.`idPessoa` FROM  `responsavel`,  `pessoa`, aluno WHERE  `responsavel`.`idPessoa` = `pessoa`.`idPessoa` AND `responsavel`.`idResponsavel`= `aluno`.`idResponsavel` AND `aluno`.`idAluno`= ".$idAluno." ;");       
                deletarResponsavel($idPessoaResponsavel);

                //Não deletar o endereço pois pode estar sendo utilizado por outra pessoa

        }


        public function deletarResponsavel($idPessoaResponsavel){
                $obj_conecta = new bd();
                $obj_conecta->conecta();
                $obj_conecta->seleciona_bd();

                $sql = "SELECT  `responsavel`.`idResponsavel` FROM  `responsavel` WHERE  `responsavel`.`idPessoa` = ".$idPessoaResponsavel." ;";
                $idResponsavel = mysql_query($sql);

                $sql = "DELETE FROM `sigar`.`responsavel` WHERE `responsavel`.`idResponsavel` = ".$idResponsavel." ;"; 
                $deleta = mysql_query($sql);

                        if($deleta){

                        }
                        else {
                                echo "Dados da tabela RESPONSAVEL deletado com sucesso";
                        }


                $sql = "DELETE FROM `sigar`.`pessoa` WHERE `pessoa`.`idPessoa` = ".$idPessoaResponsavel." ;"; 
                $deleta = mysql_query($sql);

                        if($deleta){

                        }
                        else {
                                echo "Dados tabela PESSOA deletado com sucesso";
                        }
        }






        }
?>
