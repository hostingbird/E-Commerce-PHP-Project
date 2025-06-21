<?php
// global $HDFuser;
function checkUserAuthentication()
{
    global $conn;
    global $HDFuser;
    if (isset($_COOKIE['HDF_user_login'])) {
        list($userId, $token) = explode(':', $_COOKIE['HDF_user_login']);
        $stmt = $conn->prepare("SELECT token , expires_at FROM user_tokens WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            $stmt->bind_result($storedToken, $expiresAt);
            $stmt->fetch();
            $stmt->close();

            if ($storedToken !== $token || $expiresAt <= time()) {
                logoutUser();
                return false;
            } else {
                $stmt = $conn->prepare("SELECT name, logo, dor, phone, `user_banner`, `dob`, `gender` FROM user WHERE id = ?");
                $stmt->bind_param("i", $userId);
                if ($stmt->execute()) {
                    $stmt->bind_result($HDFNAME, $HDFLOGO, $HDFDOR, $HDFPHONE, $HDFBANNER, $HDFDOB, $HDFGENDER);
                    if ($stmt->fetch()) {
                        $HDFuser = [
                            'id' => $userId,
                            'name' => $HDFNAME,
                            'logo' => $HDFLOGO,
                            'dor' => $HDFDOR,
                            'phone' => $HDFPHONE,
                            'banner' => $HDFBANNER,
                            'dob' => $HDFDOB,
                            'gender' => $HDFGENDER
                        ];
                    }
                    $stmt->close();
                }

            }
            return true;

        } else {
            echo 'Failed to execute query';
            logoutUser();
            return false;
        }
    } else {
        return false;
    }
}

function logoutUser()
{
    global $conn;
    if ($_COOKIE['HDF_user_login']) {
        list($userId, $token) = explode(':', $_COOKIE['HDF_user_login']);
        $user_id = $userId;
        $_blank = "";
        $stmt = $conn->prepare("UPDATE user_tokens SET token = ? , expires_at = ? WHERE user_id = ?");
        $stmt->bind_param('ssi', $_blank, $_blank, $user_id);
        if ($stmt->execute()) {

            setcookie('HDF_user_login', "", [
                'expires' => time() - 360000,
                'path' => '/',
                'domain' => 'localhost',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
            $_SESSION['HDF_user_login'] = "";
            session_unset();
            session_destroy();
            unset($_COOKIE['HDF_user_login']);
            echo "logging out...";
            header('Location: index.php');
            $stmt->close();
        } else {
            echo "Not Able to logout";
            header("Location:index.php");

        }
    } else {
        header('Location: index.php');
    }
}


?>