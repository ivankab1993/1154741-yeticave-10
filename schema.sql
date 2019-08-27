CREATE DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE categories (
	id INT AUTO_INCREMENT PRIMARY KEY,
  	name CHAR(255) NOT NULL UNIQUE,
  	code CHAR(255) NOT NULL UNIQUE
);

CREATE TABLE lots (
	id INT AUTO_INCREMENT PRIMARY KEY,
  	date_create DATETIME DEFAULT NOW(),
  	name CHAR(255) NOT NULL,
  	description TEXT,
 	image CHAR(255),
  	start_price DECIMAL DEFAULT 0,
  	date_close DATETIME NOT NULL,
  	step DECIMAL NOT NULL,
  	author_id INT NOT NULL,
  	winner_id INT NOT NULL,
  	category_id INT NOT NULL
);

CREATE TABLE bet (
	id INT AUTO_INCREMENT PRIMARY KEY,
  	price DECIMAL,
  	date_close DATETIME NOT NULL,
  	step DECIMAL NOT NULL,
  	user_id INT NOT NULL,
  	lot_id INT NOT NULL
);

CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
  	date_create DATETIME DEFAULT NOW(),
  	email CHAR(255) UNIQUE,
  	name CHAR(255) NOT NULL,
  	password CHAR(20) NOT NULL,
  	contacts TEXT,
  	created_lots TEXT,
  	betting TEXT
);

CREATE INDEX category_name ON categories(name);
CREATE INDEX lot_name ON lots(name);
CREATE INDEX lot_cat_id ON lots(category_id);
CREATE INDEX lot_author_id ON lots(author_id);
CREATE INDEX bet_lot_id ON bet(lot_id);
CREATE INDEX bet_user_id ON bet(user_id);
CREATE INDEX user_name ON users(name);