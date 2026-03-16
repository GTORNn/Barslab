<?php
session_start();
include '../barslabdata/barslabdb.php';


if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header('Location: barslablogin.php');
    exit();
}

$admin_id = $_SESSION['admin_id'];


if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $yeni_baslik = $_POST['baslik'];
    $yeni_icerik = $_POST['icerik'];

    
    $update_query = "UPDATE yazilar SET baslik = ?, icerik = ? WHERE id = ? AND admin_id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    
    
    mysqli_stmt_bind_param($stmt, "ssii", $yeni_baslik, $yeni_icerik, $id, $admin_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    
    header('Location: barslabdashboard.php');
    exit();
}


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    

    $select_query = "SELECT * FROM yazilar WHERE id = ? AND admin_id = ?";
    $stmt = mysqli_prepare($conn, $select_query);
    mysqli_stmt_bind_param($stmt, "ii", $id, $admin_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

   
    if (!$row) {
        header('Location: barslabdashboard.php');
        exit();
    }
} else {
    
    header('Location: barslabdashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yazıyı Düzenle</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
       
        .container { max-width: 800px; margin: 50px auto; padding: 20px; background: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; }
        .input-area form { display: flex; flex-direction: column; gap: 15px; }
        .input-area input { padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; }
        textarea.blog-icerik { padding: 12px; min-height: 200px; font-family: inherit; resize: vertical; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; line-height: 1.5; }
        .btn-update { background-color: #000000; color: white; padding: 12px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .btn-update:hover { background-color:  #000000; }
        .btn-cancel { text-align: center; display: inline-block; margin-top: 10px; color: #7f8c8d; text-decoration: none; }
        .btn-cancel:hover { text-decoration: underline; color: #e74c3c; }
        h2 { text-align: center; color: #2c3e50; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Yazıyı Düzenle</h2>
        <div class="input-area">
            <form method="POST" action="update_task.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                
                <input type="text" name="baslik" value="<?php echo htmlspecialchars($row['baslik']); ?>" required />
                
                <textarea name="icerik" class="blog-icerik" required><?php echo htmlspecialchars($row['icerik']); ?></textarea>
                
                <button type="submit" name="update" class="btn-update">💾 Değişiklikleri Kaydet</button>
            </form>
            
            <a href="barslabdashboard.php" class="btn-cancel">Vazgeç ve Panele Dön</a>
        </div>
    </div>
</body>
</html>