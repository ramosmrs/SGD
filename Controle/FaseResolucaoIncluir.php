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
	$faseresolucao = new ABDFaseResolucao();
	$faseresolucao->id = $_POST["id"];
	$faseresolucao->descricao = $_POST["descricao"];
    $mensagem = $faseresolucao->Atualiza();  
    
    echo "<script language=javascript>";
	echo "document.location = 'FaseResolucaoControle.php';";
	echo "</script>";
	return;
}

/*    echo "<script language=javascript>";
	echo "history.back();";
	echo "</script>";
*/


?>

