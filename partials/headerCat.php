<?php
$Cat_query = "SELECT * FROM `category` WHERE 1 ORDER BY RAND()";
$Cat_run = mysqli_query($conn, $Cat_query);
if ($Cat_run) {
    if (mysqli_num_rows($Cat_run) > 0) {
        ?>
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <style>
            .carousel_slide {
                max-width: 100vw;
                overflow: hidden;
            }

            .swiper-slide .categoryTab {
                width: 100%;
                display: flex;
                align-items: center;
                padding: 0 24px;
                color: #0da487;
            }

            .swiper-slide .categoryTab img {
                fill: #0da487;
                color: #0da487;
            }

            .swiper-slide .categoryTab:hover {
                color: #ffffff;
            }

            .swiper-slide {
                display: flex;
                justify-content: center;
                align-items: center;
                min-width:min-content;
            }
            @media screen and (max-width:768px){
             .swiper-slide {
                min-width:;
            }
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex" style="justify-content:center;">
                    <div class="carousel_slide">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($Cat_run)) {
                                    $count++;
                                    ?>
                                    <div class="swiper-slide">
                                        <div>
                                            <a href="javascript:void(0)" class="categoryTab category-box category-dark">
                                                <img src="<?php echo BASE_URL; ?>/asset/assets/images/product/<?php echo $row['caticon'] ?>" alt=""
                                                    style="max-width:25px;min-width:25px; margin:0 6px" />
                                                <h6><?php echo ucwords($row['catname']) ?>
                                                </h6>
                                            </a>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </div>
                            <!-- <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.swiper-container', {
                slidesPerView: <?php echo $count < 4 ? 2 : 5 ?>,
                spaceBetween: 10,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                // navigation: {
                //     nextEl: '.swiper-button-next',
                //     prevEl: '.swiper-button-prev'
                // },
                breakpoints: {
                    768: {
                        slidesPerView: <?php echo $count < 4 ? 2 : 5 ?>,
                    },
                    280: {
                        slidesPerView: <?php echo $count < 2 ? 1 : 3 ?>,
                    }
                }

            });
        </script>
        <?php
    }
} ?>