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

$prioridade = new ABDPrioridade();
if (getenv("REQUEST_METHOD") == "GET"){
	if(isset($_GET["key"]) && $_GET["key"] != 0 && $_GET["key"] != null){
		$prioridade->Carrega($_GET["key"]);
		if(isset($_GET["metodo"]) && $_GET["metodo"]=='excluir'){
			echo ElementosPagina::DialogoDecisao("Deseja excluir o registro \"$prioridade->descricao\"?", "PrioridadeControle.php", "metodo=deletar&key=$prioridade->id");
		}
		if(isset($_GET["metodo"]) && $_GET["metodo"]=='deletar'){
			$mensagem = $prioridade->Exclui();
				echo "<script language=javascript>";
				echo "document.location = 'PrioridadeControle.php';";
				echo "</script>";
		}
	}
}

$LstPrioridade = '';
$tpPrioridade = array();

$tpPrioridade = ABDPrioridade::ListarTodosArray();

$i= 1;
if ($tpPrioridade)
{
	foreach ($tpPrioridade as $tpu)
    {
    	if ($i%2 == 0) $cor = ' bgcolor="#ffffff" ';
    	else $cor = ' bgcolor="#e0e0e0" '; 
    	
    	if($_SESSION["usuario"]->sistema == 'SGA'){
    		$opcoes = '
					<td>
					<a href="PrioridadeControle.php?metodo=excluir&key='.$tpu->id.'"> 
					<img src="../app.images/ico_delete.png" border="0"> 
					</a> 
					</td>
					<td>
					<a href="PrioridadeControle.php?key='.$tpu->id.'"> 
					<img src="../app.images/ico_edit.png" border="0"> 
					</a> 
					</td>
    		';    		
    	}
    	else{
    		$opcoes = '
    		<td></td>
    		<td></td>
    		';
    	}
    	
    	
		$LstPrioridade .= '<tr '. $cor .'>'.$opcoes.'
					<td align="right">'. $tpu->id .'</td> 
					<td align="left">'. $tpu->descricao .'</td> 
                    </tr>';
	    $i++;
    }
}


// Monta a estrutura da página    
$Conteudo = "

<table width='968' class='tdatagrid_table' align='left' border ='0'>
	<tr>
		<td align='left' >
			<div align='left'>
				<p align='left' class='tit_conteudo'>Cadastro das prioridades</p>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<form enctype='multipart/form-data' name='form_busca_Prioridade' method='post'> 
				<table> 
					<tr> 
						<td> 
							Código: 
						</td> 
						<td> 
							<input class='tfield_disabled' name='id' value='$prioridade->id' type='text' style='width:50' readonly='1'> 
						</td> 
					</tr> 
					<tr> 
						<td> 
							Descricao: 
						</td> 
						<td> 
							<input class='tfield' name='descricao' value='$prioridade->descricao' type='text' width=300> 
						</td> 
					</tr> 
					<tr> 
						<td> 
							<input class='tfield' name='cadastra' type='button' value='Cadastrar' onclick=\"document.form_busca_Prioridade.action='PrioridadeIncluir.php'; document.form_busca_Prioridade.submit();\"> 
						</td> 
					</tr> 
				</table> 
			</form> 	
		</td>
	</tr>
	<tr>
		<td>
			<table class='tdatagrid_table' align='left'> 
				<tr> 
					<td class='tdatagrid_col'> 
					</td> 
					<td class='tdatagrid_col'> 
					</td> 
					<td class='tdatagrid_col' align='right' width='50'> 
					Código</td> 
					<td class='tdatagrid_col' align='left' width='140'> 
					Descrição</td> 
				</tr> 
				".$LstPrioridade."
			</table> 
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
