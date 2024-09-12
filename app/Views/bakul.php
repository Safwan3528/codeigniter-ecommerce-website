<?= $this->extend('templates/front_layout') ?>



<?= $this->section('hero') ?>
    <h1>Hero is here</h1>
<?= $this->endSection(); ?>



<?= $this->section('main-content') ?>
    <div class="row">
        <div class="col-12"><h2><a href="/" class="btn btn-sm btn-primary">Back</a>  Your Shopping Cart</h2></div>
    </div>
    <?php if (isset($_SESSION['success'])) :?>
            <div class="row">
                <div class="col">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Cart updated!</strong> Quantity and items have been updated</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
<?php endif; ?>

<?php if (isset($_SESSION['empty'])) :?>
            <div class="row">
                <div class="col">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Empty cart!</strong> Your cart is empty. Nothing to update.</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
<?php endif; ?>


    <div class="row">
        <div class="col-12">
<form action="/bakul/update" method="POST">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> </th>
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
                        <td>
                            <a href="#" class="btn btn-danger btn-sm" onclick="confirm_remove(<?= $item['id']?>)">REMOVE</a>
                        </td>
                        <td><?= $item['nama'] ?></td>
                        <td><?=  number_format( $item['harga'], 2) ?></td>
                        <td><input type="number" step="1" name="qty[<?= $item['id']?>]" value="<?= $item['qty']?>" class="form-control"></td>
                        <td>RM <?= number_format($item['harga'] * $item['qty'], 2)?></td>
                    </tr>
    <?php $total_amount += ( $item['harga'] * $item['qty'] ); ?>
    <?php endforeach; ?>
    <tr>
        <td align="right" colspan="5"><strong>Total Amount</strong></td>
        <td><strong>RM <?= number_format( $total_amount ,2); ?></strong></td>
    </tr>
<?php else : ?>

    <tr>
        <td colspan="6" class="text-center" >
            Your cart is empty
        </td>
    </tr>

<?php endif; ?>
                </tbody>
            </table>

            <a href="/checkout" class="btn btn-primary float-right">Checkout</a>

            <button class="btn btn-info mr-1 float-right">Update Cart</button>

            </form>

        </div>
    </div>



    <script>

function confirm_remove( id ) {
    if ( confirm( 'Are you sure you want to remove this product from cart?' ) ) {
        window.location.href = '/bakul/remove/' + id;
    }
}
</script>

<?= $this->endSection() ?>