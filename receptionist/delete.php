<?php
    // error_reporting(0);

    // db connection
    include "../db.php";

    if($_SERVER['HTTP_API_KEY'] == 'hospital123'){

        // delete an appointment
        if($_POST['action'] == 'deleteAnAppointment'){
            $_IdeleteId = $_POST['deleteId'];
            $conn -> query("DELETE FROM appointment WHERE appointmentId = $_IdeleteId;");
            echo "deleted";
        }
    }
    $conn = null;
?>