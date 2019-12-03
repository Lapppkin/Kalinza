<?php

use core\Helper;
use core\Regionality;

$phones = Regionality::getCurrentRegionPhones();
?>

<? foreach ($phones as $phone): ?>
    <?= Helper::parsePhone($phone, 'link') ?><br>
<? endforeach; ?>
