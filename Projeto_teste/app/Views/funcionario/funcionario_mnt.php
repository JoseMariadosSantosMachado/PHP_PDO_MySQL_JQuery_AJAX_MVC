<?php #versao: 1.0.0;?>
<div class="<?php echo $form;?>" style="overflow-y: auto;height: auto">
    <div class="card-header bg-gradient-<?php echo $_SESSION['card-color'];?>">
        <h3 class="card-title"><i class="<?php echo $_SESSION[Config::Permissao]['funcionario']['icone'];?>"></i> <label>Funcionario</label></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" <?php echo $form_btn_close;?> title="Clique aqui para fechar este formulário"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <form id="<?php echo FUNCIONARIO::MNT;?>">
        <div class="card-body" style="overflow-y: auto;min-height: 120px;">
            <div class="row">
                <div class="form-group col-xs-12 col-sm-1 col-md-1">
                    <label>Codigo</label>
                    <input
                        type="text"
                        class="form-control"
                        id="<?php echo FUNCIONARIO::MNT.FUNCIONARIO::codigo;?>"
                        value="<?php echo $arr_funcionario[0][FUNCIONARIO::codigo];?>"
                        readonly="readonly"/>
                </div>
                <div class="form-group col-xs-12 col-sm-4 col-md-4">
                    <label>Nome</label>
                    <input
                        type="text"
                        class="form-control"
                        id="<?php echo FUNCIONARIO::MNT.FUNCIONARIO::nome;?>"
                        value="<?php echo $arr_funcionario[0][FUNCIONARIO::nome];?>"
                        required="required"/>
                </div>
                <div class="form-group col-xs-12 col-sm-4 col-md-4">
                    <label>Cpf</label>
                    <input
                        type="text"
                        class="form-control"
                        id="<?php echo FUNCIONARIO::MNT.FUNCIONARIO::cpf;?>"
                        value="<?php echo $arr_funcionario[0][FUNCIONARIO::cpf];?>"
                        required="required"/>
                </div>
                <div class="form-group col-xs-12 col-sm-3 col-md-3">
                    <label>Funcao</label>
                    <input
                        type="text"
                        class="form-control"
                        id="<?php echo FUNCIONARIO::MNT.FUNCIONARIO::funcao;?>"
                        value="<?php echo $arr_funcionario[0][FUNCIONARIO::funcao];?>"
                        required="required"/>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                    <label>Senha</label>
                    <input
                        type="text"
                        class="form-control"
                        id="<?php echo FUNCIONARIO::MNT.FUNCIONARIO::senha;?>"
                        value="<?php echo $arr_funcionario[0][FUNCIONARIO::senha];?>"
                        required="required"/>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-4">
                    <label>Status</label>
                    <input
                        type="checkbox"
                        class="form-control"
                        id="<?php echo FUNCIONARIO::MNT.FUNCIONARIO::status;?>"
                        <?php echo $arr_funcionario[0][FUNCIONARIO::status];?>
                        />
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button
                type="button"
                id="<?php echo FUNCIONARIO::MNT.FUNCIONARIO::btn_voltar;?>"
                title="Clique aqui para voltar"
                class="btn bg-gradient-secondary">
                <i class="fa fa-angle-left"></i> Voltar
            </button>
<?php if(isset($_SESSION[Config::Permissao]['funcionario']['C']) && $_SESSION[Config::Permissao]['funcionario']['C'] == 'true' ||
        isset($_SESSION[Config::Permissao]['funcionario']['U']) && $_SESSION[Config::Permissao]['funcionario']['U'] == 'true'){?>
            <button
                type="submit"
                id="<?php echo FUNCIONARIO::MNT;?>A"
                value="1"
                title="Clique aqui para Salvar"
                class="btn bg-gradient-<?php echo $_SESSION['btn-color'];?> float-right">
                <i class="fa fa-save"></i> Salvar
            </button>
            <button
                type="submit"
                id="<?php echo FUNCIONARIO::MNT;?>B"
                value="0"
                title="Clique aqui para Salvar e Fechar"
                class="btn bg-gradient-<?php echo $_SESSION['btn-color'];?> float-right">
                <i class="fa fa-save"></i> Salvar e Fechar
            </button>
<?php }?>
         </div>
    </form>
