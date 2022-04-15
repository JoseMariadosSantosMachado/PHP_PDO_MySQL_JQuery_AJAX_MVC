<?php
#1.0.1
error_reporting(Debug::Show);
$r = '';
/*Variavel para não editar o valor da variavel value do href*/
$table_d = '';
$table_u = '';
$table_p = '';
$table_v = '';
if(is_array($arr_funcionario)){
    foreach($arr_funcionario as $value) {
        $table_v .= 'arr_funcionario_v.push('.$value[FUNCIONARIO::codigo].');';
        $r .= '<tr>';
        $r .= '<td>'.$value[FUNCIONARIO::nome].'</td>';
        $r .= '<td>'.$value[FUNCIONARIO::cpf].'</td>';
        $r .= '<td>'.$value[FUNCIONARIO::funcao].'</td>';
        $r .= '<td>'.$value[FUNCIONARIO::senha].'</td>';
        $r .= '<td>'.$value[FUNCIONARIO::status].'</td>';
        $r .= '<td class="text-right">';
        
        $r .= '<a href="javascript:void(0)"';
        $r .= ' id="V"';
        $r .= ' title="Clique aqui para Visualizar"';
        $r .= ' value="'.$value[FUNCIONARIO::codigo].'"';
        $r .= ' class="btn btn-xs bg-gradient-'.$_SESSION['btn-color'].'">';
        $r .= ' <i class="fa fa-edit"></i> <h7 class="d-sm-inline d-none"> Visualizar</h7>';
        $r .= '</a>';
        $u = '';
        $u .= '<a href="javascript:void(0)"';
        $u .= ' id="V"';
        $u .= ' title="Clique aqui para Visualizar"';
        $u .= ' value="'.$value[FUNCIONARIO::codigo].'"';
        $u .= ' class="btn btn-xs bg-gradient-'.$_SESSION['btn-color'].'">';
        $u .= ' <i class="fa fa-edit"></i> <h7 class="d-sm-inline d-none"> Visualizar</h7>';
        $u .= '</a>';
        $table_u .= 'arr_funcionario_u.push(\''. $u.'\');';
        
        $r .= ' <a href="javascript:void(0)"';
        $r .= ' id="P"';
        $r .= ' title="Clique aqui para Imprimir"';
        $r .= ' value="'.$value[FUNCIONARIO::codigo].'"';
        $r .= ' class="btn btn-xs bg-gradient-'.$_SESSION['btn-color'].'">';
        $r .= ' <i class="fa fa-print"></i> <h7 class="d-sm-inline d-none"> Imprimir</h7>';
        $r .= '</a>';
        $p = '';
        $p .= '<a href="javascript:void(0)"';
        $p .= ' id="P"';
        $p .= ' title="Clique aqui para Imprimir"';
        $p .= ' value="'.$value[FUNCIONARIO::codigo].'"';
        $p .= ' class="btn btn-xs bg-gradient-'.$_SESSION['btn-color'].'">';
        $p .= ' <i class="fa fa-print"></i> <h7 class="d-sm-inline d-none"> Imprimir</h7>';
        $p .= '</a>';
        $table_p .= 'arr_funcionario_p.push(\''. $p.'\');';
        
        
        $r .= ' <a href="javascript:void(0)"';
        $r .= ' id="D"';
        $r .= ' title="Clique aqui para excluir"';
        $r .= ' value="'. $value[FUNCIONARIO::codigo].'"';
        $r .= ' class="btn btn-xs bg-gradient-danger">';
        $r .= ' <i class="fa fa-trash"></i> <h7 class="d-sm-inline d-none"> Excluir</h7>';
        $r .= '</a>';
        $d = '';
        $d .= '<a href="javascript:void(0)"';
        $d .= ' id="D"';
        $d .= ' title="Clique aqui para excluir"';
        $d .= ' value="'.$value[FUNCIONARIO::codigo].'"';
        $d .= ' class="btn btn-xs bg-gradient-danger">';
        $d .= ' <i class="fa fa-trash"></i> <h7 class="d-sm-inline d-none"> Excluir</h7>';
        $d .= '</a>';
        $table_d .= 'arr_funcionario_d.push(\''. $d.'\');';
        
        $r .= '</td>';
        $r .= '</tr>';
    }
    if(sizeof($arr_funcionario) < 1){
        $r .= '<tr>';
        $r .= '<td colspan="6">Nenhum funcionario encontrado;</td>';
        $r .= '</tr>';
    }
}else{
    $r .= '<tr>';
    $r .= '<td colspan="6">Nenhum funcionario encontrado;</td>';
    $r .= '</tr>';
}
echo $r;
echo '<script>'.$table_v.';'.$table_u.';'.$table_p.';'.$table_d.'</script>';
?>
