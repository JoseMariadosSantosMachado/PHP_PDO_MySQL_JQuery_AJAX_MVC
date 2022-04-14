<?php 
include_once URL::login(URL::models);
$login = new cls_login();
$login->permissao();
 
 $reflector = new ReflectionClass(URL::class);
 $parameters = $reflector->getMethods();
foreach($parameters as $param){
     foreach$_SESSION[Config::Permissao] as $value){ 
        if($param->name == $value['nome'] && !empty($value['alias'])){?>
<a
   href="javascript:void(0)"
   title="Clique aqui para abrir <?php echo $value['alias']; ?>"
   id="frm_principal_btn_<?php echo $value['nome']; ?>"
   class="nav-link bg-<?php echo $_SESSION['btn-color'];?>">
   <i class="nav-icon <?php echo $value['icone']; ?>"></i>
   <p><?php echo $value['alias']; ?></p>
   <script>
       $('#frm_principal_btn_<?php echo $value['nome']; ?>').click(function(e){
           e.preventDefault();
           $.post(conexao,{URL:'<?php echo (URL::class.'::'.$value['nome'])();?>',M:'V'}).done((r)=>{
               if(r){
                   $("#<?php echo FRM_PRINCIPAL::DIV;?>").html(r);
               }else{
                   Swal.fire('Erro na conexão','','error');
               }
           });
       });
   </script>
</a>
<?php }
 }
}?>
