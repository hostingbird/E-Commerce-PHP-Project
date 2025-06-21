<?php
require_once 'global.php';
// $currentDomain = $_SERVER['HTTP_HOST'];
// $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
// $currentUrl = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// $parsedUrl = parse_url($currentUrl);
// $path = $parsedUrl['path'];


// $path = ltrim($path, '/');

// // Split the path into an array
// $pathParts = explode('/', $path);

// // Get the directory immediately after the domain
// $firstDirectory = isset($pathParts[0]) ? '/' . $pathParts[0] : '';
?>
<?php include('confi.php'); ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="हर दिन Fresh Grocery">
    <meta name="keywords" content="हर दिन Fresh Grocery">
    <meta name="author" content="हर दिन Fresh Grocery">
    <link rel="icon" href="<?php echo BASE_URL; ?>/asset/assets/images/favicon/1.png"
        type="image/x-icon">
    <title>On-demand Fresh delivery</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css"
        href="<?php echo BASE_URL; ?>/asset/assets/css/vendors/bootstrap.css">


    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css"
        href="<?php echo BASE_URL; ?>/asset/assets/css/bulk-style.css">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css"
        href="<?php echo BASE_URL; ?>/asset/assets/css/style.css">
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/asset/assets/js/bootstrap/bootstrap-notify.min.js"></script>

</head>