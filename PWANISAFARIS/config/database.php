<?php
/**
 * Database Configuration for Pwani Safaris
 * Invoice Management System
 */

class Database {
    private $host = 'localhost';
    private $db_name = 'pwani_safaris';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                )
            );
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        
        return $this->conn;
    }
}

// Database connection helper function
function getDBConnection() {
    $database = new Database();
    return $database->getConnection();
}

// Test database connection
function testConnection() {
    try {
        $db = getDBConnection();
        if ($db) {
            return true;
        }
        return false;
    } catch (Exception $e) {
        return false;
    }
}
?>