</div>
<script>
    var <?php echo FUNCIONARIO::MNT.FUNCIONARIO::codigo;?>="<?php echo $arr_funcionario[0][FUNCIONARIO::codigo];?>";
    var frm_funcionario_mnt=class frm_funcionario_mnt{
<?php if(isset($_SESSION[Config::Permissao]['funcionario']['C']) && $_SESSION[Config::Permissao]['funcionario']['C'] == 'true' ||
        isset($_SESSION[Config::Permissao]['funcionario']['U']) && $_SESSION[Config::Permissao]['funcionario']['U'] == 'true'){?>
        funcionario_salvar(x){
            var d=new FormData();
        	  d.append('URL','<?php echo URL::funcionario();?>');
            d.append('M','?');
            d.append('<?php echo FUNCIONARIO::codigo;?>',<?php echo FUNCIONARIO::MNT.FUNCIONARIO::codigo;?>);
            d.append('<?php echo FUNCIONARIO::nome;?>',$('#<?php echo FUNCIONARIO::MNT.FUNCIONARIO::nome;?>').val());
            d.append('<?php echo FUNCIONARIO::cpf;?>',$('#<?php echo FUNCIONARIO::MNT.FUNCIONARIO::cpf;?>').val());
            d.append('<?php echo FUNCIONARIO::funcao;?>',$('#<?php echo FUNCIONARIO::MNT.FUNCIONARIO::funcao;?>').val());
            d.append('<?php echo FUNCIONARIO::senha;?>',$('#<?php echo FUNCIONARIO::MNT.FUNCIONARIO::senha;?>').val());
            d.append('<?php echo FUNCIONARIO::status;?>',$('#<?php echo FUNCIONARIO::MNT.FUNCIONARIO::status;?>').is(':checked'));
            $.ajax({url:conexao,type:'POST',data:d,contentType:false,cache:false,processData:false,
                success:(r)=>{
                	 if(r){
                        try{
                	  	    var o=JSON.parse(r);
                    	    if(o.s===true){
                        	   Swal.fire({icon:'success',title:o.m,showConfirmButton:false,timer:500});
                        	   if(x==='1'){
                        	  	  $('#<?php echo FUNCIONARIO::MNT.FUNCIONARIO::codigo;?>').val(o.r);
                        	  	  <?php echo FUNCIONARIO::MNT.FUNCIONARIO::codigo;?>=o.r;
                        	   }else{
                        	  	  var funcionario_mnt=new frm_funcionario_mnt();
                        	  	  <?php echo $form_close;?>
                        	   }
                    	  	}else{
                        	   Swal.fire(o.m,'','error');
                    	  	}
                    	  }catch(e){
                        	 $('body').html(r);
                    	  }
                	  }else{
                    	  Swal.fire('Erro na conexão','','error');
                	  }
                },
                error:(r)=>{
                    console.log(r);
                },
                complete:()=>{
                    spinner.close_spinner(spinner_id);
                }
            });
        };
<?php }?>
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
    var funcionario_mnt=new frm_funcionario_mnt();
    $('[data-card-widget="remove"]').click(()=>{
        <?php echo $form_close;?>
    });
    $('#<?php echo FUNCIONARIO::MNT.FUNCIONARIO::btn_voltar;?>').click(()=>{
        <?php echo $form_close;?>
    });
    $(document).ready(()=>{
<?php if(isset($_SESSION[Config::Permissao]['funcionario']['C']) && $_SESSION[Config::Permissao]['funcionario']['C'] == 'true' ||
        isset($_SESSION[Config::Permissao]['funcionario']['U']) && $_SESSION[Config::Permissao]['funcionario']['U'] == 'true'){?>
        var frm=[];
        for(var i=0;i<document.getElementById('<?php echo FUNCIONARIO::MNT;?>').elements.length;i++){
        	  frm.push(document.getElementById('<?php echo FUNCIONARIO::MNT;?>').elements[i].outerHTML);
        }
        $('#<?php echo FUNCIONARIO::MNT;?>').on('click','#<?php echo FUNCIONARIO::MNT;?>A,#<?php echo FUNCIONARIO::MNT;?>B',function(e){
            var x=$(this).attr('value');
            $('#<?php echo FUNCIONARIO::MNT;?>').on('submit',function(e){
                e.preventDefault();
                for(var i=0;i<document.getElementById('<?php echo FUNCIONARIO::MNT;?>').elements.length;i++){
                	  if(e.target.elements[i].outerHTML!==frm[i]){
                	  	  window.location.reload();
                	  }
                }
                Swal.fire({
                    title: 'Salvar',
                    text: 'Deseja salvar estes dados?!',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: ' Sim '
                }).then((r)=>{
                    if(r.isConfirmed){
              	     spinner_id=spinner.new_spinner();
              	     setTimeout(()=>{
                    	    funcionario_mnt.funcionario_salvar(x);
              	     },100);
                    }
                });
            });
        });
<?php }?>
    });
</script>
