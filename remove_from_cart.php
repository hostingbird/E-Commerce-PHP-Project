<?php include ("partials/session.php") ?>
<?php include ('confi.php');
include ("partials/validation.php");
include ("errorReport.php");
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['product_id'])) {
        $productId = $data['product_id'];
        require ('confi.php');

        // Delete product from the database
        $sql = "DELETE FROM cart WHERE product_id = ? AND status = 'active'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false]);
    }
}
?>