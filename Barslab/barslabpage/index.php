<?php
include '../barslabdata/barslabdb.php';


$query = "SELECT * FROM yazilar ORDER BY olusturulma_tarihi DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BarsLab Blog</title>
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
.read-more-btn {
    display: inline-block;
    margin-top: 15px;
    padding: 8px 20px;
    background-color: #2c3e50;
    color: #ffffff;
    text-decoration: none;
    border-radius: 20px;
    font-size: 0.9em;
    font-weight: bold;
    transition: background-color 0.3s ease;
}
.read-more-btn:hover {
    background-color: #e74c3c;
}
    </style>
</head>
<body>

<div class="navbar">
    <div class="nav-logo">
        <a href="barslablogin.php">
            <img src="../images/logo3.png" alt="BarsLab Logo"
            >
        </a>
    </div>
    <div class="nav-links">
        <a href="index.php">Ana Sayfa</a>
        
    </div>
</div>



<div class="container">
   <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="blog-post">';
            echo '<h2 class="blog-title">' . htmlspecialchars($row['baslik']) . '</h2>';
            echo '<div class="blog-date"> Yayınlanma: ' . date('d.m.Y H:i', strtotime($row['olusturulma_tarihi'])) . '</div>';
            
            
            $tam_icerik = $row['icerik'];
            if (mb_strlen($tam_icerik) > 200) {
                $ozet = mb_substr($tam_icerik, 0, 200) . '...';
            } else {
                $ozet = $tam_icerik; 
            }
            
            echo '<div class="blog-content">' . htmlspecialchars($ozet) . '</div>';
            
           
            echo '<a href="yazi.php?id=' . $row['id'] . '" class="read-more-btn">Devamını Oku ➡️</a>';
            
            echo '</div>';
        }
    } else {
        echo '<div class="blog-post" style="text-align:center;">Henüz hiç yazı yayınlanmadı. Daha sonra tekrar uğrayın!</div>';
    }
    ?>
</div>

</body>
</html>