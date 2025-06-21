<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../partials/session.php");
include("../confi.php");
include("../partials/validation.php");
checkUserAuthentication();

$userId = (string) $HDFuser['id'];


$stmt = $conn->prepare("SELECT * FROM cashfree_payment WHERE user_id = ?");
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

if ($result->num_rows > 0) {
    $orders = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($orders as &$order) {
        $cartData = explode(",", $order['cartData']);
        $order['products'] = [];

        foreach ($cartData as $productId) {
            $stmtProduct = $conn->prepare("SELECT 
                                                c.product_id, 
                                                c.quantity, 
                                                p.product_name, 
                                                p.product_price, 
                                                p.product_brand, 
                                                p.product_banner, 
                                                p.product_unit 
                                            FROM 
                                                cart c 
                                            JOIN 
                                                product p 
                                            ON 
                                                c.product_id = p.product_id
                                            WHERE 
                                                c.user_id = ? AND c.status = 'conform' AND c.product_id = ?");
            $stmtProduct->bind_param("ii", $userId, $productId);
            $stmtProduct->execute();
            $resultProduct = $stmtProduct->get_result();

            if ($resultProduct->num_rows > 0) {
                $order['products'][] = $resultProduct->fetch_assoc();

            }
            $stmtProduct->close();
        }
    }
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($orders);
?>