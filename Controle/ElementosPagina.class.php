<?php

class ElementosPagina {
	
	public static $cabecalhoTela = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
			<meta http-equiv='X-UA-Compatible' content='IE=EmulateIE7' />
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			
			<title>Gestão de Demandas - SIGRH/RJ</title>
			<link href='../css/style.css' rel='stylesheet' type='text/css' />
			<link href='../css/portal.css' rel='stylesheet' type='text/css' />
			
			<style type='text/css'>
			
				.tfield
				{
					 border: solid;
					 border-color: #a0a0a0;
					 border-width: 1px;
					 z-index: 1;
				}
				
				.tfield_disabled
				{
					 border: solid;
					 border-color: #a0a0a0;
					 border-width: 1px;
					 background-color: #e0e0e0;
					 color: #a0a0a0;
				}
				
				.tdatagrid_table
				{
					 border-collapse: separate;
					 font-family: arial,verdana,sans-serif;
					 font-size: 10pt;
					 border-spacing: 0pt;
				}
				
				.tdatagrid_col
				{
					 font-size: 10pt;
					 font-weight: bold;
					 border-left: 1px solid white;
					 border-top: 1px solid white;
					 border-right: 1px solid gray;
					 border-bottom: 1px solid gray;
					 padding-top: 1px;
					 background-color: #CCCCCC;
				}
				
				.tdatagrid_col_over
				{
					 font-size: 10pt;
					 font-weight: bold;
					 border-left: 1px solid white;
					 border-top: 2px solid orange;
					 border-right: 1px solid gray;
					 border-bottom: 1px solid gray;
					 padding-top: 0px;
					 cursor: pointer;
					 background-color: #dcdcdc;
				}
			
