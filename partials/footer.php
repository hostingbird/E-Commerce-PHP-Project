<footer class="section-t-space">
    <div class="container-fluid-lg">
        <div class="service-section">
            <div class="row g-3">
                <div class="col-12">
                    <div class="service-contain">
                        <div class="service-box">
                            <div class="service-image">
                                <img src="<?php echo BASE_URL; ?>/asset/assets/svg/product.svg" class=" lazyload"
                                    alt="">
                            </div>
                            <div class="service-detail">
                                <h5>Every Fresh Products</h5>
                            </div>
                        </div>

                        <div class="service-box">
                            <div class="service-image">
                                <img src="<?php echo BASE_URL; ?>/asset/assets/svg/delivery.svg" class=" lazyload"
                                    alt="">
                            </div>

                            <div class="service-detail">
                                <h5>Free Delivery</h5>
                            </div>
                        </div>

                        <div class="service-box">
                            <div class="service-image">
                                <img src="<?php echo BASE_URL; ?>/asset/assets/svg/discount.svg" class=" lazyload"
                                    alt="">
                            </div>

                            <div class="service-detail">
                                <h5>Daily Mega Discounts</h5>
                            </div>
                        </div>

                        <div class="service-box">
                            <div class="service-image">
                                <img src="<?php echo BASE_URL; ?>/asset/assets/svg/market.svg" class=" lazyload" alt="">
                            </div>

                            <div class="service-detail">
                                <h5>Best Price On The Market</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-footer section-b-space section-t-space">
            <div class="row g-md-4 g-3">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-logo">
                        <div class="theme-logo">
                            <a href="<?php echo BASE_URL; ?>/index.php">
                                <img src="<?php echo BASE_URL; ?>/asset/assets/images/logo/1.png" class=" lazyload"
                                    alt="">
                            </a>
                        </div>

                        <div class="footer-logo-contain">
                            <p>We are your go-to online store for grocery and fresh food needs, offering a wide range of
                                vegetables, fruits, and pantry essentials.</p>

                            <ul class="address">
                                <li>
                                    <i data-feather="home"></i>
                                    <a href="javascript:void(0)">GAUR CITY 2 NOIDA EXTENTION, NOIDA, INDIA</a>
                                </li>
                                <li>
                                    <i data-feather="mail"></i>
                                    <a href="javascript:void(0)">support@domain.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Categories</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <?php
                            $query = "SELECT * FROM `category` WHERE 1 ORDER BY RAND()";
                            $run = mysqli_query($conn, $query);
                            if ($run) {
                                if (mysqli_num_rows($run) > 0) {
                                    $count = 0;
                                    while ($row = mysqli_fetch_assoc($run)) {
                                        $count++;
                                        if ($count < 7) {
                                            ?>
                                            <li>
                                                <a href="javascript:void(0)"
                                                    class="text-content"><?php echo ucwords($row['catname']) ?></a>
                                                <!--<a href="category.php?category=<?php #echo $row['cat_id'] ?>&categoryName=<?php #echo $row['catname'] ?>"-->
                                                <!--    class="text-content"><?php #echo ucwords($row['catname']) ?></a>-->
                                            </li>
                                        <?php }
                                    }
                                }
                            }
                            mysqli_close($conn); ?>
                        </ul>
                    </div>
                </div>

                <div class="col-xl col-lg-2 col-sm-3">
                    <div class="footer-title">
                        <h4>Useful Links</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <li>

                                <a href="<?php $ctr = "javascript:void(0)";
                                echo $ctr; ?>/index.php" class="text-content">Home</a>
                            </li>
                            <li>
                                <a href="<?php echo $ctr; ?>/" class="text-content">Shop</a>
                            </li>
                            <li>
                                <a href="<?php echo $ctr; ?>/" class="text-content">About Us</a>
                            </li>
                            <li>
                                <a href="<?php echo $ctr; ?>/" class="text-content">Blog</a>
                            </li>
                            <li>
                                <a href="contact.php" class="text-content">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-sm-3">
                    <div class="footer-title">
                        <h4>Help Center</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <li>
                                <a href="dashboard.php" class="text-content">Your Order</a>
                            </li>
                            <li>
                                <a href="dashboard.php" class="text-content">Your Account</a>
                            </li>
                            <li>
                                <a href="dashboard.php" class="text-content">Track Order</a>
                            </li>
                            <li>
                                <a href="index.php" class="text-content">Search</a>
                            </li>
                            <li>
                                <a href="contact.php" class="text-content">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Contact Us</h4>
                    </div>

                    <div class="footer-contact">
                        <ul>
                            <li>
                                <div class="footer-number">
                                    <i data-feather="phone"></i>
                                    <div class="contact-number">
                                        <h6 class="text-content">Hotline 24/7 :</h6>
                                        <h5>+91 888 104 2340</h5>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="footer-number">
                                    <i data-feather="mail"></i>
                                    <div class="contact-number">
                                        <h6 class="text-content">Email Address :</h6>
                                        <h5>support@domain.com</h5>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="sub-footer section-small-space">
            <div class="reserve">
                <h6 class="text-content">©2022 हर दिन Fresh Grocery All rights reserved</h6>
            </div>

            <div class="payment">
                <img src="<?php echo BASE_URL; ?>/asset/assets/images/payment/1.png" class=" lazyload" alt="">
            </div>
        </div>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.pe_signin_button svg').forEach(svg => svg.remove());
    })
</script>