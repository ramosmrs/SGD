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

echo "Aguarde...<br>";

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

if (getenv("REQUEST_METHOD") == "GET"){
		$conn = ConnOracle::GetConn();
		$varid = $_GET['id'];
		
		$qrnome = 'select nomearq from anexos where id = '.$varid;
		$s1 = oci_parse ($conn, $qrnome);
		oci_execute($s1);
		
		$results = oci_fetch_all($s1, $res);
		$nome = $res["NOMEARQ"][0];
		
		$query = 'delete from anexos where id = :varid';
		$s = oci_parse ($conn, $query);
		oci_bind_by_name($s, ':varid', $varid);
		oci_execute($s);
		
		$Historico = new ABDHistoricoDemanda();
		$Historico->demanda = $_SESSION['demanda'];
		$Historico->usuario = $_SESSION['usuario'];
		$Historico->responsavel = null;
		$Historico->situacao = null;
		$Historico->descricao = "O arquivo \"$nome\" foi excluído.";
		$mensagem = $Historico->Gravar();
		
}

echo "<script language=javascript>";
echo "document.location = 'HistoricoDemandaControle.php?key=".$_SESSION['demanda']->id."';";
echo "</script>";
