<!DOCTYPE HTML>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cloud Message</title>
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="icon" href="images/favicon.ico">
<link type="text/css" rel="stylesheet" href="main.css">
</head>


<body>

    <header class="body">
		<h1><a href="http://opencnu.duapp.com"><img width=15% src="images/sites.png" alt="home"></a>Cloud Message</h1>
    </header>

    <section class="body">

		<?php

			require_once ( "Bcms.class.php" ) ;
/*
			$accessKey = 'FA11e70fdd285bec998fa7d9a51db913';
			$secretKey = '758770169ba6ea5ffbfc930c21f3212a';
			$host = 'bcms.api.duapp.com';
*/
			function error_output ( $str ) 
			{
				echo "\033[1;40;31m" . $str ."\033[0m" . "\n";
			}

			function right_output ( $str ) 
			{
				echo "\033[1;40;32m" . $str ."\033[0m" . "\n";
			}

			function send_sms ( $queueName, $message, $address ) 
			{
			/*	global $accessKey, $secretKey, $host;
				$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
			*/
				$bcms= new Bcms();
				$ret = $bcms->sms ( $queueName, $message, $address ) ;
				if ( false === $ret ) 
				{
					echo '<p>Oops, something went wrong, try again!</p>'; 
			/*
					error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
					error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
					error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
					error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
			*/
				}
				else
				{
					echo '<p>Your message has been sent!</p>';
			/*
					right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
					right_output ( 'result: ' . print_r ( $ret, true ) ) ;
			*/
				}	
			}

			$phonenum = $_POST['phonenum'];
			$passwd = $_POST['passwd'];
			$message = $_POST['message'];
			
			
			if ($_POST['submit'] && $passwd == '010') {
				//if($phonenum=='010')
				//	$phonenum='152xxxxxxxx';//my personal phone number.
				$address = array("$phonenum");
				send_sms ( '078c4f35601848b317564deae594af3d',mb_convert_encoding ( $message , 'utf-8', 'auto') , $address) ;
			} else if ($_POST['submit'] && $passwd != '4') {
			echo '<p>You password incorrectly!</p>';
			}
		?>

	<form method="post" action="index.php">

 			<label>Phone Number</label>
            <input name="phonenum" type="tel" placeholder="Type Here">
            
            <label>Password</label>
            <input name="passwd" type="password" placeholder="Type Here">
            
			 <label>Message</label>
             <textarea name="message" placeholder="Type Here"></textarea>

            <input id="submit" name="submit" type="submit" value="Submit">

		
		</form>

    </section>

    <footer class="body">
	<a href="http://opencnu.duapp.com"><img width=10% height=10% src="images/cloud.png" alt="BAE Logo"></a>
    </footer>

</body>

</html>
