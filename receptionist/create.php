<?php
    error_reporting(0);

    // db connection
    include "../db.php";
    
    if($_SERVER['HTTP_API_KEY'] == 'hospital123'){

        // create appointment
        if($_POST['action'] == 'createAppointment'){
            $data = json_decode($_POST['data'], true);
            $_Sdate = $data['dateOfAppointment'];
            $_Stime = $data['timeOfAppointment'];
            $_IpatientId = $data['patientId'];
            $_IdoctorId = $data['doctorId'];
            $stmt = $conn -> query("SELECT * from appointment where a_date = '$_Sdate' and a_time = '$_Stime';");
            if($_Sdate < date("Y-m-d") || ($_Sdate == date("Y-m-d") && strtotime($_Stime)+60 < time())){
                echo "You're creating an appointment for past!";
            }
            elseif($stmt -> rowCount() == 1){
                echo "Already an Appointment Scheduled on this date and time!";
            }else{
                $stmt = $conn -> prepare("INSERT INTO appointment (a_date, a_time, r_patientId, r_doctorId) VALUES (?, ?, ?, ?);");
                $stmt -> bindParam(1, $_Sdate);
                $stmt -> bindParam(2, $_Stime);
                $stmt -> bindParam(3, $_IpatientId);
                $stmt -> bindParam(4, $_IdoctorId);
                $stmt -> execute();
                echo 'created';
            }
        }
    
        // create patient
        elseif($_POST['action'] == 'createPatient'){
            $data = json_decode($_POST['data'], true);
            $_Sname = $data['name'];
            $_Iage = $data['age'];
            $_Sgender = $data['gender'];
            $_Sphone = $data['phone'];
            $stmt = $conn -> query("SELECT * from patient where phone = '$_Sphone';");
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
                echo "Mobile Number already registered!";
            }else{
                $stmt = $conn -> prepare("INSERT INTO patient (name, age, gender, phone) VALUES (?, ?, ?, ?);");
                $stmt -> bindParam(1, $_Sname);
                $stmt -> bindParam(2, $_Iage);
                $stmt -> bindParam(3, $_Sgender);
                $stmt -> bindParam(4, $_Sphone);
                $stmt -> execute();
                echo "created";
            }
        }
    }
    $conn = null;
?>