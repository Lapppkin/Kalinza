<?php

use core\Helper;

?>
<!--about us-->
<div class="about-us">
    <div class="container">
        <div class="row">
            <div class="about-us--wrapper col-12">

                <div class="find-yours about-us--item">
                    <a href="/catalog/">
                        <div class="about-us--item--image">
                            <img src="<?= SITE_DIR . 'include/images/find-optics.jpg' ?>" alt="Найди свою оптику">
                        </div>
                        <div class="about-us--item--title">
                            <h3><span><?= Helper::renderIcon('location') ?></span> Найди свою оптику</h3>
                        </div>
                    </a>
                </div>

                <div class="kalinza-faces about-us--item">
                    <a href="/kalinza-v-litsakh/">
                        <div class="about-us--item--image">
                            <img src="<?= SITE_DIR . 'include/images/faces.png' ?>" alt="KALINZA в лицах">
                        </div>
                        <div class="about-us--item--title">
                            <h3><span>Kalinza</span> в лицах</h3>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
<!--/about us-->
