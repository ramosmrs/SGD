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

if(getenv("REQUEST_METHOD") == "GET"){
	$demanda = ABDDemanda::CarregaDemanda($_GET["key"], 1);	
	if ($demanda->id != 0){
	   	$_SESSION["demanda"] = $demanda;
    }
}
else {
	$demanda = new ABDDemanda();
}

//Monta a listagem de tipo de demanda
$ColTpDemanda = ABDTipoDemanda::ListarTodosArray();
$LstTpDemanda = '';
foreach ($ColTpDemanda as $obj)
{
	if($obj == $demanda->tipodemanda) $selec = ' selected ';
	else $selec = ' ';
	$LstTpDemanda = $LstTpDemanda . " <option value='".$obj->id."' $selec >".$obj->descricao."</option> ";
}

//Monta a listagem de fases
$ColFaseResolucao = ABDFaseResolucao::ListarTodosArray();
$LstFaseResolucao = '';
foreach ($ColFaseResolucao as $obj)
{
	if($obj == $demanda->fase) $selec = ' selected ';
	else $selec = ' ';
	$LstFaseResolucao = $LstFaseResolucao . " <option value='".$obj->id."' $selec >".$obj->descricao."</option> ";
}

//Monta a listagem de prioridade
$ColPrioridade = ABDPrioridade::ListarTodosArray();
$LstPrioridade = '';
foreach ($ColPrioridade as $obj)
{
	if($obj == $demanda->prioridade) $selec = ' selected ';
	else $selec = ' ';
	$LstPrioridade = $LstPrioridade . " <option value='$obj->id' $selec >$obj->descricao</option> ";
}

//Monta a listagem de situação
$ColSituacao = ABDSituacao::ListarTodosArray();
$LstSituacao = '';
foreach ($ColSituacao as $obj3)
{
	if($obj3 == $demanda->situacao) $selec = ' selected ';
	else $selec = ' ';
	$LstSituacao = $LstSituacao . " <option value='$obj3->id' $selec >$obj3->descricao</option> ";
}

//Monta a listagem de fase de resolução
$ColFase = ABDFaseResolucao::ListarTodosArray();
$LstFase = '';
foreach ($ColFase as $obj)
{
	if($obj == $demanda->fase) $selec = ' selected ';
	else $selec = ' ';
	$LstFase = $LstFase . " <option value='$obj->id' $selec >$obj->descricao</option> ";
}



// Monta a estrutura da página    
$Conteudo = '

<form onsubmit="return false;" action="">
	<p>
		Procurar texto<br />
		<input type="text" style="width: 200px;" value="" id="CityAjax" class="ac_input"/>
		<input type="button" onclick="lookupAjax();" value="Get Value"/>
	</p>
</form>

<form enctype="multipart/form-data" name="form_Demanda" method="post"> 
<table> 
	<tr> 
		<td> 
			<font style="font-family:Arial; color:black; font-size:14"> 
			Código:</font> 
		</td> 
		<td> 
			<input class="tfield_disabled" name="id" value="'.$demanda->id.'" type="text" style="width:20" readonly="1"> 
		</td> 
	</tr> 
	<tr> 
		<td> 
			<font style="font-family:Arial; color:black; font-size:14"> 
			Fase da Demanda:</font> 
		</td> 
		<td> 
			<select class="tfield" name="fase" style="width:200"> 
			'.$LstFaseResolucao.'</td> 
	</tr> 
	<tr> 
		<td> 
			<font style="font-family:Arial; color:black; font-size:14"> 
			Tipo de Demanda:</font> 
		</td> 
		<td> 
			<select class="tfield" name="tipodemanda" style="width:200"> 
			'.$LstTpDemanda.'
		</td> 
	</tr> 
	<tr> 
		<td> 
			<font style="font-family:Arial; color:black; font-size:14"> 
			Prioridade:</font> 
		</td> 
		<td> 
			<select class="tfield" name="prioridade" style="width:200"> 
			'.$LstPrioridade.'
		</td> 
	</tr> 
<tr> 
<td> 
<font style="font-family:Arial; color:black; font-size:14"> 
Situação:</font> 
</td> 
<td> 
<select class="tfield" name="situacao" style="width:200"> 
'.$LstSituacao.'</td> 
</tr> 
<tr> 
<td> 
<font style="font-family:Arial; color:black; font-size:14"> 
Título:</font> 
</td> 
<td> 
<input class="tfield" name="titulo" size=105 value="'.$demanda->titulo.'" type="text" style="width:300"> 
</td> 
</tr> 
<tr> 
<td> 
<font style="font-family:Arial; color:black; font-size:14"> 
Descrição:</font> 
</td> 
<td> 
<textarea name="descricao" cols="80" rows="10">'.$demanda->descricao.'</textarea> 
</td> 
</tr> 
<tr> 
<td> 
<font style="font-family:Arial; color:black; font-size:14"> 
Data de entrada:</font> 
</td> 
<td> 
<input class="tfield_disabled" name="dataentrada" value="'.$demanda->dataentrada.'" type="text" style="width:160" readonly="1"> 
</td> 
</tr> 
<tr> 
<td> 
</td> 
<td> 
<input class="tfield" name="action1" type="button" value="Salvar" onclick="document.form_Demanda.action=\'DemandaIncluir.php\'; document.form_Demanda.submit()"> 
</td> 
</tr> 
</table> 
</form> 

';

//Exibição
$template = ElementosPagina::$cabecalhoTela . ElementosPagina::$cabecalhoCCTela . ElementosPagina::$menuTela . ElementosPagina::$rodapeTela;
$template = str_replace('#USUARIO#', LoginControle::ExibeLinhaLogin(), $template);
$template = str_replace('#CONTENT#', $Conteudo, $template);
echo $template;


?>
