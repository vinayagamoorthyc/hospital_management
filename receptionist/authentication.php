<?php
    error_reporting(0);

    // db connection
    include "../db.php";

    // Receptionist Class
    class Receptionist extends Database{
        private $conn;

        public function __construct(){
            parent::__construct();
            $this->conn = parent::getConnection();
        }

        public function findReceptionist($_Sname, $_Spass){
            $stmt = $this->conn -> prepare("SELECT * from receptionist where name = ? and pass = ?;");
            $stmt->bindParam(1, $_Sname);
            $stmt->bindParam(2, $_Spass);
            $stmt->execute();
            return $stmt;
        }
    }

    if($_SERVER['HTTP_API_KEY'] == 'hospital123'){
        $data = json_decode($_POST['data'], true);
        
        //authentication
        if($_POST['action'] == 'receptionist'){
            $receptionist = new Receptionist();

            $_Sname = $data['name'];
            $_Spass = $data['pass'];

            if(strlen($_Sname) < 3 || !preg_match("/^[a-zA-Z\s]+$/", $_Sname)){
                $_Serror = "Please, enter valid name!";
                echo $_Serror;
            }
            elseif(strlen($_Spass) < 8 || preg_match("/^[a-zA-Z\s]+$/", $_Spass)){
                $_Serror = "Password should be atleaast 8 characters!";
                echo $_Serror;
            }
            // If authentication success
            elseif(($stmt = $receptionist-> findReceptionist($_Sname, $_Spass)) -> rowCount() == 1){
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
    else{
        echo "Unauthorized Access!";
    }
    $conn = null;
?>