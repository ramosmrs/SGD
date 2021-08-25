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

$Conexao = ConnOracle::Conecta();

$usuario = new ABDUsuario();
if (getenv("REQUEST_METHOD") == "GET"){
	if(isset($_GET["key"]) && $_GET["key"] != 0 && $_GET["key"] != null){
		$usuario->Carrega($_GET["key"]);
	}
	else $usuario = new Usuario();
}
else $usuario = new Usuario();

// Monta a estrutura da página    
$Conteudo = "

<form enctype='multipart/form-data' name='form_usuario' method='post'> 
<table> 
<tr> 
<td> 
<font style='font-family:Arial; color:black; font-size:14'> 
Código:</font> 
</td> 
<td> 
<input class='tfield_disabled' name='id' value='$usuario->id' type='text' style='width:20' readonly='1'> 
</td> 
</tr> 
<tr> 
<td> 
<font style='font-family:Arial; color:black; font-size:14'> 
Nome:</font> 
</td> 
<td> 
<input class='tfield' name='nome' value='$usuario->nome' type='text' style='width:300'> 
</td> 
</tr> 
<tr> 
<td> 
<font style='font-family:Arial; color:black; font-size:14'> 
Telefone:</font> 
</td> 
<td> 
<input class='tfield' name='telefone' value='$usuario->telefone' type='text' style='width:300'> 
</td> 
</tr> 
<tr> 
<td> 
<font style='font-family:Arial; color:black; font-size:14'> 
e-mail:</font> 
</td> 
<td> 
<input class='tfield' name='email' value='$usuario->email' type='text' style='width:300'> 
</td> 
</tr> 
<tr> 
<td> 
<font style='font-family:Arial; color:black; font-size:14'> 
Login:</font> 
</td> 
<td> 
<input class='tfield' name='login' value='$usuario->login' type='text' style='width:300'> 
</td> 
</tr> 
<tr> 
<td> 
</td> 
<td> 
<input class='tfield' name='action1' type='button' value='Salvar' onclick='document.form_usuario.action=\"UsuarioIncluir.php\"; document.form_usuario.submit()'> 
</td> 
</tr> 
</table> 
</form> 

";

//Exibição
$template = ElementosPagina::$cabecalhoTela . ElementosPagina::$cabecalhoCCTela . ElementosPagina::$menuTela . ElementosPagina::$rodapeTela;
$template = str_replace('#USUARIO#', LoginControle::ExibeLinhaLogin(), $template);
$template = str_replace('#CONTENT#', $Conteudo, $template);
echo $template;

?>
