USE yeticave;

/* Добавление данных о пользователях таблицу users */
INSERT INTO users (email, name, password) VALUES 
	("test@test.ru", "Test", "password"),
	("test2@test.ru", "Test 2", "password");

/* Добавление данных о категориях в таблицу categories */
INSERT INTO categories (name, code) VALUES 
	("Доски и лыжи", "boards"),
	("Крепления", "attachment"),
	("Ботинки", "boots"),
	("Одежда", "clothing"),
	("Инструменты", "tools"),
	("Разное", "other");

/* Добавление данных о лотах в таблицу lots */
INSERT INTO lots (author_id, name, category_id, winner_id, start_price, image, date_close) VALUES 
	("1", "2014 Rossignol District Snowboard", "1", "1", "10999", "img/lot-1.jpg", "2019-12-08"),
	("1", "DC Ply Mens 2016/2017 Snowboard", "1", "1", "159999", "img/lot-2.jpg", "2019-11-08"),
	("1", "2 Union Contact Pro 2015 года размер L/XL", "2", "1", "8000", "img/lot-3.jpg", "2019-10-08"),
	("1", "Ботинки для сноуборда DC Mutiny Charocal", "3", "1", "10999", "img/lot-4.jpg", "2019-09-08"),
	("1", "Куртка для сноуборда DC Mutiny Charocal", "4", "1", "7500", "img/lot-5.jpg", "2019-08-25"),
	("1", "Маска Oakley Canopy", "5", "1", "5400", "img/lot-6.jpg", "2019-07-25");

/* Добавление данных о ставках в таблицу bets */
INSERT INTO bet (price, date_close, user_id, lot_id) VALUES 
	("180", "2019-09-25", "2", "3"),
	("470", "2019-09-18", "2", "6"),
	("630", "2019-10-01", "1", "3");

/* получить все категории */
SELECT name FROM categories;

/*
Получить самые новые, открытые лоты.
Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории
*/
SELECT l.name, l.start_price, l.image, b.price, с.name
FROM lots l
LEFT JOIN categories с ON l.category_id = с.id
LEFT JOIN bet b ON l.id = b.lot_id
WHERE l.date_close > NOW()
ORDER BY l.date_create DESC;


/* Показать лот по его id. Получите также название категории, к которой принадлежит лот */
SELECT l.name, l.image, c.name
FROM lots l
JOIN categories c ON l.category_id = c.id
WHERE l.id = 1;

/* Обновить название лота по его идентификатору */
UPDATE lots 
SET name = 'DC Ply Mens 2016/2017 Snowboard NEW' 
WHERE id = 2;

/* получить список ставок для лота по его идентификатору с сортировкой по дате */
SELECT price FROM bet
WHERE lot_id = 3
ORDER BY date_close DESC;