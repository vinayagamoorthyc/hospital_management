<?php
    error_reporting(0);

    // db connection
    include "../db.php";

    // Appointment class
    class Appointment extends Database{
        private $conn;

        public function __construct(){
            parent::__construct();
            $this->conn = parent::getConnection();
        }

        public function delete($_IdeleteId){
            $stmt = $this->conn -> prepare("DELETE FROM appointment WHERE appointmentId = ?;");
            $stmt->bindParam(1, $_IdeleteId);
            $stmt->execute();
        }
    }

    if($_SERVER['HTTP_API_KEY'] == 'hospital123'){
        $_IdeleteId = $_POST['deleteId'];

        // delete an appointment
        if($_POST['action'] == 'deleteAnAppointment'){
            $appointment = new Appointment();

            $appointment->delete($_IdeleteId);
            echo "deleted";
        }
    }
    $conn = null;
?>