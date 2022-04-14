<?php
error_reporting(Debug::Show);
    include_once URL::login(URL::models);
    function logar(){
        $login = new cls_login();
        $s = false;
        $f = 'index.php';
        $m = 'Erro ao logar';

        if(
          filter_has_var(INPUT_POST, LOGIN::funcionario_cpf()) &&
          filter_has_var(INPUT_POST, LOGIN::funcionario_senha())){

              $login->funcionario_cpf = filter_input(INPUT_POST, LOGIN::funcionario_cpf(), FILTER_SANITIZE_STRING);
              $login->funcionario_senha = filter_input(INPUT_POST, LOGIN::funcionario_senha(), FILTER_SANITIZE_STRING);

              if($login->login_funcionario() !== false){
                  $s = true;
                  $m = '';
              }else{
                  $s = false;
                  $m = 'Erro ao logar '.$login->erro;
                  session_destroy();
              }
          }else{
              $s = false;
              $m = 'Preencha todos os campos';
              session_destroy();
          }
          echo json_encode(array('s'=>$s, 'f'=>$f, 'm'=>$m ));
    }
    function logoff(){
        echo Session::Reload();
    }
    if(!filter_has_var(INPUT_POST, 'M')){
        Session::Reload();
        echo json_encode(array('s'=>false, 'f'=>'index.php', 'm'=>'Erro'));
    }else{
        $crud = array('L'=>'L', 'S'=>'S');
        $metodo = filter_input(INPUT_POST, 'M', FILTER_SANITIZE_STRING);
        switch($crud[$metodo]){
            case 'L':
                logar();
                break;
            case 'S':
                logoff();
                break;
            default:
                logoff();
                break;
        }
    }
?>
