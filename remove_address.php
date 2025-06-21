<?php include ("partials/session.php") ?>
<?php include ('confi.php');
include ("partials/validation.php"); 
include ("errorReport.php");
?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $address_id = $data['address_id'];
    $user_id = $HDFuser['id'];
    
    $stmt = $conn->prepare("UPDATE address_book SET is_deleted = 1 WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $address_id , $user_id);
// $stmt->execute();


//     $stmt = $conn->prepare("DELETE FROM address_book WHERE id = ? AND user_id = ?");
//     $stmt->bind_param('ii', $address_id, $user_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
