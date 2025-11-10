<?php
/**
 * View Invoice Details
 * Pwani Safaris Admin Panel
 */

require_once 'auth.php';
require_once '../config/database.php';

// Require login
requireLogin();

$current_user = getCurrentUser();
$db = getDBConnection();

$invoice_id = intval($_GET['id'] ?? 0);

if (!$invoice_id) {
    header('Location: invoices.php');
    exit();
}

try {
    // Get invoice data with client information
    $query = "
        SELECT 
            i.*,
            c.client_name,
            c.email as client_email,
            c.phone as client_phone,
            c.address as client_address,
            c.city as client_city,
            c.country as client_country,
            au.full_name as created_by_name
        FROM invoices i
        LEFT JOIN clients c ON i.client_id = c.id
        LEFT JOIN admin_users au ON i.created_by = au.id
        WHERE i.id = :invoice_id
    ";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':invoice_id', $invoice_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $invoice = $stmt->fetch();
    
    if (!$invoice) {
        header('Location: invoices.php');
        exit();
    }
    
    // Get invoice items
    $query = "
        SELECT ii.*, s.service_name
        FROM invoice_items ii
        LEFT JOIN services s ON ii.service_id = s.id
        WHERE ii.invoice_id = :invoice_id
        ORDER BY ii.id
    ";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':invoice_id', $invoice_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $invoice_items = $stmt->fetchAll();
    
    // Get payment history
    $query = "
        SELECT ip.*, au.full_name as recorded_by_name
        FROM invoice_payments ip
        LEFT JOIN admin_users au ON ip.created_by = au.id
        WHERE ip.invoice_id = :invoice_id
        ORDER BY ip.payment_date DESC, ip.created_at DESC
    ";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':invoice_id', $invoice_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $payments = $stmt->fetchAll();
    
    $total_paid = array_sum(array_column($payments, 'amount'));
    $balance_due = $invoice['total_amount'] - $total_paid;
    
} catch (Exception $e) {
    $error_message = "Error loading invoice: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?php echo htmlspecialchars($invoice['invoice_number']); ?> - Pwani Safaris</title>
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
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .print-shadow { box-shadow: none !important; }
        }
    </style>
