DROP DATABASE IF EXISTS Pets;
CREATE DATABASE Pets;

DROP TABLE IF EXISTS PetStatus;

CREATE TABLE PetStatus(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS Pet;

CREATE TABLE Pet (
    id INT PRIMARY KEY AUTO_INCREMENT, 
    name VARCHAR(255) NOT NULL, 
    race VARCHAR(255), 
    size VARCHAR(255), 
    status_id INT, 
    description VARCHAR(255), 
    observations VARCHAR(255), 
    archived BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (status_id) REFERENCES PetStatus(id) ON DELETE SET NULL
);

DROP TABLE IF EXISTS Photo;

CREATE TABLE Photo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    file VARCHAR(255) NOT NULL,
    name VARCHAR(255)
);

DROP TABLE IF EXISTS PetPhoto;

CREATE TABLE PetPhoto (
    id INT PRIMARY KEY AUTO_INCREMENT,
    main BOOLEAN NOT NULL,
    photo_id INT NOT NULL,
    pet_id INT NOT NULL,
    FOREIGN KEY (photo_id) REFERENCES Photo(id) ON DELETE CASCADE,
    FOREIGN KEY (pet_id) REFERENCES Pet(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS ProductType;

CREATE TABLE ProductType(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS Product;

CREATE TABLE Product(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    product_type_id INT,
    brand VARCHAR (255),
    observations VARCHAR(255),
    archived BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (product_type_id) REFERENCES ProductType(id) ON DELETE SET NULL
);

DROP TABLE IF EXISTS Inventory;

CREATE TABLE Inventory(
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    status VARCHAR(255),
    observations VARCHAR(255),
    FOREIGN KEY (product_id) REFERENCES Product(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS Donation;

CREATE TABLE Donation(
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    status VARCHAR(255),
    timestamp_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    donor_name VARCHAR(255),
    FOREIGN KEY (product_id) REFERENCES Product(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS users;

CREATE TABLE  `users` (
 `id` INT( 50 ) NOT NULL ,
 `uname` VARCHAR( 40 ) NOT NULL ,
 `upassword` VARCHAR( 40 ) NOT NULL
) ENGINE = INNODB DEFAULT CHARSET = latin1;