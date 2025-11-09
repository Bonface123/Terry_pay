<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    include '../config/db_connect.php';
    include '../includes/functions.php';
    include 'access_token.php';
    include 'credentials.php';

    if (!isset($_POST['phone']) || !isset($_POST['amount'])) {
        echo json_encode(['status' => 'error', 'message' => 'Missing phone or amount']);
        exit;
    }

    $phone = $_POST['phone'];
    $amount = $_POST['amount'];

    // Save transaction as pending
    saveTransaction($conn, $phone, $amount);

    // Generate access token
    $access_token = generateAccessToken();
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
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type:application/json',
        'Authorization:Bearer ' . $access_token
    ]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($curl_post_data));
    $response = curl_exec($curl);

    if ($response === false) {
        throw new Exception(curl_error($curl));
    }

    echo $response;
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
