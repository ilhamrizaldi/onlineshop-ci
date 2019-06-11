
  <!-- Page Content -->
  <div class="container">

    <div class="row">

    <div class="col-lg-3">
     
        <h4 class="my-4">Brand</h4>
        <div class="list-group">
          <?php foreach($brand as $brd) {?>
            <a href="<?php echo base_url('product/brand/'.@$brd->value) ?>" class="list-group-item"><?php echo @$brd->name ?></a>
          <?php } ?>
        </div>
      </div> <!-- /.col-lg-3 -->