<?PHP

  class ABDTipoUsuario extends TipoUsuario{

      private static $conn;
	  private $ppnSQLCODE = '';
	  private $ppsSQLERRM = '';
      
	  public function __construct(){
	     self::ConectaBD();
	  }

	  private static function ConectaBD(){
	  	self::$conn = ConnOracle::GetConn();
	  }
	  
	  public function Insere(){
		$ppsDESCRICAO = $this->descricao;
		$ppsCIND_OBJ_CNTRR = 'S';
		$ppnID = '';
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
		
		$query = "BEGIN PCK_TIPOUSUARIO.prcInsert(:ppsDESCRICAO, :ppsCIND_OBJ_CNTRR, :ppnID, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);

		OCIBindByName($stmt,":ppsDESCRICAO",$ppsDESCRICAO); 
		OCIBindByName($stmt,":ppsCIND_OBJ_CNTRR",$ppsCIND_OBJ_CNTRR); 
		OCIBindByName($stmt,":ppnID",$ppnID, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
		
		oci_execute($stmt);	
		
		$this->id = $ppnID;
		return $this->ppsSQLERRM;
	}

	  public function Atualiza(){
		$ppnID = $this->id;
		$ppsDESCRICAO = $this->descricao;
		$ppsCIND_OBJ_CNTRR = 'S';
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
		$query = "BEGIN PCK_TIPOUSUARIO.prcUpdate(:ppnID, :ppsDESCRICAO, :ppsCIND_OBJ_CNTRR, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
		OCIBindByName($stmt,":ppsDESCRICAO",$ppsDESCRICAO); 
		OCIBindByName($stmt,":ppsCIND_OBJ_CNTRR",$ppsCIND_OBJ_CNTRR); 
		OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		
		return $this->ppsSQLERRM;
	}

    public function Exclui(){
		$ppnID = $this->id;
		$ppsCIND_OBJ_CNTRR = 'S';
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
		$query = "BEGIN PCK_TIPOUSUARIO.prcDelete(:ppnID, :ppsCIND_OBJ_CNTRR, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
		OCIBindByName($stmt,":ppsCIND_OBJ_CNTRR",$ppsCIND_OBJ_CNTRR); 
		OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		
		return $this->ppsSQLERRM;
	}

    public function Restaura(){
		$ppnID = $this->id;
		$ppsCIND_OBJ_CNTRR = 'S';
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
		$query = "BEGIN PCK_TIPOUSUARIO.prcRestaura(:ppnID, :ppsCIND_OBJ_CNTRR, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
		OCIBindByName($stmt,":ppsCIND_OBJ_CNTRR",$ppsCIND_OBJ_CNTRR); 
		OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		
		return $this->ppsSQLERRM;
	}

  function Carrega(){
		$ppnID = $this->id;
		$ppsDESCRICAO = '';
		$ppsCIND_OBJ_CNTRR = 'S';
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
		$query = "BEGIN PCK_TIPOUSUARIO.prcSelect(:ppnID, :ppsDESCRICAO, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
		OCIBindByName($stmt,":ppsDESCRICAO",$ppsDESCRICAO, 50); 
		OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		
		$TpUsuario = new Tipousuario();
		$Tpusuario->id = $ppnID;
		$TpUsuario->descricao = $ppsDESCRICAO;
		
		return $TpUsuario;
	}

  static function CarregaTipoUsuario($id){
  		self::ConectaBD();
  		$ppnID = $id;
		$ppsDESCRICAO = '';
		$ppsCIND_OBJ_CNTRR = 'S';
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_TIPOUSUARIO.prcSelect(:ppnID, :ppsDESCRICAO, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
		OCIBindByName($stmt,":ppsDESCRICAO",$ppsDESCRICAO, 50); 
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		
		$TpUsuario = new Tipousuario();
		$TpUsuario->id = $ppnID;
		$TpUsuario->descricao = $ppsDESCRICAO;
		return $TpUsuario;
		
	}
	
    static function ListarTodosAtivos(){
    	self::ConectaBD();
 		$ppsLISTAGEM = '';
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_TIPOUSUARIO.prcListarTodosAtivos(:ppsLISTAGEM, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppsLISTAGEM",$ppsLISTAGEM, 8000); 
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		
		return $ppsLISTAGEM;
	}	
	
    static function ListarTodosInativos(){
    	self::ConectaBD();
 		$ppsLISTAGEM = '';
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_TIPOUSUARIO.prcListarTodosInativos(:ppsLISTAGEM, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppsLISTAGEM",$ppsLISTAGEM, 8000); 
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		
		return $ppsLISTAGEM;
	}
   
    static function ListarTodosArray(){
    	self::ConectaBD();
 		$ppsLISTAGEM = '';
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_TIPOUSUARIO.prcListarArray(:ppsLISTAGEM, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppsLISTAGEM",$ppsLISTAGEM, 8000); 
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	

		$ArrTodos = array();
		
		$ArrTmp = explode('|',$ppsLISTAGEM);
		if($ArrTmp[0] != null) {
			for($i = 0; $i<count($ArrTmp);$i++){
			 	$reg = explode('#^',$ArrTmp[$i]);
				$tpusuario = new TipoUsuario();
				$tpusuario->id = $reg[0];
				$tpusuario->descricao = $reg[1];
				$ArrTodos[$i] = $tpusuario;
			}
		}
		return $ArrTodos;
	}	
	
     
	
 
  }
?>