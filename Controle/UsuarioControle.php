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

$usuario = new ABDUsuario();
if (getenv("REQUEST_METHOD") == "GET"){
	if(isset($_GET["key"]) && $_GET["key"] != 0 && $_GET["key"] != null){
		$usuario->Carrega($_GET["key"]);
		if(isset($_GET["metodo"]) && $_GET["metodo"]=='excluir'){
			echo ElementosPagina::DialogoDecisao("Deseja excluir o registro \"$usuario->nome\"?", "UsuarioControle.php", "metodo=deletar&key=$usuario->id");
		}
		if(isset($_GET["metodo"]) && $_GET["metodo"]=='deletar'){
			$mensagem = $usuario->Exclui();
				echo "<script language=javascript>";
				echo "document.location = 'UsuarioControle.php';";
				echo "</script>";
		}
	}
}

$LstUsuario = '';
$tpUsuario = array();

$tpUsuario = ABDUsuario::ListarTodosArray();

$i= 1;
if ($tpUsuario)
{
	foreach ($tpUsuario as $tpu)
    {
    	if ($i%2 == 0) $cor = ' bgcolor="#ffffff" ';
    	else $cor = ' bgcolor="#e0e0e0" '; 
    	
    	if($_SESSION["usuario"]->sistema == 'SGA'){
    		$opcoes = '
					<td>
					<a href="UsuarioControle.php?metodo=excluir&key='.$tpu->id.'"> 
					<img src="../app.images/ico_delete.png" border="0"> 
					</a> 
					</td>
					<td>
					<a href="UsuarioForm.php?key='.$tpu->id.'"> 
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
		$LstUsuario .= '<tr '. $cor .'>' . $opcoes .'
					<td align="right">'. $tpu->id .'</td> 
					<td align="left">'. $tpu->nome .'</td> 
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
				<p align='left' class='tit_conteudo'>Cadastro dos Usuários</p>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<form enctype='multipart/form-data' name='form_busca_Usuario' method='post'> 
			<table> 
			<tr> 
			<td> 
			<input class='tfield' name='cadastra' type='button' value='Novo Usuário' onclick=\"document.form_busca_Usuario.action='UsuarioForm.php'; document.form_busca_Usuario.submit()\"> 
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
				".$LstUsuario."
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
