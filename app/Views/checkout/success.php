<?= $this->extend('templates/front_layout') ?>

<?= $this->section('main-content') ?>

    <h3>Terima kasih atas pembelian anda.</h3>

    <table class="table table-bordered">

        <tbody>
        <tr>
                <td>Date</td>
                <td><?= $order['created_at']?></td>
            </tr>
        <tr>
                <td>Order Number</td>
                <td><?= $order['order_no']?></td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td><?= $order['total_amount']?></td>
            </tr>
        </tbody>
    </table>
<p>&nbsp;</p>

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
                        <td><?php
                        foreach($produk as $p) {
                            if ($p['id'] == $item['produk_id']) { 
                                echo $p['nama']; 
                                break;
                            }
                        }
                        ?></td>
                        <td>RM <?=  number_format( $item['harga'], 2) ?></td>
                        <td><?= $item['qty']?></td>
                        <td>RM <?= number_format($item['harga'] * $item['qty'], 2)?></td>
                    </tr>
    <?php endforeach; ?>

                </tbody>
            </table>



<?= $this->endSection(); ?>