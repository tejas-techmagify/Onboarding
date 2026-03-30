<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 🔹 DB CONNECTION
$host = "localhost";
$db   = "digio";
$user = "digio";
$pass = "G7NZeLzDifwTMgY8aWKm";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// 👉 Digio Credentials
$client_id = "ACK2602171800147694APPDWP1ZWIHQ9";
$client_secret = "C4E91IFQG8O66DVLFX4C1Q7QZNJZ6KAG";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $customer_identifier = $_POST['customer_identifier'];
    $customer_name = $_POST['customer_name'];

    $reference_id = "REF" . time();
    $transaction_id = "TXN" . time();

    $url = "https://ext.digio.in:444/client/kyc/v2/request/with_template";

    $payload = json_encode([
        "customer_identifier" => $customer_identifier,
        "customer_name" => $customer_name,
        "template_name" => "KYC Digio",
        "notify_customer" => true,
        "expire_in_days" => 10,
        "generate_access_token" => true,
        "reference_id" => $reference_id,
        "transaction_id" => $transaction_id,
        "generate_deeplink_info" => true
    ]);

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
        CURLOPT_USERPWD => $client_id . ":" . $client_secret,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Accept: application/json"
        ]
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $errorMessage = "cURL Error: " . curl_error($ch);
    } else {

        $apiResponse = json_decode($response, true);

        // ❌ API ERROR
        if(isset($apiResponse['error'])) {
            $errorMessage = "API Error: " . $apiResponse['error']['message'];
        }
        // ✅ SUCCESS
        elseif(isset($apiResponse['id'])) {

            $stmt = $conn->prepare("
                INSERT INTO digio_kyc_requests
                (digio_request_id, reference_id, transaction_id, customer_name, customer_identifier,
                 status, workflow_name, template_id, expire_in_days,
                 access_token_id, access_token_valid_till, api_response, digio_created_at)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)
            ");

            $digio_request_id = $apiResponse['id'];
            $status = $apiResponse['status'] ?? null;
            $workflow_name = $apiResponse['workflow_name'] ?? null;
            $template_id = $apiResponse['template_id'] ?? null;
            $expire_in_days = $apiResponse['expire_in_days'] ?? null;
            $access_token_id = $apiResponse['access_token']['id'] ?? null;
            $access_token_valid_till = $apiResponse['access_token']['valid_till'] ?? null;
            $digio_created_at = $apiResponse['created_at'] ?? null;
            $api_json = json_encode($apiResponse);

            $stmt->bind_param(
                "sssssssssssss",
                $digio_request_id,
                $reference_id,
                $transaction_id,
                $customer_name,
                $customer_identifier,
                $status,
                $workflow_name,
                $template_id,
                $expire_in_days,
                $access_token_id,
                $access_token_valid_till,
                $api_json,
                $digio_created_at
            );

            if($stmt->execute()){
                $successMessage = "Your KYC request has been sent. Please check email/mobile.";
            } else {
                $errorMessage = "DB Insert Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $errorMessage = "Unexpected API response: " . $response;
        }
    }

    curl_close($ch);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Digio KYC Request</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        form { width: 400px; }
        input, button { width: 100%; padding: 10px; margin: 8px 0; }
        .success { background:#d4edda;color:#155724;padding:12px;margin-top:15px;border-radius:5px; }
        .error { background:#f8d7da;color:#721c24;padding:12px;margin-top:15px;border-radius:5px; }
    </style>
</head>
<body>

<h2>Create KYC Request</h2>

<form method="POST">
    <label>Email / Mobile</label>
    <input type="text" name="customer_identifier" required>

    <label>Name</label>
    <input type="text" name="customer_name" required>

    <button type="submit">Create KYC</button>
</form>

<?php if($successMessage): ?>
<div class="success"><?= $successMessage ?></div>
<script>
setTimeout(()=>{ window.location.href = window.location.pathname; },10000);
</script>
<?php endif; ?>

<?php if($errorMessage): ?>
<div class="error"><?= $errorMessage ?></div>
<?php endif; ?>

</body>
</html>
