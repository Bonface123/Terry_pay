<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Terry Pay - Hospital Payment</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
  <div class="bg-white p-8 rounded-2xl shadow-lg w-96 text-center">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">💳 Terry Pay</h1>
    <form id="paymentForm" class="space-y-4">
      <div>
        <label class="block text-left mb-1 font-medium text-gray-600">Phone Number (254...)</label>
        <input type="text" name="phone" required class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label class="block text-left mb-1 font-medium text-gray-600">Amount (KES)</label>
        <input type="number" name="amount" required class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-400">
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
        Pay Now
      </button>
    </form>
    <p id="responseMsg" class="mt-4 text-green-700 text-sm"></p>
  </div>

  <script src="assets/js/main.js"></script>
</body>
</html>
