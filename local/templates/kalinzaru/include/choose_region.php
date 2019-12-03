<?php

use core\Regionality;

$regions = Regionality::getAllRegions();
?>

<div class="choose-region">
    <form id="form-choose-region">
        <?= bitrix_sessid_post() ?>
    </form>
    <select name="REGION_ID" id="region" form="form-choose-region" class="js-choose-region" title="Выберите ваш регион">
        <? foreach ($regions as $region): ?>
            <option value="<?= $region['ID'] ?>" <? if ($region['ID'] == REGION_ID) print 'selected' ?>>
                <?= $region['NAME'] ?>
            </option>
        <? endforeach; ?>
    </select>
</div>
