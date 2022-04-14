<?php
#1.0.1
class Cls_conexao {
    public $conexao;
    public $params;

    private $database_url = "IP ou Host";
    private $database_uid = "root";
    private $database_pwd = "";
    private $database_name = "database_name";

    public function __get($name){
        return $this->$name;
    }
    public function __construct(){
        error_reporting(Debug::Show);
        try{
            $this->conexao = new PDO(
                "mysql:host=$this->database_url; ".
                "dbname=$this->database_name",
                $this->database_uid,
                $this->database_pwd,
                array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8")
            );
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }
}
class Log {
    public static function log_create($funcionario, $tabela, $id, $crud){
        $conexao = new Cls_conexao();
        $query
                = "INSERT INTO" 
                . " log( "
                . " funcionario, "
                . " tabela, "
                . " id, "
                . " crud "
                . ") VALUES( "
                . " :funcionario,"
                . " :tabela, "
                . " :id, "
                . " :crud "
                . " );";
        
        $params = $conexao->conexao->prepare($query);
        
        $params->bindParam(':funcionario', $funcionario, PDO::PARAM_STR);
        $params->bindParam(':tabela', $tabela, PDO::PARAM_STR);
        $params->bindParam(':id', $id, PDO::PARAM_STR);
        $params->bindParam(':crud', $crud, PDO::PARAM_STR);
        
        $params->execute();
    }
}
?>
