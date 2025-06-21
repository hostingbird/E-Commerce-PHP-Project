<?php include ("partials/session.php") ?>
<?php include ('confi.php');
include ("partials/validation.php");
include ("errorReport.php");
?>

<?php

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $response = array("success" => false, "message" => "Unknown error occurred.");
    $userId = $HDFuser['id'];

    if (!empty($data['addresses']) && $userId) {
        $addresses = $data['addresses'];
        $time = time();
        $errors = [];

        foreach ($addresses as $address) {
            $name = isset($address['name']) ? htmlspecialchars(stripcslashes(trim($address['name']))) : "";
            $phone = isset($address['phone']) ? $address['phone'] : "";
            $tag = isset($address['tag']) ? $address['tag'] : "New";
            $line = isset($address['line']) ? htmlspecialchars(stripcslashes(trim($address['line']))) : "";
            $addressLine = isset($address['address']) ? htmlspecialchars(stripcslashes(trim($address['address']))) : "";
            $nearby = isset($address['nearby']) ? htmlspecialchars(stripcslashes(trim($address['nearby']))) : "";


            $stmt = $conn->prepare("INSERT INTO address_book (user_id, email, phone, tag, address_line, address, address_landmark, change_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssssi", $userId, $name, $phone, $tag, $line, $addressLine, $nearby, $time);

            if (!$stmt->execute()) {
                $errors[] =  $stmt->error;
            }
            $stmt->close();
        }

        if (empty($errors)) {
            $response = array("success" => true, "message" => "Addresses added successfully.");
        } else {
            $response = array("success" => false, "message" => implode(", ", $errors));
        }
    } else {
        $response = ["success" => false, "message" => "No address data provided or user not logged in"];
    }

    $conn->close();
    error_log("Response: " . json_encode($response));
    echo json_encode($response);

} else {
    $response = ["success" => false, "message" => "Invalid request method"];
    error_log("Response: " . json_encode($response));
    echo json_encode($response);
}
?>