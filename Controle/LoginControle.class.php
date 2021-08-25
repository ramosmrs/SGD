<?php

class LoginControle
{
    private $form;     // formulário de buscas
    private $datagrid; // listagem

    public function __construct()
    {
		 	echo ' ';
    }
    
    static function ExibeLinhaLogin(){
    	if (isset($_SESSION['usuario']->id)){
		    $retorno ='<td bgcolor="#FFFFFF" align=right><strong>Olá, '. $_SESSION['usuario']->nome ;
			if($_SESSION['usuario']->sistema == 'SGA'){
			//	$retorno = $retorno . '| <a href="?class=LoginControle&method=ListarUsuarios">Gerenciar logins dos usuários</a> ';
				$retorno = $retorno . ' | <a href="../Login/listar_usuarios.php">Gerenciar logins dos usuários</a> '; 
			}
		//	return $retorno . ' | <a href="#" onmouseover="parent.location=
			return $retorno . ' | <a href="../Login/Principal.php?param=logout" >Logout .</a></td>';
    	}
    }

    static function ExibeLinhaLogin2(){
    	if (isset($_SESSION['usuario']->id)){
		    $retorno ='<td bgcolor="#FFFFFF" align=right><strong>Olá, '. $_SESSION['usuario']->nome ;
			if($_SESSION['usuario']->sistema == 'SGA'){
			//	$retorno = $retorno . '| <a href="?class=LoginControle&method=ListarUsuarios">Gerenciar logins dos usuários</a> ';
				$retorno = $retorno . ' | <a href="Login/listar_usuarios.php">Gerenciar logins dos usuários</a> '; 
			}
		//	return $retorno . ' | <a href="#" onmouseover="parent.location=
			return $retorno . ' | <a href="Login/Principal.php?param=logout" >Logout .</a></td>';
    	}
    }
    
    function logout(){
    	session_destroy();
    	
    }
    
    function ListarUsuarios(){
    	$Conexao = ConnOracle::Conecta();
	
		$select = "SELECT ID, NOME, LOGIN, ALTERADA, SISTEMA, ATIVO";
		$from = " FROM USUARIO";
		$where = "  where SISTEMA IN ('SGD', 'SGA') AND ATIVO = 1";
		
		$order = " ORDER BY NOME ";
		$query = $select . $from . $where . $order;
		$stid = oci_parse($Conexao, $query);
		//echo $query;
		oci_execute($stid);
		
		$nrows = oci_fetch_all($stid, $results);
		
		    $Folhas_disp = '';
		
		    for ($i = 0; $i < $nrows; $i++) {
		    	 if ($results["ATIVO"][$i] == 'N') $fonte = '<font color="darkred">';
		    	 else $fonte = '<font color="darkblue">';
		    	 $var_encripta = $results["ID"][$i];
		         $Folhas_disp = $Folhas_disp . '<tr>
							<td>' .$fonte. $results["ID"][$i] . '</font></td>
							<td>' .$fonte. $results["NOME"][$i] . '</font></td>
							<td>' .$fonte. $results["LOGIN"][$i] . '</font></td>  
							<td><a href=edita_usuario.php?param=' . base64_encode($var_encripta). '><img class="icon" src="../images/pencil.png" width="20" height="20" border="0" /></a></td>
		               </tr>';
		    }
		    
    	   return '<table width="968" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">	<tr>
				<td align="left">
				<div align="left" style="margin-top: 2.5px; margin-left: 25px; ">
				<p align="left" class="tit_conteudo">Cadastro de usu&aacute;rios</p>
					<table border = "0" >
					 <tr> <td align = "left" height="20" valign="middle" colspan="2"><a href="../index.php">Retornar ao sistema de gestão de demandas</a></td>
					 <tr> <td align = "left" height="80" valign="middle" colspan="2"><p><i>clique no &iacute;cone ao lado para editar o usu&aacute;rio:</i></p></td></tr>
				     <tr>
						<td align="left" width="80" class="txt_azul_escuro"><strong>Código</strong></td>
					   	<td align="left" width="250" class="txt_azul_escuro"><strong>Nome</strong></td>
					   	<td align="left" width="70" class="txt_azul_escuro"><strong>Login</strong></td>
						<td align="center" class="txt_azul_escuro"> </td>
					 </tr> '
		    	   . $Folhas_disp.
		    	   ' <tr> <td align = "left" height="226" valign="middle" colspan="2"></td></tr>
				</table>
				</div>
				</td>
			</tr>
   		    </table>   ' ;

		        
    }
}  
    
?>