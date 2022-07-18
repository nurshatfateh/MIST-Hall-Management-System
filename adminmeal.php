<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {


    
    $conn = oci_connect('TANVIN', 'tanvin420', '//localhost/XE');
    if (!$conn) {
        echo 'Failed to connect to oracle' . "<br>";
    } else {
    }
    $code=$_GET["id"]; 
    $query = "SELECT * FROM ADMINN where STUDENTID=$code";
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

?>



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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <title>Meal Status Check</title>
    <link rel="icon" type="image/x-icon" href="/img/icon.jpg" />

    <!--Scripts-->
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler mb-2 mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="adminhome.php? id= <?php echo $code;?>" class="navbar-brand d-flex align-items-center border-end px-lg-4 pe-2">
                <h2 class="m-0 text-dark">Osmany Hall</h2>
            </a>
           
            <div class="collapse navbar-collapse mx-5 fw-bold" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="adminhome.php? id= <?php echo $code;?>" class="nav-item nav-link active mx-lg-4 text-dark">Home</a>
                <a href="adminmeal.php? id= <?php echo $code;?>" class="nav-item nav-link mx-lg-4 text-dark">Meal Status</a>
                <a href="adminbill.php? id= <?php echo $code;?>" class="nav-item nav-link mx-lg-4 text-dark">Input Bill</a>
               
                </div>

                <a href="logout.php"
            ><button type="button" class="btn btn-danger mx-3">
                        Log Out
                    </button></a>
            </div>
        </div>
    </nav>

<div class="hero-image hom" data-aos="zoom-in">
        <div class="hero-text">
            <h1>Student Meal System</h1>
        </div>
 </div>
 <div class="mb-5">  </div>
    <!-- nav-->


    <?php
    $query1 = "SELECT MEALCOUNTDATE,BREAKFAST,LUNCH,DINNER from MEALCOUNT  where ID=(SELECT MAX(id)
    FROM MEALCOUNT)";
 
    $stid1 = oci_parse($conn, $query1);
 
    if (!$stid1) {
        $m1 = oci_error($conn);
        trigger_error('Could not parse statement: ' . $m1['message'], E_USER_ERROR);
    }
    $r1 = oci_execute($stid1);
    if (!$r1) {
        $m1 = oci_error($stid1);
        trigger_error('Could not execute statement: ' . $m1['message'], E_USER_ERROR);
    }
    $row1 = oci_fetch_array($stid1, OCI_RETURN_NULLS + OCI_ASSOC);
    
    ?>

   <h5>Total number Student to have Breakfast on <?php echo $row1["MEALCOUNTDATE"]; ?> is = <?php echo $row1["BREAKFAST"]; ?></h5>
   <h5>Total number Student to have Lunch on <?php echo $row1["MEALCOUNTDATE"]; ?> is  = <?php echo $row1["LUNCH"]; ?></h5>
   <h5>Total number Student to have Dinner on <?php echo $row1["MEALCOUNTDATE"]; ?> is = <?php echo $row1["DINNER"]; ?></h5>
   <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
        
        <?php
         $conn = oci_connect('TANVIN', 'tanvin420', '//localhost/XE');
         if (!$conn) {
             echo 'Failed to connect to oracle' . "<br>";
         } else {
         }
     

        //query to fetch data
        $query = "SELECT STUDENTID,NAME,ROOMNO,MEALDATE, BREAKFASTSTATUS,LUNCHSTATUS,DINNERSTATUS from MEAL  Natural join ADMISSION_APPLICANTS  where  mealid in (SELECT MAX(mealid)
        FROM meal group by studentid)  order by Studentid  ";
        $stid = oci_parse($conn, $query);

        if (!$stid) {
            $m = oci_error($conn);
            trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
        }

        echo '<br>';
        
        $r = oci_execute($stid);
        if (!$r) {
            $m = oci_error($stid);
            trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
        }

        //retrieving data as a tuple 
        print '<table class="table">';
        print '  <thead>
        <tr>
          <th scope="col">Student id</th>
          <th scope="col">Name</th>
          <th scope="col">Room no</th>
          <th scope="col">Meal date</th>
          <th scope="col">Breakfast status</th>
          <th scope="col">Lunch status</th>
          <th scope="col">Dinner status</th>
        </tr>
        </thead>
        <tbody>';
        while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
            print '<tr>';
            foreach ($row as $item) {
                print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
            }
            print '</tr>';
        }

        print ' </tbody>
        </table>';
        oci_close($conn);

        ?>
            
        </div>
    </nav>

    <!-- Banner -->

    

    <!-- body -->
    <div class="mb-5">  </div>
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
                    <i class="bi bi-link-45deg"></i><a href="https://mist.ac.bd/" style="text-decoration: none"
                        class="text-white-50 text-center ps-1">VISIT MIST Website</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
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