<?PHP

  class ABDHistoricoDemanda extends HistoricoDemanda{

    private static $conn;
	  private $ppnSQLCODE = '';
	  private $ppsSQLERRM = '';
      
	  public function __construct(){
	     self::ConectaBD();
	  }

	  private static function ConectaBD(){
	  	self::$conn = ConnOracle::GetConn();
	  }
	  
	  public function Gravar(){
        $ppnDEMANDA_ID = $this->demanda->id;
        $ppnSITUACAO_ID = $this->situacao;
        $ppnUSUARIO_ID = $this->usuario->id;
        $ppnRESPONSAVEL_ID = $this->responsavel;
        $ppsDESCRICAO = $this->descricao;
        $ppsCIND_OBJ_CNTRR = 'S';
        $ppnID = 0;            
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
		$query = "BEGIN PCK_HistoricoDemanda.prcInsert(:ppnDEMANDA_ID, :ppnSITUACAO_ID, :ppnUSUARIO_ID, :ppnRESPONSAVEL_ID, :ppsDESCRICAO, :ppsCIND_OBJ_CNTRR, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);

        OCIBindByName($stmt,":ppnDEMANDA_ID",$ppnDEMANDA_ID);
        OCIBindByName($stmt,":ppnSITUACAO_ID",$ppnSITUACAO_ID);
        OCIBindByName($stmt,":ppnUSUARIO_ID",$ppnUSUARIO_ID);
        OCIBindByName($stmt,":ppnRESPONSAVEL_ID",$ppnRESPONSAVEL_ID);
        OCIBindByName($stmt,":ppsDESCRICAO",$ppsDESCRICAO);
	OCIBindByName($stmt,":ppsCIND_OBJ_CNTRR",$ppsCIND_OBJ_CNTRR); 
	OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10); 
	OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
	oci_execute($stmt);	
		
	return $this->ppsSQLERRM;
	}

  function Carregar(){
        $ppnDEMANDA_ID = 0;
        $ppnSITUACAO_ID = 0;
        $ppnUSUARIO_ID = 0;
        $ppsDESCRICAO = '';
        $ppsCIND_OBJ_CNTRR = 'S';
        $ppnID = $this->id;            
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
  		$query = "BEGIN PCK_HistoricoDemanda.prcSelect(:ppnID, :ppnDEMANDA_ID, :ppnSITUACAO_ID, :ppnUSUARIO_ID, :ppsDATA, :ppsDESCRICAO, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
    OCIBindByName($stmt,":ppnDEMANDA_ID",$ppnDEMANDA_ID, 10);
    OCIBindByName($stmt,":ppnSITUACAO_ID",$ppnSITUACAO_ID, 10);
    OCIBindByName($stmt,":ppnUSUARIO_ID",$ppnUSUARIO_ID, 10);
    OCIBindByName($stmt,":ppsDATA",$ppsDATA, 500, SQLT_CHR);
    OCIBindByName($stmt,":ppsDESCRICAO",$ppsDESCRICAO, 500, SQLT_CHR);
		OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		
		$HistoricoDemanda = new HistoricoDemanda();
		$HistoricoDemanda->id = $ppnID;
		$HistoricoDemanda->demanda = ABDDemanda::CarregaDemanda($ppnDEMANDA_ID, 2);
		$HistoricoDemanda->situacao = ABDSituacao::CarregaSituacao($ppnSITUACAO_ID);
		$HistoricoDemanda->usuario = ABDUsuario::CarregaUsuario($ppnUSUARIO_ID);
		$HistoricoDemanda->descricao = $ppsDESCRICAO;
		$HistoricoDemanda->data = $ppsDATA;
		return $HistoricoDemanda;
	}

  static function CarregaHistoricoDemanda($id){
  		self::ConectaBD();
        $ppnDEMANDA_ID = 0;
        $ppnSITUACAO_ID = 0;
        $ppnUSUARIO_ID = 0;
        $ppsDESCRICAO = '';
        $ppsCIND_OBJ_CNTRR = 'S';
        $ppnID = $id;            
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
  		$query = "BEGIN PCK_HistoricoDemanda.prcSelect(:ppnID, :ppnDEMANDA_ID, :ppnSITUACAO_ID, :ppnUSUARIO_ID, :ppsDATA, :ppsDESCRICAO, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);

		OCIBindByName($stmt,":ppnID",$ppnID); 
        OCIBindByName($stmt,":ppnDEMANDA_ID",$ppnDEMANDA_ID, 10);
        OCIBindByName($stmt,":ppnSITUACAO_ID",$ppnSITUACAO_ID, 10);
        OCIBindByName($stmt,":ppnUSUARIO_ID",$ppnUSUARIO_ID, 10);
        OCIBindByName($stmt,":ppsDATA",$ppsDATA, 500, SQLT_CHR);
        OCIBindByName($stmt,":ppsDESCRICAO",$ppsDESCRICAO, 4000, SQLT_CHR);
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	

		$HistoricoDemanda = new HistoricoDemanda();
		$HistoricoDemanda->id = $ppnID;
		$HistoricoDemanda->demanda = ABDDemanda::CarregaDemanda($ppnDEMANDA_ID, 2);
		$HistoricoDemanda->situacao = ABDSituacao::CarregaSituacao($ppnSITUACAO_ID);
		$HistoricoDemanda->usuario = ABDUsuario::CarregaUsuario($ppnUSUARIO_ID);
		$HistoricoDemanda->descricao = $ppsDESCRICAO;
		$HistoricoDemanda->data = $ppsDATA;
		return $HistoricoDemanda;
	}
	
    static function prcListarHistDemanda(){
    	self::ConectaBD();
    	$ppnDEMANDAID = $this->demanda->id;
 		$ppsLISTAGEM = '';
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_HistoricoDemanda.prcListarArray(:ppnDEMANDAID, :ppsLISTAGEM, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnDEMANDAID",$ppnDEMANDAID);		
		OCIBindByName($stmt,":ppsLISTAGEM",$ppsLISTAGEM, 8000, SQLT_CHR); 
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
	
		return $ppsLISTAGEM;
	}	
	
    static function ListarTodosArray($idDemanda){
    	self::ConectaBD();
    	$ppnDEMANDAID = $idDemanda;
 		$ppsLISTAGEM = '';
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_HistoricoDemanda.prcListarArray(:ppnDEMANDAID, :ppsLISTAGEM, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnDEMANDAID",$ppnDEMANDAID);			
		OCIBindByName($stmt,":ppsLISTAGEM",$ppsLISTAGEM, 8000); 
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
	
		$ArrTodos = array();
		
		$ArrTmp = explode('|',$ppsLISTAGEM);
		if($ArrTmp[0] != null) {
			for($i = 0; $i<count($ArrTmp);$i++){
				$ArrTodos[$i] = ABDHistoricoDemanda::CarregaHistoricoDemanda($ArrTmp[$i]);
			}
		}
		return $ArrTodos;
	}	
  }
?>
