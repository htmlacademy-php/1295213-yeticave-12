INSERT INTO site_user
SET data_reg = NOW(), email = 'email@mail.ru', name_user = 'Alex', password = '33453', contacts = '00032432';
INSERT INTO site_user
SET data_reg = NOW(), email = 'email1@mail.ru', name_user = 'Mike', password = '33r4453', contacts = '00032445432';
INSERT INTO site_user
SET data_reg = NOW(), email = 'email22@mail.ru', name_user = 'Anna', password = '33vv453', contacts = '3300032432';

INSERT INTO category
SET name_category = 'Доски и лыжи', s_code = 'boards';
INSERT INTO category
SET name_category = 'Крепления', s_code = 'attachment';
INSERT INTO category
SET name_category = 'Ботинки', s_code = 'boots';
INSERT INTO category
SET name_category = 'Одежда', s_code = 'clothing';
INSERT INTO category
SET name_category = 'Инструменты', s_code = 'tools';
INSERT INTO category
SET name_category = 'Разное', s_code = 'other';

INSERT INTO lot
SET add_time = NOW(), name_lot = '2014 Rossignol District Snowboard', description = 'description',
 img = 'img/lot-1.jpg', start_price = '10999', data_finish = '2021-04-25', step_rate = '100',
 author_id = '1', category_id = '1';
INSERT INTO lot
SET add_time = NOW(), name_lot = 'DC Ply Mens 2016/2017 Snowboard', description = 'description',
 img = 'img/lot-2.jpg', start_price = '159999', data_finish = '2021-04-26', step_rate = '100',
author_id = '2', category_id = '1';
INSERT INTO lot
SET add_time = NOW(), name_lot = 'Крепления Union Contact Pro 2015 года размер L/XL', description = 'description',
 img = 'img/lot-3.jpg', start_price = '8000', data_finish = '2021-04-27', step_rate = '100',
author_id = '3', category_id = '2';
INSERT INTO lot
SET add_time = NOW(), name_lot = 'Ботинки для сноуборда DC Mutiny Charocal', description = 'description',
 img = 'img/lot-4.jpg', start_price = '10999', data_finish = '2021-04-28', step_rate = '100',
author_id = '1', category_id = '3';
INSERT INTO lot
SET add_time = NOW(), name_lot = 'Куртка для сноуборда DC Mutiny Charocal', description = 'description',
 img = 'img/lot-5.jpg', start_price = '7500', data_finish = '2021-04-29', step_rate = '100',
author_id = '2', category_id = '4';
INSERT INTO lot
SET add_time = NOW(), name_lot = 'Маска Oakley Canopy', description = 'description',
 img = 'img/lot-6.jpg', start_price = '5400', data_finish = '2021-04-30', step_rate = '100',
author_id = '3', category_id = '6';

INSERT INTO rate
SET add_time = NOW(), price = '12000', user_id = '2', lot_id = '1';
INSERT INTO rate
SET add_time = NOW(), price = '17000', user_id = '1', lot_id = '2';
INSERT INTO rate
SET add_time = NOW(), price = '9000', user_id = '1', lot_id = '3';

INSERT INTO rate
SET add_time = NOW(), price = '12000', user_id = '2', lot_id = '1';
INSERT INTO rate
SET add_time = NOW(), price = '17000', user_id = '1', lot_id = '2';
INSERT INTO rate
SET add_time = NOW(), price = '9000', user_id = '3', lot_id = '3';


// получить все категории
SELECT name_category FROM category;

// получить самые новые, открытые лоты
SELECT l.name_lot, l.start_price, l.img, c.name_category
FROM lot l INNER JOIN category c
ON l.id = c.id ORDER BY add_time ASC;

// показать лот по его id
SELECT l.name_lot, c.name_category
FROM lot l INNER JOIN category c
ON l.id = c.id WHERE l.id = 8;

// обновить название лота по его идентификатору;
UPDATE lot SET name_lot = 'DC Mutiny Charocal' WHERE id = 8;

//получить список ставок для лота по его идентификатору с сортировкой по дате
SELECT id FROM rate WHERE lot_id = 3 ORDER BY add_time ASC;
