<?php

use Deadie\Helper;

?>
<div class="footer--menu">
    <div class="container">
        <div class="row">
            <div class="footer--menu--wrapper col-12">

                <div class="footer--menu--items">
                    <div class="footer--menu--title">О компании</div>
                    <ul>
                    <?php $APPLICATION->IncludeComponent('bitrix:menu',
                        'bottom_menu',
                        array(
                            'ROOT_MENU_TYPE'        => 'bottom_company',
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
                        ),
                        false); ?>
                    </ul>
                </div>

                <div class="footer--menu--items">
                    <div class="footer--menu--title">Информации</div>
                    <ul>
                    <?php $APPLICATION->IncludeComponent('bitrix:menu',
                        'bottom_menu',
                        array(
                            'ROOT_MENU_TYPE'        => 'bottom_info',
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
                        ),
                        false); ?>
                    </ul>
                </div>

                <div class="footer--menu--items">
                    <div class="footer--menu--title">Наши салоны оптики</div>
                    <ul>
                        <?php $APPLICATION->IncludeComponent('bitrix:menu',
                            'bottom_menu',
                            array(
                                'ROOT_MENU_TYPE'        => 'bottom_shops',
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
                            ),
                            false); ?>
                    </ul>
                </div>

                <div class="footer--menu--items">
                    <div class="footer--menu--title">Бренды</div>
                    <ul>
                        <?php $APPLICATION->IncludeComponent('bitrix:menu',
                            'bottom_menu',
                            array(
                                'ROOT_MENU_TYPE'        => 'bottom_brands',
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
                            ),
                            false); ?>
                    </ul>
                </div>

                <div class="footer--menu--items">
                    <div class="footer--menu--title">Линзы по сроку ношения</div>
                    <ul>
                        <?php $APPLICATION->IncludeComponent('bitrix:menu',
                            'bottom_menu',
                            array(
                                'ROOT_MENU_TYPE'        => 'bottom_lens',
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
                            ),
                            false); ?>
                    </ul>
                </div>

                <div class="footer--menu--items">
                    <div class="footer--menu--title">Хиты продаж</div>
                    <ul>
                        <?php $APPLICATION->IncludeComponent('bitrix:menu',
                            'bottom_menu',
                            array(
                                'ROOT_MENU_TYPE'        => 'bottom_hits',
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
                            ),
                            false); ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
