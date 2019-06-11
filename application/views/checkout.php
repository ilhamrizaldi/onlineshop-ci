<div class="col-lg-12">
        <div class="my-4">
        <?php if($total == null) { ?>
            <h2><center>Opps, anda belum menambahkan barang!</center></h2>
            <center><a href="<?php echo base_url() ?>" class="btn btn-success">BELANJA SEKARANG</a></center>
        <?php } else {?>
            <?php echo form_open('checkout/process') ?>
            <div class="col-md-12">
                <h2 style="text-align: center;">Konfirmasi Checkout</h2>
                <hr>
                <div class="card">
                    <table class="table table-striped" width="100%">
                        <tr>
                            <td>Total Belanja</td>
                            <td>Rp <?php echo number_format($total,0, '.', '.') ?></td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td><textarea name="note" cols="30" rows="3" class="form-control" placeholder="Ukuran, warna, rasa dll.."></textarea></td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="card">
                    <div class="col-md-12">
                        <br>
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">No Handphone</label>
                            <input type="text" class="form-control" name="hp">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat Lengkap</label>
                            <textarea name="alamat" id="" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Kode POS</label>
                            <input type="text" class="form-control" name="pos">
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Proses Order</button>
                </div>
             </div>
             <?php echo 
             form_close();
              ?>
        <?php } ?>
        </div>
</div>