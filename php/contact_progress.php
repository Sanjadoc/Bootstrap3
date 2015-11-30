<?php

    include 'defines.php';
    include 'email_validation.php';

	$post = (!empty($_POST)) ? true : false;

	if($post){

		$name = stripslashes($_POST['name']);
		$phone = stripslashes($_POST['phone']);
		$email = stripslashes($_POST['email']);
		$subject = 'Bid';
		$error = '';
		$message = '
			<html>
					<head>
							<title>Bid</title>
					</head>
					<body>
							<p>Имя: '.$name.'</p>
							<p>Телефон : '.$phone.'</p>
							<p>Email : '.$email.'</p>
					</body>
			</html>';

		if (!ValidateEmail($email)){
			$error = 'Email incorrectly!';
		}

		if(!$error){
			$mail = mail(CONTACT_FORM, $subject, $message,
			     "From: ".$name." <".$email.">\r\n"
			    ."Reply-To: ".$email."\r\n"
			    ."Content-type: text/html; charset=utf-8 \r\n"
			    ."X-Mailer: PHP/" . phpversion());

			if($mail){
				echo 'OK';
			}
		}else{
			echo '<div class="bg-danger">'.$error.'</div>';
		}

	}
?>