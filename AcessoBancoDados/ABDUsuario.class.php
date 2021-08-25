<?PHP

  class ABDUsuario extends Usuario{

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
	  	$ppsTIPOUSUARIO_ID = $this->tipousuario->id;
	  	$ppsNOME = $this->nome;
	  	$ppsTELEFONE = $this->telefone;
	  	$ppsEMAIL = $this->email;
	  	$ppsLOGIN = $this->login;
		$ppsCIND_OBJ_CNTRR = 'S';
		$ppnID = '';
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
		
		$query = "BEGIN PCK_Usuario.prcInsert(:ppsTIPOUSUARIO_ID, :ppsNOME, :ppsTELEFONE, :ppsEMAIL, :ppsLOGIN, :ppsCIND_OBJ_CNTRR, :ppnID, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);

        OCIBindByName($stmt,":ppsTIPOUSUARIO_ID",$ppsTIPOUSUARIO_ID);
        OCIBindByName($stmt,":ppsNOME",$ppsNOME);
        OCIBindByName($stmt,":ppsTELEFONE",$ppsTELEFONE);
        OCIBindByName($stmt,":ppsEMAIL",$ppsEMAIL);
        OCIBindByName($stmt,":ppsLOGIN",$ppsLOGIN);
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
	  	$ppsTIPOUSUARIO_ID = $this->tipousuario;
	  	$ppsNOME = $this->nome;
	  	$ppsTELEFONE = $this->telefone;
	  	$ppsEMAIL = $this->email;
	  	$ppsLOGIN = $this->login;
		$ppsCIND_OBJ_CNTRR = 'S';
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
		$query = "BEGIN PCK_Usuario.prcUpdate(:ppnID, :ppsTIPOUSUARIO_ID, :ppsNOME, :ppsTELEFONE, :ppsEMAIL, :ppsLOGIN, :ppsCIND_OBJ_CNTRR, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
        OCIBindByName($stmt,":ppsTIPOUSUARIO_ID",$ppsTIPOUSUARIO_ID);
        OCIBindByName($stmt,":ppsNOME",$ppsNOME);
        OCIBindByName($stmt,":ppsTELEFONE",$ppsTELEFONE);
        OCIBindByName($stmt,":ppsEMAIL",$ppsEMAIL);
        OCIBindByName($stmt,":ppsLOGIN",$ppsLOGIN);
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
		$query = "BEGIN PCK_Usuario.prcDelete(:ppnID, :ppsCIND_OBJ_CNTRR, :ppnSQLCODE, :ppsSQLERRM); END;";
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
		$query = "BEGIN PCK_Usuario.prcRestaura(:ppnID, :ppsCIND_OBJ_CNTRR, :ppnSQLCODE, :ppsSQLERRM); END;";
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
	  	$ppsTIPOUSUARIO_ID = 0;
	  	$ppsNOME = '';
	  	$ppsTELEFONE = '';
	  	$ppsEMAIL = '';
	  	$ppsLOGIN = '';
		$ppsCIND_OBJ_CNTRR = 'S';
		$this->ppnSQLCODE = 0;
		$this->ppsSQLERRM = '';
		$query = "BEGIN PCK_Usuario.prcSelect(:ppnID, :ppsTIPOUSUARIOID, :ppsNOME, :ppsTELEFONE, :ppsEMAIL, :ppsLOGIN, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
        OCIBindByName($stmt,":ppsTIPOUSUARIOID",$ppsTIPOUSUARIOID, 10,OCI_B_INT);
        OCIBindByName($stmt,":ppsNOME",$ppsNOME, 100, SQLT_CHR);
        OCIBindByName($stmt,":ppsTELEFONE",$ppsTELEFONE, 100, SQLT_CHR);
        OCIBindByName($stmt,":ppsEMAIL",$ppsEMAIL, 200, SQLT_CHR);
        OCIBindByName($stmt,":ppsLOGIN",$ppsLOGIN, 200, SQLT_CHR);
		OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		
		$Usuario = new Usuario();
		$Usuario->id = $ppnID;
		$Usuario->tipousuario = ABDTipoUsuario::CarregaTipoUsuario($ppsTIPOUSUARIO_ID);
		$Usuario->nome = $ppsNOME;
		$Usuario->telefone = $ppsTELEFONE;
		$Usuario->email = $ppsEMAIL;
		$Usuario->login = $ppsLOGIN;
		
		return $Usuario;
	}

  static function CarregaUsuario($id){
  		self::ConectaBD();
		$ppnID = (int)$id;
	  	(int)$ppsTIPOUSUARIO_ID = 0;
	  	$ppsNOME = '';
	  	$ppsTELEFONE = '';
	  	$ppsEMAIL = '';
	  	$ppsLOGIN = '';
	  	$ppsSISTEMA = '';
		$ppsCIND_OBJ_CNTRR = 'S';
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_Usuario.prcSelect(:ppnID, :ppsNOME, :ppsTIPOUSUARIO_ID, :ppsTELEFONE, :ppsEMAIL, :ppsLOGIN, :ppsSISTEMA, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
        OCIBindByName($stmt,":ppsTIPOUSUARIO_ID",$ppsTIPOUSUARIO_ID, 10, SQLT_CHR);
        OCIBindByName($stmt,":ppsNOME",$ppsNOME, 100, SQLT_CHR);
        OCIBindByName($stmt,":ppsTELEFONE",$ppsTELEFONE, 100, SQLT_CHR);
        OCIBindByName($stmt,":ppsEMAIL",$ppsEMAIL, 200, SQLT_CHR);
        OCIBindByName($stmt,":ppsLOGIN",$ppsLOGIN, 200, SQLT_CHR);
        OCIBindByName($stmt,":ppsSISTEMA",$ppsSISTEMA, 100, SQLT_CHR);
        
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10, OCI_B_INT); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		
		$Usuario = new Usuario();
		$Usuario->id = $ppnID;
		$Usuario->tipousuario = ABDTipoUsuario::CarregaTipoUsuario(intval($ppsTIPOUSUARIO_ID));
		$Usuario->nome = $ppsNOME;
		$Usuario->telefone = $ppsTELEFONE;
		$Usuario->email = $ppsEMAIL;
		$Usuario->login = $ppsLOGIN;
		$Usuario->sistema = $ppsSISTEMA;
		
		return $Usuario;
  	}
	
    static function ListarTodosAtivos(){
    	self::ConectaBD();
 		$ppsLISTAGEM = '';
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_Usuario.prcListarTodosAtivos(:ppsLISTAGEM, :ppnSQLCODE, :ppsSQLERRM); END;";
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
		$query = "BEGIN PCK_Usuario.prcListarTodosInativos(:ppsLISTAGEM, :ppnSQLCODE, :ppsSQLERRM); END;";
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
		$query = "BEGIN PCK_Usuario.prcListarArray(:ppsLISTAGEM, :ppnSQLCODE, :ppsSQLERRM); END;";
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
				$usuario = new Usuario();
				$usuario->id = $reg[0];
				$usuario->nome = $reg[1];
				$ArrTodos[$i] = $usuario;
			}
		}
		
		return $ArrTodos;
	}	
	
	static function ValidarLogon($login, $senha){
	//	new TMessage('info', $login.'-'.$senha)
		return true;
	}
	
  }
?>