<?= $this->extend('templates/admin_layout') ?>

<?= $this->section('main-content') ?>
      
      <div class="container mt-5">
          <div class="row">

            <div class="col-12">

            <h3><a href="/kategori" class="btn btn-sm btn-primary">Back</a>   Add New Category</h3>
            <hr>
            <?php echo form_open_multipart('/kategori/add') ?>
            <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="">
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
    
<?= $this->endSection(); ?>