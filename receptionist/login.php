<?php
error_reporting(0);
setcookie(session_name(), "", time() + 0, "/");

//authentication
if (isset($_POST['signin'])) {
    $data = array(
        'name' => $_REQUEST['name'],
        'pass' => $_REQUEST['pass']
    );
    $data = json_encode($data);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://127.0.0.1/Training_project/receptionist/authentication.php",
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
    if (!empty($_Aok)) {
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
    <!-- Tailwind CSS Script -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../assets/css/recepLogin.css">
    <title>Login</title>
</head>

<body class="p-2 mt-[50%] md:mt-0 relative bg-[#96ae971f] md:bg-white">
    <div class="login_flex relative md:flex justify-between">
        <div class="field absolute inset-0 md:static md:ml-45 z-10 backdrop-blur-lg bg-white/50 rounded-xl text-center md:text-start px-10 md:p-0">
            <div class="signin">Sign In</div>
            <div class="text-[18px] mb-3">Please enter your details.</div>
            <form class="inputs inline md:flex flex-col gap-2 w-85 mb-3" method="post">
                <div class="flex flex-col gap-3">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="password" name="pass" placeholder="Password" required>
                    <div class="text-red-500"><?php echo $response; ?></div>
                </div>
                <button class="btn w-full" type="submit" name="signin" value="signin">Sign In</button>
            </form>
            <a href="../home.php" class="block mt-3">Back</a>
        </div>
        <div class="img">
            <div class="img_text">Receptionist</div>
            <img src="../assets/images/hospital.png" alt="" width="780">
        </div>
    </div>
</body>

</html>