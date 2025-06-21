<?php include ("partials/session.php") ?>
<?php include ('confi.php');
include ("partials/validation.php"); 
checkUserAuthentication();
$bSql = "SELECT * FROM hero_images";
$bRun = mysqli_query($conn, $bSql);

$heroImages = []; 

if ($bRun) {
    $heroImages = mysqli_fetch_all($bRun, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include("partials/head.php");?>
<body class="theme-color-2 bg-effect">
    <?php
    $ip = $_SERVER['REMOTE_ADDR'];
    ?>
<header class="pb-md-4 pb-0">
    <div class="header-top">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 d-xxl-block d-none">
                    <div class="top-left-header">
                        <i class="iconly-Location icli text-white"></i>
                        <span class="text-white">GAUR CITY 2 NOIDA EXTENTION, NOIDA, INDIA</span>
                    </div>
                </div>


                <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                    <div class="header-offer">
                        <div class="notification-slider">
                            <div>
                                <div class="timer-notification">
                                    <h6><strong class="me-1">Welcome to हर दिन Fresh Grocery!</strong>.<strong
                                            class="ms-1">New Coupon Code: Fast024
                                        </strong>

                                    </h6>
                                </div>
                            </div>

                            <div>
                                <div class="timer-notification">
                                    <h6>Something you love is now on sale!
                                        <a href="#" class="text-white">Buy Now
                                            !</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                </div>
            </div>
        </div>
    </div>

    <div class="top-nav top-header sticky-header">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-top">
                        <a href="index.php" class="web-logo nav-logo">
                            <img src="<?php echo BASE_URL; ?>/asset/assets/images/logo/1.png" class="img-fluid  lazyload" alt="">
                        </a>

                        <div class="rightside-box">
                            <ul class="right-side-menu">
                                <li class="right-side">
                                    <div class="onhover-dropdown header-badge">
                                        <button type="button" class="btn p-0 position-relative header-wishlist">
                                            <i data-feather="phone-call"></i>
                                        </button>

                                        <div class="onhover-div">
                                            <ul class="cart-list">
                                               <div class="delivery-detail">
                                        <div class="delivery-icon">
                                            <!--<i data-feather="phone-call"></i>-->
                                        </div>
                                        <div class="p-0 m-0">
                                            <button class="btn"><a href="mailto:support@hdfgrocery.shop">support@hdfgrocery.shop</a></button>
                                            <button class="btn"><a href="tel:+91 888 104 2340">+91 888 104 2340</a></button>
                                        </div>
                                        </div>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                </li>
                                <li class="right-side">
                                    <div class="onhover-dropdown header-badge">
                                        <button type="button" class="btn p-0 position-relative header-wishlist">
                                            <i data-feather="shopping-cart"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle badge">2
                                                <span class="visually-hidden">0</span>
                                            </span>
                                        </button>

                                        <div class="onhover-div">
                                            <ul class="cart-list">
                                            </ul>
                                            <div class="price-box">
                                                <h5>Navigate to :</h5>
                                                <h4 class="theme-color fw-bold"><a href="javascript:void(0)" class="btn btn-sm cart-button">cart/checkout</a></h4>
                                            </div>

                                            <div class="button-group">
                                                <a href="cart.php" class="btn btn-sm cart-button">Cart</a>
                                                <a href="checkout.php" class="btn btn-sm cart-button theme-bg-color
                                                    text-white">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php 
                                
                                if (!isset($_COOKIE['HDF_user_login']) && !checkUserAuthentication()){
                                ?>
                                        <style>
        .signfloat {
            position: absolute;
            height: 80px;
            width: 100%;
            z-index: 0;
            top: -500px;
            background:#0baf9a99;
            backdrop-filter:brightness(10%) blur(20px);
            left: 2px;
            display: flex;
            justify-content: space-between;
            padding:10px;
            border-radius:0 0 10px 10px;
            align-items: center;
        }

        .floadBoard {
            position:relative;
            background: #fcffff;
            width: max-content;
            /*top: 50%;*/
            /*left: 50%;*/
            /*transform: translate(-50px, -50px);*/
        }

        .floadBoard button {
            padding: 20px;
        }

        #onlySigninBtn {
            border-radius: 5px;
            color: currentColor;
            box-shadow: 1px 1px 2px;
            border: none;
            transition: .2s ease;
        }

        #onlySigninBtn:active {
            box-shadow: 1px 1px 0px;
        }

        .header .onhover-dropdown .onhover-div-login,
        .header .onhover-dropdown .onhover-div {
            box-shadow: none;
            background: transparent;
        }
    </style>
                                        <div class="signfloat">
        <a href="index.php" class="web-logo nav-logo">
                            <img src="<?php echo BASE_URL; ?>/asset/assets/images/full-white.png" class="img-fluid  lazyload" alt="">
                        </a>
        <div class="floadBoard">
            <div class="pe_signin_button" data-client-id="11327809409869315677">
                <script src="https://www.phone.email/sign_in_button_v1.js" async></script>
            </div>
        </div>
    </div>
                                        <script>
        const valueSign = document.querySelector('.signfloat') ? document.querySelector('.signfloat') : "";

        if (valueSign) {
            valueSign.style.top = '-500px';
            valueSign.style.zIndex = '999';
            valueSign.addEventListener('click', hideValueSign);
        }

        function showValueSign(top) {
            if (valueSign) {
                valueSign.style.zIndex = '999';
                valueSign.style.top = '-24px';
            }
        }

        // Function to hide the element
        function hideValueSign() {
            if (valueSign) {
                valueSign.style.top = '-500px';
            }
        }

        document.body.addEventListener('keyup', (e) => {
            if (e.keyCode === 13) { 
                if (valueSign) {
                    valueSign.style.top = '-24px';
                }
            }
        });

        document.body.addEventListener('keyup', (e) => {
            if (e.keyCode === 32) {
                if (valueSign) {
                    valueSign.style.top = '-500px';
                }
            }
        });
        document.addEventListener('scroll', () => {
            if (valueSign) {
                hideValueSign();
            }
        });
        function phoneEmailListener(userObj) {
    let user_json_url = userObj.user_json_url;
    
    let loader = document.createElement('div');
    loader.id = 'loader';
    loader.style.position = 'fixed';
    loader.style.top = '0';
    loader.style.left = '0';
    loader.style.width = '100vw';
    loader.style.height = '100vh';
    loader.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    loader.style.display = 'flex';
    loader.style.justifyContent = 'center';
    loader.style.alignItems = 'center';
    loader.style.color = 'white';
    loader.style.fontSize = '24px';
    loader.textContent = 'Loading...';
    document.body.appendChild(loader);
    
    fetch('verify.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ user_json_url: user_json_url })
    })
    .then(response => response.json())
    .then(data => {
        document.body.removeChild(loader);
        
        console.log(data);
        if (data.success) {
            noti("Awesome", data.txt[0], "primary");
            setTimeout(() => {
                location.href = "redirect.php";
            }, 1000);
        } else {
            noti("Error!", data.txt[0], "danger");
        }
    })
    .catch(error => {
        document.body.removeChild(loader);
        console.log(error);
    });
}
    </script>
    
                                        <li class="right-side" id="onlySigninBtn">
                                        <div class="delivery-login-box">
                                             <div class="delivery-icon">
                                              <i data-feather="user"></i>
                                             </div>
                                        </div>
                                         <script>
                                                        const signinBtn = document.getElementById('onlySigninBtn') ? document.getElementById('onlySigninBtn') : "";
                                                        if (signinBtn) {
                                                            signinBtn.addEventListener('click', (event) => {
                                                                event.stopPropagation();
                                                                const currentTop = valueSign.style.top;
                                                                const newTop = currentTop === '0px' ? '-500px' : '0px';
                                                                showValueSign(newTop);
                                                            })
                                                        }
                                                        document.addEventListener('click', (event) => {
                                                            if (!valueSign.contains(event.target) && !signinBtn.contains(event.target)) {
                                                                hideValueSign();
                                                            }
                                                        });
                                        </script>
                                
                                <?php
                                
                                } else{
                                ?>
                                    <li class="right-side onhover-dropdown" id="">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>

                                    <div class="onhover-div onhover-div-login">
                                        <ul class="user-box-name">
                                                <p>Hello, 
                                                    <?php
                                                    // list($userID,$token,userName) = explode(':' , $_COOKIE['HDF_user_login']);
                                                    $namePart = explode(" ", htmlspecialchars($HDFuser['name']));
                                                    echo $namePart[0] . " \u{1F60A}";
                                                    ?>
                                                </p>
                                                <li class="product-box-contain">
                                                    <a href="dashboard.php">Account</a>
                                                </li>
                                                <li class="product-box-contain">
                                                    <!--<i></i>-->
                                                    <a href="logout.php">Logout</a>
                                                </li>
                                        </ul>

                                    </div>
                                    <?php
                                }
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Categories -->
    <?php #include ('partials/headerCat.php') ?>
