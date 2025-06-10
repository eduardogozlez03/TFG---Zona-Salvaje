// This is your test secret API key.
const stripe = Stripe("pk_test_51RPMiQ2UNE80AybWcwu055kZsc5pc92kvgs7Q7AnGkUc2QTK5qmcoLOyAvwiQrOwPFNkW2hbHBd5GK0gW4CqsKwO00PhpDSxBA");

initialize();

// Create a Checkout Session
async function initialize() {
  const fetchClientSecret = async () => {
    const response = await fetch("/stripe/checkout.php", {
      method: "POST",
    });
    const { clientSecret } = await response.json();
    return clientSecret;
  };

  const checkout = await stripe.initEmbeddedCheckout({
    fetchClientSecret,
  });

  // Mount Checkout
  checkout.mount('#checkout');
}