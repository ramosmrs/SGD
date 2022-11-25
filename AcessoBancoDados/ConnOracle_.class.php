<?php

class ConnOracle{
	private static $conexao;

// Tauoca:
        private static $Servidor = '10.9.41.19:1530/ergon';
        private static $Usuario  = 'DEMANDAS';
        private static $Senha    = '***';

// Xicu:
/*      private static $Servidor = '10.9.42.19:1530/ergond';
        private static $Usuario  = 'DEMANDAS';
        private static $Senha    = '***';
*/
//local:
/*	private static $Servidor = 'localhost:1521/xe';
    private static $Usuario = 'demandas';
	private static $Senha = '***';
*/
    public function __construct() {
    	date_default_timezone_set( 'America/Sao_Paulo' );
		return self::GetConn();
	}

	public static function Conecta(){

                putenv ( "NLS_LANG=portuguese_brazil.we8iso8859p1" );
                PutEnv ( "ORACLE_SID=ergond" );
                PutEnv ( "ORACLE_HOME=/home/oracle/product/10.2.0/db_1/" );
                PutEnv ( "TNS_ADMIN=/home/oracle/product/10.2.0/db_1/network/admin" );
                
		$msg[0] = "Conexao com o banco falhou!";
		$msg[1] = "Nao foi possivel selecionar o banco de dados!";
	
		// Fazendo a conexao com o servidor Oracle
		self::$conexao = oci_connect(self::$Usuario, self::$Senha, self::$Servidor);
		if (!self::$conexao) {
		//	$e = oci_error();
                        $msgerr = "setTimeout(\"document.location='Principal.php'\", 5000);";
		//	trigger_error(htmlentities($e['message'], ENT_QUOTES),E_USER_ERROR);
                        new TMessage('info', 'Erro na conexao ao banco de dados: ');
//              echo '<meta http-equiv="refresh" content="5;URL=the_other_page.htm">';
                echo "<script language=javascript>";
//                echo $msgerr
		echo "document.location = 'Principal.php'";
		echo "</script>";
		}
		
		return self::$conexao;
	}
	
	public static function GetConn(){
	   return self::Conecta();
	}
}
?>
