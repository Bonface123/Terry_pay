<?php
/**
 * Invoice PDF Generator
 * Pwani Safaris Invoice Management System
 */

require_once __DIR__ . '/../vendor/autoload.php'; // For TCPDF via Composer
// If TCPDF is not installed via Composer, download and include manually:
// require_once '../libs/tcpdf/tcpdf.php';

class InvoicePDF extends TCPDF {
    private $invoice_data;
    private $company_data;
    
    public function __construct($invoice_data, $company_data) {
        parent::__construct();
        $this->invoice_data = $invoice_data;
        $this->company_data = $company_data;
        
        // Set document information
        $this->SetCreator('Pwani Safaris Invoice System');
        $this->SetAuthor('Pwani Safaris');
        $this->SetTitle('Invoice #' . $invoice_data['invoice_number']);
        $this->SetSubject('Invoice');
        
        // Set margins
        $this->SetMargins(20, 30, 20);
        $this->SetHeaderMargin(10);
        $this->SetFooterMargin(15);
        
        // Set auto page breaks
        $this->SetAutoPageBreak(TRUE, 25);
        
        // Set font
        $this->SetFont('helvetica', '', 10);
    }
    
    public function Header() {
        // Company logo (if exists)
        if (!empty($this->company_data['logo_path']) && file_exists($this->company_data['logo_path'])) {
            $this->Image($this->company_data['logo_path'], 20, 15, 30, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }
        
        // Company name and details
        $this->SetFont('helvetica', 'B', 20);
        $this->SetTextColor(0, 119, 182); // Primary color
        $this->Cell(0, 15, $this->company_data['company_name'], 0, 1, 'R');
        
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(61, 61, 61); // Text dark color
        $this->Cell(0, 5, $this->company_data['address'], 0, 1, 'R');
        $this->Cell(0, 5, $this->company_data['city'] . ', ' . $this->company_data['country'], 0, 1, 'R');
        $this->Cell(0, 5, 'Phone: ' . $this->company_data['phone'], 0, 1, 'R');
        $this->Cell(0, 5, 'Email: ' . $this->company_data['email'], 0, 1, 'R');
        if (!empty($this->company_data['website'])) {
            $this->Cell(0, 5, 'Web: ' . $this->company_data['website'], 0, 1, 'R');
        }
        
        $this->Ln(10);
    }
    
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->SetTextColor(128, 128, 128);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 0, 'C');
    }
    
    public function generateInvoice() {
        $this->AddPage();
        
        // Invoice title
        $this->SetFont('helvetica', 'B', 24);
        $this->SetTextColor(0, 119, 182);
        $this->Cell(0, 15, 'INVOICE', 0, 1, 'L');
        
        $this->Ln(5);
        
        // Invoice details and client info
        $this->invoiceDetails();
        
        $this->Ln(10);
        
        // Invoice items table
        $this->invoiceItemsTable();
        
        $this->Ln(10);
        
        // Payment terms and notes
        $this->paymentTerms();
        
        return $this->Output('Invoice_' . $this->invoice_data['invoice_number'] . '.pdf', 'S');
    }
    
    private function invoiceDetails() {
        // Left side - Invoice details
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(61, 61, 61);
        $this->Cell(95, 8, 'Invoice Details', 0, 0, 'L');
        
        // Right side - Bill to
        $this->Cell(95, 8, 'Bill To', 0, 1, 'L');
        
        $this->SetFont('helvetica', '', 10);
        
        // Invoice details column
        $this->Cell(95, 6, 'Invoice Number: ' . $this->invoice_data['invoice_number'], 0, 0, 'L');
        
        // Client details column
        $this->Cell(95, 6, $this->invoice_data['client_name'], 0, 1, 'L');
        
        $this->Cell(95, 6, 'Invoice Date: ' . date('F j, Y', strtotime($this->invoice_data['invoice_date'])), 0, 0, 'L');
        if (!empty($this->invoice_data['client_address'])) {
            $this->Cell(95, 6, $this->invoice_data['client_address'], 0, 1, 'L');
        } else {
            $this->Cell(95, 6, '', 0, 1, 'L');
        }
        
        $this->Cell(95, 6, 'Due Date: ' . date('F j, Y', strtotime($this->invoice_data['due_date'])), 0, 0, 'L');
        if (!empty($this->invoice_data['client_city'])) {
            $this->Cell(95, 6, $this->invoice_data['client_city'] . ', ' . $this->invoice_data['client_country'], 0, 1, 'L');
        } else {
            $this->Cell(95, 6, '', 0, 1, 'L');
        }
        
        $this->Cell(95, 6, 'Status: ' . ucfirst($this->invoice_data['status']), 0, 0, 'L');
        if (!empty($this->invoice_data['client_email'])) {
            $this->Cell(95, 6, 'Email: ' . $this->invoice_data['client_email'], 0, 1, 'L');
        } else {
            $this->Cell(95, 6, '', 0, 1, 'L');
        }
        
        $this->Cell(95, 6, '', 0, 0, 'L');
        if (!empty($this->invoice_data['client_phone'])) {
            $this->Cell(95, 6, 'Phone: ' . $this->invoice_data['client_phone'], 0, 1, 'L');
        } else {
            $this->Cell(95, 6, '', 0, 1, 'L');
        }
    }
    
    private function invoiceItemsTable() {
        // Table header
        $this->SetFont('helvetica', 'B', 10);
        $this->SetFillColor(0, 119, 182); // Primary color
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(0, 119, 182);
        
        $this->Cell(80, 8, 'Description', 1, 0, 'L', true);
        $this->Cell(20, 8, 'Qty', 1, 0, 'C', true);
        $this->Cell(30, 8, 'Unit Price', 1, 0, 'R', true);
        $this->Cell(30, 8, 'Total', 1, 1, 'R', true);
        
        // Table content
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(61, 61, 61);
        $this->SetFillColor(248, 249, 250); // Light background
        
        $fill = false;
        foreach ($this->invoice_data['items'] as $item) {
            $this->Cell(80, 8, $item['item_description'], 1, 0, 'L', $fill);
            $this->Cell(20, 8, $item['quantity'], 1, 0, 'C', $fill);
            $this->Cell(30, 8, 'KSh ' . number_format($item['unit_price'], 2), 1, 0, 'R', $fill);
            $this->Cell(30, 8, 'KSh ' . number_format($item['total_price'], 2), 1, 1, 'R', $fill);
            $fill = !$fill;
        }
        
        // Totals section
        $this->Ln(5);
        
        // Subtotal
        $this->Cell(130, 8, '', 0, 0, 'L');
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(30, 8, 'Subtotal:', 0, 0, 'R');
        $this->Cell(30, 8, 'KSh ' . number_format($this->invoice_data['subtotal'], 2), 1, 1, 'R');
        
        // Tax
        if ($this->invoice_data['tax_amount'] > 0) {
            $this->Cell(130, 8, '', 0, 0, 'L');
            $this->Cell(30, 8, 'VAT (' . $this->invoice_data['tax_rate'] . '%):', 0, 0, 'R');
            $this->Cell(30, 8, 'KSh ' . number_format($this->invoice_data['tax_amount'], 2), 1, 1, 'R');
        }
        
        // Total
        $this->Cell(130, 8, '', 0, 0, 'L');
        $this->SetFont('helvetica', 'B', 12);
        $this->SetFillColor(0, 119, 182);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(30, 10, 'TOTAL:', 1, 0, 'R', true);
        $this->Cell(30, 10, 'KSh ' . number_format($this->invoice_data['total_amount'], 2), 1, 1, 'R', true);
    }
    
    private function paymentTerms() {
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(61, 61, 61);
        $this->Cell(0, 10, 'Payment Terms & Notes', 0, 1, 'L');
        
        $this->SetFont('helvetica', '', 10);
        
        if (!empty($this->invoice_data['terms_conditions'])) {
            $this->MultiCell(0, 6, $this->invoice_data['terms_conditions'], 0, 'L');
        } else {
            $this->MultiCell(0, 6, $this->company_data['default_terms'], 0, 'L');
        }
        
        if (!empty($this->invoice_data['notes'])) {
            $this->Ln(5);
            $this->SetFont('helvetica', 'B', 10);
            $this->Cell(0, 8, 'Additional Notes:', 0, 1, 'L');
            $this->SetFont('helvetica', '', 10);
            $this->MultiCell(0, 6, $this->invoice_data['notes'], 0, 'L');
        }
        
        // Thank you message
        $this->Ln(10);
        $this->SetFont('helvetica', 'I', 12);
        $this->SetTextColor(42, 157, 143); // Accent color
        $this->Cell(0, 10, 'Thank you for choosing Pwani Safaris!', 0, 1, 'C');
        
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(61, 61, 61);
        $this->Cell(0, 6, 'Experience authentic coastal adventures with us.', 0, 1, 'C');
    }
}

