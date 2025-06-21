<?php
include 'confi.php'; // Include your database connection file
include("partials/validation.php");
require_once 'global.php';

checkUserAuthentication();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchTerm'])) {
    $searchTerm = mysqli_real_escape_string($conn, trim($_POST['searchTerm']));
    $limit = 10; // Number of results per page
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // Current page
    $offset = ($page - 1) * $limit;

    // Construct the SQL query with LIMIT
    $query = "SELECT * FROM product WHERE product_name LIKE '%$searchTerm%' OR product_tag LIKE '%$searchTerm%' LIMIT $limit OFFSET $offset";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<div class="row g-8">';
        while ($row = mysqli_fetch_assoc($result)) {
            $noLogin = '<div class="col-xxl-2 col-lg-3 col-md-4 col-6 wow fadeInUp animated result-search" style="visibility: visible;">
            <div class="product-box-4">
                <div class="product-image">
                    <a href="javascript:void(0)">
                        <img src="' . BASE_URL . '/asset/assets/images/product/' . htmlspecialchars($row['product_banner']) . '" class="img-fluid" alt="' . htmlspecialchars($row['product_name']) . '">
                    </a>
                </div>
                <div class="product-detail">
                    <a href="#">
                        <h5 class="name">' . htmlspecialchars($row['product_name']) . '</h5>
                    </a>
                    <h5 class="price theme-color">₹' . htmlspecialchars($row['product_name']) . '</h5>
                    <div class="price-qty">
                        <div class="counter-number">
                            <b>Please Login to Purchase!</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
            $login = '<div class="col-xxl-2 col-lg-3 col-md-4 col-6 wow fadeInUp animated result-search" style="visibility: visible;">
                                                <div class="product-box-4">
                                                    <div class="product-image">

                                                        <a href="javascript:void(0)">
                                                            <img src="' . BASE_URL . '/asset/assets/images/product/' . htmlspecialchars($row['product_name']) . '" class="img-fluid" alt="' . htmlspecialchars($row['product_name']) . '">
                                                        </a>
                                                    </div>

                                                    <div class="product-detail">
                                                        <a href="#">
                                                            <h5 class="name">' . htmlspecialchars($row['product_name']) . '</h5>
                                                        </a>
                                                        <h5 class="price theme-color">
                                                            ₹' . htmlspecialchars($row['product_price']) . '                                                                                                                    </h5>
                                                        <div class="price-qty">
                                                            <div class="counter-number">
                                                                <div class="counter">

                                                                    <div class="qty-left-minus">
                                                                        <i class="fa-solid fa-minus"></i>
                                                                    </div>
                                                                    <input class="form-control input-number qty-input" type="text" name="quantity" value="0" fdprocessedid="gzqly8">

                                                                    <div class="qty-right-plus">
                                                                        <i class="fa-solid fa-plus"></i>
                                                                    </div>
                                                                </div>
                                                                <button class="add-to-cart-button buy-button buy-button-2 btn btn-cart" data-set="37" data-product="' . htmlspecialchars($row['product_id']) . '" data-price="' . htmlspecialchars($row['product_price']) . '" data-session="' . $_SERVER['REMOTE_ADDR'] . '" data-type="' . htmlspecialchars($row['product_unit']) . '" data-banner="' . htmlspecialchars($row['product_banner']) . '" disabled="">
                                                                    <i class="iconly-Buy icli text-white m-0"></i>
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';


            if (!isset($_COOKIE['HDF_user_login']) && !checkUserAuthentication()) {
                echo $noLogin;
            } else {
                echo $login;
            }
        }
        echo "</div>";


        // Pagination links (if needed)
        // echo "<div class='pagination'>";
        // echo "<a href='search.php?page=" . ($page - 1) . "'>Previous</a> | ";
        // echo "<a href='search.php?page=" . ($page + 1) . "'>Next</a>";
        // echo "</div>";
    } else {
        echo "<div>No results found.</div>";
    }
} else {
    echo "<div>Please enter a search term.</div>";
}
?>