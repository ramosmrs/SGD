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
require ("../Controle/utils.php");

if (isset ( $_SESSION ['usuario']->id )) {
	if ($_SESSION ['usuario']->id == '' || $_SESSION ["usuario"]->sistema != 'SGA') {
		   	echo "<script language=javascript>";
			echo "document.location = 'Principal.php';";
			echo "</script>";
	}
}

if (getenv ( "REQUEST_METHOD" ) == "POST") {
	
	$nome = isset($_POST["nome"]) ? $_POST["nome"] : '';
	$login = isset ( $_POST ["login"]) ? $_POST ["login"] : '';
	$id = $_POST["codigo"];
	$login = str_replace("'", "", $login);
	if ($nome == '' || $login == '') {
		alert ( "Preencha todos os campos do formulario." );
		echo "<script language=javascript>";
		echo "document.location = 'listar_usuarios.php';";
		echo "</script>";
	} else {
		
		$sistema = $_POST ["sistema"];
		$resetsenha = isset ( $_POST ["resetsenha"] ) ? 'S' : 'N';
		$param = isset ( $_POST ["param"] ) ? $_POST ["param"] : '';
		
		//echo "$matricula-$nome-$lotacao-$sistema-$ativo-$resetsenha-$param";

			if ($resetsenha == 'S')
				$senha = " SENHA = '" . base64_encode ( $login ) . "', ALTERADA = 0, ";
			else
				$senha = ' ';
			
			$select = "UPDATE USUARIO SET
                       NOME = '$nome',
                       LOGIN = '$login',
                       $senha
                       SISTEMA = '$sistema' 
					   WHERE ID = $id";
//			echo $select;
			$stid = oci_parse ( $Conexao, $select );
			$r = oci_execute ( $stid );
			
			// Envio de senha
			
			if ($resetsenha == 'S'){
				$ppnUSUARIO_ID = $id;
				$conn = ConnOracle::GetConn();
				$query = "BEGIN PCK_USUARIO.prcResetSenhaEmail(:ppnUSUARIO_ID); END;";
				$stmt = oci_parse($conn, $query);
				OCIBindByName($stmt,":ppnUSUARIO_ID",$ppnUSUARIO_ID);
				oci_execute($stmt);
			}
			
			if (! $r) {
				$e = oci_error ( $stid );
				alert ( "Erro na gravacao do registro." );
			} else
				alert ( "Registro gravado com sucesso." );
			
			echo "<script language=javascript>";
			echo "document.location = 'listar_usuarios.php';";
			echo "</script>";
		
		}
}
?>
