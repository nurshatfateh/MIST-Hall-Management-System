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







<?php


   
    
    if(isset($_POST['submit_btn']))
    {
    	$HALL_DATE = $_POST['HALL_DATE'];
    	$MESS_DATE= $_POST['MESS_DATE'];
    	$HALL_BILL = $_POST['HALL_BILL'];
    	$MESS_BILL = $_POST['MESS_BILL'];
    	$STUDENTID= $_POST['STUDENTID'];
    	
    	
    
    
        $q="INSERT INTO BILL
        VALUES
        (
        '$HALL_DATE',
        '$MESS_DATE',
        '$HALL_BILL',
        '$MESS_BILL', 
        '$STUDENTID'
       

        )";

    	$query = oci_parse($conn, $q);
        if (!$query) {
            $m = oci_error($conn);
            trigger_error('Could not parse statement: ' . $m['message'], E_USER_ERROR);
        }

     
    	$result = oci_execute($query);
 
    	if ($result) {
            
            header("Location: adminhome.php? id= $code ");
           
    	// 	// exit();
            oci_close($conn);
    	}
    	else {
    		echo "Error !";
            $m = oci_error($query);
            trigger_error('Could not execute statement: ' . $m['message'], E_USER_ERROR);
    		// exit();
    	}
    }
?>






<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Student Registration Form</title>

<!-- BOOTSTRAP CSS -->
<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

<!-- favicon link css  -->
<link rel="shortcut icon" type="image/png" href="img/MIST.png" />

<!-- Script --> 

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> 
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script> 
<script src="js/function.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script> 


<!-- Font -->
<link href="http://fonts.cdnfonts.com/css/berlin-sans-fb-demi" rel="stylesheet">
</head>
<body >

<!-- navbar starts -->
<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler mb-2 mt-1" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="adminhome.php? id= <?php echo $code;?>" class="navbar-brand d-flex align-items-center border-end px-lg-4 pe-2">
                <h2 class="m-0 text-dark">Osmany Hall</h2>
            </a>
        </div>
    </nav>
	
<div class="bg-light" >
  <div class="container" style="padding: 10px 10px 0px 0px;">
    <h2 style="text-align: center"><b>Enter Hall Charge & Mess Bill</b></h2>
  </div>
  <div class="container mt-5">
    <form class="row g-3 bg-white border p-3 border-1" style="border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" action="adminbill.php? id= <?php echo $code;?>" method="post">
      
      <!-- <form class="row g-3 bg-white border p-3" method="post" enctype="multipart/form-data"> -->
      <div class="col-md-12">
        <label for="StudentRoll" class="form-label">
        <h6>STUDENT ID</h6>
        </label>
        <input type="text" name="STUDENTID" required class="form-control" id="StudentRoll" />
      </div>
      
 
      <div class="col-md-12">
        <label for="BATCH" class="form-label">
        <h6>Hall Charge Date</h6>
        </label>
        <input type="text" name="HALL_DATE" placeholder="DD/MM/YY" required class="form-control" id="Batch" />
      </div>
      <br>
      <div class="col-md-12">
        <label for="BATCH" class="form-label">
        <h6>Hall Charge Amount</h6>
        </label>
        <input type="text" name="HALL_BILL"  class="form-control" id="Batch" />
      </div>
      <br>
    
     
      <div class="col-md-12">
        <label for="BATCH" class="form-label">
        <h6>Mess Bill Date</h6>
        </label>
        <input type="text" name="MESS_DATE" placeholder="DD/MM/YY" required class="form-control" id="Batch" />
      </div>  <br>
      <div class="col-md-12">
        <label for="BATCH" class="form-label">
        <h6>Mess Bill Amount</h6>
        </label>
        <input type="text" name="MESS_BILL" required class="form-control" id="Batch" />
      </div>
      <br>
 
      <div class="col-md-12 text-center">
        <button type="submit" name="submit_btn" class="btn btn-success" onclick="  alert('DONE!') " >Submit</button>
       

      </div>
    </form>
  </div>


<!-- footer -->

<div class="container-fluid bg-black py-2 mt-5">
  <div class="row">
    <div class="col-md-4 pt-3">
      <p class="text-white-50 text-center"> © 2022 MIST. All rights reserved </p>
      <p></p>
    </div>
    <div class="col-md-4 pt-3">
      <p class="text-white-50 text-center"> <i class="bi bi-telephone"></i>+880 176 902 3806 </p>
    </div>
    <div class="col-md-4 pt-3">
      <p class="text-white-50 text-center"> <i class="bi bi-envelope"></i> info@mist.ac.bd </p>
    </div>
  </div>
</div>
</div>
<!-- BOOTSTRAP JS --> 

<script src="js/login.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script> 
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script> 
<script>
    $('#password, #confirmpassword').on('keyup', function(){

        $('.confirm-message').removeClass('success-message').removeClass('error-message');

        let password=$('#password').val();
        let confirm_password=$('#confirmpassword').val();

        if(password===""){
            $('.confirm-message').text("Password Field cannot be empty").addClass('error-message');
        }
        else if(confirm_password===""){
            $('.confirm-message').text("Confirm Password Field cannot be empty").addClass('error-message');
        }
        else if(confirm_password===password)
        {
            $('.confirm-message').text('Password Match!').addClass('success-message');
        }
        else{
            $('.confirm-message').text("Password Doesn't Match!").addClass('error-message');
        }

    });
</script>
</body>
	
	<style>
	input:not(:valid) {
     color: #FF0000;
  }	
	</style>
	
</html>

<?php 
}else{

header("Location: logout.php");

exit();

}

?>