<?php

/**
 * @var \CMain $APPLICATION
 */

?>
</div>
</div>
</div>

<footer id="colorlib-footer" role="contentinfo">
    <div class="overlay"></div>
    <div class="container container-fix">
        <div class="row row-pb-md">
            <div class="col-md-2">
                <ul class="colorlib-footer-links">
                    <li class="bx-block-title">Хиты продаж</li>
                    <?php $APPLICATION->IncludeComponent('bitrix:menu', 'bottom_menu', [
                        'ROOT_MENU_TYPE'        => 'bot1',
                        'MENU_CACHE_TYPE'       => 'A',
                        'MENU_CACHE_TIME'       => '36000000',
                        'MENU_CACHE_USE_GROUPS' => 'Y',
                        'MENU_CACHE_GET_VARS'   => [],
                        'CACHE_SELECTED_ITEMS'  => 'N',
                        'MAX_LEVEL'             => '1',
                        'USE_EXT'               => 'Y',
                        'DELAY'                 => 'N',
                        'ALLOW_MULTI_SELECT'    => 'N',
                        'COMPONENT_TEMPLATE'    => 'bottom_menu',
                        'CHILD_MENU_TYPE'       => 'left',
                    ], false); ?>
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="colorlib-footer-links">
                    <li class="bx-block-title">Линзы по сроку ношения</li>
                    <?php $APPLICATION->IncludeComponent('bitrix:menu', 'bottom_menu', [
                        'ROOT_MENU_TYPE'        => 'bot2',
                        'MENU_CACHE_TYPE'       => 'A',
                        'MENU_CACHE_TIME'       => '36000000',
                        'MENU_CACHE_USE_GROUPS' => 'Y',
                        'MENU_CACHE_GET_VARS'   => [],
                        'CACHE_SELECTED_ITEMS'  => 'N',
                        'MAX_LEVEL'             => '1',
                        'USE_EXT'               => 'Y',
                        'DELAY'                 => 'N',
                        'ALLOW_MULTI_SELECT'    => 'N',
                        'COMPONENT_TEMPLATE'    => 'bottom_menu',
                        'CHILD_MENU_TYPE'       => 'left',
                    ], false); ?>
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="colorlib-footer-links">
                    <li class="bx-block-title">До того как вы купили</li>
                    <?php $APPLICATION->IncludeComponent('bitrix:menu', 'bottom_menu', [
                        'ROOT_MENU_TYPE'        => 'bot3',
                        'MENU_CACHE_TYPE'       => 'A',
                        'MENU_CACHE_TIME'       => '36000000',
                        'MENU_CACHE_USE_GROUPS' => 'Y',
                        'MENU_CACHE_GET_VARS'   => [],
                        'CACHE_SELECTED_ITEMS'  => 'N',
                        'MAX_LEVEL'             => '1',
                        'USE_EXT'               => 'Y',
                        'DELAY'                 => 'N',
                        'ALLOW_MULTI_SELECT'    => 'N',
                        'COMPONENT_TEMPLATE'    => 'bottom_menu',
                        'CHILD_MENU_TYPE'       => 'left',
                    ], false); ?>
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="colorlib-footer-links">
                    <li class="bx-block-title">&nbsp;</li>
                    <?php $APPLICATION->IncludeComponent('bitrix:menu', 'bottom_menu', [
                        'ROOT_MENU_TYPE'        => 'bot4',
                        'MENU_CACHE_TYPE'       => 'A',
                        'MENU_CACHE_TIME'       => '36000000',
                        'MENU_CACHE_USE_GROUPS' => 'Y',
                        'MENU_CACHE_GET_VARS'   => [],
                        'CACHE_SELECTED_ITEMS'  => 'N',
                        'MAX_LEVEL'             => '1',
                        'USE_EXT'               => 'Y',
                        'DELAY'                 => 'N',
                        'ALLOW_MULTI_SELECT'    => 'N',
                        'COMPONENT_TEMPLATE'    => 'bottom_menu',
                        'CHILD_MENU_TYPE'       => 'left',
                    ], false); ?>
                </ul>
            </div>
            <div class="col-md-1 bb44">
                <ul class="colorlib-footer-links">
                    <?php if ($USER->IsAuthorized()): ?>
                        <li><a class="button_modal" href="/?logout=yes">Выйти</a></li>
                    <?php else: ?>
                        <li><a class="button_modal" href="/auth/?register=yes">Регистрация</a></li>
                        <li><a class="button_modal" data-modal="modal_1" href="#">Вход</a></li>
                    <?php endif; ?>
                    <li>
                        <a href="https://vk.com/kalinza" style="margin-right: 10px;" target="_blank" rel="nofollow noopener"><img src="/2/images/vk.svg" alt=""/></a>
                        <a href="https://www.instagram.com/optika_kalinza/" target="_blank" rel="nofollow noopener"><img src="/2/images/instagram.svg" alt=""/></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <?php $APPLICATION->IncludeComponent(
                    'bitrix:search.title',
                    'visual1',
                    [
                        'NUM_CATEGORIES'            => '1',
                        'TOP_COUNT'                 => '0',
                        'CHECK_DATES'               => 'N',
                        'SHOW_OTHERS'               => 'N',
                        'PAGE'                      => SITE_DIR . 'catalog/',
                        'CATEGORY_0_TITLE'          => GetMessage('SEARCH_GOODS'),
                        'CATEGORY_0'                => [
                            0 => 'no',
                        ],
                        'CATEGORY_0_iblock_catalog' => '',
                        'CATEGORY_OTHERS_TITLE'     => GetMessage('SEARCH_OTHER'),
                        'SHOW_INPUT'                => 'Y',
                        'INPUT_ID'                  => 'title-search-input',
                        'CONTAINER_ID'              => 'search',
                        'PRICE_CODE'                => [
                            0 => 'BASE',
                        ],
                        'SHOW_PREVIEW'              => 'Y',
                        'PREVIEW_WIDTH'             => '75',
                        'PREVIEW_HEIGHT'            => '75',
                        'CONVERT_CURRENCY'          => 'Y',
                        'COMPONENT_TEMPLATE'        => 'visual1',
                        'ORDER'                     => 'date',
                        'USE_LANGUAGE_GUESS'        => 'Y',
                        'PRICE_VAT_INCLUDE'         => 'Y',
                        'PREVIEW_TRUNCATE_LEN'      => '',
                        'CURRENCY_ID'               => 'RUB',
                    ],
                    false
                ); ?>

                <ul class="social-links">
                    <li class="whatsapp">
                        <a href="https://api.whatsapp.com/send?phone=79182447228" target="_blank">
                            <span class="social-name">WhatsApp</span>
                            <span class="social-detail">+7 918 244-72-28</span>
                        </a>
                    </li>
                    <li class="viber">
                        <a href="viber://chat?number=79182447228" target="_blank">
                            <span class="social-name">Viber</span>
                            <span class="social-detail">+7 918 244-72-28</span>
                        </a>
                    </li>
                    <li class="instagram">
                        <a href="https://www.instagram.com/optika_kalinza/" target="_blank">
                            <span class="social-name">Instagram</span>
                            <span class="social-detail">optika_kalinza</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row row-md">
            <div class="col-md-6 cccc bottom_padd_blo">
                © 2009—2019 «Калинза». Все права защищены. <a href="/politika-konfidentsialnosti-i-soglasie-s-rassylkoy-i-nasha-otvetstvennost.php">Политики конфиденциальности</a>
            </div>
            <div class="col-md-6 cccc bottom_raz">
                <a href="http://lapkinlab.ru/" target="_blank" rel="nofollow noopener">Разработка сайта - </a><a href="http://msk.lapkinlab.ru/"
                                                                                                                 target="_blank"
                                                                                                                 rel="nofollow noopener"><img src="https://lapkinlab.ru/wp-content/uploads/2018/02/logo-new2.png"
                                                                                                                                              width="15%"/></a>
            </div>
        </div>
    </div>
