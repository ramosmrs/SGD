<?php

session_start();
echo "Aguarde...";
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

$Conexao = ConnOracle::Conecta();

if(getenv("REQUEST_METHOD") == "POST"){
	$HistDemanda = new ABDHistoricoDemanda();
	$HistDemanda->demanda = $_SESSION['demanda'];
	$HistDemanda->situacao = $_POST['situacao'];
	$HistDemanda->usuario = $_SESSION['usuario'];
	$HistDemanda->responsavel = $_POST['responsavel'];
	$HistDemanda->descricao = $_POST['descricao'];
	$HistDemanda->Gravar();
}

echo "<script language=javascript>";
echo "document.location = 'HistoricoDemandaControle.php?key=".$_SESSION['demanda']->id ."';";
echo "</script>";

?>