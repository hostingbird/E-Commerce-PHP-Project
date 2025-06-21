<?php include("partials/session.php") ?>
<?php include('confi.php');
include("partials/validation.php");
include("errorReport.php");
?>
<?php
header('Content-Type: application/json');

$response = ['status' => 'error'];

$user_id = $HDFuser['id'] ?? null;

if ($user_id) {

    try {
        $stmt = $conn->prepare("SELECT 
                                c.product_id, 
                                p.product_name, 
                                c.price AS product_price, 
                                c.quantity AS product_quantity, 
                                p.product_banner, 
                                p.product_brand,
                                p.product_unit 
                            FROM 
                                cart c 
                            JOIN 
                                product p 
                            ON 
                                c.product_id = p.product_id 
                            WHERE 
                                c.user_id = ? AND status = 'active' ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $cart = [];
        while ($row = $result->fetch_assoc()) {
            $cart[] = [
                'product_id' => $row['product_id'],
                'name' => $row['product_name'],
                'price' => $row['product_price'],
                'quantity' => $row['product_quantity'],
                'quantityType' => $row['product_unit'],
                'banner' => $row['product_banner'],
                'brand' => $row['product_brand']
            ];
        }

        $response['status'] = 'success';
        $response['data'] = $cart;
    } catch (Exception $e) {
        $response['message'] = 'An error occurred: ' . $e->getMessage();
    }

    echo json_encode($response);
}


?>