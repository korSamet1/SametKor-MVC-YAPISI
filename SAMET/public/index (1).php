<?php
// Start session to maintain login state
session_start();

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
$userFullName = $isLoggedIn ? $_SESSION['adsoyad'] : '';
$isLoggedIn = isset($_SESSION['adsoyad']);
?>

<!doctype html>
<html lang="tr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Kırtasiye Dünyası</title>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
        />
        <style>
            .top-bar {
                background: #f8f9fa;
                padding: 5px 0;
                font-size: 14px;
            }

            .banner {
                background: white;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .search-box {
                border-radius: 20px;
                border: 2px solid #ddd;
            }

            .carousel-item img {
                height: 400px;
                width: 100%;
                object-fit: cover;
            }

            footer {
                background: #34495e;
                color: white;
                padding: 40px 0;
            }

            .navbar-brand img {
                height: 205px;
                width: auto;
            }

            #cart-count {
                position: absolute;
                top: -8px;
                right: -8px;
                background: #dc3545;
                color: white;
                border-radius: 50%;
                padding: 2px 6px;
                font-size: 12px;
            }

            .cart-item {
                display: flex;
                align-items: center;
                padding: 10px;
                border-bottom: 1px solid #eee;
            }

            .cart-item img {
                width: 80px;
                margin-right: 15px;
            }

            #cartModal .modal-body {
                max-height: 400px;
                overflow-y: auto;
            }

            .category-card {
                border: 1px solid #ccc;
                padding: 20px;
                text-align: center;
                margin-bottom: 20px;
            }

            .category-card img {
                max-width: 100%;
                height: auto;
                margin-bottom: 10px;
            }
            
            .welcome-text {
                font-weight: bold;
                color: #28a745;
            }
            .sidebar {
    width: 300px; /* Yan menü genişliği */
    float: left; /* Solda hizalanması için */
    margin-right: 20px; /* Sağdan boşluk bırak */
    background-color: #ffffff; /* Arka plan rengi beyaz */
    border-radius: 8px; /* Kenar yuvarlama */
    padding: 20px; /* İç boşluk */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15); /* Daha belirgin gölgelendirme */
    height: calc(120vh - 40px); /* Yüksekliği belirle */
    overflow-y: auto; /* Fazla içeriğe karşı kaydırma çubuğu ekle */
}
/* kategoriler başlığı*/
h2 {
    text-align: center;
    color: BLACK; /* Başlık rengi yeşil */
    font-family: 'Arial', sans-serif; /* Yazı tipi */
    margin-bottom: 20px; /* Başlık altındaki boşluk */
}

.filter {
    margin-bottom: 15px; /* Elemanlar arasındaki boşluk */
}

.filter h3 {
    margin: 10px 0; /* Üst ve alt kenarlardan boşluk */
    color: #333; /* Başlık için koyu renk */
    font-size: 1.2em; /* Başlık boyutu */
    padding-bottom: 5px; /* Alt kenar ile içerik arasında boşluk */
    border-bottom: 2px solid #28a745; /* Alt kenar çubuğu */
}

select, input[type="number"], button {
    width: 100%; /* Elemanların tüm genişliği kaplaması için */
    padding: 12px; /* İç boşluk */
    margin-top: 5px; /* Üstten boşluk */
    border: 1px solid #ccc; /* Kenar rengi */
    border-radius: 5px; /* Kenar yuvarlama */
    font-size: 1em; /* Yazı boyutu */
}

select:focus, 
input[type="number"]:focus {
    border-color: #28a745; /* Odaklanma rengi */
    outline: none; /* Kenar çizgisini kaldır */
}

button {
    background-color: #28a745; /* Düğme arka plan rengi */
    color: white; /* Düğme yazı rengi */
    border: none; /* Kenar yok */
    cursor: pointer; /* İmleci göster */
    font-size: 1.1em; /* Düğme yazı boyutu */
    padding: 12px; /* İç boşluk */
    transition: background-color 0.3s, transform 0.3s; /* Geçiş efekti */
}

