<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <!--заполните этот список из массива категорий-->
        <?php foreach ($arMenu as $item): ?>
            <?php
                $menuItemId = isset($item["id"]) ? $item["id"] : "";
                $menuItemCode = isset($item["code"]) ? $item["code"] : "";
                $menuItemName = isset($item["name"]) ? $item["name"] : "";
            ?>
            <li class="promo__item promo__item--<?=$menuItemCode;?>">
                <a class="promo__link" href="pages/all-lots.html"><?=htmlspecialchars($menuItemName);?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <!--заполните этот список из массива с товарами-->
        <?php foreach ($arAds as $arAd): ?>
            <?php 
                $adName = isset($arAd["name"]) ? $arAd["name"] : "";
                $adCategory = isset($arAd["category"]) ? $arAd["category"] : "";
                $adUrl = isset($arAd["image"]) ? $arAd["image"] : "";
                $adPrice = isset($arAd["start_price"]) ? $arAd["start_price"] : "";
                $adExperationDate = isset($arAd["date_close"]) ? $arAd["date_close"] : "";
            ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=htmlspecialchars($adUrl);?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=htmlspecialchars($adCategory);?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?=htmlspecialchars($adName);?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=price_format(htmlspecialchars($adPrice));?></span>
                        </div>
                            <?php
                                $arExperationDate = get_dt_range(htmlspecialchars($adExperationDate));
                            ?>
                        <div class="lot__timer timer<?=(!empty($arExperationDate["TIME_LEFT"]) ? ' timer--finishing' : '');?>">
                            <?=$arExperationDate["HOURS"].':'.$arExperationDate["MINUTES"];?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
</section>