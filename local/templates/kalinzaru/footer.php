<?

/**
 * @var \CMain $APPLICATION
 */

use Bitrix\Main\Page\Asset;

    ?>
                    </div>
                </div>
            </main>

            <footer id="footer">
                <?
                $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/footer_menu.php');
                $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/footer_bottom.php');
                ?>
            </footer>

            <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/modals.php'); ?>

            <?
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/jquery.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/bootstrap.bundle.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/jquery.carousel.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/jquery.fancybox.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/jquery.inputmask.bundle.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/vendor/jquery.malihu.PageScroll2id.js');

            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/main.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/modals.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/sliders.min.js');
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/svg_localstorage.min.js');
            ?>

            <div style="display:none;">
                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/seo_bottom.php'); ?>
                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/schemaorg.php'); ?>
            </div>

        </div>
    </body>
</html>
