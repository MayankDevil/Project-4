-- ///* smriti database *///

CREATE DATABASE IF NOT EXISTS smriti_db;

USE smriti_db;

-- USER TABLE
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name varchar(30) NOT NULL,
    last_name varchar(30) DEFAULT NULL,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(70) NOT NULL UNIQUE,
    contact_number VARCHAR(20) DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    role TINYINT(1) NOT NULL DEFAULT 0,      -- 0 = user, 1 = admin
    isActive TINYINT(1) NOT NULL DEFAULT 1,  -- 1 = yes, 0 = no
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
);

-- CATEGORIES TABLE
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- POST TABLE
CREATE TABLE post (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    author_id INT,
    category_id INT,
    FOREIGN KEY (author_id) REFERENCES user(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- mysqldump -u root -p smriti_db > backup.sql