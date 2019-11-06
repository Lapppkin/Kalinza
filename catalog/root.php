<?

$rsSection = CIBlockSection::GetList(
    array(),
    array(
        'ACTIVE'      => 'Y',
        'IBLOCK_ID'   => CATALOG_DEFAULT_IBLOCK_ID,
        'DEPTH_LEVEL' => 1,
    )
);
$arResult = array();
while ($arSection = $rsSection->Fetch()) {

    $rsSection2 = CIBlockSection::GetList(
        array(),
        array(
            'ACTIVE'      => 'Y',
            'IBLOCK_ID'   => CATALOG_DEFAULT_IBLOCK_ID,
            'DEPTH_LEVEL' => 2,
            'SECTION_ID'  => $arSection['ID'],
        )
    );

    $arItems = array();
    while ($arSection2 = $rsSection2->Fetch()) {
        $arItems[] = array(
            'ID'          => $arSection2['ID'],
            'NAME'        => $arSection2['NAME'],
            'CODE'        => $arSection2['CODE'],
            'SHORTNAME'   => $arSection2['DESCRIPTION'],
            'IBLOCK_CODE' => $arSection2['IBLOCK_CODE'],
        );
    }

    $arResult[] = array(
        'ID'             => $arSection['ID'],
        'NAME'           => $arSection['NAME'],
        'CODE'           => $arSection['CODE'],
        'SHORTNAME'      => $arSection['DESCRIPTION'],
        'IBLOCK_CODE'    => $arSection['IBLOCK_CODE'],
        'IBLOCK_TYPE_ID' => $arSection['IBLOCK_TYPE_ID'],
        'URL'            => '/' . implode('/', array($arSection2['IBLOCK_TYPE_ID'], $arSection2['IBLOCK_CODE'], $arSection2['CODE'])),
        'ITEMS'          => $arItems,
    );
}
?>

<!--категории каталога-->
<div class="catalog-root col-12">
    <div class="catalog-root--wrapper">

        <? foreach ($arResult as $item): ?>
            <ul class="col-lg-4 col-md-6 col-sm-12 catalog-root--section">
                <h2 class="catalog-root--title">
                    <a href="<?= $item['CODE'] ?>"><?= $item['NAME'] ?></a>
                </h2>

                <? foreach ($item['ITEMS'] as $subItem): ?>
                    <li <?= ($APPLICATION->GetCurPage() === '/' . implode('/', array($item['IBLOCK_TYPE_ID'], $item['CODE']))) ? ' class="active"' : '' ?>>
                        <a href="/<?= implode('/', array($item['IBLOCK_TYPE_ID'], $subItem['CODE'])) ?>/">
                        <?/*<a href="/<?= implode('/', array($item['IBLOCK_TYPE_ID'], $item['CODE'], $subItem['CODE'])) ?>/">*/?>
                            <?= $subItem['NAME'] ?>
                        </a>
                    </li>
                <? endforeach; ?>

            </ul>
        <? endforeach; ?>

    </div>

</div>
