<?php
#1.0.1
error_reporting(Debug::Show);
include_once URL::login(URL::models);
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <?php include config::Src.'head.php'; ?>
        <?php include config::Src.'script.php'; ?>
       <script>
        	var conexao = "";
    		var spinner = new frm_spinner();
   	</script>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a><b>Processo_Seletivo</b></a>
            </div>
            <div class="card">
                <div class="card-body login-card-body" style="border-radius: 10px">
                    <h4 class="login-box-msg">Controle de Acesso</h4>
                    <form id="frm_index">
                        <div class="input-group mb-3">
                            <input
                            	  type="text"
                            	  class="form-control"
                            	  placeholder="Digite o funcionario_cpf"
                            	  id="txt_funcionario_cpf"
                            	  required="required"/>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-user-circle"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input
                            	  type="password"
                            	  class="form-control"
                            	  placeholder="Digite a senha"
                            	  id="txt_funcionario_senha"
                            	  required="required"/>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="javascript:void(0)">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                                        <i class="fa fa-sign-in"></i> Entrar
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     <script>
     var cls_index_entrar=class cls_index_entrar{
        entrar(){
            var d=new FormData();
            d.append('URL','<?php echo URL::login();?>');
            d.append('M','L');
            d.append('<?php echo LOGIN::funcionario_cpf();?>',$('#frm_index').find('#txt_funcionario_cpf').val());
            d.append('<?php echo LOGIN::funcionario_senha();?>',$('#frm_index').find('#txt_funcionario_senha').val());
            $.ajax({url:conexao,type:'POST',data:d,contentType:false,cache:false,processData:false,
                success:(r)=>{
                	  if(r){
                	  	  var o=JSON.parse(r);
                    	  if(o.s===true){
                        	  window.location.replace(o.f);
                    	  }else{
                        	  Swal.fire(o.m,'','error');
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
        };
    	 var index_entrar=new cls_index_entrar();
        $(document).ready(function(){
            var frm=[];
            for(var i=0;i<document.getElementById('frm_index').elements.length;i++){
                frm.push(document.getElementById('frm_index').elements[i].outerHTML);
            }
            $('#frm_index').on('submit', function(e) {
                e.preventDefault();
                for(var i=0;i<document.getElementById('frm_index').elements.length;i++){
                    if(e.target.elements[i].outerHTML!==frm[i]){
                        alert('Não edite está página seu Djanho...');
                        window.location.reload();
                        return;
                    }
                }
              	 spinner_id=spinner.new_spinner();
              	 setTimeout(()=>{
                	index_entrar.entrar();
              	 },100);
            });
        });
   </script>
   </body>
</html>
