<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Bootstrap</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/style.css">

</head>
<body>
<!-- Image and text -->
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="/img/logo-120.png" width="30" height="30" class="d-inline-block align-top" alt="">
      KelasProgramming.com
    </a>
  </nav>

  <!-- hero area -->
  <div class="hero-area">

    <div class="container">

        <div class="row">

            <div class="col">
                <h1>KelasProgramming.com</h1>
                <p>Program bimbingan pembelajaran PHP secara online dan sambilan.</p>
            </div>

        </div>

    </div>

</div>

<div class="container mt-5">
    <!-- subtitle -->

    <div class="row">
        <div class="col text-center">
            <h3>Gambar-gambar Pekan</h3>
        </div>
    </div>

    <!-- gallery -->
    <div class="row">

        <?php foreach($all_pekan as $pekan ) : ?>
        <div class="col-12 col-sm-6 col-md-4  col-lg-3 mt-3">
            <div class="card">
                <img src="/img/<?php echo $pekan->nama_fail?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5><?php echo $pekan->nama;?></h5>
                  <p class="card-text"><?php echo $pekan->keterangan; ?></p>
                </div>
              </div>
        </div>
        <?php endforeach; ?>

    </div><!-- /row  -->

    <!-- pagination -->
    <div class="row p-5">
        <div class="col-12">

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>

        </div>
    </div><!-- /pagination -->

</div><!-- /container -->

<footer class="text-center p-5">
<p>Hakcipta terpelihara &copy; 2021</p>

</footer>
    
</body>
</html>