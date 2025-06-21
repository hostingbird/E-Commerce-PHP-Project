
<?php
include 'config.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Status</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;1,6..12,400;1,6..12,600;1,6..12,1000&display=swap" rel="stylesheet">
<style>
	.checkout-page {
  background-color: #fff;
  font-family: "Nunito Sans", sans-serif;
  overflow-x: hidden;
}
.text-red{color:red;font-size: 18px !important;}
.checkout-page * {
  font-weight: 400;
  font-size: 14px;
  line-height: 30px;
}
.checkout-page .header {
  padding: 7px 20px 0px;
}
.checkout-page .header h2 {
 font-size:23px;
 font-weight:bold;
 margin-top:20px;
}
.checkout-page .text-wrap {
  padding: 0px 30px;
}
.checkout-page .text-wrap h1 {
  font-size: 24px;
  font-weight: 400;
  margin: 20px auto 90px;
}
.checkout-page .box-wrap {
  max-width: 520px;
  margin: auto;
}
.checkout-page .summary-div {
  padding: 30px;
  margin: 20px auto;
  border: 1px solid #d9d9d9;
  background: #f6f6f6;
}
.checkout-page .form-control, .checkout-page select {
  border-radius: 0px;
  width: 100%;
  min-height: 40px;
  font-size: 15px;
  color: #000;
}
.checkout-page .form-control::-moz-placeholder, .checkout-page select::-moz-placeholder {
  font-size: 14px;
  opacity: 0.7;
}
.checkout-page .form-control::placeholder, .checkout-page select::placeholder {
  font-size: 14px;
  opacity: 0.7;
}
.checkout-page button {
  color: rgb(255, 255, 255);
  background: #63c643;
  font-size: 16px;
  transition: all 0.2s ease 0s;
  border-radius: 0px;
  padding: 12px 6px;
  border-style: none;
  width: 100%;
  max-width: 270px;
  margin: 20px auto 0;
  display: block;
  white-space: inherit;
}
.checkout-page .header-label {
  margin-bottom: 15px;
}
.checkout-page .optional-label {
  color: #8a8a8a;
  font-size: 20px;
  line-height: 30px;
}
.checkout-page .tax-row {
  margin-top: 30px;
  margin-bottom: 30px;
}
.checkout-page .text-right {
  text-align: right;
}
.checkout-page strong {
  font-weight: 700;
}
.checkout-page .total-row {
  margin-top: 30px;
  margin-bottom: 30px;
}
.checkout-page select option {
  font-size: 16px;
}

.checkout-footer {
  background-color: #baddd9;
  color: rgb(0, 0, 0);
  font-size: 16px;
}

.checkout-form .item-row .cell:first-of-type {
  font-size: 22px;
  color: #000;
}



.text-center {
  text-align: center;
}

.text-white {
  color: #fff;
}

@media (max-width: 580px) {
  .checkout-page * {
    font-size: 14px;
    line-height: 30px;
  }
  .checkout-page .text-wrap h1 {
    font-size: 20px;
    margin: 20px auto 50px;
  }
  .checkout-page .text-wrap {
    padding: 0px 10px;
  }
  .checkout-page .form-group {
    margin-bottom: 0;
  }
  .checkout-page .form-control {
    margin-bottom: 20px;
  }
  .checkout-page .optional-label {
    color: #8a8a8a;
    font-size: 16px;
    line-height: 25px;
  }
  .checkout-page .tax-row, .checkout-page .total-row {
    margin-top: 20px;
    margin-bottom: 20px;
  }
}
.orderDetails{font-size: 16px !important;margin-top:25px;}
</style>


</head>

<body>
     <main class="checkout-page">
        <div class="header" style="text-align:center">
           <h5>Payment Status</h5>
        </div>
        <div class="text-wrap">
            
            <div class="box-wrap">
                <div class="row justify-content-center">
                    <div class="col">
                        
                        <div class="summary-div checkout-page">
                        
     <?php 
     
           
   if(isset($_GET['order_id']) && $_GET['order_id'] !=''){
$order_id=$_GET['order_id'];

$tablename='cashfree_payment';

 $myQuery="select * from `".$tablename."` where `order_id`='".$order_id."'";
 
$getRes=mysqli_query($con,$myQuery);
$getData=mysqli_fetch_assoc($getRes);

$transactionId=$getData['cf_order_id'];
$paymentstatus=$getData['payment_status'];
if($paymentstatus=='SUCCESS'){
    ?>
    
        <p class="text-center text-success" style="font-size: 18px;">
         Payment Successfull!
            </p>
            <div class="orderDetails order-summary-container">
            <div class="row item-row sub-total-row">
            <div class="col-md-6 col-sm-6 col">Payment Tnx Id  </div>
            <div class="col-md-6 col-sm-6 col  text-right">
            <strong><?php echo $transactionId;?></strong>
                                    </div> </div>
           <div class="row item-row sub-total-row">
            <div class="col-md-6 col-sm-6 col">Order Id   </div>
            <div class="col-md-6 col-sm-6 col  text-right">
            <strong><?php echo $order_id;?></strong>
                                    </div> </div>
             <div class="orderDetails row item-row sub-total-row">
              <div class="col-md-12 col-sm-12 col">
                <p>Thank you for your payment.  </p>
</div>
</div>

                            </div>
            
            <?php  }else{

      
    
    ?>
    
        <p class="text-center text-red">
          Payment is <?php echo $paymentstatus;?>.
          <br>
          <i class="fa fa-times" aria-hidden="true"></i>
            </p>
           
            <?php  }
  ?>
                            </div>
    
    
                        </div>
                    
                    </div>
                </div>
            </div>
          
          </div>
         
    </main>
   </body>

</html>
<?php
}else{
    echo "{'error':'Record not found'}";
}
