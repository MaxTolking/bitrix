<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>

<form method="post">
    <h3>Редактировать категорию</h3>
    <label for="categoryTitle">Название категории: </label>
    <input type="text" id="categoryTitle" name="title" value="<?= $arResult['category']['NAME'] ?>" placeholder="Введите категорию..."><p>
    <input type="submit" value="Обновить" name="category_upd">
    <input type="submit" value="Удалить" name="category_dlt">
    <input type="hidden" name="form" value="category_update">
    <input type="hidden" name="category_id" value="<?= $_GET['category_id'] ?>">
</form>
