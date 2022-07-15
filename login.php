<html>
<body>
 <?php session_start();?>
 <?php
   $con = oci_connect('TANVIN', 'tanvin420', '//localhost/XE');
if (!$con) {
$m = oci_error();
echo $m['message'], "\n";
//error fuction returns an oracle message.
exit; }

if (isset($_POST['user']) && isset($_POST['pwd'])) {


$query = "SELECT STUDENTID FROM ADMISSION_APPLICANTS WHERE STUDENTID =
 :user_bv and PASSWORD=:pwd"; 
//query is sent to the db to fetch row id.
 $stid = oci_parse($con, $query);
/*oci_parse fuction prepares the db to execute the statement.
requires two parameters resource($con)and sql string.*/
if (isset($_POST['user'])
 ||isset($_POST['pwd'])){           
$user = $_POST['user'];
$pass=$_POST['pwd'];
}
oci_bind_by_name($stid, ':user_bv', $user);

oci_bind_by_name($stid, ':pwd', $pass);
/*oci_bind_by_name function tells php which variable to use.
They are references of the original variables.*/
oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC);
//oci_fetch_array returns a row from the db.

 if ($row) {
  $_SESSION['user_name'] = $row['STUDENTID'];

  $_SESSION['name'] = $row['NAME'];

  $_SESSION['id'] = $row['STUDENTID'];
 echo"log in successful";
  }
 else {
  header("Location: index.php?error=Incorect User name or password");

  exit();

}
$ID = $row['STUDENTID']; 
oci_free_statement($stid);
oci_close($con);
header("Location: home.php? id= $ID ");
//header function locates you to a welcome page saved s wel.php
}else{

  header("Location: index.php");

  exit();

}
 ?>
 </body>
 </html>