</header>
<!-- Header End -->
    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>Home</span>
                </a>
            </li>

            <li>
                <a href="cart.php" class="notifi-wishlist">
                    <i class="iconly-Heart icli"></i>
                    <span>Cart</span>
                </a>
            </li>

            <li>
                <a href="dashboard.php">
                    <i class="iconly-Bag-2 icli fly-cate"></i>
                    <span>Account</span>
                </a>
            </li>
             <li>
                <a href="checkout.php">
                    <i class="iconly-Bag-2 icli fly-cate"></i>
                    <span>Checkout</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->
<!-- Header End -->
    <style>
    body .visibtnsop {
        visibility: visible !important;
    }
    #search-container{
        display: block;
    }
    #searchBar{
        width: 100%;
        padding:12px 14px;
        border-radius: 10px;
        border: .8px solid #acacac;
        background: #ffffff;
        box-shadow: 2px 5px 2px #aeafac;
    }
    </style>
    <!-- Product Section Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="title title-flex-2">
                <h2>Our Products</h2>
                <ul class="nav nav-tabs tab-style-color-2 tab-style-color" id="myTab">
                    <li class="nav-item">
                        <button class="list-tab-pane-click nav-link btn active" id="all" data-bs-toggle="tab" data-bs-target="#"
                            type="button">All</button>
                    </li>
                    <?php
                    $query = "SELECT * FROM `category` WHERE 1 ORDER BY RAND()";
                    $run = mysqli_query($conn, $query);
                    if ($run) {
                        if (mysqli_num_rows($run) > 0) {
                            while ($row = mysqli_fetch_assoc($run)) {
                                    $catId = str_replace(" ", "_", $row['catname']);
                                    ?>
                                    <li class="nav-item">
                                        <button class="list-tab-pane-click nav-link btn" id="<?php echo $catId; ?>" data-bs-toggle="tab"
                                            data-bs-target="#" type="button"><?php echo ucwords($row['catname']); ?></button>
                                    </li>
                                <?php
                            }
                        }
                    } ?>
                </ul>
                <div class="row drone-up-fade" id="search-container">
                    <div class="col-12">
                        <div class="search-input">
                            <input type="text" id="searchBar" placeholder="Search for products..." />
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-content" id="content-tab-pane-result" data-cat-tab-pane-result="all">
                        <div class="tab-pane fade show active" id="All" role="tabpanel">
                            <div class="row g-8">
                                <?php
                                $allquery = "SELECT * FROM `product` WHERE 1";
                                $allrun = mysqli_query($conn, $allquery);
                                if ($allrun) {
                                    if (mysqli_num_rows($allrun) > 0) {
                                        while ($rok = mysqli_fetch_assoc($allrun)) {
                                            $category = str_replace(" ", "_", $rok['product_category']);
                                            ?>
                                            <div class="col-xxl-2 col-lg-3 col-md-4 col-6 wow fadeInUp" data-target-tab-pane-result="<?php echo $category ?>"
                                            data-target-tab-name-result="<?php echo htmlspecialchars($rok['product_name']); ?>">
                                                <div class="product-box-4">
                                                    <div class="product-image">

                                                        <a href="javascript:void(0)">
                                                            <img src="<?php echo BASE_URL; ?>/asset/assets/images/product/<?php echo htmlspecialchars($rok['product_banner']); ?>"
                                                                class="img-fluid"
                                                                alt="<?php echo htmlspecialchars($rok['product_name']); ?>">
                                                        </a>
                                                    </div>

                                                    <div class="product-detail">
                                                        <ul class="rating">
                                                            <?php
                                                            $random_number = mt_rand(1, 5);
                                                            for ($i = 1; $i <= 5; $i++) {
                                                                if ($i <= $random_number) {
                                                                    echo '<li><i data-feather="star" class="fill"></i></li>';
                                                                } else {
                                                                    echo '<li><i data-feather="star"></i></li>';
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                        <a href="#">
                                                            <h5 class="name product-box-modal-name"><?php echo htmlspecialchars($rok['product_name']); ?></h5>
                                                        </a>
                                                        <h5 class="price theme-color">
                                                            &#x20B9;<?php echo htmlspecialchars($rok['product_price']); ?>
                                                            <?php
                                                            $unitAs = htmlspecialchars($rok['product_unit']);
                                                            $unitQuery = "SELECT unit_name FROM units WHERE unit_as = '$unitAs'";
                                                            $unitRun = mysqli_query($conn, $unitQuery);
                                                            if (mysqli_num_rows($unitRun) > 0) {
                                                                while ($unitRow = mysqli_fetch_assoc($unitRun)) {
                                                                    echo $unitRow['unit_name'];
                                                                }
                                                            }
                                                            ?>
                                                        </h5>
                                                        <div class="price-qty">
                                                            <div class="counter-number">
                                                                <div class="counter">

                                                                    <div class="qty-left-minus">
                                                                        <i class="fa-solid fa-minus"></i>
                                                                    </div>
                                                                    <input class="form-control input-number qty-input" type="text"
                                                                        name="quantity" value="0">

                                                                    <div class="qty-right-plus">
                                                                        <i class="fa-solid fa-plus"></i>
                                                                    </div>
                                                                </div>
                                                                <button class="add-to-cart-button buy-button buy-button-2 btn btn-cart"
                                                                    <?php if (isset($_COOKIE['HDF_user_login']) && checkUserAuthentication()) { ?>
                                                                        data-set="<?php echo $HDFuser['id'] ?>"
                                                                        data-product="<?php echo $rok['product_id'] ?>"
                                                                        data-price="<?php echo floatval($rok['product_price']) ?>"
                                                                        data-session="<?php echo $ip ?>" data-type="<?php echo $unitAs ?>"
                                                                        data-banner="<?php echo $rok['product_banner'] ?>" <?php } else { ?>
                                                                        onclick='showValueSign()' <?php } ?>>
                                                                    <i class="iconly-Buy icli text-white m-0"></i>
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                } ?>
                            </div>
                        </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Banner Section Start -->

    <!-- Footer Start -->
    <?php include("partials/footer.php") ?>
    <!-- Footer End -->

    <!-- Quick View Modal Box Start -->
    <div class="modal fade theme-modal view-modal" id="view" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">
                        <div class="col-lg-6">
                            <div class="slider-image">
                                <img src="<?php echo BASE_URL; ?>/asset/assets/images/product/category/1.jpg" class="img-fluid  lazyload"
                                    alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">Peanut Butter Bite Premium Butter Cookies 600 g</h4>
                                <h4 class="price">$36.99</h4>
                                <div class="product-rating">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                    <span class="ms-2">8 Reviews</span>
                                    <span class="ms-2 text-danger">6 sold in last 16 hours</span>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>Candy canes sugar plum tart cotton candy chupa chups sugar plum chocolate I love.
                                        Caramels marshmallow icing dessert candy canes I love soufflé I love toffee.
                                        Marshmallow pie sweet sweet roll sesame snaps tiramisu jelly bear claw. Bonbon
                                        muffin I love carrot cake sugar plum dessert bonbon.</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Brand Name:</h5>
                                            <h6>Black Forest</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>W0690034</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Type:</h5>
                                            <h6>White Cream Cake</h6>
                                        </div>
                                    </li>
                                </ul>

                                <div class="select-size">
                                    <h4>Cake Size :</h4>
                                    <select class="form-select select-form-size">
                                        <option selected>Select Size</option>
                                        <option value="1.2">1/2 KG</option>
                                        <option value="0">1 KG</option>
                                        <option value="1.5">1/5 KG</option>
                                        <option value="red">Red Roses</option>
                                        <option value="pink">With Pink Roses</option>
                                    </select>
                                </div>

                                <div class="modal-button">
                                    <button onclick="location.href = 'cart.php';"
                                        class="btn btn-md add-cart-button icon">Add
                                        To Cart</button>
                                    <button onclick="location.href = 'product-left.php';"
                                        class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                        View More Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Items section Start -->
    <div class="button-item">
        <button class="item-btn btn text-white">
            <i class="iconly-Bag-2 icli"></i>
        </button>
    </div>
    <div class="item-section">
        <button class="close-button">
            <i class="fas fa-times"></i>
        </button>
        <h6>
            <i class="iconly-Bag-2 icli"></i>
            <span><span id="cartTotalItem"></span> Items</span>
        </h6>
        <ul class="items-image" id="cartTotalItemList">

        </ul>
        <button onclick="location.href = 'cart.php';" class="btn item-button btn-sm fw-bold">&#x20B9; <span
                id="cartTotalSum"></span></button>
    </div>

    <!-- Items section End -->

    <!-- Tap to top and theme setting button start -->
    <div class="theme-option">

        <div class="back-to-top">
            <a id="back-to-top" href="#">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <!-- Tap to top and theme setting button end -->

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

    <!-- feather icon js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather-icon.js"></script>

    <!-- Slick js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/slick.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/bootstrap-notify.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/custom_slick.js"></script>

    <!-- Auto Height Js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/auto-height.js"></script>

    <!-- Quantity Js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/quantity.js"></script>


    <!-- Fly Cart Js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/fly-cart.js"></script>

    <!-- WOW js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/wow.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/custom-wow.js"></script>

    <!-- script js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/script.js"></script>
    <script src="addcart.js"></script>
    <script src="input.js"></script>
</body>

</html>