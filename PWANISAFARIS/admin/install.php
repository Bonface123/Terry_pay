<?php
/**
 * Installation Script for Pwani Safaris Invoice Management System
 * Run this once to set up the database
 */

// Check if already installed
if (file_exists('installed.lock')) {
    die('System already installed. Delete installed.lock file to reinstall.');
}

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Database connection parameters
        $host = $_POST['host'] ?? 'localhost';
        $username = $_POST['username'] ?? 'root';
        $password = $_POST['password'] ?? '';
        $database = $_POST['database'] ?? 'pwani_safaris';
        
        // Connect to MySQL
        $pdo = new PDO("mysql:host=$host", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Create database if it doesn't exist
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `$database`");
        
        // Read and execute SQL file
        $sql_file = '../database/invoice_system.sql';
        if (!file_exists($sql_file)) {
            throw new Exception('SQL file not found: ' . $sql_file);
        }
        
        $sql = file_get_contents($sql_file);
        
        // Split SQL into individual statements
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        
        foreach ($statements as $statement) {
            if (!empty($statement) && !preg_match('/^(--|#)/', $statement)) {
                $pdo->exec($statement);
            }
        }
        
        // Update database config file
        $config_content = "<?php
/**
 * Database Configuration for Pwani Safaris
 * Invoice Management System
 */

class Database {
    private \$host = '$host';
    private \$db_name = '$database';
    private \$username = '$username';
    private \$password = '$password';
    private \$conn;

    public function getConnection() {
        \$this->conn = null;
        
        try {
            \$this->conn = new PDO(
                \"mysql:host=\" . \$this->host . \";dbname=\" . \$this->db_name,
                \$this->username,
                \$this->password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => \"SET NAMES utf8\"
                )
            );
        } catch(PDOException \$exception) {
            echo \"Connection error: \" . \$exception->getMessage();
        }
        
        return \$this->conn;
    }
}

// Database connection helper function
function getDBConnection() {
    \$database = new Database();
    return \$database->getConnection();
}

// Test database connection
function testConnection() {
    try {
        \$db = getDBConnection();
        if (\$db) {
            return true;
        }
        return false;
    } catch (Exception \$e) {
        return false;
    }
}
?>";
        
        file_put_contents('../config/database.php', $config_content);
        
        // Create lock file
        file_put_contents('installed.lock', date('Y-m-d H:i:s'));
        
        $success_message = 'Installation completed successfully! You can now login with username: admin, password: admin123';
        
    } catch (Exception $e) {
        $error_message = 'Installation failed: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install Pwani Safaris Invoice System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0077B6',
                        accent: '#2A9D8F',
                        cta: '#F77F00',
                        altcta: '#E63946',
                        base: '#F4E1C1',
                        textdark: '#3D3D3D',
                        lightbg: '#F8F9FA',
                        darkfooter: '#023E8A'
                    },
                    fontFamily: {
                        'heading': ['Playfair Display', 'serif'],
                        'body': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-primary/10 to-accent/10 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <!-- Logo and Title -->
        <div class="text-center mb-8">
            <div class="bg-white rounded-full w-20 h-20 mx-auto mb-4 flex items-center justify-center shadow-lg">
                <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-heading font-bold text-textdark mb-2">Pwani Safaris</h1>
            <p class="text-textdark/70 font-body">Invoice Management System Installation</p>
        </div>

        <!-- Installation Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <?php if (!empty($success_message)): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <?php echo htmlspecialchars($success_message); ?>
                </div>
                <div class="mt-4">
                    <a href="login.php" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-body transition-colors">
                        Go to Login
                    </a>
                </div>
            </div>
            <?php else: ?>
            
            <form method="POST" class="space-y-6">
                <div class="text-center mb-6">
                    <h2 class="text-xl font-heading font-bold text-textdark mb-2">Database Configuration</h2>
                    <p class="text-textdark/70 font-body text-sm">Enter your database connection details</p>
                </div>

                <!-- Error Message -->
                <?php if (!empty($error_message)): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Database Host -->
                <div>
                    <label for="host" class="block text-sm font-semibold text-textdark mb-2 font-body">Database Host</label>
                    <input 
                        type="text" 
                        id="host" 
                        name="host" 
                        value="localhost"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body"
                        required
                    >
                </div>

                <!-- Database Name -->
                <div>
                    <label for="database" class="block text-sm font-semibold text-textdark mb-2 font-body">Database Name</label>
                    <input 
                        type="text" 
                        id="database" 
                        name="database" 
                        value="pwani_safaris"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body"
                        required
                    >
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-textdark mb-2 font-body">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="root"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body"
                        required
                    >
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-textdark mb-2 font-body">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors font-body"
                    >
                </div>

                <!-- Install Button -->
                <button 
                    type="submit" 
                    class="w-full bg-primary hover:bg-primary/90 text-white py-3 px-4 rounded-lg font-semibold font-body transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2"
                >
                    Install System
                </button>
            </form>

            <!-- Installation Notes -->
            <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <h3 class="text-sm font-semibold text-blue-800 mb-2 font-body">Installation Notes:</h3>
                <ul class="text-sm text-blue-700 font-body space-y-1">
                    <li>• Make sure your MySQL server is running</li>
                    <li>• The database will be created automatically</li>
                    <li>• Default admin credentials: admin / admin123</li>
                    <li>• Change default credentials after first login</li>
                </ul>
            </div>
            <?php endif; ?>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-textdark/60 text-sm font-body">
                © 2025 Pwani Safaris. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
