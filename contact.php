<?php
$orderID = !empty($_GET['orderId']) ? $_GET['orderId'] : '';
?>
<?php include("partials/session.php") ?>
<?php include('confi.php');
include("partials/validation.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php include("partials/head.php") ?>

<body>

    <!-- Header Start -->
    <?php include('partials/header.php') ?>
    <!-- Header End -->

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Contact us</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="home.php">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Contact us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="section-404 section-lg-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="image-404">
                        <img src="<?php echo BASE_URL; ?>/asset/assets/svg/contact-i.svg"
                            class="img-fluid blur-up lazyload" alt="">
                    </div>
                </div>
                <style>
                    .occ-title {
                        font-size: 2rem;
                        color: #82e4a3;
                        margin: 14px 0;
                        padding: 4px 0;
                        border-radius: 50px;
                        background: radial-gradient(#1e6348 70%, #1e6348 90%, #ffffff99 70%);
                    }

                    .occ {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);

                        gap: 10px;

                    }

                    .lg-2 {
                        grid-template-rows: repeat(2, 1fr);
                    }


                    .click_contact {
                        background: #82e4a3;
                        min-height: 90px;
                        border-radius: 4px;
                        display: flex;
                        flex-direction: column;
                    }

                    .click_flap {
                        position: relative;
                        display: flex;
                        align-items: center;
                        height: 100%;
                        justify-content: flex-start;
                        padding: 12px;
                    }

                    .click_flap a {
                        color: #1e6348;
                        font-weight: 700;
                        font-size: 1.2rem;
                    }

                    .click_flap i {
                        position: absolute;
                        width: 50px;
                        right: 0;
                        top: 25%;
                        transform: translate(-10px, 0px);
                        background: #ffffff;
                        box-shadow: 0 0 4px;
                        border-radius: 50%;
                    }

                    .click_flap i img {
                        mix-blend-mode: multiply;
                        max-width: 100%;
                        min-width: 100%;
                    }
                </style>
                <div class="col-12">
                    <div class="contain-404">
                        <h2 class="occ-title">(OCC) One Click Contact</h2>
                        <div class="occ lg-2">
                            <div class="click_contact sm-column">
                                <span class="click_flap">
                                    <a href="https://web.whatsapp.com/send?phone=+918881042340&text=<?php
                                    if (isset($_GET['orderId'])) {
                                        echo "Help!%20Order%20ID%20%3A%" . $_GET['orderId'] . "%20";
                                    } else {
                                        echo "HDF%20CONTACT";
                                    } ?>" class="mobile"><i class="cc_icon"><img
                                                src="<?php echo BASE_URL; ?>/asset/assets/whatsapp.png"></i>
                                        WHATSAPP</a>
                                </span>
                            </div>
                            <div class="click_contact sm-column">
                                <span class="click_flap">
                                    <a href="mailto:support@domain.com?subject=<?php
                                    if (isset($_GET['orderId'])) {
                                        echo "Help!%20Order%20ID%20%3A%" . $_GET['orderId'] . "%20&body='Help!%20Order%20ID%20%3A%'" . $_GET['orderId'] . "%20";
                                    } else {
                                        echo "HDF%20CONTACT&body='Contact info'";
                                    } ?>" class="mobile"><i class="cc_icon"><img
                                                src="<?php echo BASE_URL; ?>/asset/assets/message.gif"></i>
                                        EMAIL</a>
                                </span>
                            </div>
                            <div class="click_contact sm-column">
                                <span class="click_flap">
                                    <a href="tel:+918881042340" class="mobile"><i class="cc_icon"><img
                                                src="<?php echo BASE_URL; ?>/asset/assets/phone.gif"></i>
                                        PHONE</a>
                                </span>
                            </div>

                            <div class="click_contact sm-column">
                                <span class="click_flap">
                                    <a class="mobile" href="sms:+91 888 104 2340?body=<?php
                                    if (isset($_GET['orderId'])) {
                                        echo "Help!%20Order%20ID%20%3A%" . $_GET['orderId'] . "%20";
                                    } else {
                                        echo "HDF%20CONTACT";
                                    } ?>"><i class="cc_icon"><img
                                                src="<?php echo BASE_URL; ?>/asset/assets/chat.gif"></i>
                                        SMS</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="contain-404">
                        <h2 class="occ-title">Contact Details</h2>
                        <div class="occ">
                            <div class="click_contact">
                                <span class="click_flap mobile">
                                    <i class="cc_icon"><img src="<?php echo BASE_URL; ?>/asset/assets/whatsapp.png"></i>
                                    +91 888 104 2340
                                </span>
                            </div>
                            <div class="click_contact">
                                <span class="click_flap mobile">
                                    <i class="cc_icon"><img src="<?php echo BASE_URL; ?>/asset/assets/message.gif"></i>
                                    support@domain.com
                                </span>
                            </div>
                            <div class="click_contact">
                                <span class="click_flap mobile">
                                    <i class="cc_icon"><img src="<?php echo BASE_URL; ?>/asset/assets/phone.gif"></i>
                                    +91 888 104 2340
                                </span>
                            </div>

                            <div class="click_contact">
                                <span class="click_flap mobile">
                                    <i class="cc_icon"><img src="<?php echo BASE_URL; ?>/asset/assets/chat.gif"></i>
                                    +91 888 104 2340
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section Start -->
    <?php include("partials/footer.php") ?>
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