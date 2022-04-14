<?php
#1.0.1
    session_start();
    error_reporting(Debug::Show);
    if(empty($_SESSION['funcionario_cpf']) && empty(filter_input(INPUT_POST, URL::class, FILTER_SANITIZE_SPECIAL_CHARS))){
        include Views::login;
    }else{
        if(filter_input(INPUT_POST, URL::class, FILTER_SANITIZE_SPECIAL_CHARS) && !empty(filter_input(INPUT_POST, URL::class, FILTER_SANITIZE_SPECIAL_CHARS))){
            $url = filter_input(INPUT_POST, URL::class, FILTER_SANITIZE_SPECIAL_CHARS);
            
            $reflector = new ReflectionClass(URL::class);
            $parameters = $reflector->getMethods();
            foreach($parameters as $param){
                if((URL::class.'::'.$param->name)(URL::decode) == $url){
                    if(file_exists((URL::class.'::'.$param->name)(URL::controllers))){
                        include (URL::class.'::'.$param->name)(URL::controllers);
                        exit();
                    }else{
                        echo Session::Reload();
                    }
                }
            }
        }else{
            include Views::principal;
        }
    }
?>