			#menuhor {
				border: none;
				margin: 5;
				font: 12px Arial, sans-serif;
			}
			
			#menuhor li {
				list-style: none;
				margin: 0;
				display: inline;
			}
			 
			#menuhor li a {
				height: 1px; /* conserto para Internet Explorer */
				padding: 8px 6px;
				margin: 0;
				border: 2px solid #0042ff;
				background: #E2EBED;
				text-decoration: none;
			}
			 
			#menuhor li a:link {
				color: #000000;
			}
			 
			#menuhor li a:visited {
				color: #000000;
			}
			 
			#menuhor li a:hover {
				background: #859ce0;
				color: #000000;
				border-color: #000000;
			}
			
			body
				{
				    font-family: arial,verdana,sans-serif;
				    font-size: 10pt;
					margin-top: 0px;
					background-color: #ffffff
				}
				
				#inativo
				{
				    background-color: #E2EBED;
				    border-left: 2px solid white;
				    height: 20px;
				    padding-top: 5px;
				    padding-left: 4px;
				    margin-bottom: 2px;
				}
				
				#ativo
				{
				    background-color: #c0c0c0;
				    border-left: 2px solid red;
				    height: 20px;
				    padding-top: 5px;
				    padding-left: 4px;
				    margin-bottom: 2px;
				    cursor: pointer;
				}
				
				#pageheader
				{
				    border: none;
				    width:950px;
				    height:112;
				    overflow: none;
				    margin-bottom:0px;
				
				}
				
				#pagebody
				{
				    background-color: white;
				    width:950px;
				    
				}
				
				
				#pageleft
				{
				    width:180;
				    margin-left: 0px;
				    margin-right: 0px;
				    float:left;
				    text-align:left;
				    border: 1px solid #000000;
				    font-size: 10pt;
				    font-family: arial,verdana,sans-serif;
				    font-weight: bold;
				}
				
				#pagecontent
				{
				    margin-right: 0px;
				    margin-left: 40px;
				    margin-top:0px;
				    width:928px;
				    
				    text-align:left;
				    color: #333333;
				}
				
				#pageboth
				{
				    clear:both;
				}
			</style>
			
			<script language='javascript' src='script/divs.js'
			type='text/javascript'></script>
			
			
			<!--[if gte IE 8]>
				<link rel='stylesheet' href='css/style_ie8.css' type='text/css'/>
			<![endif]-->  
			<script type='text/javascript' src='js/detector.js'></script>
			
			<script type='text/javascript'>
				var tamanhoPadrao = .9; 
					function MudarTamanho(Tipo, Objeto)
					{
						if (navigator.appName == 'Netscape') {
							b_objeto_i='document.getElementById('';
							b_objeto_f='')'; 
						}else{
							b_objeto_i='document.all.';
							b_objeto_f='';
						}
						eval('var obj=' + b_objeto_i + Objeto + b_objeto_f);
						var Tamanho = parseFloat(obj.style.fontSize.replace('em',''));
						if(isNaN(Tamanho))
						{
							Tamanho=.9;
						}
						Tamanho=(Tipo==0 ? .9 : Tamanho+Tipo);
						if(Tamanho < 1.7 && Tamanho > 0.5){
							obj.style.fontSize=Tamanho+'em';
						}
			}
			
			function normalizaTamanho(Objeto) {
				if (navigator.appName == 'Netscape') {
					b_objeto_i='document.getElementById('';
					b_objeto_f='')'; 
				}else{
					b_objeto_i='document.all.';
					b_objeto_f='';
				}
					eval('var obj=' + b_objeto_i + Objeto + b_objeto_f);
					obj.style.fontSize = tamanhoPadrao+'em';
				}
			
			<!-- alto contraste -->
				
				function setActiveStyleSheet(){
						if( cookieRead( 'alto_contraste' ) == null || cookieRead( 'alto_contraste' ) == '' )
						cookieCreate('alto_contraste', '1', 1);
					else
						cookieErase('alto_contraste', '1', 1);
					window.location.reload();
				}
				
				function cookieCreate(strName, strValue, intDays,timeExpire) {
				
				if ( intDays ) {
				var date = new Date();
				date.setTime(date.getTime()+(intDays*24*60*60*1000));
				var expires = '; expires='+date.toGMTString();
				} else {
					var expires = '';
				}
				if( timeExpire ){
					expires = '; expires:=' + timeExpire;
				}
				document.cookie = strName + '=' + strValue + expires + '; path=/';
				}
				
				function cookieRead(strName) {
				var strNameIgual = strName + '=';
				var arrCookies = document.cookie.split(';');
				for ( var i = 0, strCookie; strCookie = arrCookies[i]; i++ ) {
					while ( strCookie.charAt(0) == ' ') {
						strCookie = strCookie.substring(1,strCookie.length);
					}
					if ( strCookie.indexOf(strNameIgual) == 0 ) {
						return strCookie.substring(strNameIgual.length,strCookie.length);
					}
				}
				return null;
			}
				
				function cookieErase(strName) {
				this.cookieCreate(strName,'',-1);
			}
				
				if(new Number( cookieRead( 'alto_contraste' ) ) == 1 ){
					if((BrowserDetect.browser == 'Explorer' && BrowserDetect.version > 7) || BrowserDetect.browser == 'Opera'){
						document.write('<link href='css/altocontraste_ie8.css' rel='stylesheet' type='text/css' />');
					}else{
						document.write('<link href='css/altocontraste.css' rel='stylesheet' type='text/css' />');
					}
					document.write('<input type='hidden' id='altoContraste' value='1'>');
				}else{
					document.write('<input type='hidden' id='altoContraste' value='0'>');
				}
				
			</script>
			
			</head>
			
			<body>
			
			<div class='principal_head'>
			<div id='header'>
			   <div id='topo'> 
			      <div id='logoportal' title='Portal do Governo do Estado do Rio de Janeiro'><a href='http://www.rj.gov.br/' target='_blank'>Portal do Governo do Estado do Rio de Janeiro</a></div>
			      <div id='topo_menu'>
				 <ul>
				    <li><!-- <a href='http://portalgovrj/web/poupatemporj' target='_blank'>RIO POUPA TEMPO NA WEB</a> --></li> 
				 </ul>        
			     </div>
			  </div> 
			</div> 
			 </div>  
			
			<!--Fecha HEADER--> 
			";

	public static $cabecalhoCCTela = "
		<table border='0' align='center' cellpadding='0' cellspacing='0'>
		<tr>
		  <td align=center><a href='http://www.sigrh.rj.gov.br/' ><img src='../images/SIG_cabeca.jpg'  border='0' width='968' height='154' alt=''></a></td>
		</tr>
		</table>
		
	";	
	public static $menuTela = "
		<table border='0' width='968' bgcolor='#FFFFFF' align='center' cellpadding='0' cellspacing='0' >
			<tr>
				<td align='right'>#USUARIO#</td>
			</tr>
		</table>
				
		<table border='0' width='968' bgcolor='#FFFFFF' align='center' cellpadding='0' cellspacing='0' >
			<td bgcolor='#FFFFFF'>
			   <div id='menuhor'>
			   <br>
			   <ul id= 'menuhor'>
					<li> <a href= 'DemandaControle.php' title= 'Demandas'>Demandas</a> </li>
					<li> <a href= 'DemandaControleFiltro.php' title= 'Demandas por usuário'>Demandas por usuário</a> </li>
					<li> <a href= 'DemandaControleResp.php' title= 'Demandas sob responsabilidade'>Demandas sob responsabilidade</a> </li>
					<li> <a href= 'DemandaControleGrupo.php' title= 'Demandas do grupo'>Demandas do grupo</a> </li>
					<li> <a href= '../index.php?class=UsuarioControle' title= 'Usuários'>Usuários</a> </li>
					<li> <a href= '../index.php?class=TipoDemandaControle' title= 'Tipos de demanda'>Tipos de demanda</a> </li>
					<li> <a href= '../index.php?class=PrioridadeControle' title= 'Prioridades'>Prioridades</a> </li>
					<li> <a href= '../index.php?class=SituacaoControle' title= 'Situação'>Situação</a> </li>
				</ul>
				</div> 
	
			    <div id='pagecontent'>
			    <br>
			        #CONTENT#
			    </div>
			    
			    <div id='pageboth'></div>
			        
				</div>
			</td>
		</table>
	
	
	";

	
	public static $menuTela2 = "
			<table border='0' width='968' bgcolor='#FFFFFF' align='center' cellpadding='0' cellspacing='0' >
		<tr>
		<td align='right'>#USUARIO#</td>
		</tr>
		</table>
				
		<table border='0' width='968' bgcolor='#FFFFFF' align='center' cellpadding='0' cellspacing='0' >
		<td bgcolor='#FFFFFF'>
		   <div id='menuhor'>
		   <br>
		   <ul id= 'menuhor'>
				<li> <a href= 'Controle/DemandaControle.php' title= 'Demandas'>Demandas</a> </li>
				<li> <a href= 'Controle/DemandaControleFiltro.php' title= 'Demandas por usuário'>Demandas por usuário</a> </li>
				<li> <a href= 'index.php?class=UsuarioControle' title= 'Usuários'>Usuários</a> </li>
				<li> <a href= 'index.php?class=TipoDemandaControle' title= 'Tipos de demanda'>Tipos de demanda</a> </li>
				<li> <a href= 'index.php?class=PrioridadeControle' title= 'Prioridades'>Prioridades</a> </li>
				<li> <a href= 'index.php?class=SituacaoControle' title= 'Situação'>Situação</a> </li>
			</ul>
			</div> 

		    <div id='pagecontent'>
		    <br>
		        #CONTENT#
		    </div>
		    
		    <div id='pageboth'></div>
		        
			</div>
		</td>

