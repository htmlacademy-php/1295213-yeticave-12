<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?php foreach ($rows as $row): ?>
                <li class="promo__item promo__item--boards <?=$row['s_code']?>">
                    <a class="promo__link" href="pages/all-lots.html"><?=htmlspecialchars($row['name_category'])?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <?php foreach ($lots as $key => $item): ?>
                <li class="lots__item lot">
                    <a href="lot.php?id=<?=$item['id']?>">
                        <div class="lot__image">
                            <img src="<?= htmlspecialchars($item['img']); ?>" width="350" height="260"
                                 alt="<?= htmlspecialchars($item['name_lot']); ?>">
                        </div>
                    </a>
                    <div class="lot__info">
                        <span class="lot__category"><?=htmlspecialchars($item['name_category']); ?></span>
                        <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$item['id']?>"><?=htmlspecialchars($item['name_lot']); ?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?= format_price($item['start_price']) ?></span>
                            </div>
                            <div class="lot__timer timer<?php if(reset(get_time($item['data_finish'])) < 1): ?> timer--finishing<?php endif;?> ">
                                <?= implode(":", get_time($item['data_finish'])) ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
