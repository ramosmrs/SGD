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

$_SESSION['Logado'] = null;
$_SESSION['Sistema'] = null;

if (getenv("REQUEST_METHOD") == "POST"){
	if ($_POST["Login"]!= '' && $_POST["Senha"] != '')
	{
		$select = "SELECT ID, LOGIN, SENHA, ALTERADA, SISTEMA FROM USUARIO WHERE LOGIN = '".$_POST["Login"].
		                                                    "' AND SENHA = '".base64_encode($_POST["Senha"]).
															"' AND SISTEMA in ('SGD', 'SGA') ".
															"  AND ATIVO = 1 ";
//		echo $select;
		$stid = oci_parse($Conexao, $select);
        oci_execute($stid);

		$nrows = oci_fetch_all($stid, $results);

		if ($nrows == 1){
			$SENHATABELA = $results["SENHA"][0];
//			echo $results["SENHA"][0];
			if ($results["ALTERADA"][0] == '1')
			{
				if ($SENHATABELA == base64_encode($_POST["Senha"]))
				{
					$_SESSION['usuario'] = ABDUsuario::CarregaUsuario($results['ID'][0]);
					//$_SESSION['Sistema'] = $results["SISTEMA"][0];
				   	$_SESSION['Erro']   = NULL;
				   	echo "<script language=javascript>";
				//   	echo "document.clear();";
				   	echo "document.location = '../Controle/DemandaControleFiltro.php';";
				//	echo 'location.href = "../index.php";'; //+ "&target='. "'". '_self' ."'".'";';
					echo "</script>";
			    	return;
				}
				else
				{
					alert("Login ou senha Inv&aacute;lidos!");
					$_SESSION['Logado'] = NULL;
					echo "<script language=javascript>";
					echo "document.location = 'Principal.php';";
					echo "</script>";
				}
			}
			else
			{
				echo "<script language=javascript>";
				echo "document.location = 'Trocasenha.php?ID=".$_POST["Login"]."';";
				echo "</script>";
			}
		}
		else
		{
			$_SESSION['Erro']   = "Login ou senha Inv&aacute;lidos!";
			$_SESSION['Logado'] = NULL;
			echo "<script language=javascript>";
			echo "document.location = 'Principal.php';";
			echo "</script>";
		}
	}
	else
	{
		$_SESSION['Erro']   = "Login ou senha Inv&aacute;lidos!";
		$_SESSION['Logado'] = NULL;
		echo "<script language=javascript>";
		echo "document.location = 'Principal.php';";
		echo "</script>";
	}
}
else
{
	session_destroy();
	echo "<script language=javascript>";
	echo "document.location = 'Principal.php';";
	echo "</script>";
}
?>
