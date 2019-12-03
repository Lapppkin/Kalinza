<?php

use core\Helper;
use core\Regionality;

$emails = Regionality::getCurrentRegionEmails();
?>

<? foreach ($emails as $email): ?>
    <a href="mailto:<?= $email ?>"><?= $email ?></a><br>
<? endforeach; ?>
