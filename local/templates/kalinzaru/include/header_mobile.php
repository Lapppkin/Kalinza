<?php

use Deadie\Helper;

?>
<!--header mobile-->
<div class="header--mobile">
    <div class="container">
        <div class="row">
            <div class="header--mobile--wrapper col-12">
                <div class="header--mobile--menu">
                    <?= Helper::renderIcon('menu') ?>
                </div>
                <div class="header--mobile--search">
                    <a href="/search/">
                        <?= Helper::renderIcon('search') ?>
                    </a>

                    <!--search bar-->
                    <div class="header--mobile--search-bar"></div>

                </div>
                <div class="header--mobile--logo">
                    <a href="/" title="Главная">
                        <img src="<?= SITE_TEMPLATE_PATH . '/images/logo-mobile.svg' ?>" alt="KALINZA">
                    </a>
                </div>
                <div class="header--mobile--cart">
                    <a class="header-mobile--cart-icon" href="/personal/cart/">
                        <?= Helper::renderIcon('shopping-cart') ?>
                    </a>
                    <div class="header--mobile--cart-counter">0</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--popup menu-->
<div class="header--mobile--menu-popup">
    <div class="mobile-menu--header">
        <div class="mobile-menu--close">
            <?= Helper::renderIcon('close') ?>
        </div>
        <div class="mobile-menu--logo">
            <a href="/" title="Главная">
                <img src="<?= SITE_TEMPLATE_PATH . '/images/logo-mobile.svg' ?>" alt="KALINZA">
            </a>
        </div>
    </div>
    <div class="mobile-menu--location">
        <div class="mobile-menu--location-icon"><?= Helper::renderIcon('location') ?></div>
        <div class="mobile-menu--location-city">Краснодар</div>
    </div>
    <div class="mobile-menu--auth"></div>
    <div class="mobile-menu--catalog"></div>
    <div class="mobile-menu--menu"></div>
    <div class="mobile-menu--footer">
        <div class="mobile-menu--footer--phone"></div>
        <div class="mobile-menu--footer--callback"></div>
        <div class="mobile-menu--footer--socials"></div>
    </div>
</div>

