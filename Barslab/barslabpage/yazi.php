<?php

include '../barslabdata/barslabdb.php';


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}


$id = intval($_GET['id']);


$query = "SELECT * FROM yazilar WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$yazi = mysqli_fetch_assoc($result);


if (!$yazi) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($yazi['baslik']); ?> - BarsLab Blog</title>
    <style>
       
body { 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    background-color: #f9f9f9; 
    margin: 0; 
    padding: 0; 
    color: #333;
}


.navbar {
    display: flex;
    justify-content: space-between; 
    align-items: center; 
    background-color: #000000; 
    padding: 15px 50px; 
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    position: sticky; 
    top: 0;
    z-index: 1000;
   
}


.nav-logo {
    background-color: #ffffff;
    padding: 8px 25px; 
    border-radius: 40px; 
    display: inline-flex;
    align-items: center;
    transition: transform 0.3s ease; 
}

.nav-logo:hover {
    transform: translateY(-3px); 
}

.nav-logo a {
    display: flex;
    align-items: center;
    text-decoration: none;
}

.nav-logo img {
    max-height: 50px; 
    object-fit: contain; 
}


.nav-links {
    display: flex;
    gap: 25px; 
}

.nav-links a {
    background-color: #ffffff; 
    color: #2c3e50; 
    padding: 12px 35px; 
    border-radius: 40px; 
    text-decoration: none; 
    font-size: 1.1em; 
    font-weight: bold; 
    transition: all 0.3s ease; 
    display: inline-flex;
    align-items: center;
}

.nav-links a:hover {
    color: #e74c3c;
    transform: translateY(-3px); 
  
    box-shadow: 0 4px 12px rgba(255,255,255,0.15); 
}


.container { 
    max-width: 800px; 
    margin: 40px auto; 
    padding: 0 20px;
}

.blog-post { 
    background: #ffffff; 
    padding: 30px; 
    margin-bottom: 30px; 
    border-radius: 10px; 
    box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
}

.blog-title { 
    margin-top: 0; 
    color: #2c3e50; 
    font-size: 24px;
}

.blog-date { 
    color: #95a5a6; 
    font-size: 0.9em; 
    margin-bottom: 20px; 
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.blog-content { 
    line-height: 1.8; 
    color: #444; 
    font-size: 16px;
}
  
.back-btn { 
    display: inline-flex; 
    align-items: center;
    margin-top: 30px; 
    padding: 12px 25px;
    background-color: #2c3e50; 
    color: #ffffff; 
    text-decoration: none; 
    font-weight: bold; 
    border-radius: 30px; 
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.back-btn:hover { 
    background-color: #e74c3c; 
    color: #ffffff;
    transform: translateY(-3px); 
    box-shadow: 0 6px 15px rgba(231, 76, 60, 0.4);
}
    </style>
</head>
<body>

<div class="navbar">
    <div class="nav-logo">
        <a href="barslablogin.php">
            <img src="../images/logo3.png" alt="BarsLab Logo">
        </a>
    </div>
    <div class="nav-links">
        <a href="index.php">Ana Sayfa</a>
    </div>
</div>

<div class="container">
    <div class="full-post">
        <h1 class="full-title"><?php echo htmlspecialchars($yazi['baslik']); ?></h1>
        <div class="full-date">Yayınlanma: <?php echo date('d.m.Y H:i', strtotime($yazi['olusturulma_tarihi'])); ?></div>
        
        <div class="full-content">
            <?php echo nl2br(htmlspecialchars($yazi['icerik'])); ?>
        </div>
        
        <a href="index.php" class="back-btn">⬅️ Ana Sayfaya Dön</a>
    </div>
</div>

</body>
</html>