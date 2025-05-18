<?php
    error_reporting(0);
    
    // connection
    include "../db.php";

    if($_SERVER['HTTP_API_KEY'] == 'hospital123'){

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
            $stmt = $conn -> query("SELECT a.appointmentId, a.a_date, a.a_time, p.name as pName, d.name as dName, p.phone as contact, p.gender FROM appointment a join patient p on p.patientid = a.r_patientId join doctor d on d.doctorId = a.r_doctorId where a.a_date $_Ssign '$_Stoday' ORDER BY a.a_date, a.a_time;");
            $_Aappointments = $stmt -> fetchAll();
            echo json_encode($_Aappointments);
        }

        // Read an appointment to update an appointment
        if($_POST['action'] == 'getAnAppointment'){
            $_IupdateId = $_POST['updateId'];
            $stmt = $conn -> query("SELECT a.a_date, a.a_time, a.r_patientId, a.r_doctorId, p.name FROM appointment a join patient p on p.patientId = a.r_patientId WHERE appointmentId = '$_IupdateId'");
            $_AtoUpdate = $stmt -> fetch();
            echo json_encode($_AtoUpdate);
        }

        // Read a patient to update a patient
        if($_POST['action'] == 'getaPatient'){
            $_IupdateId = $_POST['p_updateId'];
            $stmt = $conn -> query("SELECT * FROM patient WHERE patientId = '$_IupdateId'"); 
            $_AtoUpdate = $stmt -> fetch();
            echo json_encode($_AtoUpdate);
        }

        // Read Patients
        if($_POST['action'] == 'getPatients'){
            $stmt = $conn -> query("SELECT * from patient;");
            $_Apatients = $stmt -> fetchAll();
            echo json_encode($_Apatients);
        }

        // Read Doctors
        if($_POST['action'] == 'getDoctors'){
            $stmt = $conn -> query("SELECT * from doctor;");
            $_Adoctors = $stmt -> fetchAll();
            echo json_encode($_Adoctors);
        }
    }
?>