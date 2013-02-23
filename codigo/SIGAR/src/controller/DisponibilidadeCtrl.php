<?php

require_once 'C:/xampp/htdocs/SIGAR/codigo/SIGAR/src/DAO/DisponibilidadeDAO.php';

/**
 * Description of DisponibilidadeCtrl
 *
 * @author Hebert
 */
class DisponibilidadeCtrl {

    public function adicionarDisponibilidade($idProfessor, $diaDaSemana, $descricaoHorario) {
        $disponibilidade_obj = new DisponibilidadeDAO();

        $idDisponibilidade = $disponibilidade_obj->selecionarIdDisponibilidade($idProfessor);
        $idDia = $disponibilidade_obj->selecionarIdDia($idDisponibilidade, $diaDaSemana);
        
        //Verifica se o dia da semana já existe com aquele idDisponibilidade
        if($idDia != 0){
            //O idDia já existe, não é necessário cadastrar novo IdDia
        }else{
            //O idDia não existe cadastrar novo DIA
           $idDia = $disponibilidade_obj->salvarDia($idDisponibilidade, $diaDaSemana);     
        }
        

        if ($idDia == 0) {
            echo "Erro ao salvar na tabela dia";
        } else {
            $idHorario = $disponibilidade_obj->salvarHorario($idDia, $descricaoHorario);
            if ($idHorario == 0) {
                echo "Erro ao salvar na tabela horario";
            }
        }
    }

    public function deletarDisponibilidade($idProfessor) {
        $disponibilidade_obj = new DisponibilidadeDAO();

        $idDisponibilidade = $disponibilidade_obj->selecionarIdDisponibilidade($idProfessor);
        if ($idDisponibilidade == 0) {
            echo "Erro ao selecionar idDisponibilidade";
        }

        $arrayIdDia = $disponibilidade_obj->selecionarArrayIdDia($idDisponibilidade);

        if (mysql_num_rows($arrayIdDia) > 0) {
            for ($i = 0; $i < mysql_num_rows($arrayIdDia); $i++) {
                $idDia = mysql_result($arrayIdDia, $i, 'idDia');
                if ($disponibilidade_obj->deletarHorario($idDia) == 0) {
                    echo "Erro ao deletar um horário";
                }
            }
        }

        $res = $disponibilidade_obj->deletarDia($idDisponibilidade);
        if($res == 0 ){
            return 0;
        }else{
            return 1;
        }
    }

}

?>