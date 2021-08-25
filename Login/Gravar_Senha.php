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
		if (getenv("REQUEST_METHOD") == "POST"){
		$select_1 = "SELECT ID, LOGIN, SENHA, ALTERADA, SISTEMA FROM USUARIO WHERE LOGIN = '".$_POST["Usuario"].
		                                                    "' AND SENHA = '".base64_encode($_POST["Senha"])."' ".
															" AND SISTEMA IN ('SGD', 'SGA')".
															" AND ATIVO = 1 ";

		$stid_1 = oci_parse($Conexao, $select_1);
        oci_execute($stid_1);
		
		$nrows_1 = oci_fetch_all($stid_1, $results_1);
		if ($nrows_1 == 1){
			$SENHATABELA = $results_1["SENHA"][0];
			if ($_POST["Usuario"] != '' && $_POST["Senha"] != '' && 
			    $_POST["Novasenha"] != '' && $_POST["Novasenha2"] != '')
			{
				if($_POST["Novasenha"] == $_POST["Novasenha2"]){
				   $V_SENHA = base64_encode($_POST["Novasenha"]);
	 		       $select = "UPDATE USUARIO SET
				                     SENHA     = '$V_SENHA',
				                     ALTERADA  = '1'
				               WHERE ID = '".$results_1["ID"][0]."'";
	 		        alert($select);
			        $stid = oci_parse($Conexao, $select);
			        $r = oci_execute($stid);
			
			        if (!$r) 
			        {
			            $e = oci_error($stid); 
			            alert("Erro na gravacao da senha.");
						echo "<script language=javascript>";
						echo "document.location = 'Trocasenha.php?ID=".$_POST["Usuario"]."';";
						echo "</script>";
			        }
			        else
			        {
				        alert("Senha alterada com sucesso.");
				        $_SESSION['usuario'] = ABDUsuario::CarregaUsuario($results_1["ID"][0]);
					   	$_SESSION['Erro']   = NULL;
				        echo "<script language=javascript>";
				        echo "document.location = '../index.php';";
				        echo "</script>";
			        }
				}
				
				else{
					alert("As novas senhas sao diferentes.");
					echo "<script language=javascript>";
					echo "document.location = 'Trocasenha.php?ID=".$_POST["Usuario"]."';";
					echo "</script>";
				}
				
			}
		}
		ELSE
		{
				alert("Senha inválida.");
				echo "<script language=javascript>";
				echo "document.location = 'Trocasenha.php?ID=".$_POST["Usuario"]."';";
				echo "</script>";
		}
	}

?>
