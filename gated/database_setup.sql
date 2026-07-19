CREATE DATABASE IF NOT EXISTS estatesecurity;
USE estatesecurity;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'resident', 'security') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS resident (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    national_ID INT,
    telephone INT NULL,
    email VARCHAR(50) NULL,
    courtNo INT NOT NULL,
    houseNo INT NOT NULL
);

CREATE TABLE IF NOT EXISTS guest (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    national_ID INT,
    telephone INT NULL,
    vehiclePlate VARCHAR(15) NULL,
    purpose VARCHAR(255),
    visitTime DATETIME DEFAULT CURRENT_TIMESTAMP,
    courtNo INT NOT NULL,
    houseNo INT NOT NULL
);

CREATE TABLE IF NOT EXISTS security (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staffNo INT NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    national_ID INT,
    dateOnDuty DATETIME DEFAULT CURRENT_TIMESTAMP,
    rank VARCHAR(50) NOT NULL,
    workstation VARCHAR(100)
);