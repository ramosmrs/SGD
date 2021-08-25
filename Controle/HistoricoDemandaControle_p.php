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
	$demanda = ABDDemanda::CarregaDemanda($_GET["key"], 2);	
//	$demanda = ABDDemanda::CarregaDemanda(12, 1);
	if ($demanda->id != 0){
	   	$_SESSION["demanda"] = $demanda;
    }
}
    
// Monta a listagem de usuários artibuídos a demanda:
$ColResponsavel = ABDDemanda::ListarUsuariosDemandaArray($_SESSION['demanda']->id);
$i= 1;
$LstUsuarios = '';
if ($ColResponsavel)
{
	foreach ($ColResponsavel as $tpu)
    {
    	if ($i%2 == 0) $cor = ' bgcolor="#ffffff"';
    	else $cor = ' bgcolor="#e0e0e0"';
    	$LstUsuarios = $LstUsuarios.  
				'<tr '. $cor .'>
				<td> </td>
				<td align="right" width="50">
				'. $tpu->id .'</td>
				<td align="right" width="150">
				'. $tpu->nome .'</td>
				</tr>';
    	$i = $i + 1;
    }
}

/*
//Monta a listagem da combo de usuarios a adicionar:
$ColUsuarioAdic = ABDUsuario::ListarTodosArray();
$LstUsuarioAdic = '';
// adiciona objetos na combo
foreach ($ColUsuarioAdic as $obj1)
{
	$incluir = " <option value='$obj1->id'>$obj1->nome</option> ";
	
	foreach($ColResponsavel as $tpu){
		if($obj1->id == $tpu->id) $incluir = '';
	}
    $LstUsuarioAdic = $LstUsuarioAdic . $incluir;
}

*/

// Monta o histórico da demanda:
$ColHistorico = ABDHistoricoDemanda::ListarTodosArray($_SESSION['demanda']->id);
$LstHistorico = '';

$i = 1;
foreach ($ColHistorico as $lst2)
{
    	if ($i%2 == 0) $cor = ' bgcolor="#ffffff"';
    	else $cor = ' bgcolor="#e0e0e0"';
    	$LstHistorico = $LstHistorico. '  
						<tr "'.$cor.'">
						<td align="left" width="80">
						'.$lst2->situacao->descricao.'</td>
						<td align="left" width="80">
						'.$lst2->usuario->nome.'</td>
						<td align="left" width="150">
						'.$lst2->data.'</td>
						<td align="left" width="545">
						'.$lst2->descricao.'</td>
						</tr>
						';
    	$i = $i + 1;
}


//Monta a listagem de situação
$ColSituacao = ABDSituacao::ListarTodosArray();
$LstSituacao = '';
foreach ($ColSituacao as $obj3)
{
	if($obj3->id == $_SESSION['demanda']->situacao->id) $selec = ' selected ';
	else $selec = ' ';
	$LstSituacao = $LstSituacao . " <option value='$obj3->id' $selec >$obj3->descricao</option> ";
}

/*
//Monta a listagem de usuários da demanda 
$LstResponsavel = '';
foreach ($ColResponsavel as $obj4){
	$selec = '';
	if($obj4->id == $_SESSION['demanda']->responsavel->id) $selec = ' selected ';
	
	$LstResponsavel = $LstResponsavel . " <option value='$obj4->id' $selec >$obj4->nome</option> ";;
}
*/
// Monta a listagem de arquivos anexos

$ColAnexos = ABDAnexos::ListarAnexos($_SESSION['demanda']->id);
$LstAnexos = '';

$i= 1;
if ($ColAnexos)
{
	foreach ($ColAnexos as $obj2)
    {
    	if ($i%2 == 0) $cor = ' bgcolor="#ffffff"';
    	else $cor = ' bgcolor="#e0e0e0"';
    	$LstAnexos = $LstAnexos.  
				'<tr '. $cor .'>
				<td>
				</td>
				<td align="left" width="200">
				'. $obj2->nomearq .'</td>
				<td align="left" width="80">
				'. $obj2->dtinclusao .'</td>
				<td>
				</td>
				</tr>';
    	$i = $i + 1;
    }
}


// Monta a estrutura da página    
$Conteudo = '

