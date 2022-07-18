<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {


    
    $conn = oci_connect('TANVIN', 'tanvin420', '//localhost/XE');
    if (!$conn) {
        echo 'Failed to connect to oracle' . "<br>";
    } else {
    }
$code=$_GET["id"]; 
    $query = "SELECT * FROM ADMISSION_APPLICANTS where STUDENTID=$code";
    $stid = oci_parse($conn, $query);

    if (!$stid) {
        $m = oci_error($conn);
        trigger_error('Could not parse statement: ' . $m['message'], E_USER_ERROR);
    }
    $r = oci_execute($stid);
    if (!$r) {
        $m = oci_error($stid);
        trigger_error('Could not execute statement: ' . $m['message'], E_USER_ERROR);
    }
    $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC);
    








// if (mysqli_num_rows($result) === 1){
// $me = mysqli_fetch_array($result);
// $joined=$me["session"];
// $pos="Student";
// }

// else if (mysqli_num_rows($result2) === 1){
  
//   $me = mysqli_fetch_array($result2);
//   $joined=$me["joindate"];
//   $pos=$me["position"];
  
// }
// else if (mysqli_num_rows($result3) === 1){
  
//   $me = mysqli_fetch_array($result3);
//   $joined=$me["joindate"];
//   $pos=$me["position"];
  
// }
//  ?>








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
            <a href="home.php? id= <?php echo $code;?>" class="navbar-brand d-flex align-items-center border-end px-lg-4 pe-2">
                <h2 class="m-0 text-dark">Osmany Hall</h2>
            </a>
           
            <div class="collapse navbar-collapse mx-5 fw-bold" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="home.php? id= <?php echo $code;?>" class="nav-item nav-link active mx-lg-4 text-dark">Home</a>
                <a href="mbill.php? id= <?php echo $code;?>" class="nav-item nav-link mx-lg-4 text-dark">Mess Bill</a>
                <a href="hbill.php? id= <?php echo $code;?>" class="nav-item nav-link mx-lg-4 text-dark">Hall Charge</a>
                <a href="meal_on_off.php? id= <?php echo $code;?>" class="nav-item nav-link mx-lg-4 text-dark">Meal On/Off</a>
                
                <a href="menu.php? id= <?php echo $code;?>" class="nav-item nav-link mx-lg-4 text-dark">Menu</a>
                </div>

                <a href="logout.php"
            ><button type="button" class="btn btn-danger mx-3">
                        Log Out
                    </button></a>
            </div>
        </div>
    </nav>

    <!-- Banner -->

    <div class="hero-image" data-aos="zoom-in" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/elec.png'); height: 100%;">
        <div class="hero-text">
            <h1>Osmany Hall Management System</h1>
            <h3>Student Information</h3>
        </div>
    </div>
    

    
   
    
    <!-- body -->

    <div class="container">


        <table class="table ">


            <h1 class=" mt-5 mb-5" style="text-align:left; "><u>My Profile</u></h1>
        


            <tbody style="font-size: large;">

                <tr>
                    <th scope="row">STUDENT ID</th>
                    <td><?php echo $row["STUDENTID"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">NAME</th>
                    <td><?php echo $row["NAME"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">BIRTH DATE</th>
                    <td><?php echo $row["BIRTHDATE"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">BATCH</th>
                    <td><?php echo $row["BATCH"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">DEPARTMENT</th>
                    <td><?php echo $row["DEPT"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">SESSION YEAR</th>
                    <td><?php echo $row["SESSIONYEAR"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">BIRTH CERTIFICATE</th>
                    <td><?php echo $row["BIRTHCERT"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">EMAIL</th>
                    <td><?php echo $row["EMAIL"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">PHONE</th>
                    <td><?php echo $row["PHONE"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">GUARDIAN NAME</th>
                    <td><?php echo $row["GUARDIANNAME"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">GUARDIAN ADDRESS</th>
                    <td><?php echo $row["GUARDIANADDRESS"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">GUARDIAN PHONE</th>
                    <td><?php echo $row["GUARDIANPHONE"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">LEVEL</th>
                    <td><?php echo $row["YEAR"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">SEAT NO</th>
                    <td><?php echo $row["SEATNO"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">HALL ID</th>
                    <td><?php echo $row["SEATNO"]; ?></td>
                </tr>

                <tr>
                    <th scope="row">RELIGION</th>
                    <td><?php echo $row["RELIGION"]; ?></td>
                </tr>
                <tr>
                    <th scope="row">SPECIAL REQUIRMENTS</th>
                    <td><?php echo $row["SPECIALREQ"]; ?></td>
                </tr>
                <tr>
                    <th scope="row">ROOM NUMBER</th>
                    <td><?php echo $row["ROOMNO"]; ?></td>
                </tr>
                <tr>
                    <th scope="row">PERMANENT ADDRESS</th>
                    <td><?php echo $row["PERMANENTADDRESS"]; ?></td>
                </tr>

                

                <tr>
                    <th scope="row">NATIONALITY</th>
                    <td><?php echo $row["NATIONALITY"]; ?></td>
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

<?php 
}else{

header("Location: logout.php");

exit();

}

?>