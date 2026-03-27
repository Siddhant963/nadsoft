-- Business Rating System Database
-- Compatible with MySQL Workbench
-- Execute this file directly in MySQL Workbench

DROP DATABASE IF EXISTS business_rating_system;
CREATE DATABASE business_rating_system;
USE business_rating_system;

-- Businesses Table
CREATE TABLE businesses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address TEXT,
    phone VARCHAR(20),
    email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Ratings Table
CREATE TABLE ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    business_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    phone VARCHAR(20),
    rating DECIMAL(2,1) NOT NULL CHECK (rating >= 1.0 AND rating <= 5.0),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (business_id) REFERENCES businesses(id) ON DELETE CASCADE
);

-- Sample Test Data
INSERT INTO businesses (name, address, phone, email) VALUES
('Tech Solutions Inc', '123 Silicon Valley, CA 94025', '+1-555-0101', 'contact@techsolutions.com'),
('Green Cafe', '456 Organic Street, Portland, OR 97201', '+1-555-0202', 'hello@greencafe.com'),
('FastFix Auto Repair', '789 Motor Avenue, Detroit, MI 48201', '+1-555-0303', 'service@fastfix.com');

-- Sample Ratings
INSERT INTO ratings (business_id, name, email, phone, rating) VALUES
(1, 'John Doe', 'john@example.com', '+1-555-1001', 4.5),
(1, 'Jane Smith', 'jane@example.com', '+1-555-1002', 5.0),
(2, 'Mike Johnson', 'mike@example.com', '+1-555-1003', 4.0),
(2, 'Sarah Williams', 'sarah@example.com', '+1-555-1004', 4.5),
(3, 'Tom Brown', 'tom@example.com', '+1-555-1005', 3.5);
