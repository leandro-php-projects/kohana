<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Functions {
	
	//Define new passwords
	public static function generatespassword($size = 8, $uppercase = true, $numbers = true, $symbols = false)
	{
		$llower = 'abcdefghijklmnopqrstuvwxyz';
		$lupper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';
		$exit = '';
		$characters = '';
		
		$characters .= $lmin;
		if ($uppercase) $characters .= $lupper;
		if ($numbers) $characters .= $num;
		if ($symbols) $characters .= $simb;
		
		$len = strlen($characters);
		for ($n = 1; $n <= $size; $n++) {
			$rand = mt_rand(1, $len);
			$exit .= $characters[$rand-1];
		}
			return $exit;
	}
	
	public static function emailvalidate($mail){
		if(preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(\.[[:lower:]]{2,3})(\.[[:lower:]]{2})?$/", $mail)) {
			return true;
		}else{
			return false;
		}
	}
	
	public static function logs($table, $data){
		echo $table;
		echo '<pre>';
		print_r($data);
		die();
	}

	public static function printrd($array){
		echo "<div style='z-index: 100; position: absolute; border: 1px sold #666666; background: #cccccc; width: 500px'>";
		echo "<pre>";
		print_r($array);
		echo "</pre>";
		echo "</div>";
		die();
	}	
	
	public static function printr($array){
		echo "<div style='z-index: 100; position: absolute; border: 1px sold #666666; background: #cccccc; width: 500px'>";
		echo "<pre>";
		print_r($array);
		echo "</pre>";
		echo "</div>";
	}
	
	public static function ridingtext($txt){
	 $txt = ucfirst($txt);
	 $txt =nl2br($txt);
	 $txt =stripslashes($txt);
		$altera_texto["\\[/link]"]="</a>";
/*		$altera_texto["\\[link='http:"]="<a class=link target=_blank href='http:";
		$altera_texto["\\[link"]="<a class=link href";
		$altera_texto["\\[justificado]"]="<div align='justify'>";
		$altera_texto["\\[/justificado]"]="</div>";
		$altera_texto["\\[direita]"]="<div align='right'>";
		$altera_texto["\\[/direita]"]="</div>";
		$altera_texto["\\[esquerda]"]="<div align='left'>";
		$altera_texto["\\[/esquerda]"]="</div>";
		$altera_texto["\\[centralizado]"]="<center>";
		$altera_texto["\\[/centralizado]"]="</center>";
		$altera_texto["\\[paragrafo]"]="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$altera_texto["\\[marcador]"]="<li>";
		$altera_texto["\\[negrito]"]="<b>";
		$altera_texto["\\[/negrito]"]="</b>";
		$altera_texto["\\[italico]"]="<i>";
		$altera_texto["\\[/italico]"]="</i>";
		$altera_texto["\\[sublinhado]"]="<u>";
		$altera_texto["\\[/sublinhado]"]="</u>";
		$altera_texto["\\[vermelho]"]="<font color=A5011B>";
		$altera_texto["\\[/vermelho]"]="</font>";
		$altera_texto["\\[oferta_publica]"]="";
		$altera_texto["\\[tamanho12]"]="<span class=tamanho12>";
		$altera_texto["\\[/tamanho12]"]="</span>";

		$altera_texto["\\]"]="</a>";
		
		foreach (array_keys($altera_texto) as $texto)
		{
			$txt = preg_replace ($texto, $altera_texto[$texto], $txt);
		}*/
		return($txt);

   }	
   
  public static function sendmail($from, $fromname, $to, $subject, $body) {

	  require_once("mailer/class.phpmailer.php"); 

	  $mail = new PHPMailer();
	  $mail->SetLanguage("br");
	  //$mail->IsSMTP();
	  //$mail->Port    = 587; 
	  $mail->IsHTML(true);
	  $mail->From = $from;
	  $mail->FromName = $fromname;
	  $mail->AddAddress($to);
	  $mail->Subject = $subject;
	  $mail->Body = $body;
	  if(!$mail->Send()){
			  return false;
	  } else
			  return true;
	}
	
	public static function sendmail_certified($from, $fromname, $to, $subject, $body) {
			 
		require("mailer/class.phpmailer.php");
		 
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "ssl";
		$mail->Port       = 465;  
		$mail->Host       = "smtp.gmail.com";
		$mail->Username   = "rolemakcomercial@gmail.com";
		$mail->Password   = "comercial#$%";
		$mail->Sender = $from; 
		$mail->From = $from;
		$mail->FromName = $fromname; 
		$mail->AddAddress($to);
		$mail->IsHTML(true); 
		$mail->Subject  = $subject;
		$mail->Body = $body;
			 
			$send = $mail->Send();
	
			if(!$send){
						return false;
				}else{
						return true;
				}
	}				
	
	
}