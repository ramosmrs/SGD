<?php 
	session_start();

function __autoload($classe)
{
	   $pastas = array('../AcessoBancoDados','../app.widgets', '../app.images', '../Controle', '../Modelo');
	   foreach ($pastas as $pasta)
	   {
		      if (file_exists("{$pasta}/{$classe}.class.php"))
        {
			         include_once "{$pasta}/{$classe}.class.php";
		      }
	   }
}	

$Conexao = ConnOracle::Conecta();
	
	require ("../Controle/utils.php");
	if (getenv("REQUEST_METHOD") == "GET"){
		IF (isset($_GET["ID"]))
			$V_LOGIN = $_GET["ID"];
		ELSE $V_LOGIN = '';
	}

	echo ElementosPagina::$cabecalhoTela;
	echo ElementosPagina::$cabecalhoCCTela;  
	echo "

		
		
		<table width='968' height='104' border='0' align='center'
			cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>
			<tr>
				<td align='left'>
					<div align='left' style='margin-top: 2.5px'>
					<p align='left' class='tit_conteudo'>Manutenção de usuários - Alterar senha</p>
						<form action='Gravar_Senha.php' method='post' target='_frame'>
							<table>
							    <tr>
							       <td>Usu&aacute;rio</td>";
       	$Texto = $V_LOGIN != '' ? "  value='".$V_LOGIN."'" : "";
       	echo "
		                           <td><input name='Usuario' type='text' class='IUsuario' id='Usuario' size='20' maxlength='10' $Texto></td>
							    </tr>
							    <tr>
								   <td>Senha antiga</td>
								   <td><input name='Senha' type='password' class='ISenha' id='senha' size='20' maxlength='10'></td>
								</tr>
								<tr>
								   <td>Nova senha</td>
								   <td><input name='Novasenha' type='password' class='INovasenha' id='Novasenha' size='20' maxlength='10'></td>
								</tr>
								<tr>
								   <td>Repetir nova senha</td>
								   <td><input name='Novasenha2' type='password' class='INovasenha2' id='Novasenha2' size='20' maxlength='10'></td>
								</tr>
								<tr>
								<td><input name='Submit' type='submit' class='Enviar' value='Gravar' /></td>
								<td><input type='button' value='Cancelar' onClick='javascript:document.location = 'Login.php''></td>
								</tr>
							</table>
						</form>
					</div>
				</td>
				<td><img src='../images/spacer.gif' width='1' height='42' border='0' alt=''></td>
			</tr>
		</table>
	";
							       		
echo ElementosPagina::$rodapeTela;
?>