<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<form>
    <label for="newsTitle"><h2><?= $arResult['detailNews']['NAME'] ?></h2></label><p>
        <label for="newsText"><?= $arResult['detailNews']['DETAIL_TEXT'] ?></label><p>
        <? if ($arResult['detailNews']['DETAIL_PICTURE']): ?>
            <label for="newsFiles">
                <img src="<?= CFile::GetPath($arResult['detailNews']['DETAIL_PICTURE']) ?>" alt="Изображение">
            </label><p>
        <? endif; ?>
        <label for="newsDate">Дата публикации <?= $arResult['detailNews']['DATE_CREATE'] ?></label><p>
        <label for="newsCategory">Категория
            <ul>
            <? foreach ($arResult['LIST'][$_GET['id']]['categories'] as $item): ?>
                <li><?= $item['NAME'] ?></li>
            <? endforeach; ?>
            </ul>
        </label><p>
        <a href = "?iblock_news_update=Y&news_id=<?= $arResult['detailNews']['ID'] ?>">Редактировать</a>
</form>
