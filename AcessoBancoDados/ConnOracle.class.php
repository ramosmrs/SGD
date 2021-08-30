<?php

class ConnOracle{

// Atributo que armazena a conex�o ao banco de dados.
	private static $conexao = false;

// Dados do servidor Tauoca(PRODUCAO):
/*
        private static $Servidor = '10.9.41.19:1530/ergon';
        private static $Usuario  = 'demandas';
        private static $Senha    = 'senha';
*/
// Dados do servidor Xicu(DESENVOLVIMENTO)
        private static $Servidor = '10.9.42.19:1530/ergond';
        private static $Usuario  = 'demandas';
        private static $Senha    = 'senha';
        
        
// M�todo de constru��o da classe.
// Ao ser instanciada, a classe automaticamente j� se conecta ao banco, se j� n�o houver nenhuma conex�o.
    public function __construct() {
    	date_default_timezone_set( 'America/Sao_Paulo' );
		return self::GetConn();
	}

// M�todo para conex�o ao banco
// Executado quando n�o existe uma inst�ncia da classe
	public static function Conecta(){
	    //Vari�veis de ambiente:
        putenv ( "NLS_LANG=portuguese_brazil.we8iso8859p1" );
        PutEnv ( "ORACLE_SID=ergond" );
        PutEnv ( "ORACLE_HOME=/home/oracle/product/10.2.0/db_1/" );
        PutEnv ( "TNS_ADMIN=/home/oracle/product/10.2.0/db_1/network/admin" );
        // Mensagens de erro:
		$msg[0] = "Conexao com o banco falhou!";
		$msg[1] = "Nao foi possivel selecionar o banco de dados!";
	
	    // Fazendo a conexao com o servidor Oracle. 
		// O pr�prio OCI_CONNECT J� SE ENCARREGA DE MANTER UMA �NICA CONEX�O, SENDO CHAMADO DESSA MANEIRA.
		self::$conexao = oci_connect(self::$Usuario, self::$Senha, self::$Servidor);
		return self::$conexao;
	}
	
// M�todo que retorna o Atributo de conex�o.
	public static function GetConn(){
	   return self::Conecta();
	}
}
?>