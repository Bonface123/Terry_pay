-- Invoice Management System Database Schema
-- Created for Pwani Safaris Admin Panel

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS pwani_safaris;
USE pwani_safaris;

-- Admin users table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('admin', 'manager', 'staff') DEFAULT 'staff',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Clients table
CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    address TEXT,
    city VARCHAR(50),
    country VARCHAR(50) DEFAULT 'Kenya',
    tax_number VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tours/Services table
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(100) NOT NULL,
    description TEXT,
    unit_price DECIMAL(10,2) NOT NULL,
    category ENUM('cultural', 'coastal', 'custom', 'accommodation', 'transport') DEFAULT 'cultural',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Invoices table
CREATE TABLE IF NOT EXISTS invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_number VARCHAR(20) UNIQUE NOT NULL,
    client_id INT NOT NULL,
    invoice_date DATE NOT NULL,
    due_date DATE NOT NULL,
    status ENUM('draft', 'sent', 'paid', 'overdue', 'cancelled') DEFAULT 'draft',
    subtotal DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    tax_rate DECIMAL(5,2) DEFAULT 16.00, -- Kenya VAT rate
    tax_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    total_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    currency VARCHAR(3) DEFAULT 'KSh',
    notes TEXT,
    terms_conditions TEXT,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES admin_users(id)
);

-- Invoice items table
CREATE TABLE IF NOT EXISTS invoice_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT NOT NULL,
    service_id INT,
    item_description VARCHAR(200) NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    unit_price DECIMAL(10,2) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
);

-- Invoice payments table
CREATE TABLE IF NOT EXISTS invoice_payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT NOT NULL,
    payment_date DATE NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('cash', 'bank_transfer', 'mpesa', 'card', 'other') NOT NULL,
    reference_number VARCHAR(100),
    notes TEXT,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES admin_users(id)
);

-- Company settings table
CREATE TABLE IF NOT EXISTS company_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(100) NOT NULL DEFAULT 'Pwani Safaris',
    address TEXT,
    city VARCHAR(50) DEFAULT 'Kilifi',
    country VARCHAR(50) DEFAULT 'Kenya',
    phone VARCHAR(20),
    email VARCHAR(100),
    website VARCHAR(100),
    tax_number VARCHAR(50),
    logo_path VARCHAR(255),
    invoice_prefix VARCHAR(10) DEFAULT 'PS',
    next_invoice_number INT DEFAULT 1,
    default_terms TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert default admin user (password: admin123)
INSERT INTO admin_users (username, email, password_hash, full_name, role) VALUES 
('admin', 'admin@pwanisafaris.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System Administrator', 'admin');

-- Insert default company settings
INSERT INTO company_settings (
    company_name, 
    address, 
    city, 
    country, 
    phone, 
    email, 
    website,
    default_terms
) VALUES (
    'Pwani Safaris',
    'Kilifi County, Coastal Region',
    'Kilifi',
    'Kenya',
    '+254 740 900 798',
    'info@pwanisafaris.com',
    'www.pwanisafaris.com',
    'Payment is due within 30 days of invoice date. Late payments may incur additional charges. All tours are subject to weather conditions and availability.'
);

-- Insert sample services
INSERT INTO services (service_name, description, unit_price, category) VALUES
('Kaya Kauma Cultural Tour', 'Explore ancient Mijikenda sacred forests with traditional elders', 8500.00, 'cultural'),
('Gede Ruins Discovery', 'Uncover the mysteries of this 13th-century Swahili town', 6500.00, 'cultural'),
('Beach Sunset Cruise', 'Sail along pristine coastlines with traditional music', 12000.00, 'coastal'),
('Coral Reef Snorkeling', 'Discover vibrant marine life in protected coral reefs', 15000.00, 'coastal'),
('Mangrove Forest Exploration', 'Guided tour through coastal mangrove ecosystems', 9500.00, 'coastal'),
('Custom Coastal Adventure', 'Tailored experience designed around your interests', 25000.00, 'custom'),
('Airport Transfer', 'Transportation to/from Malindi Airport', 3500.00, 'transport'),
('Hotel Accommodation', 'Coastal hotel accommodation per night', 8000.00, 'accommodation');

-- Insert sample clients
INSERT INTO clients (client_name, email, phone, address, city, country) VALUES
('Sarah Mitchell', 'sarah.mitchell@email.com', '+44 20 7946 0958', '123 London Street', 'London', 'United Kingdom'),
('Marcus Johnson', 'marcus.johnson@email.com', '+1 416 555 0123', '456 Toronto Avenue', 'Toronto', 'Canada'),
('Elena Rodriguez', 'elena.rodriguez@email.com', '+34 93 123 4567', '789 Barcelona Road', 'Barcelona', 'Spain'),
('David Kimani', 'david.kimani@email.com', '+254 722 123 456', 'P.O. Box 123', 'Nairobi', 'Kenya');

-- Create indexes for better performance
CREATE INDEX idx_invoices_client_id ON invoices(client_id);
CREATE INDEX idx_invoices_status ON invoices(status);
CREATE INDEX idx_invoices_date ON invoices(invoice_date);
CREATE INDEX idx_invoice_items_invoice_id ON invoice_items(invoice_id);
CREATE INDEX idx_invoice_payments_invoice_id ON invoice_payments(invoice_id);
