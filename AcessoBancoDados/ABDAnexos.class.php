<?php 

class ABDAnexos extends Anexos{
	
	private static $conn;
	
	  public function __construct(){
	     self::ConectaBD();
	  }
	  
	  private static function ConectaBD(){
	  	self::$conn = ConnOracle::GetConn();
	  }
	
	static function inserir($demanda_id, $descricao, $nomearq, $tipo, $tamanho, $conteudo){
		$c = self::ConectaBD();
		$stmt = OCIParse($c, "insert into anexos (id, demanda_id, nomearq, tipo, descricao, tamanho, anexo) values (anexos_id.nextval, :demanda_id, :nomearq, :tipo, :descricao, :tamanho, :the_blob)");
		$lob = oci_new_descriptor($c, OCI_D_LOB);
	    oci_bind_by_name($stmt, ':nomearq', $nomearq);
	    oci_bind_by_name($stmt, ':tipo', $tipo);
		oci_bind_by_name($stmt, ':demanda_id', $demanda_id);
		oci_bind_by_name($stmt, ':descricao', $descricao);
		oci_bind_by_name($stmt, ':tamanho', $tamanho);
	    OCIBindByName($stmt, ':the_blob', $lob, -1, OCI_B_BLOB); 
		$lob->writeTemporary($conteudo, OCI_TEMP_BLOB);
		oci_execute($stmt, OCI_DEFAULT);
		oci_commit($c);
		$lob->close(); // close lob descriptor to free resources	
	}  
	  
	  
	static function inserirfunc($demanda_id, $descricao, $nomearq, $tipo, $tamanho, $conteudo){
		self::ConectaBD();
	    $lob = OCINewDescriptor(self::$conn, OCI_D_LOB); 
	    $stmt = OCIParse(self::$conn,"insert into anexos (id, demanda_id, nomearq, tipo, descricao, tamanho, anexo) values (anexos_id.nextval, :demanda_id, :nomearq, :tipo, :descricao, :tamanho, :the_blob)");
	    oci_bind_by_name($stmt, ':nomearq', $nomearq);
	    oci_bind_by_name($stmt, ':tipo', $tipo);
		oci_bind_by_name($stmt, ':demanda_id', $demanda_id);
		oci_bind_by_name($stmt, ':descricao', $descricao);
		oci_bind_by_name($stmt, ':tamanho', $tamanho);
	    OCIBindByName($stmt, ':the_blob', $lob, -1, OCI_B_BLOB); 
	    $lob->WriteTemporary($conteudo); 
	    OCIExecute($stmt, OCI_DEFAULT); 
	    $lob->close(); 
	    $lob->free(); 
	    OCICommit(self::$conn); 
	}

	static function recuperar($demanda_id){
		$ppnDEMANDA_ID = $demanda_id;
		$query = "BEGIN P_RECUPERA_ANEXO(:ppnDEMANDA_ID); END;";
		$stmt = oci_parse(self::$conn, $query);
		
		OCIBindByName($stmt,":ppnDEMANDA_ID",$ppnDEMANDA_ID);
		oci_execute($stmt);
		return null;
	}
	
	static function ListarAnexos($demanda){
		self::ConectaBD();
		
		$query = "select id, nomearq, nvl(to_char(dtinclusao, 'dd/mm/yyyy hh24:mi:ss'), '(Sem data cadastrada)') as dtinc from anexos where demanda_id = $demanda order by dtinclusao desc";
		
		$stid = oci_parse(self::$conn, $query);
		oci_execute($stid);

		$nrows = oci_fetch_all($stid, $reg);
    	
    	$ArrTodos = array();
		
		$t=0;
		
		for($i = 0; $i < $nrows; $i++){
				$Anexo = new Anexos();
				$Anexo->id = $reg["ID"][$i];
				$Anexo->nomearq = $reg["NOMEARQ"][$i];
				$Anexo->dtinclusao = $reg["DTINC"][$i];
				$ArrTodos[$t] = $Anexo;
				$t++;			
		}    	
		return $ArrTodos;
	}
	
	
}

?>