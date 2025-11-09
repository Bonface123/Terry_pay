document.querySelector("#paymentForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  const formData = new FormData(e.target);
  const responseMsg = document.getElementById("responseMsg");

  responseMsg.textContent = "Processing payment...";

  try {
    const res = await fetch("mpesa/stk_push.php", {
      method: "POST",
      body: formData
    });

    const data = await res.json();

    if (data.ResponseCode === "0") {
      responseMsg.textContent = "STK Push sent. Enter PIN on your phone.";
    } else {
      responseMsg.textContent = "Error: " + (data.errorMessage || "Unable to initiate payment.");
    }
  } catch (err) {
    responseMsg.textContent = "Network error: " + err.message;
  }
});
