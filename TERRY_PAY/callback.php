<?php
include 'config/db_connect.php';
include 'includes/functions.php';

$data = file_get_contents('php://input');
$transaction = json_decode($data, true);

if (isset($transaction['Body']['stkCallback'])) {
    $callback = $transaction['Body']['stkCallback'];
    $resultCode = $callback['ResultCode'];

    if ($resultCode == 0) {
        $amount = $callback['CallbackMetadata']['Item'][0]['Value'];
        $mpesa_receipt = $callback['CallbackMetadata']['Item'][1]['Value'];
        $phone = $callback['CallbackMetadata']['Item'][4]['Value'];
        updateTransaction($conn, $phone, 'Success', $mpesa_receipt);
    } else {
        $phone = $callback['CallbackMetadata']['Item'][4]['Value'] ?? '';
        updateTransaction($conn, $phone, 'Failed');
    }
}
?>
