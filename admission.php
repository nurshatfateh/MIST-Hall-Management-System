


<?php

$conn = oci_connect('TANVIN', 'tanvin420', '//localhost/XE');
    if (!$conn) echo 'Failed to connect to oracle' . "<br>";
   
    
    if(isset($_POST['submit_btn']))
    {
    	$STUDENTID = $_POST['STUDENTID'];
    	$NAME= $_POST['NAME'];
    	$BIRTHDATE = $_POST['BIRTHDATE'];
    	$BATCH = $_POST['BATCH'];
    	$DEPT = $_POST['DEPT'];
    	$SESSIONYEAR = $_POST['SESSIONYEAR'];
   
    
    	$BIRTHCERT = $_POST['BIRTHCERT'];
    	$EMAIL = $_POST['EMAIL'];
    	$PHONE = $_POST['PHONE'];
    	$GUARDIANNAME= $_POST['GUARDIANNAME'];
    	$GUARDIANADDRESS = $_POST['GUARDIANADDRESS'];
    	$GUARDIANPHONE = $_POST['GUARDIANPHONE'];
    	$YEAR = $_POST['YEAR'];
    	$PASSWORD = $_POST['PASSWORD'];
    	$RELIGION = $_POST['RELIGION'];
    	$SPECIALREQ= $_POST['SPECIALREQ'];
    	$PERMANENTADDRESS = $_POST['PERMANENTADDRESS'];
    	$NATIONALITY = $_POST['NATIONALITY'];
    	
    
    
        $q="INSERT INTO ADMISSION_APPLICANTS
        VALUES
        (
        '$STUDENTID',
        '$NAME',
        '$BIRTHDATE',
        '$BATCH', 
        '$DEPT',
        '$SESSIONYEAR',
        '$BIRTHCERT',
        '$EMAIL',
        '$PHONE',
        '$GUARDIANNAME',
        '$GUARDIANADDRESS',
        '$GUARDIANPHONE',
        '$YEAR',
        seatnoi.nextval,
        hallidi.nextval,
        '$PASSWORD',
        '$RELIGION',
        '$SPECIALREQ',
        roomnoi.nextval,
        '$PERMANENTADDRESS',
        '$NATIONALITY'

        )";

    	$query = oci_parse($conn, $q);
        if (!$query) {
            $m = oci_error($conn);
            trigger_error('Could not parse statement: ' . $m['message'], E_USER_ERROR);
        }

     
    	$result = oci_execute($query);
 
    	if ($result) {
            
            header('Location: index.php');
           
    	// 	// exit();
            oci_close($conn);
    	}
    	else {
    		echo "Error !";
            $m = oci_error($query);
            trigger_error('Could not execute statement: ' . $m['message'], E_USER_ERROR);
    		// exit();
    	}


      { 
        $query1 = "INSERT INTO MEAL (MEALID,BREAKFASTFEE,LUNCHFEE,DINNERFEE,STUDENTID) Values (MEAL_ID.nextval,'0','0','0','$STUDENTID')";
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
            <a href="index.php" class="navbar-brand d-flex align-items-center border-end px-lg-4 pe-2">
                <h2 class="m-0 text-dark">Osmany Hall</h2>
            </a>
        </div>
    </nav>
	
<div class="bg-light" >
  <div class="container" style="padding: 10px 10px 0px 0px;">
    <h2 style="text-align: center"><b>Student Registration Form:</b></h2>
  </div>
  <div class="container mt-5">
    <form class="row g-3 bg-white border p-3 border-1" style="border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" action="admission.php" method="post">
      
      <!-- <form class="row g-3 bg-white border p-3" method="post" enctype="multipart/form-data"> -->
      <div class="col-md-6">
        <label for="StudentRoll" class="form-label">
        <h6>STUDENT ID<font color="ff0000">*</font></h6>
        </label>
        <input type="text" name="STUDENTID" required class="form-control" id="StudentRoll" />
      </div>
      <div class="col-md-6">
        <label for="StudentName" class="form-label">
        <h6>Name<font color="ff0000">*</font></h6>
        </label>
        <input type="text" name="NAME" required class="form-control" id="StudentName" />
      </div>
         
      <div class="col-md-6">
        <label for="BATCH" class="form-label">
        <h6>BIRTH DATE</h6>
        </label>
        <input type="text" name="BIRTHDATE" placeholder="DD-MM-YYYY" class="form-control" id="Batch" />
      </div>

    
     
      <div class="col-md-6">
        <label for="BATCH" class="form-label">
        <h6>Batch</h6>
        </label>
        <input type="text" name="BATCH"  class="form-control" id="Batch" />
      </div>
   
      <div class="col-md-6">
        <label for="Department" class="form-label">
        <h6>DEPARTMENT</h6>
        </label>
        <br />
        <select class="form-control selectpicker"  name="DEPT" >
          <option selected disabled>Department</option>
          <option value="CE">Department of Civil Engineering (CE)</option>
          <option value="EWCE">Department of Environmental, Water Resources and Coastal Engineering (EWCE)</option>
          <option value="ARCH">Department of Architecture</option>
          <option value="PME">Department of Petroleum &amp; Mining Engineering (PME)</option>
          <option value="CSE">Department of Computer Science &amp; Engineering (CSE)</option>
          <option value="EECE">Department of Electrical, Electronic and Communication Engineering (EECE)</option>
          <option value="ME">Department of Mechanical Engineering (ME)</option>
          <option value="AE">Department of Aeronautical Engineering (AE)</option>
          <option value="NAME">Department of Naval Architecture and Marine Engineering (NAME)</option>
          <option value="IPE">Department of Industrial and Production Engineering (IPE)</option>
          <option value="NSE">Department of Nuclear Science &amp; Engineering (NSE)</option>
          <option value="BME">Department of Biomedical Engineering (BME)</option>
          <option value="SH">Department of Science &amp; Humanities (SH)</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="SESSION YEAR" class="form-label">
        <h6>SESSION YEAR</h6>
        </label>
        <input type="text" name="SESSIONYEAR"   class="form-control" id="FatherName" />
      </div>
      <div class="col-md-6">
        <label for="SESSION YEAR" class="form-label">
        <h6>BIRTH CERTIFICATE</h6>
        </label>
        <input type="text" name="BIRTHCERT"   class="form-control" id="FatherName" />
      </div>
      <div class="form-floating mt-3 mb-2">
            <input type="email" name="EMAIL"  placeholder="Email"   class="form-control input-lg"/>
            <label for="email">
            <h6>EMAIL</h6>
            </label>
          </div>
          
      <div class="col-md-6">
        <label for="Phone Number" class="form-label">
        <h6>PHONE</h6>
        </label>
        <input type="text" name="PHONE"  class="form-control" id="PhoneNumber" />
      </div>
  
     

   
   
      <div class="col-md-6">
        <label for="SESSION YEAR" class="form-label">
        <h6>GUARDIAN NAME</h6>
        </label>
        <input type="text" name="GUARDIANNAME"   class="form-control" id="FatherName" />
      </div>

     
      <div class="col-md-12">
        <label for="Present Address" class="form-label"
              >
        <h6>GUARDIAN ADDRESS</h6>
        </label>
        <textarea
              class="form-control"
              id="PresentAddress"
              rows="3"
              name="GUARDIANADDRESS"
            ></textarea>
      </div>
      <div class="col-md-6">
        <label for="Phone Number" class="form-label">
        <h6>GUARDIAN PHONE</h6>
        </label>
        <input type="text" name="GUARDIANPHONE"  class="form-control" id="PhoneNumber" />
      </div>
      <div class="col-md-6">
        <label for="BATCH" class="form-label">
        <h6>LEVEL</h6>
        </label>
        <input type="text" name="YEAR"  class="form-control" id="Batch" />
      </div>
      <div class="col-md-6">
        <label for="BATCH" class="form-label">
        <h6>RELIGION</h6>
        </label>
        <input type="text" name="RELIGION"  class="form-control" id="Batch" />
      </div>

      <div class="col-md-6">
        <label for="BATCH" class="form-label">
        <h6>SPECIAL REQUIRMENTS</h6>
        </label>
        <input type="text" name="SPECIALREQ"  class="form-control" id="Batch" />
      </div>




      <div class="col-md-6">
        <label for="BATCH" class="form-label">
        <h6>NATIONALITY</h6>
        </label>
        <input type="text" name="NATIONALITY"  class="form-control" id="Batch" />
      </div>




      <div class="col-md-12">
        <label for="Permanent Address" class="form-label"
              >
        <h6>PERMANENT ADDRESS</h6>
        </label>
        
        <textarea
              class="form-control"
              id="PermanentAddress"
              rows="3"
              name="PERMANENTADDRESS"
            ></textarea>
      </div>

      <div class="col-md-12" id="pwd-container">
        <section class="login-form">
         
          <div class="form-floating mt-3 mb-2">
            <input type="password" name="PASSWORD" required class="form-control input-lg" id="PASSWORD" placeholder="Password"  />
            <label for="password">
            <h6>PASSWORD<font color="ff0000">*</font></h6>
            </label>
          </div>
          <div class="pwstrength_viewport_progress"></div>
        </section>
      </div>


 
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
