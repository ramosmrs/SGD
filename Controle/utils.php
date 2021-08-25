<?php 
# Variáveis para o modo de manutenção:
$Manutencao = 'N';
$diaretorno = '04/02/2011';
$horaretorno = '20:00';

if($Manutencao == 'S'){
	session_start();
	$_SESSION["DIARETORNO"] = $diaretorno;
	$_SESSION["HORARETORNO"] = $horaretorno;
	
	echo "<script language=javascript>";
	echo "document.location ='/PORTAL/Manut.php';";
	echo "</script>";	
	return;
}

$V_SIGRH   = "http://www.sigrh.rj.gov.br";
$V_HPS     = "http://grou.proderj.rj.gov.br/entradasigrh";
$V_PRODERJ = "http://www.proderj.rj.gov.br";
$V_SEPLAG  = "http://www.planejamento.rj.gov.br";
$V_MANUAIS = "http://www.planejamento.rj.gov.br";


# Caixa de alerta
function alert($text)
{
    echo "<script content='text/html; charset=iso-8859-1'>alert('" . $text . "');</script>";
}

# Versï¿½o atual do sistema
function Versao()
{
    return "vers&atilde;o 0.0.4 de 06/05/2009";
}

# Caminho do servidor
function Servidor()
{
    return "http://localhost";
}

function descripta($param){

	$str = $param;
	$str = str_replace("'", "", $str);
	$str = str_replace('"', '', $str);
	$arr = explode('_', $str);
	$retorno = '';
	
	for($i = 0; $i < sizeof($arr); $i++){
		//echo '<br>';
		//echo $i. '-'. $arr[$i];
		$valor = $arr[$i] - 18;
		//echo ' - '.$valor;
		
		switch ($valor){
			case 55 : $retorno = '&'. $retorno; break;
			case 65 : $retorno = '='. $retorno; break;
			case 13 : $retorno = '0'. $retorno; break;
			case 14 : $retorno = '1'. $retorno; break;
			case 15 : $retorno = '2'. $retorno; break;
			case 16 : $retorno = '3'. $retorno; break;
			case 17 : $retorno = '4'. $retorno; break;
			case 18 : $retorno = '5'. $retorno; break;
			case 19 : $retorno = '6'. $retorno; break;
			case 20 : $retorno = '7'. $retorno; break;
			case 21 : $retorno = '8'. $retorno; break;
			case 22 : $retorno = '9'. $retorno; break;
			
			case 23 : $retorno = 'A'. $retorno; break; case 24 : $retorno = 'B'. $retorno; break;
			case 25 : $retorno = 'C'. $retorno; break; case 26 : $retorno = 'D'. $retorno; break;
			case 27 : $retorno = 'E'. $retorno; break; case 28 : $retorno = 'F'. $retorno; break;
			case 29 : $retorno = 'G'. $retorno; break; case 30 : $retorno = 'H'. $retorno; break;
			case 31 : $retorno = 'I'. $retorno; break; case 32 : $retorno = 'J'. $retorno; break;
			case 33 : $retorno = 'K'. $retorno; break; case 34 : $retorno = 'L'. $retorno; break;
			case 35 : $retorno = 'M'. $retorno; break; case 36 : $retorno = 'N'. $retorno; break;
			case 37 : $retorno = 'O'. $retorno; break; case 38 : $retorno = 'P'. $retorno; break;
			case 39 : $retorno = 'Q'. $retorno; break; case 40 : $retorno = 'R'. $retorno; break;
			case 41 : $retorno = 'S'. $retorno; break; case 42 : $retorno = 'T'. $retorno; break;
			case 43 : $retorno = 'U'. $retorno; break; case 44 : $retorno = 'V'. $retorno; break;
			case 45 : $retorno = 'W'. $retorno; break; case 46 : $retorno = 'X'. $retorno; break;
			case 47 : $retorno = 'Y'. $retorno; break; case 48 : $retorno = 'Z'. $retorno; break;
	
			case 100 : $retorno = 'a'. $retorno; break; case 101 : $retorno = 'b'. $retorno; break;
			case 102 : $retorno = 'c'. $retorno; break; case 103 : $retorno = 'd'. $retorno; break;
			case 104 : $retorno = 'e'. $retorno; break; case 105 : $retorno = 'f'. $retorno; break;
			case 106 : $retorno = 'g'. $retorno; break; case 107 : $retorno = 'h'. $retorno; break;
			case 108 : $retorno = 'i'. $retorno; break; case 109 : $retorno = 'j'. $retorno; break;
			case 110 : $retorno = 'k'. $retorno; break; case 111 : $retorno = 'l'. $retorno; break;
			case 112 : $retorno = 'm'. $retorno; break; case 113 : $retorno = 'n'. $retorno; break;
			case 114 : $retorno = 'o'. $retorno; break; case 115 : $retorno = 'p'. $retorno; break;
			case 116 : $retorno = 'q'. $retorno; break; case 117 : $retorno = 'r'. $retorno; break;
			case 118 : $retorno = 's'. $retorno; break; case 119 : $retorno = 't'. $retorno; break;
			case 120 : $retorno = 'u'. $retorno; break; case 121 : $retorno = 'v'. $retorno; break;
			case 122 : $retorno = 'w'. $retorno; break; case 123 : $retorno = 'x'. $retorno; break;
			case 124 : $retorno = 'y'. $retorno; break; case 125 : $retorno = 'z'. $retorno; break;
		}
	}
	
	return $retorno;
	
}

