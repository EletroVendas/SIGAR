
<?php
require_once "C:/xampp/htdocs/SIGAR/codigo/SIGAR/src/model/Endereco.class.php";
require_once 'C:/xampp/htdocs/SIGAR/codigo/SIGAR/src/DAO/AlunoDAO.php';
require_once 'C:/xampp/htdocs/SIGAR/codigo/SIGAR/src/model/Pessoa.class.php';
require_once 'C:/xampp/htdocs/SIGAR/codigo/SIGAR/src/model/User.class.php';
require_once 'C:/xampp/htdocs/SIGAR/codigo/SIGAR/src/model/Aluno.class.php';
require_once 'C:/xampp/htdocs/SIGAR/codigo/SIGAR/src/model/Endereco.class.php';
require_once 'C:/xampp/htdocs/SIGAR/codigo/SIGAR/src/model/Responsavel.class.php';

/**
 * @author Guilherme Baufaker  <gbre.111@gmail.com>
 */
class DAOTest extends PHPUnit_Framework_TestCase{
     
    protected $aluno_obj; 
    protected $endereco_obj;
    protected $reponsavel_obj;
    protected $user_obj;
    
    public function setUp()
    {
        $logradouro = 'QE 32 CONJUNTO H';
        $cep = '710283832';
        $bairro = 'Guara';
        $cidade = 'Brasilia';
        $complemento = 'casa';
        $numero = '19';
        $uf = 'DF';
        $referencia = 'Brasilia';
        
        
       $nomeResp = 'Pai do Aluno';
       $sexoResp = 'm';
       $cpf = '012.202.033-21';
       $telResResp='(61)3301-3239'; 
       $telefoneTrabalho = '(61)3301-3239';
       $telCelResp = '(61)3301-3239';
       $categoria = 'pai';
       $nascimentoResp = '1990-11-12';
       $emailResp = 'pai@emai.com.br';
       
       $nome = 'Aluno de teste';
       $sexo = 'm';
       $email = 'gbre';
       $nascimento = '1995-11-24';
       $anoEscolar = '3 ano';
       $telResidencial = '(61)3301-3239';
       $telCelular = '(61)9332-1292';
       $escola = 'Sigma';
       
       $this->endereco_obj=new Endereco($logradouro,$cep,$bairro,$cidade,$complemento,$numero,$uf,$referencia);
       $this->user_obj = new User();
       $this->responsavel_obj = new Responsavel(utf8_decode($nomeResp),$emailResp,$telResResp, $telCelResp, $sexoResp ,$nascimentoResp, $cpf, $categoria, $telefoneTrabalho, $this->endereco_obj);
       $this->aluno_obj=new Aluno (utf8_decode($nome),$sexo,$nascimento,$email,$anoEscolar,$telResidencial,$telCelular,$escola,  $this->endereco_obj,$this->responsavel_obj,$this->user_obj);
       
    }
    
    
    /**
     * @test
     *
     */
    public function TestDAO()
    {
        $aluno_dao = new AlunoDao();
       
       $this->assertEquals('1', $aluno_dao->salvarAluno($this->aluno_obj,$this->responsavel_obj,$this->user_obj));
    }
    
}
?>
