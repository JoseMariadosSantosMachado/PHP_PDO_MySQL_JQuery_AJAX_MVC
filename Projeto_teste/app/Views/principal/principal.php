<?php
#1.0.1
error_reporting(Debug::Show);
if(!isset($_SESSION['funcionario_cpf'])){
   echo Session::Reload();
}else if(strpos(strtolower(Host::Web), strtolower(filter_input(INPUT_SERVER,'HTTP_HOST').filter_input(INPUT_SERVER,'REQUEST_URI')) )!==false){
?>
<!DOCTYPE html>
<html lang="pt">
	<head>
    	<?php include Config::Src.'head.php';?>
    	<?php include Config::Src.'script.php';?>
       <script>
        	var conexao = "";
    		var spinner = new frm_spinner();
    		var modal = new frm_modal();
   	</script>
	</head>
   <body class="sidebar sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-dark navbar-<?php echo $_SESSION['navbar-color'];?> text-sm">
                <?php include Config::Src.'nav.php';?>
            </nav>
            <aside class="main-sidebar sidebar-light-<?php echo $_SESSION['sidebar-btn-color'];?> elevation-3">
                <?php include Config::Src.'side.php';?>
            </aside>
            <div class="content-wrapper">
                <?php include Config::Src.'content_header.php';?>
                <?php include Config::Src.'content.php';?>
            </div>
            <footer class="main-footer bg-gradient-<?php echo $_SESSION['footer-color'];?> text-sm">
                <?php include Config::Src.'footer.php';?>
            </footer>
        </div> 
	 <script>
	 $(function(){
        $(document).ready(function(){
            $('body').on('hidden.bs.modal', function () {
                if($('.modal.in').length > 0){
                    $('body').addClass('modal-open');
                }
            });
        });
        <?php if(isset($_SESSION['form_principal'])){?>
        form=function(){
            $.post(conexao,{<?php echo $_SESSION['form_principal'];?>}).done((r)=>{
                if(r){
                    $("#<?php echo FRM_PRINCIPAL::DIV;?>").html(r);
                }
            });
        };
        form();
        <?php }?>
	});
	 </script>
    </body>
</html>
<?php }else{
    echo Session::Reload();
}?>
