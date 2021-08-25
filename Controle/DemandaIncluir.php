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
	$demanda = new ABDDemanda();
	$demanda->id = $_POST["id"];
//	$demanda->tipodemanda = ABDTipoDemanda::CarregaTipoDemanda($_POST["tipodemanda"]);
	$demanda->tipodemanda = $_POST["tipodemanda"];
//	$demanda->prioridade = ABDPrioridade::CarregaPrioridade($_POST["prioridade"]);
	$demanda->prioridade = $_POST["prioridade"];
	$demanda->situacao = $_POST["situacao"];
	$demanda->titulo = $_POST["titulo"];
	$demanda->descricao = $_POST["descricao"];
	$demanda->fase = $_POST["fase"];
//	$demanda->fase = ABDFaseResolucao::CarregaFaseResolucao($_POST["fase"]);
    $mensagem = $demanda->Atualiza();  
    //new TMessage('info', $mensagem);
    $_SESSION['demanda'] = ABDDemanda::CarregaDemanda($mensagem, 1);
    
    echo "<script language=javascript>";
	echo "document.location = 'HistoricoDemandaControle.php?key=".$_SESSION['demanda']->id."';";
	echo "</script>";
	return;
}

/*    echo "<script language=javascript>";
	echo "history.back();";
	echo "</script>";
*/


?>

