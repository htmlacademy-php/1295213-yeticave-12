<main>
<nav class="nav">
      <ul class="nav__list container">
          <?php foreach($categories_arr as $category): ?>
        <li class="nav__item">
          <a href="all-lots.html"><?=xss_protection($category['name'])?></a>
        </li>
        <?php endforeach; ?>
      </ul>
    </nav>
<section class="lot-item container">
    <h2><?=$item_name?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?=$img_path?>" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span><?=xss_protection($category_name)?></span></p>
            <p class="lot-item__description"><?=$description?></p>
        </div>
        <div class="lot-item__right">
            <?php if($user_name != ''): ?>
            <div class="lot-item__state">
                <?php $time_arr=get_dt_range($completion_date);
                $red_flag = $time_arr[0] == '00'?'timer--finishing':'';
                ?>
                <div class="lot-item__timer timer <?=$red_flag?> ">
                    <?php print($time_arr[0].':'.$time_arr[1])?>
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?=price_format($current_price)?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?=price_format($min_bid)?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
</main>