button:hover {
    background-color: f4ECC2; /* Hover durumu için daha koyu yeşil */
    transform: translateY(-2px); /* Hover durumunda yukarı kaldır */
}

button:active {
    transform: translateY(1px); /* Tıklanma durumunda hafif aşağı iter */
}

        </style>
    </head>
    <body>
        <!-- Banner -->
        <header class="banner sticky-top">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="#">
                        <img src="/smt/görsel/logo3.png" alt="Logo" />
                    </a>

                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                       <form class="d-flex mx-auto w-50">
    <input
        class="form-control search-box flex-grow-1"
        type="search"
        placeholder="Ne aramıştınız?"
    />
    <button class="btn btn-primary ms-2" style="width: 80px;" type="submit">
        Ara
    </button>
</form>
                      

                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <?php if($isLoggedIn): ?>
                                <!-- Giriş yapıldığında hoşgeldiniz mesajını göster -->
                                <span class="nav-link welcome-text">
                                   <i class="fas fa-user"></i>
                                   Hoşgeldiniz, <?php echo htmlspecialchars($_SESSION['adsoyad']); ?>
                                </span>
                                <?php else: ?>
                                <!-- Giriş yapılmadığında giriş butonunu göster -->
                                <a class="nav-link" href="/dönemson/login.php">
                                    <i class="fas fa-user"></i> Giriş Yap
                                </a>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item d-flex align-items-center">
                                <a class="nav-link position-relative" href="#" data-bs-toggle="modal" data-bs-target="#cartModal">
                                    <i class="fas fa-shopping-cart"></i> Sepetim
                                    <span id="cart-count" class="d-none">0</span>
                                </a>
                                <?php if($isLoggedIn): ?>
                                <!-- Sadece giriş yapıldığında çıkış butonunu göster -->
                                <a class="nav-link" href="/dönemson/logout.php">
                                    <i class="fas fa-sign-out-alt ms-2"></i> Çıkış Yap
                                </a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <?php if(!$isLoggedIn): ?>
        <!-- Giriş Modal - Show only when not logged in -->
        <div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginmodalLabel">Üye Ol</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="register_process.php">
                            <div class="mb-3">
                                <label for="reg-email" class="form-label">E-posta</label>
                                <input type="email" class="form-control" id="reg-email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="reg-name" class="form-label">Ad Soyad</label>
                                <input type="text" class="form-control" id="reg-name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="reg-password" class="form-label">Şifre</label>
                                <input type="password" class="form-control" id="reg-password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Kayıt Ol</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Carousel -->
        <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        src="/smt/görsel/cur3.png"
                        class="d-block w-100"
                        alt="Kampanya 1"
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="/smt/görsel/cur2.jpg"
                        class="d-block w-100"
                        alt="Kampanya 2"
                    />
                </div>
                <div class="carousel-item">
                    <img
                        src="/smt/görsel/cur4.png"
                        class="d-block w-100"
                        alt="Kampanya 3"
                    />
                </div>
            </div>
            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#mainCarousel"
                data-bs-slide="prev"
            >
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Önceki</span>
            </button>
            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#mainCarousel"
                data-bs-slide="next"
            >
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Sonraki</span>
            </button>
        
        </div>
  <aside class="sidebar">
    <h2>Kategoriler</h2>
    
    <div class="accordion" id="kategoriler">
   <!-- Kağıt & Defter Kategorisi -->
  <div class="accordion-item">
      <h2 class="accordion-header" id="kagit-defter-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#kagit-defter-collapse">
              <i class="fas fa-book me-2"></i> Kağıt & Defter
          </button>
      </h2>
      <div id="kagit-defter-collapse" class="accordion-collapse collapse show">
          <div class="accordion-body">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="defter" id="defter">
                  <label class="form-check-label" for="defter"><i class="fas fa-journal-whills me-2"></i> Defterler</label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="not-defteri" id="not-defteri">
                  <label class="form-check-label" for="not-defteri"><i class="fas fa-sticky-note me-2"></i> Not Defterleri</label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="ajanda" id="ajanda">
                  <label class="form-check-label" for="ajanda"><i class="fas fa-calendar-alt me-2"></i> Ajandalar</label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="kagit" id="kagit">
                  <label class="form-check-label" for="kagit"><i class="fas fa-file-alt me-2"></i> Yazı Kağıtları</label>
              </div>
          </div>
      </div>
  </div>
  <!-- Kalem & Yazma Kategorisi -->
  <div class="accordion-item">
      <h2 class="accordion-header" id="kalem-yazma-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kalem-yazma-collapse">
              <i class="fas fa-pen me-2"></i> Kalem & Yazma Gereçleri
          </button>
      </h2>
      <div id="kalem-yazma-collapse" class="accordion-collapse collapse">
          <div class="accordion-body">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="tukenmez-kalem" id="tukenmez-kalem">
                  <label class="form-check-label" for="tukenmez-kalem"><i class="fas fa-pen-nib me-2"></i> Tükenmez Kalemler</label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="dolma-kalem" id="dolma-kalem">
                  <label class="form-check-label" for="dolma-kalem"><i class="fas fa-feather me-2"></i> Dolma Kalemler</label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="kurşun-kalem" id="kursun-kalem">
                  <label class="form-check-label" for="kursun-kalem"><i class="fas fa-pencil-alt me-2"></i> Kurşun Kalemler</label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="fosforlu-kalem" id="fosforlu-kalem">
                  <label class="form-check-label" for="fosforlu-kalem"><i class="fas fa-highlighter me-2"></i> Fosforlu Kalemler</label>
              </div>
          </div>
      </div>
  </div>
