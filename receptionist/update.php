<?php
    error_reporting(0);

    // db connection
    include "../db.php";

    if($_SERVER['HTTP_API_KEY'] == 'hospital123'){
        // update an appointment
        if($_POST['action'] == 'updateAppointment'){
            $data = json_decode($_POST['data'], true);
            $_IupdateId = $data['updateAppointment'];
            $_Sdate = $data['dateOfAppointment'];
            $_Stime = $data['timeOfAppointment'];
            $_IpatientId = $data['patientId'];
            $_IdoctorId = $data['doctorId'];
            $stmt = $conn -> query("SELECT * from appointment where a_date = '$_Sdate' and a_time = '$_Stime' and appointmentId != $_IupdateId;");
            if($_Sdate < date("Y-m-d") || ($_Sdate == date("Y-m-d") && strtotime($_Stime)+60 < time())){
                echo "You cannot update a past appointment!";
            }
            elseif($stmt -> rowCount() > 0){
               echo "Already an Appointment Scheduled on this date and time!";
            }else{
                $stmt = $conn -> prepare("UPDATE appointment set a_date = ?, a_time = ?, r_patientId = ?, r_doctorId = ? where appointmentId = ?;");
                $stmt -> bindParam(1, $_Sdate);
                $stmt -> bindParam(2, $_Stime);
                $stmt -> bindParam(3, $_IpatientId);
                $stmt -> bindParam(4, $_IdoctorId);
                $stmt -> bindParam(5, $_IupdateId);
                $stmt -> execute();
                echo 'updated';
            }
        }
    
        // update a patient
        elseif($_POST['action'] == 'updatePatient'){
            $data = json_decode($_POST['data'], true);
            $_IupdateId = $data['updatePatient'];
            $_Sname = $data['name'];
            $_Iage = $data['age'];
            $_Sgender = $data['gender'];
            $_Sphone = $data['phone'];
            $stmt = $conn -> query("SELECT * from patient where phone = '$_Sphone' and patientId != $_IupdateId;");
            if(strlen($_Sname) < 3 || !preg_match("/^[a-zA-Z\s]+$/", $_Sname)){
                echo "Give valid data in the name field!";
            }
            elseif($_Iage >= 120){
                echo "Give valid data in the age field!";
            }
            elseif(strlen((string)$_Sphone) != 10){
                echo "Give valid mobile number in the contact field!";
            }
            elseif($stmt -> rowCount() > 0){
                echo "Already a patient registered with this mobile number!";
            }else{
                $stmt = $conn -> prepare("UPDATE patient set name = ?, age = ?, gender = ?, phone = ? where patientId = ?;");
                $stmt -> bindParam(1, $_Sname);
                $stmt -> bindParam(2, $_Iage);
                $stmt -> bindParam(3, $_Sgender);
                $stmt -> bindParam(4, $_Sphone);
                $stmt -> bindParam(5, $_IupdateId);
                $stmt -> execute();
                echo 'updated';
            }
        }
    }
    $conn = null;
?>