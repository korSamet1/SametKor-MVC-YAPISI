<?php
// Veritabanı bağlantısı için gerekli bilgiler
$servername = "sql100.infinityfree.com";  
$username = "if0_37711758";                
$password = "NIgEfU0PtG";                
$dbname = "if0_37711758_sametkor";    

// Veritabanı bağlantısı
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Karakter setini ayarla
$conn->set_charset("utf8mb4");

session_start(); // Oturum başlat

// Hata raporlamasını aç
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Giriş işlemi kontrolü
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL sorgusu - musteri tablosunu kullan
    $stmt = $conn->prepare("SELECT adsoyad FROM musteri WHERE eposta = ? AND sifre = ?");
    
    if ($stmt === false) {
        die("SQL sorgusu hazırlanmada hata: " . $conn->error);
    }
    
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->store_result();

    // Kullanıcı varsa
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($adsoyad);
        $stmt->fetch();
        $_SESSION['adsoyad'] = $adsoyad; // Oturumda ad soyadı sakla
        header("Location: /smt/index.php"); // Ana sayfaya yönlendir
        exit;
    } else {
        $error_message = "Hatalı e-posta veya şifre! Lütfen tekrar deneyin.";
        // Hata durumunda aynı sayfada kalması için modal'ı açık tutacağız
        $showLoginModal = true;
    }
}

// Kayıt işlemi kontrolü
if (isset($_POST['register'])) {
    $eposta = $_POST['regEmail'];
    $adres = $_POST['regAddress'];
    $adsoyad = $_POST['regName'];
    $sifre = $_POST['regPassword'];

    // Veritabanına ekle
    $stmt = $conn->prepare("INSERT INTO musteri (eposta, adres, adsoyad, sifre) VALUES (?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("SQL sorgusu hazırlanmada hata: " . $conn->error);
    }
    
    $stmt->bind_param("ssss", $eposta, $adres, $adsoyad, $sifre);
    
    if ($stmt->execute()) {
        // Kayıt başarılı
        $_SESSION['adsoyad'] = $adsoyad; // Oturumda ad soyadı sakla
        header("Location: /smt/index.php");
        exit;
    } else {
        $reg_error_message = "Kayıt sırasında bir hata oluştu: " . $stmt->error;
        // Hata durumunda aynı sayfada kalması için modal'ı açık tutacağız
        $showRegisterModal = true;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye Girişi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f0f0, #d9d9d9);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .button {
            background: red;
            color: white;
            border: none;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background 0.3s;
            flex: 1;
            margin: 0 5px;
        }

        .button:hover {
            background: black;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color:white;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            text-align: center;
        }

        .modal-content input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-content button {
            padding: 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .modal-content button:hover {
            background-color:black;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Üye Girişi</h2>
        </div>
        <div class="button-container">
            <div class="button" onclick="openModal('loginModal')">Giriş Yap</div>
            <div class="button" onclick="openModal('registerModal')">Kayıt Ol</div>  
        </div>
    </div>

    <!-- Modal for Login -->
    <div id="loginModal" class="modal" <?php echo isset($showLoginModal) ? 'style="display:flex;"' : ''; ?>>
        <div class="modal-content">
            <span onclick="closeModal('loginModal')" style="cursor:pointer; float:right;">&times;</span>
            <h3>Giriş Yap</h3>
            <form method="post" action="">
                <input type="text" name="email" placeholder="Gmail" required />
                <input type="password" name="password" placeholder="Şifre" required />
                <button type="submit" name="login">Giriş Yap</button>
            </form>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal for Registration -->
    <div id="registerModal" class="modal" <?php echo isset($showRegisterModal) ? 'style="display:flex;"' : ''; ?>>
        <div class="modal-content">
            <span onclick="closeModal('registerModal')" style="cursor:pointer; float:right;">&times;</span>
            <h3>Kayıt Ol</h3>
            <form method="post" action="">
                <input type="email" name="regEmail" placeholder="E-posta" required />
                <input type="text" name="regAddress" placeholder="Adres" required />
                <input type="text" name="regName" placeholder="İsim Soyisim" required />
                <input type="password" name="regPassword" placeholder="Şifre" required />
                <button type="submit" name="register">Kayıt Ol</button>
            </form>
            <?php if (isset($reg_error_message)): ?>
                <p class="error-message"><?php echo $reg_error_message; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "flex";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }
    </script>
</body>
</html>