<!-- Ofis Malzemeleri Kategorisi -->
<div class="accordion-item">
    <h2 class="accordion-header" id="ofis-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ofis-collapse" aria-expanded="false" aria-controls="ofis-collapse">
            <i class="fas fa-briefcase me-2"></i> Ofis Malzemeleri
        </button>
    </h2>
    <div id="ofis-collapse" class="accordion-collapse collapse" aria-labelledby="ofis-header">
        <div class="accordion-body">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="kagit" id="kagit">
                <label class="form-check-label" for="kagit">Kağıt Çeşitleri</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="kalem" id="kalem">
                <label class="form-check-label" for="kalem">Kalemler</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="dosya-klasor" id="dosya-klasor">
                <label class="form-check-label" for="dosya-klasor">Dosya & Klasörler</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="ajanda" id="ajanda">
                <label class="form-check-label" for="ajanda">Ajandalar</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="silgi-kalemtiras" id="silgi-kalemtiras">
                <label class="form-check-label" for="silgi-kalemtiras">Silgi & Kalemtıraş</label>
            </div>
        </div>
    </div>
</div>

       <!-- Okul Malzemeleri Kategorisi -->
<div class="accordion-item">
    <h2 class="accordion-header" id="okul-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#okul-collapse" aria-expanded="false" aria-controls="okul-collapse">
            <i class="fas fa-school me-2"></i> Okul Malzemeleri
        </button>
    </h2>
    <div id="okul-collapse" class="accordion-collapse collapse" aria-labelledby="okul-header">
        <div class="accordion-body">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="okul-cantasi" id="okul-cantasi">
                <label class="form-check-label" for="okul-cantasi">Okul Çantaları</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="kalem-kutusu" id="kalem-kutusu">
                <label class="form-check-label" for="kalem-kutusu">Kalem Kutuları</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="silgi" id="silgi">
                <label class="form-check-label" for="silgi">Silgiler</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="kalemtiras" id="kalemtiras">
                <label class="form-check-label" for="kalemtiras">Kalemtıraşlar</label>
            </div>
        </div>
    </div>
