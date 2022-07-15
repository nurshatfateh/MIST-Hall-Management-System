<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- added -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="style.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <title>Osmany Hall</title>
    <link rel="icon" type="image/x-icon" href="/img/icon.jpg" />
</head>

<body>
    <!-- nav-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler mb-2 mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="home.html" class="navbar-brand d-flex align-items-center border-end px-lg-4 pe-2">
                <h2 class="m-0 text-dark">Osmany Hall</h2>
            </a>

            <div class="collapse navbar-collapse mx-5 fw-bold" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="home.html" class="nav-item nav-link active mx-lg-4 text-dark">Home</a>
                    <a href="bill.html" class="nav-item nav-link mx-lg-4 text-dark">Bill</a>

                    <a href="meal_on_off.html" class="nav-item nav-link mx-lg-4 text-dark">Meal On/Off</a>
                    <a href="day-to-day.html" class="nav-item nav-link mx-lg-4 text-dark">Daily Meal bill</a>
                    <a href="menu.php" class="nav-item nav-link mx-lg-4 text-dark">Menu</a>
                </div>

                <a href="index.php"><button type="button" class="btn btn-danger mx-3">
                        Log Out
                    </button></a>
            </div>
        </div>
    </nav>

    <!-- Banner -->

    <div class="hero-image" data-aos="zoom-in" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/admindesk.png'); height: 100%;">
        <div class="hero-text">
            <h1>Osmany Hall Management System</h1>
            <h3>Student Information</h3>
        </div>
    </div>
    

    <?php
    $conn = oci_connect('TANVIN', 'tanvin420', '//localhost/XE');
    // Check connection
    if (!$conn) {
        echo 'Failed to connect to oracle' . "<br>";
    } else {
        //echo 'Connected successfully!' ."<br>";
    }

    //query to fetch data
    $query = 'SELECT * FROM ADMISSION_APPLICANTS';
    $stid = oci_parse($conn, $query);

    if (!$stid) {
        $m = oci_error($conn);
        trigger_error('Could not parse statement: ' . $m['message'], E_USER_ERROR);
    }
    //print "oci_parse executed";
    //echo '<br>';

    $r = oci_execute($stid);
    if (!$r) {
        $m = oci_error($stid);
        trigger_error('Could not execute statement: ' . $m['message'], E_USER_ERROR);
    }
    //print "oci executed". "\n";
    //echo '<br>';

    //retrieving data as a tuple 
    //while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {


    //}

    //oci_close($conn);
    $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC);
    ?>
    
    <!-- body -->

    <div class="container">


        <table class="table ">


            <h1 class=" mt-5 mb-5" style="text-align:left; "><u>My Profile</u></h1>
        


            <tbody style="font-size: large;">

                <tr>
                    <th scope="row">Student ID</th>
                    <td><?php echo $row["STUDENTID"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Name</th>
                    <td><?php echo $row["NAME"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">NID</th>
                    <td><?php echo $row["NID"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Batch</th>
                    <td><?php echo $row["BATCH"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Department</th>
                    <td><?php echo $row["DEPT"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Session</th>
                    <td><?php echo $row["SESSIONYEAR"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Birth Certificate Number</th>
                    <td><?php echo $row["BIRTHCERT"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Email</th>
                    <td><?php echo $row["EMAIL"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Phone Number</th>
                    <td><?php echo $row["PHONE"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Passport</th>
                    <td><?php echo $row["PASSPORT"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Guardian Name</th>
                    <td><?php echo $row["GUARDIANNAME"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Guardian Phone</th>
                    <td><?php echo $row["GUARDIANPHONE"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Guardian Address</th>
                    <td><?php echo $row["GUARDIANADDRESS"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Level</th>
                    <td><?php echo $row["YEAR"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Seat Number</th>
                    <td><?php echo $row["SEATNO"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Hall ID</th>
                    <td><?php echo $row["HALLID"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Status</th>
                    <td style="color: green;"><?php echo $row["STATUS"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Religion</th>
                    <td><?php echo $row["RELIGION"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Special Requirement</th>
                    <td><?php echo $row["SPECIALREQ"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">Room Number</th>
                    <td><?php echo $row["ROOMNO"]; ?></td>
                </tr>
                <tr>
                    <th scope="row">Permanent Address</th>
                    <td><?php echo $row["PERMANENTADDRESS"]; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- footer -->
    <div class="container-fluid bg-dark py-2">
        <div class="row">
            <div class="col-md-4 col-12 pt-3">
                <p class="text-white-50 text-center">
                    © 2022 MIST Osmany Hall. All rights reserved
                </p>
                <p></p>
            </div>

            <div class="col-md-4 col-12 pt-3">
                <p class="text-white-50 text-center">
                    <i class="bi bi-link-45deg"></i><a href="https://mist.ac.bd/" style="text-decoration: none" class="text-white-50 text-center ps-1">VISIT MIST Website</a>
                </p>
            </div>
            <div class="col-md-4 col-12 pt-3">
                <p class="text-white-50 text-center">
                    <i class="bi bi-envelope"></i> osmanyhall@gmail.com
                </p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>