<?php
$sitename = "kalinza.ru";
$to  = 'akapinos@lapkinlab.ru' . ', ';
$to .= 'lapppkin@yahoo.com' . ', ';
$to .= 'kalinza.krd@gmail.com' . ', ';
$to .= 'pochta@lapkinlab.ru' . ', ';
//$to .= 'kapinos.aptem@gmail.com' . ', ';

$day = trim($_POST["day"]);
$mes = trim($_POST["mes"]);
$god = trim($_POST["god"]);
$time = trim($_POST["time"]);
$name = trim($_POST["name"]);
$phone = trim($_POST["phone"]);
$contact = trim($_POST["contact"]);


$subject = "Бесплатная проверка зрения - \"$sitename\"";
$message = '
<html>
    <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Бесплатная проверка зрения - '.$sitename.'</title>
    </head>
    <body>
        <p>День: '.$day.' <br> Месяц: '.$mes.' <br> Год: '.$god.' <br> Время: '.$time.' <br> Имя: '.$name.' <br> Телефон: '.$phone.' <br> Адрес: '.$contact.'</p>
    </body>
</html>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: Интернет-магазин kalinza.ru <info@kalinza.ru>\r\n";
$headers .= 'Cc: akapinos@lapkinlab.ru' . "\r\n";
$headers .= "Bcc: akapinos@lapkinlab.ru\r\n";
mail($to, $subject, $message, $headers);

$to2 = 'akapinos@lapkinlab.ru';
$client  = @$_SERVER['HTTP_CLIENT_IP'];
$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = @$_SERVER['REMOTE_ADDR'];
if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
else $ip = $remote;
$subject = "Бесплатная проверка зрения - \"$sitename\"";
$message = '
<html>
    <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Бесплатная проверка зрения - '.$sitename.'</title>
    </head>
    <body>
        <p>День: '.$day.' <br> Месяц: '.$mes.' <br> Год: '.$god.' <br> Время: '.$time.' <br> Имя: '.$name.' <br> Телефон: '.$phone.' <br> Адрес: '.$contact.' <br> &nbsp;</p>
        <p>IP: '.$ip.'</p>
    </body>
</html>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: Интернет-магазин kalinza.ru <info@kalinza.ru>\r\n";
$headers .= 'Cc: akapinos@lapkinlab.ru' . "\r\n";
$headers .= "Bcc: akapinos@lapkinlab.ru\r\n";
mail($to2, $subject, $message, $headers);
header("Location: https://kalinza.ru/spasibo/spasibo_proverka");
?>
