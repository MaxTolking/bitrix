<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule('iblock');

class CNews extends CBitrixComponent {
    public string $componentPage = "";

    public function request(){
        if (!empty($_REQUEST["iblock_add"])) {
            $this->componentPage = "template.news.add";
        }
        if (!empty($_REQUEST["category_add"])) {
            $this->componentPage = "template.category.add";
        }

        if (!empty($_REQUEST["iblock_detail"])) {
           // $this->arResult['detailNews'] = CIBlockElement::GetList($_REQUEST['id']){
            $result = CIBlockElement::GetList(
                [],
                ['IBLOCK_ID'=>$this->arParams['ID'],'ID'=> $_REQUEST['id']],
                false,
                false,
                ['NAME', 'PROPERTY_CATEGORY', 'DATE_CREATE', 'ID', 'newsText', 'newsFiles', 'DETAIL_TEXT', 'DETAIL_PICTURE']);
            while ($element = $result->fetch()) {
                $this->arResult['detailNews'] = $element;
            }
            $this->componentPage = "template.news.detailed";
        }

        if (!empty($_REQUEST["iblock_category_update"])) {
            if (isset($_POST['form']) && $_POST['form'] === 'category_update') {
                if (isset($_POST['category_dlt'])) {
                    CIBlockSection::Delete($_POST['category_id']);
                } else if (isset($_POST['category_upd'])) {
                    $this->updateCategory($_POST['category_id'], ['NAME' => $_POST['title']]);
                }
            }
            $this->arResult['category'] = CIBlockSection::GetList(
                [],
                ['ID' => $_GET['category_id']],
                false,
                ['NAME']
            )->fetch();

            $this->componentPage = "template.news.category.upd";
        }
        $this->getCategories();

        if (!empty($_REQUEST["iblock_news_update"])) {
            $this->componentPage = "template.news.upd";
        }

        if (isset($_POST['form']) && $_POST['form'] === 'add_news'){
            $this->addNews();
        }
        if (isset($_POST['form']) && $_POST['form'] === 'news_update'){
            if (isset($_POST['news_upd'])) {
                $date = new \DateTime($_POST['newDate']);
                $this->updateNews($_POST['news_id'], [
                    'NAME' => $_POST['title'],
                    'DETAIL_TEXT' => $_POST['content'],
                    'DETAIL_PICTURE' => $_FILES['newFiles'],
                    'DATE_CREATE' => $date->format('d.m.Y H:i:s')
                ], $_POST['categories']);
            } else if (isset($_POST['news_dlt'])) {
                CIBlockElement::Delete($_POST['news_id']);
            }
        }

    }

    protected function updateNews($id, $fields, $categories)
    {
        (new CIBlockElement)->Update($id, $fields);
        CIBlockElement::SetElementSection($id, $categories);
        return true;
    }

    protected function updateCategory($id, $fields)
    {
        return (new CIBlockSection)->Update($id, $fields);
    }

    protected function addCategory($fields)
    {
        return (new CIBlockSection)->Add($fields);
    }

    protected function getCategories()
    {
        $result = CIBlockSection::GetList(
            [],
            ['IBLOCK_ID' => 1],
            false,
            ['ID', 'NAME']
        );
        while ($section = $result->fetch()) {
            $this->arResult['sections'][] = $section;
        }
    }

    public function getNewsList($ID)
    {
        $result = CIBlockElement::GetList(
            [],
            ['IBLOCK_ID'=>$ID],
            false,
            false,
            ['NAME', 'PROPERTY_CATEGORY', 'DATE_CREATE', 'ID', 'DETAIL_TEXT']);
       // $this->arResult['LIST'] = [];
       // $tasks = [];
        while ($element = $result->fetch()) {
            $categories = CIBlockElement::GetElementGroups($element['ID'], true);
            while ($category = $categories->fetch()) {
                $element['categories'][$category['ID']] = $category;
            }

            $this->arResult['LIST'][$element['ID']] = $element;
        }
    }

    public function addNews(){

        $el = new CIBlockElement;

        $arLoadProductArray = array(
            "IBLOCK_SECTION_ID" => 1,
            "IBLOCK_ID" => 1,
            "NAME" => $_POST['title'],
            "ACTIVE" => "Y",
            "DETAIL_TEXT" => $_POST['content'],
            "DETAIL_PICTURE" => $_POST['file'],
            "DATE_ACTIVE_FROM" => $_POST['date']
        );

        if ($PRODUCT_ID = $el->Add($arLoadProductArray))
            echo "New ID: " . $PRODUCT_ID;
        else
            echo "Error: " . $el->LAST_ERROR;

    }

    public function updNews(){

        $el = new CIBlockElement;

        $arLoadProductArray = array(
        "IBLOCK_SECTION" => false,          // элемент лежит в корне раздела
        "NAME" => $_POST['title'],
        "ACTIVE" => "Y",
        "DETAIL_TEXT" => $_POST['content'],
        "DETAIL_PICTURE" => $_POST['file'],
        "DATE_ACTIVE_FROM" => $_POST['date']
        );

        $PRODUCT_ID = 2;  // изменяем элемент с кодом (ID) 2
        $res = $el->Update($PRODUCT_ID, $arLoadProductArray);
    }

    public function executeComponent()
    {
        $this->request();
        $this->getNewsList($this->arParams['ID']);
        $this->includeComponentTemplate($this->componentPage);
        return $this->arResult['LIST'];
    }




}
//$this->IncludeComponentTemplate();

