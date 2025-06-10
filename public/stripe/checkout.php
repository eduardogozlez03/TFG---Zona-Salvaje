<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../vendor/autoload.php';
require_once '../stripe/secrets.php';

\Stripe\Stripe::setVerifySslCerts(false);

$stripe = new \Stripe\StripeClient($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:8000/subscription/success?subscription=vip';

$checkout_session = $stripe->checkout->sessions->create([
  'ui_mode' => 'embedded',
  'line_items' => [[
    # Provide the exact Price ID (e.g. price_1234) of the product you want to sell
    'price' => 'price_1RPkNJ2UNE80AybWvnCwJqHK',
    'quantity' => 1,
  ]],
  'mode' => 'subscription',
   'return_url' => $YOUR_DOMAIN, //. '/stripe/return.html?session_id={CHECKOUT_SESSION_ID}',
]);

  echo json_encode(array('clientSecret' => $checkout_session->client_secret));








