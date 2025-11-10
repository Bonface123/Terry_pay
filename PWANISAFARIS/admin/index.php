<?php
/**
 * Admin Dashboard - Invoice Management System
 * Pwani Safaris
 */

require_once 'auth.php';
require_once '../config/database.php';

// Require login
requireLogin();

$current_user = getCurrentUser();
$db = getDBConnection();

// Get dashboard statistics
try {
    // Total invoices
    $stmt = $db->query("SELECT COUNT(*) as total FROM invoices");
    $total_invoices = $stmt->fetch()['total'];
    
    // Pending invoices
    $stmt = $db->query("SELECT COUNT(*) as pending FROM invoices WHERE status IN ('draft', 'sent')");
    $pending_invoices = $stmt->fetch()['pending'];
    
    // Paid invoices this month
    $stmt = $db->query("SELECT COUNT(*) as paid FROM invoices WHERE status = 'paid' AND MONTH(invoice_date) = MONTH(CURRENT_DATE()) AND YEAR(invoice_date) = YEAR(CURRENT_DATE())");
    $paid_this_month = $stmt->fetch()['paid'];
    
    // Total revenue this month
    $stmt = $db->query("SELECT COALESCE(SUM(total_amount), 0) as revenue FROM invoices WHERE status = 'paid' AND MONTH(invoice_date) = MONTH(CURRENT_DATE()) AND YEAR(invoice_date) = YEAR(CURRENT_DATE())");
    $monthly_revenue = $stmt->fetch()['revenue'];
    
    // Recent invoices
    $stmt = $db->query("
        SELECT i.*, c.client_name 
        FROM invoices i 
        LEFT JOIN clients c ON i.client_id = c.id 
        ORDER BY i.created_at DESC 
        LIMIT 5
    ");
    $recent_invoices = $stmt->fetchAll();
    
} catch (Exception $e) {
    $error_message = "Error loading dashboard data: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pwani Safaris</title>
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
<body class="bg-lightbg">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-heading font-bold text-primary">Pwani Safaris</h1>
                        <p class="text-sm text-textdark/70 font-body">Admin Dashboard</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-textdark font-body"><?php echo htmlspecialchars($current_user['name']); ?></p>
                        <p class="text-xs text-textdark/70 font-body"><?php echo ucfirst($current_user['role']); ?></p>
                    </div>
                    <a href="logout.php" class="bg-altcta hover:bg-altcta/90 text-white px-4 py-2 rounded-lg text-sm font-body transition-colors">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg min-h-screen">
            <div class="p-6">
                <nav class="space-y-2">
                    <a href="index.php" class="bg-primary text-white px-4 py-2 rounded-lg flex items-center space-x-3 font-body">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 7l5 5l5-5"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="invoices.php" class="text-textdark hover:bg-primary/10 hover:text-primary px-4 py-2 rounded-lg flex items-center space-x-3 font-body transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Invoices</span>
                    </a>
                    
                    <a href="clients.php" class="text-textdark hover:bg-primary/10 hover:text-primary px-4 py-2 rounded-lg flex items-center space-x-3 font-body transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Clients</span>
                    </a>
                    
                    <a href="services.php" class="text-textdark hover:bg-primary/10 hover:text-primary px-4 py-2 rounded-lg flex items-center space-x-3 font-body transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span>Services</span>
                    </a>
                    
                    <a href="reports.php" class="text-textdark hover:bg-primary/10 hover:text-primary px-4 py-2 rounded-lg flex items-center space-x-3 font-body transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Reports</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Page Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-heading font-bold text-textdark mb-2">Dashboard Overview</h2>
                <p class="text-textdark/70 font-body">Welcome back, <?php echo htmlspecialchars($current_user['name']); ?>! Here's what's happening with your invoices.</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Invoices -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-body text-textdark/70 mb-1">Total Invoices</p>
                            <p class="text-3xl font-bold text-textdark"><?php echo number_format($total_invoices ?? 0); ?></p>
                        </div>
                        <div class="bg-primary/10 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Invoices -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-body text-textdark/70 mb-1">Pending</p>
                            <p class="text-3xl font-bold text-cta"><?php echo number_format($pending_invoices ?? 0); ?></p>
                        </div>
                        <div class="bg-cta/10 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-cta" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Paid This Month -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-body text-textdark/70 mb-1">Paid This Month</p>
                            <p class="text-3xl font-bold text-accent"><?php echo number_format($paid_this_month ?? 0); ?></p>
                        </div>
                        <div class="bg-accent/10 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Monthly Revenue -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-body text-textdark/70 mb-1">Monthly Revenue</p>
                            <p class="text-3xl font-bold text-textdark">KSh <?php echo number_format($monthly_revenue ?? 0); ?></p>
                        </div>
                        <div class="bg-primary/10 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="lg:col-span-2">
                    <!-- Recent Invoices -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-heading font-bold text-textdark">Recent Invoices</h3>
                            <a href="invoices.php" class="text-primary hover:text-primary/80 font-body text-sm">View All</a>
                        </div>
                        
                        <?php if (!empty($recent_invoices)): ?>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-4 font-semibold text-textdark font-body">Invoice #</th>
                                        <th class="text-left py-3 px-4 font-semibold text-textdark font-body">Client</th>
                                        <th class="text-left py-3 px-4 font-semibold text-textdark font-body">Amount</th>
                                        <th class="text-left py-3 px-4 font-semibold text-textdark font-body">Status</th>
                                        <th class="text-left py-3 px-4 font-semibold text-textdark font-body">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_invoices as $invoice): ?>
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="py-3 px-4 font-body">
                                            <a href="invoice-view.php?id=<?php echo $invoice['id']; ?>" class="text-primary hover:underline">
                                                <?php echo htmlspecialchars($invoice['invoice_number']); ?>
                                            </a>
                                        </td>
                                        <td class="py-3 px-4 font-body"><?php echo htmlspecialchars($invoice['client_name'] ?? 'N/A'); ?></td>
                                        <td class="py-3 px-4 font-body">KSh <?php echo number_format($invoice['total_amount']); ?></td>
                                        <td class="py-3 px-4">
                                            <?php
                                            $status_colors = [
                                                'draft' => 'bg-gray-100 text-gray-800',
                                                'sent' => 'bg-blue-100 text-blue-800',
                                                'paid' => 'bg-green-100 text-green-800',
                                                'overdue' => 'bg-red-100 text-red-800',
                                                'cancelled' => 'bg-gray-100 text-gray-800'
                                            ];
                                            $color_class = $status_colors[$invoice['status']] ?? 'bg-gray-100 text-gray-800';
                                            ?>
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold font-body <?php echo $color_class; ?>">
                                                <?php echo ucfirst($invoice['status']); ?>
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 font-body text-sm text-textdark/70">
                                            <?php echo date('M j, Y', strtotime($invoice['invoice_date'])); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-textdark/70 font-body">No invoices found</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-heading font-bold text-textdark mb-6">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="invoice-create.php" class="w-full bg-primary hover:bg-primary/90 text-white px-4 py-3 rounded-lg font-body transition-colors flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <span>Create Invoice</span>
                            </a>
                            
                            <a href="clients.php?action=add" class="w-full bg-accent hover:bg-accent/90 text-white px-4 py-3 rounded-lg font-body transition-colors flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                <span>Add Client</span>
                            </a>
                            
                            <a href="services.php?action=add" class="w-full bg-cta hover:bg-cta/90 text-white px-4 py-3 rounded-lg font-body transition-colors flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <span>Add Service</span>
                            </a>
                            
                            <a href="reports.php" class="w-full border border-primary text-primary hover:bg-primary hover:text-white px-4 py-3 rounded-lg font-body transition-colors flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                <span>View Reports</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>