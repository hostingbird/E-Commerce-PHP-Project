<?php include ("partials/session.php") ?>
<?php include ('confi.php');
include ("partials/validation.php");
include ("errorReport.php");
?>

<!DOCTYPE html>
<html lang="en">
    <?php  include("partials/head.php");?>
<body>

    <!-- Header Start -->
    <?php include('partials/header.php') ?>
<?php
$token = bin2hex(random_bytes(32));

$_SESSION['checkout_token'] = $token;
$userID = $HDFuser['id'];
$userPhone = $HDFuser['phone'];
$userName = $HDFuser['name'];

?>
    <!-- Header End -->

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Checkout</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="home.php">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Checkout section Start -->
    <?php if( $_COOKIE['HDF_user_login']){?>
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-lg-8">
                    <div class="left-sidebar-checkout">
                        <div class="checkout-detail-box">
                            <ul>
                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                            trigger="loop-on-hover"
                                            colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a"
                                            class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Delivery Address</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <div class="row g-sm-4 g-3">
                                                <?php
                                                $adduser = $userID;
                                                $addselect = "SELECT * FROM address_book WHERE user_id = ? AND is_deleted = 0";
                                                $stmt = $conn->prepare("SELECT * FROM address_book WHERE user_id = ?  AND is_deleted = 0");
                                                $stmt->bind_param('i', $adduser);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                if ($result->num_rows > 0) {
                                                    echo "<div class='row g-4'>";
                                                    $addresses = $result->fetch_all(MYSQLI_ASSOC);
                                                    foreach ($addresses as $adder) {
                                                        ?>
                                                        <div class="col-xxl-6 col-lg-12 col-md-6">
                                                            <div class="delivery-address-box">
                                                                <div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="hdf_address"
                                                                            id="flexRadioDefault1" data-list="<?php echo $adder['id']?>" data-user="<?php echo $adder['phone']?>" data-msg="<?php echo $adder['email']?>" data-name="<?php echo $userName;?>">
                                                                    </div>

                                                                    <div class="label">
                                                                        <label><?php echo $adder['tag'] ?></label>
                                                                    </div>

                                                                    <ul class="delivery-address-detail">
                                                                        <li>
                                                                            <h4 class="fw-500"><?php echo $adder['email'] ?>
                                                                            </h4>
                                                                        </li>

                                                                        <li>
                                                                            <p class="text-content"><span
                                                                                    class="text-title">Address
                                                                                    :
                                                                                </span><?php echo $adder['address_line'] . ", " . $adder['address'] . ", near by " . $adder['address_landmark'] ?>
                                                                            </p>
                                                                        </li>

                                                                        <li>
                                                                            <h6 class="text-content mb-0"><span
                                                                                    class="text-title">Phone
                                                                                    :</span>
                                                                                <?php echo $adder['phone'] ?>
                                                                            </h6>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="col-xxl-6 col-lg-12 col-md-6"><button
                                                            class="btn btn-primary"
                                                            onclick="location.href='dashboard.php'">select another</button>
                                                    </div>
                                                </div>
                                                <?php
                                                } else {
                                                    ?>
                                                <div class="modal-body">
                                                    <br>
                                                     <span style="font-size:12px; color:red;">All details are send to enterd email *</span>
                                                    <br>
                                                    <br>
                                                    
                                                    
                                                    
                                                      <form class="dummyForm">
                                                        <div class="form-floating mb-4 theme-form-floating">
                                                              <input type="email" class="form-control" id="addfname" name="addfname"
                                placeholder="Enter Email">
                            <label for="addfname">Address email</label>
                                                        </div>
                                                    </form>
                                                    
                                                    <form class="dummyForm">
                                                        <div class="form-floating mb-4 theme-form-floating">
                                                           
                                                       <div class="form-floating mb-4 theme-form-floating">
                          
                        </div>
                                                            <input type="tel" class="form-control" pattern="\d{10}"
                                                                id="addphoneNumber" placeholder="">
                                                            <label for="line">Phone no.</label>
                                                        </div>
                                                    </form>
                                                    <form class="dummyForm">
                                                        <div class="form-floating mb-4 theme-form-floating">
                                                            <input type="text" class="form-control" id="addline"
                                                                name="addline" placeholder="eg. 102 D 1st floor">
                                                            <label for="line">flat/h.no/Gali/plot no. <span
                                                                    style="font-size:10px;"> eg. 102 D 1st
                                                                    floor</span></label>
                                                        </div>
                                                    </form>

                                                    <form class="dummyForm">
                                                        <div class="form-floating mb-4 theme-form-floating">
                                                            <textarea class="form-control"
                                                                placeholder="Leave a comment here" id="addaddress"
                                                                name="addaddress" style="height: 100px"></textarea>
                                                            <label for="address">Enter full Address</label>
                                                        </div>
                                                    </form>

                                                    <form class="dummyForm">
                                                        <div class="form-floating mb-4 theme-form-floating">
                                                            <input type="nearby" class="form-control" id="addnearby"
                                                                name="addnearby" placeholder="Enter Pin Code">
                                                            <label for="pin">Near by</label>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn theme-bg-color btn-md text-white"
                                                        id="addnewaddress">Save</button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                        </div>
                        </li>

                        <li>
                            <div class="checkout-icon">
                                <lord-icon target=".nav-item" src="https://cdn.lordicon.com/oaflahpk.json"
                                    trigger="loop-on-hover" colors="primary:#0baf9a" class="lord-icon">
                                </lord-icon>
                            </div>
                            <div class="checkout-box">
                                <div class="checkout-title">
                                    <h4>Delivery Option</h4>
                                </div>
                                <style>
                                    .unMent {
                                        user-select: none;
                                        pointer-events: none;
                                        opacity: 0.8;
                                    }

                                    .unMC2 {
                                        font-size: 13px;
                                        color: #acacac;
                                        margin-left: 12px;
                                    }
                                </style>

                                <div class="checkout-detail">
                                    <div class="row g-4">
                                        <div class="col-xxl-6">
                                            <div class="delivery-option">
                                                <div class="delivery-category">
                                                    <div class="shipment-detail">
                                                        <div class="form-check mb-0 custom-form-check">
                                                            <input class="form-check-input" type="radio" name="standard"
                                                                id="stand" data-method="standard" checked>
                                                            <label class="form-check-label" for="stand"
                                                                id="standlabel">Standard
                                                                Delivery</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6">
                                            <div class="delivery-option">
                                                <div class="delivery-category">
                                                    <div class="shipment-detail">
                                                        <div class="form-check mb-0 custom-form-check show-box-checked">
                                                            <!-- Unavibalel -->
                                                            <input class="form-check-input" type="radio" name="standard"
                                                                id="future" data-method="future" disabled>
                                                            <label class="form-check-label unMent" for="future"
                                                                id="future">Subscription
                                                                <span class="unMC2">Unavilabel
                                                                    at this
                                                                    time</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 StandDel" style="display:none;">
                                            <div class="future-option">
                                                <div class="row g-md-0 gy-4">
                                                    <div class="col-md-6">
                                                        <p>In This Delevery Option Parcel/Product Will be
                                                            Delever at your Door step at morning 6:00AM-9:00AM
                                                            or Evening 6:00PM-9:00PM
                                                            and no future Subscription(Product after Deleverd);
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 future-box futDel">
                                            <div class="future-option">
                                                <div class="row g-md-0 gy-4">
                                                    <div class="col-md-6">
                                                        <div class="delivery-items unMent">
                                                            <div>
                                                                <h5 class="items text-content">
                                                                    <!-- <span>3
                                                                                Items</span>@ -->
                                                                    Unavilabel at this time
                                                                </h5>
                                                                <!-- <h5 class="charge text-content">Delivery Charge
                                                                            $34.67
                                                                            <button type="button" class="btn p-0"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="Extra Charge">
                                                                                <i
                                                                                    class="fa-solid fa-circle-exclamation"></i>
                                                                            </button>
                                                                        </h5> -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--<div class="col-md-6">-->
                                                    <!--    <form class="form-floating theme-form-floating date-box">-->
                                                    <!--        <input type="date" class="form-control">-->
                                                    <!--        <label>Select Date</label>-->
                                                    <!--    </form>-->
                                                    <!--</div>-->
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            let btn = document.getElementById('stand');
                                            let futrbtn = document.getElementById('future');
                                            let btnlabel = document.getElementById('standlabel');
                                            let viewDiv = document.querySelector('.StandDel');
                                            let viewDiv2 = document.querySelector('.futDel');
                                            btnlabel.addEventListener('click', () => {
                                                if (btn.checked == true) {
                                                    viewDiv.style.display = 'block'
                                                } else {
                                                    viewDiv.style.display = 'none'
                                                }
                                            })
                                            document.addEventListener('click', () => {
                                                if (btn.checked == true) {
                                                    viewDiv.style.display = 'block'
                                                    viewDiv2.style.display = 'none'
                                                } else {
                                                    viewDiv.style.display = 'none'
                                                    viewDiv2.style.display = 'block'
                                                }
                                                if (futrbtn.checked == true) {
                                                    viewDiv.style.display = 'none'
                                                    viewDiv2.style.display = 'block'
                                                } else {
                                                    viewDiv.style.display = 'block'
                                                    viewDiv2.style.display = 'none'
                                                }
                                            })
                                            if (btn.checked == true) {
                                                viewDiv.style.display = 'block'
                                                viewDiv2.style.display = 'none'
                                            } else {
                                                viewDiv.style.display = 'none'
                                                viewDiv2.style.display = 'block'
                                            }
                                            if (futrbtn.checked == true) {
                                                viewDiv.style.display = 'none'
                                                viewDiv2.style.display = 'block'
                                            } else {
                                                viewDiv.style.display = 'block'
                                                viewDiv2.style.display = 'none'
                                            }

                                        </script>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="checkout-icon">
                                <lord-icon target=".nav-item" src="https://cdn.lordicon.com/qmcsqnle.json"
                                    trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a"
                                    class="lord-icon">
                                </lord-icon>
                            </div>
                            <div class="checkout-box">
                                <div class="checkout-title">
                                    <h4>Payment Option</h4>
                                </div>

                                <div class="checkout-detail">
                                    <div class="accordion accordion-flush custom-accordion" id="accordionFlushExample">
                                        <!-- COD -->
                                        
                                        <div class="accordion-item">
                                            <div class="accordion-header" id="flush-headingFour" aria-disabled="true">
                                                <div class="accordion-button collapsed" data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseFour">
                                                    <div class="custom-form-check form-check mb-0">
                                                        <label class="form-check-label" for="cash">
                                                            <input class="form-check-input mt-0" data-check="netchPayCF" type="radio"
                                                                name="flexRadioDefault" id="cash" checked>Pay Online</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="flush-collapseFour" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <p class="cod-review">with this option your can pay using wallet/ credit or debit card / Net Banking etc..<a
                                                            href="javascript:void(0)"></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <div class="accordion-header" id="flush-headingFour" aria-disabled="true">
                                                <div class="accordion-button collapsed" data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseFour">
                                                    <div class="custom-form-check form-check mb-0">
                                                        <label class="form-check-label" for="cash">
                                                            <input class="form-check-input mt-0" data-check="COD" type="radio"
                                                                name="flexRadioDefault" id="cash"> Cash
                                                            On Delivery</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="flush-collapseFour" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <p class="cod-review">with COD option you can pay when order reach at your door step. <a
                                                            href="javascript:void(0)"></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Credit or Debit Card -->
                                        <!--<div class="accordion-item unMent">-->
                                        <!--    <div class="accordion-header" id="flush-headingOne">-->
                                        <!--        <div class="accordion-button collapsed" data-bs-toggle="collapse"-->
                                        <!--            data-bs-target="#flush-collapseOne">-->
                                        <!--            <div class="custom-form-check form-check mb-0">-->
                                        <!--                <label class="form-check-label" for="credit">-->
                                        <!--                    <input-->
                                        <!--                        class="form-check-input mt-0" data-check="CDC" type="radio"-->
                                        <!--                        name="flexRadioDefault" id="credit">-->
                                        <!--                    Credit or Debit Card-->
                                        <!--                    <span class="unMC2">Unavilabel-->
                                        <!--                        at this-->
                                        <!--                        time</span>-->
                                        <!--                </label>-->
                                        <!--            </div>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                            <!--<div id="flush-collapseOne" class="accordion-collapse collapse"-->
                                            <!--    data-bs-parent="#accordionFlushExample">-->
                                            <!--    <div class="accordion-body">-->
                                            <!--        <div class="row g-2">-->
                                            <!--            <div class="col-12">-->
                                            <!--                <div class="payment-method">-->
                                            <!--                    <div-->
                                            <!--                        class="form-floating mb-lg-3 mb-2 theme-form-floating">-->
                                            <!--                        <input type="text" class="form-control" id="credit2"-->
                                            <!--                            placeholder="Enter Credit & Debit Card Number">-->
                                            <!--                        <label for="credit2">Enter Credit & Debit-->
                                            <!--                            Card Number</label>-->
                                            <!--                    </div>-->
                                            <!--                </div>-->
                                            <!--            </div>-->

                                            <!--            <div class="col-xxl-4">-->
                                            <!--                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">-->
                                            <!--                    <input type="text" class="form-control" id="expiry"-->
                                            <!--                        placeholder="Enter Expiry Date">-->
                                            <!--                    <label for="expiry">Expiry Date</label>-->
                                            <!--                </div>-->
                                            <!--            </div>-->

                                            <!--            <div class="col-xxl-4">-->
                                            <!--                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">-->
                                            <!--                    <input type="text" class="form-control" id="cvv"-->
                                            <!--                        placeholder="Enter CVV Number">-->
                                            <!--                    <label for="cvv">CVV Number</label>-->
                                            <!--                </div>-->
                                            <!--            </div>-->

                                            <!--            <div class="col-xxl-4">-->
                                            <!--                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">-->
                                            <!--                    <input type="password" class="form-control"-->
                                            <!--                        id="password" placeholder="Enter Password">-->
                                            <!--                    <label for="password">Password</label>-->
                                            <!--                </div>-->
                                            <!--            </div>-->

                                            <!--            <div class="button-group mt-0">-->
                                            <!--                <ul>-->
                                            <!--                    <li>-->
                                            <!--                        <button-->
                                            <!--                            class="btn btn-light shopping-button">Cancel</button>-->
                                            <!--                    </li>-->

                                            <!--                    <li>-->
                                            <!--                        <button class="btn btn-animation">Use This-->
                                            <!--                            Card</button>-->
                                            <!--                    </li>-->
                                            <!--                </ul>-->
                                            <!--            </div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                        <!-- Net Banking -->
                                        <!--<div class="accordion-item unMent">-->
                                        <!--    <div class="accordion-header" id="flush-headingTwo">-->
                                        <!--        <div class="accordion-button collapsed" data-bs-toggle="collapse"-->
                                        <!--            data-bs-target="#flush-collapseTwo">-->
                                        <!--            <div class="custom-form-check form-check mb-0">-->
                                        <!--                <label class="form-check-label" for="banking"><input-->
                                        <!--                        class="form-check-input mt-0" data-check="BANK" type="radio"-->
                                        <!--                        name="flexRadioDefault" id="banking">Net-->
                                        <!--                    Banking-->
                                        <!--                    <span class="unMC2">Unavilabel-->
                                        <!--                        at this-->
                                        <!--                        time</span>-->
                                        <!--                </label>-->
                                        <!--            </div>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                            <!--<div id="flush-collapseTwo" class="accordion-collapse collapse"-->
                                            <!--    data-bs-parent="#accordionFlushExample">-->
                                            <!--    <div class="accordion-body">-->
                                            <!--        <h5 class="text-uppercase mb-4">Select Your Bank-->
                                            <!--        </h5>-->
                                            <!--        <div class="row g-2">-->
                                            <!--            <div class="col-md-6">-->
                                            <!--                <div class="custom-form-check form-check">-->
                                            <!--                    <input class="form-check-input mt-0" type="radio"-->
                                            <!--                        name="flexRadioDefault" id="bank1">-->
                                            <!--                    <label class="form-check-label" for="bank1">Industrial &-->
                                            <!--                        Commercial-->
                                            <!--                        Bank</label>-->
                                            <!--                </div>-->
                                            <!--            </div>-->

                                            <!--            <div class="col-md-6">-->
                                            <!--                <div class="custom-form-check form-check">-->
                                            <!--                    <input class="form-check-input mt-0" type="radio"-->
                                            <!--                        name="flexRadioDefault" id="bank2">-->
                                            <!--                    <label class="form-check-label" for="bank2">Agricultural-->
                                            <!--                        Bank</label>-->
                                            <!--                </div>-->
                                            <!--            </div>-->

                                            <!--            <div class="col-md-6">-->
                                            <!--                <div class="custom-form-check form-check">-->
                                            <!--                    <input class="form-check-input mt-0" type="radio"-->
                                            <!--                        name="flexRadioDefault" id="bank3">-->
                                            <!--                    <label class="form-check-label" for="bank3">Bank-->
                                            <!--                        of America</label>-->
                                            <!--                </div>-->
                                            <!--            </div>-->

                                            <!--            <div class="col-md-6">-->
                                            <!--                <div class="custom-form-check form-check">-->
                                            <!--                    <input class="form-check-input mt-0" type="radio"-->
                                            <!--                        name="flexRadioDefault" id="bank4">-->
                                            <!--                    <label class="form-check-label" for="bank4">Construction-->
                                            <!--                        Bank Corp.</label>-->
                                            <!--                </div>-->
                                            <!--            </div>-->

                                            <!--            <div class="col-md-6">-->
                                            <!--                <div class="custom-form-check form-check">-->
                                            <!--                    <input class="form-check-input mt-0" type="radio"-->
                                            <!--                        name="flexRadioDefault" id="bank5">-->
                                            <!--                    <label class="form-check-label" for="bank5">HSBC-->
                                            <!--                        Holdings</label>-->
                                            <!--                </div>-->
                                            <!--            </div>-->

                                            <!--            <div class="col-md-6">-->
                                            <!--                <div class="custom-form-check form-check">-->
                                            <!--                    <input class="form-check-input mt-0" type="radio"-->
                                            <!--                        name="flexRadioDefault" id="bank6">-->
                                            <!--                    <label class="form-check-label" for="bank6">JPMorgan-->
                                            <!--                        Chase & Co.</label>-->
                                            <!--                </div>-->
                                            <!--            </div>-->

                                            <!--            <div class="col-12">-->
                                            <!--                <div class="select-option">-->
                                            <!--                    <div class="form-floating theme-form-floating">-->
                                            <!--                        <select class="form-select theme-form-select">-->
                                            <!--                            <option value="hsbc">HSBC Holdings-->
                                            <!--                            </option>-->
                                            <!--                            <option value="loyds">Lloyds Banking-->
                                            <!--                                Group</option>-->
                                            <!--                            <option value="natwest">Nat West Group-->
                                            <!--                            </option>-->
                                            <!--                            <option value="Barclays">Barclays-->
                                            <!--                            </option>-->
                                            <!--                            <option value="other">Others Bank-->
                                            <!--                            </option>-->
                                            <!--                        </select>-->
                                            <!--                        <label>Select Other Bank</label>-->
                                            <!--                    </div>-->
                                            <!--                </div>-->
                                            <!--            </div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                        <!-- Wallet -->
                                        <!--<div class="accordion-item unMent">-->
                                        <!--    <div class="accordion-header" id="flush-headingThree">-->
                                        <!--        <div class="accordion-button collapsed" data-bs-toggle="collapse"-->
                                        <!--            data-bs-target="#flush-collapseThree">-->
                                        <!--            <div class="custom-form-check form-check mb-0">-->
                                        <!--                <label class="form-check-label" for="wallet"><input-->
                                        <!--                        class="form-check-input mt-0" data-check="WALLET" type="radio"-->
                                        <!--                        name="flexRadioDefault" id="wallet">My-->
                                        <!--                    Wallet-->
                                        <!--                    <span class="unMC2">Unavilabel-->
                                        <!--                        at this-->
                                        <!--                        time</span>-->
                                        <!--                </label>-->
                                        <!--            </div>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--    <div id="flush-collapseThree" class="accordion-collapse collapse"-->
                                        <!--        data-bs-parent="#accordionFlushExample">-->
                                        <!--        <div class="accordion-body">-->
                                        <!--            <h5 class="text-uppercase mb-4">Select Your Wallet-->
                                        <!--            </h5>-->
                                        <!--            <div class="row">-->
                                        <!--                <div class="col-md-6">-->
                                        <!--                    <div class="custom-form-check form-check">-->
                                        <!--                        <label class="form-check-label" for="amazon"><input-->
                                        <!--                                class="form-check-input mt-0" type="radio"-->
                                        <!--                                name="flexRadioDefault" id="amazon">Amazon-->
                                        <!--                            Pay</label>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->

                                        <!--                <div class="col-md-6">-->
                                        <!--                    <div class="custom-form-check form-check">-->
                                        <!--                        <input class="form-check-input mt-0" type="radio"-->
                                        <!--                            name="flexRadioDefault" id="gpay">-->
                                        <!--                        <label class="form-check-label" for="gpay">Google-->
                                        <!--                            Pay</label>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->

                                        <!--                <div class="col-md-6">-->
                                        <!--                    <div class="custom-form-check form-check">-->
                                        <!--                        <input class="form-check-input mt-0" type="radio"-->
                                        <!--                            name="flexRadioDefault" id="airtel">-->
                                        <!--                        <label class="form-check-label" for="airtel">Airtel-->
                                        <!--                            Money</label>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->

                                        <!--                <div class="col-md-6">-->
                                        <!--                    <div class="custom-form-check form-check">-->
                                        <!--                        <input class="form-check-input mt-0" type="radio"-->
                                        <!--                            name="flexRadioDefault" id="paytm">-->
                                        <!--                        <label class="form-check-label" for="paytm">Paytm-->
                                        <!--                            Pay</label>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->

                                        <!--                <div class="col-md-6">-->
                                        <!--                    <div class="custom-form-check form-check">-->
                                        <!--                        <input class="form-check-input mt-0" type="radio"-->
                                        <!--                            name="flexRadioDefault" id="jio">-->
                                        <!--                        <label class="form-check-label" for="jio">JIO-->
                                        <!--                            Money</label>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->

                                        <!--                <div class="col-md-6">-->
                                        <!--                    <div class="custom-form-check form-check">-->
                                        <!--                        <input class="form-check-input mt-0" type="radio"-->
                                        <!--                            name="flexRadioDefault" id="free">-->
                                        <!--                        <label class="form-check-label"-->
                                        <!--                            for="free">Freecharge</label>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->
                                        <!--            </div>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="right-side-summery-box">
                    <?php
                    if (isset($userID)) {
                        global $cartData;
                        $user_id = $userID;
                        $selectQuery = "SELECT * FROM `cart` WHERE user_id = ? AND status = 'active'";
                        $stmt = $conn->prepare($selectQuery);
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $selectResult = $stmt->get_result();

                        if ($selectResult->num_rows > 0) {
                            $grandTotal = 0;
                            $Totalsave = 0;
                            $TotalCount = 0;
                            $TotalPrice = 0;
                              $productIds = [];
                            ?>
                            <div class="summery-box-2">
                                <div class="summery-header">
                                    <h3>Order Summery</h3>
                                </div>

                                <ul class="summery-contain">
                                    <?php
                                    while ($row = $selectResult->fetch_assoc()) {
                                        $product_id = $row['product_id'];
                                        $productIds[] = $product_id;
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
                                                // $TotalCount += $itemQuantity;
                                                $TotalPrice += $pprice * $itemQuantity;

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
                                                <li>
                                                    <img src="<?php echo BASE_URL; ?>/asset/assets/images/product/<?php echo $pbanner ?>"
                                                        class="img-fluid blur-up lazyloaded checkout-image" alt="<?php echo $pname ?>"
                                                        title="<?php echo $pname . "(" . $pbrand . ")" ?>">
                                                    <h4><?php echo $pname ?> <span>X <?php echo $itemQuantity ?></span></h4>
                                                    <h4 class="price"><?php echo "&#x20B9;" . $pprice * $itemQuantity ?></h4>
                                                </li>

                                            <?php }
                                        }
                                    }
                                    $cartData = implode(',', $productIds);
                                    ?>
                                </ul>

                                <ul class="summery-total">
                                    <li>
                                        <h4>Subtotal</h4>
                                        <h4 class="price"><?php echo "+ &#x20B9;" . $TotalPrice ?></h4>
                                    </li>
                                    <li>
                                        <h4>Shipping</h4>
                                        <h4 class="price" style="color:#0da487">
                                            <?php echo "Free"; #echo "+ &#x20B9;" . ($TotalPrice / 100) * 15 ?>
                                        </h4>
                                    </li>

                                    <!-- <li>
                                            <h4>Tax</h4>
                                            <h4 class="price">$29.498</h4>
                                        </li> -->

                                    <li>
                                        <h4>Coupon discount</h4>
                                        <h4 class="price"><?php 0
                                            #echo "- &#x20B9;" . ($TotalPrice / 100) * 10 ?></h4>
                                    </li>

                                    <li class="list-total">
                                        <h4>Total (INR)</h4>
                                        <h4 class="price"><?php echo "&#x20B9;" . $TotalPrice ?>
                                        </h4>
                                    </li>
                                </ul>
                            </div>


                            <div class="checkout-offer">
                                <div class="offer-title">
                                    <div class="offer-icon">
                                        <img src="<?php echo BASE_URL; ?>/asset/assets/images/inner-page/offer.svg" class="img-fluid" alt="">
                                    </div>
                                    <div class="offer-name">
                                        <h6>Available Offers</h6>
                                    </div>
                                </div>

                                <ul class="offer-detail">
                                    <li>
                                        <!-- <p>Hdf Startup Bonus 20% off...</p> -->
                                    </li>
                                </ul>
                            </div>

                            <button class="btn theme-bg-color text-white btn-md md-place w-100 mt-4 fw-bold" id="placeorder" name="placeorder" data-amtx="<?php echo $TotalPrice ?>" data-cprod="<?php echo $cartData ?>">Place Order</button>
                            <?php
                        } else {
                            echo "<script>location.href;</script><h2>Your Cart is Empty!</h2>";
                        }
                    } else {
                        echo "<address>There was Some Technical issue. (cart error).</address>";
                    }
                    ?>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php }else{
      echo "<br><center><h2><address>- There was Some Technical issue. (user error).</address></h2</center><br>";
    }?>
    <!-- Checkout section End -->

    <!-- Footer Section Start -->
    <?php include("partials/footer.php") ?>
    <!-- Footer Section End -->

    <!-- Add address modal box start -->
    <div class="modal fade theme-modal" id="add-address" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add a new address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="fname" placeholder="Enter First Name">
                            <label for="fname">First Name</label>
                        </div>
                    </form>

                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="lname" placeholder="Enter Last Name">
                            <label for="lname">Last Name</label>
                        </div>
                    </form>

                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="email" class="form-control" id="email" placeholder="Enter Email Address">
                            <label for="email">Email Address</label>
                        </div>
                    </form>

                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="address"
                                style="height: 100px"></textarea>
                            <label for="address">Enter Address</label>
                        </div>
                    </form>

                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="email" class="form-control" id="pin" placeholder="Enter Pin Code">
                            <label for="pin">Pin Code</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-bg-color btn-md text-white" data-bs-dismiss="modal">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add address modal box end -->

    <!-- Deal Box Modal Start -->
    <div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title w-100" id="deal_today">Deal Today</h5>
                        <p class="mt-1 text-content">Recommended deals for you.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="deal-offer-box">
                        <ul class="deal-offer-list">
                            <li class="list-1">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.php" class="deal-image">
                                        <img src="<?php echo BASE_URL; ?>/asset/assets/images/vegetable/product/10.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.php" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-2">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.php" class="deal-image">
                                        <img src="<?php echo BASE_URL; ?>/asset/assets/images/vegetable/product/11.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.php" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-3">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.php" class="deal-image">
                                        <img src="<?php echo BASE_URL; ?>/asset/assets/images/vegetable/product/12.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.php" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-1">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.php" class="deal-image">
                                        <img src="<?php echo BASE_URL; ?>/asset/assets/images/vegetable/product/13.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.php" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deal Box Modal End -->

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

    <!-- Lord-icon Js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/lusqsztk.js"></script>
    <!-- Bootstrap js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/popper.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/bootstrap-notify.min.js"></script>

    <!-- feather icon js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/feather/feather-icon.js"></script>

    <!-- Lazyload Js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/lazysizes.min.js"></script>

    <!-- Delivery Option js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/delivery-option.js"></script>

    <!-- Slick js-->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/slick.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/slick/custom_slick.js"></script>

    <!-- Quantity js -->
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/quantity.js"></script>

    <!-- script js -->
    <script src="dash7efascri.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/script.js"></script>
    <script>
        function echo(e) {
    const check = document.querySelector('input[name="hdf_address"]:checked');
    const check2 = document.querySelector('input[name="standard"]:checked');
    const check3 = document.querySelector('input[name="flexRadioDefault"]:checked');
    const token = "<?php #echo $token; ?>";
    const totalAmount = e.dataset.amtx;
    const tprod = e.dataset.cprod;
    const userPhone = "<?php echo $userPhone; ?>";
     const userName = "<?php echo $userName; ?>";
     const usersjvt = "<?php echo $userID;?>";
    
    
    if (!check) {
        noti("","please select Address.");
        return;
    }
    if (!check2) {
        noti("","please select Delevery method.");
        return;
    }
    if (!check3) {
        noti("","please select Payment method.");
        return;
    }
    if (check2.dataset.method === "future") {
        const fromDate = document.getElementById('from-date').value;
        const toDate = document.getElementById('to-date').value;
        const days = document.getElementById('days').value;

        if (!fromDate || !toDate || !days) {
            console.log("Please fill in the future delivery details.");
            return;
        }

        futureDeliveryData = {
            from_date: fromDate,
            to_date: toDate,
            days: days
        };
    }
        const userEmail = check? check.dataset.msg : "Not Provide";
        const mbfcfs = {
        user:usersjvt,
        username:userName,
        phone:userPhone,
        email:userEmail,
        hdf_address: check.dataset.list,
        addoi:"",
        cprod:tprod,
        total:totalAmount,
        standard: check2.dataset.method,
        paymentModes: check3 ? check3.dataset.check : "COD"
        }
        postToAnotherPage(mbfcfs);
        }
  
    </script>
    <script src="srcv1check.js"></script>
</body>

</html>