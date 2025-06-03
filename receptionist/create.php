<?php
    error_reporting(0);

    // DB connection
    include "../db.php";

    // Appointment class
    class Appointment extends Database
    {
        private $conn;

        public function __construct(){
            parent::__construct();
            $this->conn = parent::getConnection();
        }

        public function isSlotTaken($_Sdate, $_Stime){
            $stmt = $this->conn->prepare("SELECT * FROM appointment WHERE a_date = ? AND a_time = ?");
            $stmt->bindParam(1, $_Sdate);
            $stmt->bindParam(2, $_Stime);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        }

        public function create($_Sdate, $_Stime, $_IpatientId, $_IdoctorId){
            $stmt = $this->conn->prepare("INSERT INTO appointment (a_date, a_time, r_patientId, r_doctorId) VALUES (?, ?, ?, ?);");
            $stmt->bindParam(1, $_Sdate);
            $stmt->bindParam(2, $_Stime);
            $stmt->bindParam(3, $_IpatientId);
            $stmt->bindParam(4, $_IdoctorId);
            $stmt->execute();
        }
    }

    // Patient Class
    class Patient extends Database
    {
        private $conn;

        public function __construct(){
            parent::__construct();
            $this->conn = parent::getConnection();
        }

        public function isPhoneRegistered($_Sphone){
            $stmt = $this->conn->prepare("SELECT * FROM patient WHERE phone = ?");
            $stmt->bindParam(1, $_Sphone);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        }

        public function create($_Sname, $_Iage, $_Sgender, $_Sphone){
            $stmt = $this->conn->prepare("INSERT INTO patient (name, age, gender, phone) VALUES (?, ?, ?, ?);");
            $stmt->bindParam(1, $_Sname);
            $stmt->bindParam(2, $_Iage);
            $stmt->bindParam(3, $_Sgender);
            $stmt->bindParam(4, $_Sphone);
            $stmt->execute();
        }
    }
    
    if($_SERVER['HTTP_API_KEY'] == 'hospital123'){

        $data = json_decode($_POST['data'], true);

        // create appointment
        if($_POST['action'] == 'createAppointment'){
            $appointment = new Appointment();

            $_Sdate = $data['dateOfAppointment'];
            $_Stime = $data['timeOfAppointment'];
            $_IpatientId = $data['patientId'];
            $_IdoctorId = $data['doctorId'];

            if($_Sdate < date("Y-m-d") || ($_Sdate == date("Y-m-d") && strtotime($_Stime)+60 < time())){
                echo "You're creating an appointment for past!";
            }
            elseif($appointment -> isSlotTaken($_Sdate, $_Stime)){
                echo "Already an Appointment Scheduled on this date and time!";
            }else{
                $appointment -> create($_Sdate, $_Stime, $_IpatientId, $_IdoctorId);
                echo 'created';
            }
        }
    
        // create patient
        elseif($_POST['action'] == 'createPatient'){
            $patient = new Patient();

            $_Sname = $data['name'];
            $_Iage = $data['age'];
            $_Sgender = $data['gender'];
            $_Sphone = $data['phone'];

            if(strlen($_Sname) < 3 || !preg_match("/^[a-zA-Z\s]+$/", $_Sname)){
                echo "Give valid data in the name field!";
            }
            elseif($_Iage >= 120){
                echo "Give valid data in the age field!";
            }
            elseif(strlen((string)$_Sphone) != 10){
                echo "Give valid mobile number in the contact field!";
            }
            elseif($patient -> isPhoneRegistered($_Sphone)){
                echo "Mobile Number already registered!";
            }else{
                $patient -> create($_Sname, $_Iage, $_Sgender, $_Sphone);
                echo "created";
            }
        }
    }
    else{
        echo "Unauthorized Access";
    }
    $conn = null;
?>