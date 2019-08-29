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
  	start_price DECIMAL(10,2) DEFAULT 0,
  	date_close DATETIME NOT NULL,
  	step DECIMAL(10,2) NOT NULL DEFAULT 0
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


CREATE TABLE bet (
	id INT AUTO_INCREMENT PRIMARY KEY,
  	price DECIMAL(10,2) DEFAULT 0,
  	date_close DATETIME NOT NULL
);

CREATE TABLE users_lots_categories (
	lot_id INT NOT NULL,
	author_id INT NOT NULL,
  	category_id INT NOT NULL,
	PRIMARY KEY (lot_id, author_id, category_id),
	INDEX lot_id (lot_id),
    INDEX author_id (author_id),
    INDEX category_id (category_id),
    CONSTRAINT fk_lots FOREIGN KEY (lot_id) 
        REFERENCES lots (id) ON DELETE CASCADE,
    CONSTRAINT fk_author FOREIGN KEY (author_id) 
        REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT fk_categories FOREIGN KEY (category_id) 
        REFERENCES categories (id) ON DELETE CASCADE
);

CREATE TABLE bet_users_lots (
  	user_id INT NOT NULL,
  	lot_id INT NOT NULL,
  	PRIMARY KEY (user_id, lot_id),
	INDEX user_id (user_id),
    INDEX lot_id (lot_id),
    CONSTRAINT fk_users FOREIGN KEY (user_id) 
        REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT fk_betlots FOREIGN KEY (lot_id) 
        REFERENCES lots (id) ON DELETE CASCADE
);

CREATE INDEX category_name ON categories(name);
CREATE INDEX lot_name ON lots(name);
CREATE INDEX user_name ON users(name);