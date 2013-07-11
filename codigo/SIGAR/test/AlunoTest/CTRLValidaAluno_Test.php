<?php
require_once "/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/Endereco.class.php";
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/dao/AlunoDAO.php';
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/Pessoa.class.php';
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/User.class.php';
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/Aluno.class.php';
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/Endereco.class.php';
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/Responsavel.class.php';
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/controller/AlunoCtrl.php';
require_once "/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/utils/Conexao.class.php";
require_once "/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/utils/GeradorCpf.php";

class CTRLValidaAluno_Test extends PHPUnit_Framework_TestCase {
    
    public $retorno = 0; 
    
    public function setUp(){
        $endereco = 'SMPW 21 Conjunto 3';
        $cep = '72151-832';
        $bairro = 'Park Way';
        $cidade = 'Brasília';
        $complemento = 'Casa';
        $numero = '19';
        $uf = 'DF';
        $referencia = 'Brasilia';

        $mesmoEnd = 'sim';
        
        $nomeResp = 'João da Silva';
        $sexoResp = 'm';
        $gera = new GeradorCpf();
        $cpf = $gera->cpf(1);
        //$cpf = '037.040.041.03';
        $telResResp='(61) 3301-3239'; 
        $telefoneTrabalho = '(61) 3301-3239';
        $telCelResp = '(61) 3301-3239';
        $categoria = 'pai';
        $nascimentoResp = '1990-11-12';
        $emailResp = $gera->cpf(0).'@gmail.com';

        $nome = 'Rafael Ferreira';
        $sexo = 'm';
        $email = $gera->cpf(0).'1@gmail.com';
        $nascimento = '1995-11-24';
        $anoEscolar = '2em';
        $telResidencial = '(61) 3321-3030';
        $telCelular = '(61) 9999-8699';
        $escola = 'FGA';

        $enderecoResp = "";
        $numeroResp = "";
        $complementoResp = "";
        $bairroResp = "";
        $cidadeResp = "";
        $ufResp = "";
        $cepResp = "";
        $referenciaResp = "";

        $validaAluno = new AlunoCrtl();

        $this->retorno = $validaAluno->validaAluno(0,
                                                   utf8_decode($nome), 
                                                   $sexo, 
                                                   $nascimento, 
                                                   utf8_decode($email), 
                                                   $telResidencial, 
                                                   $telCelular, 
                                                   $anoEscolar, 
                                                   utf8_decode($escola), 
                                                   utf8_decode($nomeResp), 
                                                   $categoria, 
                                                   $cpf, 
                                                   utf8_decode($emailResp), 
                                                   $telResResp, 
                                                   $sexoResp, 
                                                   $nascimentoResp, 
                                                   $telCelResp, 
                                                   $telefoneTrabalho, 
                                                   $mesmoEnd, 
                                                   utf8_decode($endereco), 
                                                   $numero, 
                                                   utf8_decode($complemento), 
                                                   utf8_decode($bairro), 
                                                   utf8_decode($cidade), 
                                                   $uf, 
                                                   $cep, 
                                                   utf8_decode($referencia), 
                                                   utf8_decode($enderecoResp), 
                                                   $numeroResp, 
                                                   utf8_decode($complementoResp), 
                                                   utf8_decode($bairroResp), 
                                                   utf8_decode($cidadeResp), 
                                                   $ufResp, 
                                                   $cepResp, 
                                                   utf8_decode($referenciaResp),
                                                   1);
    }
    
    /**
     * @test
     *
     */
    
    public function TestValidarAluno(){
       $this->assertEquals('<font color=green><b>Aluno Cadastrado com sucesso!</b></font>',$this->retorno);   
    }
}

?>
