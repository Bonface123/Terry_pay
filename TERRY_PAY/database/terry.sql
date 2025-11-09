CREATE DATABASE terry_pay;

USE terry_pay;

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone VARCHAR(15) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    mpesa_receipt VARCHAR(50),
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Pending', 'Success', 'Failed') DEFAULT 'Pending'
);
