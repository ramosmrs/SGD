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
if (getenv("REQUEST_METHOD") == "GET"){
		$conn = ConnOracle::GetConn();
		$varid = $_GET['id'];
		$query = 'select nomearq, tipo, tamanho, anexo from anexos where id = :varid';
		$s = oci_parse ($conn, $query);
		oci_bind_by_name($s, ':varid', $varid);
		oci_execute($s);
		$arr = oci_fetch_array($s, OCI_ASSOC);
		$retorno = array();
		if (is_object($arr['ANEXO'])) {  // protect against a NULL LOB
			$nome = $arr['NOMEARQ'];
			$tipo = $arr['TIPO'];
			$tamanho = $arr['TAMANHO'];
		    $conteudo = $arr['ANEXO']->load();
		    $arr['ANEXO']->free();
		    
		    header('Content-Description: File Transfer');
			header('Content-Disposition: attachment; filename="'.$nome.'"');
//			header('Content-Type: application/octet-stream');
			Header('Content-type: ' .$tipo);
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . $tamanho);
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Expires: 0');

			ECHO $conteudo;
		}
}



?>