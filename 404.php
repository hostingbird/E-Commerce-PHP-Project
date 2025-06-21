<?php
$wrongUrl = !empty($_SERVER['HTTPS']) ? $_SERVER['REQUEST_URI'] : 'Unknown';
?>
<?php include ("partials/session.php") ?>
<?php include ('confi.php');
include ("partials/validation.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<?php include ("partials/head.php") ?>
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
                        <h2>404 Page</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="home.php">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">404</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- 404 Section Start -->
    <section class="section-404 section-lg-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="image-404">
                        <img src="<?php echo BASE_URL; ?>/asset/assets/images/inner-page/404.png" class="img-fluid blur-up lazyload" alt="">
                    </div>
                </div>

                <div class="col-12">
                    <div class="contain-404">
                        <h3 class="text-content">The page <strong><?php echo htmlspecialchars($wrongUrl); ?></strong></h3> you want to access is removed or not exist in my record.</h3>
                        <button onclick="location.href = 'index.php';"
                            class="btn btn-md text-white theme-bg-color mt-4 mx-auto">Back To Home Screen</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 404 Section End -->

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
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/custom_slick.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/slick.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/slick-animation.min.js"></script>

    <!-- feather icon js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather-icon.js"></script>

    <!-- script js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/script.js"></script>
</body>

</html>