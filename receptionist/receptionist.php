<?php
error_reporting(0);
ob_start();

// session management
session_start();
if (!isset($_SESSION['sessionId'])) {
    header("Location: login.php");
}

// Logout Session
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    setcookie(session_name(), "", time() + 0, "/");
    header("Location: login.php");
}

// Profile Image upload
elseif (isset($_FILES['profile_img'])) {
    $_AallowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (in_array($_FILES['profile_img']['type'], $_AallowedTypes)) {
        move_uploaded_file($_FILES['profile_img']['tmp_name'], "../assets/images/profile.png");
        setcookie("success_msg", "Profile Picture Uploaded Successfully!", time() + 2);
        header("Location: receptionist.php");
    } else {
        setcookie("create_error", "You uploaded unsupported file! Upload format like png, jpg, jpeg!", time() + 2);
        header("Location: receptionist.php");
    }
}

// Show all appointments
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://127.0.0.1/Training_project/receptionist/read.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array("API-KEY: hospital123"),
    CURLOPT_POSTFIELDS => array(
        "filter" => $_GET['filter'],
        "action" => "getAppointments"
    )
));
$response = curl_exec($curl);
curl_close($curl);
$_Aappointments = json_decode($response, true);

// For Status Color Change
if ($_GET['filter'] == 'previous') {
    $_Spast_restrict = "disabled";
    $mark = "border-left: 5px solid #6c757d;";
} else if ($_GET['filter'] == 'upcoming') {
    $mark = "border-left: 5px solid #007bff;";
} else {
    $mark = "border-left: 5px solid #28a745;";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link for Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <!-- Script for toast for image upload functionality -->
    <script src="../assets/js/toast.js"></script>
    <!-- Link for Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Link for my style -->
    <link rel="stylesheet" href="../assets/css/receptionist.css">
    <title>Receptionist</title>
</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary custom_nav fixed-top">
        <div class="container-fluid custom_container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand custom_brand" href="#">Receptionist</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="flex-grow: 0;">
                <div class="nav_flex">
                    <img src="../assets/images/profile.png" alt="" width="40" height="40" class="profile_image nav-item" id="liveToastBtn">
                    <div class="dropdown dropdown_main nav-item">
                        <button class="btn dropdown-toggle custom_dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Get Details
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom1" aria-controls="offcanvasBottom">Patients</a></li>
                            <li><a class="dropdown-item" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom2" aria-controls="offcanvasBottom">Doctors</a></li>
                        </ul>
                    </div>
                    <form method='post' style='display:inline;' class="nav-item">
                        <button class='btn custom_logout' type='submit' name="logout" value="logout"><i class="bi bi-person profile_icon"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!-- end of header -->
    <!-- body -->
    <div class="body">
        <!-- Topic with filters and add buttons -->
        <div class="topic_flex">
            <h4>Appointments</h4>
            <div class="btn_flex">
                <div class="dropdown">
                    <button class="btn dropdown-toggle custom_dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter by Date
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./receptionist.php?filter=today">Today</a></li>
                        <li><a class="dropdown-item" href="./receptionist.php?filter=previous">Previous</a></li>
                        <li><a class="dropdown-item" href="./receptionist.php?filter=upcoming">Upcoming</a></li>
                    </ul>
                </div>
                <span class="count position-relative">
                    <span class="badge text-bg-secondary bg-warning text-black">
                        <?php
                        echo count($_Aappointments);
                        ?>
                    </span> Appointments
                </span>
                <button class="create-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop3" aria-controls="offcanvasTop">Register a Patient</button>
                <button class="create-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Create an Appointment</button>
            </div>
        </div>
        <!-- End of Topic -->
        <!-- show Appointment table -->
        <div class="table_container">
            <?php
            // Alert for duplication
            if (isset($_COOKIE['create_error'])) {
                $_Screate_error = $_COOKIE['create_error'];
                echo "<div class='alert alert-warning custom_warning' role='alert'>
                    $_Screate_error
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
            // Success message for creation
            elseif (isset($_COOKIE['success_msg'])) {
                $_Ssuccess_msg = $_COOKIE['success_msg'];
                echo "<div class='alert alert-success custom_warning' role='alert'>
                    $_Ssuccess_msg
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
            // delete message after deletion
            elseif (isset($_COOKIE['delete_msg'])) {
                $_Sdelete_msg = $_COOKIE['delete_msg'];
                echo "<div class='alert alert-danger custom_warning' role='alert'>
                    $_Sdelete_msg
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
            ?>
            <div class="table-responsive">
                <table class="table table-hover custom_table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Appointment ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Patient Gender</th>
                            <th scope="col">Patient Contact</th>
                            <th scope="col">Doctor Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($_Aappointments) > 0) {
                            foreach ($_Aappointments as $key => $value) {
                                if ($_GET['filter'] == 'previous') {
                                    $_Spast_restrict = "disabled";
                                    $mark = "border-left: 5px solid #6c757d;";
                                } else if ($_GET['filter'] == 'upcoming') {
                                    $mark = "border-left: 5px solid #007bff;";
                                } else {
                                    if ($value['status'] == 'Not Attended') {
                                        $mark = "border-left: 5px solid red;";
                                    } else {
                                        $mark = "border-left: 5px solid #28a745;";
                                    }
                                }
                        ?>
                                <tr>
                                    <th scope='row' style="<?php echo $mark; ?>"><?php echo $value['appointmentId'] ?></th>
                                    <td><?php echo $value['a_date'] ?></td>
                                    <td><?php echo $value['a_time'] ?></td>
                                    <td><?php echo $value['pName'] ?></td>
                                    <td><?php echo $value['gender'] ?></td>
                                    <td><?php echo $value['contact'] ?></td>
                                    <td><?php echo $value['dName'] ?></td>
                                    <td><?php echo $value['status'] ?></td>
                                    <td>
                                        <form method='post' style='display:inline;'>
                                            <input type='hidden' name='updateId' value="<?php echo $value['appointmentId'] ?>">
                                            <button class='update-btn' type='submit' <?php echo $_Spast_restrict ?>>Update</button>
                                        </form>
                                        <button type='button' class='delete-btn' <?php echo $_Spast_restrict ?> data-bs-toggle='modal' data-bs-target='#exampleModal'>Cancel</button>
                                        <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog modal-sm'>
                                                <div class='modal-content'>
                                                    <div class='modal-header' style="background-color: #96ae97a9;">
                                                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Remove Confirmation</h1>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Back</button>
                                                        <form method='post' style='display:inline;'>
                                                            <input type='hidden' name='deleteId' value='<?php echo $value['appointmentId'] ?>'>
                                                            <button type='submit' class='btn btn-danger'>Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "
                                    <tr>
                                        <td colspan='9' style='text-align: center; '>No Record Found</td>
                                    </tr>
                                ";
                        }
                        //delete an appointment
                        if (isset($_POST['deleteId'])) {
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => "http://127.0.0.1/Training_project/receptionist/delete.php",
                                // CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_POST => true,
                                CURLOPT_HTTPHEADER => array("API-KEY: hospital123"),
                                CURLOPT_POSTFIELDS => array(
                                    "deleteId" => $_POST['deleteId'],
                                    "action" => "deleteAnAppointment"
                                )
                            ));
                            $response = curl_exec($curl);
                            curl_close($curl);
                            if ($response == 'deleted') {
                                setcookie("delete_msg", "You have cancelled an appointment!", time() + 2);
                                header("Location: receptionist.php");
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Body -->
    <!-- create an appointment offcanvas -->
    <div class=" offcanvas offcanvas-top" tabindex="-1" data-bs-scroll="true" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
        <?php
        if (isset($_POST['addAppointment'])) {
            $data = array(
                'dateOfAppointment' => $_REQUEST['dateOfAppointment'],
                'timeOfAppointment' => $_REQUEST['timeOfAppointment'],
                "patientId" => $_REQUEST['patientId'],
                'doctorId' => $_REQUEST['doctorId']
            );
            $data = json_encode($data);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://127.0.0.1/Training_project/receptionist/create.php",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array("API-KEY: hospital123"),
                CURLOPT_POSTFIELDS => array(
                    "data" => $data,
                    "action" => "createAppointment"
                )
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            if ($response == 'created') {
                setcookie("success_msg", "Appointment created successfully!", time() + 2);
                header("Location: receptionist.php");
            } else {
                setcookie("create_error", $response, time() + 2);
                header("Location: receptionist.php");
            }
        }
        ?>
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasTopLabel">Create an Appointment</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="inputs" method="post">
                <div class="input_flex">
                    <input type="date" name="dateOfAppointment" placeholder="Date" required>
                    <input type="time" name="timeOfAppointment" placeholder="Time" required>
                    <select name="patientId">
                        <option selected disabled>Patient Name</option>
                        <?php
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "http://127.0.0.1/Training_project/receptionist/read.php",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_HTTPHEADER => array("API-KEY: hospital123"),
                            CURLOPT_POSTFIELDS => array("action" => "getPatients")
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $_Apatients = json_decode($response, true);
                        if (count($_Apatients) > 0) {
                            foreach ($_Apatients as $key => $value) {
                                echo "
                                        <option value='" . $value['patientId'] . "'>" . $value['name'] . "</option>
                                    ";
                            }
                        }
                        ?>
                    </select>
                    <select name="doctorId">
                        <option selected disabled>Doctor Name</option>
                        <?php
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "http://127.0.0.1/Training_project/receptionist/read.php",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_HTTPHEADER => array("API-KEY: hospital123"),
                            CURLOPT_POSTFIELDS => array("action" => "getDoctors")
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $_Adoctors = json_decode($response, true);
                        if (count($_Adoctors) > 0) {
                            foreach ($_Adoctors as $key => $value) {
                                echo "
                                        <option value='" . $value['doctorId'] . "'>" . $value['name'] . "</option>
                                    ";
                            }
                        }
                        ?>
                    </select>
                </div>
                <button class="add-btn" type="submit" name="addAppointment" value="add">Add Appointment</button>
            </form>
        </div>
    </div>
    <!-- End of create Appointment -->
    <!-- create a patient offcanvas -->
    <div class="offcanvas offcanvas-top" tabindex="-1" data-bs-scroll="true" id="offcanvasTop3" aria-labelledby="offcanvasTopLabel">
        <?php
        if (isset($_POST['addPatient'])) {
            $data = array(
                'name' => $_REQUEST['name'],
                'age' => $_REQUEST['age'],
                "gender" => $_REQUEST['gender'],
                'phone' => $_REQUEST['phone']
            );
            $data = json_encode($data);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://127.0.0.1/Training_project/receptionist/create.php",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array("API-KEY: hospital123"),
                CURLOPT_POSTFIELDS => array(
                    "data" => $data,
                    "action" => "createPatient"
                )
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            if ($response == 'created') {
                setcookie("success_msg", "Patient registered successfully!", time() + 2);
                header("Location: receptionist.php");
            } else {
                setcookie("create_error", $response, time() + 2);
                header("Location: receptionist.php");
            }
        }
        ?>
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasTopLabel">Create a Patient</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="inputs" method="post">
                <div class="input_flex">
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="number" name="age" placeholder="Age" required>
                    <select name="gender">
                        <option selected disabled>Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <input type="text" name="phone" placeholder="Mobile Number" required>
                </div>
                <button class="add-btn" type="submit" name="addPatient" value="addPatient">Add Patient</button>
            </form>
        </div>
    </div>
    <!-- End of create patient -->
    <!-- update an appointment -->
    <div class="offcanvas offcanvas-top <?php if (isset($_POST['updateId'])) echo "show"; ?>" tabindex="-1" data-bs-scroll="true" id="offcanvasTop2" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasTopLabel">Update an Appointment</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php
            if (isset($_POST['updateId'])) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://127.0.0.1/Training_project/receptionist/read.php",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => array("API-KEY: hospital123"),
                    CURLOPT_POSTFIELDS => array(
                        "updateId" => $_POST['updateId'],
                        "action" => "getAnAppointment"
                    )
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $_AtoUpdate = json_decode($response, true);
            }
            ?>
            <form class="inputs" method="post">
                <div class="input_flex">
                    <input type="date" name="dateOfAppointment" placeholder="Date" required value="<?php echo $_AtoUpdate['a_date']; ?>">
                    <input type="time" name="timeOfAppointment" placeholder="Time" required value="<?php echo $_AtoUpdate['a_time']; ?>">
                    <input type="number" name="patientId" placeholder="Patient ID" required value="<?php echo $_AtoUpdate['r_patientId']; ?>" hidden>
                    <input type="text" name="patientName" required value="<?php echo $_AtoUpdate['name']; ?>" disabled>
                    <select name="doctorId">
                        <option selected disabled>Doctor Name</option>
                        <?php
                        foreach ($_Adoctors as $key => $value) {
                            echo "<option ";
                            if ($_AtoUpdate['r_doctorId'] == $value['doctorId']) {
                                echo "selected";
                            }
                            echo " value='" . $value['doctorId'] . "'>" . $value['name'] . "</option>";
                        }
                        ?>
                    </select>
                    <select name="status">
                        <!-- <option selected disabled>Status</option> -->
                        <?php
                            echo "<option selected value='" . $_AtoUpdate['status'] . "'>" . $_AtoUpdate['status'] . "</option>";
                            if($_AtoUpdate['status'] == 'Attended'){
                                echo "<option value='Not Attended'>Not Attended</option>";
                            } 
                            elseif ($_AtoUpdate['status'] == 'Not Attended') {
                            echo "<option value='Attended'>Attended</option>";
                            }
                        ?>
                    </select>
                </div>
                <button class="update-btn" type="submit" name="updateAppointment" value="<?php echo $_POST['updateId']; ?>">Update Appointment</button>
            </form>
        </div>
        <?php
        if (isset($_POST['updateAppointment'])) {
            $data = array(
                'updateAppointment' => $_POST['updateAppointment'],
                'dateOfAppointment' => $_POST['dateOfAppointment'],
                'timeOfAppointment' => $_POST['timeOfAppointment'],
                "patientId" => $_POST['patientId'],
                'doctorId' => $_POST['doctorId'],
                "status" => $_POST['status']
            );
            $data = json_encode($data);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://127.0.0.1/Training_project/receptionist/update.php",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array("API-KEY: hospital123"),
                CURLOPT_POSTFIELDS => array(
                    "data" => $data,
                    "action" => "updateAppointment"
                )
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            if ($response == 'updated') {
                setcookie("success_msg", "Appointment updated successfully!", time() + 2);
                header("Location: receptionist.php");
            } else {
                setcookie("create_error", $response, time() + 2);
                header("Location: receptionist.php");
            }
        }
        ?>
    </div>
    <!-- end of update appointment-->
    <!-- Show Patients -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom1" aria-labelledby="offcanvasBottomLabel" style="height: 100%;">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasBottomLabel">Patients</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="table_container">
                <table class="table table-hover custom_table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Patient ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($_Apatients) > 0) {
                            foreach ($_Apatients as $key => $value) {
                                echo "
                                        <tr>
                                            <th scope='row'>" . $value['patientId'] . "</th>
                                            <td>" . $value['name'] . "</td>
                                            <td>" . $value['age'] . "</td>
                                            <td>" . $value['gender'] . "</td>
                                            <td>" . $value['phone'] . "</td>
                                            <td>
                                                <form method='post' style='display:inline;'>
                                                    <input type='hidden' name='p_updateId' value='" . $value['patientId'] . "'>
                                                    <button class='update-btn' type='submit'>Update</button>
                                                </form>
                                            </td>
                                        </tr>
                                    ";
                            }
                        } else {
                            echo "
                                    <tr>
                                        <td colspan='6' style='text-align: center'>No Record Found</td>
                                    </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end of show patients -->
    <!-- update a patient -->
    <div class="offcanvas offcanvas-top <?php if (isset($_POST['p_updateId'])) echo "show"; ?>" tabindex="-1" data-bs-scroll="true" id="offcanvasTop2" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasTopLabel">Update a Patient</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php
            if (isset($_POST['p_updateId'])) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://127.0.0.1/Training_project/receptionist/read.php",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => array("API-KEY: hospital123"),
                    CURLOPT_POSTFIELDS => array(
                        "p_updateId" => $_POST['p_updateId'],
                        "action" => "getaPatient"
                    )
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $_AtoUpdate = json_decode($response, true);
            }
            ?>
            <form class="inputs" method="post">
                <div class="input_flex">
                    <input type="text" name="name" placeholder="Patient's Name" required value="<?php echo $_AtoUpdate['name']; ?>">
                    <input type="number" name="age" placeholder="Patient's Age" required value="<?php echo $_AtoUpdate['age']; ?>">
                    <select name="gender">
                        <option selected disabled>Patient's Gender</option>
                        <option value="male" <?php if ($_AtoUpdate['gender'] == 'male') echo 'selected' ?>>Male</option>
                        <option value="female" <?php if ($_AtoUpdate['gender'] == 'female') echo 'selected' ?>>Female</option>
                    </select>
                    <input type="text" name="phone" placeholder="Contact Number" required value="<?php echo $_AtoUpdate['phone']; ?>">
                </div>
                <button class="update-btn" type="submit" name="updatePatient" value="<?php echo $_POST['p_updateId']; ?>">Update Patient</button>
            </form>
        </div>
        <?php
        if (isset($_POST['updatePatient'])) {
            $data = array(
                'updatePatient' => $_POST['updatePatient'],
                'name' => $_POST['name'],
                'age' => $_POST['age'],
                "gender" => $_POST['gender'],
                'phone' => $_POST['phone']
            );
            $data = json_encode($data);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://127.0.0.1/Training_project/receptionist/update.php",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array("API-KEY: hospital123"),
                CURLOPT_POSTFIELDS => array(
                    "data" => $data,
                    "action" => "updatePatient"
                )
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            if ($response == 'updated') {
                setcookie("success_msg", "Patient Details updated successfully!", time() + 2);
                header("Location: receptionist.php");
            } else {
                setcookie("create_error", $response, time() + 2);
                header("Location: receptionist.php");
            }
        }
        ?>
    </div>
    <!-- end of update patient-->
    <!-- Show Doctors -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom2" aria-labelledby="offcanvasBottomLabel" style="height: 100%;">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasBottomLabel">Doctors</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="table_container">
                <table class="table table-hover custom_table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Doctor ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Specialization</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($_Adoctors) > 0) {
                            foreach ($_Adoctors as $key => $value) {
                                echo "
                                        <tr>
                                            <th scope='row'>" . $value['doctorId'] . "</th>
                                            <td>" . $value['name'] . "</td>
                                            <td>" . $value['specialization'] . "</td>
                                            <td>" . $value['phone'] . "</td>
                                            <td>" . $value['email'] . "</td>
                                        </tr>
                                    ";
                            }
                        } else {
                            echo "
                                    <tr>
                                        <td colspan='5' style='text-align: center'>No Record Found</td>
                                    </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Emd of Show doctors -->
    <!-- Profile Upload Toast -->
    <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" style="width: 375px;">
            <div class="toast-header" style="background-color: #96ae97a9;">
                <strong class="me-auto">Profile Upload</strong>
                <small></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <form action="receptionist.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="profile_img" id="profile_img" required>
                    <input type="submit" class="custom_btn" value="Upload">
                </form>
            </div>
        </div>
    </div>
    <!-- End of Profile Upload toast -->
</body>
</html>