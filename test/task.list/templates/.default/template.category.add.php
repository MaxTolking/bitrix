<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<form method="post">
    <h3>Добавить категорию</h3>
    <label for="categoryTitle">Название категории: </label>
    <input type="text" name="title" value="" placeholder="Введите название категории...">
    <br>
    <br>
    <input type="submit" value="Добавить">
    <input type="hidden" name="form" value="category_add">
</form>