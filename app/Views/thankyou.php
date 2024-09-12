<?= $this->extend('templates/front_layout') ?>

<?= $this->section('main-content') ?>

    <h3>Terima kasih atas pembelian anda</h3>


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

    <?php $counter = 0; ?>
    <?php foreach( $order_items as $item) : ?>
                <tr>
                    <td><?= ++$counter;?></td>
                        <td><?= $produk[ $item['produk_id']]['nama'] ?></td>
                        <td><?= number_format( $item['harga'], 2) ?></td>
                        <td><?= $item['qty']?></td>
                        <td>RM <?= number_format($item['harga'] * $item['qty'], 2)?></td>
                    </tr>
    <?php endforeach; ?>
    <tr>
        <td align="right" colspan="4"><strong>Total Amount</strong></td>
        <td><strong>RM <?= number_format( $order['total_amount'] ,2); ?></strong></td>
    </tr>

                </tbody>
            </table>

        </div>
    </div>



<?= $this->endSection() ?>
