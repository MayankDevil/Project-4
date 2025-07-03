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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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

-- USERS DATA RECORD
INSERT INTO user (
    first_name,
    last_name,
    name,
    email,
    contact_number,
    password,
    role,
    isActive
) VALUES
('Amit', 'Sharma', 'amitsh', 'amit.sharma@gmail.com', '9012345671', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Priya', 'Verma', 'priyav', 'priya.verma@gmail.com', '9012345672', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Rohan', NULL, 'rohan123', 'rohan.k@gmail.com', '9012345673', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Kajal', 'Singh', 'kajal_s', 'kajal.singh@gmail.com', '9012345674', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Sneha', NULL, 'sneha_dev', 'sneha@gmail.com', '9012345675', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Vikas', 'Yadav', 'vikasy', 'vikas.yadav@gmail.com', '9012345676', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Neha', 'Rai', 'neharii', 'neha.rai@gmail.com', '9012345677', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Arjun', NULL, 'arjunx', 'arjun@gmail.com', '9012345678', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Meera', 'Patel', 'meerap', 'meera.patel@gmail.com', '9012345679', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Abhishek', NULL, 'abhi_k', 'abhishek.k@gmail.com', '9012345680', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Simran', 'Mehta', 'sim_mehta', 'simran.mehta@gmail.com', '9012345681', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Raj', NULL, 'raj_dev', 'raj.dev@gmail.com', '9012345682', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Divya', 'Gupta', 'divgupta', 'divya.gupta@gmail.com', '9012345683', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Tina', 'Das', 'tina_d', 'tina.das@gmail.com', '9012345684', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Ankit', NULL, 'ankit101', 'ankit@gmail.com', '9012345685', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Ritu', 'Sen', 'ritusen', 'ritu.sen@gmail.com', '9012345686', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Deepak', NULL, 'deep_coder', 'deepak@gmail.com', '9012345687', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Pooja', 'Rawat', 'poojar', 'pooja.rawat@gmail.com', '9012345688', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Harsh', 'Bansal', 'harshb', 'harsh.bansal@gmail.com', '9012345689', '23b1362d92cddc00f79313c7a75cc3db', 0, 1),
('Alisha', NULL, 'alishaq', 'alisha.q@gmail.com', '9012345690', '23b1362d92cddc00f79313c7a75cc3db', 0, 1);