</div>
<!-- Okuma Kitapları Kategorisi -->
<div class="accordion-item">
    <h2 class="accordion-header" id="okuma-kitaplari-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#okuma-kitaplari-collapse">
            <i class="fas fa-book-open me-2"></i> Okuma Kitapları
        </button>
    </h2>
    <div id="okuma-kitaplari-collapse" class="accordion-collapse collapse">
        <div class="accordion-body">
            <!-- Roman Kategorileri -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="klasik-roman" id="klasik-roman">
                <label class="form-check-label" for="klasik-roman">
                    <i class="fas fa-scroll me-2"></i> Klasik Romanlar
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="cagdas-roman" id="cagdas-roman">
                <label class="form-check-label" for="cagdas-roman">
                    <i class="fas fa-feather me-2"></i> Çağdaş Romanlar
                </label>
            </div>
            
            <!-- Edebiyat Türleri -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="turk-edebiyati" id="turk-edebiyati">
                <label class="form-check-label" for="turk-edebiyati">
                    <i class="fas fa-flag me-2"></i> Türk Edebiyatı
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="dunya-edebiyati" id="dunya-edebiyati">
                <label class="form-check-label" for="dunya-edebiyati">
                    <i class="fas fa-globe me-2"></i> Dünya Edebiyatı
                </label>
            </div>
            
            <!-- Popüler Türler -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="polisiye" id="polisiye">
                <label class="form-check-label" for="polisiye">
                    <i class="fas fa-user-secret me-2"></i> Polisiye
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="bilim-kurgu" id="bilim-kurgu">
                <label class="form-check-label" for="bilim-kurgu">
                    <i class="fas fa-rocket me-2"></i> Bilim Kurgu
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="ask-romanlari" id="ask-romanlari">
                <label class="form-check-label" for="ask-romanlari">
                    <i class="fas fa-heart me-2"></i> Aşk Romanları
                </label>
            </div>
            
            <!-- Diğer Kategoriler -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="tarih-kitaplari" id="tarih-kitaplari">
                <label class="form-check-label" for="tarih-kitaplari">
                    <i class="fas fa-landmark me-2"></i> Tarih Kitapları
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="biyografi" id="biyografi">
                <label class="form-check-label" for="biyografi">
                    <i class="fas fa-user-tie me-2"></i> Biyografi
                </label>
            </div>
        </div>
    </div>
</div>

<!-- Eğitim Kitapları Kategorisi -->
<div class="accordion-item">
    <h2 class="accordion-header" id="egitim-kitaplari-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#egitim-kitaplari-collapse">
            <i class="fas fa-graduation-cap me-2"></i> Eğitim Kitapları
        </button>
    </h2>
    <div id="egitim-kitaplari-collapse" class="accordion-collapse collapse">
        <div class="accordion-body">
            <!-- LGS Hazırlık -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="lgs-hazirlik" id="lgs-hazirlik">
                <label class="form-check-label" for="lgs-hazirlik">
                    <i class="fas fa-school me-2"></i> LGS Hazırlık Kitapları
                </label>
            </div>
            
            <!-- YKS Hazırlık -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="tyt-hazirlik" id="tyt-hazirlik">
                <label class="form-check-label" for="tyt-hazirlik">
                    <i class="fas fa-book-reader me-2"></i> TYT Hazırlık Kitapları
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="ayt-hazirlik" id="ayt-hazirlik">
                <label class="form-check-label" for="ayt-hazirlik">
                    <i class="fas fa-book-reader me-2"></i> AYT Hazırlık Kitapları
                </label>
            </div>
            
            <!-- DGS Hazırlık -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="dgs-hazirlik" id="dgs-hazirlik">
                <label class="form-check-label" for="dgs-hazirlik">
                    <i class="fas fa-university me-2"></i> DGS Hazırlık Kitapları
                </label>
            </div>
            
            <!-- Diğer Sınav Kitapları -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="kpss-hazirlik" id="kpss-hazirlik">
                <label class="form-check-label" for="kpss-hazirlik">
                    <i class="fas fa-clipboard-list me-2"></i> KPSS Hazırlık Kitapları
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="ales-hazirlik" id="ales-hazirlik">
                <label class="form-check-label" for="ales-hazirlik">
                    <i class="fas fa-clipboard-check me-2"></i> ALES Hazırlık Kitapları
                </label>
            </div>
        </div>
    </div>
