<?php include("partials/session.php") ?>
<?php include('confi.php');
include("partials/validation.php");
include("errorReport.php");
require_once 'global.php'
  ?>
<?php
require_once 'env.php';
// error_reporting(E_ALL);
// ini_set("display_errors",1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // $user = $_POST['user'] ?? 'Not Provided'; //
  $user = $_POST['user'] ?? 'Not Provided'; //
  $name = $_POST['username'] ?? 'Not Provided';//------------
  $phone = $_POST['phone'] ?? 'Not Provided';//
  $phone2 = substr($phone, 3, $phone);     //--------------
  $four = substr($phone, -4);
  $email = $_POST['email'] ?? 'Not Provided';//--------------
  $cart = $_POST['cprod'] ?? 'Not Provided';//
  $total = $_POST['total'] ?? 'Not Provided';//--------------
  $address = $_POST['hdf_address'] ?? 'Not Provided';//
  $type = $_POST['standard'] ?? 'Not Provided';//
  $Ordertype = $type === 'standard' ? 1 : 2;//
  $mode = $_POST['paymentModes'] ?? 'Not Provided';//
  $ptOrderID = "HDF" . $four;
  // Modes
  if ($mode === "COD") {
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
    $orderId = generateOrderId('COD_');
    $cf_orderId = "COD" . mt_rand(1000000000, 9999999999);


    if (isset($total) && $total != '' && $phone != '' && $name != '' && $email != '') {
      $data = $_POST;
      $userDevice = $_SERVER['HTTP_USER_AGENT'];
      $data['orderId'] = $orderId;
      $data['sessionId'] = $orderId;
      $url = BASE_URL . '/orders2.php';

      $tablename = 'cashfree_payment';
      $myQuery = "INSERT INTO $tablename (order_id, order_amount, customer_id, customer_name, customer_email, customer_phone, cf_order_id, payment_session_id, payment_status, payment_time, user_id, address, orderType, cartData, process, processDate, order_note)
            VALUES ('$orderId', '$total', 'none', '$name', '$email', '$phone', '$cf_orderId', '$userDevice', 'COD',NOW(), '$user', '$address', '$Ordertype', '$cart', 'take', NOW(), 'order created')";


      if (mysqli_query($conn, $myQuery)) {
        echo "<script>
          window.location.href='result.php?order_id=$orderId';</script>";
      }

    }

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
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
        <h2>Processing Order...</h2>
        <form id="renderBtn" method="post">
          <h4>Order Total : <?php echo "Rs. " . $total; ?></h4><br>
          <span>User ID : <?php echo $user; ?></span><br>
          <span>Name : <?php echo $name; ?></span><br>
          <span>Email : <?php echo $email; ?></span><br>
          <span>Phone : <?php echo $phone; ?></span><br>
        </form>
        <br>
        <span id="area">fetching details...</span>
      </div>
    </body>

    </html>
    <?php
  } else {
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

    if (isset($total) && $total != '' && $phone != '' && $name != '' && $email != '') {

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


      $orderAmount = $total;
      $customer_id = uniqid();
      $customer_name = $name;
      $customer_email = $email;
      $customer_phone = $phone;

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
"return_url": "' . $base_url . '/result.php?order_id=' . $orderId . '",
"notify_url":"' . $base_url . '/cash3/callback.php"
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
        $myQuery = "INSERT INTO $tablename (order_id, order_amount, customer_id, customer_name, customer_email, customer_phone, cf_order_id, payment_session_id, payment_status, user_id, address, orderType, cartData, process, processDate, order_note)
            VALUES ('$order_id', '$orderAmount', '$customer_id', '$customer_name', '$customer_email', '$customer_phone', '$cf_order_id', '$paymentSessionId', 'PENDING', '$user', '$address', '$Ordertype', '$cart', 'take', NOW(), 'order created')";


        mysqli_query($conn, $myQuery);
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
            <h5 id="area">fetching you details</h5>
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
                <td colspan="3">
                  Inilizing Payment gateway...</td>
              </tr>
            </table>


          </div>
        </body>
        <script>
          const cashfree = Cashfree({
            mode: "<?php echo $payMode ?>" //or production,
          });
          //   document.getElementById("renderBtn").addEventListener("click", () => {
          setTimeout(() => {
            document.getElementById("area").innerHTML = "Processing you payment...";
          }, 1000);
          setTimeout(() => {
            cashfree.checkout({
              paymentSessionId: "<?php echo $paymentSessionId ?>"
            });
          }, 2000)
          //   });
        </script>

        </html>



      <?php }
    } else {
      echo "<h5>Payment request failed</h5>";
    }
  }
} else {
  echo "403 UNAUTHORIZED ACCESS";
}
?>