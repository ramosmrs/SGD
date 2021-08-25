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
$Conexao = ConnOracle::Conecta();

if(getenv("REQUEST_METHOD") == "POST"){
	$mensagem = new ABDAnexos();
	$mensagem->recuperar($_SESSION['demanda']->id);
}

echo "<script language=javascript>";
echo "document.location = 'HistoricoDemandaControle.php?key=".$_SESSION['demanda']->id ."';";
echo "</script>";
?>