</div>


    <!-- Sanat & Hobi Kategorisi -->
<div class="accordion-item">
    <h2 class="accordion-header" id="sanat-hobi-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sanat-hobi-collapse">
            <i class="fas fa-palette me-2"></i> Sanat & Hobi Malzemeleri
        </button>
    </h2>
    <div id="sanat-hobi-collapse" class="accordion-collapse collapse">
        <div class="accordion-body">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="boya" id="boya">
                <label class="form-check-label" for="boya">
                    <i class="fas fa-paint-brush me-2"></i> Boyalar
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="resim-malzemeleri" id="resim-malzemeleri">
                <label class="form-check-label" for="resim-malzemeleri">
                    <i class="fas fa-image me-2"></i> Resim Malzemeleri
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="kroki-defteri" id="kroki-defteri">
                <label class="form-check-label" for="kroki-defteri">
                    <i class="fas fa-pencil-alt me-2"></i> Kroki Defterleri
                </label>
            </div>
        </div>
    </div>
</div>


    <!-- Fiyat Filtresi -->
    <div class="filter mt-3">
        <h3>Fiyat Aralığı</h3>
        <div class="input-group">
            <input type="number" class="form-control" id="min-price" placeholder="En Az">
            <span class="input-group-text">-</span>
            <input type="number" class="form-control" id="max-price" placeholder="En Çok">
        </div>
    </div>

    <!-- Filtre Butonları -->
    <div class="filter-actions mt-3">
        <button class="btn btn-primary w-100 mb-2" onclick="applyFilters()">
            Filtreleri Uygula
        </button>
        <button class="btn btn-outline-secondary w-100" onclick="resetFilters()">
            Filtreleri Temizle
        </button>
    </div>
