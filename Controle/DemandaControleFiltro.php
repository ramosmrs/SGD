<?php 
session_start();

function __autoload($classe)
{
   $pastas = array('../AcessoBancoDados','../app.widgets', '../Controle', '../Modelo');
   foreach ($pastas as $pasta)
   {
      if (file_exists("{$pasta}/{$classe}.class.php"))
	  {
	      include_once "{$pasta}/{$classe}.class.php";
	  }
   }
}

if(isset($_SESSION['usuario']->id)){
	if ($_SESSION['usuario']->id == 0){
		echo "<script language=javascript>";
		echo "document.location = '../Login/index.php';";
		echo "</script>";
	}
}
else{
	echo "<script language=javascript>";
	echo "document.location = '../Login/index.php';";
	echo "</script>";
}

$Conexao = ConnOracle::Conecta();


if($_SESSION["usuario"]->id != null)
{
	$LstDemandas = '';
	$tpDemanda = array();
	$tpDemanda = ABDDemanda::ListarTodosUsuarioArray();
}
else {
	echo '<script type="text/javascript">';
	echo '	document.location = "../Login/index.php";';
	echo '</script>';
}

$i= 1;
if ($tpDemanda)
{
	foreach ($tpDemanda as $tpu)
    {
    	if ($i%2 == 0) $cor = ' bgcolor="#ffffff"';
    	else $cor = ' bgcolor="#e0e0e0"'; 
    	
		$LstDemandas = $LstDemandas . '<tr '. $cor .'>
					<td><a href="DemandaForm.php?key='.$tpu->id .'" title="Editar demanda"><img src="../app.images/ico_edit.png" border="0"></a></td>
					<td><a href="HistoricoDemandaControle.php?key='.$tpu->id .'" title="Detalhes da demanda"><img src="../app.images/ico_view.png" border="0"></a>
					<td align="right">'. $tpu->id .'</td> 
					<td align="left">'. $tpu->dataentrada.'</td> 
					<td align="left">'. $tpu->titulo .'</td> 
					<td align="left">'. $tpu->situacao .'</td> 
					<td align="left">'. $tpu->prioridade .'</td> 
					<td align="left">'. $tpu->usuario .'</td> 
                    </tr>';
	    $i++;
    }
}


$Conteudo = "
<table width='968' class='tdatagrid_table' align='left' border ='0'>
	<tr>
		<td align='left' >
			<div align='left'>
				<br>
				<p align='left' class='tit_conteudo'>Cadastro das demandas por usuário</p>
			</div>
		</td>
		<tr>
		<td>
	</tr>
	<tr>
	<td>
	<form enctype='multipart/form-data' name='form_nova_Demanda' method='post'> 
			<input name='nova' type='button' value='Nova Demanda' onclick=\"document.form_nova_Demanda.action='DemandaForm.php'; document.form_nova_Demanda.submit()\">
	</form>
	</td>
	</tr>
	<tr>
	<td>
	<table width='908' align='left'  border='0' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'> 
<tr>
 
<td class='tdatagrid_col' width='10'> 
</td> 
<td class='tdatagrid_col' width='10'> 
</td> 
<td class='tdatagrid_col' align='right' width='50'> 
Código</td> 
<td class='tdatagrid_col' align='left' width='70'> 
Data</td> 
<td class='tdatagrid_col' align='left' width='200'> 
Título</td> 
<td class='tdatagrid_col' align='left' width='140'> 
Situação</td> 
<td class='tdatagrid_col' align='left' width='70'> 
Prioridade</td> 
<td class='tdatagrid_col' align='left' width='200'> 
Responsável (a partir de)</td> 
</tr>"
. $LstDemandas ." <tr><td><br><br><br></td></tr> </table>
	</td>
	</tr>
	
</table>

";

//Exibição
$template = ElementosPagina::$cabecalhoTela . ElementosPagina::$cabecalhoCCTela . ElementosPagina::$menuTela . ElementosPagina::$rodapeTela;
$template = str_replace('#USUARIO#', LoginControle::ExibeLinhaLogin(), $template);
$template = str_replace('#CONTENT#', $Conteudo, $template);
echo $template;
?>



