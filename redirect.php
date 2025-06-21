<?php 
session_start();
include('confi.php');
if(isset($_SESSION['user_ID']) && isset($_SESSION['user_PHONE']) && isset($_SESSION['user_NAME'])){
    echo "<script>location.href='index.php'</script>";
}else{
    echo "<script>location.href='index.php'</script>";
}
?>