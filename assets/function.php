<?php

	function my_hash($pass) {
		$pwd = hash("whirlpool", $pass);
		return ($pwd);
	}

	function validate_pass($pass) {
	    $reg = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,42}$/";

	    return preg_match($reg, $pass);
	}

	function generate_random_string($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++)
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    return $randomString;
	}

function sendConfirmMail($usercode, $mail, $username)
{
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
        $passage_ligne = "\r\n";
    else
        $passage_ligne = "\n";
    $message_txt = "Hi ".$username.$passage_ligne."
    This is your activation link : http://".$_SERVER['HTTP_HOST']."/activate.php?mail=".$mail."&code=".$usercode." ".$passage_ligne.$passage_ligne." 
    See you soon !";
    $message_html = "<html><head></head><body>Hi <b>".$username."</b><br /> 
    This is your activation link : http://".$_SERVER['HTTP_HOST']."/activate.php?mail=".$mail."&code=".$usercode." <br /><br />
    See you soon !</body></html>";
    $boundary = "-----=".md5(rand());
    $boundary_alt = "-----=".md5(rand());
    $sujet = "Inscription Camagru";
    $header = "From: \"Camagru <Ebertin>!\"<ebertin@student.42.fr>".$passage_ligne;
    $header.= "Reply-to: \"Elliot B\" <ebertin@student.42.fr".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary.$passage_ligne;
    mail($mail,$sujet,$message,$header);
}
?>
