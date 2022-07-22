<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$date = new \DateTime($arResult['LIST'][$_GET['news_id']]['DATE_CREATE']);
?>


<form method="post" enctype='multipart/form-data'>
    <h3>Редактировать новость</h3>
    <label for="newTitle">Заголовок </label>
    <input type="text" id="newTitle" name="title" value="<?= $arResult['LIST'][$_GET['news_id']]['NAME'] ?>" placeholder="Введите заголовок..."><p>

        <label for="newText">Описание: </label><p>
        <textarea id="newText" rows="15" cols="60"  name="content" placeholder="Введите текст новости..."><?= $arResult['LIST'][$_GET['news_id']]['DETAIL_TEXT'] ?></textarea><p>

        <label for="newFiles">Изображение</label>
        <input type="file" name="newFiles"><p>

        <label for="newDate">Дата публикации</label>
        <input id="newDate" type="date" name="newDate" value="<?= $date->format('Y-m-d') ?>"><p>

        <label for="newCategory">Категория</label>
        <? foreach ($arResult['sections'] as $section): ?>
            <p><input type="checkbox" name="categories[]" value="<?= $section['ID'] ?>" <?= $arResult['LIST'][$_GET['news_id']]['categories'][$section['ID']] ? 'checked' : '' ?>> <?= $section['NAME'] ?></p>
        <? endforeach; ?>
    <p>

        <input type="submit" value="Обновить" name="news_upd">
        <input type="submit" value="Удалить" name="news_dlt">
        <input type="hidden" value="news_update" name="form">
        <input type="hidden" value="<?= $_GET['news_id'] ?>" name="news_id">
</form>

