<?php
#1.0.1
error_reporting(Debug::Show);
?>
<script>
    var frm_funcionario_vie=class frm_funcionario_vie{
        fechar(){
           $.post(conexao,{URL:'<?php echo URL::funcionario();?>',M:'V'}).done((r)=>{
               if(r){
                   $("#<?php echo FRM_PRINCIPAL::DIV;?>").html(r);
               }else{
                   Swal.fire('Erro na conexão','','error');
               }
           });
        };
    };
    var funcionario_vie=new frm_funcionario_vie();
    $('[data-card-widget="remove"]').click(()=>{
        <?php echo $form_close;?>
    });
</script>
<div class="<?php echo $form;?>" style="overflow-y: auto;height: auto">
    <div class="card-header bg-gradient-<?php echo $_SESSION['card-color'];?>">
        <h3 class="card-title"><i class="<?php echo $_SESSION[Config::Permissao]['funcionario']['icone'];?>"></i> <label>Relatório de Funcionario</label></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" <?php echo $form_btn_close;?> title="Clique aqui para fechar este formulário"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="card-body" style="height: auto">
        <?php include Reports::funcionario_rpt;?>
    </div>
    <div class="card-footer"></div>
</div>
