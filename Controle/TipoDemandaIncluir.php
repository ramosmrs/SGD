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

echo "Por favor, aguarde...<br>";
if (getenv("REQUEST_METHOD") == "POST"){
	$tipodemanda = new ABDTipoDemanda();
	$tipodemanda->id = $_POST["id"];
	$tipodemanda->descricao = $_POST["descricao"];
    $mensagem = $tipodemanda->Atualiza();  
    
    echo "<script language=javascript>";
	echo "document.location = 'TipoDemandaControle.php';";
	echo "</script>";
	return;
}

?>

