<?php
session_start();

include '../barslabdata/barslabdb.php';


if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header('Location: barslablogin.php');
    exit();
}


if (isset($_GET['id'])) {
    

    $id = intval($_GET['id']);

   
    $query = "DELETE FROM yazilar WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
      
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        die("Silme işlemi sırasında veritabanı hatası: " . mysqli_error($conn));
    }

    
    header("Location: barslabdashboard.php");
    exit();
} else {
   
    header("Location: barslabdashboard.php");
    exit();
}
?>