</head>
<body class="bg-lightbg">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-heading font-bold text-primary">Pwani Safaris</h1>
                        <p class="text-sm text-textdark/70 font-body">Invoice Details</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="invoices.php" class="text-textdark hover:text-primary font-body">← Back to Invoices</a>
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

    <div class="max-w-6xl mx-auto p-8">
        <!-- Action Buttons -->
        <div class="flex justify-between items-center mb-8 no-print">
            <div>
                <h2 class="text-3xl font-heading font-bold text-textdark mb-2">Invoice #<?php echo htmlspecialchars($invoice['invoice_number']); ?></h2>
                <p class="text-textdark/70 font-body">Created on <?php echo date('F j, Y', strtotime($invoice['created_at'])); ?></p>
            </div>
            
            <div class="flex space-x-3">
                <button onclick="window.print()" class="bg-accent hover:bg-accent/90 text-white px-4 py-2 rounded-lg font-body transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Print</span>
                </button>
                
                <a href="invoice-pdf.php?id=<?php echo $invoice['id']; ?>" target="_blank" class="bg-cta hover:bg-cta/90 text-white px-4 py-2 rounded-lg font-body transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Download PDF</span>
                </a>
                
                <a href="invoice-edit.php?id=<?php echo $invoice['id']; ?>" class="border border-primary text-primary hover:bg-primary hover:text-white px-4 py-2 rounded-lg font-body transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span>Edit</span>
                </a>
            </div>
        </div>

        <!-- Invoice Content -->
        <div class="bg-white rounded-xl shadow-lg print-shadow p-8 mb-8">
            <!-- Header -->
            <div class="border-b border-gray-200 pb-8 mb-8">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-4xl font-heading font-bold text-primary mb-4">Pwani Safaris</h1>
                        <div class="text-textdark/70 font-body">
                            <p>Kilifi County, Coastal Region</p>
                            <p>Kilifi, Kenya</p>
                            <p>Phone: +254 740 900 798</p>
                            <p>Email: info@pwanisafaris.com</p>
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <h2 class="text-3xl font-heading font-bold text-textdark mb-4">INVOICE</h2>
                        <div class="text-textdark font-body">
                            <p><strong>Invoice #:</strong> <?php echo htmlspecialchars($invoice['invoice_number']); ?></p>
                            <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($invoice['invoice_date'])); ?></p>
                            <p><strong>Due Date:</strong> <?php echo date('F j, Y', strtotime($invoice['due_date'])); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client and Status Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-heading font-bold text-textdark mb-4">Bill To:</h3>
                    <div class="text-textdark font-body">
                        <p class="font-semibold text-lg"><?php echo htmlspecialchars($invoice['client_name']); ?></p>
                        <?php if (!empty($invoice['client_address'])): ?>
                        <p><?php echo htmlspecialchars($invoice['client_address']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($invoice['client_city'])): ?>
                        <p><?php echo htmlspecialchars($invoice['client_city'] . ', ' . $invoice['client_country']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($invoice['client_email'])): ?>
                        <p>Email: <?php echo htmlspecialchars($invoice['client_email']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($invoice['client_phone'])): ?>
                        <p>Phone: <?php echo htmlspecialchars($invoice['client_phone']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-heading font-bold text-textdark mb-4">Invoice Status:</h3>
                    <div class="space-y-3">
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
                        <div>
                            <span class="px-4 py-2 rounded-full text-sm font-semibold font-body <?php echo $color_class; ?>">
                                <?php echo ucfirst($invoice['status']); ?>
                            </span>
                        </div>
                        
                        <div class="text-textdark font-body">
                            <p><strong>Total Amount:</strong> KSh <?php echo number_format($invoice['total_amount'], 2); ?></p>
                            <p><strong>Amount Paid:</strong> KSh <?php echo number_format($total_paid, 2); ?></p>
                            <p><strong>Balance Due:</strong> <span class="<?php echo $balance_due > 0 ? 'text-altcta font-semibold' : 'text-accent'; ?>">KSh <?php echo number_format($balance_due, 2); ?></span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="mb-8">
                <h3 class="text-lg font-heading font-bold text-textdark mb-4">Invoice Items</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th class="text-left py-3 px-4 font-semibold font-body">Description</th>
                                <th class="text-center py-3 px-4 font-semibold font-body">Qty</th>
                                <th class="text-right py-3 px-4 font-semibold font-body">Unit Price</th>
                                <th class="text-right py-3 px-4 font-semibold font-body">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($invoice_items as $item): ?>
                            <tr class="border-b border-gray-200">
                                <td class="py-3 px-4 font-body"><?php echo htmlspecialchars($item['item_description']); ?></td>
                                <td class="py-3 px-4 font-body text-center"><?php echo $item['quantity']; ?></td>
                                <td class="py-3 px-4 font-body text-right">KSh <?php echo number_format($item['unit_price'], 2); ?></td>
                                <td class="py-3 px-4 font-body text-right">KSh <?php echo number_format($item['total_price'], 2); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Totals -->
                <div class="flex justify-end mt-6">
                    <div class="w-80">
                        <div class="flex justify-between py-2 border-b border-gray-200">
                            <span class="font-body text-textdark">Subtotal:</span>
                            <span class="font-body font-semibold">KSh <?php echo number_format($invoice['subtotal'], 2); ?></span>
                        </div>
                        <?php if ($invoice['tax_amount'] > 0): ?>
                        <div class="flex justify-between py-2 border-b border-gray-200">
                            <span class="font-body text-textdark">VAT (<?php echo $invoice['tax_rate']; ?>%):</span>
                            <span class="font-body font-semibold">KSh <?php echo number_format($invoice['tax_amount'], 2); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="flex justify-between py-3 border-t-2 border-primary">
                            <span class="font-body font-bold text-textdark text-lg">TOTAL:</span>
                            <span class="font-body font-bold text-primary text-lg">KSh <?php echo number_format($invoice['total_amount'], 2); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes and Terms -->
            <?php if (!empty($invoice['notes']) || !empty($invoice['terms_conditions'])): ?>
            <div class="border-t border-gray-200 pt-8">
                <?php if (!empty($invoice['notes'])): ?>
                <div class="mb-6">
                    <h3 class="text-lg font-heading font-bold text-textdark mb-3">Notes:</h3>
                    <p class="text-textdark font-body"><?php echo nl2br(htmlspecialchars($invoice['notes'])); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($invoice['terms_conditions'])): ?>
                <div>
                    <h3 class="text-lg font-heading font-bold text-textdark mb-3">Terms & Conditions:</h3>
                    <p class="text-textdark font-body"><?php echo nl2br(htmlspecialchars($invoice['terms_conditions'])); ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Footer -->
            <div class="text-center mt-8 pt-8 border-t border-gray-200">
                <p class="text-accent font-body font-semibold text-lg">Thank you for choosing Pwani Safaris!</p>
                <p class="text-textdark/70 font-body">Experience authentic coastal adventures with us.</p>
            </div>
        </div>

        <!-- Payment History -->
        <?php if (!empty($payments) || $current_user['role'] === 'admin'): ?>
        <div class="bg-white rounded-xl shadow-lg p-6 no-print">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-heading font-bold text-textdark">Payment History</h3>
                <?php if ($balance_due > 0 && $current_user['role'] === 'admin'): ?>
                <button onclick="showAddPaymentModal()" class="bg-accent hover:bg-accent/90 text-white px-4 py-2 rounded-lg font-body transition-colors">
                    Record Payment
                </button>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($payments)): ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-3 px-4 font-semibold text-textdark font-body">Date</th>
                            <th class="text-left py-3 px-4 font-semibold text-textdark font-body">Amount</th>
                            <th class="text-left py-3 px-4 font-semibold text-textdark font-body">Method</th>
                            <th class="text-left py-3 px-4 font-semibold text-textdark font-body">Reference</th>
                            <th class="text-left py-3 px-4 font-semibold text-textdark font-body">Recorded By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments as $payment): ?>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 px-4 font-body"><?php echo date('M j, Y', strtotime($payment['payment_date'])); ?></td>
                            <td class="py-3 px-4 font-body font-semibold text-accent">KSh <?php echo number_format($payment['amount'], 2); ?></td>
                            <td class="py-3 px-4 font-body"><?php echo ucfirst(str_replace('_', ' ', $payment['payment_method'])); ?></td>
                            <td class="py-3 px-4 font-body"><?php echo htmlspecialchars($payment['reference_number'] ?? '-'); ?></td>
                            <td class="py-3 px-4 font-body"><?php echo htmlspecialchars($payment['recorded_by_name'] ?? 'Unknown'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="text-center py-8">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-3a2 2 0 00-2-2H9a2 2 0 00-2 2v3a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <p class="text-textdark/70 font-body">No payments recorded yet</p>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Add Payment Modal (placeholder for future implementation) -->
    <div id="payment-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-heading font-bold text-textdark mb-4">Record Payment</h3>
            <p class="text-textdark/70 font-body mb-4">Payment recording functionality will be implemented in the next phase.</p>
            <button onclick="hideAddPaymentModal()" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-body transition-colors">
                Close
            </button>
        </div>
    </div>

    <script>
        function showAddPaymentModal() {
            document.getElementById('payment-modal').classList.remove('hidden');
            document.getElementById('payment-modal').classList.add('flex');
        }
        
        function hideAddPaymentModal() {
            document.getElementById('payment-modal').classList.add('hidden');
            document.getElementById('payment-modal').classList.remove('flex');
        }
    </script>
</body>
</html>
