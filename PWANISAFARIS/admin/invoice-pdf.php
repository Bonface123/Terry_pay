<?php
/**
 * Invoice PDF Generator Endpoint
 * Pwani Safaris Admin Panel
 */

require_once 'auth.php';
require_once '../config/database.php';
require_once 'includes/InvoicePDF.php';

// Require login
requireLogin();

$invoice_id = intval($_GET['id'] ?? 0);

if (!$invoice_id) {
    die('Invalid invoice ID');
}

$db = getDBConnection();

try {
    // Get invoice data with client and company information
    $query = "
        SELECT 
            i.*,
            c.client_name,
            c.email as client_email,
            c.phone as client_phone,
            c.address as client_address,
            c.city as client_city,
            c.country as client_country,
            cs.company_name,
            cs.address as company_address,
            cs.city as company_city,
            cs.country as company_country,
            cs.phone as company_phone,
            cs.email as company_email,
            cs.website as company_website,
            cs.logo_path,
            cs.default_terms
        FROM invoices i
        LEFT JOIN clients c ON i.client_id = c.id
        LEFT JOIN company_settings cs ON cs.id = 1
        WHERE i.id = :invoice_id
    ";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':invoice_id', $invoice_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $invoice_data = $stmt->fetch();
    
    if (!$invoice_data) {
        die('Invoice not found');
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
    $invoice_data['items'] = $invoice_items;
    
    // Prepare company data
    $company_data = [
        'company_name' => $invoice_data['company_name'],
        'address' => $invoice_data['company_address'],
        'city' => $invoice_data['company_city'],
        'country' => $invoice_data['company_country'],
        'phone' => $invoice_data['company_phone'],
        'email' => $invoice_data['company_email'],
        'website' => $invoice_data['company_website'],
        'logo_path' => $invoice_data['logo_path'],
        'default_terms' => $invoice_data['default_terms']
    ];
    
    // Check if TCPDF is available
    $use_tcpdf = class_exists('TCPDF');
    
    if ($use_tcpdf) {
        // Use TCPDF for professional PDF generation
        $pdf = new InvoicePDF($invoice_data, $company_data);
        $pdf_content = $pdf->generateInvoice();
        
        // Output PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="Invoice_' . $invoice_data['invoice_number'] . '.pdf"');
        header('Content-Length: ' . strlen($pdf_content));
        echo $pdf_content;
    } else {
        // Fallback to HTML version that can be printed or converted
        $pdf = new SimpleInvoicePDF($invoice_data, $company_data);
        $html_content = $pdf->generateInvoice();
        
        // Add print styles and auto-print JavaScript
        $html_content = str_replace('</head>', '
            <script>
                window.onload = function() {
                    if (confirm("Would you like to print this invoice?")) {
                        window.print();
                    }
                }
            </script>
            </head>', $html_content);
        
        header('Content-Type: text/html; charset=UTF-8');
        echo $html_content;
    }
    
} catch (Exception $e) {
    die('Error generating PDF: ' . $e->getMessage());
}
?>
