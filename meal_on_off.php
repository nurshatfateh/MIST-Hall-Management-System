<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {


    
    $conn = oci_connect('TANVIN', 'tanvin420', '//localhost/XE');
    if (!$conn) {
        echo 'Failed to connect to oracle' . "<br>";
    } else {
    }

   $code=$_GET["id"]; 


   $dateTomorrow = date('d/m/y', strtotime('+1 days'));
   $tomorrow=$dateTomorrow;
   //echo $tomorrow;



   $query = "SELECT BREAKFASTSTATUS,LUNCHSTATUS,DINNERSTATUS,MEALDATE from MEAL where studentid=$code and mealid=(SELECT MAX(mealid)
   FROM meal WHERE studentid =$code)";

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




   if(isset($_POST['meal_place']))
    { 
   $query1 = "INSERT INTO MEAL (MEALID,BREAKFASTFEE,LUNCHFEE,DINNERFEE,STUDENTID) Values (MEAL_ID.nextval,'0','0','0',$code)";
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

   header("Location: meal_on_off.php? id= $code ");
   }


    if(isset($_POST['submit_btn']))
    {   
        $BREAKFASTSTATUS = $_POST['BREAKFASTSTATUS'];
    	$LUNCHSTATUS = $_POST['LUNCHSTATUS'];
    	$DINNERSTATUS = $_POST['DINNERSTATUS'];


        $q3=" UPDATE meal
        SET BREAKFASTSTATUS = '$BREAKFASTSTATUS' , LUNCHSTATUS = '$LUNCHSTATUS', DINNERSTATUS = '$DINNERSTATUS'
        WHERE studentid = $code and mealid = (SELECT MAX(mealid)
        FROM meal
        WHERE studentid = $code) ";

        $query3 = oci_parse($conn, $q3);
        if (!$query3) {
            $m3 = oci_error($conn);
            trigger_error('Could not parse statement: ' . $m3['message'], E_USER_ERROR);
        }

     
    	$result3 = oci_execute($query3);
 
    	if ($result3) {
            
            
           
    	// 	// exit();
            oci_close($conn);
    	}
    	else {
    		echo "Error !";
            $m3 = oci_error($query3);
            trigger_error('Could not execute statement: ' . $m3['message'], E_USER_ERROR);
    		// exit();
    	}

        header("Location: meal_on_off.php? id= $code ");
    }


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

    <title>Meal On/Off</title>
    <link rel="icon" type="image/x-icon" href="/img/icon.jpg" />

    <!--Scripts-->
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

    <div class="hero-image hom" data-aos="zoom-in">
        <div class="hero-text">
            <h1>Meal Syetem</h1>
            <h3>Meal On/Off</h3>
        </div>
    </div>

    <!-- body -->

    <div class="container-fluid my-lg-4">
        <h1 class="text-center mt-5 mb-5">Meal On/Off</h1>
        <br><br>
        <!-- <h2>Place order for tomorrow</h2>
        <form  action="meal_on_off.php? id= <?php echo $code;?>" method="post">
        <button type="submit" class="btn btn-primary" name="meal_place" onclick="  window.location.reload(); ">Place Order</button>
        </form> -->
        <br><br>
        <h2>Status for  (<?php echo $row["MEALDATE"]; ?> )</h2> 
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Breakfast</th>
                <th scope="col">Lunch</th>
                <th scope="col">Dinner</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $row["BREAKFASTSTATUS"]; ?></td>
                <td><?php echo $row["LUNCHSTATUS"]; ?></td>
                <td><?php echo $row["DINNERSTATUS"]; ?></td>
              </tr>
            </tbody>
          </table>




        <br><br>
        <h2>Update status for tomorrow</h2>
        <form  action="meal_on_off.php? id= <?php echo $code;?>" method="post">
            <h3>Breakfast</h3>
            <select class="form-control selectpicker" name="BREAKFASTSTATUS">
                <option selected disabled>Select</option>
                <option value="YES">Yes</option>
                <option value="NO">No</option>
              </select>
            <h3>Lunch</h3>
            <select class="form-control selectpicker" name="LUNCHSTATUS">
                <option selected disabled>Select</option>
                <option value="YES">Yes</option>
                <option value="NO">No</option>
              </select>
            <h3>Dinner</h3>
            <select class="form-control selectpicker" name="DINNERSTATUS">
                <option selected disabled>Select</option>
                <option value="YES">Yes</option>
                <option value="NO">No</option>
              </select>
            <div class="col-md-12 text-center my-3">
                <button type="submit" name="submit_btn" class="btn btn-success" onclick="  alert('DONE!');">Save</button>
            </div>
        </form>
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