</aside>
        <!-- Kategoriler -->
        <div class="container mt-5">
            <h3 class="text-center mb-4">Popüler Kategoriler</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="category-card">
                        <img
                            src="/smt/görsel/kmpok.jpeg"
                            alt="Okul Malzemeleri"
                        />
                        <h5>Okul Malzemeleri</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-card">
                        <img
                            src="/smt/görsel/kmpof.jpg"
                            alt="Ofis Malzemeleri"
                        />
                        <h5>Ofis Malzemeleri</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-card">
                        <img
                            src="/smt/görsel/kmpsnt.jpeg"
                            alt="Sanat Malzemeleri"
                        />
                        <h5>Sanat Malzemeleri</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-card">
                        <img src="/smt/görsel/kmpktp.jpeg" alt="Kitaplar" />
                        <h5>Kitaplar</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ürünler -->
        <div class="container mt-5">
            <h3 class="text-center mb-4">Öne Çıkan Ürünler</h3>
            <div class="row">
                <!-- Ürün 1 -->
                <div class="col-md-3">
                    <div class="card product-card">
                        <img
                            src="/smt/görsel/ürün1.jpg"
                            class="card-img-top"
                            alt="Ürün 1"
                        />
                        <div class="card-body">
                            <h5 class="card-title">Faber Castell Kalem Seti</h5>
                            <p class="card-text">12'li Renkli Kalem Seti</p>
                            <p class="text-primary fw-bold">89.90 TL</p>
                            <button
                                class="btn btn-primary w-100"
                                onclick="addToCart(1)"
                            >
                                Sepete Ekle
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Ürün 2 -->
                <div class="col-md-3">
                    <div class="card product-card">
                        <img
                            src="/smt/görsel/ürün2.jpg"
                            class="card-img-top"
                            alt="Ürün 2"
                        />
                        <div class="card-body">
                            <h5 class="card-title">Premium Defter</h5>
                            <p class="card-text">A4 Spiralli Çizgili Defter</p>
                            <p class="text-primary fw-bold">45.90 TL</p>
                            <button
                                class="btn btn-primary w-100"
                                onclick="addToCart(2)"
                            >
                                Sepete Ekle
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Ürün 3 -->
                <div class="col-md-3">
                    <div class="card product-card">
                        <img
                            src="/smt/görsel/ürün3.jpg"
                            class="card-img-top"
                            alt="Ürün 3"
                        />
                        <div class="card-body">
                            <h5 class="card-title">Fosforlu Kalem Seti</h5>
                            <p class="card-text">6 Renk Pastel Ton</p>
                            <p class="text-primary fw-bold">69.90 TL</p>
                            <button
                                class="btn btn-primary w-100"
                                onclick="addToCart(3)"
                            >
                                Sepete Ekle
                            </button>
                        </div>
                    </div>
                </div>
  <!-- Ürün 4 -->
                <div class="col-md-3">
                    <div class="card product-card">
                        <img
                            src="/smt/görsel/ürün4.jpg"
                            class="card-img-top"
                            alt="Ürün 4"
                        />
                        <div class="card-body">
                            <h5 class="card-title">Okul Çantası</h5>
                            <p class="card-text">Ergonomik Sırt Çantası</p>
                            <p class="text-primary fw-bold">199.90 TL</p>
                            <button
                                class="btn btn-primary w-100"
                                onclick="addToCart(4)"
                            >
                                Sepete Ekle
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        


        <!-- Footer -->
        <footer class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h5>Kırtasiye Hakkında</h5>
                        <p>
                            Kırtasiye E-Ticaret platformumuzda, her türlü
                            kırtasiye ürününü bulabilir, uygun fiyatlarla
                            alışveriş yapabilirsiniz.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h5>Bize Ulaşın</h5>
                        <p>📍 İstanbul, Türkiye</p>
                        <p>📞 0212 XXX XX XX</p>
                        <p>📧 info@kirtasiye.com</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Hızlı Bağlantılar</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#" class="text-white">Ana Sayfa</a>
                            </li>
                            <li><a href="#" class="text-white">Ürünler</a></li>
                            <li>
                                <a href="#" class="text-white">İndirimler</a>
                            </li>
                            <li><a href="#" class="text-white">İletişim</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Sepet Modal -->
        <div class="modal fade" id="cartModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Alışveriş Sepeti</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div id="cart-items"></div>
                        <div id="cart-empty" class="text-center py-3">
                            Sepetiniz boş
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Toplam:</span>
                                <span id="cart-total">0,00 TL</span>
                            </div>
                            <button
                                class="btn btn-primary w-100"
                                onclick="checkout()"
                            >
                                Ödemeye Geç
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <script>
            // Ürün verileri
            const products = [
                {
                    id: 1,
                    name: "Faber Castell Kalem Seti",
                    description: "12'li Renkli Kalem Seti",
                    price: 89.9,
                    image: "/smt/görsel/ürün1.jpg",
                },
                {
                    id: 2,
                    name: "Premium Defter",
                    description: "A4 Spiralli Çizgili Defter",
                    price: 45.9,
                    image: "/smt/görsel/ürün2.jpg",
                },
                {
                    id: 3,
                    name: "Fosforlu Kalem Seti",
                    description: "6 Renk Pastel Ton",
                    price: 69.9,
                    image: "/smt/görsel/ürün3.jpg",
                },
                {
                    id: 4,
                    name: "Okul Çantası",
                    description: "Ergonomik Sırt Çantası",
                    price: 199.9,
                    image: "/smt/görsel/ürün4.jpg",
                },
            ];

            // Sepet
            let cart = [];
            let userCarts = {};

            // Sayfa yüklendiğinde sepeti ve kullanıcı sepetlerini yükle
            $(document).ready(function() {
                loadUserCarts();
                const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
                const userFullName = "<?php echo $isLoggedIn ? $_SESSION['adsoyad'] : ''; ?>";
                
                if (isLoggedIn) {
                    // Kullanıcı giriş yapmış, kullanıcıya özgü sepeti yükle
                    loadUserCart(userFullName);
                } else {
                    // Kullanıcı giriş yapmamış, geçici sepeti yükle
                    loadCartFromStorage();
                }
                
                updateCartUI();
            });

            // Kullanıcı sepetlerini localStorage'dan yükle
            function loadUserCarts() {
                const savedUserCarts = localStorage.getItem('kirtasiyeUserCarts');
                if (savedUserCarts) {
                    userCarts = JSON.parse(savedUserCarts);
                }
            }

            // Sepeti localStorage'dan yükle (anonim kullanıcılar için)
            function loadCartFromStorage() {
                const savedCart = localStorage.getItem('kirtasiyeCart');
                if (savedCart) {
                    cart = JSON.parse(savedCart);
                }
            }

            // Belirli bir kullanıcının sepetini yükle
            function loadUserCart(username) {
                if (userCarts[username]) {
                    cart = userCarts[username];
                } else {
                    // Eğer kullanıcının geçici sepetinde ürün varsa, 
                    // giriş yaptığında bu sepeti kullanıcı sepetine aktar
                    loadCartFromStorage();
                    userCarts[username] = cart;
                    saveUserCarts();
                    
                    // Geçici sepeti temizle
                    localStorage.removeItem('kirtasiyeCart');
                }
            }

            // Sepeti localStorage'a kaydet
            function saveCartToStorage() {
                const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
                const userFullName = "<?php echo $isLoggedIn ? $_SESSION['adsoyad'] : ''; ?>";
                
                if (isLoggedIn) {
                    // Kullanıcı giriş yapmış, kullanıcıya özgü sepeti güncelle
                    userCarts[userFullName] = cart;
                    saveUserCarts();
                } else {
                    // Kullanıcı giriş yapmamış, geçici sepeti güncelle
                    localStorage.setItem('kirtasiyeCart', JSON.stringify(cart));
                }
            }

            // Kullanıcı sepetlerini localStorage'a kaydet
            function saveUserCarts() {
                localStorage.setItem('kirtasiyeUserCarts', JSON.stringify(userCarts));
            }

            // Sepete ürün ekle
            function addToCart(productId) {
                const product = products.find((p) => p.id === productId);
                const existingItem = cart.find((item) => item.id === productId);

                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    cart.push({
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        image: product.image,
                        quantity: 1,
                    });
                }

                saveCartToStorage();
                updateCartUI();
            }

            // Sepetten ürün çıkar
            function removeFromCart(productId) {
                cart = cart.filter((item) => item.id !== productId);
                saveCartToStorage();
                updateCartUI();
            }

            // Ürün miktarını güncelle
            function updateQuantity(productId, change) {
                const item = cart.find((item) => item.id === productId);
                if (item) {
                    item.quantity += change;
                    if (item.quantity <= 0) {
                        removeFromCart(productId);
                    } else {
                        saveCartToStorage();
                        updateCartUI();
                    }
                }
            }

            // Sepet arayüzünü güncelle
            function updateCartUI() {
                const cartCount = document.getElementById("cart-count");
                const cartItems = document.getElementById("cart-items");
                const cartEmpty = document.getElementById("cart-empty");
                const cartTotal = document.getElementById("cart-total");

                const totalQuantity = cart.reduce(
                    (sum, item) => sum + item.quantity,
                    0,
                );
                const totalPrice = cart.reduce(
                    (sum, item) => sum + item.price * item.quantity,
                    0,
                );

                // Sepet sayısını güncelle
                cartCount.textContent = totalQuantity;
                cartCount.classList.toggle("d-none", totalQuantity === 0);

                // Sepet içeriğini güncelle
                if (cart.length === 0) {
                    cartItems.innerHTML = "";
                    cartEmpty.classList.remove("d-none");
                } else {
                    cartEmpty.classList.add("d-none");
                    cartItems.innerHTML = cart
                        .map(
                            (item) => `
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">${item.name}</h6>
                            <div class="d-flex align-items-center mt-2">
                                <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${item.id}, -1)">-</button>
                                <span class="mx-2">${item.quantity}</span>
                                <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${item.id}, 1)">+</button>
                                <button class="btn btn-sm btn-danger ms-3" onclick="removeFromCart(${item.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="ms-3 text-end">
                            <div class="fw-bold">${(item.price * item.quantity).toFixed(2)} TL</div>
                            <small class="text-muted">${item.price.toFixed(2)} TL/adet</small>
                        </div>
                    </div>
                `,
                        )
                        .join("");
                }

                // Toplam tutarı güncelle
                cartTotal.textContent = `${totalPrice.toFixed(2)} TL`;
            }

            // Ödeme işlemi
            function checkout() {
                if (cart.length === 0) {
                    alert("Sepetiniz boş!");
                    return;
                }
                // Kullanıcı giriş yapmış mı kontrol et
                const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
                
                if (!isLoggedIn) {
                    alert("Ödeme yapmak için giriş yapmalısınız!");
                    window.location.href = "/dönemson/login.php";
                    return;
                }
                
                alert("Ödeme sayfasına yönlendiriliyorsunuz...");
                // Burada ödeme sayfasına yönlendirme yapılabilir
            }
         function applyFilters() {
    // Seçilen kategoriler
    const selectedCategories = Array.from(
        document.querySelectorAll('.category-list input:checked')
    ).map(el => el.value);

    // Seçilen markalar
    const selectedBrands = Array.from(
        document.querySelectorAll('.brand-list input:checked')
    ).map(el => el.value);

    // Fiyat aralığı
    const minPrice = document.getElementById('min-price').value;
    const maxPrice = document.getElementById('max-price').value;

    console.log('Filtreler:', {
        categories: selectedCategories,
        brands: selectedBrands,
        minPrice: minPrice,
        maxPrice: maxPrice
    });

    // Burada ürünleri filtreleme mantığı eklenebilir
    filterProducts(selectedCategories, selectedBrands, minPrice, maxPrice);
}

