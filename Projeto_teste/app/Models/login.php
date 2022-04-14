<?php
#1.0.1
error_reporting(Debug::Show);
include_once Config::Cls_conexao;
class LOGIN{
    public static function funcionario_cpf(){
        return Encripty::encript('funcionario_cpf');
    }
    public static function funcionario_senha(){
        return Encripty::encript('funcionario_senha');
    }
}
class cls_login extends cls_conexao{
    public $erro;

    private $funcionario_cpf;
    private $funcionario_senha;

    public function __set($name, $value){
        $this->$name = $value;
    }
    public function __get($name){
        return $this->$name;
    }

    public function login_funcionario(){
        $query
                = "SELECT"
                . " funcionario_cpf, " 
                . " funcionario_cpf " 
                . " FROM"
                . " funcionario " 
                . " WHERE " 
                . " funcionario_cpf = :funcionario_cpf"
                . " AND "
                . " funcionario_senha = :funcionario_senha;";

        $this->params = $this->conexao->prepare($query);

        $this->params->bindParam(':funcionario_cpf', $this->funcionario_cpf, PDO::PARAM_STR);
        $this->params->bindParam(':funcionario_senha', $this->funcionario_senha, PDO::PARAM_STR);

        try{ 
          if($this->params->execute() !== false){ 
            if($this->params->rowCount() > 0){
                $r = $this->params->fetch();

                $_SESSION["funcionario_cpf"] = $r[0];
                $_SESSION["funcionario_cpf"] = $r[1];

                $_SESSION['btn-color'] = "blue";
                $_SESSION['card-color'] = "blue";
                $_SESSION['dgv-color'] = "blue";
                $_SESSION['navbar-color'] = "blue";
                $_SESSION['sidebar-btn-color'] = "blue";
                $_SESSION['sidebar-bgd-color'] = "light";
                $_SESSION['footer-color'] = "gray";
                $_SESSION['logo-color'] = "blue";

                #$this->permissao();
                #$this->personalizacao();
                return true;
            }else{
                $this->erro = $this->mysqli_error;
                return false;
            }
          }else{
            $this->erro = $this->mysqli_error;
            return false;
          }
        }catch(PDOException $e){
            $this->error =  $e->getMessage();
            return false;
        }
    }
    function permissao(){
        $query
                = "SELECT"
                . " permissao_tabela.nome AS 'nome',"
                . " permissao_tabela.alias AS 'alias',"
                . " permissao_tabela.icone AS 'icone',"
                . " IF(funcionario_permissao.C = '1', 'true', 'false') AS 'C',"
                . " IF(funcionario_permissao.R = '1', 'true', 'false') AS 'R',"
                . " IF(funcionario_permissao.U = '1', 'true', 'false') AS 'U',"
                . " IF(funcionario_permissao.D = '1', 'true', 'false') AS 'D',"
                . " IF(funcionario_permissao.V='1','true','false') AS 'V',"
                . " IF(funcionario_permissao.P='1','true','false') AS 'P'"
                . " FROM"
                . " funcionario_permissao"
                . " INNER JOIN permissao_tabela"
                . " ON permissao_tabela.codigo = funcionario_permissao.tabela"
                . " WHERE"
                . " funcionario_permissao.funcionario = :funcionario;";

        $this->params = $this->conexao->prepare($query);

        $this->params->bindParam(':funcionario', $_SESSION['funcionario_cpf'], PDO::PARAM_INT);

        if($this->params->execute() !== false){
          foreach ($this->params as $value) {
            $tabela_array[$value['nome']] =
                array(
                    'nome'=>$value['nome'],
                    'alias'=>$value['alias'],
                    'icone'=>$value['icone'],
                    'C'=>$value['C'],
                    'R'=>$value['R'],
                    'U'=>$value['U'],
                    'D'=>$value['D'],
                    'V'=>$value['V'],
                    'P'=>$value['P']
                );
          }
          $_SESSION[Config::Permissao] = $tabela_array;
        }
    }
    function personalizacao(){
		  $query
                = "SELECT"
                . " tag_componente.nome AS 'nome',"
                . " tag_color.cor AS 'cor'"
                . " FROM"
                . " funcionario_personalizar"
                . " INNER JOIN tag_componente ON componente = tag_componente.codigo"
                . " INNER JOIN tag_color ON funcionario_personalizar.cor = tag_color.codigo"
                . " WHERE"
                . " funcionario_personalizar.funcionario = :funcionario;";

        $this->params = $this->conexao->prepare($query);

        $this->params->bindParam(':funcionario', $_SESSION['funcionario_cpf'], PDO::PARAM_INT);

        if($this->params->execute() !== false){
            foreach ($this->params as $value) {
		          $_SESSION[$value['nome']] = $value['cor'];
		      }
		  }
    }
}
?>
