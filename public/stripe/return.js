initialize();

async function initialize() {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const sessionId = urlParams.get('session_id');
  const response = await fetch("/gonzaleze/backend_2/public/stripe/status.php", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "POST",
    body: JSON.stringify({ session_id: sessionId }),
  });
  const session = await response.json();

  if (session.status == 'open') {

    // window.location.replace('http://localhost:8000/checkout.html')
    window.location.replace('https://ruizgijon.ddns.net/gonzaleze/backend_2/public/stripe/checkout.html')

  } else if (session.status == 'complete') {
    document.getElementById('success').classList.remove('hidden');
    document.getElementById('customer-email').textContent = session.customer_email
  }
}