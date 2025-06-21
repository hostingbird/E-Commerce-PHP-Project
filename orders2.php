<?php include("partials/session.php") ?>
<?php include('confi.php');
include("partials/validation.php");
require_once 'env.php';

if (!isset($_COOKIE['HDF_REQ_CHECKIN'])) {
    echo "<script>location.href='checkout.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include("partials/head.php") ?>

<body>

    <style>
        .mobile-menu.d-md.d-block.cart {
            left: 0 !important;
        }
    </style>
    <?php
    if ($_POST) {
        list($addressID, $userID, $cartID) = explode(':', $_COOKIE['HDF_REQ_CHECKIN']);

        json_encode($_POST);

        $user = $userID;
        $orderId = $_POST["orderId"] ?? $_POST["unique_id"];
        $orderType = 1;
        $txMsg = $_POST["txMsg"] ?? "";
        $orderAmount = $_POST["orderAmount"] ?? $_POST["total"];
        $referenceId = $_POST["referenceId"] ?? "COD Order";
        $txStatus = $_POST["txStatus"] ?? "COD Order";
        $paymentMode = $_POST["paymentMode"] ?? $_POST['paymentModes'];
        $txTime = $_POST["txTime"] ?? date('Y-m-d H:i:s', time());
        $address = $addressID;
        $option = "none";
        $signature = $_POST["signature"] ?? "";
        $data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
        $secretKey = $_ENV['CASH_TEST_SCR'];
        $hash_hmac = hash_hmac('sha256', $data, $secretKey, true) ?? "";
        $computedSignature = base64_encode($hash_hmac) ?? "";


        function insertOrder($conn, $statusValue, $user, $orderId, $pm, $address, $amt, $option, $ot, $ci, $orderTime, $process)
        {
            $checkSql = "SELECT COUNT(*) FROM `orders` WHERE `user_id` = ? AND `order_id` = ?";

            if ($checkStmt = $conn->prepare($checkSql)) {
                $checkStmt->bind_param("is", $user, $orderId);
                $checkStmt->execute();
                $checkStmt->bind_result($count);
                $checkStmt->fetch();
                $checkStmt->close();

                if ($count > 0) {
                    return 'Error: Cannot resubmit the same order.';
                }
            } else {
                return 'Failed to prepare duplicate check statement: ' . $conn->error;
            }

            $sql = "INSERT INTO `orders` (`user_id`, `order_id`, `method`, `amount`, `address`, `option`, `status`, `orderType`, `cartData`, `orderTime` , `process`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("issdsssssss", $user, $orderId, $pm, $amt, $address, $option, $statusValue, $ot, $ci, $orderTime, $process);

                if ($stmt->execute()) {
                    $stmt->close();

                    if ($statusValue == "paid" || $statusValue == "unpaid") {
                        $updateSql = "UPDATE `cart` SET `status` = 'conform' WHERE `user_id` = ?";
                        if ($updateStmt = $conn->prepare($updateSql)) {
                            $updateStmt->bind_param("i", $user);
                            if ($updateStmt->execute()) {
                                $updateStmt->close();
                                return true;
                            } else {
                                $updateStmt->close();
                                return 'Failed to update cart status: ' . $updateStmt->error;
                            }
                        } else {
                            return 'Failed to prepare cart update statement: ' . $conn->error;
                        }
                    } else {
                        return true; // if no cart update needed
                    }
                } else {
                    $stmt->close();
                    return 'Failed to insert order: ' . $stmt->error;
                }
            } else {
                return 'Failed to prepare SQL statement: ' . $conn->error;
            }
        }


        if ($paymentMode === 'COD') {
            ?>
            <!-- Breadcrumb Section Start -->
            <section class="breadcrumb-section pt-0">
                <div class="container-fluid-lg">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-contain breadcrumb-order">
                                <div class="order-box">
                                    <div class="order-contain">
                                        <?php


                                        if ($conn) {
                                            $RESULT = insertOrder($conn, "unpaid", $user, $orderId, $paymentMode, $address, $orderAmount, $option, $orderType, $cartID, $txTime, "take");
                                            if ($RESULT === true) {
                                                echo ' <div class="mobile-menu d-md d-block cart">
        <ul>
            <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>Back to Lobby</span>
                </a>
            </li>
             <li class="active">
                <a href="hdfgrocery/index.php">
                    <i class="iconly-Home icli"></i>
                    <span>view orders</span>
                </a>
            </li>
        </ul>
    </div>';
                                                echo '<div class="order-image">
                                <div class="checkmark">
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="checkmark__check" height="36" viewBox="0 0 48 36" width="48"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M47.248 3.9L43.906.667a2.428 2.428 0 0 0-3.344 0l-23.63 23.09-9.554-9.338a2.432 2.432 0 0 0-3.345 0L.692 17.654a2.236 2.236 0 0 0 .002 3.233l14.567 14.175c.926.894 2.42.894 3.342.01L47.248 7.128c.922-.89.922-2.34 0-3.23">
                                        </path>
                                    </svg>
                                    <svg class="checkmark__background" height="115" viewBox="0 0 120 115" width="120"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M107.332 72.938c-1.798 5.557 4.564 15.334 1.21 19.96-3.387 4.674-14.646 1.605-19.298 5.003-4.61 3.368-5.163 15.074-10.695 16.878-5.344 1.743-12.628-7.35-18.545-7.35-5.922 0-13.206 9.088-18.543 7.345-5.538-1.804-6.09-13.515-10.696-16.877-4.657-3.398-15.91-.334-19.297-5.002-3.356-4.627 3.006-14.404 1.208-19.962C10.93 67.576 0 63.442 0 57.5c0-5.943 10.93-10.076 12.668-15.438 1.798-5.557-4.564-15.334-1.21-19.96 3.387-4.674 14.646-1.605 19.298-5.003C35.366 13.73 35.92 2.025 41.45.22c5.344-1.743 12.628 7.35 18.545 7.35 5.922 0 13.206-9.088 18.543-7.345 5.538 1.804 6.09 13.515 10.696 16.877 4.657 3.398 15.91.334 19.297 5.002 3.356 4.627-3.006 14.404-1.208 19.962C109.07 47.424 120 51.562 120 57.5c0 5.943-10.93 10.076-12.668 15.438z">
                                        </path>
                                    </svg>
                                </div>
                            </div>';
                                                echo '<h3 class="theme-color">Order Success</h3>';
                                                echo '<h5 class="text-content">Your order COD is placed Successfully And Your Order Is On The Way and may deleverd at your door between 06:00 AM to 09:00 AM or 06:00 PM to 09:00 PM </h5>';
                                                echo '<h6>Transaction ID: ' . $orderId . '</h6>';
                                                echo '<h2>Orders list : <a href="dashboard.php">profile/view Orders</a></h2>';
                                            } else {
                                                echo ' <div class="mobile-menu d-md d-block cart">
        <ul>
            <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>Back to Lobby</span>
                </a>
            </li>
             <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>view orders</span>
                </a>
            </li>
        </ul>
    </div>';
                                                echo '<div class="order-image">
    <div class="checkmark">
        <svg height="100" viewBox="0 0 100 100" width="100" xmlns="http://www.w3.org/2000/svg">
            <!-- Outer Circle -->
            <circle cx="50" cy="50" r="45" stroke="#FF5252" stroke-width="6" fill="none" />
            
            <!-- Cross -->
            <g>
                <!-- Top-Left to Bottom-Right Line -->
                <line x1="30" y1="30" x2="70" y2="70" stroke="#FF5252" stroke-width="8">
                    <animate attributeName="stroke-dasharray" values="0,40; 40,0; 0,40; 40,0;" keyTimes="0; 0.25; 0.75; 1" dur="1.5s" repeatCount="indefinite" />
                </line>
                
                <!-- Top-Right to Bottom-Left Line -->
                <line x1="70" y1="30" x2="30" y2="70" stroke="#FF5252" stroke-width="8">
                    <animate attributeName="stroke-dasharray" values="0,40; 40,0; 0,40; 40,0;" keyTimes="0; 0.25; 0.75; 1" dur="1.5s" repeatCount="indefinite" />
                </line>
            </g>
            
            <!-- Glitch Effect -->
            <g>
                <rect x="30" y="30" width="40" height="40" fill="none" stroke="#FF5252" stroke-width="2" />
                <line x1="30" y1="40" x2="70" y2="40" stroke="#FF5252" stroke-width="4" stroke-dasharray="5,5">
                    <animateTransform attributeName="transform" type="translate" values="0,0; 0,5; 0,-5; 0,0" dur="1.5s" repeatCount="indefinite" />
                </line>
                <line x1="30" y1="60" x2="70" y2="60" stroke="#FF5252" stroke-width="4" stroke-dasharray="5,5">
                    <animateTransform attributeName="transform" type="translate" values="0,0; 0,-5; 0,5; 0,0" dur="1.5s" repeatCount="indefinite" />
                </line>
            </g>
        </svg>
    </div>
</div>

';
                                                echo '<h1 style="color:red">Order Failed By the Server</h1>';
                                                echo '<h5 class="text-content">if amount is deducted it will return in 1-2 working days ,or you can contact to our customer care support</h5>';
                                                echo '<h2>Mail to : <a href="mailto:support@domain.com">support@domain.com</a></h2>';

                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                                        } else {
                                            echo ' <div class="mobile-menu d-md d-block cart">
        <ul>
            <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>Back to Lobby</span>
                </a>
            </li>
        </ul>
    </div>';
                                            echo '<style>/* Styles go here */
body{
  background-color: #FFF;
  margin:0;
  font-family: sans-serif !important;
}
.andi
{
  background:#0da487;
}
.android-container
{
  position:relative;
 
  margin:10% auto 0;
  height: 150px;
  width:250px;
}
.android-container>div{
  position:absolute;
  transition:all 0.5s ease;
 
}
.andi-head{
  height:45px;
  width:90px;
  left:100px;
  top:50px;
  border-radius: 90px 90px 0 0;
  -moz-border-radius: 90px 90px 0 0;
  -webkit-border-radius: 90px 90px 0 0;
 
}
.andi-body
{
  width:90px;
  height:120px;
  border-top-left-radius:10px;
  border-top-right-radius:10px;
}
.andi-antena-1
{
  top:40px;
  left:105px;
  width:10px;
  height:30px;
  border-radius:10px;
  transform:rotate(-50deg);
}

.andi-antena-2
{
  top:40px;
  left:175px;
  width:10px;
  height:30px;
  border-radius:10px;
  transform:rotate(50deg);
}
.andi-hand-1{
  width:80px;
  height:20px;
  left:95px;
  top:100px;
  border-radius:10px;
}
.andi-hand-2{
  width:50px;
  height:20px;
  left:-45px;
  top:85px;
  border-radius:10px;
  transform:rotate(70deg);
}

.andi-leg-1{
  width:20px;
  height:50px;
  left:15px; 
  top:-40px; 
  border-radius:10px;
  animation-name:leg;
  animation-duration: 2s;
  animation-iteration-count: infinite;
  transition:all 0.5s ease-in-out;
  
}
.andi-leg-2{
  width:20px;
  height:50px;
  left:55px; 
  top:-40px; 
  border-radius:10px;
  
}
.andi-eye-1{
  width:10px;
  height:10px;
  background:#ffffff;
  left:160px;
  top:70px;
  animation-name:eye1;
  animation-duration: 4s;
  animation-iteration-count: infinite;
}
.andi-eye-2{
  width:15px;
  height:3px;
  background:#ffffff;
  left:120px;
  top:75px;
  transform:rotate(50deg);
  border-radius:10px;
}
.andi-eye-2-1{
  width:15px;
  height:3px;
  background:#ffffff;
  left:120px;
  top:75px;
  transform:rotate(-50deg);
  border-radius:10px;
}
@keyframes eye1 {
  0% {
        left:155px;
       
    }
    50%{
      left:165px;
      height:10px;
    }

    100%{
      left:155px;
       
    }
}
@-webkit-keyframes eye1 {
    0% {
        left:155px;
       
    }
    50%{
      left:165px;
      height:10px;
    }

    100%{
      left:155px;
       
    }
}
.andi-bubble-2
{
  width:15px;
  height:15px;
  background:#22C5C5;
  border-radius:50%;
  left:200px;
  top:28px;
  animation-name:blink;
  animation-duration: 2s;
  animation-iteration-count: infinite;
  transition:all 0.5s ease-in-out;
}
.andi-bubble-1
{
  width:15px;
  height:15px;
  border:3px solid #22C5C5;
  background:transparent;
  border-radius:50%;
  left:220px;
  top:10px;
  animation-delay: 1s;
  animation-name:blink;
  animation-duration: 2s;
  animation-iteration-count: infinite;
  transition:all 0.5s ease-in-out;
}
@keyframes blink {
  0% {
        opacity:0;
        transform:scale(0.3);
       
    }
  50%{
    opacity:1;
     transform:scale(1);
  }

  100%{
      opacity:0;
      transform:scale(0.3);
       
    }
}
@-webkit-keyframes blink {
  0% {
        opacity:0;
       
    }
  50%{
    opacity:1;
  }

  100%{
      opacity:0;
       
    }
}

@keyframes leg {
  0% {
        top:-25px;
       
    }
  50%{
  top:-40px;
  }

  100%{
      top:-25px;
       
    }
}
.oops
{
  text-align:center;
  font-size:16px;
  font-weight:bold;
  color:#757575;
  margin-left:-60px;
}
.inspired a{
  text-decoration:none;
  color:#2856b6;
  vertical-align:middle;
}
.inspired img{
  vertical-align:middle;
}
.inspired
{
  text-align:center;
  margin:50px 0 50px -60px;
}
</style>';
                                            echo "<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>";
                                            echo '<link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
  
    
    <div class="android-container">
        <div class="andi andi-head">
      
      
        </div>
        <div class="andi andi-body">
          
        </div>
        <div class="andi andi-antena-1">
          
        </div>
        <div class="andi andi-antena-2">
          
        </div>
        <div class="andi andi-hand-1">
          
        </div>
        <div class="andi andi-hand-2">
          
        </div>
         <div class="andi andi-leg-1">
          
        </div>
         <div class="andi andi-leg-2">
          
        </div>
        <div class="andi andi-eye-1">
          
        </div>
        <div class="andi andi-eye-2">
          
        </div>
        <div class="andi andi-eye-2-1">
          
        </div>
         <div class="andi andi-bubble-1">
          
        </div>
        <div class="andi andi-bubble-2">
          
        </div>
    </div>
    <div class="oops">
     <h1> REQUEST SERVER ERROR</h2>
    </div>';
                                        }
                                        ?>

            <?php

        } else {
            ?>
            <section class="breadcrumb-section pt-0">
                <div class="container-fluid-lg">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-contain breadcrumb-order">
                                <div class="order-box">
                                    <div class="order-contain">
                                        <?php
                                        if ($signature == $computedSignature) {
                                            if ($txStatus === "SUCCESS") {
                                                $RESULT = insertOrder($conn, "paid", $user, $orderId, $paymentMode, $address, $orderAmount, $option, $orderType, $cartID, $txTime, 'take');
                                                if ($RESULT === true) {
                                                    echo ' <div class="mobile-menu d-md d-block cart">
                    <ul>
                        <li class="active">
                            <a href="index.php">
                                <i class="iconly-Home icli"></i>
                                <span>Back to Lobby</span>
                            </a>
                        </li>
                         <li class="active">
                            <a href="index.php">
                                <i class="iconly-Home icli"></i>
                                <span>view orders</span>
                            </a>
                        </li>
                    </ul>
                </div>';
                                                    echo '<div class="order-image">
                                            <div class="checkmark">
                                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972            -.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                                    </path>
                                                </svg>
                                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972            -.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                                    </path>
                                                </svg>
                                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972            -.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                                    </path>
                                                </svg>
                                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972            -.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                                    </path>
                                                </svg>
                                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972            -.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                                    </path>
                                                </svg>
                                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972            -.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                                    </path>
                                                </svg>
                                                <svg class="checkmark__check" height="36" viewBox="0 0 48 36" width="48"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M47.248 3.9L43.906.667a2.428 2.428 0 0 0-3.344 0l-23.63 23.09-9.554-9.338a2.432 2.432 0 0 0-3.345 0L.692 17.654a2.236 2.236 0 0 0 .002 3.233l14.567 14.175c.926.894 2.42.894             3.342.01L47.248 7.128c.922-.89.922-2.34 0-3.23">
                                                    </path>
                                                </svg>
                                                <svg class="checkmark__background" height="115" viewBox="0 0 120 115" width="120"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M107.332 72.938c-1.798 5.557 4.564 15.334 1.21 19.96-3.387 4.674-14.646 1.605-19.298 5.003-4.61 3.368-5.163 15.074-10.695 16.878-5.344 1.743-12.628-7.35-18.545-7.35-5.922 0            -13.206 9.088-18.543 7.345-5.538-1.804-6.09-13.515-10.696-16.877-4.657-3.398-15.91-.334-19.297-5.002-3.356-4.627 3.006-14.404 1.208-19.962C10.93 67.576 0 63.442 0 57.5c0-5            .943 10.93-10.076 12.668-15.438 1.798-5.557-4.564-15.334-1.21-19.96 3.387-4.674 14.646-1.605 19.298-5.003C35.366 13.73 35.92 2.025 41.45.22c5.344-1.743 12.628 7.35 18.545 7            .35 5.922 0 13.206-9.088 18.543-7.345 5.538 1.804 6.09 13.515 10.696 16.877 4.657 3.398 15.91.334 19.297 5.002 3.356 4.627-3.006 14.404-1.208 19.962C109.07 47.424 120 51            .562 120 57.5c0 5.943-10.93 10.076-12.668 15.438z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>';
                                                    echo '<h3 class="theme-color">Order Success</h3>';
                                                    echo '<h5 class="text-content">Payment Is Successfully And Your Order Is On The Way</h5>';
                                                    echo '<h6>Transaction ID: ' . $orderId . '</h6>';

                                                } else {
                                                    echo '<h3 class="theme-color"> THERE WAS PROBLEM ' . $RESULT . '</h3>';
                                                    echo '<h5 class="text-content">may this happen if you resubmit that order page(ERROR : DUPLICATE ORDER NOT ACCEPT). sorry for any intruption,this is not an error. please check your order in dashboard/orders section or you can contect to out customer support.</h5>';
                                                    echo '<h6>Transaction ID: ' . $orderId . '</h6>';
                                                }

                                            } else if ($txStatus === "PENDING") {
                                                $RESULT = insertOrder($conn, "return", $user, $orderId, $paymentMode, $address, $orderAmount, $option, $orderType, $cartID, $txTime);
                                                if ($RESULT === true) {
                                                    echo ' <div class="mobile-menu d-md d-block cart">
        <ul>
            <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>Back to Lobby</span>
                </a>
            </li>
             <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>view orders</span>
                </a>
            </li>
        </ul>
    </div>';
                                                    echo '<div class="order-image">
    <div class="checkmark">
        <svg height="100" viewBox="0 0 100 100" width="100" xmlns="http://www.w3.org/2000/svg">
            <!-- Outer Gear -->
            <g>
                <circle cx="50" cy="50" r="45" stroke="#FFC107" stroke-width="6" fill="none" />
                <g transform="translate(50,50)">
                    <g transform="rotate(0)">
                        <rect x="-2.5" y="-45" width="5" height="15" fill="#FFC107">
                            <animateTransform attributeName="transform" type="rotate" from="0" to="360" dur="5s" repeatCount="indefinite" />
                        </rect>
                    </g>
                    <g transform="rotate(45)">
                        <rect x="-2.5" y="-45" width="5" height="15" fill="#FFC107">
                            <animateTransform attributeName="transform" type="rotate" from="0" to="360" dur="5s" repeatCount="indefinite" />
                        </rect>
                    </g>
                    <g transform="rotate(90)">
                        <rect x="-2.5" y="-45" width="5" height="15" fill="#FFC107">
                            <animateTransform attributeName="transform" type="rotate" from="0" to="360" dur="5s" repeatCount="indefinite" />
                        </rect>
                    </g>
                    <g transform="rotate(135)">
                        <rect x="-2.5" y="-45" width="5" height="15" fill="#FFC107">
                            <animateTransform attributeName="transform" type="rotate" from="0" to="360" dur="5s" repeatCount="indefinite" />
                        </rect>
                    </g>
                </g>
            </g>
            <!-- Inner Clock -->
            <g>
                <circle cx="50" cy="50" r="30" stroke="#FFC107" stroke-width="4" fill="none" />
                <line x1="50" y1="50" x2="50" y2="25" stroke="#FFC107" stroke-width="3">
                    <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="10s" repeatCount="indefinite" />
                </line>
                <line x1="50" y1="50" x2="75" y2="50" stroke="#FFC107" stroke-width="3">
                    <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="60s" repeatCount="indefinite" />
                </line>
            </g>
        </svg>
    </div>
</div>
';
                                                    echo '<h1 style="color:yellow">Order Pending</h1>';
                                                    echo '<h5 class="text-content">Do not Pay again if amount is deducted , contact to our customer care</h5>';
                                                    echo '<h2>Mail to : <a href="mailto:support@domain.com">support@domain.com</a></h2>';
                                                } else {
                                                    echo '<h1 style="color:yellow">Order Pending and not be done</h1>';
                                                    echo '<h5 class="text-content">Server , contact to our customer care</h5>';
                                                    echo '<h2>Mail to : <a href="mailto:support@domain.com">support@domain.com</a></h2>';

                                                }

                                            } else if ($txStatus === "FAILED") {
                                                $RESULT = insertOrder($conn, "cancel", $user, $orderId, $paymentMode, $address, $orderAmount, $option, $orderType, $cartID, $txTime);
                                                if ($RESULT === true) {
                                                    echo ' <div class="mobile-menu d-md d-block cart">
        <ul>
            <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>Back to Lobby</span>
                </a>
            </li>
             <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>view orders</span>
                </a>
            </li>
        </ul>
    </div>';
                                                    echo '<div class="order-image">
    <div class="checkmark">
        <svg height="100" viewBox="0 0 100 100" width="100" xmlns="http://www.w3.org/2000/svg">
            <!-- Outer Circle -->
            <circle cx="50" cy="50" r="45" stroke="#FF5252" stroke-width="6" fill="none" />
            
            <!-- Cross -->
            <g>
                <!-- Top-Left to Bottom-Right Line -->
                <line x1="30" y1="30" x2="70" y2="70" stroke="#FF5252" stroke-width="8">
                    <animate attributeName="stroke-dasharray" values="0,40; 40,0; 0,40; 40,0;" keyTimes="0; 0.25; 0.75; 1" dur="1.5s" repeatCount="indefinite" />
                </line>
                
                <!-- Top-Right to Bottom-Left Line -->
                <line x1="70" y1="30" x2="30" y2="70" stroke="#FF5252" stroke-width="8">
                    <animate attributeName="stroke-dasharray" values="0,40; 40,0; 0,40; 40,0;" keyTimes="0; 0.25; 0.75; 1" dur="1.5s" repeatCount="indefinite" />
                </line>
            </g>
            
            <!-- Glitch Effect -->
            <g>
                <rect x="30" y="30" width="40" height="40" fill="none" stroke="#FF5252" stroke-width="2" />
                <line x1="30" y1="40" x2="70" y2="40" stroke="#FF5252" stroke-width="4" stroke-dasharray="5,5">
                    <animateTransform attributeName="transform" type="translate" values="0,0; 0,5; 0,-5; 0,0" dur="1.5s" repeatCount="indefinite" />
                </line>
                <line x1="30" y1="60" x2="70" y2="60" stroke="#FF5252" stroke-width="4" stroke-dasharray="5,5">
                    <animateTransform attributeName="transform" type="translate" values="0,0; 0,-5; 0,5; 0,0" dur="1.5s" repeatCount="indefinite" />
                </line>
            </g>
        </svg>
    </div>
</div>

';
                                                    echo '<h1 style="color:red">Order Payment Failed</h1>';
                                                    echo '<h5 class="text-content">if amount is deducted it will return in 1-2 working days ,or you can contact to our customer care support</h5>';
                                                    echo '<h2>Mail to : <a href="mailto:support@domain.com">support@domain.com</a></h2>';
                                                } else {
                                                    echo '<h1 style="color:red">Order Failed</h1>';
                                                    echo '<h5 class="text-content">Server Error ,or you can contact to our customer care support</h5>';
                                                    echo '<h2>Mail to : <a href="mailto:support@domain.com">support@domain.com</a></h2>';

                                                }

                                            } else if ($txStatus === "USER_DROPPED") {
                                                $RESULT = insertOrder($conn, "cancel", $user, $orderId, $paymentMode, $address, $orderAmount, $option, $orderType, $cartID, $txTime);
                                                if ($RESULT === true) {
                                                    echo ' <div class="mobile-menu d-md d-block cart">
        <ul>
            <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>Back to Lobby</span>
                </a>
            </li>
             <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>view orders</span>
                </a>
            </li>
        </ul>
    </div>';

                                                    echo '<div class="order-image">
    <div class="checkmark">
        <svg height="100" viewBox="0 0 100 100" width="100" xmlns="http://www.w3.org/2000/svg">
            <!-- Outer Circle -->
            <circle cx="50" cy="50" r="45" stroke="#FF5252" stroke-width="6" fill="none" />
            
            <!-- Cross -->
            <g>
                <!-- Top-Left to Bottom-Right Line -->
                <line x1="30" y1="30" x2="70" y2="70" stroke="#FF5252" stroke-width="8">
                    <animate attributeName="stroke-dasharray" values="0,40; 40,0; 0,40; 40,0;" keyTimes="0; 0.25; 0.75; 1" dur="1.5s" repeatCount="indefinite" />
                </line>
                
                <!-- Top-Right to Bottom-Left Line -->
                <line x1="70" y1="30" x2="30" y2="70" stroke="#FF5252" stroke-width="8">
                    <animate attributeName="stroke-dasharray" values="0,40; 40,0; 0,40; 40,0;" keyTimes="0; 0.25; 0.75; 1" dur="1.5s" repeatCount="indefinite" />
                </line>
            </g>
            
            <!-- Glitch Effect -->
            <g>
                <rect x="30" y="30" width="40" height="40" fill="none" stroke="#FF5252" stroke-width="2" />
                <line x1="30" y1="40" x2="70" y2="40" stroke="#FF5252" stroke-width="4" stroke-dasharray="5,5">
                    <animateTransform attributeName="transform" type="translate" values="0,0; 0,5; 0,-5; 0,0" dur="1.5s" repeatCount="indefinite" />
                </line>
                <line x1="30" y1="60" x2="70" y2="60" stroke="#FF5252" stroke-width="4" stroke-dasharray="5,5">
                    <animateTransform attributeName="transform" type="translate" values="0,0; 0,-5; 0,5; 0,0" dur="1.5s" repeatCount="indefinite" />
                </line>
            </g>
        </svg>
    </div>
</div>

';
                                                    echo '<h1 style="color:red">Order Droped</h1>';
                                                    echo '<h5 class="text-content">if need any help, you can contact to our customer care support</h5>';
                                                    echo '<h2>Mail to : <a href="mailto:support@domain.com">support@domain.com</a></h2>';
                                                } else {
                                                    echo '<h1 style="color:red">Order Failed Server Error</h1>';
                                                    echo '<h5 class="text-content">if need any help, you can contact to our customer care support</h5>';
                                                    echo '<h2>Mail to : <a href="mailto:support@domain.com">support@domain.com</a></h2>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                                        } else {
                                            echo ' <div class="mobile-menu d-md d-block cart">
        <ul>
            <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>Back to Lobby</span>
                </a>
            </li>
        </ul>
    </div>';
                                            echo '<style>/* Styles go here */
body{
  background-color: #FFF;
  margin:0;
  font-family: sans-serif !important;
}
.andi
{
  background:#0da487;
}
.android-container
{
  position:relative;
 
  margin:10% auto 0;
  height: 150px;
  width:250px;
}
.android-container>div{
  position:absolute;
  transition:all 0.5s ease;
 
}
.andi-head{
  height:45px;
  width:90px;
   left:100px;
  top:50px;
  border-radius: 90px 90px 0 0;
  -moz-border-radius: 90px 90px 0 0;
  -webkit-border-radius: 90px 90px 0 0;
 
}
.andi-body
{
   width:90px;
   height:120px;
   border-top-left-radius:10px;
   border-top-right-radius:10px;
}
.andi-antena-1
{
  top:40px;
  left:105px;
  width:10px;
  height:30px;
  border-radius:10px;
  transform:rotate(-50deg);
}

.andi-antena-2
{
  top:40px;
  left:175px;
  width:10px;
  height:30px;
  border-radius:10px;
  transform:rotate(50deg);
}
.andi-hand-1{
  width:80px;
  height:20px;
  left:95px;
  top:100px;
  border-radius:10px;
}
.andi-hand-2{
  width:50px;
  height:20px;
  left:-45px;
  top:85px;
  border-radius:10px;
  transform:rotate(70deg);
}

.andi-leg-1{
  width:20px;
  height:50px;
  left:15px; 
  top:-40px; 
  border-radius:10px;
  animation-name:leg;
  animation-duration: 2s;
  animation-iteration-count: infinite;
   transition:all 0.5s ease-in-out;
  
}
.andi-leg-2{
  width:20px;
  height:50px;
  left:55px; 
  top:-40px; 
  border-radius:10px;
  
}
.andi-eye-1{
  width:10px;
  height:10px;
  background:#ffffff;
  left:160px;
  top:70px;
  animation-name:eye1;
  animation-duration: 4s;
  animation-iteration-count: infinite;
}
.andi-eye-2{
  width:15px;
  height:3px;
  background:#ffffff;
  left:120px;
  top:75px;
  transform:rotate(50deg);
   border-radius:10px;
}
.andi-eye-2-1{
  width:15px;
  height:3px;
  background:#ffffff;
  left:120px;
  top:75px;
  transform:rotate(-50deg);
   border-radius:10px;
}
@keyframes eye1 {
   0% {
        left:155px;
       
    }
    50%{
      left:165px;
      height:10px;
    }

    100%{
       left:155px;
       
    }
}
@-webkit-keyframes eye1 {
    0% {
        left:155px;
       
    }
    50%{
      left:165px;
      height:10px;
    }

    100%{
       left:155px;
       
    }
}
.andi-bubble-2
{
  width:15px;
  height:15px;
  background:#22C5C5;
  border-radius:50%;
  left:200px;
  top:28px;
  animation-name:blink;
  animation-duration: 2s;
  animation-iteration-count: infinite;
   transition:all 0.5s ease-in-out;
}
.andi-bubble-1
{
  width:15px;
  height:15px;
  border:3px solid #22C5C5;
  background:transparent;
  border-radius:50%;
  left:220px;
  top:10px;
  animation-delay: 1s;
  animation-name:blink;
  animation-duration: 2s;
  animation-iteration-count: infinite;
   transition:all 0.5s ease-in-out;
}
@keyframes blink {
   0% {
        opacity:0;
        transform:scale(0.3);
       
    }
  50%{
    opacity:1;
     transform:scale(1);
  }

   100%{
      opacity:0;
      transform:scale(0.3);
       
    }
}
@-webkit-keyframes blink {
   0% {
        opacity:0;
       
    }
  50%{
    opacity:1;
  }

   100%{
      opacity:0;
       
    }
}

@keyframes leg {
   0% {
        top:-25px;
       
    }
  50%{
   top:-40px;
  }

   100%{
      top:-25px;
       
    }
}
.oops
{
  text-align:center;
  font-size:16px;
  font-weight:bold;
  color:#757575;
  margin-left:-60px;
}
.inspired a{
  text-decoration:none;
  color:#2856b6;
  vertical-align:middle;
}
.inspired img{
  vertical-align:middle;
}
.inspired
{
  text-align:center;
  margin:50px 0 50px -60px;
}
</style>';
                                            echo "<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>";
                                            echo '<link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
  
    
    <div class="android-container">
        <div class="andi andi-head">
      
      
        </div>
        <div class="andi andi-body">
          
        </div>
        <div class="andi andi-antena-1">
          
        </div>
        <div class="andi andi-antena-2">
          
        </div>
        <div class="andi andi-hand-1">
          
        </div>
        <div class="andi andi-hand-2">
          
        </div>
         <div class="andi andi-leg-1">
          
        </div>
         <div class="andi andi-leg-2">
          
        </div>
        <div class="andi andi-eye-1">
          
        </div>
        <div class="andi andi-eye-2">
          
        </div>
        <div class="andi andi-eye-2-1">
          
        </div>
         <div class="andi andi-bubble-1">
          
        </div>
        <div class="andi andi-bubble-2">
          
        </div>
    </div>
    <div class="oops">
     <h1> OOPS!! something bad has happened</h2>
    </div>';
                                        }
        }
        // $POSt method failed
    }
    // Request Not a json part or post request
    else {
        echo ' <div class="mobile-menu d-md d-block cart">
        <ul>
            <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>Back to Lobby</span>
                </a>
            </li>
        </ul>
    </div>';
        echo '<style>/* Styles go here */
body{
  background-color: #FFF;
  margin:0;
  font-family: sans-serif !important;
}
.andi
{
  background:#0da487;
}
.android-container
{
  position:relative;
 
  margin:10% auto 0;
  height: 150px;
  width:250px;
}
.android-container>div{
  position:absolute;
  transition:all 0.5s ease;
 
}
.andi-head{
  height:45px;
  width:90px;
   left:100px;
  top:50px;
  border-radius: 90px 90px 0 0;
  -moz-border-radius: 90px 90px 0 0;
  -webkit-border-radius: 90px 90px 0 0;
 
}
.andi-body
{
   width:90px;
   height:120px;
   border-top-left-radius:10px;
   border-top-right-radius:10px;
}
.andi-antena-1
{
  top:40px;
  left:105px;
  width:10px;
  height:30px;
  border-radius:10px;
  transform:rotate(-50deg);
}

.andi-antena-2
{
  top:40px;
  left:175px;
  width:10px;
  height:30px;
  border-radius:10px;
  transform:rotate(50deg);
}
.andi-hand-1{
  width:80px;
  height:20px;
  left:95px;
  top:100px;
  border-radius:10px;
}
.andi-hand-2{
  width:50px;
  height:20px;
  left:-45px;
  top:85px;
  border-radius:10px;
  transform:rotate(70deg);
}

.andi-leg-1{
  width:20px;
  height:50px;
  left:15px; 
  top:-40px; 
  border-radius:10px;
  animation-name:leg;
  animation-duration: 2s;
  animation-iteration-count: infinite;
   transition:all 0.5s ease-in-out;
  
}
.andi-leg-2{
  width:20px;
  height:50px;
  left:55px; 
  top:-40px; 
  border-radius:10px;
  
}
.andi-eye-1{
  width:10px;
  height:10px;
  background:#ffffff;
  left:160px;
  top:70px;
  animation-name:eye1;
  animation-duration: 4s;
  animation-iteration-count: infinite;
}
.andi-eye-2{
  width:15px;
  height:3px;
  background:#ffffff;
  left:120px;
  top:75px;
  transform:rotate(50deg);
   border-radius:10px;
}
.andi-eye-2-1{
  width:15px;
  height:3px;
  background:#ffffff;
  left:120px;
  top:75px;
  transform:rotate(-50deg);
   border-radius:10px;
}
@keyframes eye1 {
   0% {
        left:155px;
       
    }
    50%{
      left:165px;
      height:10px;
    }

    100%{
       left:155px;
       
    }
}
@-webkit-keyframes eye1 {
    0% {
        left:155px;
       
    }
    50%{
      left:165px;
      height:10px;
    }

    100%{
       left:155px;
       
    }
}
.andi-bubble-2
{
  width:15px;
  height:15px;
  background:#22C5C5;
  border-radius:50%;
  left:200px;
  top:28px;
  animation-name:blink;
  animation-duration: 2s;
  animation-iteration-count: infinite;
   transition:all 0.5s ease-in-out;
}
.andi-bubble-1
{
  width:15px;
  height:15px;
  border:3px solid #22C5C5;
  background:transparent;
  border-radius:50%;
  left:220px;
  top:10px;
  animation-delay: 1s;
  animation-name:blink;
  animation-duration: 2s;
  animation-iteration-count: infinite;
   transition:all 0.5s ease-in-out;
}
@keyframes blink {
   0% {
        opacity:0;
        transform:scale(0.3);
       
    }
  50%{
    opacity:1;
     transform:scale(1);
  }

   100%{
      opacity:0;
      transform:scale(0.3);
       
    }
}
@-webkit-keyframes blink {
   0% {
        opacity:0;
       
    }
  50%{
    opacity:1;
  }

   100%{
      opacity:0;
       
    }
}

@keyframes leg {
   0% {
        top:-25px;
       
    }
  50%{
   top:-40px;
  }

   100%{
      top:-25px;
       
    }
}
.oops
{
  text-align:center;
  font-size:16px;
  font-weight:bold;
  color:#757575;
  margin-left:-60px;
}
.inspired a{
  text-decoration:none;
  color:#2856b6;
  vertical-align:middle;
}
.inspired img{
  vertical-align:middle;
}
.inspired
{
  text-align:center;
  margin:50px 0 50px -60px;
}
</style>';
        echo "<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>";
        echo '<link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
  
    
    <div class="android-container">
        <div class="andi andi-head">
      
      
        </div>
        <div class="andi andi-body">
          
        </div>
        <div class="andi andi-antena-1">
          
        </div>
        <div class="andi andi-antena-2">
          
        </div>
        <div class="andi andi-hand-1">
          
        </div>
        <div class="andi andi-hand-2">
          
        </div>
         <div class="andi andi-leg-1">
          
        </div>
         <div class="andi andi-leg-2">
          
        </div>
        <div class="andi andi-eye-1">
          
        </div>
        <div class="andi andi-eye-2">
          
        </div>
        <div class="andi andi-eye-2-1">
          
        </div>
         <div class="andi andi-bubble-1">
          
        </div>
        <div class="andi andi-bubble-2">
          
        </div>
    </div>
    <div class="oops">
     <h1> OOPS!! something is fly away can\'t handle REQUEST CODE 500 ERROR</h2>
    </div>';
    }
    ?>

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- latest jquery-->
    <script src="<?php echo BASE_URL; ?>h/asset/assets/js/jquery-3.6.0.min.js"></script>

    <!-- jquery ui-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/jquery-ui.min.js"></script>

    <!-- Bootstrap js-->
    <script
        src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script
        src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/bootstrap-notify.min.js"></script>
    <script
        src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/popper.min.js"></script>
</body>

</html>