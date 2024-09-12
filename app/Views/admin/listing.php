<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/admin.css">

</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <img src="/img/logo-120.png" width="30" height="30" class="d-inline-block align-top" alt="">
          KelasProgramming.com
        </a>
      </nav> 
      
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
                <a href="/gambar/add" class="btn btn-sm btn-primary float-right">Add New</a>
                <h3>Senarai Gambar</h3>
              </div>

              <div class="col-12">

                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>

<?php foreach($gambar as $g) : ?>                    
                        <tr>
                            <td><?= $g['id'];?></td>
                            <td>
                            <img class="gambar-pekan" src="/img/<?= $g['nama_fail']?>" alt="">
                            </td>
                            <td>
                            <?= $g['nama']?>
                            </td>
                            <td>
                                <a href="/gambar/edit/<?= $g['id'];?>" class="btn btn-sm btn-primary">Edit</a>
                                <button href="/gambar/delete/<?= $g['id'];?>" onclick="confirm_delete( <?= $g['id'];?> )"  class="btn btn-sm btn-danger">Delete</button>

                            </td>
                        </tr>
<?php endforeach; ?>
                    </tbody>
                </table>

                <div id="my-pagination">
                <?= $pager->links() ?>
                </div>

                <!-- <nav aria-label="Page navigation example">
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
                  </nav> -->

              </div>
          </div>


      </div>
    

      <footer class="text-center p-5">
        <p>Hakcipta terpelihara &copy; 2021</p>
        
        </footer>

<script>

function confirm_delete( id ) {
    if ( confirm( 'Are you sure you want to delete record ID '+ id + '?' ) ) {
        window.location.href = '/gambar/delete/' + id;
    }
}

</script>

</body>
</html>


