<?php if($barang == null) {?>
    <h2><center>Opps, Barang sudah tidak ada!</center></h2>
    <center><a href="<?php echo base_url() ?>" class="btn btn-success">BELANJA SEKARANG</a></center>
    <br>
<?php }else{ ?>
<div class="col-lg-6 mx-auto">
    <div class="my-4">
        <p>Terima kasih telah melakukan pembelian di online shop kami, Pesanan anda sudah kami terima , mohon segera lunasi pembayaran. Berikut detail pesanan anda.</p>
        <center><h2>Invoice</h2></center>
        <br>
        <table width="100%"> 
            <tr>
                <td><span style="margin-bottom: 3px; font-weight: 600; display: block;">NO #<?php echo $this->uri->segment(3); ?></span></td>
            </tr>
        </table>
        <div class="card">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($barang as $brg) {?>
                                <tr>
                                    <td><?php echo $brg->product_name ?></td>
                                    <td><?php echo $brg->product_qty ?></td>
                                    <td><?php echo $brg->product_price ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan='2' align="center"><b>Total</b></td>
                                <th colspan='3'>Rp <?php echo number_format($brg->total, 0, '.', '.') ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- separator -->
        <div style="margin: 30px 0;">
            <div style="border-bottom: thin dashed #474747; margin-bottom: 10px;"></div>
            <div style="border-bottom: thin dashed #474747"></div>
        </div>
        <div class="card">
        <table class="table table-striped" width="100%">
        <tr>
            <td style="font-weight: 600; font-size: 14px;padding-bottom: 8px;">Tujuan Pengiriman:</td>
        </tr>
        <tr>
            <td style="font-size: 12px; padding-bottom: 20px;">
            <?php foreach($alamat as $alm) {?>
                <span style="margin-bottom: 3px; font-weight: 600; display: block;"><?php echo $alm->name ?></span>
                <div>
                    <?php echo $alm->alamat ?>
                    <p><?php echo $alm->hp ?></p>
                </div>
            <?php } ?>
            </td>
        </tr>
        </table>
        </div>
    </div>
    <div class="form-group">
            <a href="<?php echo base_url('checkout/struk/'.$this->uri->segment(3)) ?>" class="btn btn-primary btn-block"><i class="fa fa-print"></i> CETAK STRUK</a>
        </div>  
</div>
<?php } ?>