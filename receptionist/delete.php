<?php
    error_reporting(0);

    // db connection
    include "../db.php";
    $db = new Database();
    $conn = $db->getConnection();

    // Appointment class
    class Appointment{
        private $conn;

        public function __construct($conn){
            $this->conn = $conn;
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
            $appointment = new Appointment($conn);

            $appointment->delete($_IdeleteId);
            echo "deleted";
        }
    }
    $conn = null;
?>