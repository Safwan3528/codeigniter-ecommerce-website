<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Gambar</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/admin.css">

</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <img src="/img/logo-120.png" width="30" height="30" class="d-inline-block align-top" alt="">
          KelasProgramming.com
        </a>
      </nav> 
      
      <div class="container mt-5">
          <div class="row">

            <div class="col-12">

            <h3><a href="/gambar" class="btn btn-sm btn-primary">Back</a>   Add New Gambar</h3>
            <hr>
            <?php echo form_open_multipart('/gambar/add') ?>
                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="">
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
                              <input type="file" class="custom-file-input" id="nama_fail" name="nama_fail">
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
    

      <footer class="text-center p-5">
        <p>Hakcipta terpelihara &copy; 2021</p>
        
        </footer>

</body>
</html>


