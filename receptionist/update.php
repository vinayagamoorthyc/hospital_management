<?php
    error_reporting(0);

    // db connection
    include "../db.php";
    $db = new Database();
    $conn = $db->getConnection();

    // Appointment Class
    class Appointment{
        private $conn;

        public function __construct($conn){
            $this->conn = $conn;
        }

        public function isSlotTaken($_Sdate, $_Stime, $_IupdateId){
            $stmt = $this->conn -> prepare("SELECT * from appointment where a_date = ? and a_time = ? and appointmentId != ?;");
            $stmt->bindParam(1, $_Sdate);
            $stmt->bindParam(2, $_Stime);
            $stmt->bindParam(3, $_IupdateId);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        }

        public function update($_Sdate, $_Stime, $_IpatientId, $_IdoctorId, $_IupdateId){
            $stmt = $this->conn->prepare("UPDATE appointment set a_date = ?, a_time = ?, r_patientId = ?, r_doctorId = ? where appointmentId = ?;");
            $stmt->bindParam(1, $_Sdate);
            $stmt->bindParam(2, $_Stime);
            $stmt->bindParam(3, $_IpatientId);
            $stmt->bindParam(4, $_IdoctorId);
            $stmt->bindParam(5, $_IupdateId);
            $stmt->execute();
        }
    }

    // Patient Class
    class Patient{
        private $conn;

        public function __construct($conn){
            $this->conn = $conn;
        }

        public function isPhoneRegistered($_Sphone, $_IupdateId){
            $stmt = $this->conn->prepare("SELECT * from patient where phone = ? and patientId != ?;");
            $stmt->bindParam(1, $_Sphone);
            $stmt->bindParam(2, $_IupdateId);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        }

        public function update($_Sname, $_Iage, $_Sgender, $_Sphone, $_IupdateId){
            $stmt = $this->conn->prepare("UPDATE patient set name = ?, age = ?, gender = ?, phone = ? where patientId = ?;");
            $stmt->bindParam(1, $_Sname);
            $stmt->bindParam(2, $_Iage);
            $stmt->bindParam(3, $_Sgender);
            $stmt->bindParam(4, $_Sphone);
            $stmt->bindParam(5, $_IupdateId);
            $stmt->execute();
        }
    }

    if($_SERVER['HTTP_API_KEY'] == 'hospital123'){
        $data = json_decode($_POST['data'], true);
        
        // update an appointment
        if($_POST['action'] == 'updateAppointment'){
            $appointment = new Appointment($conn);

            $_IupdateId = $data['updateAppointment'];
            $_Sdate = $data['dateOfAppointment'];
            $_Stime = $data['timeOfAppointment'];
            $_IpatientId = $data['patientId'];
            $_IdoctorId = $data['doctorId'];

            if($_Sdate < date("Y-m-d") || ($_Sdate == date("Y-m-d") && strtotime($_Stime)+60 < time())){
                echo "You cannot update a past appointment!";
            }
            elseif($appointment->isSlotTaken($_Sdate, $_Stime, $_IupdateId)){
               echo "Already an Appointment Scheduled on this date and time!";
            }else{
                $appointment->update($_Sdate, $_Stime, $_IpatientId, $_IdoctorId, $_IupdateId);
                echo 'updated';
            }
        }
    
        // update a patient
        elseif($_POST['action'] == 'updatePatient'){
            $patient = new Patient($conn);

            $_IupdateId = $data['updatePatient'];
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
            elseif($patient->isPhoneRegistered($_Sphone, $_IupdateId)){
                echo "Already a patient registered with this mobile number!";
            }else{
                $patient->update($_Sname, $_Iage, $_Sgender, $_Sphone, $_IupdateId);
                echo 'updated';
            }
        }
    }
    else{
        echo "Unauthorized Access!";
    }
    $conn = null;
?>