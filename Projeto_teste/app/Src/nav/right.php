<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right"> 
    <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="javascript:void(0)" id="nav_funcionario_btn_sair">
        <script>
          $('#nav_funcionario_btn_sair').click(function(e){
          e.preventDefault();
          Swal.fire({
            title: 'Sair',
            text: 'Deseja sair?!',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: ' Sim '
            }).then((r)=>{
            if (r.isConfirmed) {
              $.post(conexao,{URL:'<?php echo URL::login();?>'}).done(function(){window.location.reload();});
            }
            });
          });
        </script>
        <i class="fa fa-sign-out mr-2"></i> Sair
      </a>
</div>

