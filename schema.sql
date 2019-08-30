CREATE DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE categories (
	id INT AUTO_INCREMENT PRIMARY KEY,
  	name CHAR(255) NOT NULL UNIQUE,
  	code CHAR(255) NOT NULL UNIQUE
);

CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
  	date_create DATETIME DEFAULT NOW(),
  	email VARCHAR(255) UNIQUE,
  	name VARCHAR(255) NOT NULL,
  	password VARCHAR(60) NOT NULL,
  	contacts TEXT
);


CREATE TABLE lots (
	id INT AUTO_INCREMENT PRIMARY KEY,
  	date_create DATETIME DEFAULT NOW(),
  	name VARCHAR(255) NOT NULL,
  	description TEXT,
 	image VARCHAR(255),
  	start_price DECIMAL(10,2) DEFAULT 0,
  	date_close DATETIME NOT NULL,
  	step DECIMAL(10,2) NOT NULL DEFAULT 0,
  	author_id INT NOT NULL,
  	winner_id INT NOT NULL,
  	category_id INT NOT NULL,
    FOREIGN KEY (author_id)  REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (winner_id)  REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (category_id)  REFERENCES categories (id) ON DELETE CASCADE
);

CREATE TABLE bet (
	id INT AUTO_INCREMENT PRIMARY KEY,
  	price DECIMAL(10,2),
  	date_close DATETIME NOT NULL,
  	user_id INT NOT NULL,
  	lot_id INT NOT NULL,
    FOREIGN KEY (user_id)  REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (lot_id)  REFERENCES lots (id) ON DELETE CASCADE
);


CREATE INDEX category_name ON categories(name);
CREATE INDEX lot_name ON lots(name);
CREATE INDEX user_name ON users(name);
CREATE INDEX user_email ON users(email);
