<?php
#1.0.1
error_reporting(Debug::Show);
include_once Config::Cls_conexao;

    /*
    *Classe estatica
    */
    class FUNCIONARIO{
        const FUNCIONARIO = 'funcionario';
        const SRC = 'funcionario_src_';
        const MNT = 'funcionario_mnt_';
        const PNT = 'funcionario_pnt_';
        const btn_novo = 'btn_novo';
        const btn_voltar = 'btn_voltar';
        const btn_imprimir = 'btn_imprimir';
        const dgv_funcionario = 'dgv_funcionario';

        const codigo = 'codigo';
        const nome = 'nome';
        const cpf = 'cpf';
        const funcao = 'funcao';
        const senha = 'senha';
        const status = 'status';
    }

class cls_funcionario extends Cls_conexao{
    public $error;
    //variaveis privadas
    private $codigo;
    private $nome;
    private $cpf;
    private $funcao;
    private $senha;
    private $status;

    //variaveis publicas
    public function __set($name, $value){
        $this->$name = $value;
    }
    public function __get($name){
        return $this->$name;
    }

    /*
    *funcao create
    */
    public function create(){
        $query
                = "INSERT INTO" 
                . " funcionario( "
                . " nome, "
                . " cpf, "
                . " funcao, "
                . " senha, "
                . " status "
                . " ) VALUES( "
                . " :nome, "
                . " :cpf, "
                . " :funcao, "
                . " :senha, "
                . " :status "
                . " );";

        $this->params = $this->conexao->prepare($query);

        $this->params->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $this->params->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
        $this->params->bindParam(':funcao', $this->funcao, PDO::PARAM_INT);
        $this->params->bindParam(':senha', $this->senha, PDO::PARAM_STR);
        $this->params->bindParam(':status', $this->status, PDO::PARAM_INT);

        try{
            if($this->params->execute() !== false){
                $this->codigo = $this->conexao->lastInsertId();
                return true;
            }else{
                $this->error = $this->conexao->error;
                return false;
            }
        } catch (PDOException $e) {
            $this->error =  $e->getMessage();
            return false;
        }
    }
    /*
    *funcao update
    */
    public function update(){
        $query
                = "UPDATE "
                . " funcionario "
                . " SET "
                . " nome = :nome , "
                . " cpf = :cpf , "
                . " funcao = :funcao , "
                . " senha = :senha , "
                . " status = :status "
                . " WHERE "
                . " codigo = :codigo ;";

        $this->params = $this->conexao->prepare($query);

        $this->params->bindParam(':codigo', $this->codigo, PDO::PARAM_INT);
        $this->params->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $this->params->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
        $this->params->bindParam(':funcao', $this->funcao, PDO::PARAM_INT);
        $this->params->bindParam(':senha', $this->senha, PDO::PARAM_STR);
        $this->params->bindParam(':status', $this->status, PDO::PARAM_INT);

        try{
            if($this->params->execute() !== false){
                return true;
            }else{
                $this->error = $this->conexao->error;
                return false;
            }
        } catch (PDOException $e) {
            $this->error =  $e->getMessage();
            return false;
        }
    }
    /*
    *funcao delete
    */
    public function delete(){
        $query
                = "DELETE" 
                . " FROM" 
                . " funcionario" 
                . " WHERE" 
                . " codigo = :codigo ;";

        $this->params = $this->conexao->prepare($query);

        $this->params->bindParam(':codigo', $this->codigo, PDO::PARAM_INT);


        try{
            if($this->params->execute() !== false){
                return true;
            }else{
                $this->error = $this->conexao->error;
                return false;
            }
        } catch (PDOException $e) {
            $this->error =  $e->getMessage();
            return false;
        }
    }
    /*
    *funcao read
    */
    public function read($nome){
    	  $query
            	  = "SELECT "
            	  . " codigo AS codigo , "
            	  . " nome AS nome , "
            	  . " cpf AS cpf , "
            	  . " funcao AS funcao , "
            	  . " senha AS senha , "
            	  . " IF(status='1','Ativo','Inativo') AS status "
            	  . " FROM" 
            	  . " funcionario "
            	  . " WHERE "
                . " nome LIKE CONCAT('%',:nome,'%') "
            	  . " ORDER BY" 
            	  . " nome" 
            	  . " LIMIT 15;";

        $this->params = $this->conexao->prepare($query);

        $this->params->bindParam(':nome', $nome, PDO::PARAM_STR);

  	$arr_funcionario = array();
        try{
            if($this->params->execute() !== false){
	      	foreach ($this->params as $value) {
	      		array_push($arr_funcionario,
				array(
				  'codigo'=>$value['codigo'],
				  'nome'=>$value['nome'],
				  'cpf'=>$value['cpf'],
				  'funcao'=>$value['funcao'],
				  'senha'=>$value['senha'],
				  'status'=>$value['status']
                	      )
            	      	);
	      }
	  }
        } catch (PDOException $e) {
            echo $query.'<br><br>';
            echo $e->getMessage();
            exit();
        }
  	return $arr_funcionario;
    }
    /*
    *funcao read para select2 $ajax
    */
    public function select2($nome){
	  $query
		  = "SELECT "
		  . " codigo AS codigo , "
		  . " nome AS nome , "
		  . " cpf AS cpf , "
		  . " funcao AS funcao , "
		  . " senha AS senha , "
		  . " status AS status "
		  . " FROM "
		  . " funcionario "
		  . " WHERE "
		  . " nome LIKE :nome "
            	  . " ORDER BY" 
            	  . " nome" 
            	  . " LIMIT 15;";

        $this->params = $this->conexao->prepare($query);

        $nome = '%'.$nome.'%';
        $this->params->bindParam(':nome', $nome, PDO::PARAM_STR);


    	  $arr_funcionario = array();
    	  $arr_funcionario['results'] = array();

        try{
            if($this->params->execute() !== false){
        	      foreach ($this->params as $value) {
                    $array = array();

                $array['id'] = $value['codigo'];
                $array['text'] = $value['nome'];
                $array['nome'] = $value['nome'];
                $array['cpf'] = $value['cpf'];
                $array['funcao'] = $value['funcao'];
                $array['senha'] = $value['senha'];
                $array['status'] = $value['status'];

                array_push($arr_funcionario['results'], $array);
        	      }
        	  }
        } catch (PDOException $e) {
            echo $query.'<br><br>';
            echo $e->getMessage();
            exit();
        }
    	  return json_encode($arr_funcionario);
	  }
    /*
    *funcao select
    */
    public function select_union($codigo){
    	  $query
            	  = "SELECT "
            	  . " codigo AS codigo , "
            	  . " nome AS nome , "
            	  . " cpf AS cpf , "
            	  . " funcao AS funcao , "
            	  . " senha AS senha , "
            	  . " status AS status "
            	  . " FROM "
            	  . " funcionario "
            	  . " WHERE "
                . " codigo = :codigo "
            	  . " UNION "
            	  . " SELECT "
            	  . " codigo AS codigo , "
            	  . " nome AS nome , "
            	  . " cpf AS cpf , "
            	  . " funcao AS funcao , "
            	  . " senha AS senha , "
            	  . " status AS status "
            	  . " FROM "
            	  . " funcionario "
            	  . " WHERE "
                . " codigo != :codigo ;";

        $this->params = $this->conexao->prepare($query);
        $this->params->bindParam(':codigo', $codigo, PDO::PARAM_INT);

    	  $arr_funcionario = array();
        if($this->params->execute() !== false){
        	 foreach ($this->params as $value) {
            	  array_push($arr_funcionario,
                	  array(
                    	  'codigo'=>$value['codigo'],
                    	  'nome'=>$value['nome'],
                    	  'cpf'=>$value['cpf'],
                    	  'funcao'=>$value['funcao'],
                    	  'senha'=>$value['senha'],
                    	  'status'=>$value['status']
                	  )
            	  );
        	  }
    	  }
    	  return $arr_funcionario;
	  }
    /*
    *funcao select
    */
    public function select(){
    	  $query
            	  = "SELECT "
            	  . " codigo AS codigo , "
            	  . " nome AS nome , "
            	  . " cpf AS cpf , "
            	  . " funcao AS funcao , "
            	  . " senha AS senha , "
            	  . "  IF(status='1','checked','') AS status "
            	  . " FROM "
            	  . " funcionario "
            	  . " WHERE "
                . " codigo = :codigo ;";

        $this->params = $this->conexao->prepare($query);
        $this->params->bindParam(':codigo', $this->codigo, PDO::PARAM_INT);

    	  $arr_funcionario = array();
        try{
            if($this->params->execute() !== false){
        	      foreach ($this->params as $value) {
            	      array_push($arr_funcionario,
                	      array(
                    	      'codigo'=>$value['codigo'],
                    	      'nome'=>$value['nome'],
                    	      'cpf'=>$value['cpf'],
                    	      'funcao'=>$value['funcao'],
                    	      'senha'=>$value['senha'],
                	          'status'=>$value['status']
                	      )
            	      );
        	      }
        	  }
        } catch (PDOException $e) {
            echo $query.'<br><br>';
            echo $e->getMessage();
            exit();
        }
    	  return $arr_funcionario;
	  }
    /*
    *funcao print_
    */
    public function print_(){
    	  $query
            	  = "SELECT "
            	  . " codigo AS codigo , "
            	  . " nome AS nome , "
            	  . " cpf AS cpf , "
            	  . " funcao AS funcao , "
            	  . " senha AS senha , "
            	  . " status AS status "
            	  . " FROM "
            	  . " funcionario "
            	  . " WHERE "
                . " codigo = :codigo ;";
        $this->params = $this->conexao->prepare($query);
        $this->params->bindParam(':codigo', $this->codigo, PDO::PARAM_INT);

    	  $arr_funcionario = array();
        if($this->params->execute() !== false){
        	 foreach ($this->params as $value) {
            	  array_push($arr_funcionario,
                	  array(
                    	  'codigo'=>$value['codigo'],
                    	  'nome'=>$value['nome'],
                    	  'cpf'=>$value['cpf'],
                    	  'funcao'=>$value['funcao'],
                    	  'senha'=>$value['senha'],
                    	  'status'=>$value['status']
                	  )
            	  );
        	  }
    	  }
    	  return $arr_funcionario;
	  }
}
?>
