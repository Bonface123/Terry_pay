<?php
/**
 * Admin Authentication System
 * Pwani Safaris Invoice Management
 */

session_start();
require_once '../config/database.php';

class AdminAuth {
    private $db;
    
    public function __construct() {
        $this->db = getDBConnection();
    }
    
    public function login($username, $password) {
        try {
            $query = "SELECT id, username, email, password_hash, full_name, role, is_active 
                     FROM admin_users 
                     WHERE (username = :username OR email = :username) AND is_active = 1";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            if ($stmt->rowCount() == 1) {
                $user = $stmt->fetch();
                
                if (password_verify($password, $user['password_hash'])) {
                    // Set session variables
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['admin_username'] = $user['username'];
                    $_SESSION['admin_email'] = $user['email'];
                    $_SESSION['admin_name'] = $user['full_name'];
                    $_SESSION['admin_role'] = $user['role'];
                    $_SESSION['login_time'] = time();
                    
                    return [
                        'success' => true,
                        'message' => 'Login successful',
                        'user' => $user
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Invalid password'
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'User not found or inactive'
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Login error: ' . $e->getMessage()
            ];
        }
    }
    
    public function logout() {
        session_destroy();
        return true;
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }
    
    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            header('Location: login.php');
            exit();
        }
    }
    
    public function getCurrentUser() {
        if ($this->isLoggedIn()) {
            return [
                'id' => $_SESSION['admin_id'],
                'username' => $_SESSION['admin_username'],
                'email' => $_SESSION['admin_email'],
                'name' => $_SESSION['admin_name'],
                'role' => $_SESSION['admin_role']
            ];
        }
        return null;
    }
    
    public function hasPermission($required_role = 'staff') {
        if (!$this->isLoggedIn()) {
            return false;
        }
        
        $user_role = $_SESSION['admin_role'];
        $roles = ['staff' => 1, 'manager' => 2, 'admin' => 3];
        
        return $roles[$user_role] >= $roles[$required_role];
    }
}

// Global auth instance
$auth = new AdminAuth();

// Helper functions
function requireLogin() {
    global $auth;
    $auth->requireLogin();
}

function getCurrentUser() {
    global $auth;
    return $auth->getCurrentUser();
}

function hasPermission($role = 'staff') {
    global $auth;
    return $auth->hasPermission($role);
}

function isLoggedIn() {
    global $auth;
    return $auth->isLoggedIn();
}
?>
