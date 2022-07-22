<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

echo '<pre>';
//var_dump($arResult);
echo '</pre>';
?>

<table>
    <p><a href="?iblock_add=Y">Добавить новость</a><p>
    <p><a href="?category_add=Y">Добавить категорию</a><p>

    <tr>
        <td>Название</td>
        <td>Категория</td>
        <td>Дата публикации</td>
    </tr>


    <? foreach ($arResult['LIST'] as $key => $task): ?>
    <? $date = new \DateTime($task['DATE_CREATE']); ?>
            <tr>
                <td><a href="?iblock_detail=Y&id=<?= $task['ID'] ?>"><?=$task['NAME']?></a></td>
                <td>
                    <? foreach ($task['categories'] as $category): ?>
                        <a href="?iblock_category_update=Y&category_id=<?= $category['ID'] ?>"><?= $category['NAME'] ?></a>
                    <? endforeach; ?>
                </td>
                <td><?= $date->format('d.m.Y') ?></td>
            </tr>

    <? endforeach; ?>

</table>

