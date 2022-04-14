<?php
#1.0.1
error_reporting(Debug::Show);
    include_once URL::funcionario(URL::models);

    /*
    *funcao create
    */
    function create(){
        $cls_funcionario = new cls_funcionario();
    
        $s = false;
        $r = '';
        $m = 'Erro ';
    
        if(
            filter_has_var(INPUT_POST, FUNCIONARIO::nome) &&
            filter_has_var(INPUT_POST, FUNCIONARIO::cpf) &&
            filter_has_var(INPUT_POST, FUNCIONARIO::funcao) &&
            filter_has_var(INPUT_POST, FUNCIONARIO::senha) &&
            filter_has_var(INPUT_POST, FUNCIONARIO::status)
        ){
    
            $cls_funcionario->nome = filter_input(INPUT_POST, FUNCIONARIO::nome, FILTER_SANITIZE_STRING);
            $cls_funcionario->cpf = filter_input(INPUT_POST, FUNCIONARIO::cpf, FILTER_SANITIZE_STRING);
            $cls_funcionario->funcao = filter_input(INPUT_POST, FUNCIONARIO::funcao, FILTER_SANITIZE_NUMBER_INT);
            $cls_funcionario->senha = filter_input(INPUT_POST, FUNCIONARIO::senha, FILTER_SANITIZE_STRING);
            $cls_funcionario->status = filter_input(INPUT_POST, FUNCIONARIO::status, FILTER_SANITIZE_NUMBER_INT);
    
            if($cls_funcionario->create() !== false){
                $s = true;
                $r = $cls_funcionario->codigo;
                $m = 'funcionario inserido com sucesso';
            }else{
                $s = false;
                $r = $cls_funcionario->error;
                $m = 'Erro ao inserir funcionario';
            }
        }else{
            $s = false;
            $m = 'Preencha todos os campos';
        }
        echo json_encode(array('s'=>$s,'r'=>$r, 'm'=>$m));
    }
    /*
    *funcao update
    */
    function update(){
        $cls_funcionario = new cls_funcionario();
    
        $s = false;
        $r = '';
        $m = 'Erro ';
    
        if(
            filter_has_var(INPUT_POST, FUNCIONARIO::codigo) &&
            filter_has_var(INPUT_POST, FUNCIONARIO::nome) &&
            filter_has_var(INPUT_POST, FUNCIONARIO::cpf) &&
            filter_has_var(INPUT_POST, FUNCIONARIO::funcao) &&
            filter_has_var(INPUT_POST, FUNCIONARIO::senha) &&
            filter_has_var(INPUT_POST, FUNCIONARIO::status)
        ){
    
            $cls_funcionario->codigo = filter_input(INPUT_POST, FUNCIONARIO::codigo, FILTER_SANITIZE_NUMBER_INT);
            $cls_funcionario->nome = filter_input(INPUT_POST, FUNCIONARIO::nome, FILTER_SANITIZE_STRING);
            $cls_funcionario->cpf = filter_input(INPUT_POST, FUNCIONARIO::cpf, FILTER_SANITIZE_STRING);
            $cls_funcionario->funcao = filter_input(INPUT_POST, FUNCIONARIO::funcao, FILTER_SANITIZE_NUMBER_INT);
            $cls_funcionario->senha = filter_input(INPUT_POST, FUNCIONARIO::senha, FILTER_SANITIZE_STRING);
            $cls_funcionario->status = filter_input(INPUT_POST, FUNCIONARIO::status, FILTER_SANITIZE_NUMBER_INT);
    
            if($cls_funcionario->update() !== false){
                $s = true;
                $r = $cls_funcionario->codigo;
                $m = 'funcionario atualizado com sucesso';
            }else{
                $s = false;
                $r = $cls_funcionario->error;
                $m = 'Erro ao atualizar funcionario';
            }
        }else{
            $s = false;
            $m = 'Preencha todos os campos';
        }
        echo json_encode(array('s'=>$s,'r'=>$r, 'm'=>$m));
    }
    /*
    *funcao delete
    */
    function delete(){
        $cls_funcionario = new cls_funcionario();
    
        $s = false;
        $r = '';
        $m = 'Erro ';
    
        if(filter_has_var(INPUT_POST, FUNCIONARIO::codigo)){
            $cls_funcionario->codigo = filter_input(INPUT_POST, FUNCIONARIO::codigo, FILTER_SANITIZE_NUMBER_INT);
    
            if($cls_funcionario->delete() !== false){
                $s = true;
                $r = $cls_funcionario->codigo;
                $m = 'funcionario excluído com sucesso';
            }else{
                $s = false;
                $r = $cls_funcionario->error;
                $m = 'Erro ao excluir funcionario';
            }
        }else{
            $s = false;
            $m = 'Preencha todos os campos';
        }
    
        echo json_encode(array('s'=>$s,'r'=>$r, 'm'=>$m));
    }
    /*
    *funcao read
    */
    function read(){
        $cls_funcionario = new cls_funcionario();
    
        $arr_funcionario = $cls_funcionario->read(filter_input(INPUT_POST, FUNCIONARIO::nome, FILTER_SANITIZE_STRING));
    
    	  include_once Views::funcionario_fgt;
    }
    /*
    *funcao select2
    */
    function select2(){
        $cls_funcionario = new cls_funcionario();

        echo $cls_funcionario->select2(filter_input(INPUT_POST, FUNCIONARIO::nome, FILTER_SANITIZE_STRING));
    }
    /*
    *funcao select
    */
    function select(){
        $cls_funcionario = new cls_funcionario();

        $cls_funcionario->codigo = filter_input(INPUT_POST, FUNCIONARIO::codigo, FILTER_SANITIZE_NUMBER_INT);
        $arr_funcionario = $cls_funcionario->select();

        switch (filter_input(INPUT_POST, 'F', FILTER_SANITIZE_STRING)){
            case 'C':
                $_SESSION['form_principal'] = 'URL:"'.URL::funcionario().'",M:"S",'.FUNCIONARIO::codigo.':"'.$arr_funcionario[0][FUNCIONARIO::codigo].'"';

                $form = 'card';
                $form_btn_close = 'data-card-widget="remove"';
                $form_close = 'funcionario_mnt.fechar();';
                break;
            case 'M':
                $form = 'modal-content';
                $form_btn_close = 'data-dismiss="modal"';
                $form_close = 'modal.close_modal(modal_funcionario);';
                break;
            default:
                $_SESSION['form_principal'] = 'URL:"'.URL::funcionario().'",M:"S",'.FUNCIONARIO::codigo.':"'.$arr_funcionario[0][FUNCIONARIO::codigo].'"';

                $form = 'card';
                $form_btn_close = 'data-card-widget="remove"';
                $form_close = 'funcionario_mnt.fechar();';
                break;
        }

    	 include_once Views::funcionario_mnt;
    }
    /*
    *funcao view
    */
    function view(){
    	 include_once Views::funcionario_src;

       $_SESSION['form_principal'] = 'URL:"'.URL::funcionario().'",M:"V"';
    }
    /*
    *funcao print_
    */
    function print_(){
        $cls_funcionario = new cls_funcionario();

        $cls_funcionario->codigo = filter_input(INPUT_POST, FUNCIONARIO::codigo, FILTER_SANITIZE_NUMBER_INT);
        $arr_funcionario = $cls_funcionario->print_();

        switch (filter_input(INPUT_POST, 'F', FILTER_SANITIZE_STRING)){
            case 'C':
                $_SESSION['form_principal'] = 'URL:"'.URL::funcionario().'",M:"P",'.FUNCIONARIO::codigo.':"'.$arr_funcionario[0][FUNCIONARIO::codigo].'"';

                $form = 'card';
                $form_btn_close = 'data-card-widget="remove"';
                $form_close = 'funcionario_vie.fechar();';
                break;
            case 'M':
                $form = 'modal-content';
                $form_btn_close = 'data-dismiss="modal"';
                $form_close = 'modal.close_modal(modal_funcionario);';
                break;
            default:
                $_SESSION['form_principal'] = 'URL:"'.URL::funcionario().'",M:"P",'.FUNCIONARIO::codigo.':"'.$arr_funcionario[0][FUNCIONARIO::codigo].'"';

                $form = 'card';
                $form_btn_close = 'data-card-widget="remove"';
                $form_close = 'funcionario_vie.fechar();';
                break;
        }

    	 include_once Reports::funcionario_vie;
    }
    /*
    *funcao switch
    */
    if(filter_has_var(INPUT_POST, 'M')){
        $crud = array('?'=>'?', 'C'=>'C', 'R'=>'R', 'U'=>'U', 'D'=>'D', 'S'=>'S', 'P'=>'P', 'V'=>'V', 'SS'=>'SS');
        $metodo = filter_input(INPUT_POST, 'M', FILTER_SANITIZE_STRING);
        switch($crud[$metodo]){
            case '?':
                empty(filter_input(INPUT_POST, FUNCIONARIO::codigo, FILTER_SANITIZE_NUMBER_INT)) ? create() : update();
                break;
            case 'C':
                create();
                break;
            case 'R':
                read();
                break;
            case 'U':
                update();
                break;
            case 'D':
                delete();
                break;
            case 'S':
                select();
                break;
            case 'P':
                print_();
                break;
            case 'V':
                view();
                break;
            case 'SS':
                select2();
                break;
            default:
                echo Session::Reload();
                break;
        }
    }else{
        echo Session::Reload();
    }
?>