<table width="968" align="left" border ="0">
	<tr>
		<td align="left">
		    <p align="left" class="tit_conteudo">Sistema de Gestão de Demandas</p>
			<p align="left" class="tit_conteudo">Detalhes da demanda: '. $demanda->titulo .'</p>
			<p align="left" class="tit_conteudo">Fase ..............: '. $demanda->fase->descricao .'</p>
		</td>
	</tr>
<tr><td>
<table width="900" class="tdatagrid_table" align="left" border ="0">
	<tr>
		<td align="left" class="tit_texto">
		<strong>Codigo: </strong>'. $demanda->id .'
		</td>
	</tr>
<tr>
<td align="left" class="tit_texto">
<strong>Data de cadastro : </strong>'. $demanda->dataentrada .'
</td>
</tr>
<tr>
<td align="left" class="tit_texto">
<strong>Prioridade : </strong>'. $demanda->prioridade->descricao .'
</td>
</tr>
<tr>
<td align="left" class="tit_texto">
<strong>Tipo de demanda : </strong>'. $demanda->tipodemanda->descricao .'
</td>
</tr>
<tr>
<td align="left" class="tit_texto">
<strong>Situação : </strong>'. $demanda->situacao->descricao .'
</td>
</tr>
<tr>
<td align="left" class="tit_texto">
<strong>Autor : </strong>'. $demanda->usuario->nome .'
</td>
</tr>
<tr>
<td align="left" class="tit_texto">
<strong>Responsável : </strong>'. $demanda->responsavel->nome .'
</td>
</tr>
<tr>
<td align="left" class="tit_texto">
<strong>Descrição : </strong><br>'. $demanda->descricao .'
</td>
</tr>
<tr>
<td>
<hr width="880" align="left">
</td>
</tr>
</table>
</td></tr>

<tr><td>
<form enctype="multipart/form-data" name="form_inclui_usuario" method="post"> 
<table width="968" align="left" border ="0">
<tr>
<td align="left" class="tit_conteudo"><strong>Usuários atribuídos a demanda</strong>
</td>
</tr>
<tr>
<td>
<table class="tdatagrid_table" align="left">
<tr>
<td class="tdatagrid_col">
</td>
<td class="tdatagrid_col" align="right" width="50">
Código</td>
<td class="tdatagrid_col" align="right" width="150">
Usuário</td>
</tr>
'. $LstUsuarios .'
</table>
</td>
</tr>
<tr>
<td>
<hr width="880" align="left">
</td>
</tr>
<tr>
</table>
</form>
</td></tr>

<tr><td>
<form enctype="multipart/form-data" name="form_anexos" method="post"> 
<table width="968" align="left" border ="0">
<tr>
<td align="left" class="tit_conteudo"><strong>Arquivos anexados</strong>
</td>
</tr>
<tr>
<td>
<table class="tdatagrid_table" align="left">
<tr>
<td class="tdatagrid_col">
</td>
<td class="tdatagrid_col" align="left" width="400">
Arquivo</td>
<td class="tdatagrid_col" align="left" width="150">
Data de inclusão</td>
<td class="tdatagrid_col">
</td>
</tr>
'. $LstAnexos .'
</table>
</td>
</tr>
<tr>
<td>
<hr width="880" align="left">
</td>
</tr>
<tr>
</table>
</form>
</td></tr>
<tr><td>
<table width="968" align="left" border ="0">
<tr>
<td align="left" class="tit_conteudo"><strong>Histórico da demanda</strong>
</td>
</tr>
<tr>
<td>
<table class="tdatagrid_table" align="left">
<tr>
<td class="tdatagrid_col" align="left" width="80">
Situação</td>
<td class="tdatagrid_col" align="left" width="80">
Usuário</td>
<td class="tdatagrid_col" align="left" width="150">
Data</td>
<td class="tdatagrid_col" align="left" width="360">
Descrição</td>
</tr>'. $LstHistorico .'
</table>
</td>
</tr>
<tr>
<td>
<hr width="880" align="left">
</td>
</tr>
</table>
</td></tr>

</table>
</td></tr>

</table>
';

//Exibição
$template = ElementosPagina::$PaginaPrint;
//$template = str_replace('#USUARIO#', LoginControle::ExibeLinhaLogin(), $template);
$template = str_replace('#CONTENT#', $Conteudo, $template);
echo $template;


?>
