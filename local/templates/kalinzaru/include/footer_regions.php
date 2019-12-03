<?php

use core\Regionality;

$regions = Regionality::getAllRegions();
?>

<? foreach ($regions as $region): ?>
    <a href="/nashi-magaziny/?REGION_ID=<?= $region['ID'] ?>"><?= $region['NAME'] ?></a>
<? endforeach; ?>

