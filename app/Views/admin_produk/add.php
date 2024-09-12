<?= $this->extend('templates/admin_layout') ?>

<?= $this->section('main-content') ?>
      
      <div class="container mt-5">
          <div class="row">

            <div class="col-12">

            <h3><a href="/produk" class="btn btn-sm btn-primary">Back</a>   Add New Produk</h3>
            <hr>
            <?php echo form_open_multipart('/produk/add') ?>
            <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Harga</label>
                  <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" id="harga" name="harga" value=""> -->

                    <input type="number" class="form-control" required name="harga" id="harga" min="0" step=".01">  

                  </div>
                </div>



                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">

                  <?php 
                    echo form_dropdown('kategori_id', 
                      $kategori, null, 
                      [ 'class' => 'form-control' ]
                    );
                  ?>

                  </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">

                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>


                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3 mt-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="gambar" name="gambar">
                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                          </div>

                          <button class="btn btn-primary" type="submit">Save</button>

                    </div>
                  </div>


              </form>
            </div>
            </div>
      </div>
    
<?= $this->endSection(); ?>