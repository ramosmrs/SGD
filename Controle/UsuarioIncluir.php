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
	$usuario = new ABDUsuario();
	$usuario->id = $_POST["id"];
	$usuario->nome = $_POST["nome"];
	$usuario->telefone = $_POST["telefone"];
	$usuario->email = $_POST["email"];
	$usuario->login = $_POST["login"];
    $mensagem = $usuario->Atualiza();
    
    echo "<script language=javascript>";
	echo "document.location = 'UsuarioControle.php';";
	echo "</script>";
	return;
}

?>

