<?php include ("partials/session.php") ?>
<?php include ('confi.php');
include ("partials/validation.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<?php include ("partials/head.php") ?>
<!--<meta http-equiv="refresh" content="5"></meta>-->
<body>

    <!-- Header Start -->
    <?php include ('partials/header.php') ?>
    <!-- Header End -->

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>ORDER VIEW</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="home.php">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">expand-order</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
<?php
if(isset($_GET['orderId'])){
    $orderID = $_GET['orderId'];
?>
       <section class="section-404 section-lg-space">
            <link href="order.css" rel="stylesheet"></style>
            <style>
                .order-container {
                     min-width: 100%;
                     padding:15px 10%;
               }
               .flex-pane{
                   display:flex;
                   place-content:center;
                   flex-wrap:wrap;
                   gap:15px;
               }
               .product-container{
                   border:1px solid;
                   padding:7px;
                   gap:7px;
                   display:grid;
                   width:239px;
                   border-radius:4px;
                   background:#ffffff89;
                   backdrop-filter:blur(10px);
                   grid-template-columns:repeat(2,1fr);
               }
                
               .product-img-div2{
                   width:70px;
                   height:70px;
                   max-width:100px;
                   max-height:100px;
                   aspect-ratio:2/3;
               }
               .product-img-div2 img.order_img2{
                   border-radius:5px;
                   position:relative;
                   width:100%;
                   height:100%;
               }
               .p-name{
                   font-size:16px;
                   font-weight:bold;
                   color:#000000;
               }
               .p-qty , .p-price , .p-brand{
                   color:#000000;
               }
               
            </style>
            <div id="orders"></div>
            <script>
                   const phpOrderId = "<?php echo $orderID; ?>";
            </script>
           <script src="view/order.js"></script>
    </section>
<?php

}else{
    echo "<h2 style='margin:10px;text-align:center;'>determine id not found!</h2>";
    
};
?>
    <!-- Footer Section Start -->
    <?php include ("partials/footer.php") ?>
    <!-- Footer Section End -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- latest jquery-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/jquery-3.6.0.min.js"></script>

    <!-- jquery ui-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/jquery-ui.min.js"></script>

    <!-- Bootstrap js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/popper.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/bootstrap-notify.min.js"></script>

    <!-- Lazyload Js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/lazysizes.min.js"></script>

    <!-- Slick js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/slick.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/slick-animation.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/custom_slick.js"></script>

    <!-- feather icon js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather-icon.js"></script>

    <!-- script js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/script.js"></script>
</body>

</html>