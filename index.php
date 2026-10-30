<?php
// load config.php
include("config/config.php");
 
// untuk api_key newsapi.org
$api_key = "b3a0975f58b5491cb8c04af5239ee0d1";
 
// url api untuk ambil berita headline di Indonesia
$url = "https://newsapi.org/v2/top-headlines?country=us&apiKey=" . $api_key;
 
// menyimpan hasil dalam variabel
$data = http_request_get($url);
 
// konversi data json ke array
$hasil = json_decode($data, true);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rest Client dengan cURL</title>
    <!-- CSS Bootstrap Lokal (Pastikan folder css dan file bootstrap.min.css ada sejajar dengan index.php) -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
 
<!-- navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info">
  <div class="container">
      <a class="navbar-brand" href="#">RestClient</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
        </ul>
      </div>
  </div>
</nav>
<!-- navbar -->

<div class="container" style="margin-top: 85px;">
    <div class="row">
 
<!-- looping hasil data di array article -->
<?php if (isset($hasil['status']) && $hasil['status'] === 'ok' && isset($hasil['articles']) && count($hasil['articles']) > 0): ?>
    <?php foreach ($hasil['articles'] as $row) { ?>
        <div class="col-md-4" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="card h-100 shadow-sm">
              <img src="<?php echo !empty($row['urlToImage']) ? $row['urlToImage'] : 'https://via.placeholder.com/286x180?text=No+Image'; ?>" class="card-img-top" height="180px" style="object-fit: cover;">
              <div class="card-body d-flex flex-column">
                <p class="card-text flex-grow-1">
                    <small class="text-muted"><i>Oleh <?php echo !empty($row['author']) ? htmlspecialchars($row['author']) : 'Tidak diketahui'; ?></i></small><br>
                    <strong><?php echo htmlspecialchars($row['title']); ?></strong>
                </p>
                <p class="text-right mt-auto mb-0">
                    <a href="<?php echo $row['url']; ?>" target="_blank" class="btn btn-sm btn-outline-primary">Selengkapnya..</a>
                </p>
              </div>
            </div>
        </div>
    <?php } ?>
<?php else: ?>
    <div class="col-12">
        <div class="alert alert-warning text-center" role="alert">
            Gagal memuat data berita. Pesan dari API: <strong><?php echo isset($hasil['message']) ? htmlspecialchars($hasil['message']) : 'Periksa kembali koneksi internet atau kuota API Anda.'; ?></strong>
        </div>
    </div>
<?php endif; ?>
 
    </div>
</div>
 
<!-- JS Bootstrap Lokal (Menggunakan file yang ada di folder js Anda) -->
<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>