</footer>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script src="/2/js/jquery.min.js"></script>
<script src="/2/js/jquery.easing.1.3.js"></script>
<script src="/2/bootstrap/js/bootstrap.min.js"></script>
<script src="/2/js/owl.carousel.min.js"></script>
<script src="/2/js/jquery.flexslider-min.js"></script>
<script src="/2/js/main.js"></script>

<script src="/2/js/horizontal.js"></script>
<script src="/2/js/sly.min.js"></script>

<?php if ($APPLICATION->GetProperty('novoe_svoistvo') == '2'): ?>
    <script src="/2/js/slides.min.jquery.js"></script>
    <script>
        jQuery(function() {
            jQuery('#products').slides({
                preload:            true,
                preloadImage:       'img/loading.gif',
                effect:             'slide, fade',
                crossfade:          true,
                slideSpeed:         200,
                fadeSpeed:          500,
                generateNextPrev:   true,
                generatePagination: false
            });

            jQuery('input.box').change(function() {
                if (document.getElementById('box-1').checked) {

                    document.getElementById('koll').value = '1';

                    document.getElementById('ckeeeeee').value = '0';

                    if (document.getElementById('ifff1')) {
                        document.getElementById('ifff1').style.opacity = '0.5';
                        document.getElementById('ifff1').style.cursor  = 'not-allowed';
                        document.getElementById('ifff1').setAttribute('disabled', 'disabled');
                    }
                    if (document.getElementById('ifff2')) {
                        document.getElementById('ifff2').style.opacity = '0.5';
                        document.getElementById('ifff2').style.cursor  = 'not-allowed';
                        document.getElementById('ifff2').setAttribute('disabled', 'disabled');
                    }
                    if (document.getElementById('ifff3')) {
                        document.getElementById('ifff3').style.opacity = '0.5';
                        document.getElementById('ifff3').style.cursor  = 'not-allowed';
                        document.getElementById('ifff3').setAttribute('disabled', 'disabled');
                    }
                    if (document.getElementById('ifff4')) {
                        document.getElementById('ifff4').style.opacity = '0.5';
                        document.getElementById('ifff4').style.cursor  = 'not-allowed';
                        document.getElementById('ifff4').setAttribute('disabled', 'disabled');
                    }
                    if (document.getElementById('ifff5')) {
                        document.getElementById('ifff5').style.opacity = '0.5';
                        document.getElementById('ifff5').style.cursor  = 'not-allowed';
                        document.getElementById('ifff5').setAttribute('disabled', 'disabled');
                    }
                    if (document.getElementById('ifff6')) {
                        document.getElementById('ifff6').style.opacity = '0.5';
                        document.getElementById('ifff6').style.cursor  = 'not-allowed';
                        document.getElementById('ifff6').setAttribute('disabled', 'disabled');
                    }
                    if (document.getElementById('ifff7')) {
                        document.getElementById('ifff7').style.opacity = '0.5';
                        document.getElementById('ifff7').style.cursor  = 'not-allowed';
                        document.getElementById('ifff7').setAttribute('disabled', 'disabled');
                    }
                    if (document.getElementById('ifff8')) {
                        document.getElementById('ifff8').style.opacity = '0.5';
                        document.getElementById('ifff8').style.cursor  = 'not-allowed';
                        document.getElementById('ifff8').setAttribute('disabled', 'disabled');
                    }
                    if (document.getElementById('ifff9')) {
                        document.getElementById('ifff9').style.opacity = '0.5';
                        document.getElementById('ifff9').style.cursor  = 'not-allowed';
                        document.getElementById('ifff9').setAttribute('disabled', 'disabled');
                    }
                    return;
                } else {
                    document.getElementById('koll').value = '2';

                    document.getElementById('ckeeeeee').value = '1';

                    if (document.getElementById('ifff1')) {
                        document.getElementById('ifff1').style.opacity = '1';
                        document.getElementById('ifff1').style.cursor  = 'pointer';
                        document.getElementById('ifff1').removeAttribute('disabled');
                    }
                    if (document.getElementById('ifff2')) {
                        document.getElementById('ifff2').style.opacity = '1';
                        document.getElementById('ifff2').style.cursor  = 'pointer';
                        document.getElementById('ifff2').removeAttribute('disabled');
                    }
                    if (document.getElementById('ifff3')) {
                        document.getElementById('ifff3').style.opacity = '1';
                        document.getElementById('ifff3').style.cursor  = 'pointer';
                        document.getElementById('ifff3').removeAttribute('disabled');
                    }
                    if (document.getElementById('ifff4')) {
                        document.getElementById('ifff4').style.opacity = '1';
                        document.getElementById('ifff4').style.cursor  = 'pointer';
                        document.getElementById('ifff4').removeAttribute('disabled');
                    }
                    if (document.getElementById('ifff5')) {
                        document.getElementById('ifff5').style.opacity = '1';
                        document.getElementById('ifff5').style.cursor  = 'pointer';
                        document.getElementById('ifff5').removeAttribute('disabled');
                    }
                    if (document.getElementById('ifff6')) {
                        document.getElementById('ifff6').style.opacity = '1';
                        document.getElementById('ifff6').style.cursor  = 'pointer';
                        document.getElementById('ifff6').removeAttribute('disabled');
                    }
                    if (document.getElementById('ifff7')) {
                        document.getElementById('ifff7').style.opacity = '1';
                        document.getElementById('ifff7').style.cursor  = 'pointer';
                        document.getElementById('ifff7').removeAttribute('disabled');
                    }
                    if (document.getElementById('ifff8')) {
                        document.getElementById('ifff8').style.opacity = '1';
                        document.getElementById('ifff8').style.cursor  = 'pointer';
                        document.getElementById('ifff8').removeAttribute('disabled');
                    }
                    if (document.getElementById('ifff9')) {
                        document.getElementById('ifff9').style.opacity = '1';
                        document.getElementById('ifff9').style.cursor  = 'pointer';
                        document.getElementById('ifff9').removeAttribute('disabled');
                    }
                }

            });
        });
    </script>
