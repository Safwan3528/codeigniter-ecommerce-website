<?= $this->extend('templates/front_layout') ?>

  <?= $this->section('hero') ?>

  <div class="hero-area">

    <div class="container">

        <div class="row">

            <div class="col">
                <h1><?= $site_name; ?></h1>
                <p><?= $site_description ?></p>
            </div>

        </div>

    </div>

</div>
<?= $this->endSection() ?>


<?= $this->section('main-content') ?>

<div class="container mt-5">
<?php if (isset($_SESSION['success'])) :?>
            <div class="row">
                <div class="col">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Add to cart!</strong> View your item in your <a href="/bakul">cart.</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

<?php endif; ?>


    <div class="row">
        <div class="col text-center">
            <h3>Produk</h3>
        </div>
    </div>

    <!-- gallery -->
    <div class="row">

        <?php foreach($produk as $p ) : ?>
        <div class="col-12 col-sm-6 col-md-4  col-lg-3 mt-3">
            <div class="card">
                <img src="<?php echo '/'. $produk_img_location . $p['gambar']?>" class="card-img-top" alt="...">
                <div class="card-body">
                <p><span class="badge bg-info text-dark"><?= $kategori[ $p['kategori_id'] ]?></span></p> 
                                    <h5><?php echo $p['nama'];?></h5>
                    <p class="card-text"><?php echo $p['keterangan']; ?></p>
                    <p class="card-text">
                    <strong>Harga : </strong> RM
                    <?php echo number_format( $p['harga'],2); ?></p>


                    <div class="row">
                        <div class="col-12">
                            <form method="post" class="form-inline" action="/bakul/add">
                                <input type="hidden" name="produk_id" value="<?= $p['id']?>">
                                <input type="number" name="qty" value="1" class="form-control col-4 mr-1">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
              </div>
        </div>
        <?php endforeach; ?>

    </div><!-- /row  -->

    <!-- pagination -->
    <div class="row p-5">
        <div class="col-12">

        <div id="my-pagination">
                <?= $pager->links() ?>
                </div>

        </div>
    </div><!-- /pagination -->

</div><!-- /container -->

<?= $this->endSection() ?>
