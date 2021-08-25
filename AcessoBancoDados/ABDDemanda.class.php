<?PHP

  class ABDDemanda extends Demanda{
  	
      private static $conn;
	  private $ppnSQLCODE = '';
	  private $ppsSQLERRM = '';
      
	  public function __construct(){
	     self::ConectaBD();
	  }
	  private static function ConectaBD(){
	  	self::$conn = ConnOracle::GetConn();
	  }
	  
	  public function Atualiza(){
	  	$ppnID = $this->id;
	  	$ppnTIPODEMANDA_ID = $this->tipodemanda;
		$ppnPRIORIDADE_ID = $this->prioridade;
		$ppnSITUACAO_ID  = $this->situacao;
		$ppsTITULO      = $this->titulo;
		$ppsDESCRICAO   = $this->descricao;
		$ppnUSUARIO_ID  = $_SESSION["usuario"]->id;
		$ppnFASE_ID     = $this->fase;
		$ppsCIND_OBJ_CNTRR = 'S';
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
		$query = "BEGIN PCK_DEMANDA.prcUpdate(:ppnID, :ppnTIPODEMANDA_ID, :ppnPRIORIDADE_ID, :ppnSITUACAO_ID, :ppsTITULO, :ppsDESCRICAO, :ppnUSUARIO_ID, :ppnFASE_ID, :ppsCIND_OBJ_CNTRR, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
        OCIBindByName($stmt,":ppnTIPODEMANDA_ID",$ppnTIPODEMANDA_ID);
        OCIBindByName($stmt,":ppnPRIORIDADE_ID",$ppnPRIORIDADE_ID);
        OCIBindByName($stmt,":ppnSITUACAO_ID",$ppnSITUACAO_ID);
        OCIBindByName($stmt,":ppsTITULO",$ppsTITULO);
        OCIBindByName($stmt,":ppsDESCRICAO",$ppsDESCRICAO);
	    OCIBindByName($stmt,":ppnUSUARIO_ID",$ppnUSUARIO_ID);
		OCIBindByName($stmt,":ppnFASE_ID",$ppnFASE_ID);
	    OCIBindByName($stmt,":ppsCIND_OBJ_CNTRR",$ppsCIND_OBJ_CNTRR); 
		OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		return $this->ppsSQLERRM;
	}

	
    public function Exclui(){
		$ppnID = $this->id;
		$ppsCIND_OBJ_CNTRR = 'S';
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
		$query = "BEGIN PCK_DEMANDA.prcDelete(:ppnID, :ppsCIND_OBJ_CNTRR, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
		OCIBindByName($stmt,":ppsCIND_OBJ_CNTRR",$ppsCIND_OBJ_CNTRR); 
		OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		return $this->ppsSQLERRM;
	}

    public function Restaura(){
		$ppnID = $this->id;
		$ppsCIND_OBJ_CNTRR = 'S';
		$this->ppnSQLCODE = '';
		$this->ppsSQLERRM = '';
		$query = "BEGIN PCK_DEMANDA.prcRestaura(:ppnID, :ppsCIND_OBJ_CNTRR, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
		OCIBindByName($stmt,":ppsCIND_OBJ_CNTRR",$ppsCIND_OBJ_CNTRR); 
		OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		return $this->ppsSQLERRM;
	}
   /**
     * método Carrega($formato)
     * carrega os dados da demanda
     * formato = 1 -> padrão (CR/LF)
     * formato = 2 -> HTML   (<BR>)
     */
/*  function Carrega($formato){
		$ppnID = $this->id;
		$ppnFORMATO = intval($formato);
	  	$ppnTIPODEMANDA_ID = 0;
		$ppnPRIORIDADE_ID = 0;
		$ppnSITUACAO_ID = 0;
		$ppsTITULO = '';
		$ppsDESCRICAO = '';
		$ppsDATA_ENTRADA = '';
		$ppnFASE = 0;
		$ppsCIND_OBJ_CNTRR = 'S';
		$this->ppnSQLCODE = 0;
		$this->ppsSQLERRM = '';
		$query = "BEGIN PCK_Demanda.prcUpdate(:ppnID, :ppnFORMATO, :ppnTIPODEMANDA_ID, :ppnPRIORIDADE_ID, :ppnSITUACAO_ID, :ppsTITULO, :ppsDESCRICAO, :ppnFASE, :ppsDATA_ENTRADA, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID);
		OCIBindByName($stmt,":ppnFORMATO",$ppnFORMATO); 
        OCIBindByName($stmt,":ppnTIPODEMANDA_ID",$ppnTIPODEMANDA_ID, 10);
        OCIBindByName($stmt,":ppnPRIORIDADE_ID",$ppnPRIORIDADE_ID, 10);
        OCIBindByName($stmt,":ppnSITUACAO_ID",$ppnSITUACAO_ID, 10);
        OCIBindByName($stmt,":ppsTITULO",$ppsTITULO, 500, SQLT_CHR);
        OCIBindByName($stmt,":ppsDESCRICAO",$ppsDESCRICAO, 500, SQLT_CHR);
        OCIBindByName($stmt,":ppsDATA_ENTRADA",$ppsDATA_ENTRADA, 500, SQLT_CHR);
		OCIBindByName($stmt,":ppsCIND_OBJ_CNTRR",$ppsCIND_OBJ_CNTRR); 
		OCIBindByName($stmt,":ppnSQLCODE",$this->ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$this->ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
	
//		new TMessage('info', $ppnTIPODEMANDA_ID.'-'.$ppnPRIORIDADE_ID .'-'.$ppnSITUACAO_ID);
		$Demanda = new Demanda();
		$Demanda->id = $ppnID;
		$Demanda->tipodemanda = ABDTipoDemanda::CarregaTipoDemanda(intval($ppnTIPODEMANDA_ID));
		$Demanda->prioridade = ABDPrioridade::CarregaPrioridade(intval($ppnPRIORIDADE_ID));
		$Demanda->situacao = ABDSituacao::CarregaSituacao(intval($ppnSITUACAO_ID));
		$Demanda->titulo = $ppsTITULO;
		$Demanda->descricao = $ppsDESCRICAO;
		$Demanda->dataentrada = $ppsDATA_ENTRADA;
		return $Demanda;
	}
   /**
     * $formato = 1 -> padrão (CR/LF) <br> formato = 2 -> HTML (BR)
     */

	
	static function CarregaDemanda($id, $formato){
  	self::ConectaBD();
		$ppnID = intval($id);
		$ppnFORMATO = intval($formato);
	    (int)$ppnTIPODEMANDA_ID = 0;
		(int)$ppnPRIORIDADE_ID = 0;
		(int)$ppnSITUACAO_ID = 0;
		$ppsTITULO = '';
		$ppsDESCRICAO = '';
		(int)$ppnUSUARIO_ID = 0;
		(int)$ppnRESPONSAVEL_ID = 0;
		$ppsDATA_ENTRADA = '';
		(int)$ppsUSUARIO_ID = 0;
		$ppsCIND_OBJ_CNTRR = 'S';
		$ppnSQLCODE = 0;
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_Demanda.prcSelect(:ppnID, :ppnFORMATO, :ppnTIPODEMANDA_ID, :ppnPRIORIDADE_ID,  :ppnSITUACAO_ID, :ppsTITULO, :ppsDESCRICAO, :ppsDATA_ENTRADA, :ppnUSUARIO_ID, :ppnRESPONSAVEL_ID, :ppnFASE_ID, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnID",$ppnID); 
		OCIBindByName($stmt,":ppnFORMATO",$ppnFORMATO);
 	    OCIBindByName($stmt,":ppnTIPODEMANDA_ID",$ppnTIPODEMANDA_ID, 10);
 	    OCIBindByName($stmt,":ppnPRIORIDADE_ID",$ppnPRIORIDADE_ID, 10);
		OCIBindByName($stmt,":ppnSITUACAO_ID",$ppnSITUACAO_ID, 10);
   	 	OCIBindByName($stmt,":ppnUSUARIO_ID",$ppnUSUARIO_ID, 10);
   		OCIBindByName($stmt,":ppnRESPONSAVEL_ID",$ppnRESPONSAVEL_ID, 10);
	    OCIBindByName($stmt,":ppsTITULO",$ppsTITULO, 500, SQLT_CHR);
	    OCIBindByName($stmt,":ppsDESCRICAO",$ppsDESCRICAO, 4000, SQLT_CHR);
	    OCIBindByName($stmt,":ppsDATA_ENTRADA",$ppsDATA_ENTRADA, 500, SQLT_CHR);
	    OCIBindByName($stmt,":ppnFASE_ID",$ppnFASE_ID, 10);
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10);
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR);
		oci_execute($stmt);
		
		// new TMessage('info', $ppnTIPODEMANDA_ID.'-'.$ppnPRIORIDADE_ID .'-'.$ppnSITUACAO_ID);	
		$Demanda = new Demanda();
		$Demanda->id = $ppnID;
		$Demanda->tipodemanda = ABDTipoDemanda::CarregaTipoDemanda(intval($ppnTIPODEMANDA_ID));
		$Demanda->prioridade = ABDPrioridade::CarregaPrioridade(intval($ppnPRIORIDADE_ID));
		$Demanda->situacao = ABDSituacao::CarregaSituacao(intval($ppnSITUACAO_ID));
		$Demanda->titulo = $ppsTITULO;
		$Demanda->descricao = $ppsDESCRICAO;
		$Demanda->usuario = ABDUsuario::CarregaUsuario(intval($ppnUSUARIO_ID));
		$Demanda->responsavel = ABDUsuario::CarregaUsuario(intval($ppnRESPONSAVEL_ID));
		$Demanda->dataentrada = $ppsDATA_ENTRADA;
		$Demanda->fase = ABDFaseResolucao::CarregaFaseResolucao($ppnFASE_ID); 
		return $Demanda;
  	}
	
    static function ListarTodosArray($situacao, $prioridade, $usuario, $fase){
    	self::ConectaBD();
    	$query = 
    	"SELECT D.ID ID,
               D.TITULO TITULO,
               nvl(SIT.DESCRICAO, '>> Não Informado <<') SITUACAO,
               nvl(PRI.DESCRICAO, '>> Não Informado <<') PRIORIDADE,
               TO_CHAR(D.DATA_ENTRADA, 'DD/MM/YYYY HH24:MI:SS') DATA_ENTRADA,
               nvl(USU.NOME, '>> Não Informado <<') || ' (' ||
               NVL(TO_CHAR(DT_RESP, 'DD/MM/YYYY HH24:MI:SS'),
                   '--/--/---- --:--:--') || ')' USUARIO,
               D.RESPONSAVEL_ID RESPONSAVEL_ID
          FROM DEMANDA D, PRIORIDADE PRI, SITUACAO SIT, USUARIO USU
         WHERE D.SITUACAO_ID = SIT.ID(+)
           AND D.PRIORIDADE_ID = PRI.ID(+)
           AND D.RESPONSAVEL_ID = USU.ID(+)
           AND D.ATIVO = 1";
    	if ($situacao != ''){
          $query = $query . " AND D.SITUACAO_ID IN ($situacao) ";
    	}
		else{
    	    $query = $query . " AND D.SITUACAO_ID NOT IN (12, 14) ";
    	}
	
    	if ($prioridade != ''){
          $query = $query . " AND D.PRIORIDADE_ID IN ($prioridade) ";
    	}
    	if (trim($usuario, ' ') != ''){
    		$query = $query	. " AND D.RESPONSAVEL_ID = $usuario ";
    	}
		if (trim($fase, ' ') != ''){
			$query .= " AND D.FASE_ID = $fase ";
		}
    	$query = $query . " ORDER BY D.DATA_ENTRADA desc, D.TITULO ";
    	$stid = oci_parse(self::$conn, $query);
		oci_execute($stid);
		$nrows = oci_fetch_all($stid, $reg);
    	$ArrTodos = array();
		$t=0;
		for($i = 0; $i < $nrows; $i++){
				$Demanda = new Demanda();
				$Demanda->dataentrada = $reg["DATA_ENTRADA"][$i];
				$Demanda->titulo = $reg["TITULO"][$i];
				$Demanda->situacao = $reg["SITUACAO"][$i];
				$Demanda->prioridade = $reg["PRIORIDADE"][$i];
				$Demanda->id = $reg["ID"][$i];
				$Demanda->usuario = $reg["USUARIO"][$i];
				$ArrTodos[$t] = $Demanda;
				$t++;			
		}    	
		return $ArrTodos;
    }	

    static function ListarTodosUsuarioArray(){
    	self::ConectaBD();
		(int)$ppnUSUARIO_ID = $_SESSION["usuario"]->id;
 		$ppsLISTAGEM = ocinewcursor(self::$conn);
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_Demanda.prcListarArrayUsuario(:ppnUSUARIO_ID, :ppsLISTAGEM, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnUSUARIO_ID",$ppnUSUARIO_ID);
		OCIBindByName($stmt,":ppsLISTAGEM",$ppsLISTAGEM, -1, OCI_B_CURSOR); 
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		oci_execute($ppsLISTAGEM);

		$ArrTodos = array();
		$i=0;
		while(ocifetchinto($ppsLISTAGEM, $reg, OCI_ASSOC)){
				$Demanda = new Demanda();
				$Demanda->dataentrada = $reg["DATA_ENTRADA"];
				$Demanda->titulo = $reg["TITULO"];
				$Demanda->situacao = $reg["SITUACAO"];
				$Demanda->prioridade = $reg["PRIORIDADE"];
				$Demanda->id = $reg["ID"];
				$Demanda->usuario = $reg["USUARIO"];
				$ArrTodos[$i] = $Demanda;
				$i++;			
		}
		return $ArrTodos;
	}
	
	static function ListarRespUsuarioArray(){
		self::ConectaBD();
		(int)$ppnUSUARIO_ID = $_SESSION["usuario"]->id;
		$ppsLISTAGEM = ocinewcursor(self::$conn);
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_Demanda.prcListarArrayUsuResp(:ppnUSUARIO_ID, :ppsLISTAGEM, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnUSUARIO_ID",$ppnUSUARIO_ID);
		OCIBindByName($stmt,":ppsLISTAGEM",$ppsLISTAGEM, -1, OCI_B_CURSOR);
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10);
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR);
		oci_execute($stmt);
		oci_execute($ppsLISTAGEM);
	
		$ArrTodos = array();
		$i=0;
		while(ocifetchinto($ppsLISTAGEM, $reg, OCI_ASSOC)){
			$Demanda = new Demanda();
			$Demanda->dataentrada = $reg["DATA_ENTRADA"];
			$Demanda->titulo = $reg["TITULO"];
			$Demanda->situacao = $reg["SITUACAO"];
			$Demanda->prioridade = $reg["PRIORIDADE"];
			$Demanda->id = $reg["ID"];
			$Demanda->usuario = $reg["USUARIO"];
			$ArrTodos[$i] = $Demanda;
			$i++;
		}
		return $ArrTodos;
	}
	
	
	static function AtribuiUsuarioDemanda($demanda, $usuario){
		self::ConectaBD();

		$ppnDEMANDA = $demanda;
		$ppnUSUARIO = $_SESSION['usuario']->id;
		$ppnNOVOUSUARIO = $usuario;
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_Demanda.prcAtribuiUsuarioDemanda(:ppnDEMANDA, :ppnUSUARIO, :ppnNOVOUSUARIO, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnDEMANDA",$ppnDEMANDA);
		OCIBindByName($stmt,":ppnUSUARIO",$ppnUSUARIO);
		OCIBindByName($stmt,":ppnNOVOUSUARIO",$ppnNOVOUSUARIO); 
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		return $ppsSQLERRM;
	}
	
	static function ListarUsuariosDemandaArray($demanda){
		self::ConectaBD();
		$ppnDEMANDA = $demanda;
 		$ppsLISTAGEM = ocinewcursor(self::$conn);
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_Demanda.prcListarUsuariosDemanda(:ppnDEMANDA, :ppsLISTAGEM, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnDEMANDA",$ppnDEMANDA);
		OCIBindByName($stmt,":ppsLISTAGEM",$ppsLISTAGEM, -1, OCI_B_CURSOR); 
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		oci_execute($ppsLISTAGEM);

		$ArrTodos = array();
		$i = 0;
		while(ocifetchinto($ppsLISTAGEM, $reg, OCI_ASSOC)){
			 	$Demanda = new stdClass();
				$Demanda->id = $reg["ID"];
				$Demanda->nome = $reg["NOME"];
				$ArrTodos[$i] = $Demanda;
				$i++;
		}
		return $ArrTodos;
	}
	
	static function RemoverUsuarioDemanda($demanda, $usuario){
		self::ConectaBD();

		$ppnDEMANDA = $demanda;
		$ppnUSUARIO = $_SESSION['usuario']->id;
		$ppnNOVOUSUARIO = $usuario;
		$ppnSQLCODE = '';
		$ppsSQLERRM = '';
		$query = "BEGIN PCK_Demanda.prcRemoverUsuarioDemanda(:ppnDEMANDA, :ppnUSUARIO, :ppnNOVOUSUARIO, :ppnSQLCODE, :ppsSQLERRM); END;";
		$stmt = oci_parse(self::$conn, $query);
	
		OCIBindByName($stmt,":ppnDEMANDA",$ppnDEMANDA);
		OCIBindByName($stmt,":ppnUSUARIO",$ppnUSUARIO);
		OCIBindByName($stmt,":ppnNOVOUSUARIO",$ppnNOVOUSUARIO); 
		OCIBindByName($stmt,":ppnSQLCODE",$ppnSQLCODE, 10); 
		OCIBindByName($stmt,":ppsSQLERRM",$ppsSQLERRM, 500, SQLT_CHR); 
		oci_execute($stmt);	
		return $ppsSQLERRM;
	}
  }
?>
