<?php
session_start();

function __autoload($classe)
{
	   $pastas = array('../AcessoBancoDados','../app.widgets', '../app.images', '../Controle', '../Modelo');
	   foreach ($pastas as $pasta)
	   {
		      if (file_exists("{$pasta}/{$classe}.class.php"))
        {
		
			         include_once "{$pasta}/{$classe}.class.php";
		      }
	   }
}	

$Conexao = ConnOracle::Conecta();

if (isset ( $_SESSION ['usuario']->id )) {
	if ($_SESSION ['usuario']->id == '' || $_SESSION ["usuario"]->sistema != 'SGA') {
		echo "<script language=javascript>";
		echo "document.location = 'Principal.php'";
		echo "</script>";
	}
}
else{
	echo "<script language=javascript>";
	echo "document.location = 'Principal.php';";
	echo "</script>";
	
}

if (getenv ( "REQUEST_METHOD" ) == "GET") {
	$param = base64_decode ($_GET["param"]);
	if ( $param != 'novo'){
	    
		$select = "SELECT ID, NOME, LOGIN, SISTEMA";
		$from = " FROM USUARIO ";
		$where = "  where ID = '$param' AND ATIVO = 1 ";
		$order = " ";

		$query = $select . $from . $where . $order;
		$stid = oci_parse ( $Conexao, $query );
		//echo $query;
		oci_execute ( $stid );
		
		$nrows = oci_fetch_all ( $stid, $results );
		
		if ($nrows < 1) {
			alert("Nenhum registro encontrado.");
			echo "<script language=javascript>";
			echo "document.location = 'listar_usuarios.php';";
			echo "</script>";
		}
		else
		{
			$id        = $results["ID"][0];
			$nome      = $results["NOME"][0];
			$sistema   = $results["SISTEMA"][0];
			$login     = $results["LOGIN"][0];
		}
	}
	else
	{
		$id        = '';
		$nome      = '';
		$sistema   = 'ADM';
		$login     = '';
	}
}


echo ElementosPagina::$cabecalhoTela;
echo ElementosPagina::$cabecalhoCCTela;  
echo "


<table width='968' height='104' border='0' align='center'
	cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>

	<tr>
		<td align='left'>
		<div align='left' style='margin-top: 2.5px'>
		<p align='left' class='tit_conteudo'>Manutenção de usuários - Editar usuário</p>
		<form action='gravar_usuario.php' method='post' target='_frame'>
		<table>
			<tr>
				<td>Código</td>
				<td><input name='codigor' type='text' class='codigor' disabled='disabled'
					id='codigor' size='20' maxlength='10' 
					value='$id' >
					<input name='codigo' type='hidden' class='codigo' 
					id='codigo' size='20' maxlength='10' 
					value='$id' >
			</tr>
			<tr>
				<td>Nome</td>
				<td><input name='nome' type='text' class='Inome' id='nome' size='80'
					maxlength='80' value='$nome'></td>
			</tr>
			<tr>
				<td>Tipo de usu&aacute;rio</td>
				<td><input name='sistema' type='radio' class='sistema'
					id='sistema' value='SGD'";
		echo $sistema == 'SGD' ? ' checked=\'checked\' ' : '';
		echo ">Comum 
					<input name='sistema' type='radio' class='sistema' 
					id='sistema' value='SGA'";
		echo $sistema == 'SGA' ? ' checked=\'checked\' ' : '';
		echo ">Administrador
				</td>
			</tr>
			<tr>
				<td>login</td>
				<td><input name='login' type='text' class='login' id='login' size='80'
					maxlength='80' value='$login'></td>
			</tr>

			<tr>
				<td>Ressetar senha</td>
				<td><input name='resetsenha' type='checkbox' value='reset'
					class='Iresetsenha' id='resetsenha'><i> (A senha ser&aacute; igual a matr&iacute;cula,
				                      e o usu&aacute;rio dever&aacute; troc&aacute;-la no pr&oacute;ximo login.)
  				                   </i></td>
			    <td></td>
				<td><input name='param' type='hidden' value='$param'></td>
			</tr>
			<tr>
				<td><input name='Submit' type='submit' class='Enviar' value='Gravar' /></td>
				<td><input type='button' value='Voltar'
					onClick=\"javascript:document.location = 'listar_usuarios.php'\"></td>
			</tr>
		</table>
		</form>
		</div>
		</td>
		<td><img src='..images/spacer.gif' width='1' height='42' border='0'
			alt=''></td>
	</tr>
</table>

";

echo ElementosPagina::$rodapeTela;
?>

