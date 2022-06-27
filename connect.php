<?php
    $conn = oci_connect('TANVIN', 'tanvin420', '//localhost/XE');
    // Check connection
    if (!$conn) {
        echo 'Failed to connect to oracle' . "<br>";
    }
    else {
        echo 'Connected successfully!' ."<br>";
    }
    
    
    //oci_close($conn);
    ?>