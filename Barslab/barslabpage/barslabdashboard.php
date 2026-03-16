<?php
session_start();
include '../barslabdata/barslabdb.php';


if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header('Location: barslablogin.php');
    exit();
}

$admin_id = $_SESSION['admin_id']; 


$stmt = $conn->prepare("SELECT * FROM yazilar WHERE admin_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result(); 
?>

<!DOCTYPE html>
<html lang="tr"> 
<head>
  <meta charset="UTF-8">
  <title>BarsLab | Blog Yönetim Paneli</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <style>

    .input-area {
        width: 100%;
        max-width: 750px;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-top: 20px;
    }

    .input-area form { 
        display: flex; 
        flex-direction: column; 
        gap: 15px; 
    }

    .input-area input, textarea.blog-icerik { 
        width: 100%; 
        padding: 12px; 
        border: 1px solid #ddd; 
        border-radius: 5px; 
        font-family: inherit;
        box-sizing: border-box; 
    }

    textarea.blog-icerik { 
        min-height: 150px; 
        resize: vertical; 
    }

   
    .input-area input:focus, textarea.blog-icerik:focus {
        outline: none;
        border-color: #333;
    }

    
    .btn-edit { 
        text-decoration: none; 
        padding: 6px 12px; 
        color: #333; 
        border: 1px solid #333;
        border-radius: 4px;
        font-size: 13px;
        transition: 0.3s;
    }
    .btn-edit:hover { background: #333; color: #fff; }

    .btn-delete { 
        text-decoration: none; 
        padding: 6px 12px; 
        color: #888; 
        font-size: 13px;
        transition: 0.3s;
    }
    .btn-delete:hover { color: #d9534f; } 

    .table { margin-top: 30px; }
  </style>
</head>
<body>
  <nav>
    <a class="heading" href="index.php">BarsLab Admin Paneli</a>
  </nav>
  
  <div class="container">
    <div class="input-area">
      <h4 style="margin-bottom: 15px; font-weight: 700;">Yeni İçerik Oluştur</h4>
      <form method="POST" action="add_task.php"> 
        <input type="text" name="baslik" placeholder="Yazı Başlığını Girin..." required />
        <textarea name="icerik" class="blog-icerik" placeholder="Yazı içeriğinizi buraya yazın..." required></textarea>
        <button class="btn" name="add">Yazıyı Yayınla</button>
      </form>
    </div>
    
    <table class="table">
      <thead>
        <tr>
          <th style="width: 50px;">#</th>
          <th>Başlık</th>
          <th style="width: 150px;">Tarih</th>
          <th style="width: 200px; text-align: center;">İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $count = 1;
        while ($fetch = $result->fetch_assoc()) { 
        ?>
        <tr class="border-bottom">
          <td><strong><?php echo $count++ ?></strong></td>
          <td><?php echo htmlspecialchars($fetch['baslik']); ?></td>
          <td style="color: #666; font-size: 13px;">
            <?php echo date('d.m.Y', strtotime($fetch['olusturulma_tarihi'])); ?>
          </td>
          <td class="action">
            <a href="update_task.php?id=<?php echo $fetch['id']; ?>" class="btn-edit">Düzenle</a>
            <a href="delete_task.php?id=<?php echo $fetch['id']; ?>" class="btn-delete" onclick="return confirm('Bu yazıyı silmek istediğinize emin misiniz?');">Sil</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>