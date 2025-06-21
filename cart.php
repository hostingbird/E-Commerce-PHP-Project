<?php include ("partials/session.php") ?>
<?php include ('confi.php');
include ("partials/validation.php");
include ("errorReport.php");
?>

<!DOCTYPE html>
<html lang="en">
<?php include ("partials/head.php") ?>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Header Start -->
    <?php include ('partials/header.php') ?>

    <!-- Header End -->

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Cart</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="home.php">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Cart Section Start -->
<?php if($_COOKIE['HDF_user_login']){?>
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <?php
            $user_id = $HDFuser['id'];
            if (isset($user_id)) {
                
                $selectQuery = "SELECT * FROM `cart` WHERE user_id = ? AND status = 'active'";
                $stmt = $conn->prepare($selectQuery);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $selectResult = $stmt->get_result();

                if ($selectResult->num_rows > 0) {
                    $grandTotal = 0;
                    $Totalsave = 0;
                    $TotalCount = 0;
                    ?>
                    <div class="row g-sm-5 g-3">
                        <div class="col-xxl-9">
                            <div class="cart-table">
                                <div class="table-responsive-xl">
                                    <?php
                                    while ($row = $selectResult->fetch_assoc()) {
                                        $product_id = $row['product_id'];
                                        $productQuery = "SELECT * FROM `product` WHERE product_id = ?";
                                        $productStmt = $conn->prepare($productQuery);
                                        $productStmt->bind_param("i", $product_id);
                                        $productStmt->execute();
                                        $productResult = $productStmt->get_result();

                                        if ($productResult->num_rows > 0) {
                                            while ($col = $productResult->fetch_assoc()) {
                                                $pname = $col['product_name'];
                                                $pbrand = $col['product_brand'];
                                                $pbanner = $col['product_banner'];
                                                $itemQuantity = $row['quantity'];
                                                $pprice = $col['product_price'];
                                                $TotalCount += $itemQuantity;

                                                // UnitType Fetch From Unit
                                                $unit_name = $col['product_unit'];
                                                $unitStmt = $conn->prepare("SELECT unit_as FROM units WHERE unit_name = ?");
                                                $unitStmt->bind_param("s", $unit_name);
                                                $unitStmt->execute();
                                                $unitResult = $unitStmt->get_result();

                                                if ($unitRow = $unitResult->fetch_assoc()) {
                                                    $pUnitType = $unitRow['unit_as'];
                                                }
                                                $total = floatval($itemQuantity) * floatval($pprice);
                                                $grandTotal += $total;
                                                ?>
                                                <br>
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="product-box-contain detail_item_box-contain"
                                                            data-product-id="<?php echo $product_id; ?>">
                                                            <td class="product-detail">
                                                                <div class="product border-0">
                                                                    <a href="#" class="product-image">
                                                                        <img src="<?php echo BASE_URL; ?>/asset/assets/images/product/<?php echo $pbanner; ?>"
                                                                            class="img-fluid blur-up lazyload" alt="">
                                                                    </a>
                                                                    <div class="product-detail">
                                                                        <ul>
                                                                            <li class="name">
                                                                                <a href="#"><?php echo ucwords($pname); ?></a>
                                                                            </li>

                                                                            <li class="text-content"><span class="text-title">Sold
                                                                                    By:</span> <?php echo ucwords($pbrand); ?></li>

                                                                            <li class="text-content">
                                                                                <span
                                                                                    class="text-title">Quantity</span> -
                                                                                <span class="quantityTxt"></span>
                                                                            </li>

                                                                            <li>
                                                                                <h5 class="text-content d-inline-block">Price :</h5>
                                                                                <span>&#x20B9;<?php echo $pprice; ?></span>
                                                                            </li>

                                                                            <li>
                                                                                <h5>Total: &#x20B9;<?php echo $total; ?></h5>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="price">
                                                                <h4 class="table-title text-content">Price</h4>
                                                                <h5>&#x20B9;<?php echo floatval($pprice); ?></h5>
                                                            </td>

                                                            <td class="quantity">
                                                                <h4 class="table-title text-content">Qty</h4>
                                                                <div class="quantity-price">
                                                                    <div class="cart_qty">
                                                                        <div class="input-group">
                                                                            <button type="button" class="btn qty-left-minus"
                                                                                data-type="minus" data-field="">
                                                                                <i class="fa fa-minus ms-0"></i>
                                                                            </button>
                                                                            <input class="form-control input-number qty-input" type="text"
                                                                                name="quantity" value="<?php echo $itemQuantity; ?>"
                                                                                data-product-id="<?php echo $product_id; ?>">
                                                                            <button type="button" class="btn qty-right-plus"
                                                                                data-type="plus" data-field="">
                                                                                <i class="fa fa-plus ms-0"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="subtotal">
                                                                <h4 class="table-title text-content">Total</h4>
                                                                <h5>&#x20B9;<span class="eachProductTotal"></span></h5>
                                                                <!--<h6 class="theme-color">You Save :-->
                                                                <!--    &#x20B9;<span class="indivPsave"></span></h6>-->
                                                            </td>

                                                            <td class="save-remove">
                                                                <h4 class="table-title text-content">Action</h4>
                                                                <a class="remove-from-cart-button remove close_button"
                                                                    href="javascript:void(0)"
                                                                    data-product-id="<?php echo $product_id; ?>">Remove</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <br>
                                            <?php }
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3">
                            <div class="summery-box p-sticky">
                                <div class="summery-header">
                                    <h3>Cart Total</h3>
                                </div>

                                <ul class="summery-total">
                                    <!--<li class="list-total border-top-0">-->
                                    <!--    <h4>Total Amount</h4>-->
                                    <!--    <h4 class="price theme-color">&#x20B9;<span class="Totalamt"></span></h4>-->
                                    <!--</li>-->
                                    <!--<li class="list-total border-top-0">-->
                                    <!--    <h4>Discount (&#x20B9;)</h4>-->
                                    <!--    <h4 class="price theme-color">&#x20B9;<span class="TotalDisc"></span></h4>-->
                                    <!--</li>-->
                                    <li class="list-total border-top-0">
                                        <h4>Total Payable (INR)</h4>
                                        <h4 class="price theme-color" id="total-amount">&#x20B9;<span
                                                class="TotalNetPay"></span></h4>
                                    </li>
                                </ul>

                                <div class="button-group cart-button">
                                    <ul>
                                        <li>
                                            <button onclick="location.href = 'checkout.php';"
                                                class="btn btn-animation proceed-btn fw-bold">Process To Checkout</button>
                                        </li>

                                        <li>
                                            <button onclick="location.href = 'index.php';"
                                                class="btn btn-light shopping-button text-dark">
                                                <i class="fa-solid fa-arrow-left-long"></i>Return To Shopping</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "<h2>Hey , Your Cart is Empty! Please add some Products here. <a href='index.php'> Explore</a></h2>";
                }
            } else {
                echo "<address>There was Some Technical issue. (cart error).</address>";
            }
            ?>
        </div>
    </section>
<?php }else{
      echo "<br><center><h2><address>- There was Some Technical issue. (user error).</address></h2</center><br>";
    }?>
    <!-- Cart Section End -->

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

    <!-- feather icon js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather-icon.js"></script>

    <!-- Lazyload Js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/lazysizes.min.js"></script>

    <!-- Slick js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/slick.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/custom_slick.js"></script>

    <!-- Quantity js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/quantity.js"></script>

    <!-- script js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/script.js"></script>
    <script src="deletecart.js"></script>
</body>
<script>

</script>

</html>