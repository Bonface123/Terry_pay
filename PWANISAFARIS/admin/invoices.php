<?php
/**
 * Invoice Management - List All Invoices
 * Pwani Safaris Admin Panel
 */

require_once 'auth.php';
require_once '../config/database.php';

// Require login
requireLogin();

$current_user = getCurrentUser();
$db = getDBConnection();

// Handle search and filters
$search = $_GET['search'] ?? '';
$status_filter = $_GET['status'] ?? '';
$page = max(1, intval($_GET['page'] ?? 1));
$per_page = 20;
$offset = ($page - 1) * $per_page;

// Build query
$where_conditions = [];
$params = [];

if (!empty($search)) {
    $where_conditions[] = "(i.invoice_number LIKE :search OR c.client_name LIKE :search OR c.email LIKE :search)";
    $params[':search'] = "%$search%";
}

if (!empty($status_filter)) {
    $where_conditions[] = "i.status = :status";
    $params[':status'] = $status_filter;
}

$where_clause = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

try {
    // Get total count
    $count_query = "
        SELECT COUNT(*) as total 
        FROM invoices i 
        LEFT JOIN clients c ON i.client_id = c.id 
        $where_clause
    ";
    $stmt = $db->prepare($count_query);
    $stmt->execute($params);
    $total_invoices = $stmt->fetch()['total'];
    $total_pages = ceil($total_invoices / $per_page);

    // Get invoices
    $query = "
        SELECT i.*, c.client_name, c.email as client_email
        FROM invoices i 
        LEFT JOIN clients c ON i.client_id = c.id 
        $where_clause
        ORDER BY i.created_at DESC 
        LIMIT :limit OFFSET :offset
    ";
    
    $stmt = $db->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $per_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $invoices = $stmt->fetchAll();

} catch (Exception $e) {
    $error_message = "Error loading invoices: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Management - Pwani Safaris</title>
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
                        <p class="text-sm text-textdark/70 font-body">Invoice Management</p>
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
                    <a href="index.php" class="text-textdark hover:bg-primary/10 hover:text-primary px-4 py-2 rounded-lg flex items-center space-x-3 font-body transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 7l5 5l5-5"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="invoices.php" class="bg-primary text-white px-4 py-2 rounded-lg flex items-center space-x-3 font-body">
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
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-heading font-bold text-textdark mb-2">Invoice Management</h2>
                    <p class="text-textdark/70 font-body">Manage all client invoices and payments</p>
                </div>
                <a href="invoice-create.php" class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-body font-semibold transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span>Create Invoice</span>
                </a>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <form method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input 
                            type="text" 
                            name="search" 
                            value="<?php echo htmlspecialchars($search); ?>"
                            placeholder="Search by invoice number, client name, or email..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body"
                        >
                    </div>
                    <div>
                        <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body">
                            <option value="">All Status</option>
                            <option value="draft" <?php echo $status_filter === 'draft' ? 'selected' : ''; ?>>Draft</option>
                            <option value="sent" <?php echo $status_filter === 'sent' ? 'selected' : ''; ?>>Sent</option>
                            <option value="paid" <?php echo $status_filter === 'paid' ? 'selected' : ''; ?>>Paid</option>
                            <option value="overdue" <?php echo $status_filter === 'overdue' ? 'selected' : ''; ?>>Overdue</option>
                            <option value="cancelled" <?php echo $status_filter === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-accent hover:bg-accent/90 text-white px-6 py-2 rounded-lg font-body transition-colors">
                        Search
                    </button>
                    <?php if (!empty($search) || !empty($status_filter)): ?>
                    <a href="invoices.php" class="border border-gray-300 text-textdark hover:bg-gray-50 px-6 py-2 rounded-lg font-body transition-colors">
                        Clear
                    </a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Invoices Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <?php if (!empty($invoices)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left py-4 px-6 font-semibold text-textdark font-body">Invoice #</th>
                                <th class="text-left py-4 px-6 font-semibold text-textdark font-body">Client</th>
                                <th class="text-left py-4 px-6 font-semibold text-textdark font-body">Amount</th>
                                <th class="text-left py-4 px-6 font-semibold text-textdark font-body">Status</th>
                                <th class="text-left py-4 px-6 font-semibold text-textdark font-body">Date</th>
                                <th class="text-left py-4 px-6 font-semibold text-textdark font-body">Due Date</th>
                                <th class="text-left py-4 px-6 font-semibold text-textdark font-body">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($invoices as $invoice): ?>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-6 font-body">
                                    <a href="invoice-view.php?id=<?php echo $invoice['id']; ?>" class="text-primary hover:underline font-semibold">
                                        <?php echo htmlspecialchars($invoice['invoice_number']); ?>
                                    </a>
                                </td>
                                <td class="py-4 px-6 font-body">
                                    <div>
                                        <p class="font-semibold text-textdark"><?php echo htmlspecialchars($invoice['client_name'] ?? 'N/A'); ?></p>
                                        <p class="text-sm text-textdark/70"><?php echo htmlspecialchars($invoice['client_email'] ?? ''); ?></p>
                                    </div>
                                </td>
                                <td class="py-4 px-6 font-body font-semibold">KSh <?php echo number_format($invoice['total_amount']); ?></td>
                                <td class="py-4 px-6">
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
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold font-body <?php echo $color_class; ?>">
                                        <?php echo ucfirst($invoice['status']); ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 font-body text-textdark/70">
                                    <?php echo date('M j, Y', strtotime($invoice['invoice_date'])); ?>
                                </td>
                                <td class="py-4 px-6 font-body text-textdark/70">
                                    <?php echo date('M j, Y', strtotime($invoice['due_date'])); ?>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-2">
                                        <a href="invoice-view.php?id=<?php echo $invoice['id']; ?>" class="text-primary hover:text-primary/80" title="View">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        <a href="invoice-edit.php?id=<?php echo $invoice['id']; ?>" class="text-accent hover:text-accent/80" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <a href="invoice-pdf.php?id=<?php echo $invoice['id']; ?>" class="text-cta hover:text-cta/80" title="Download PDF" target="_blank">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-between">
                    <div class="text-sm text-textdark/70 font-body">
                        Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $per_page, $total_invoices); ?> of <?php echo $total_invoices; ?> invoices
                    </div>
                    <div class="flex items-center space-x-2">
                        <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>&status=<?php echo urlencode($status_filter); ?>" 
                           class="px-3 py-2 border border-gray-300 rounded-lg text-textdark hover:bg-gray-100 font-body">
                            Previous
                        </a>
                        <?php endif; ?>
                        
                        <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                        <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&status=<?php echo urlencode($status_filter); ?>" 
                           class="px-3 py-2 border rounded-lg font-body <?php echo $i === $page ? 'bg-primary text-white border-primary' : 'border-gray-300 text-textdark hover:bg-gray-100'; ?>">
                            <?php echo $i; ?>
                        </a>
                        <?php endfor; ?>
                        
                        <?php if ($page < $total_pages): ?>
                        <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>&status=<?php echo urlencode($status_filter); ?>" 
                           class="px-3 py-2 border border-gray-300 rounded-lg text-textdark hover:bg-gray-100 font-body">
                            Next
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php else: ?>
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-lg font-heading font-semibold text-textdark mb-2">No invoices found</h3>
                    <p class="text-textdark/70 font-body mb-4">Get started by creating your first invoice.</p>
                    <a href="invoice-create.php" class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-body font-semibold transition-colors inline-flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        <span>Create Invoice</span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