/**
 * Simple PDF Generator (fallback if TCPDF is not available)
 */
class SimpleInvoicePDF {
    private $invoice_data;
    private $company_data;
    
    public function __construct($invoice_data, $company_data) {
        $this->invoice_data = $invoice_data;
        $this->company_data = $company_data;
    }
    
    public function generateInvoice() {
        // Generate HTML content for PDF conversion
        $html = $this->generateHTML();
        
        // Use DomPDF or similar library if available
        // For now, return HTML that can be printed or converted
        return $html;
    }
    
    private function generateHTML() {
        ob_start();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Invoice #<?php echo htmlspecialchars($this->invoice_data['invoice_number']); ?></title>
            <style>
                body { font-family: Arial, sans-serif; margin: 0; padding: 20px; color: #3D3D3D; }
                .header { border-bottom: 2px solid #0077B6; padding-bottom: 20px; margin-bottom: 30px; }
                .company-name { color: #0077B6; font-size: 24px; font-weight: bold; margin-bottom: 10px; }
                .invoice-title { color: #0077B6; font-size: 28px; font-weight: bold; margin: 20px 0; }
                .invoice-details { display: flex; justify-content: space-between; margin-bottom: 30px; }
                .invoice-details div { width: 48%; }
                .invoice-details h3 { color: #3D3D3D; border-bottom: 1px solid #ddd; padding-bottom: 5px; }
                table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                th { background-color: #0077B6; color: white; padding: 12px; text-align: left; }
                td { padding: 10px; border-bottom: 1px solid #ddd; }
                .total-row { background-color: #f8f9fa; font-weight: bold; }
                .grand-total { background-color: #0077B6; color: white; font-weight: bold; }
                .terms { margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 5px; }
                .footer { text-align: center; margin-top: 40px; color: #2A9D8F; font-style: italic; }
                @media print { body { margin: 0; } }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="company-name"><?php echo htmlspecialchars($this->company_data['company_name']); ?></div>
                <div><?php echo htmlspecialchars($this->company_data['address']); ?></div>
                <div><?php echo htmlspecialchars($this->company_data['city'] . ', ' . $this->company_data['country']); ?></div>
                <div>Phone: <?php echo htmlspecialchars($this->company_data['phone']); ?></div>
                <div>Email: <?php echo htmlspecialchars($this->company_data['email']); ?></div>
            </div>
            
            <div class="invoice-title">INVOICE</div>
            
            <div class="invoice-details">
                <div>
                    <h3>Invoice Details</h3>
                    <p><strong>Invoice Number:</strong> <?php echo htmlspecialchars($this->invoice_data['invoice_number']); ?></p>
                    <p><strong>Invoice Date:</strong> <?php echo date('F j, Y', strtotime($this->invoice_data['invoice_date'])); ?></p>
                    <p><strong>Due Date:</strong> <?php echo date('F j, Y', strtotime($this->invoice_data['due_date'])); ?></p>
                    <p><strong>Status:</strong> <?php echo ucfirst($this->invoice_data['status']); ?></p>
                </div>
                <div>
                    <h3>Bill To</h3>
                    <p><strong><?php echo htmlspecialchars($this->invoice_data['client_name']); ?></strong></p>
                    <?php if (!empty($this->invoice_data['client_address'])): ?>
                    <p><?php echo htmlspecialchars($this->invoice_data['client_address']); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($this->invoice_data['client_city'])): ?>
                    <p><?php echo htmlspecialchars($this->invoice_data['client_city'] . ', ' . $this->invoice_data['client_country']); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($this->invoice_data['client_email'])): ?>
                    <p>Email: <?php echo htmlspecialchars($this->invoice_data['client_email']); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($this->invoice_data['client_phone'])): ?>
                    <p>Phone: <?php echo htmlspecialchars($this->invoice_data['client_phone']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Unit Price</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->invoice_data['items'] as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['item_description']); ?></td>
                        <td style="text-align: center;"><?php echo $item['quantity']; ?></td>
                        <td style="text-align: right;">KSh <?php echo number_format($item['unit_price'], 2); ?></td>
                        <td style="text-align: right;">KSh <?php echo number_format($item['total_price'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right;"><strong>Subtotal:</strong></td>
                        <td style="text-align: right;"><strong>KSh <?php echo number_format($this->invoice_data['subtotal'], 2); ?></strong></td>
                    </tr>
                    <?php if ($this->invoice_data['tax_amount'] > 0): ?>
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right;"><strong>VAT (<?php echo $this->invoice_data['tax_rate']; ?>%):</strong></td>
                        <td style="text-align: right;"><strong>KSh <?php echo number_format($this->invoice_data['tax_amount'], 2); ?></strong></td>
                    </tr>
                    <?php endif; ?>
                    <tr class="grand-total">
                        <td colspan="3" style="text-align: right;"><strong>TOTAL:</strong></td>
                        <td style="text-align: right;"><strong>KSh <?php echo number_format($this->invoice_data['total_amount'], 2); ?></strong></td>
                    </tr>
                </tbody>
            </table>
            
            <div class="terms">
                <h3>Payment Terms & Notes</h3>
                <?php if (!empty($this->invoice_data['terms_conditions'])): ?>
                <p><?php echo nl2br(htmlspecialchars($this->invoice_data['terms_conditions'])); ?></p>
                <?php else: ?>
                <p><?php echo nl2br(htmlspecialchars($this->company_data['default_terms'])); ?></p>
                <?php endif; ?>
                
                <?php if (!empty($this->invoice_data['notes'])): ?>
                <h4>Additional Notes:</h4>
                <p><?php echo nl2br(htmlspecialchars($this->invoice_data['notes'])); ?></p>
                <?php endif; ?>
            </div>
            
            <div class="footer">
                <p><strong>Thank you for choosing Pwani Safaris!</strong></p>
                <p>Experience authentic coastal adventures with us.</p>
            </div>
        </body>
        </html>
        <?php
        return ob_get_clean();
    }
}
?>
