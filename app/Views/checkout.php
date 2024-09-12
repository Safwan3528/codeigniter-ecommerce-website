<?= $this->extend('templates/front_layout') ?>

<?= $this->section('main-content') ?>

    <h3>Checkout</h3>


    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> </th>
                        <th>Product</th>
                        <th>Price</th>
                        <th width="15%">Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

<?php if(isset($_SESSION['cart']['items']) && (  count($_SESSION['cart']['items']) > 0 ) ) : ?>                
    <?php $counter = 0; ?>
    <?php $total_amount = 0; ?>
    <?php foreach( $_SESSION['cart']['items'] as $item) : ?>
                <tr>
                    <td><?= ++$counter;?></td>
                        <td><?= $item['nama'] ?></td>
                        <td><?= number_format( $item['harga'], 2) ?></td>
                        <td><?= $item['qty']?></td>
                        <td>RM <?= number_format($item['harga'] * $item['qty'], 2)?></td>
                    </tr>
    <?php $total_amount += ( $item['harga'] * $item['qty'] ); ?>
    <?php endforeach; ?>
    <tr>
        <td align="right" colspan="4"><strong>Total Amount</strong></td>
        <td><strong>RM <?= number_format( $total_amount ,2); ?></strong></td>
    </tr>
<?php else : ?>

    <tr>
        <td colspan="5" class="text-center" >
            Your cart is empty
        </td>
    </tr>

<?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

<hr>

<?php if (isset($_SESSION['form_failed'])) :?>
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Invalid data!</strong> Please complete form with valid information.</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

<?php endif; ?>

<form action="/checkout" method="POST">


<?php
    $nama_penuh_invalid = (isset($_SESSION['form_errors']['nama_penuh'])) ? 'is-invalid' : '';
    $nama_penuh_value = (isset($_SESSION['form_data']['nama_penuh'])) ? $_SESSION['form_data']['nama_penuh'] : '';
?>
<div class="form-group">
    <label for="nama_penuh">Nama Penuh</label>
    <input type="text" class="form-control <?= $nama_penuh_invalid?>" name="nama_penuh" id="nama_penuh" value="<?= $nama_penuh_value?>">
  </div>

    <div class="row">

    <?php
    $email_invalid = (isset($_SESSION['form_errors']['email'])) ? 'is-invalid' : '';
    $email_value = (isset($_SESSION['form_data']['email'])) ? $_SESSION['form_data']['email'] : '';
?>

        <div class="form-group col-sm-6">
            <label for="email">Email</label>
            <input type="email" class="form-control <?= $email_invalid?>" name="email" id="email" value="<?= $email_value?>">
        </div>

    <?php
    $nombor_telefon_invalid = (isset($_SESSION['form_errors']['nombor_telefon'])) ? 'is-invalid' : '';
    $nombor_telefon_value = (isset($_SESSION['form_data']['nombor_telefon'])) ? $_SESSION['form_data']['nombor_telefon'] : '';
    ?>

        <div class="form-group col-sm-6">
            <label for="email">Nombor Telefon</label>
            <input type="text" class="form-control <?= $nombor_telefon_invalid?>" name="nombor_telefon" id="nombor_telefon" value="<?=$nombor_telefon_value?>">
        </div>
    
    </div>

  <div class="form-group">
  <?php
    $alamat_1_invalid = (isset($_SESSION['form_errors']['alamat_1'])) ? 'is-invalid' : '';
    $alamat_1_value = (isset($_SESSION['form_data']['alamat_1'])) ? $_SESSION['form_data']['alamat_1'] : '';
    $alamat_2_value = (isset($_SESSION['form_data']['alamat_2'])) ? $_SESSION['form_data']['alamat_2'] : '';
    ?>
    <label for="alamat_1">Alamat</label>
    <input type="text" class="form-control mb-2 <?= $alamat_1_invalid?>" name="alamat_1" id="alamat_1" value="<?= $alamat_1_value?>">
    <input type="text" class="form-control" name="alamat_2" id="alamat_2" value="<?= $alamat_2_value?>">
  </div>

    <div class="row">
    <?php
    $poskod_invalid = (isset($_SESSION['form_errors']['poskod'])) ? 'is-invalid' : '';
    $poskod_value = (isset($_SESSION['form_data']['poskod'])) ? $_SESSION['form_data']['poskod'] : '';
    ?>        <div class="form-group col-sm-2">
        <label for="poskod">Poskod</label>
        <input type="text" class="form-control <?= $poskod_invalid?>" name="poskod" id="poskod" value="<?= $poskod_value?>">
    </div>

    <div class="form-group col-sm-6">
    <?php
    $daerah_invalid = (isset($_SESSION['form_errors']['daerah'])) ? 'is-invalid' : '';
    $daerah_value = (isset($_SESSION['form_data']['daerah'])) ? $_SESSION['form_data']['daerah'] : '';
    ?>        <label for="daerah">Dearah</label>
        <input type="text" class="form-control <?= $daerah_invalid?>" name="daerah" id="daerah" value="<?=$daerah_value?>">
    </div>

    <div class="form-group col-sm-4">
        <label for="negeri">Negeri</label>
        <?php
    $negeri_invalid = (isset($_SESSION['form_errors']['negeri'])) ? 'is-invalid' : '';
    $negeri_value = (isset($_SESSION['form_data']['negeri'])) ? $_SESSION['form_data']['negeri'] : null;
    ?>
        <?= form_dropdown('negeri', $negeri, $negeri_value, [ 'class' => 'form-control '.$negeri_invalid ]); ?>
    </div>
    
    </div>


  <button type="submit" class="btn btn-primary" name="payment_gateway" value="securepay">Bayar Dengan Online Banking</button>

  <button type="submit" class="btn btn-primary" name="payment_gateway" value="stripe">Bayar Dengan Stripe</button>

</form>


<?= $this->endSection() ?>
