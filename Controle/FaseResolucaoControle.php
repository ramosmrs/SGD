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

$fase = new ABDFaseResolucao();
if (getenv("REQUEST_METHOD") == "GET"){
	if(isset($_GET["key"]) && $_GET["key"] != 0 && $_GET["key"] != null){
		$fase->Carrega($_GET["key"]);
		//$fase = ABDFaseResolucao::CarregaFaseResolucao($_GET["key"]);
		if(isset($_GET["metodo"]) && $_GET["metodo"]=='excluir'){
			echo ElementosPagina::DialogoDecisao("Deseja excluir o registro \"$fase->descricao\"?", "FaseResolucaoControle.php", "metodo=deletar&key=$fase->id");
		}
		if(isset($_GET["metodo"]) && $_GET["metodo"]=='deletar'){
			$mensagem = $fase->Exclui();
				echo "<script language=javascript>";
				echo "document.location = 'FaseResolucaoControle.php';";
				echo "</script>";
		}
		
	}
	
}

$LstFaseResolucao = '';
$tpFaseResolucao = array();

$tpFaseResolucao = ABDFaseResolucao::ListarTodosArray();

$i= 1;
if ($tpFaseResolucao)
{
	foreach ($tpFaseResolucao as $tpu)
    {
    	if ($i%2 == 0) $cor = ' bgcolor="#ffffff"';
    	else $cor = ' bgcolor="#e0e0e0"'; 
    	
    	if($_SESSION["usuario"]->sistema == 'SGA'){
    		$opcoes = '
					<td>
					<a href="FaseResolucaoControle.php?metodo=excluir&key='.$tpu->id.'"> 
					<img src="../app.images/ico_delete.png" border="0"> 
					</a>
					</td>
					<td>
					<a href="FaseResolucaoControle.php?key='.$tpu->id.'"> 
					<img src="../app.images/ico_edit.png" border="0"> 
					</a> 
					</td> ';    		
    	}
    	else{
    		$opcoes = '
    		<td></td>
    		<td></td>
    		';
    	}
    	
		$LstFaseResolucao .= '<tr '. $cor .'>' . $opcoes .'
						
					<td align="right">'. $tpu->id .'</td> 
					<td align="left">'. $tpu->descricao .'</td> 
                    </tr>';
	    $i++;
//					<td><a href="FaseResolucaoExcluir.php?key='.$tpu->id .'"><img src="../app.images/ico_delete.png" border="0"></a>

    }
}


// Monta a estrutura da pï¿½gina    
$Conteudo = "

<table width='968' class='tdatagrid_table' align='left' border ='0'>
	<tr>
		<td align='left' >
			<div align='left'>
				<p align='left' class='tit_conteudo'>Cadastro das fases das demandas</p>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<form enctype='multipart/form-data' name='form_busca_FaseResolucao' method='post'> 
				<table> 
					<tr> 
						<td> 
							Código: 
						</td> 
						<td> 
							<input class='tfield_disabled' name='id' value='$fase->id' type='text' style='width:50' readonly='1'> 
						</td> 
					</tr> 
					<tr> 
						<td> 
							Descrição: 
						</td> 
						<td> 
							<input class='tfield' name='descricao' value='$fase->descricao' type='text' width=300> 
						</td> 
					</tr> 
					<tr> 
						<td> 
							<input class='tfield' name='cadastra' type='button' value='Cadastrar' onclick=\"document.form_busca_FaseResolucao.action='FaseResolucaoIncluir.php'; document.form_busca_FaseResolucao.submit();\"> 
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
				".$LstFaseResolucao."
			</table> 
		</td>
	</tr>
</table>

";

//Exibiï¿½ï¿½o
$template = ElementosPagina::$cabecalhoTela . ElementosPagina::$cabecalhoCCTela . ElementosPagina::$menuTela . ElementosPagina::$rodapeTela;
$template = str_replace('#USUARIO#', LoginControle::ExibeLinhaLogin(), $template);
$template = str_replace('#CONTENT#', $Conteudo, $template);
echo $template;

?>
