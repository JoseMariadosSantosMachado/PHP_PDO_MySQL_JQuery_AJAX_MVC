<?php #versao: 1.0.0; ?>
<div class="card" style="overflow-y: auto;height: auto">
    <div class="card-header bg-gradient-<?php echo $_SESSION['card-color'];?>">
        <h3 class="card-title"><i class="<?php echo $_SESSION[Config::Permissao]['funcionario']['icone'];?>"></i> <label>Funcionario</label></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Clique aqui para fechar este formulário"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <form id="<?php echo FUNCIONARIO::SRC;?>">
    <div class="card-body" style="height: auto">
        <div class="row">
            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                <label class="control-label">Procurar Funcionario</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                         <a class="input-group-text bg-gradient-<?php echo $_SESSION['btn-color'];?>"
                            href="javascript:void(0)"
                            title="Clique aqui para Limpar o campo de pesquisa">
                            <i class="fa fa-times"></i>
                         </a>
                    </div>
                    <input type="text" class="form-control" id="<?php echo FUNCIONARIO::SRC.FUNCIONARIO::nome;?>"/>
                    <?php if(isset($_SESSION[Config::Permissao]['funcionario']['C']) && $_SESSION[Config::Permissao]['funcionario']['C'] == 'true'){?>
                    <div class="input-group-append">
                        <a class="btn bg-gradient-<?php echo $_SESSION['btn-color'];?>"
                            title="Clique aqui para Inserir novo Funcionario"
                            href="javascript:void(0)"
                            id="<?php echo FUNCIONARIO::SRC.FUNCIONARIO::btn_novo;?>"
                            value="0">
                            <i class="fa fa-plus"></i> Novo
                        </a>
                    </div>
                    <?php }?>
                    <?php if(isset($_SESSION[Config::Permissao]['funcionario']['P']) && $_SESSION[Config::Permissao]['funcionario']['P'] == 'true'){?>
                    <div class="input-group-append">
                        <a class="btn bg-gradient-<?php echo $_SESSION['btn-color'];?>"
                            title="Clique aqui para Imprimir Funcionario"
                            href="javascript:void(0)"
                            id="<?php echo FUNCIONARIO::SRC.FUNCIONARIO::btn_imprimir;?>"
                            value="0">
                            <i class="fa fa-print"></i> Imprimir
                        </a>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                <div style="overflow-y: auto; min-height: 320px; height: 50vh;">
                    <table class="table table-striped table-bordered table-hover table-sm table-head-fixed">
                        <thead>
                            <tr class="bg-light">
                                <th class="bg-gradient-<?php echo $_SESSION['dgv-color'];?>">
                                    Nome
                                </th>
                                <th class="bg-gradient-<?php echo $_SESSION['dgv-color'];?>">
                                    Cpf
                                </th>
                                <th class="bg-gradient-<?php echo $_SESSION['dgv-color'];?>">
                                    Funcao
                                </th>
                                <th class="bg-gradient-<?php echo $_SESSION['dgv-color'];?>">
                                    Senha
                                </th>
                                <th class="bg-gradient-<?php echo $_SESSION['dgv-color'];?>">
                                    Status
                                </th>
                                <th class="bg-gradient-<?php echo $_SESSION['dgv-color'];?>">
                                    <i class="fa fa-cogs"></i> Opção
                                </th>
                            </tr>
                        </thead>
                        <tbody id="<?php echo FUNCIONARIO::SRC.FUNCIONARIO::dgv_funcionario;?>"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div class="card-footer"></div>
</div>
<script>
    var arr_funcionario_v=[],arr_funcionario_u=[],arr_funcionario_p=[],arr_funcionario_d=[],modal_funcionario;
    var frm_funcionario_scr=class frm_funcionario_scr{
        dgv_funcionario(){
            arr_funcionario_v=[];arr_funcionario_u=[];arr_funcionario_p=[];arr_funcionario_d=[];
            var d=new FormData();
            d.append('URL','<?php echo URL::funcionario();?>');
            d.append('M','R');
            d.append('<?php echo FUNCIONARIO::nome;?>',$("#<?php echo FUNCIONARIO::SRC.FUNCIONARIO::nome;?>").val());
            $.ajax({url:conexao,type:'POST',data:d,contentType:false,cache:false,processData:false,
                success:(r)=>{
                	if(r){
                        $("#<?php echo FUNCIONARIO::SRC.FUNCIONARIO::dgv_funcionario;?>").html(r);
                    }else{
                        $("#<?php echo FUNCIONARIO::SRC.FUNCIONARIO::dgv_funcionario;?>").html('');
                    }
                },
                error:(r)=>{
                    console.log(r);
                },
                complete:(r)=>{
                    //console.log(r);
                }
            });
        };

<?php if(isset($_SESSION[Config::Permissao]['funcionario']['D']) && $_SESSION[Config::Permissao]['funcionario']['D'] == 'true'){?>
        funcionario_excluir(<?php echo FUNCIONARIO::codigo;?>){
            var d=new FormData();
            d.append('URL','<?php echo URL::funcionario();?>');
            d.append('M','D');
            d.append('<?php echo FUNCIONARIO::codigo;?>',<?php echo FUNCIONARIO::codigo;?>);
            $.ajax({url:conexao,type:'POST',data:d,contentType:false,cache:false,processData:false,
            	  success:(r)=>{
                	 if(r){
                        try{
                	  	    var o=JSON.parse(r);
                    	    if(o.s===true){
                        	   Swal.fire({icon:'success',title:o.m,showConfirmButton:false,timer:1000});
    						   var funcionario=new frm_funcionario_scr();
    						   funcionario.dgv_funcionario();
                    	  	}else{
                        	   Swal.fire(o.m,'','error');
                    	  	}
                    	  } catch (e) {
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

<?php if(isset($_SESSION[Config::Permissao]['funcionario']['C']) && $_SESSION[Config::Permissao]['funcionario']['C'] == 'true' ||
         isset($_SESSION[Config::Permissao]['funcionario']['V']) && $_SESSION[Config::Permissao]['funcionario']['V'] == 'true'){?>
        funcionario_mnt(<?php echo FUNCIONARIO::codigo;?>){
            var d=new FormData();
            d.append('URL','<?php echo URL::funcionario();?>');
            d.append('M','S');
            d.append('F','C');
            d.append('<?php echo FUNCIONARIO::codigo;?>',<?php echo FUNCIONARIO::codigo;?>);
            $.ajax({url:conexao,type:'POST',data:d,contentType:false,cache:false,processData:false,
                success:(r)=>{
                    if(r){
                        //modal_funcionario=modal.new_modal(r,'lg');
                        $("#<?php echo FRM_PRINCIPAL::DIV;?>").html(r);
                    }else{
                        Swal.fire('Erro na conexão','','error');
                    }
                },
                error:(r)=>{
                    console.log(r);
                },
                complete:(r)=>{
                    //console.log(r);
                }
            });
        };
<?php }?>

<?php if(isset($_SESSION[Config::Permissao]['funcionario']['P']) && $_SESSION[Config::Permissao]['funcionario']['P'] == 'true'){?>
        funcionario_print(<?php echo FUNCIONARIO::codigo;?>){
            var d=new FormData();
            d.append('URL','<?php echo URL::funcionario();?>');
            d.append('M','P');
            d.append('F','C');
            d.append('<?php echo FUNCIONARIO::codigo;?>',<?php echo FUNCIONARIO::codigo;?>);
            $.ajax({url:conexao,type:'POST',data:d,contentType:false,cache:false,processData:false,
                success:(r)=>{
                    if(r){
                        //modal_funcionario=modal.new_modal(r,'lg');
                        $("#<?php echo FRM_PRINCIPAL::DIV;?>").html(r);
                    }else{
                        Swal.fire('Erro na conexão','','error');
                    }
                },
                error:(r)=>{
                    console.log(r);
                },
                complete:(r)=>{
                    //console.log(r);
                }
            });
        };
<?php }?>

    };
    var funcionario_scr=new frm_funcionario_scr();
    funcionario_scr.dgv_funcionario();
    $('document').ready(()=>{
        $("#<?php echo FUNCIONARIO::SRC;?>").on('submit',function(e){
            e.preventDefault();
        });
        $("#<?php echo FUNCIONARIO::SRC;?>").find(".input-group-text").click((e)=>{
            e.preventDefault();
            $("#<?php echo FUNCIONARIO::SRC.FUNCIONARIO::nome;?>").val('');
            funcionario_scr.dgv_funcionario();
        });
        $("#<?php echo FUNCIONARIO::SRC.FUNCIONARIO::nome;?>").keyup(()=>{
            funcionario_scr.dgv_funcionario();
        });
    });

<?php if(isset($_SESSION[Config::Permissao]['funcionario']['C']) && $_SESSION[Config::Permissao]['funcionario']['C'] == 'true'){?>
    $("#<?php echo FUNCIONARIO::SRC.FUNCIONARIO::btn_novo;?>").click(function(e){
        e.preventDefault();
        funcionario_scr.funcionario_mnt(0);
    });
<?php }?>

<?php if(isset($_SESSION[Config::Permissao]['funcionario']['P']) && $_SESSION[Config::Permissao]['funcionario']['P'] == 'true'){?>
    $("#<?php echo FUNCIONARIO::SRC.FUNCIONARIO::btn_imprimir;?>").click(function(e){
        e.preventDefault();
        funcionario_scr.funcionario_print($(this).attr('value'));
    });
<?php }?>

<?php if(isset($_SESSION[Config::Permissao]['funcionario']['P']) && $_SESSION[Config::Permissao]['funcionario']['P'] == 'true'){?>
    $("#<?php echo FUNCIONARIO::SRC.FUNCIONARIO::dgv_funcionario;?>").on("click","#P",function(e){
        e.preventDefault();
        if(arr_funcionario_p[$(this).closest('tr').index()]===e.currentTarget.outerHTML){
        	 funcionario_scr.funcionario_print(arr_funcionario_p[$(this).closest('tr').index()]);
        }
    });
<?php }?>

<?php if(isset($_SESSION[Config::Permissao]['funcionario']['U']) && $_SESSION[Config::Permissao]['funcionario']['U'] == 'true' ||
         isset($_SESSION[Config::Permissao]['funcionario']['V']) && $_SESSION[Config::Permissao]['funcionario']['V'] == 'true'){?>
    $("#<?php echo FUNCIONARIO::SRC.FUNCIONARIO::dgv_funcionario;?>").on("click","#V",function(e){
        e.preventDefault();
        if(arr_funcionario_u[$(this).closest('tr').index()]===e.currentTarget.outerHTML){
        	 funcionario_scr.funcionario_mnt(arr_funcionario_v[$(this).closest('tr').index()]);
        }
    });
<?php }?>

<?php if(isset($_SESSION[Config::Permissao]['funcionario']['D']) && $_SESSION[Config::Permissao]['funcionario']['D'] == 'true'){?>
    $("#<?php echo FUNCIONARIO::SRC.FUNCIONARIO::dgv_funcionario;?>").on("click","#D",function(e){
        e.preventDefault();
        if(arr_funcionario_d[$(this).closest('tr').index()]===e.currentTarget.outerHTML){
          Swal.fire({
              title: 'Excluir',
              text: 'Deseja excluir este funcionario?!',
              icon: 'question',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: ' Sim '
          }).then((r)=>{
              if (r.isConfirmed) {
           	  spinner_id=spinner.new_spinner();
                  setTimeout(()=>{
                      funcionario_scr.funcionario_excluir(arr_funcionario_d[$(this).closest('tr').index()]);
                  },100);
              }
          });
        }
    });
<?php }?>

</script>
