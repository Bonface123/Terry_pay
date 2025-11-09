<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../config/db_connect.php';
include '../includes/functions.php';
include 'access_token.php';
include 'credentials.php';

if (empty($_POST['phone']) || empty($_POST['amount'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing phone or amount']);
    exit;
}

$phone = $_POST['phone'];
$amount = $_POST['amount'];

try {
    // Save transaction
    saveTransaction($conn, $phone, $amount);

    // Get access token
    $access_token = generateAccessToken();
    if (!$access_token) {
        throw new Exception('Failed to generate access token');
    }

    $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $timestamp = date('YmdHis');
    $password = base64_encode(SHORTCODE . PASSKEY . $timestamp);

    $curl_post_data = [
        'BusinessShortCode' => SHORTCODE,
        'Password' => $password,
        'Timestamp' => $timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $amount,
        'PartyA' => $phone,
        'PartyB' => SHORTCODE,
        'PhoneNumber' => $phone,
        'CallBackURL' => CALLBACK_URL,
        'AccountReference' => 'TerryPay',
        'TransactionDesc' => 'Hospital Bill Payment'
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => [
            'Content-Type:application/json',
            'Authorization:Bearer ' . $access_token
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($curl_post_data),
        CURLOPT_TIMEOUT => 30
    ]);

    $response = curl_exec($curl);
    if ($response === false) {
        throw new Exception('cURL Error: ' . curl_error($curl));
    }
    curl_close($curl);

    echo $response;

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
