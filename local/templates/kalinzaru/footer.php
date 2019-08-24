<?php

/**
 * @var \CMain $APPLICATION
 */

use Bitrix\Main\Page\Asset;

?>
            <?php if ($APPLICATION->GetCurDir() !== '/'): ?>
                    </div>
                </div>
            <?php endif; ?>
            </main>

            <footer id="footer">
                <?php
                $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/footer_menu.php');
                $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/footer_bottom.php');
                ?>
            </footer>

            <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/modals.php'); ?>

            <?php
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/jquery.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/bootstrap.bundle.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/owl.carousel.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/jquery.fancybox.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/jquery.inputmask.bundle.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/jquery.malihu.PageScroll2id.js');

            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/main.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/modals.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/sliders.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/svg_localstorage.min.js');
            ?>

            <div style="display:none;">
                <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/seo_bottom.php'); ?>
                <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/schemaorg.php'); ?>
            </div>

        </div>
    </body>
</html>
