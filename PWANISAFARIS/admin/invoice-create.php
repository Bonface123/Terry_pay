<?php
/**
 * Create New Invoice
 * Pwani Safaris Admin Panel
 */

require_once 'auth.php';
require_once '../config/database.php';

// Require login
requireLogin();

$current_user = getCurrentUser();
$db = getDBConnection();

$error_message = '';
$success_message = '';

// Get clients and services for dropdowns
try {
    $clients_stmt = $db->query("SELECT id, client_name, email FROM clients ORDER BY client_name");
    $clients = $clients_stmt->fetchAll();
    
    $services_stmt = $db->query("SELECT id, service_name, unit_price FROM services WHERE is_active = 1 ORDER BY service_name");
    $services = $services_stmt->fetchAll();
    
    // Get next invoice number
    $settings_stmt = $db->query("SELECT invoice_prefix, next_invoice_number FROM company_settings WHERE id = 1");
    $settings = $settings_stmt->fetch();
    $next_invoice_number = ($settings['invoice_prefix'] ?? 'PS') . str_pad($settings['next_invoice_number'] ?? 1, 4, '0', STR_PAD_LEFT);
    
} catch (Exception $e) {
    $error_message = "Error loading data: " . $e->getMessage();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $db->beginTransaction();
        
        // Validate required fields
        $client_id = intval($_POST['client_id'] ?? 0);
        $invoice_date = $_POST['invoice_date'] ?? '';
        $due_date = $_POST['due_date'] ?? '';
        $tax_rate = floatval($_POST['tax_rate'] ?? 16);
        $notes = trim($_POST['notes'] ?? '');
        $terms_conditions = trim($_POST['terms_conditions'] ?? '');
        
        if (!$client_id || !$invoice_date || !$due_date) {
            throw new Exception('Please fill in all required fields.');
        }
        
        // Generate invoice number
        $invoice_number = $next_invoice_number;
        
        // Calculate totals
        $subtotal = 0;
        $items = [];
        
        if (isset($_POST['items']) && is_array($_POST['items'])) {
            foreach ($_POST['items'] as $item) {
                if (!empty($item['description']) && !empty($item['quantity']) && !empty($item['unit_price'])) {
                    $quantity = intval($item['quantity']);
                    $unit_price = floatval($item['unit_price']);
                    $total_price = $quantity * $unit_price;
                    
                    $items[] = [
                        'service_id' => intval($item['service_id']) ?: null,
                        'description' => trim($item['description']),
                        'quantity' => $quantity,
                        'unit_price' => $unit_price,
                        'total_price' => $total_price
                    ];
                    
                    $subtotal += $total_price;
                }
            }
        }
        
        if (empty($items)) {
            throw new Exception('Please add at least one invoice item.');
        }
        
        $tax_amount = ($subtotal * $tax_rate) / 100;
        $total_amount = $subtotal + $tax_amount;
        
        // Insert invoice
        $invoice_query = "
            INSERT INTO invoices (
                invoice_number, client_id, invoice_date, due_date, 
                subtotal, tax_rate, tax_amount, total_amount, 
                notes, terms_conditions, created_by
            ) VALUES (
                :invoice_number, :client_id, :invoice_date, :due_date,
                :subtotal, :tax_rate, :tax_amount, :total_amount,
                :notes, :terms_conditions, :created_by
            )
        ";
        
        $stmt = $db->prepare($invoice_query);
        $stmt->execute([
            ':invoice_number' => $invoice_number,
            ':client_id' => $client_id,
            ':invoice_date' => $invoice_date,
            ':due_date' => $due_date,
            ':subtotal' => $subtotal,
            ':tax_rate' => $tax_rate,
            ':tax_amount' => $tax_amount,
            ':total_amount' => $total_amount,
            ':notes' => $notes,
            ':terms_conditions' => $terms_conditions,
            ':created_by' => $current_user['id']
        ]);
        
        $invoice_id = $db->lastInsertId();
        
        // Insert invoice items
        $item_query = "
            INSERT INTO invoice_items (
                invoice_id, service_id, item_description, 
                quantity, unit_price, total_price
            ) VALUES (
                :invoice_id, :service_id, :item_description,
                :quantity, :unit_price, :total_price
            )
        ";
        
        $item_stmt = $db->prepare($item_query);
        
        foreach ($items as $item) {
            $item_stmt->execute([
                ':invoice_id' => $invoice_id,
                ':service_id' => $item['service_id'],
                ':item_description' => $item['description'],
                ':quantity' => $item['quantity'],
                ':unit_price' => $item['unit_price'],
                ':total_price' => $item['total_price']
            ]);
        }
        
        // Update next invoice number
        $db->query("UPDATE company_settings SET next_invoice_number = next_invoice_number + 1 WHERE id = 1");
        
        $db->commit();
        
        $success_message = "Invoice created successfully!";
        
        // Redirect to invoice view
        header("Location: invoice-view.php?id=$invoice_id");
        exit();
        
    } catch (Exception $e) {
        $db->rollBack();
        $error_message = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice - Pwani Safaris</title>
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
                        <p class="text-sm text-textdark/70 font-body">Create Invoice</p>
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
        <!-- Page Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-heading font-bold text-textdark mb-2">Create New Invoice</h2>
            <p class="text-textdark/70 font-body">Generate a professional invoice for your client</p>
        </div>

        <!-- Messages -->
        <?php if (!empty($error_message)): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Invoice Form -->
        <form method="POST" id="invoice-form" class="space-y-8">
            <!-- Invoice Details -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-heading font-bold text-textdark mb-6">Invoice Details</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="invoice_number" class="block text-sm font-semibold text-textdark mb-2 font-body">Invoice Number</label>
                        <input 
                            type="text" 
                            id="invoice_number" 
                            value="<?php echo htmlspecialchars($next_invoice_number); ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 font-body"
                            readonly
                        >
                    </div>
                    
                    <div>
                        <label for="client_id" class="block text-sm font-semibold text-textdark mb-2 font-body">Client *</label>
                        <select 
                            id="client_id" 
                            name="client_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body"
                            required
                        >
                            <option value="">Select a client</option>
                            <?php foreach ($clients as $client): ?>
                            <option value="<?php echo $client['id']; ?>">
                                <?php echo htmlspecialchars($client['client_name'] . ' (' . $client['email'] . ')'); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div>
                        <label for="tax_rate" class="block text-sm font-semibold text-textdark mb-2 font-body">Tax Rate (%)</label>
                        <input 
                            type="number" 
                            id="tax_rate" 
                            name="tax_rate" 
                            value="16"
                            step="0.01"
                            min="0"
                            max="100"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body"
                        >
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="invoice_date" class="block text-sm font-semibold text-textdark mb-2 font-body">Invoice Date *</label>
                        <input 
                            type="date" 
                            id="invoice_date" 
                            name="invoice_date" 
                            value="<?php echo date('Y-m-d'); ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body"
                            required
                        >
                    </div>
                    
                    <div>
                        <label for="due_date" class="block text-sm font-semibold text-textdark mb-2 font-body">Due Date *</label>
                        <input 
                            type="date" 
                            id="due_date" 
                            name="due_date" 
                            value="<?php echo date('Y-m-d', strtotime('+30 days')); ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body"
                            required
                        >
                    </div>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-heading font-bold text-textdark">Invoice Items</h3>
                    <button type="button" onclick="addInvoiceItem()" class="bg-accent hover:bg-accent/90 text-white px-4 py-2 rounded-lg font-body transition-colors">
                        Add Item
                    </button>
                </div>
                
                <div id="invoice-items">
                    <!-- Items will be added here dynamically -->
                </div>
                
                <!-- Totals -->
                <div class="mt-6 border-t pt-6">
                    <div class="flex justify-end">
                        <div class="w-80">
                            <div class="flex justify-between py-2">
                                <span class="font-body text-textdark">Subtotal:</span>
                                <span class="font-body font-semibold" id="subtotal-display">KSh 0.00</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="font-body text-textdark">VAT (<span id="tax-rate-display">16</span>%):</span>
                                <span class="font-body font-semibold" id="tax-display">KSh 0.00</span>
                            </div>
                            <div class="flex justify-between py-3 border-t border-gray-200">
                                <span class="font-body font-bold text-textdark text-lg">Total:</span>
                                <span class="font-body font-bold text-primary text-lg" id="total-display">KSh 0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes and Terms -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-heading font-bold text-textdark mb-6">Additional Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="notes" class="block text-sm font-semibold text-textdark mb-2 font-body">Notes</label>
                        <textarea 
                            id="notes" 
                            name="notes" 
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body"
                            placeholder="Any additional notes for the client..."
                        ></textarea>
                    </div>
                    
                    <div>
                        <label for="terms_conditions" class="block text-sm font-semibold text-textdark mb-2 font-body">Terms & Conditions</label>
                        <textarea 
                            id="terms_conditions" 
                            name="terms_conditions" 
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body"
                            placeholder="Payment terms and conditions..."
                        ></textarea>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4">
                <a href="invoices.php" class="border border-gray-300 text-textdark hover:bg-gray-50 px-6 py-3 rounded-lg font-body transition-colors">
                    Cancel
                </a>
                <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-body font-semibold transition-colors">
                    Create Invoice
                </button>
            </div>
        </form>
    </div>

    <script>
        let itemCounter = 0;
        const services = <?php echo json_encode($services); ?>;
        
        function addInvoiceItem() {
            itemCounter++;
            const itemsContainer = document.getElementById('invoice-items');
            
            const itemDiv = document.createElement('div');
            itemDiv.className = 'invoice-item border border-gray-200 rounded-lg p-4 mb-4';
            itemDiv.id = `item-${itemCounter}`;
            
            itemDiv.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    <div class="md:col-span-5">
                        <label class="block text-sm font-semibold text-textdark mb-2 font-body">Service/Description *</label>
                        <select name="items[${itemCounter}][service_id]" onchange="selectService(this, ${itemCounter})" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body">
                            <option value="">Select a service or enter custom</option>
                            ${services.map(service => `<option value="${service.id}" data-price="${service.unit_price}">${service.service_name} - KSh ${parseFloat(service.unit_price).toLocaleString()}</option>`).join('')}
                        </select>
                        <input type="text" name="items[${itemCounter}][description]" id="description-${itemCounter}" placeholder="Enter description" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body mt-2" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-textdark mb-2 font-body">Quantity *</label>
                        <input type="number" name="items[${itemCounter}][quantity]" id="quantity-${itemCounter}" value="1" min="1" onchange="calculateItemTotal(${itemCounter})" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-textdark mb-2 font-body">Unit Price *</label>
                        <input type="number" name="items[${itemCounter}][unit_price]" id="unit-price-${itemCounter}" step="0.01" min="0" onchange="calculateItemTotal(${itemCounter})" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-textdark mb-2 font-body">Total</label>
                        <input type="text" id="total-${itemCounter}" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 font-body" readonly>
                    </div>
                    <div class="md:col-span-1">
                        <button type="button" onclick="removeInvoiceItem(${itemCounter})" class="w-full bg-altcta hover:bg-altcta/90 text-white px-3 py-2 rounded-lg font-body transition-colors">
                            Remove
                        </button>
                    </div>
                </div>
            `;
            
            itemsContainer.appendChild(itemDiv);
            calculateTotals();
        }
        
        function selectService(select, itemId) {
            const selectedOption = select.options[select.selectedIndex];
            const descriptionInput = document.getElementById(`description-${itemId}`);
            const unitPriceInput = document.getElementById(`unit-price-${itemId}`);
            
            if (selectedOption.value) {
                descriptionInput.value = selectedOption.text.split(' - ')[0];
                unitPriceInput.value = selectedOption.dataset.price;
                calculateItemTotal(itemId);
            }
        }
        
        function calculateItemTotal(itemId) {
            const quantity = parseFloat(document.getElementById(`quantity-${itemId}`).value) || 0;
            const unitPrice = parseFloat(document.getElementById(`unit-price-${itemId}`).value) || 0;
            const total = quantity * unitPrice;
            
            document.getElementById(`total-${itemId}`).value = `KSh ${total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            calculateTotals();
        }
        
        function removeInvoiceItem(itemId) {
            const itemDiv = document.getElementById(`item-${itemId}`);
            itemDiv.remove();
            calculateTotals();
        }
        
        function calculateTotals() {
            let subtotal = 0;
            
            // Calculate subtotal from all items
            document.querySelectorAll('.invoice-item').forEach(item => {
                const quantityInput = item.querySelector('input[name*="[quantity]"]');
                const unitPriceInput = item.querySelector('input[name*="[unit_price]"]');
                
                if (quantityInput && unitPriceInput) {
                    const quantity = parseFloat(quantityInput.value) || 0;
                    const unitPrice = parseFloat(unitPriceInput.value) || 0;
                    subtotal += quantity * unitPrice;
                }
            });
            
            const taxRate = parseFloat(document.getElementById('tax_rate').value) || 0;
            const taxAmount = (subtotal * taxRate) / 100;
            const total = subtotal + taxAmount;
            
            // Update displays
            document.getElementById('subtotal-display').textContent = `KSh ${subtotal.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            document.getElementById('tax-rate-display').textContent = taxRate.toString();
            document.getElementById('tax-display').textContent = `KSh ${taxAmount.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            document.getElementById('total-display').textContent = `KSh ${total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        }
        
        // Update totals when tax rate changes
        document.getElementById('tax_rate').addEventListener('change', calculateTotals);
        
        // Add first item on page load
        document.addEventListener('DOMContentLoaded', function() {
            addInvoiceItem();
        });
        
        // Form validation
        document.getElementById('invoice-form').addEventListener('submit', function(e) {
            const items = document.querySelectorAll('.invoice-item');
            if (items.length === 0) {
                e.preventDefault();
                alert('Please add at least one invoice item.');
                return false;
            }
            
            let hasValidItem = false;
            items.forEach(item => {
                const description = item.querySelector('input[name*="[description]"]').value.trim();
                const quantity = item.querySelector('input[name*="[quantity]"]').value;
                const unitPrice = item.querySelector('input[name*="[unit_price]"]').value;
                
                if (description && quantity && unitPrice) {
                    hasValidItem = true;
                }
            });
            
            if (!hasValidItem) {
                e.preventDefault();
                alert('Please fill in all required fields for at least one invoice item.');
                return false;
            }
        });
    </script>
</body>
</html>
