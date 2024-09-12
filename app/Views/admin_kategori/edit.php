<?= $this->extend('templates/admin_layout') ?>

<?= $this->section('main-content') ?>

      <div class="container mt-5">

      <?php if (isset($_SESSION['success'])) :?>
            <div class="row">
                <div class="col">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> New data has been updated.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                </div>
            </div>
<?php endif; ?>

          <div class="row">

            <div class="col-12">

            <h3><a href="/kategori" class="btn btn-sm btn-primary">Back</a>   Edit Kategori</h3>
            <hr>
            <?php echo form_open_multipart('/kategori/edit/' . $kategori['id'] ) ?>
            <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $kategori['nama'] ?>">
                  </div>
                </div>

                  <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label"> </label>
                    <div class="col-sm-10">

                          <button class="btn btn-primary" type="submit">Save</button>

                    </div>
                  </div>


              </form>
            </div>
            </div>
      </div>
  

<?= $this->endSection() ?>
