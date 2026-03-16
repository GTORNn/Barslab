<?php
session_start(); 
include '../barslabdata/barslabdb.php'; 


if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header('Location: barslablogin.php');
    exit();
}

$admin_id = $_SESSION['admin_id'];


if (isset($_POST['add']) && !empty($_POST['baslik']) && !empty($_POST['icerik'])) {
    
   
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];


    $query = "INSERT INTO yazilar (admin_id, baslik, icerik) VALUES (?, ?, ?)";
    
  
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
      
        mysqli_stmt_bind_param($stmt, "iss", $admin_id, $baslik, $icerik);
        
      
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt); 

        header('Location: barslabdashboard.php');
        exit();
    } else {
        
        die("Veritabanı hatası: " . mysqli_error($conn));
    }

} else {
    
    header('Location: barslabdashboard.php');
    exit();
}
?>