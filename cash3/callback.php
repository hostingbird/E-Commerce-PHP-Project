
<?php
include 'config.php';
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data) {
    $orderid=$data['data']['order']['order_id'];
    $payment_time=$data['data']['payment']['payment_time'];
    $orderStatus=$data['data']['payment']['payment_status'];
    
    /******** update payment Status **********/
    $tablename='cashfree_payment';

 $myQuery="UPDATE `".$tablename."` SET `payment_status`='".$orderStatus."',`payment_time`='".$payment_time."',`callback_response`='".$input."' where `order_id`='".$orderid."'";
 
mysqli_query($con,$myQuery);

/************** end payment status ***************/

    // Respond to the webhook sender
    http_response_code(200);
    echo json_encode(['status' => 'success']);
} else {
    // Invalid data
    http_response_code(400);
    echo json_encode(['status' => 'invalid data']);
}
?>