</table>
	
	
	";
	
	
	public static $PaginaPrint = "
		<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
		<meta http-equiv='X-UA-Compatible' content='IE=EmulateIE7' />
		
		<title>Gestão de Demandas - SIGRH/RJ</title>
		<link href='../css/portal.css' rel='stylesheet' type='text/css' />
		
		<body>
	
		<table border='0' width='968' bgcolor='#FFFFFF' align='center' cellpadding='0' cellspacing='0' >
		<td bgcolor='#FFFFFF'>

			<div>
		    <br>
		        #CONTENT#
		    </div>
	
		    <div></div>
	
		
		</td>
		</table>
		</body>	
	";
	
	// Rodapé:
	public static $rodapeTela = " 
			<!--FOOTER--> 
			
			<div id='bg_footer'>
			<div title='Esta obra é licenciada sob uma licença Creative Commons Atribuio 2.0 Brasil' id='copyright'></div>
			<div id='copyright_txt'><a target='_blank' href='http://www.creativecommons.org.br'>Esta obra &eacute; licenciada sob uma licen&ccedil;a Creative Commons Atribuio 2.0 Brasil</a>
			</div>
			</div>
			<!--Fecha FOOTER-->   
			</body>
			</html>";

	public static $AcessoIndevido = "
		<table width= '968' border='0' align='center' 
			cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>
			<table width= '968' border='0' align='center' 
			cellpadding='0' cellspacing='20' bgcolor='#FFFFFF'>
			
			<tr>
				<td align='left' >
				<p align='left'  class='tit_conteudo' >SIGRH-RJ: Aviso !</p>
		        <br>
		        <br>  
				<p >Prezado(a) Servidor(a),
				</p>
				<p>Detectamos que foi feito um acesso inadequado a p&aacute;gina de contracheque.
				</p>
				<p>Por favor, feche esta janela e efetue o login na sua p&aacute;gina de contracheque, colocando a matr&iacute;cula e a senha.
				</p>
				<p>Agrade&ccedil;emos a compreens&atilde;o.
				</p>
				</td>
			</tr>
			<tr> <td align = 'left' height='300' valign='middle' colspan='2'></td></tr>	
			</table>
		</table>
		";	
	
	public static $Indisponivel = "
			<table width= '968' border='0' align='center' 
			cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>
			<table width= '968' border='0' align='center' 
			cellpadding='0' cellspacing='20' bgcolor='#FFFFFF'>
			
			<tr>
				<td align='left' >
		        <p align='left' class='tit_conteudo'>SIGRH-RJ: Emiss&atilde;o de contracheque</p>
		        <br>
		        <br>
		        <p align='left'  class='tit_conteudo' >Aviso!</p>
		        <br>
		        <br>
				<p>Servi&ccedil;o temporariamente indispon&iacute;vel.
				</p>
				</td>
			</tr>
			<tr> <td align = 'left' height='300' valign='middle' colspan='2'></td></tr>	
			</table>
		</table>
	";
	
	public static function TelaAcessoIndevido(){
		return self::$cabecalhoTela . self::$AcessoIndevido . self::$rodapeTela; 
	}
	
	public static function TelaIndisponivel(){
		return self::$cabecalhoTela . self::$Indisponivel . self::$rodapeTela;
	}
	
	public static function alert($text)
	{
	    echo "<script content='text/html; charset=iso-8859-1'>alert('" . $text . "');</script>";
	}
}

?>