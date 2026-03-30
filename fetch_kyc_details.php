<?php
// 🔹 DB CONNECTION
$host = "localhost";
$db   = "digio";
$user = "digio";
$pass = "G7NZeLzDifwTMgY8aWKm";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// 🔹 Digio Credentials
$client_id = "ACK2602171800147694APPDWP1ZWIHQ9";
$client_secret = "C4E91IFQG8O66DVLFX4C1Q7QZNJZ6KAG";

// 👉 Get KYC ID from URL
$digio_id = $_GET['id'] ?? '';

$responseData = "";
$statusMessage = "";

if($digio_id){

    $url = "https://ext.digio.in:444/client/kyc/v2/".$digio_id."/response";

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, $client_id . ":" . $client_secret);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Accept: application/json"
    ]);

    $response = curl_exec($ch);

    if(curl_errno($ch)){
        $responseData = "cURL Error: " . curl_error($ch);
    }else{

        $responseData = $response;
        $apiResponse = json_decode($response, true);

        if(isset($apiResponse['status'])){

            $kyc_status = $apiResponse['status'];
            $updated_at = $apiResponse['updated_at'];
            $response_json = json_encode($apiResponse);

            // 🔹 UPDATE DB
            $stmt = $conn->prepare("
                UPDATE kyc_requests 
                SET kyc_status=?, kyc_response=?, updated_at=? 
                WHERE digio_id=?
            ");

            $stmt->bind_param(
                "ssss",
                $kyc_status,
                $response_json,
                $updated_at,
                $digio_id
            );

            $stmt->execute();
            $stmt->close();

            $statusMessage = "KYC Status Updated Successfully ✅";
        }
    }

    curl_close($ch);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Fetch KYC Details</title>
<style>
body{font-family:Arial;margin:40px;}
.success{background:#d4edda;color:#155724;padding:12px;margin-bottom:20px;border-radius:5px;}
.response{background:#f4f4f4;padding:15px;}
</style>
</head>
<body>

<h2>Fetch KYC Details</h2>

<form method="GET">
    <label>Enter Digio KYC ID</label><br>
    <input type="text" name="id" value="<?php echo htmlspecialchars($digio_id); ?>" required style="width:300px;padding:8px;">
    <button type="submit" style="padding:8px 15px;">Fetch</button>
</form>

<?php if($statusMessage): ?>
<div class="success"><?php echo $statusMessage; ?></div>
<?php endif; ?>

<?php if($responseData): ?>
<div class="response">
    <strong>API Response:</strong>
    <pre><?php echo htmlspecialchars($responseData); ?></pre>
</div>
<?php endif; ?>

</body>
</html>