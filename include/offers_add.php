<?php

use core\Helper;

?>
<div class="offers-add">
    <div class="container">
        <div class="row">
            <div class="offers-add--wrapper col-12">

                <a class="offers-add--item" href="/informaciya/dostavka-i-oplata/">
                    <div class="offers-add--item--icon"><?= Helper::renderIcon('delivery-truck') ?></div>
                    <div class="offers-add--item--text">Доставка в день заказа</div>
                </a>
                <a class="offers-add--item" href="/besplatnaya-proverka-zreniya/">
                    <div class="offers-add--item--icon"><?= Helper::renderIcon('eye-big') ?></div>
                    <div class="offers-add--item--text">Бесплатная проверка зрения</div>
                </a>
                <?/*
                <a class="offers-add--item">
                    <div class="offers-add--item--icon"><?= Helper::renderIcon('eye-glasses') ?></div>
                    <div class="offers-add--item--text">Большой ассортимент</div>
                </a>
                */?>
                <a class="offers-add--item" href="/company/pochemu-v-kalinza-ru-deshevle-chem-v-optike/">
                    <div class="offers-add--item--icon"><?= Helper::renderIcon('wallet') ?></div>
                    <div class="offers-add--item--text">Доступные цены</div>
                </a>

            </div>
        </div>
    </div>
</div>
