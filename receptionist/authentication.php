<?php
    error_reporting(0);

    // db connection
    include "../db.php";
    $db = new Database();
    $conn = $db->getConnection();

    if($_SERVER['HTTP_API_KEY'] == 'hospital123'){
        
        //authentication
        if($_POST['action'] == 'receptionist'){
            $data = json_decode($_POST['data'], true);
            $_Sname = $data['name'];
            $_Spass = $data['pass'];
            $stmt = $conn -> query("SELECT * from receptionist where name = '$_Sname' and pass = '$_Spass';");
            if(strlen($_Sname) < 3 || !preg_match("/^[a-zA-Z\s]+$/", $_Sname)){
                $_Serror = "Please, enter valid name!";
                echo $_Serror;
            }
            elseif(strlen($_Spass) < 8 || preg_match("/^[a-zA-Z\s]+$/", $_Spass)){
                $_Serror = "Password should be atleaast 8 characters!";
                echo $_Serror;
            }
            elseif($stmt -> rowCount() == 1){
                $_Areceptionist = $stmt -> fetch();
                $response = array("receptionistId" => $_Areceptionist['receptionistId']);
                echo json_encode($response);
            }else{
                // error for wrong access
                $_Serror = "You entered wrong name or password!";
                echo $_Serror;
            }
        }
    }
?>