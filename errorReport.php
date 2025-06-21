<?php 
if (isset($_COOKIE['HDF_user_login']) && checkUserAuthentication()){
    checkUserAuthentication();
}else{
    echo "An Error";
    echo '<script>location.href="index.php"</script>';
}
?>
