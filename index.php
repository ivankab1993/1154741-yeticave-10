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

function get_dt_range($expirationDate) {
	$unixNowDate = time();
	$unixExpirationDate = strtotime($expirationDate);

	$unixRemainingTime = $unixExpirationDate - $unixNowDate;

	$arReremainingTime = [];
	$hours = floor($unixRemainingTime / 3600);
	$minutes = floor(($unixRemainingTime / 3600 - $hours) * 60);

	$arReremainingTime = [
		"HOURS" => ($unixNowDate < $unixExpirationDate ? $hours : '00'),
		"MINUTES" => ($unixNowDate < $unixExpirationDate ? $minutes : '00'),
		"TIME_LEFT" => ($hours < 1 ? 'Y' : ''),
	];

	return $arReremainingTime;
}

$arAds = [];
$arAds = [
    [   "NAME" => "2014 Rossignol District Snowboard",
        "CATEGORY" => "Доски и лыжи",
        "PRICE" => "10999",
        "IMAGE_URL" => "img/lot-1.jpg",
        "EXPIRATION_DATE" => "2019-12-08",
    ],
    [   "NAME" => "DC Ply Mens 2016/2017 Snowboard",
        "CATEGORY" => "Доски и лыжи",
        "PRICE" => "159999",
        "IMAGE_URL" => "img/lot-2.jpg",
        "EXPIRATION_DATE" => "2019-11-08",
    ],
    [   "NAME" => "Крепления Union Contact Pro 2015 года размер L/XL",
        "CATEGORY" => "Крепления",
        "PRICE" => "8000",
        "IMAGE_URL" => "img/lot-3.jpg",
        "EXPIRATION_DATE" => "2019-10-08",
    ],
    [   "NAME" => "Ботинки для сноуборда DC Mutiny Charocal",
        "CATEGORY" => "Ботинки",
        "PRICE" => "10999",
        "IMAGE_URL" => "img/lot-4.jpg",
        "EXPIRATION_DATE" => "2019-09-08",
    ],
    [   "NAME" => "Куртка для сноуборда DC Mutiny Charocal",
        "CATEGORY" => "Одежда",
        "PRICE" => "7500",
        "IMAGE_URL" => "img/lot-5.jpg",
        "EXPIRATION_DATE" => "2019-08-25",
    ],
    [   "NAME" => "Маска Oakley Canopy",
        "CATEGORY" => "Разное",
        "PRICE" => "5400",
        "IMAGE_URL" => "img/lot-6.jpg",
        "EXPIRATION_DATE" => "2019-07-31",
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