<?php endif; ?>
</div>

<div style="display:none;">

    <!-- Yandex.Metrika informer -->
    <a href="https://metrika.yandex.ru/stat/?id=27995820&amp;from=informer"
       target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/27995820/3_0_FFFFFFFF_EDEBF5FF_0_pageviews"
                                           style="width:88px; height:31px; border:0;"
                                           alt="ßíäåêñ.Ìåòðèêà"
                                           title="ßíäåêñ.Ìåòðèêà: äàííûå çà ñåãîäíÿ (ïðîñìîòðû, âèçèòû è óíèêàëüíûå ïîñåòèòåëè)"
                                           onclick="try{Ya.Metrika.informer({i:this,id:27995820,lang:'ru'});return false}catch(e){}"/></a>
    <!-- /Yandex.Metrika informer -->

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter27995820 = new Ya.Metrika({
                        id:                  27995820,
                        webvisor:            true,
                        clickmap:            true,
                        trackLinks:          true,
                        accurateTrackBounce: true
                    });
                } catch (e) {
                }
            });

            var n   = d.getElementsByTagName('script')[0],
                s   = d.createElement('script'),
                f   = function() {
                    n.parentNode.insertBefore(s, n);
                };
            s.type  = 'text/javascript';
            s.async = true;
            s.src   = (d.location.protocol == 'https:' ? 'https:' : 'http:') + '//mc.yandex.ru/metrika/watch.js';

            if (w.opera == '[object Opera]') {
                d.addEventListener('DOMContentLoaded', f, false);
            } else {
                f();
            }
        })(document, window, 'yandex_metrika_callbacks');
    </script>
    <noscript>
        <div><img src="//mc.yandex.ru/watch/27995820" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->

    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments);
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src   = g;
            m.parentNode.insertBefore(a, m);
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-61069582-1', 'auto');
        ga('send', 'pageview');

    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter44969914 = new Ya.Metrika({
                        id:                  44969914,
                        clickmap:            true,
                        trackLinks:          true,
                        accurateTrackBounce: true,
                        webvisor:            true
                    });
                } catch (e) {
                }
            });

            var n   = d.getElementsByTagName('script')[0],
                s   = d.createElement('script'),
                f   = function() {
                    n.parentNode.insertBefore(s, n);
                };
            s.type  = 'text/javascript';
            s.async = true;
            s.src   = 'https://mc.yandex.ru/metrika/watch.js';

            if (w.opera == '[object Opera]') {
                d.addEventListener('DOMContentLoaded', f, false);
            } else {
                f();
            }
        })(document, window, 'yandex_metrika_callbacks');
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/44969914" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
</div>

<script type="text/javascript" src="/2/js/jquery.maskedinput.min.js"></script>

<script>
    jQuery('#phone_mask').mask('+7 (999) 999-99-99');
</script>

<div style="display:none;">
    <div itemscope="" itemtype="http://schema.org/Organization">
        <span itemprop="name">KALINZA</span>
        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
            <span itemprop="streetAddress">ул.Красная 176, лит 5/3 </span>
            <span itemprop="addressLocality">Краснодар</span>
        </div>

        <span itemprop="telephone">+7 861 292 16 40</span>,

        <span itemprop="email"> kalinza.krd@gmail.com </span>
    </div>
</div>
</body>
</html>
