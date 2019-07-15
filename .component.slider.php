<?php

declare(strict_types=1);

$id_block   = 11;
$section_id = 0;
$items      = GetIBlockElementList($id_block, $section_id, ['SORT' => 'ASC'], 3);
$items->NavPrint('пользователи');

$slides = [];

while ($item = $items->GetNext()) {
    $image = CFile::GetPath($item['PREVIEW_PICTURE']);

    if (empty($image)) {
        continue;
    }

    $slides[] = [
        'IMAGE' => $image,
        'URL'   => $item['DETAIL_TEXT'] ? : '#',
    ];
}
?>

<aside id="colorlib-hero">
    <ul class="slides">
        <?php foreach ($slides as $slide): ?>
            <li style="background-image: url(<?= $slide['IMAGE']; ?>);">
                <a class="btn btn-primary" href="<?= $slide['URL']; ?>">Купить сейчас</a>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>
