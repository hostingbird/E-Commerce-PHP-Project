<?php include ("partials/session.php") ?>
<?php include ('confi.php');
include ("partials/validation.php");
include ("errorReport.php");
?>
<!DOCTYPE html>
<html lang="en">
<link href="order.css" rel="stylesheet"></link>
<?php include("partials/head.php") ?>

<body>
    <!-- Header Start -->
    <?php include('partials/header.php') ?>
    <?php
    $user_id = $HDFuser['id'];
    $userName = $HDFuser['name'];
    $userPhone = $HDFuser['phone'];
    $userGender = $HDFuser['gender'];
    $userDOB = $HDFuser['dob'];
    $userDOR = $HDFuser['dor'];
    
    $phoneNumber;

    if ($userPhone) {
        $countryCode = substr($userPhone, 0, 3); 
        $firstFour = substr($userPhone, 3,4);  
        $lastTwo = substr($userPhone, -2);  
        $phoneNumber = $countryCode." " . $firstFour . '*****' . $lastTwo;
    } else {
        echo 'not found!';
    }
    ?>

    <!-- User Dashboard Section Start -->
    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 col-lg-4" style="z-index:999;">
                    <div class="dashboard-left-sidebar">
                        <div class="close-button d-flex d-lg-none">
                            <button class="close-sidebar">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="profile-box">
                            <div class="cover-image">
                                <img src="https://static.vecteezy.com/system/resources/previews/002/885/318/large_2x/nature-green-tree-fresh-leaf-on-beautiful-blurred-soft-bokeh-sunlight-background-with-free-copy-space-spring-summer-or-environment-cover-page-template-web-banner-and-header-free-photo.jpg"
                                    class="img-fluid blur-up lazyload" alt="">
                            </div>

                            <div class="profile-contain">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        <img src="https://cdn4.iconfinder.com/data/icons/green-shopper/1068/user.png"
                                            class="blur-up lazyload update_img" alt="">
                                    </div>
                                </div>

                                <div class="profile-name">
                                    <h3><?php echo htmlspecialchars($userName); ?></h3>
                                    <h6 class="text-content"><?php echo $phoneNumber; ?></h6>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-dashboard" type="button"><i data-feather="home"></i>
                                    DashBoard</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-order" type="button"><i
                                        data-feather="shopping-bag"></i>Order</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-download-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-subscription" type="button" role="tab"><i
                                        data-feather="bell"></i>Subscribe</button>
                            </li>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-address-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-address" type="button" role="tab"><i
                                        data-feather="map-pin"></i>Address</button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                        Menu</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-home">
                                    <div class="title">
                                        <h2>Dashboard</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="<?php echo BASE_URL; ?>/asset/assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-user-name">
                                        <h6 class="text-content">Hello,
                                            <?php echo ucwords(htmlspecialchars($userName)); ?><b
                                                class="text-title"></b>
                                        </h6>
                                        <p class="text-content">From
                                            <?php echo strtolower(htmlspecialchars($userName)); ?> Account Dashboard
                                            you
                                            have the ability to
                                            view a overview of your recent account activity and update your account
                                            information. Select a link below to view or edit information.
                                        </p>
                                    </div>

                                    <div class="total-box">
                                        <div class="row g-sm-4 g-3">
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="<?php echo BASE_URL; ?>/asset/assets/images/svg/order.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="<?php echo BASE_URL; ?>/asset/assets/images/svg/order.svg" class="blur-up lazyload"
                                                        alt="">
                                                    <div class="total-detail">
                                                        <h5>Total Order</h5>
                                                        <h3 id="order_total">0</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="<?php echo BASE_URL; ?>/asset/assets/images/svg/pending.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="<?php echo BASE_URL; ?>/asset/assets/images/svg/pending.svg" class="blur-up lazyload"
                                                        alt="">
                                                    <div class="total-detail">
                                                        <h5>Total Pending Order</h5>
                                                        <h3 id="order_process">0</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dashboard-title">
                                        <!-- <h3>
                                            Account Information
                                        </h3> -->
                                        <div class="title">
                                            <h4>Personal Details</h4>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use xlink:href="<?php echo BASE_URL; ?>/asset/assets/svg/leaf.svg#leaf"></use>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row g-4 dashboard-profile">
                                        <div class="col-xxl-12 profile-detail dashboard-bg-box">
                                            <div class="profile-name-detail">
                                                <div class="d-sm-flex align-items-center d-block">
                                                    <h3><b><?php echo htmlspecialchars($userName) ?></b></h3>
                                                </div>

                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#editProfile">Edit Profile</a>
                                            </div>

                                            <div class="location-profile">
                                                <ul>
                                                    <?php
                                                    if ($userAddress) {
                                                        echo '<li>
                                                          <div class="location-box">
                                                           <i data-feather="map-pin"></i>
                                                           <h6> ' . htmlspecialchars($userAddress) . ' </h6>
                                                         </div>
                                                        </li>';

                                                    }
                                                    ?>

                                                    <li>
                                                        <div class="location-box">
                                                            <i data-feather="phone"></i>
                                                            <h6><?php echo $phoneNumber; ?></h6>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="location-box">
                                                            <i data-feather="check-square"></i>
                                                            <h6><?php $dor = date("d-m-Y", strtotime($userDOR));
                                                            echo "<span style='color:#acacac'>User since <b>" . $dor . "</b></span>" ?>
                                                            </h6>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-xxl-12">
                                            <div class="dashboard-title mb-3">
                                                <h3>Profile About</h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Gender :</td>
                                                            <td><?php echo $userGender ? htmlspecialchars($userGender) : "Not Found"; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Birthday :</td>
                                                            <td> <?php echo $userDOB ? date("d-m-Y", strtotime($userDOB)) : "--/--/----"; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone Number :</td>
                                                            <td>
                                                                <?php #echo $userPhone ? '+'.$userPhone : 'not found!'; 
                                                                echo $phoneNumber;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address :</td>
                                                            <td>
                                                                <span>Click on address tab to change address.</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                           
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-order" role="tabpanel">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>Orders History</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="<?php echo BASE_URL; ?>/asset/assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>
                                        <div class="orderOtion">
                                                 <div>
                                                 Filter: 
                                                 <select id="Option">
                                                     <option value="all">All orders</option>
                                                     <option value="pending">Pending orders</option>
                                                     <option value="ship">Shipped orders</option>
                                                     <option value="delever">Delivered orders</option>
                                                     <option value="cod">COD orders</option>
                                                     <option value="online">Online paid orders</option>
                                                     <option value="paid">Paid orders</option>
                                                     <option value="unpaid">Unpaid orders</option>
                                                     <option value="fail">Failed orders</option>
                                                     <option value="success">Successful orders</option>
                                                     <option value="return">Order Return/Cancel</option>
                                                 </select>
                                             </div>
                                             <div class="d-flex form">
                                                 <div>Search : </div> 
                                                 <div class="form-group"> <input type="text" placeholder=" by order id or amount" id="search__order" class="form-input"></div>
                                             </div>
                                                 
                                        </div>
                                        <div id="orders"></div>
                                    </div>

                            <div class="tab-pane fade" id="pills-download" role="tabpanel">
                                <div class="dashboard-download">
                                    <div class="title">
                                        <h2>Subscribe Products</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="<?php echo BASE_URL; ?>/asset/assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="download-detail dashboard-bg-box">
                                        <address><h2>This feature is added back later!</h2></address>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-security" role="tabpanel">
                                <div class="dashboard-privacy">
                                    <div class="dashboard-bg-box">
                                        <div class="dashboard-title mb-4">
                                            <h3>Privacy</h3>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Allows others to see my profile</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio">
                                                    < <label class="form-check-label" for="redio"></label>
                                                </div>
                                            </div>

                                            <p class="text-content">all peoples will be able to see my profile
                                            </p>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>who has save this profile only that people see my profile
                                                </h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio2">
                                                    <label class="form-check-label" for="redio2"></label>
                                                </div>
                                            </div>

                                            <p class="text-content">all peoples will not be able to see my
                                                profile</p>
                                        </div>

                                        <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Save
                                            Changes</button>
                                    </div>

                                    <div class="dashboard-bg-box mt-4">
                                        <div class="dashboard-title mb-4">
                                            <h3>Account settings</h3>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Deleting Your Account Will Permanently</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio3">
                                                    <label class="form-check-label" for="redio3"></label>
                                                </div>
                                            </div>
                                            <p class="text-content">Once your account is deleted, you will be
                                                logged out
                                                and will be unable to log in back.</p>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Deleting Your Account Will Temporary</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio4">
                                                    <label class="form-check-label" for="redio4"></label>
                                                </div>
                                            </div>

                                            <p class="text-content">Once your account is deleted, you will be
                                                logged out
                                                and you will be create new account</p>
                                        </div>

                                        <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Delete
                                            My
                                            Account</button>
                                    </div>
                                </div>
                            </div>
                            <!--Sections End-->
                        </div>
                        
                            <div class="tab-pane fade" id="pills-address" role="tabpanel">
                                <div class="dashboard-address">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>My Address Book</h2>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use xlink:href="<?php echo BASE_URL; ?>/asset/assets/svg/leaf.svg#leaf"></use>
                                                </svg>
                                            </span>
                                        </div>

                                        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                            data-bs-toggle="modal" data-bs-target="#add-address"><i data-feather="plus"
                                                class="me-2"></i>click to Add an Address</button>
                                    </div>

                                    <div class="row g-sm-4 g-3">
                                        <?php
                                        $adduser =  $user_id;
                                        $addselect = "SELECT * FROM address_book WHERE user_id = ? AND is_deleted = 0";
                                        $stmt = $conn->prepare("SELECT * FROM address_book WHERE user_id = ? AND is_deleted = 0");
                                        $stmt->bind_param('i', $adduser);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            $addresses = $result->fetch_all(MYSQLI_ASSOC);
                                            foreach ($addresses as $adder) {


                                                ?>
                                                <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                                    <div class="address-box">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="jack"
                                                                    id="flexRadioDefault2" checked>
                                                            </div>

                                                            <div class="label">
                                                                <label><?php echo $adder['tag'] ?></label>
                                                            </div>

                                                            <div class="table-responsive address-table">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <?php echo $adder['email'] ?>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Address :</td>
                                                                            <td>
                                                                                <p>
                                                                                    <?php echo $adder['address_line'] . ", " . $adder['address'] . ", " . $adder['address_landmark'] ?>
                                                                                </p>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Phone :</td>
                                                                            <td><?php echo $adder['phone'] ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="button-group">
                                                            <!-- <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                                data-bs-target="#add-address<?php #echo $adder['id'] ?>"
                                                                data-address="<?php # echo $adder['id'] ?>"><i
                                                                    data-feather="edit"></i>Edit</button> -->
                                                            <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                                data-bs-target="#removeProfile"
                                                                data-address="<?php echo $adder['id'] ?>"><i
                                                                    data-feather="trash-2"></i>Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade theme-modal" id="add-address<?php echo $adder['id'] ?>"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    address</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="dummyForm">
                                                                    <div class="form-floating mb-4 theme-form-floating">
                                                                        <input type="text" class="form-control" id="fname"
                                                                            placeholder="Enter Name"
                                                                            value="<?php echo $adder['email'] ?>">
                                                                        <label for="fname">Name</label>
                                                                    </div>
                                                                </form>
                                                                <form class="dummyForm">
                                                                    <div class="form-floating mb-4 theme-form-floating">
                                                                        <input type="tel" class="form-control" id="phone"
                                                                            placeholder=""
                                                                            value="<?php echo $adder['phone'] ?>">
                                                                        <label for="line">Phone no.</label>
                                                                    </div>
                                                                </form>
                                                                <form class="dummyForm">
                                                                    <div class="form-floating mb-4 theme-form-floating">
                                                                        <input type="text" class="form-control" id="tag"
                                                                            placeholder="Address as home, office etc.."
                                                                            value="<?php echo $adder['tag'] ?>">
                                                                        <label for="email">Address tag <span
                                                                                style="font-size:10px;"> eg. Home ,
                                                                                Office
                                                                                etc.</span></label>
                                                                    </div>
                                                                </form>


                                                                <form class="dummyForm">
                                                                    <div class="form-floating mb-4 theme-form-floating">
                                                                        <input type="text" class="form-control" id="line"
                                                                            placeholder="eg. 102 D 1st floor"
                                                                            value="<?php echo $adder['address_line'] ?>">
                                                                        <label for="line">Address line <span
                                                                                style="font-size:10px;"> eg. 102 D 1st
                                                                                floor</span></label>
                                                                    </div>
                                                                </form>

                                                                <form class="dummyForm">
                                                                    <div class="form-floating mb-4 theme-form-floating">
                                                                        <textarea class="form-control"
                                                                            placeholder="Leave a comment here" id="address"
                                                                            style="height: 100px"><?php echo $adder['address'] ?></textarea>
                                                                        <label for="address">Enter full Address</label>
                                                                    </div>
                                                                </form>

                                                                <form class="dummyForm">
                                                                    <div class="form-floating mb-4 theme-form-floating">
                                                                        <input type="nearby" class="form-control" id="nearby"
                                                                            placeholder="Enter Pin Code"
                                                                            value="<?php echo $adder['address_landmark'] ?>">
                                                                        <label for="pin">Near by</label>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-md"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button"
                                                                    class="btn theme-bg-color btn-md text-white"
                                                                    id="updateland">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            echo "<br/><h2 style='color:#0da487'>Please add an address</h2>";
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="pills-subscription" role="tabpanel">
                                <div class="dashboard-download">
                                    <div class="title">
                                        <h2>Subscribe Products</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="<?php echo BASE_URL; ?>/asset/assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="download-detail dashboard-bg-box">
                                        <address><h2>This feature is added back later!</h2></address>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->

    <!-- Footer Section Start -->
    <?php include("partials/footer.php") ?>
    <!-- Footer Section End -->

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
    <div class="bg-overlay" style="z-index: 5;"></div>
    <!-- Bg overlay End -->

    <!-- Add address modal box start -->
    <div class="modal fade theme-modal" id="add-address" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add an address<br><span style="font-size:12px">All Details are send to the enterd Email</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="dummyForm">
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="email" class="form-control" id="addfname" name="addfname"
                                placeholder="Enter Email">
                            <label for="addfname">Address email</label>
                        </div>
                    </form>
                    <form class="dummyForm">
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="tel" class="form-control" pattern="\d{10}" id="addphoneNumber" placeholder="">
                            <label for="addphone">Address Phone no.</label>
                        </div>
                    </form>
                    <form class="dummyForm">
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="addtag" name="addtag"
                                placeholder="Address as home, office etc..">
                            <label for="addtag">Address tag <span style="font-size:10px;"> eg. Home , Office
                                    etc.</span></label>
                        </div>
                    </form>


                    <form class="dummyForm">
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="addline" name="addline"
                                placeholder="eg. 102 D 1st floor">
                            <label for="line">flat/h.no/Gali/plot no. <span style="font-size:10px;"> eg. 102 D 1st
                                    floor</span></label>
                        </div>
                    </form>

                    <form class="dummyForm">
                        <div class="form-floating mb-4 theme-form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="addaddress"
                                name="addaddress" style="height: 100px"></textarea>
                            <label for="address">Enter full Address</label>
                        </div>
                    </form>

                    <form class="dummyForm">
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="nearby" class="form-control" id="addnearby" name="addnearby"
                                placeholder="Enter Pin Code">
                            <label for="pin">Near by</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-bg-color btn-md text-white" id="addnewaddress">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Start -->
    <div class="modal fade theme-modal" id="editProfile" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-xxl-12">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="pname"
                                        value="<?php echo ucwords($userName) ?>">
                                    <label for="pname">Full Name</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-xxl-12">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="date" class="form-control" id="pdob">
                                    <label for="pdob">Date of Birth</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-xxl-12">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <select class="form-select" id="pgender">
                                        <option selected>Choose Your Gender</option>
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                        <option value="transgender">Transgender</option>
                                        <option value="other">other</option>
                                    </select>
                                    <label for="pgender">Gender</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-animation btn-md fw-bold"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" data-bs-dismiss="modal" class="btn theme-bg-color btn-md fw-bold text-light"
                        id="saveProfile" onclick="saveChanges()">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Remove address Modal Start -->
    <div class="modal fade theme-modal remove-profile" id="removeProfile" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>The Deleted Address will not Restored later once it is deleted.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-confirm-remove theme-bg-color btn-md fw-bold text-light"
                        data-bs-target="#removeAddress" data-bs-toggle="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade theme-modal remove-profile" id="removeAddress" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box text-center">
                        <h4 class="text-content">It's Removed.</h4>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <button type="button" class="btn theme-bg-color btn-md fw-bold text-light"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/jquery-3.6.0.min.js"></script>

    <!-- jquery ui-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/jquery-ui.min.js"></script>

    <!-- Bootstrap js-->
    <script src="view/orders.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/bootstrap-notify.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/popper.min.js"></script>

    <!-- feather icon js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather-icon.js"></script>

    <!-- Lazyload Js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/lazysizes.min.js"></script>

    <!-- Slick js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/slick.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/custom_slick.js"></script>

    <!-- Quantity js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/quantity-2.js"></script>

    <!-- Nav & tab upside js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/nav-tab.js"></script>

    <!-- script js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/script.js"></script>
    <script src="dash7efascri.js"></script>
</body>

</html>