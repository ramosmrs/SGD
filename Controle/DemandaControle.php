

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

$filtro = '';

if (getenv("REQUEST_METHOD") == "POST"){
	$filtrosit = '';
	$filtropri = '';
	$filtrofase = '';
	if(isset($_POST["chksituacao"])){
	foreach ($_POST["chksituacao"] as $chavesit){
		if ($filtrosit == '')
			$filtrosit = $chavesit;
		else
			$filtrosit = $filtrosit . ',' . $chavesit;
		
	}
	}
	if(isset($_POST["chkprioridade"])){
	foreach ($_POST["chkprioridade"] as $chavepri){
		if ($filtropri == '')
			$filtropri = $chavepri;
		else
			$filtropri = $filtropri . ',' . $chavepri;
		
	}
	}
	if(isset($_POST["chkfase"])){
		$filtrofase = $_POST["chkfase"];
	}
	else $filtrofase = '';
	$filtrousu = $_POST["chkusuario"];
	//$filtro = $filtrosit .';'.$filtropri.';'.$_POST["chkusuario"];
}
else {
	$filtrosit = '';
	$filtropri = '';
	$filtrousu = '';
	$filtrofase = '';
}

$Conexao = ConnOracle::Conecta();
$LstDemandas = '';
$tpDemanda = array();
$tpDemanda = ABDDemanda::ListarTodosArray($filtrosit, $filtropri, $filtrousu, $filtrofase);

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

$tpSituacao = array();
$tpSituacao = ABDSituacao::ListarTodosArray();
$LstSituacao = '';
if ($tpSituacao)
{
	foreach($tpSituacao as $tps){
	    if (getenv("REQUEST_METHOD") == "POST" && isset($_POST["chksituacao"]) && count($_POST["chksituacao"]) > 0){
	    	$chk = '';
			foreach ($_POST["chksituacao"] as $chavesit){
				if ($chavesit == $tps->id) $chk = ' checked ';
			}
			$LstSituacao = $LstSituacao . 
			" <input type='checkbox' name='chksituacao[]' value='$tps->id' $chk />$tps->descricao<br> ";
			
		}
		else{
			$LstSituacao = $LstSituacao . 
			" <input type='checkbox' name='chksituacao[]' value='$tps->id' />$tps->descricao<br> ";
		}
	}
}
$tpPrioridade = array();
$tpPrioridade = ABDPrioridade::ListarTodosArray();
$LstPrioridade = '';
if ($tpPrioridade)
{
	foreach($tpPrioridade as $tpp){
	    if (getenv("REQUEST_METHOD") == "POST" && isset($_POST["chkprioridade"]) && count($_POST["chkprioridade"]) > 0){
	    	$chk = '';
	    	foreach ($_POST["chkprioridade"] as $chavesit){
		    		if ($chavesit == $tpp->id) $chk = ' checked ';
		    }
	    	$LstPrioridade = $LstPrioridade .
			" <input type='checkbox' name='chkprioridade[]' value='$tpp->id' $chk />$tpp->descricao<br> ";
	    }
	    else {
			$LstPrioridade = $LstPrioridade . 
			" <input type='checkbox' name='chkprioridade[]' value='$tpp->id' />$tpp->descricao<br> ";
	    }
	}
}
$tpUsuario = array();
$tpUsuario = ABDUsuario::ListarTodosArray();
$LstUsuario = '';
if($tpUsuario){
	
	foreach($tpUsuario as $tpusu){
		$chkusu = '';
		if(getenv("REQUEST_METHOD") == "POST" && isset($_POST["chkusuario"]) && $_POST["chkusuario"] == $tpusu->id){
			$chkusu = ' selected ';
		}
		$LstUsuario = $LstUsuario . 
		"<option value = '". $tpusu->id . "' $chkusu >". $tpusu->nome ."</option>";
	}
}

$tpFaseResolucao = array();
$tpFaseResolucao = ABDFaseResolucao::ListarTodosArray();
$LstFaseResolucao = '';
if ($tpFaseResolucao)
{
	foreach($tpFaseResolucao as $tps){
	    if (getenv("REQUEST_METHOD") == "POST" && isset($_POST["chkfase"]) && count($_POST["chkfase"]) > 0){
	    	$chk = '';
			if ($_POST["chkfase"] == $tps->id) $chk = ' checked ';
			$LstFaseResolucao .= 
			" <input type='radio' name='chkfase' value='$tps->id' $chk />$tps->descricao<br> ";
			
		}
		else{
			$LstFaseResolucao .=  
			" <input type='radio' name='chkfase' value='$tps->id' />$tps->descricao<br> ";
		}
	}
}

$Conteudo = "<table width='968' class='tdatagrid_table' align='left' border ='0'>
	<tr>
		<td align='left' >
			<div align='left'>
				<p align='left' class='tit_conteudo'>Cadastro das demandas</p>
			</div>
		</td>
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
	<form enctype='multipart/form-data' name='form_busca_Demanda2' method='post'> 
	<table border ='0' width=910> 
	    <tr>
	    	<td class='tdatagrid_col' colspan=4 align='center'>
	    		<p>Filtros aplic�veis</p>
	    	</td>
	    </tr> 
		<tr> 
			<td bgcolor='#e0e0e0' width='200' valign=top>
			   <strong>Fase:</strong><br>
			   $LstFaseResolucao
			</td>
			<td bgcolor='#e0e0e0' width=300 valign=top >
			    <strong>Situa��o:</strong><br> 
				$LstSituacao
			<br> 
			</td> 
			<td bgcolor='#e0e0e0' width='200' valign=top>
			   <strong>Prioridade:</strong><br>
			   $LstPrioridade
			</td>
			<td bgcolor='#e0e0e0' width='200' valign=top>
			   <strong>Respons�vel</strong><br>
			   <select name='chkusuario'>
			   <option value=' '> </option>
			   $LstUsuario
			</td>
		</tr>
		<tr>
			<td class='tdatagrid_col' colspan=4>
				 <input name='filtro' type='button' value='Aplicar filtro' onclick=\"document.form_busca_Demanda2.action='DemandaControle.php'; document.form_busca_Demanda2.submit()\">
				 <strong> (Para limpar os filtros, clique no bot�o \"Demandas\")</strong>
		    </td>

		    
		</tr>
	</table> 
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
C�digo</td> 
<td class='tdatagrid_col' align='left' width='70'> 
Data</td> 
<td class='tdatagrid_col' align='left' width='200'> 
T�tulo</td> 
<td class='tdatagrid_col' align='left' width='140'> 
Situa��o</td> 
<td class='tdatagrid_col' align='left' width='70'> 
Prioridade</td> 
<td class='tdatagrid_col' align='left' width='200'> 
Respons�vel (a partir de)</td> 
</tr>"
. $LstDemandas ." <tr><td><br><br></td></tr> </table> 
	</td>
	</tr>
</table>
";

//Exibi��o
$template = ElementosPagina::$cabecalhoTela . ElementosPagina::$cabecalhoCCTela . ElementosPagina::$menuTela . ElementosPagina::$rodapeTela;
$template = str_replace('#USUARIO#', LoginControle::ExibeLinhaLogin(), $template);
$template = str_replace('#CONTENT#', $Conteudo, $template);
echo $template;
?>



