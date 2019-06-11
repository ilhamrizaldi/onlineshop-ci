<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
      <div class="col-lg-12">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <!-- Img size 579x194 -->
              <img class="img-slide" src="https://ecs7.tokopedia.net/img/cache/1242/banner/2019/5/15/20723472/20723472_ba0fc220-d863-4dcb-a4f2-72f83041e872.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="img-slide" src="https://ecs7.tokopedia.net/img/cache/1242/banner/2019/5/15/20723472/20723472_ba0fc220-d863-4dcb-a4f2-72f83041e872.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="img-slide" src="https://ecs7.tokopedia.net/img/cache/1242/banner/2019/5/15/20723472/20723472_ba0fc220-d863-4dcb-a4f2-72f83041e872.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <ol class="breadcrumb">
            <li>Produk Terbaru</li>
        </ol>
        <div class="row">
        <?php if($latest != null) {?>
      <?php foreach($latest as $lts) {?>
          <div class="col-lg-3 col-md-3 mb-3">
                <div class="card h-60">
                  <a href="<?php echo base_url('product/detail/'.@$lts->slug) ?>"><img class="card-img-top" src="<?php echo base_url('assets/images/product/'.@$lts->image) ?>" alt=""></a>
                  <div class="card-body" style="min-height: 160px;">
                    <p class="card-title judul">
                      <?php echo substr(@$lts->name, 0, 50) ?>
                    </p>
                    <p><span class="badge badge-success">New Produk</span></p>
                    <h5>Rp <?php echo number_format(@$lts->price, 0, '.', '.') ?></h5>
                    <p class="brand"><i class="fa fa-industry"></i> <?php echo @$lts->brand ?></p>
                    </div>
                  <div class="card-footer">
                      <a href="<?php echo base_url('product/detail/'.@$lts->slug) ?>" class="btn btn-primary btn-block" ><i class="fa fa-eye"></i> Preview</a>
                  </div>
                </div>
              </div>
      <?php } ?>
      <?php } else { ?>
          <div class="col-lg-12 col-md-12 mb-3"><p class="text-center" style="font-family: code;">Oopps, Product not found!</p></div>
      <?php } ?>
        </div>
        
      <!-- Product -->
      <ol class="breadcrumb">
            <li>Semua Produk</li>
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
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->
  