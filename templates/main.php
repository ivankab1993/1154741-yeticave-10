<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <!--заполните этот список из массива категорий-->
        <li class="promo__item promo__item--boards">
            <a class="promo__link" href="pages/all-lots.html">Имя категории</a>
        </li>
        <?php foreach ($arMenu as $item): ?>
            <li class="promo__item promo__item--boards">
                <?php $menuItem = isset($item) ? $item : "";  ?>
                <a class="promo__link" href="pages/all-lots.html"><?=htmlspecialchars($menuItem);?></a>
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
            <li class="lots__item lot">
                <div class="lot__image">
                    <?php $adUrl = isset($arAd["IMAGE_URL"]) ? $arAd["IMAGE_URL"] : "";  ?>
                    <img src="<?=htmlspecialchars($adUrl);?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <?php $adCategory = isset($arAd["CATEGORY"]) ? $arAd["CATEGORY"] : "";  ?>
                    <span class="lot__category"><?=htmlspecialchars($adCategory);?></span>
                    <?php $adName = isset($arAd["NAME"]) ? $arAd["NAME"] : "";  ?>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?=htmlspecialchars($adName);?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <?php $adPrice = isset($arAd["PRICE"]) ? $arAd["PRICE"] : "";?>
                            <span class="lot__cost"><?=price_format(htmlspecialchars($adPrice));?></span>
                        </div>
                            <?php
                                $adExperationDate = isset($arAd["EXPIRATION_DATE"]) ? $arAd["EXPIRATION_DATE"] : "";
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