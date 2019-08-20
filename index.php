<?php
require_once("helpers.php");

$is_auth = rand(0, 1);
$user_name = 'Иван'; // укажите здесь ваше имя

function price_format(int $price) {
    $ceilPrice = ceil($price);
    $numberFormatPrice = number_format($ceilPrice, 0, ' ', ' ');
    $finalPriceFormat = $numberFormatPrice.'<b class="rub">р</b>'; 
    return $finalPriceFormat;
}

$arAds = [];
$arAds = [
    [   "NAME" => "2014 Rossignol District Snowboard",
        "CATEGORY" => "Доски и лыжи",
        "PRICE" => "10999",
        "IMAGE_URL" => "img/lot-1.jpg",
    ],
    [   "NAME" => "DC Ply Mens 2016/2017 Snowboard",
        "CATEGORY" => "Доски и лыжи",
        "PRICE" => "159999",
        "IMAGE_URL" => "img/lot-2.jpg",
    ],
    [   "NAME" => "Крепления Union Contact Pro 2015 года размер L/XL",
        "CATEGORY" => "Крепления",
        "PRICE" => "8000",
        "IMAGE_URL" => "img/lot-3.jpg",
    ],
    [   "NAME" => "Ботинки для сноуборда DC Mutiny Charocal",
        "CATEGORY" => "Ботинки",
        "PRICE" => "10999",
        "IMAGE_URL" => "img/lot-4.jpg",
    ],
    [   "NAME" => "Куртка для сноуборда DC Mutiny Charocal",
        "CATEGORY" => "Одежда",
        "PRICE" => "7500",
        "IMAGE_URL" => "img/lot-5.jpg",
    ],
    [   "NAME" => "Маска Oakley Canopy",
        "CATEGORY" => "Разное",
        "PRICE" => "5400",
        "IMAGE_URL" => "img/lot-6.jpg",
    ],
];

$arMenu = [];
$arMenu = [
    "Доски и лыжи",
    "Крепления",
    "Ботинки",
    "Одежда",
    "Инструменты",
    "Разное",
];

$page_content = include_template('main.php', [
	"arMenu" => $arMenu,
	"arAds" => $arAds,
]);

$layout_content = include_template('layout.php', [
	"title" => "Главная",
	"is_auth" => $is_auth,
	"user_name" => $user_name,
	"content" => $page_content,
	"arMenu" => $arMenu,
]);
print($layout_content);