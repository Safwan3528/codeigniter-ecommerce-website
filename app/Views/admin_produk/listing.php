<?= $this->extend('templates/admin_layout') ?>

<?= $this->section('main-content') ?>

      <div class="container mt-5">

            <?php if (isset($_SESSION['success'])) :?>
            <div class="row">
                <div class="col">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> New data has been added.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                </div>
            </div>

            <?php endif; ?>


            <?php if (isset($_SESSION['deleted'])) :?>
            <div class="row">
                <div class="col">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Data has been deleted.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                </div>
            </div>

            <?php endif; ?>

          <div class="row">
              <div class="col-12">
                <a href="/produk/add" class="btn btn-sm btn-primary float-right">Add New</a>
                <h3>Senarai Produk</h3>
              </div>

              <div class="col-12">

                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
<?php $counter = 0; ?>
<?php foreach($produk as $g) : ?>                    
                        <tr>
                            <td><?= ++$counter;?></td>
                            <td>
                            <img class="gambar-pekan" src="/img/produk/<?= $g['gambar']?>" alt="">
                            </td>
                            <td><?= $g['nama']?></td>
                            <td><?= $kategori[ $g['kategori_id'] ]?></td>
                            <td>RM <?= number_format($g['harga'], 2)?></td>
                            <td>
                                <a href="/produk/edit/<?= $g['id'];?>" class="btn btn-sm btn-primary">Edit</a>
                                <button href="/produk/delete/<?= $g['id'];?>" onclick="confirm_delete( <?= $g['id'];?> )"  class="btn btn-sm btn-danger">Delete</button>

                            </td>
                        </tr>
<?php endforeach; ?>
                    </tbody>
                </table>

                <div id="my-pagination">
                <?= $pager->links() ?>
                </div>

              </div>
          </div>


      </div>

<script>

function confirm_delete( id ) {
    if ( confirm( 'Are you sure you want to delete record ID '+ id + '?' ) ) {
        window.location.href = '/produk/delete/' + id;
    }
}
</script>
<?= $this->endSection() ?>
