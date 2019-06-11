<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?php echo base_url() ?>">Online Shop</a>
      <!-- dropdown container -->
        <div class="dropdown">

        <!-- trigger button -->
        <cat>Kategori</cat>

        <!-- dropdown menu -->
        <ul class="dropdown-menu">
        <?php foreach($category as $cat) {?>
                    <li><a href="<?php echo base_url('product/category/'.@$cat->value) ?>"><?php echo $cat->name ?></a></li>
          <?php } ?>
        </ul>
      </div>
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      <form class="form-inline mt-2 mt-md-0" action="<?php echo base_url('product') ?>">
            <input class="form-control mr-sm-2" type="text" placeholder="Cari produk.." aria-label="Search" name="search" value="<?php set_value('search') ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
       </form>
       <div class="dropdown">

        <!-- trigger button -->
        <cat> Brand</cat>

        <!-- dropdown menu -->
        <ul class="dropdown-menu">
        <?php foreach($brand as $brd) {?>
                    <li><a href="<?php echo base_url('product/brand/'.@$brd->value) ?>"><?php echo @$brd->name ?></a></li>
          <?php } ?>
        </ul>
        </div>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('cart') ?>"><span class="fa fa-shopping-bag fa-lg"></span> <i class="badge badge-primary"><?php echo $jcart ?></i> </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>