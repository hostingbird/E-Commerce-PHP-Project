<?php include ("partials/session.php") ?>
<?php include ('confi.php');
include ("partials/validation.php");
include ("errorReport.php");?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = json_decode(file_get_contents('php://input'), true);
    $userId = $HDFuser['id'];
    $fieldName = isset($postData['fieldName']) ? strtolower(trim($postData['fieldName'])) : '';
    $fieldValue = isset($postData['fieldValue']) ? strtolower(trim($postData['fieldValue'])) : '';

    if(!$fieldValue){
          echo json_encode(['status' => 'error', 'message' => 'Invalid Value']);
    }else{
        switch ($fieldName) {
        case 'full_name':
            $stmt = $conn->prepare("UPDATE user SET name = ? WHERE id = ?");
            $stmt->bind_param("si", $fieldValue, $userId);
            break;
        case 'dob':
            $stmt = $conn->prepare("UPDATE user SET dob = ? WHERE id = ?");
            $stmt->bind_param("si", $fieldValue, $userId);
            break;
        case 'gender':
            $stmt = $conn->prepare("UPDATE user SET gender = ? WHERE id = ?");
            $stmt->bind_param("si", $fieldValue, $userId);
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid field name']);
            exit;
    }
    }
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Profile updated']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update profile']);
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}
?>
