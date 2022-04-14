<?php
#1.0.1
error_reporting(Debug::Show);
include_once Libs::PhpJasperLibrary;
class frm_funcionario_rpt{
    public function funcionario_rpt(){
        $txt_empresa_logo = Src::Img.'logo.jpg';
        $array = array(
            'txt_relatorio_nome'=>'Relatório de funcionario',
            'txt_empresa_nome'=>'Processo_Seletivo',
            'txt_empresa_endereco'=>'Processo_Seletivo',
            'txt_projeto_nome'=>'Processo_Seletivo',
            'txt_empresa_logo'=>$txt_empresa_logo
        );
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->setErrorReport(false);
        $PHPJasperXML->arrayParameter = $array;
        $PHPJasperXML->load_xml_file(Reports::funcionario_xml);
        //$PHPJasperXML->debugsql = true;
        $PHPJasperXML->transferDBtoArray();
        echo $PHPJasperXML->outpage('V',70);
    }
}
$funcionario = new frm_funcionario_rpt();
$funcionario->funcionario_rpt();
?>
