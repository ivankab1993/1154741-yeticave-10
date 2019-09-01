<?php
require_once("config/dbconn.php");
// $config - массив с настройками подклчения к БД

$connect = mysqli_connect($config['HOST'], $config['USER'], $config['PASSWORD'], $config['DB_NAME']);

if ($connect == false) {
    print('Ошибка подключения ' . mysqli_connect_error());
} else {
    mysqli_set_charset($connect, 'utf-8');
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

    // Получение лотов из БД
    $adsSQL = "SELECT * FROM lots ORDER BY date_create DESC LIMIT 9";
    $adsResult = mysqli_query($connect, $adsSQL);
    $arAds = [];
    $arAds = mysqli_fetch_all($adsResult, MYSQLI_ASSOC);

    // Получение категорий из БД
    $menuSQL = "SELECT * FROM categories";
    $menuResult = mysqli_query($connect, $menuSQL);
    $arMenu = [];
    $arMenu = mysqli_fetch_all($menuResult, MYSQLI_ASSOC);


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
}