function resetFilters() {
    // Tüm checkbox'ları kaldır
    document.querySelectorAll('.category-list input, .brand-list input').forEach(el => {
        el.checked = false;
    });

    // Fiyat aralığını sıfırla
    document.getElementById('min-price').value = '';
    document.getElementById('max-price').value = '';

    // Tüm ürünleri göster
    showAllProducts();
}

function filterProducts(categories, brands, minPrice, maxPrice) {
    const products = document.querySelectorAll('.product-card');
    
    products.forEach(product => {
        const productCategory = product.getAttribute('data-category');
        const productBrand = product.getAttribute('data-brand');
        const productPrice = parseFloat(product.getAttribute('data-price'));

        const categoryMatch = categories.length === 0 || categories.includes(productCategory);
        const brandMatch = brands.length === 0 || brands.includes(productBrand);
        const priceMatch = 
            (!minPrice || productPrice >= parseFloat(minPrice)) && 
            (!maxPrice || productPrice <= parseFloat(maxPrice));

        product.style.display = (categoryMatch && brandMatch && priceMatch) ? 'block' : 'none';
    });
}

function showAllProducts() {
    const products = document.querySelectorAll('.product-card');
    products.forEach(product => {
        product.style.display = 'block';
    });
}   
        </script>
    </body>
</html>