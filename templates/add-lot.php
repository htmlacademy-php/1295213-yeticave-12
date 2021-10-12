    <main>
        <nav class="nav">
            <ul class="nav__list container">
                <li class="nav__item">
                    <a href="all-lots.html">Доски и лыжи</a>
                </li>
                <li class="nav__item">
                    <a href="all-lots.html">Крепления</a>
                </li>
                <li class="nav__item">
                    <a href="all-lots.html">Ботинки</a>
                </li>
                <li class="nav__item">
                    <a href="all-lots.html">Одежда</a>
                </li>
                <li class="nav__item">
                    <a href="all-lots.html">Инструменты</a>
                </li>
                <li class="nav__item">
                    <a href="all-lots.html">Разное</a>
                </li>
            </ul>
        </nav>
        <?php $classNameForm = isset($errors) ? " form--invalid" : ""; ?>
        <form class="form form--add-lot container <?=$classNameForm?>" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
            <h2>Добавление лота</h2>
            <div class="form__container-two">
                <?php $className = isset($errors['lot-name']) ? " form__item--invalid" : ""; ?>
                <div class="form__item <?$className;?>"> <!-- form__item--invalid -->
                    <label for="lot-name">Наименование <sup>*</sup></label>
                    <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=getPostVal('lot-name')?>">
                    <span class="form__error">Введите наименование лота</span>
                </div>
                <?php $classNameCategory = isset($errors['category']) ? " form__item--invalid" : ""; ?>
                <div class="form__item <?=$classNameCategory?>">
                    <label for="category">Категория <sup>*</sup></label>
                    <select id="category" name="category">
                        <option>Выберите категорию</option>
                        <option>Доски и лыжи</option>
                        <option>Крепления</option>
                        <option>Ботинки</option>
                        <option>Одежда</option>
                        <option>Инструменты</option>
                        <option>Разное</option>
                    </select>
                    <span class="form__error">Выберите категорию</span>
                </div>
            </div>
            <?php $classNameMessage = isset($errors['message']) ? " form__item--invalid" : ""; ?>
            <div class="form__item form__item--wide <?=$classNameMessage?>">
                <label for="message">Описание <sup>*</sup></label>
                <textarea id="message" name="message" placeholder="Напишите описание лота"><?=getPostVal('message')?></textarea>
                <span class="form__error">Напишите описание лота</span>
            </div>
            <div class="form__item form__item--file">
                <label>Изображение <sup>*</sup></label>
                <div class="form__input-file">
                    <input class="visually-hidden" type="file" id="lot-img" value="" name="foto">
                    <label for="lot-img">
                        Добавить
                    </label>
                </div>
            </div>
            <div class="form__container-three">
                <?php $classNameRate = isset($errors['lot-rate']) ? " form__item--invalid" : ""; ?>
                <div class="form__item form__item--small <?=$classNameRate?>">
                    <label for="lot-rate">Начальная цена <sup>*</sup></label>
                    <input id="lot-rate" type="text" name="lot-rate" placeholder="0" value="<?=getPostVal('lot-rate')?>">
                    <span class="form__error">Введите начальную цену</span>
                </div>
                <?php $classNameStep = isset($errors['lot-step']) ? " form__item--invalid" : ""; ?>
                <div class="form__item form__item--small <?=$classNameStep?>">
                    <label for="lot-step">Шаг ставки <sup>*</sup></label>
                    <input id="lot-step" type="text" name="lot-step" placeholder="0" value="<?=getPostVal('lot-step')?>">
                    <span class="form__error">Введите шаг ставки</span>
                </div>
                <?php $classNameData = isset($errors['lot-date']) ? " form__item--invalid" : ""; ?>
                <div class="form__item <?=$classNameData?>">
                    <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
                    <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
                    <span class="form__error">Введите дату завершения торгов</span>
                </div>
            </div>
            <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
            <button type="submit" class="button">Добавить лот</button>
        </form>
    </main>


