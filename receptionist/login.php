<?php
    error_reporting(0);

    // db connection
    include "../db.php";
    setcookie(session_name(), "", time()+0, "/");

    //authentication
    if(isset($_POST['signin'])){
        $data = array(
            'name' => $_REQUEST['name'],
            'pass' => $_REQUEST['pass']
        );
        $data = json_encode($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://127.0.0.1/evaluation3/receptionist/authentication.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => array("API-KEY: hospital123"),
            CURLOPT_POSTFIELDS => array(
                "data" => $data,
                "action" => "receptionist"
                )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $_Aok = json_decode($response, 1);
        if(!empty($_Aok)){
            session_start();
            $_SESSION['sessionId'] = $_Aok['receptionistId'];
            header("Location: receptionist.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/recepLogin.css">
    <title>Login</title>
</head>
<body>
    <div class="login_flex">
        <div class="field">
            <div class="signin">Sign In</div>
            <div style="font-size: 18px;">Please enter your details.</div>
            <form class="inputs" method="post">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="password" name="pass" placeholder="Password" required>
                <div style='color:red;'><?php echo $response;?></div>
                <button class="btn" type="submit" name="signin" value="signin">Sign In</button>
            </form>
        </div>
        <div class="img">
            <div class="img_text">Receptionist</div>
            <img src="../assets/images/hospital.png" alt="" width="780">
        </div>
    </div>
</body>
</html>
<?php
    $conn = null;
?>