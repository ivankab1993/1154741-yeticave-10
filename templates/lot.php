<nav class="nav">
	<ul class="nav__list container">
		<?php foreach ($arMenu as $item): ?>
			<?php
				$menuItemId = isset($item["id"]) ? $item["id"] : "";
				$menuItemCode = isset($item["code"]) ? $item["code"] : "";
				$menuItemName = isset($item["name"]) ? $item["name"] : "";
			?>
			<li class="nav__item nav__item--<?=$menuItemCode;?>">
				<a class="nav__link" href="/pages/all-lots.html"><?=htmlspecialchars($menuItemName);?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
<?php 
	if (is_array($arAd)) {
		$adId = isset(current($arAd)["id"]) ? current($arAd)["id"] : "";
		$adName = isset(current($arAd)["name"]) ? current($arAd)["name"] : "";
		$adCategory = isset(current($arAd)["category_name"]) ? current($arAd)["category_name"] : "";
		$adImage = isset(current($arAd)["image"]) ? current($arAd)["image"] : "";
		$adPrice = isset(current($arAd)["price"]) ? current($arAd)["price"] : "";
		$adStep = isset(current($arAd)["step"]) ? current($arAd)["step"] : "";
		$adExperationDate = isset(current($arAd)["date_close"]) ? current($arAd)["date_close"] : "";
		$adDescription = isset(current($arAd)["description"]) ? current($arAd)["description"] : "";
	}
?>

<section class="lot-item container">
	<h2><?=htmlspecialchars($adName);?></h2>
	<div class="lot-item__content">
		<div class="lot-item__left">
			<div class="lot-item__image">
				<img src="/<?=htmlspecialchars($adImage);?>" width="730" height="548" alt="Сноуборд">
			</div>
			<p class="lot-item__category">Категория: <span><?=$adCategory;?></span></p>
			<p class="lot-item__description"><?=$adDescription;?></p>
		</div>
		<div class="lot-item__right">
			<div class="lot-item__state">
				<div class="lot-item__timer timer<?=(!empty($arExperationDate["TIME_LEFT"]) ? ' timer--finishing' : '');?>">
					<?php
						$arExperationDate = get_dt_range(htmlspecialchars($adExperationDate));
					?>
					<?=$arExperationDate["HOURS"].':'.$arExperationDate["MINUTES"];?>
				</div>
				<div class="lot-item__cost-state">
					<div class="lot-item__rate">
						<span class="lot-item__amount">Текущая цена</span>
						<span class="lot-item__cost"><?=price_format(htmlspecialchars($adPrice));?></span>
					</div>
					<div class="lot-item__min-cost">
						Мин. ставка <span><?=price_format(htmlspecialchars($adStep));?></span>
					</div>
				</div>
				<form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
					<p class="lot-item__form-item form__item form__item--invalid">
						<label for="cost">Ваша ставка</label>
						<input id="cost" type="text" name="cost" placeholder="12 000">
						<span class="form__error">Введите наименование лота</span>
					</p>
					<button type="submit" class="button">Сделать ставку</button>
				</form>
			</div>
			<div class="history" style="display: none;">
				<h3>История ставок (<span>10</span>)</h3>
				<table class="history__list">
					<tr class="history__item">
						<td class="history__name">Иван</td>
						<td class="history__price">10 999 р</td>
						<td class="history__time">5 минут назад</td>
					</tr>
					<tr class="history__item">
						<td class="history__name">Константин</td>
						<td class="history__price">10 999 р</td>
						<td class="history__time">20 минут назад</td>
					</tr>
					<tr class="history__item">
						<td class="history__name">Евгений</td>
						<td class="history__price">10 999 р</td>
						<td class="history__time">Час назад</td>
					</tr>
					<tr class="history__item">
						<td class="history__name">Игорь</td>
						<td class="history__price">10 999 р</td>
						<td class="history__time">19.03.17 в 08:21</td>
					</tr>
					<tr class="history__item">
						<td class="history__name">Енакентий</td>
						<td class="history__price">10 999 р</td>
						<td class="history__time">19.03.17 в 13:20</td>
					</tr>
					<tr class="history__item">
						<td class="history__name">Семён</td>
						<td class="history__price">10 999 р</td>
						<td class="history__time">19.03.17 в 12:20</td>
					</tr>
					<tr class="history__item">
						<td class="history__name">Илья</td>
						<td class="history__price">10 999 р</td>
						<td class="history__time">19.03.17 в 10:20</td>
					</tr>
					<tr class="history__item">
						<td class="history__name">Енакентий</td>
						<td class="history__price">10 999 р</td>
						<td class="history__time">19.03.17 в 13:20</td>
					</tr>
					<tr class="history__item">
						<td class="history__name">Семён</td>
						<td class="history__price">10 999 р</td>
						<td class="history__time">19.03.17 в 12:20</td>
					</tr>
					<tr class="history__item">
						<td class="history__name">Илья</td>
						<td class="history__price">10 999 р</td>
						<td class="history__time">19.03.17 в 10:20</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>