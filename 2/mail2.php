<?php
function generkey($length,$type='pass')
{
    $gen=($type=='pass')?array('a','b','c','d', 'e', 'f','1','2','3','4','5','6','7','8','9','0'):array('1','2','3','4','5','6','7','8','9','0');
    for($i=0;$i<$length;$i++)
    {
        $char=$gen[rand(0,sizeof($gen)-1)];
        $key[]=$char;
    }
    if($length!=0)
    {
        return join('',$key);
    }
return false;
}
$kod = generkey(6,'pass');


$sitename1 = "kalinza.ru";
$to  = 'akapinos@lapkinlab.ru' . ', ';
$to .= 'lapppkin@yahoo.com' . ', ';
$to .= 'kalinza.krd@gmail.com' . ', ';
$to .= 'pochta@lapkinlab.ru' . ', ';
$email1 = trim($_POST["email"]);
$subject = "Новая зявка на 500 рублей с сайта \"$sitename1\"";
$message = '
<html>
    <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Новая зявка на 500 рублей с сайта '.$sitename1.'</title>
    </head>
    <body>
        <p>Email: '.$email1.' <br> Код: '.$kod.' <br> Хочу 500 рублей!</p>
    </body>
</html>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: Интернет-магазин kalinza.ru <info@kalinza.ru>\r\n";
$headers .= 'Cc: akapinos@lapkinlab.ru' . "\r\n";
$headers .= "Bcc: akapinos@lapkinlab.ru\r\n";
mail($to, $subject, $message, $headers);



$email = trim($_POST["email"]);
$sitename = "kalinza.ru";
$recepient = $email;
$message = "Здравствуйте, \nВаш ключ -  $kod для получения скидки 500 рублей на покупку очков.\nПожалуйста скажите эти 6 символов нашему продавцу и Вы получите скидку! Спасибо. \nДля уточнения информации наберите: тел. 8 (861)-292-16-40.";
$pagetitle = "Зявка на 500 рублей с сайта \"$sitename1\"";

$email = trim($_POST["email"]);
$to  = $email;
$subject = "Ваши 500 рублей на очки с сайта \"$sitename\"";
$message = '
<html>
    <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Зявка на 500 рублей с сайта '.$sitename.'</title>
    </head>
    <body>
        <p>Здравствуйте, <br>Ваш ключ -  '.$kod.' для получения скидки 500 рублей на покупку очков.<br>Пожалуйста скажите эти 6 символов нашему продавцу и Вы получите скидку! Спасибо. <br>Для уточнения информации наберите: тел. 8 (861)-292-16-40.</p>
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
$subject = "Новая зявка на 500 рублей с сайта \"$sitename\"";
$message = '
<html>
    <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Новая зявка на 500 рублей с сайта '.$sitename.'</title>
    </head>
    <body>
        <p>Email: '.$email1.' <br> Код: '.$kod.' <br> Хочу 500 рублей! <br> &nbsp;</p>
        <p>IP: '.$ip.'</p>
    </body>
</html>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: Интернет-магазин kalinza.ru <info@kalinza.ru>\r\n";
$headers .= 'Cc: akapinos@lapkinlab.ru' . "\r\n";
$headers .= "Bcc: akapinos@lapkinlab.ru\r\n";
mail($to2, $subject, $message, $headers);
header("Location: https://kalinza.ru/spasibo_mess");
?>