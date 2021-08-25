<?php
session_start(); 
session_destroy();
session_start();

function __autoload($classe)
{
	   $pastas = array('../AcessoBancoDados', '../Utils', '../Controle');
	   foreach ($pastas as $pasta)
	   {
		      if (file_exists("{$pasta}/{$classe}.class.php"))
        {
		
			         include_once "{$pasta}/{$classe}.class.php";
		      }
	   }
}	

echo ElementosPagina::$cabecalhoTela;
echo ElementosPagina::$cabecalhoCCTela;
date_default_timezone_set('America/Sao_Paulo');
echo '

<table  width="968"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

	<tr>
		<td align="left">
		 <p align="left" class="tit_conteudo">Sistema de gest&atilde;o de demandas - Login</p>
		<div align="left" style="margin-top: 2.5px">

		<form action="Login.php" method="post" name="frmLogin">
		<table>
		';
		if (isset($_SESSION['Erro'])){
		   if ($_SESSION['Erro'] != null)
		      echo ' <tr> <td></td><td><p style="font-weight:bold;color: red">'.$_SESSION['Erro'].'</p></td> </tr> ';
		}
		echo'
	    <tr>
	       <td>Usu&aacute;rio</td>
	       <td><input name="Login" type="text" class="ILogin" id="login" size="20" maxlength="10"></td>
	    </tr>
	    <tr>
		   <td>Senha</td><td><input name="Senha" type="password" class="ISenha" id="senha" size="20" maxlength="10"></td>
		</tr>
		<tr>
		   <td colspan = "2"><br><a href="Trocasenha.php">Alterar senha de usu&aacute;rio</a><br></td>
		</tr>
		
		<tr>
		<td><input name="Submit" type="submit" class="Login" value="Login" /></td></tr>
		</table>
		</form>
		</div>
		</td>
		<td><img src="../images/spacer.gif" width="1" height="42" border="0" alt=""></td>
	</tr>
</table>
<script language=javascript>
   document.frmLogin.Login.focus();
</script>
';
	
echo ElementosPagina::$rodapeTela;

?>
