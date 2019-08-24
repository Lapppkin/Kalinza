<?php require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
$APPLICATION->SetTitle('Купить контактные и цветные линзы в Краснодаре с доставкой. KALINZA.ru - первый в Краснодаре интернет-магазин цветных и контактных линз.');
?>

<?php if ($APPLICATION->GetCurDir() === '/'): ?>
    <div class="main--content">
        <div class="container">
            <div class="row">
                <div class="main--content--wrapper">
                    <?php $APPLICATION->IncludeFile('/include/slider.php'); ?>
                    <?php $APPLICATION->IncludeFile('/include/offers.php'); ?>
                </div>
            </div>
        </div>
    </div>

    <?php $APPLICATION->IncludeFile('/include/about.php'); ?>
    <?php $APPLICATION->IncludeFile('/include/popular_products.php'); ?>
    <?php $APPLICATION->IncludeFile('/include/blog.php'); ?>
<?php endif; ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'; ?>