function encripta($param){    

$code = '';
	for($i = 0; $i < sizeof($param); $i++)
    {       
        $x = CRP8532_XLI(substr($param, $i, 1)) + 18 ;
        
        if ($code == ""){
            $code = $x;
        }else
        {
            $code = $x . "_" . $code;
        }
    }
    return $code;    
}

function CRP8532_XLI($str)
{
        if ($str == "&") return 55;
        if ($str == "=") return 65;       
        if ($str == "0") return 13;
        if ($str == "1") return 14;
        if ($str == "2") return 15;
        if ($str == "3") return 16;
        if ($str == "4") return 17;
        if ($str == "5") return 18;
        if ($str == "6") return 19;
        if ($str == "7") return 20;
        if ($str == "8") return 21;
        if ($str == "9") return 22;

        if ($str == "A") return 23;
        if ($str == "B") return 24;
        if ($str == "C") return 25;
        if ($str == "D") return 26;
        if ($str == "E") return 27;
        if ($str == "F") return 28;
        if ($str == "G") return 29;
        if ($str == "H") return 30;
        if ($str == "I") return 31;
        if ($str == "J") return 32;
        if ($str == "K") return 33;
        if ($str == "L") return 34;
        if ($str == "M") return 35;
        if ($str == "N") return 36;
        if ($str == "O") return 37;
        if ($str == "P") return 38;
        if ($str == "Q") return 39;
        if ($str == "R") return 40;
        if ($str == "S") return 41;
        if ($str == "T") return 42;
        if ($str == "U") return 43;
        if ($str == "V") return 44;
        if ($str == "W") return 45;
        if ($str == "X") return 46;
        if ($str == "Y") return 47;
        if ($str == "Z") return 48;
        if ($str == "a") return 100;
        if ($str == "b") return 101;
        if ($str == "c") return 102;
        if ($str == "d") return 103;
        if ($str == "e") return 104;
        if ($str == "f") return 105;
        if ($str == "g") return 106;
        if ($str == "h") return 107;
        if ($str == "i") return 108;
        if ($str == "j") return 109;
        if ($str == "k") return 110;
        if ($str == "l") return 111;
        if ($str == "m") return 112;
        if ($str == "n") return 113;
        if ($str == "o") return 114;
        if ($str == "p") return 115;
        if ($str == "q") return 116;
        if ($str == "r") return 117;
        if ($str == "s") return 118;
        if ($str == "t") return 119;
        if ($str == "u") return 120;
        if ($str == "v") return 121;
        if ($str == "w") return 122;
        if ($str == "x") return 123;
        if ($str == "y") return 124;
        if ($str == "z") return 125;
}


function get_rnd_iv($iv_len)
{
    $iv = '';
    while ($iv_len-- > 0) {
        $iv .= chr(mt_rand() & 0xff);
    }
    return $iv;
}

