<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barslabdb";
$conn = "";
try{
$conn = mysqli_connect( 
    $servername,  
$username,  
$password,   
$dbname
  );
}catch(mysqli_sql_exception)
{
  echo "you are not connected";
}
if ($conn) {


}

?>