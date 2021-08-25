<?php

class ConnOracle{

// Atributo que armazena a conexгo ao banco de dados.
	private static $conexao = false;

// Dados do servidor Tauoca(PRODUCAO):
/*
        private static $Servidor = '10.9.41.19:1530/ergon';
        private static $Usuario  = 'demandas';
        private static $Senha    = 'dmdprd15';
*/
// Dados do servidor Xicu(DESENVOLVIMENTO)
        private static $Servidor = '10.9.42.19:1530/ergond';
        private static $Usuario  = 'demandas';
        private static $Senha    = 'dmddes09';
        
        
// Mйtodo de construзгo da classe.
// Ao ser instanciada, a classe automaticamente jб se conecta ao banco, se jб nгo houver nenhuma conexгo.
    public function __construct() {
    	date_default_timezone_set( 'America/Sao_Paulo' );
		return self::GetConn();
	}

// Mйtodo para conexгo ao banco
// Executado quando nгo existe uma instвncia da classe
	public static function Conecta(){
	    //Variбveis de ambiente:
        putenv ( "NLS_LANG=portuguese_brazil.we8iso8859p1" );
        PutEnv ( "ORACLE_SID=ergond" );
        PutEnv ( "ORACLE_HOME=/home/oracle/product/10.2.0/db_1/" );
        PutEnv ( "TNS_ADMIN=/home/oracle/product/10.2.0/db_1/network/admin" );
        // Mensagens de erro:
		$msg[0] = "Conexao com o banco falhou!";
		$msg[1] = "Nao foi possivel selecionar o banco de dados!";
	
	    // Fazendo a conexao com o servidor Oracle. 
		// O prуprio OCI_CONNECT JБ SE ENCARREGA DE MANTER UMA ЪNICA CONEXГO, SENDO CHAMADO DESSA MANEIRA.
		self::$conexao = oci_connect(self::$Usuario, self::$Senha, self::$Servidor);
		return self::$conexao;
	}
	
// Mйtodo que retorna o Atributo de conexгo.
	public static function GetConn(){
	   return self::Conecta();
	}
}
?>