function md5_encrypt($plain_text, $password, $iv_len = 16)
{
    $plain_text .= "\x13";
    $n = strlen($plain_text);
    if ($n % 16) $plain_text .= str_repeat("\0", 16 - ($n % 16));
    $i = 0;
    $enc_text = get_rnd_iv($iv_len);
    $iv = substr($password ^ $enc_text, 0, 512);
    while ($i < $n) {
        $block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
        $enc_text .= $block;
        $iv = substr($block . $iv, 0, 512) ^ $password;
        $i += 16;
    }
    return base64_encode($enc_text);
}

function md5_decrypt($enc_text, $password, $iv_len = 16)
{
    $enc_text = base64_decode($enc_text);
    $n = strlen($enc_text);
    $i = $iv_len;
    $plain_text = '';
    $iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
    while ($i < $n) {
        $block = substr($enc_text, $i, 16);
        $plain_text .= $block ^ pack('H*', md5($iv));
        $iv = substr($block . $iv, 0, 512) ^ $password;
        $i += 16;
    }
    return preg_replace('/\\x13\\x00*$/', '', $plain_text);
}

	Function CriptografarURL($param){
		$CHAVE_CRIPTOGRAFIA_RIO = 18743;
        $strFinal = '';

        for($s = 0; $s < strlen($param); $s++){ 
	       $valorMultpChave = ((int)GerarCodigoDaString(substr($param,$s,1))) * $CHAVE_CRIPTOGRAFIA_RIO;
           $strFinal = strlen($valorMultpChave).$valorMultpChave.$strFinal;
        }   
        return $strFinal;
	}                

        Function GerarCodigoDaString($str){

            switch($str){
                Case "&" : Return 7 ; break;
                Case "=" : Return 13; break;

                Case "0" : Return 12; break;
                Case "1" : Return 11; break;
                Case "2" : Return 2 ; break;
                Case "3" : Return 10; break;
                Case "4" : Return 3 ; break;
                Case "5" : Return 9 ; break;
                Case "6" : Return 4 ; break;
                Case "7" : Return 8 ; break;
                Case "8" : Return 5 ; break;
                Case "9" : Return 6 ; break;

                Case "A" : Return 14; break;
                Case "B" : Return 41; break;
                Case "C" : Return 15; break;
                Case "D" : Return 40; break;
                Case "E" : Return 16; break;
                Case "F" : Return 39; break;
                Case "G" : Return 17; break;
                Case "H" : Return 38; break;
                Case "I" : Return 18; break;
                Case "J" : Return 37; break;
                Case "K" : Return 19; break;
                Case "L" : Return 36; break;
                Case "M" : Return 20; break;
                Case "N" : Return 35; break;
                Case "O" : Return 21; break;
                Case "P" : Return 34; break;
                Case "Q" : Return 22; break;
                Case "R" : Return 33; break;
                Case "S" : Return 23; break;
                Case "T" : Return 32; break;
                Case "U" : Return 24; break;
                Case "V" : Return 31; break;
                Case "W" : Return 25; break;
                Case "X" : Return 30; break;
                Case "Y" : Return 26; break;
                Case "Z" : Return 29; break;

                Case "a" : Return 42; break;
                Case "b" : Return 67; break;
                Case "c" : Return 43; break;
                Case "d" : Return 66; break;
                Case "e" : Return 44; break;
                Case "f" : Return 65; break;
                Case "g" : Return 45; break;
                Case "h" : Return 64; break;
                Case "i" : Return 46; break;
                Case "j" : Return 63; break;
                Case "k" : Return 47; break;
                Case "l" : Return 62; break;
                Case "m" : Return 48; break;
                Case "n" : Return 61; break;
                Case "o" : Return 49; break;
                Case "p" : Return 60; break;
                Case "q" : Return 50; break;
                Case "r" : Return 59; break;
                Case "s" : Return 51; break;
                Case "t" : Return 58; break;
                Case "u" : Return 52; break;
                Case "v" : Return 57; break;
                Case "w" : Return 53; break;
                Case "x" : Return 56; break;
                Case "y" : Return 54; break;
                Case "z" : Return 55; break;
            }
            Return null;
        }


?>