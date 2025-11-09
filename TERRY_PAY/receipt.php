<?php
include 'config/db_connect.php';
$result = $conn->query("SELECT * FROM transactions ORDER BY id DESC LIMIT 1");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Receipt - Terry Pay</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex justify-center items-center h-screen">
  <div class="bg-white shadow-xl p-6 rounded-2xl w-96 text-center">
    <h2 class="text-2xl font-bold text-green-600 mb-4">✅ Payment Successful</h2>
    <div class="text-gray-700 space-y-1">
      <p><strong>Phone:</strong> <?= $row['phone'] ?></p>
      <p><strong>Amount:</strong> KES <?= $row['amount'] ?></p>
      <p><strong>Receipt:</strong> <?= $row['mpesa_receipt'] ?></p>
      <p><strong>Date:</strong> <?= $row['transaction_date'] ?></p>
      <p><strong>Status:</strong> <?= $row['status'] ?></p>
    </div>
    <button onclick="window.print()" class="mt-5 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
      Download / Print
    </button>
  </div>
</body>
</html>
