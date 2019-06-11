
        <div class="col-lg-12 my-4">
            <ol class="breadcrumb">
                    <li>Menampilkan <?php echo number_format(count($product), 0, '.', '.') ?> dari hasil pencarian <i><?php echo $this->uri->segment(3) ?></i></li>
            </ol>
            
            <div class="row">
            <?php if($product != null) {?>
            <?php foreach($product as $prd) {?>
                <div class="col-lg-3 ol-md-3 mb-3">
                <div class="card h-60">
                  <a href="<?php echo base_url('product/detail/'.@$prd->slug) ?>"><img class="card-img-top" src="<?php echo base_url('assets/images/product/'.@$prd->image) ?>" alt=""></a>
                  <div class="card-body" style="min-height: 120px; ">
                    <p class="card-title judul">
                      <?php echo substr(@$prd->name, 0, 50) ?>
                    </p>
                    <p><h5>Rp <?php echo number_format(@$prd->price, 0, '.', '.') ?></h5></p>
                    <p class="brand"><i class="fa fa-industry"></i> <?php echo @$prd->brand ?></p>
                    <p><table width="100%"><td width="80%">Jumlah</td> <td><input type="number" id="<?php echo @$prd->id ?>" style="width: 100%;" value="1"></td></table></p>
                  </div>
                  <div class="card-footer">
                  <?php if (@$prd->status == 'sold') {?>
                      <button class="cart btn btn-danger btn-block"  disabled="disabled"><i class="fa fa-times"></i> Sold Out</button>
                  <?php } else { ?>
                    <button type="submit" class="cart btn btn-success btn-block" data-produkid="<?php echo @$prd->id ?>" data-produkname="<?php echo @$prd->name ?>" data-produkprice="<?php echo @$prd->price ?>"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                  <?php } ?>
                  </div>
                </div>
              </div>
            <?php } ?>
            <?php } else { ?>
                <div class="col-lg-12 col-md-12 mb-3"><p class="text-center" style="font-family: code;">Oopps, Product not found!</p></div>
            <?php } ?>
        </div> <!-- /.row -->
        </div>
    </div>
</div>