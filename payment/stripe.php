<?php
require '../config/config.php';
require '../vendor/autoload.php';

\Stripe\Stripe::setApiKey('STRIPE_SECRET_KEY');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'] * 100;

    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $amount,
        'currency' => 'usd',
        'payment_method_types' => ['card'],
    ]);

    echo json_encode(['client_secret' => $paymentIntent->client_secret]);
}
?>

<form method="post">
    <input type="number" name="amount" placeholder="To‘lov summasi" required><br>
    <button type="submit">Stripe orqali to‘lash</button>
</form>
