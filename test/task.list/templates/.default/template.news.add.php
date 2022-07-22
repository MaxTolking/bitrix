<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>

<form method="post" action="">
    <h3>Добавить новость</h3>
        <label for="newsTitle">Заголовок </label>
            <input type="text" id="newsTitle" name="title" value="" placeholder="Введите заголовок..."><p>

        <label for="newsText">Описание </label>
            <textarea id="newsText" rows="15" cols="60"  name="content" placeholder="Введите текст новости..."></textarea><p>

        <label for="newsFiles">Изображение</label>
            <input type="file" name="file"><p>

        <label for="newsDate">Дата публикации</label>
            <input id="newsDate" name="date" type="date"><p>

        <label for="newsCategory">Категория</label>
            <input type="text" id="newsCategory" name="category" value="" placeholder="Введите категорию..."><p>

            <input type="submit" value="Добавить" name="news_add">

    <input type="hidden" name="form" value="add_news">
</form>