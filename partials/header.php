
<script>
    var currentUrl = window.location.href;
        var url = new URL(currentUrl);
        var domain = url.hostname;
        var pathname = url.pathname;
        var pathParts = pathname.split('/').filter(Boolean);

        // Get the first directory (if it exists)
        var firstDirectory = pathParts.length > 0 ? '/' + pathParts[0] : '';
        let finalURL = domain+firstDirectory;
</script>
<!-- Loader Start -->
    <!--<div class="fullpage-loader">-->
    <!--    <span></span>-->
    <!--    <span></span>-->
    <!--    <span></span>-->
    <!--    <span></span>-->
    <!--    <span></span>-->
    <!--    <span></span>-->
    <!--</div>-->
    <!-- Loader End -->

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
                                            class="ms-1">Daily New Daily fresh
                                        </strong>

                                    </h6>
                                </div>
                            </div>

                            <div>
                                <div class="timer-notification">
                                    <h6>Something you love is now on sale!
                                        <a href="shop-left-sidebar.php" class="text-white">Buy Now
                                            !</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3"></div>
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
                                            <!--<span class="position-absolute top-0 start-100 translate-middle badge">2-->
                                            <!--    <span class="visually-hidden"></span>-->
                                            <!--</span>-->
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
                                            <span class="position-absolute top-0 start-100 translate-middle badge">0
                                                <span class="visually-hidden">0</span>
                                            </span>
                                        </button>

                                        <div class="onhover-div">
                                            <ul class="cart-list">
                                                <!--<li class="product-box-contain">-->
                                                <!--    <div class="drop-cart">-->
                                                <!--        <a href="product-left-thumbnail.php" class="drop-image">-->
                                                <!--            <img src="https://hdfgrocery.shop/asset/assets/images/vegetable/product/1.png"-->
                                                <!--                class=" lazyload" alt="">-->
                                                <!--        </a>-->

                                                <!--        <div class="drop-contain">-->
                                                <!--            <a href="product-left-thumbnail.php">-->
                                                <!--                <h5>Fantasy Crunchy Choco Chip Cookies</h5>-->
                                                <!--            </a>-->
                                                <!--            <h6><span>1 x</span> $80.58</h6>-->
                                                <!--            <button class="close-button close_button">-->
                                                <!--                <i class="fa-solid fa-xmark"></i>-->
                                                <!--            </button>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</li>-->

                                                <!--<li class="product-box-contain">-->
                                                <!--    <div class="drop-cart">-->
                                                <!--        <a href="product-left-thumbnail.php" class="drop-image">-->
                                                <!--            <img src="https://hdfgrocery.shop/asset/assets/images/vegetable/product/2.png"-->
                                                <!--                class=" lazyload" alt="">-->
                                                <!--        </a>-->

                                                <!--        <div class="drop-contain">-->
                                                <!--            <a href="product-left-thumbnail.php">-->
                                                <!--                <h5>Peanut Butter Bite Premium Butter Cookies 600 g-->
                                                <!--                </h5>-->
                                                <!--            </a>-->
                                                <!--            <h6><span>1 x</span> $25.68</h6>-->
                                                <!--            <button class="close-button close_button">-->
                                                <!--                <i class="fa-solid fa-xmark"></i>-->
                                                <!--            </button>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</li>-->
                                            </ul>

                                            <!--<div class="price-box">-->
                                            <!--    <h5>Total :</h5>-->
                                            <!--    <h4 class="theme-color fw-bold">$106.58</h4>-->
                                            <!--</div>-->
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
                            <img src="<?php echo BASE_URL; ?>/asset/assets/images/logo/1.png" class="img-fluid  lazyload" alt="">
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
        if (data.success) {
            noti("Awesome", data.txt[0] + data.id[0], "primary");
            setTimeout(() => {
                location.href = "redirect.php";
            }, 1000);
        } else {
            noti("Error!", data.txt[0], "danger");
        }
    })
    .catch(error => {
        document.body.removeChild(loader);
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