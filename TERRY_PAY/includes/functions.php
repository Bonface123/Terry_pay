<?php
if (!function_exists('saveTransaction')) {
    function saveTransaction($conn, $phone, $amount) {
        $sql = "INSERT INTO transactions (phone, amount, status) VALUES (?, ?, 'Pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sd", $phone, $amount);
        $stmt->execute();
    }
}

if (!function_exists('updateTransaction')) {
    function updateTransaction($conn, $phone, $status, $receipt = null) {
        $sql = "UPDATE transactions SET status=?, mpesa_receipt=? WHERE phone=? ORDER BY id DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $status, $receipt, $phone);
        $stmt->execute();
    }
}
?>
