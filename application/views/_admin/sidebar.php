<aside class="main-sidebar">
            <section class="sidebar">
                <!-- Main Sidebar in here -->
                <div class="user-panel">
    <div class="pull-left image">
        <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p><?php echo $this->session->userdata('username') ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
    <li class="treeview menu-open">
        <a href="#">
            <i class="fa fa-pencil-square-o"></i> <span>Manage Data</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('administrator/data-orders') ?>"><i class="fa fa-circle-o"></i>Data Orders</a></li>        
        </ul>
    </li>
    <li class="treeview menu-open">
        <a href="#">
            <i class="fa fa-pencil"></i> <span>Data Input</span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('administrator/input-product') ?>"><i class="fa fa-circle-o"></i>Input Product</a></li>
            <li><a href="<?php echo base_url('administrator/input-category') ?>"><i class="fa fa-circle-o"></i>Input Category</a></li>
            <li><a href="<?php echo base_url('administrator/input-brand') ?>"><i class="fa fa-circle-o"></i>Input Brand</a></li>
        </ul>
    </li>
    <li class="treeview menu-open">
        <a href="#">
            <i class="fa fa-file"></i> <span>Page</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('administrator/discovery') ?>"><i class="fa fa-circle-o"></i>Discovery</a></li>     
        </ul>
    </li>
    </ul>            
</section>
        </aside>
        <!-- End Sidebar -->
