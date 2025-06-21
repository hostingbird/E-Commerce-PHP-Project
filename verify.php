<?php
error_reporting(0);
ini_set("display_errors" , 0);
include ("partials/session.php") ?>
<?php include ('confi.php');?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);
$user_json_url = $input['user_json_url'];

$json_data = file_get_contents($user_json_url);
$data = json_decode($json_data, true);

if ($data) {
    $fname = $data['user_first_name'];
    $lname = $data['user_last_name'];
    $phone = $data['user_country_code'] . $data['user_phone_number'];
    $name = $fname ? $fname : "newuser";
    $name .= ($lname ? " " . $lname : " hdf1");

    if (isset($phone) && isset($name)) {
        $stmt = $conn->prepare("SELECT id, name FROM user WHERE phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->bind_result($userId, $username);
        $stmt->fetch();
        $stmt->close();

        $token = bin2hex(random_bytes(32)); 
        $expireTime = time() + 86400 * 30; 

        if ($userId) {
            $stmt = $conn->prepare("UPDATE user_tokens SET token = ?, expires_at = ? WHERE user_id = ?");
            $stmt->bind_param("ssi", $token, $expireTime, $userId);
            
            
            
            if( $stmt->execute()){
                
                   setcookie('HDF_user_login', $userId.':'.$token.':'.$username.':'.$phone,[
        'expires' => $expireTime,
        'path' => '/',
        'domain' => 'localhost',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
                $_SESSION['HDF_user_login'] = $userId;

            echo json_encode([
                'success' => true,
                'txt' => ['Signin success']
            ]);
            }else{
                 echo json_encode([
                     'id' => $newUserId,
                'success' => false,
                'txt' => ['Signin token failed']
            ]);
            }
            $stmt->close();
        } else {
            $stmt = $conn->prepare("INSERT INTO user (name, phone, session, dor) VALUES (?, ?, ?, ?)");
            $ip_address = 'hdf_' . $_SERVER["REMOTE_ADDR"];
            $regDate = date('Y-m-d H:i:s');
            $stmt->bind_param("ssss", $name, $phone, $ip_address, $regDate);

            if ($stmt->execute()) {
                $newUserId = $stmt->insert_id;
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO user_tokens (user_id, token, expires_at) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $newUserId, $token, $expireTime);
                if($stmt->execute()){
                     
                   $_SESSION['HDF_user_login'] = $newUserId;
                     setcookie('HDF_user_login', $newUserId.':'.$token.':'. $name.':'.$phone,[
                        'expires' => $expireTime,
                        'path' => '/',
                        'domain' => 'localhost',
                        'secure' => false,
                        'httponly' => true,
                        'samesite' => 'Lax'
                    ]);
    
                   echo json_encode([
                      'id'=> $newUserId,
                    'success' => true,
                    'txt' => ['Signup success']
                    ]);
                }else{
                    echo json_encode([
                    'success' => false,
                    'txt' => ['Token Insertation failed']
                ]);
                }
                $stmt->close();
            } else {
                echo json_encode([
                    'success' => false,
                    'txt' => ['Db insert failed ,Server Error, please try again later']
                ]);
            }
        }
    } else {
        echo json_encode([
            'success' => false,
            'txt' => ['Phone or name missing']
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'txt' => ['Invalid request! error']
    ]);
}
?>
