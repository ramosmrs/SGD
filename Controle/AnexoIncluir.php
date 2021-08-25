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

echo "Aguarde...<br>";
if (getenv("REQUEST_METHOD") == "POST"){
	if($_FILES["arquivo"]["size"] != 0){
		$arquivo = $_FILES["arquivo"]["tmp_name"]; 
		if ( $arquivo != "none" )
		{
			$tamanho = $_FILES["arquivo"]["size"];
			$tipo    = $_FILES["arquivo"]["type"];
			$nome    = $_FILES["arquivo"]["name"];
			$demanda_id = $_SESSION['demanda']->id;
			if($tamanho <= 3145728){ 
				$fp = fopen($arquivo, "rb");
				$conteudo = fread($fp, $tamanho);
				$c = ConnOracle::GetConn();
				$stmt = OCIParse($c, "insert into anexos (id, demanda_id, nomearq, tipo, descricao, tamanho, anexo) values (anexos_id.nextval, :demanda_id, :nomearq, :tipo, :descricao, :tamanho, :the_blob)");
				$lob = oci_new_descriptor($c, OCI_D_LOB);
			    oci_bind_by_name($stmt, ':nomearq', $nome);
			    oci_bind_by_name($stmt, ':tipo', $tipo);
				oci_bind_by_name($stmt, ':demanda_id', $demanda_id);
				oci_bind_by_name($stmt, ':descricao', $nome);
				oci_bind_by_name($stmt, ':tamanho', $tamanho);
			    OCIBindByName($stmt, ':the_blob', $lob, -1, OCI_B_BLOB); 
				$lob->writeTemporary($conteudo, OCI_TEMP_BLOB);
				$result = oci_execute($stmt, OCI_DEFAULT);
				if ($result){
				//	$Demanda = new ABDDemanda();
				//	$Demanda = ABDDemanda::CarregaDemanda($_SESSION['demanda']->id, 1);
					$Historico = new ABDHistoricoDemanda();
					$Historico->demanda = $_SESSION['demanda'];
					$Historico->usuario = $_SESSION['usuario'];
					//echo "<br>" . $_SESSION['demanda']->situacao->id . "<br>";
					//echo "<br>" . $_SESSION['demanda']->responsavel->id . "<br>";
					$Historico->responsavel = $_SESSION['demanda']->responsavel->id;
					$Historico->situacao = $_SESSION['demanda']->situacao->id;
					$Historico->descricao = "O arquivo \"$nome\" foi anexado.";
					$mensagem = $Historico->Gravar();
				}
				else echo "Erro na gravação do anexo. <br>";
				
				oci_commit($c);
				$lob->close(); 
				fclose($fp);
				

			}
			else echo "Arquivo muito grande.<br>";
		}
	}
	else echo "<br>Erro na Inclusão.<br>";
}

echo "<script language=javascript>";
echo "document.location = 'HistoricoDemandaControle.php?key=".$_SESSION['demanda']->id."';";
echo "</script>";

?>

