<?php
include 'config.php';
require_once '../global.php';
require_once '../env.php';
// Enter Your website domain url

$base_url = BASE_URL . "/cash3";


/******************* Cashfree API Details ***************/


// for live change it to "production" or "sandbox"
$base_url = BASE_URL;

$payMode = "sandbox"; //production/sandbox
if ($payMode == 'production') {

  // live api details

  define('client_id', $_ENV["CASH_PROD_Client"]);
  define('secret_key', $_ENV["CASH_PROD_SCR"]);

  $APIURL = "https://api.cashfree.com/pg/orders";

} else {

  // test api details
  define('client_id', $_ENV["CASH_TEST_Client"]);
  define('secret_key', $_ENV["CASH_TEST_SCR"]);

  $APIURL = "https://sandbox.cashfree.com/pg/orders";

}
//===========*********************============

if (isset($_POST['amount']) && $_POST['amount'] != '' && $_POST['mobile'] != '' && $_POST['cust_name'] != '' && $_POST['email'] != '') {

  function generateOrderId($prefix = '')
  {
    // Use uniqid with more entropy
    $uniqid = uniqid($prefix, true);


    $randomNumber = mt_rand(100000, 999999);
    $orderId = $uniqid . $randomNumber;
    $orderId = hash('sha256', $orderId);
    $orderId = substr($orderId, 0, 20);

    return strtoupper($orderId);
  }


  $orderId = generateOrderId('ORD_');


  $orderAmount = $_POST['amount'];
  $customer_id = uniqid();
  $customer_name = $_POST['cust_name'];
  $customer_email = $_POST['email'];
  $customer_phone = $_POST['mobile'];

  $paymentSessionId = '';
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $APIURL,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{
  "order_id":"' . $orderId . '",
"order_amount": ' . $orderAmount . ',
"order_currency": "INR",
"customer_details": {
"customer_id": "' . $customer_id . '",
"customer_name": "' . $customer_name . '",
"customer_email": "' . $customer_email . '",
"customer_phone": "' . $customer_phone . '"
},
"order_meta": { 
"return_url": "' . $base_url . '/success.php?order_id=' . $orderId . '",
"notify_url":"' . $base_url . '/callback.php"
}

}',
    CURLOPT_HTTPHEADER => array(
      'X-Client-Secret: ' . secret_key,
      'X-Client-Id: ' . client_id,
      'Content-Type: application/json',
      'Accept: application/json',
      'x-api-version: 2023-08-01'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  //echo $response;
  $resData = json_decode($response);


  if (isset($resData->cf_order_id) && $resData->cf_order_id != '') {

    $cf_order_id = $resData->cf_order_id;
    $order_id = $resData->order_id;
    $payment_session_id = $resData->payment_session_id;
    $paymentSessionId = $payment_session_id;

    /***** insert payment details ***********/
    $tablename = 'cashfree_payment';

    $myQuery = "INSERT INTO `" . $tablename . "` (`order_id`, `order_amount`,`customer_id`,`customer_name`,`customer_email`,`customer_phone`,`cf_order_id`,`payment_session_id`,`payment_status` ) VALUES ( '" . $order_id . "', '" . $orderAmount . "','" . $customer_id . "','" . $customer_name . "','" . $customer_email . "','" . $customer_phone . "', '" . $cf_order_id . "','" . $paymentSessionId . "','PENDING')";

    mysqli_query($con, $myQuery);
    /******* end here **********/

  } else {
    echo $response;
  }

  ?>

  <?php
  if (isset($paymentSessionId) && $paymentSessionId != '') { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
      <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;1,6..12,400;1,6..12,600;1,6..12,1000&display=swap"
        rel="stylesheet">
      <style>
        .infoBox {
          width: 30%;
          margin: 5% auto;
          font-size: 16px;
          color: #000;
          background-color: #fdfdfd;
          font-family: "Nunito Sans", sans-serif;
          overflow-x: hidden;
          font-weight: 400;
          line-height: 30px;
          text-align: center;
          padding: 2%;
          border: 1px solid #d9d9d9;
          border-radius: 5px;
        }

        .infoBox table {
          width: 100%;
          text-align: left;
          margin: auto;
        }

        .infoBox table td {
          padding: 2px 5px;
          text-align: left;
        }

        .infoBox #renderBtn {
          cursor: pointer;
          color: rgb(255, 255, 255);
          background: #63c643;
          font-size: 16px;
          transition: all 0.2s ease 0s;
          border-radius: 0px;
          padding: 12px 6px;
          border-style: none;
          width: 100%;
          max-width: 100%;
          margin: 20px auto 0;
          display: block;
          white-space: inherit;
        }
      </style>
    </head>

    <body>
      <div class="infoBox">
        <h5>Confirm Your Details</h5>
        <table>
          <tr>
            <td>Name</td>
            <td>:</td>
            <td><?php echo $customer_name; ?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>:</td>
            <td><?php echo $customer_email; ?></td>
          </tr>
          <tr>
            <td>Mobile No.</td>
            <td>:</td>
            <td><?php echo $customer_phone; ?></td>
          </tr>
          <tr>
            <td>Pay Amount</td>
            <td>:</td>
            <td style="color:green;font-weight:bold;font-size:18px;"><?php echo "Rs. " . $orderAmount; ?></td>
          </tr>
          <tr>
            <td colspan="3"><button type="button" id="renderBtn">
                Confirm & Pay
              </button></td>
          </tr>
        </table>


      </div>
    </body>
    <script>
      const cashfree = Cashfree({
        mode: "<?php echo $payMode ?>" //or production,
      });
      document.getElementById("renderBtn").addEventListener("click", () => {
        cashfree.checkout({
          paymentSessionId: "<?php echo $paymentSessionId ?>"
        });
      });
    </script>

    </html>



  <?php }
} else {
  echo "<h5>Payment request failed</h5>";
} ?>