<!doctype html>
<html lang="de" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>LfSt Adventskalenderbot</title>
</head>
<body>
<pre><?php
  require 'conf.inc.php';
  require 'inc/phpmailer/PHPMailerAutoload.php';

  // ---------------------------------------------------------------------------
  // Plumbing

  $currentDay = date('d.m.');

  function writeWinnerToLog($todaysWinner)
  {
    global $currentDay;
    $logFile = fopen('protocol.log', 'a');
    if ($logFile !== FALSE) {
      fwrite($logFile, $currentDay.' - '.$todaysWinner['name']."\n");
      fclose($logFile);
    }
  }

  function sendMail($todaysWinner) {
    global $colleagues;
    global $banter;
    global $currentDay;

    $winner = explode(' ', $todaysWinner['name']);

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = MAIL_HOST;;
    $mail->SMTPAuth = true;
    $mail->Username = MAIL_USER;
    $mail->Password = MAIL_PASS;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
    foreach ($colleagues as $col) {
      $mail->addAddress($col['email'], $col['name']);
    }
    $mail->isHTML(false);

    $mail->Subject = MAIL_SUBJECT.': '.$currentDay;

    // -- Body ---------
    $logFile = file_get_contents('./protocol.log');

    $altBody = 'Der heutige Gewinner ist '.$winner[0]."!\n\n"
            .$banter[rand(0, count($banter) - 1)]."\n\n\n"
            .'Hier noch das Protokoll der letzten Ziehungen:'."\n"
            .'------------------------------------------------------------'."\n"
            .file_get_contents('./protocol.log');
    $body = nl2br($altBody);

    $mail->Body = $body;
    $mail->AltBody = $altBody;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
  }

  // ---------------------------------------------------------------------------
  // Gruntwork

  $todaysWinner = $colleagues[rand(0, count($colleagues) - 1)];

  writeWinnerToLog($todaysWinner);
  sendMail($todaysWinner);
?></pre>
</body>
</html>