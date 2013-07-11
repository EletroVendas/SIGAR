<?php

require_once '/opt/lampp/htdocs/SIGAR/codigo/SIGAR/src/dao/EmailDAO.php';

class EmailCtrl {
    
    protected $_res = 0;
    
    public function criarListaEmails(){
       $emailDAO = new EmailDAO();
       $this->_res = $emailDAO->criarListaEmails();
    }
    
    public function getResposta() {
        return $this->_res;
    }
}
?>
