
<?php
include('confi.php');
error_reporting(E_ALL);
ini_set("display_errors", 1)
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Status</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <style>
 body {
      font-family: 'Roboto', sans-serif;
      background-color: #f1f2f3;
      padding: 20px;
      margin: 0;
      user-select: none;
    }

    .material-symbols-rounded {
      font-variation-settings:
        'FILL' 1,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24;
    }

    .header {
      display: flex;
      align-items: center;
    }

    .header span {
      margin-right: 10px;
      color: black;
    }

    .header:hover span,
    .header:hover h1 {
      color: grey;
    }

    .invoice {
      max-width: 800px;
      margin: auto;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
      padding: 40px;
    }

    h1 {
      margin: 0;
      color: black;
      cursor: pointer;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #fff;
    }

    th,
    td {
      border-bottom: 1px solid #e0e0e0;
      padding: 16px;
      text-align: left;
    }

    th {
      background-color: #fff;
      color: black;
    }

    td {
      background-color: #fff;
      text-align: right;
    }

    .description-col {
      width: 35%;
    }

    .quantity-col,
    .price-col {
      width: 20%;
    }

    .total-col {
      width: 25%;
      text-align: right;
    }

    .totals {
      text-align: right;
      margin-top: 20px;
      position: relative;
    }

    .no-print {
      display: none;
    }

    @media print {
      .no-print {
        display: none !important;
      }
    }

    input[type="text"],
    input[type="number"] {
      width: calc(100%);
      box-sizing: border-box;
      word-wrap: break-word;
      margin-top: 4px;
      margin-bottom: 4px;
      border: none;
      border-bottom: 2px solid #f5f5f5;
      outline: none;
      background-color: transparent;
    }

    .add-row-btn,
    .rmw-row-btn,
    .print-row-btn,
    button {
      display: inline-block;
      margin-top: 20px;
      float: left;
      padding: 14px 28px;
      position: left;
      margin-right: 5px;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-size: 1em;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .add-row-btn {
      background-color: #189bcc;
    }

    .add-row-btn:hover {
      background-color: #4b4e6c;
    }

    .rmw-row-btn {
      background-color: #f68b70;
    }

    .rmw-row-btn:hover {
      background-color: #f35a33;
    }

    .print-row-btn {
      background-color: darkgrey;
    }

    .print-row-btn:hover {
      background-color: grey;
    }

    button {
      margin-top: 20px;
      display: block;
    }

    .footer {
      text-align: center;
      margin-top: 40px;
      font-size: 0.8em;
      color: #666;
    }

    .tax-field strong {
      margin-right: 10px;
      white-space: nowrap;
    }

    .tax-field input {
      width: 80px;
      margin-left: 5px;
    }

    .tax {
      display: flex;
    }
</style>
<?php 
if(isset($_GET['order_id']) && $_GET['order_id'] !=''){
$order_id=$_GET['order_id'];

$tablename='cashfree_payment';

 $myQuery="select * from `".$tablename."` where `order_id`='".$order_id."'";
 
$getRes=mysqli_query($conn,$myQuery);
$getData=mysqli_fetch_assoc($getRes);

if($getData){
$transactionId=$getData['cf_order_id'];
$amt=$getData['order_amount'];
$paymentstatus=$getData['payment_status'];
$name = $getData['customer_name'];
$user = intval($getData['user_id']);
$phone = $getData['customer_phone'];
$email = $getData['customer_email'];
$CC = $getData['callback_response'];
$odDate = $getData['payment_time'];
if($paymentstatus === "SUCCESS" || $paymentstatus === "COD"){
                $updateSql = "UPDATE `cart` SET `status` = 'conform' WHERE `user_id` = ?";
            if ($updateStmt = $conn->prepare($updateSql)) {
                // Bind parameters
                $updateStmt->bind_param("i", $user);
                
                if ($updateStmt->execute()) {
                    $updateStmt->close();
                    
?>

  <div class="invoice">
    <div class="header" onclick="location.href='index.php'">
      <span class="material-symbols-rounded" style="color:#16b29e">
        receipt_long
      </span>
      <h1 id="invoice-type" style="color:#16b29e">ORDER BILL</h1>
    </div>
    
    <p>Reciptent Name : <span style="color:#313133"><?php echo $name;?></span></p>
    <p>Order Date :- <span style="color:#313133"><?php echo $odDate;?></span></p>

    <table id="invoice-table">
      <thead>
        <tr>
          <th class="description-col">Order id</th>
          <th class="quantity-col">Phone</th>
          <th class="price-col">Email</th>
          <th class="total-col">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width:max-content;float:left;"><span><?php echo $transactionId?></span></td>
          <td><span><?php echo $phone?></span></td>
          <td><span><?php echo $email?></span></td>
          <td class="total"><?php echo $amt?> INR</td>
        </tr>
      </tbody>
    </table>

    <div class="totals">
      <button class="print-row-btn no-print" onclick="window.print()"><span class="material-symbols-rounded">
print
</span></button>
      <button class="print-row-btn no-print" onclick="#"><span class="material-symbols-rounded">
info
</span></button>
      <button class="print-row-btn no-print" onclick="#"><span class="material-symbols-rounded">
dashboard
</span></button>
   <?php $status = $paymentstatus==="SUCCESS" ? "paid" : "failed";?>
      <p style="font-size: 1.3em; font-weight: bold;"><span id="orderColor"><?php echo $CC === "" ? "COD" : $status;?></span></p>
    </div>
  </div>

  <div class="footer">
    <p>hdfgrocery.shop <span style= "vertical-align: middle; font-size: 1.3em;" class="material-symbols-rounded">
copyright
</span> 2024</p>
  </div>
  <script>
    let valueOFStatus = document.getElementById('orderColor');
    valueOFStatus.innerText === "paid" || valueOFStatus.innerText === "COD" ? valueOFStatus.style.color = "#16b29e" : valueOFStatus.style.color = "red";
</script>
<?php
                } else {
                    $updateStmt->close();
                    return 'Failed to update cart: ';
                }
            } else {
                return 'Failed to prepare cart update: ';
            }
}


}else{
    echo "Invalid Order";
}
} else{
echo "invalid order result failed";
}?>
</body>
</html>