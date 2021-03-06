
<?php
require_once "/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/Endereco.class.php";
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/dao/AlunoDAO.php';
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/Pessoa.class.php';
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/User.class.php';
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/Aluno.class.php';
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/Endereco.class.php';
require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/model/Responsavel.class.php';

/**
 * @author Guilherme Baufaker  <gbre.111@gmail.com>
 */

    
class DAODeletar_Test extends PHPUnit_Framework_TestCase{

    
     protected $aluno_obj; 
    protected $endereco_obj;
    protected $reponsavel_obj;
    protected $user_obj;
    protected $id_pessoa_aluno;

    public function setUp()
    {
        $logradouro = 'SMPW 21 CONJUNTO 3';
        $cep = '710283832';
        $bairro = 'PARK WWAY';
        $cidade = 'Brasilia';
        $complemento = 'casa';
        $numero = '19';
        $uf = 'DF';
        $referencia = 'Brasilia';

        $nomeResp = 'EDSON ALVES';
        $sexoResp = 'm';
        $cpf = '012.202.033-21';
        $telResResp='(61)3301-3239'; 
        $telefoneTrabalho = '(61)3301-3239';
        $telCelResp = '(61)3301-3239';
        $categoria = 'pai';
        $nascimentoResp = '1990-11-12';
        $emailResp = 'EDSONSALVER@emai.com.br';

        $nome = 'hilmer';
        $sexo = 'm';
        $email = 'HILMER@GMAIL.COM';
        $nascimento = '1995-11-24';
        $anoEscolar = '2ef';
        $telResidencial = '(61)3321-3030';
        $telCelular = '(61)9999-8699';
        $escola = 'FGA';

        $this->endereco_obj=new Endereco($logradouro,$cep,$bairro,$cidade,$complemento,$numero,$uf,$referencia);
        $this->user_obj = new User();
        $this->responsavel_obj = new Responsavel(utf8_decode($nomeResp),$emailResp,$telResResp, $telCelResp, $sexoResp ,$nascimentoResp, $cpf, $categoria, $telefoneTrabalho, $this->endereco_obj);
        $this->aluno_obj=new Aluno (utf8_decode($nome),$sexo,$nascimento,$email,$anoEscolar,$telResidencial,$telCelular,$escola,  $this->endereco_obj,$this->responsavel_obj,$this->user_obj);
    }
    
        
    /**
     * @test
     *
     */

    public function TestDeletarAlunoDAO(){
        $aluno_dao = new AlunoDAO();

       
        $this->id_pessoa_aluno = $aluno_dao->salvarAluno($this->aluno_obj,$this->responsavel_obj,$this->user_obj);
        $this->assertEquals('1',$aluno_dao->deletarAluno($this->id_pessoa_aluno));
 
    }
}
?>
