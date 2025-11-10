<?php
/**
 * Admin Logout
 * Pwani Safaris Invoice Management System
 */

require_once 'auth.php';

// Logout user
$auth->logout();

// Redirect to login page
header('Location: login.php?message=logged_out');
exit();
?>
