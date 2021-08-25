<?php
session_start(); 
//$_SESSION['usuario']= ABDUsuario::CarregaUsuario(1);

if(isset($_SESSION['usuario']->id)){
	if ($_SESSION['usuario']->id == 0){
		echo "<script language=javascript>";
		echo "document.location = 'Login/index.php';";
//                echo "document.locaton = 'Login/Principal.php?param=logout'"
		echo "</script>";
	}
}
else{
	echo "<script language=javascript>";
	echo "document.location = 'Login/index.php';";
//        echo "document.location = 'Login/Principal.php?param=logout'"
	echo "</script>";
}

function __autoload($classe)
{
	   $pastas = array('AcessoBancoDados','app.widgets', 'Controle', 'Modelo');
	   foreach ($pastas as $pasta)
	   {
		      if (file_exists("{$pasta}/{$classe}.class.php"))
        {
			         include_once "{$pasta}/{$classe}.class.php";
        }
	   }
}

class TApplication
{
	private $login;
	
	   static public function run()
	   {
		   	//  $template = file_get_contents('template.html');
		   	  $template = ElementosPagina::$cabecalhoTela . ElementosPagina::$cabecalhoCCTela . ElementosPagina::$menuTela2 . ElementosPagina::$rodapeTela;
	   	
			  $content = '';
		      if ($_GET)
		      {
			         $class = $_GET['class'];
			        // $method = $_GET['method'];
			         if (class_exists($class))
			         {
				            $pagina = new $class;
				            ob_start();
				            $pagina->show();
				            $content = ob_get_contents();
				            ob_end_clean();
			         }
			         else if (function_exists($method))
			         {
				            call_user_func($method, $_GET);
			         }
		      }
			  $template = str_replace('#USUARIO#', LoginControle::ExibeLinhaLogin2(), $template);
		      echo str_replace('#CONTENT#', $content, $template);
	   }
}
TApplication::run();

?>
