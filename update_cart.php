<?php include ("partials/session.php");  ?>
<?php include ('confi.php');
include ("partials/validation.php");
include ("errorReport.php"); ?>
<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['product'])) {
    header('Content-Type: text/html');
    echo "exemption error : Page load failed or page not found";
    exit;
}
$product = $data['product'];
$user_id = $HDFuser['id'];
if (!$user_id) {
    echo json_encode(['status' => 'error', 'message' => 'Please Login/signup First to add products']);
    exit;
}

$product_id = $product['product_id'];
$action = $data['action'];

$response = ["status" => "error"];

try {
    if ($action === 'add') {
        if (!isset($product['quantity'], $product['price'],$product['quantity_type'], $product['ip'])) {
            $response['message'] = 'Required fields are missing for adding product';
            echo json_encode($response);
            exit;
        }

        $quantity = $product['quantity'];
        $price = $product['price'];
        $date = date('Y-m-d');
        $quantity_type = $product['quantity_type'];
        $ip = $product['ip'];
        $status = 'active';

        // Check if the product is already in the cart
        $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ? AND status = ?");
        $stmt->bind_param("iis", $user_id, $product_id , $status);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt = $conn->prepare("UPDATE cart SET quantity = quantity+ ? WHERE user_id = ? AND product_id = ?");
            $stmt->bind_param("iii", $quantity, $user_id, $product_id);
        } else {
            // Insert a new product into the cart if it doesn't exist
            $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, price, date, quantityValue, session_ip)
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiidsis", $user_id, $product_id, $quantity, $price, $date, $quantity_type, $ip);
        }

        if ($stmt->execute()) {
            $response['status'] = 'success';
        } else {
            error_log("Error adding product: " . $stmt->error);
            $response['message'] = 'Failed to execute adding product';
        }

        $stmt->close();
    } elseif ($action === 'update') {
        if (!isset($product['quantity'])) {
            $response['message'] = 'Quantity is missing for updating product';
            echo json_encode($response);
            exit;
        }

        $quantity = $product['quantity'];

        // Update the quantity of the product
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("iii", $quantity, $user_id, $product_id);

        if ($stmt->execute()) {
            $response['status'] = 'success';
        } else {
            error_log("Error executing query for updating product: " . $stmt->error);
            $response['message'] = 'Failed to execute query for updating product';
        }

        $stmt->close();
    } elseif ($action === 'remove') {
        // Remove the product from the cart
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $user_id, $product_id);

        if ($stmt->execute()) {
            $response['status'] = 'success';
        } else {
            error_log("Error executing query for removing product: " . $stmt->error);
            $response['message'] = 'Failed to execute query for removing product';
        }

        $stmt->close();
    } else {
        $response['message'] = 'Invalid action';
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = 'Exception: ' . $e->getMessage();
}
echo json_encode($response);
$conn->close();
?>