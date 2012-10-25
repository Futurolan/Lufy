<?php
/******/
$host = 'localhost';
$login = 'ga';
$password = 'OUjcGOhsSqrmOolG';
$dbname = 'ga_prod';
/******/


/****************************/	
/* Fichier de retour de paypal */
/****************************/
/* 23/09/2010 */


		// PHP 4.1

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) 
		{
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		// post back to PayPal system to validate
		$header  = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

		// assign posted variables to local variables
		$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$custom = $_POST['custom'];
		$payer_email = $_POST['payer_email'];
    $date_rcpt = date('Y-m-d H:i:s');

		if (!$fp)
		{
			// HTTP ERROR
		}
		else 
		{
			fputs ($fp, $header . $req);
			while (!feof($fp)) 
			{
				$res = fgets ($fp, 1024);
				if (strcmp ($res, "VERIFIED") == 0)
				{
	  if ($custom == 'cotisation') {
		$e_subject = "Nouveau membre - Cotisation Paypal";
		$e_to = "contact@futurolan.net";
		$e_message = "
			Num transaction paypal : $txn_id \r\n
			Email : $payer_email
		";
		$e_headers = 'From: noreply@futurolan.net' . "\r\n" .
			'Reply-To: webmaster@futurolan.net' . "\r\n" .
	                'Cci: futurolan@gmail.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		mail($e_to, $e_subject, $e_message, $e_headers);
			
	  }
          mysql_connect($host, $login, $password);
          mysql_select_db($dbname);
					
          mysql_query("INSERT INTO p_ipn_paypal (id, txn_id, amount, currency, licence_ga, email, status, is_checked, created_at) VALUES ('', '$txn_id', '$payment_amount', '$payment_currency', '$custom', '$payer_email', '$payment_status', '0', '$date_rcpt')");
				}
				else if (strcmp ($res, "INVALID") == 0)
				{
					$e_to      = 'inscriptions@futurolan.net';
          $e_subject = 'ERR-PPRESULT-0';
          $e_message = 'Erreur enregistrement IPN Paypal' . "\r\n IP : " .$_SERVER['REMOTE_ADDR'];
          $e_headers = 'From: noreply@futurolan.net' . "\r\n" .
            'Reply-To: webmaster@futurolan.net' . "\r\n" .
            'Cci: futurolan@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

          mail($e_to, $e_subject, $e_message, $e_headers);
				}
			}
			fclose ($fp);
		}



?>
