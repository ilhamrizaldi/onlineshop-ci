
<div class="col-lg-12">
    <div class="row">
        <div class="col-md-12 my-4">
            <?php if($cart != null) {?>
            <div class="table-responsive">
            <?php echo form_open('', 'id="form-cart"') ?>
                <table class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th><center>#</center></th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cart as $cr) {?>
                            <tr>
                                <td><center><button id="<?php echo $cr['rowid'] ?>" class="delete-cart btn btn-danger"><span class="fa fa-trash"></span></button></center></td>
                                <td><?php echo $cr['name'] ?></td>
                                <td><?php echo number_format($cr['qty'],0, '.', '.') ?></div></td>
                                <td>Rp <?php echo number_format($cr['price'],0, '.', '.') ?></td>
                                <td>Rp <?php echo number_format($cr['subtotal'], 0, '.', '.') ?></td>
                            </tr>             
                        <?php } ?>
                        <tr>
                            <td colspan='4' align="center"><b>Total</b></td>
                            <th colspan='4'>Rp <?php echo number_format($total, 0, '.', '.') ?></th>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group col-md-4 float-left">
                    <a href="<?php echo base_url('product/') ?>" class="btn btn-success btn-block">Lanjutkan Belanja</a>
                </div>
                <div class="form-group col-md-4 float-right">
                    <a href="<?php echo base_url('checkout') ?>" class="btn btn-primary btn-block">Checkout</a>
                </div>
            <?php  echo form_close() ?>
            </div>
            <?php } else {?>
                    <h2><center>Opps, keranjang anda masih kosong!</center></h2>
                    <center><a href="<?php echo base_url() ?>" class="btn btn-success">BELANJA SEKARANG</a></center>
            <?php } ?>
        </div>
    </div>
</div>
