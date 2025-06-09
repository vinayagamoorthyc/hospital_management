<?php
    error_reporting(0);
    
    // connection
    include "../db.php";

    // Read class
    class Read extends Database{
        private $conn;

        public function __construct(){
            parent::__construct();
            $this->conn = parent::getConnection();
        }

        // Read Appointments
        public function getAppointments($_Ssign, $_Stoday){
            $stmt = $this->conn -> prepare("SELECT a.appointmentId, a.a_date, a.a_time, a.status, p.name as pName, d.name as dName, p.phone as contact, p.gender FROM appointment a join patient p on p.patientid = a.r_patientId join doctor d on d.doctorId = a.r_doctorId where a.a_date $_Ssign ? ORDER BY a.a_date, a.a_time;");
            $stmt->bindParam(1, $_Stoday);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        // Read Patients
        public function getPatients(){
            $stmt = $this->conn->query("SELECT * from patient;");
            return $stmt->fetchAll();
        }

        // Read Doctors
        public function getDoctors(){
            $stmt = $this->conn->query("SELECT * from doctor;");
            return $stmt->fetchAll();
        }

        // Read an appointment to update an appointment
        public function getAnAppointment($_IupdateId){
            $stmt = $this->conn->prepare("SELECT a.a_date, a.a_time, a.r_patientId, a.r_doctorId, a.status, p.name FROM appointment a join patient p on p.patientId = a.r_patientId WHERE appointmentId = ?");
            $stmt->bindParam(1, $_IupdateId);
            $stmt->execute();
            return $stmt->fetch();
        }

        // Read a patient to update a patient
        public function getaPatient($_IupdateId){
            $stmt = $this->conn->prepare("SELECT * FROM patient WHERE patientId = ?");
            $stmt->bindParam(1, $_IupdateId);
            $stmt->execute();
            return $stmt->fetch();
        }
    }

    // Controlling Requests
    if($_SERVER['HTTP_API_KEY'] == 'hospital123'){
        $read = new Read();
        
        // Read Appointments
        if($_POST['action'] == 'getAppointments'){
            $_Stoday = date("Y-m-d");
            $_Ssign = '=';
            $_Sfilter = $_POST['filter'];
            if($_Sfilter == 'upcoming'){
                $_Ssign = '>';
            }
            elseif($_Sfilter == 'previous'){
                $_Ssign = '<';
            }
            echo json_encode($read->getAppointments($_Ssign, $_Stoday));
        }
        
        // Read Patients
        if($_POST['action'] == 'getPatients'){
            echo json_encode($read->getPatients());
        }
        
        // Read Doctors
        if($_POST['action'] == 'getDoctors'){
            echo json_encode($read->getDoctors());
        }

        // Read an appointment to update an appointment
        if($_POST['action'] == 'getAnAppointment'){
            $_IupdateId = $_POST['updateId'];
            echo json_encode($read->getAnAppointment($_IupdateId));
        }

        // Read a patient to update a patient
        if($_POST['action'] == 'getaPatient'){
            $_IupdateId = $_POST['p_updateId']; 
            echo json_encode($read->getaPatient($_IupdateId));
        }
    }
?>