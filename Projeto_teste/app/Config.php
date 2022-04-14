<?php
#1.0.1
error_reporting(Debug::Show);
class Config {
    const Sistema_nome = 	'projeto_teste';
    const Sistema_Alias = 	'Projeto::Teste';
    const Permissao = 		'projeto_teste';
    const App = 			'../app/';
    const Index =           Config::App.'index.php';
    const IP = 				array('127.0.0.1/');
    const Web = 			'../public/';
    const Cls_conexao = 	Config::App.'Config/Conexao.php';
    const Controllers = 	Config::App.'Controllers/';
    const Models = 			Config::App.'Models/';
    const Views = 			Config::App.'Views/';
    const Libs = 			Config::App.'Libs/';
    const Reports = 		Config::App.'Reports/';
    const Src = 			Config::App.'Src/';
}
class Host {
    const CMD = 'C:\xampp\htdocs\Projeto_teste\public>php -S 127.0.0.1:80';
    const Web = '('.Config::IP[0] . 'Projeto_teste/public/index.php|'. Config::IP[0] . 'Processo_Seletivo/public/)';
}
class Session {
    public static function Reload(){
    	session_destroy();
    	return '<script>window.location.reload();</script>';
    }
    public static function funcionario_cpf(){
    	return $_SESSION['funcionario_cpf'];
    }
    public static function form_principal(){
    	return $_SESSION['form_principal'] = 'URL:"'.URL::principal().'"';
    }
}
class Debug {
    const Show = 1;
}
class Libs {
    const PhpJasperLibrary = Config::Libs.'PhpJasperLibrary/PHPJasperXML.inc.php';
}
class Src {
    const Img = Config::Src .'img/';
    const Nav = Config::Src .'nav/';
    const Side = Config::Src .'side/';
}
class Web {
    const Style = Config::Web .'style/';
    const Script = Config::Web .'script/';
}
include_once 'Config/Views.php';
include_once 'Config/URL.php';
include_once 'Config/Reports.php';
include_once 'Config/Template.php';
?>
