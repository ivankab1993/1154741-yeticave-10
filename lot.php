<?php
require_once("config/dbconn.php");
// $connect - переменная для подключения к БД

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

    if (isset($_GET['id'])) {
        $adId = intval($_GET['id']); 

        $adSQL = "SELECT 
            l.id, l.date_create, l.name, l.description, l.image, l.start_price, l.date_close, l.step, l.category_id,
            с.name AS category_name,
            b.price, b.id AS bet_id
            FROM lots l
            LEFT JOIN categories с ON l.category_id = с.id
            LEFT JOIN bet b ON l.id = b.lot_id
            WHERE l.id = '$adId'
            ORDER BY bet_id DESC
            LIMIT 1";

        $adResult = mysqli_query($connect, $adSQL);
        $arAd = [];
        $arAd = mysqli_fetch_all($adResult, MYSQLI_ASSOC);

        if (!empty($arAd)) {
            $page_content = include_template('lot.php', [
                "arMenu" => $arMenu,
                "arAd" => $arAd,
            ]);
        } else {
            http_response_code(404);
            $page_content = include_template('404.php', [
                "message_404" => "Статус 404. Запрашиваемая страница не найдена",
            ]);
        }

    }

    $layout_content = include_template('layout.php', [
    	"title" => "Главная",
    	"is_auth" => $is_auth,
    	"user_name" => $user_name,
    	"content" => $page_content,
    	"arMenu" => $arMenu,
        "noContainer" => 'Y',
    ]);
    print($layout_content);
}