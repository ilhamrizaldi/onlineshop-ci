
        <div class="col-lg-12">
        <?php if ($detail != null) {?>
            <?php foreach($detail as $tail) {?>
                <div class="row">
                    <div class="my-4 col-md-6">
                        <img class="card-img-top" src="<?php echo base_url('assets/images/product/'.@$tail->image) ?>" >
                    </div>
                    <div class="my-4 col-md-6">
                            <h2><?php echo @$tail->name ?></h2>
                            <h4 style="color: red;">Rp <?php echo number_format(@$tail->price, 0, '.', '.') ?></h4>
                            <hr>
                            <div class="form-group">
                            <span for="">Jumlah</span>
                            <input type="number" class="form-control col-md-2" id="<?php echo @$tail->id ?>" value="1">
                            </div>
                            <p>Bagikan ke :</p>
                            <div class="post-share">

                                <a href="javascript:void(0)"
                                    onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('product/detail/'.$tail->slug) ?>', 'Share This Post', 'width=640,height=450');return false"
                                    class="btn btn-primary">
                                    <i class="fa fa-facebook"></i>
                                    <span class="hidden-sm">Facebook</span>
                                </a>


                                <a href="javascript:void(0)"
                                    onclick="window.open('https://plus.google.com/share?url=<?php echo base_url('product/detail/'.$tail->slug) ?>', 'Share This Post', 'width=640,height=450');return false"
                                    class="btn btn-danger">
                                    <i class="fa fa-google-plus"></i>
                                    <span class="hidden-sm">Google</span>
                                </a>

                                <a href="https://api.whatsapp.com/send?text=<?php echo $tail->name ?> Kunjungi di <?php echo base_url('product/detail/'.$tail->slug) ?><?php echo base_url('product/detail/'.$tail->slug) ?>" target="_blank"
                                    class="btn btn-success">
                                    <i class="fa fa-whatsapp"></i>
                                    <span class="hidden-sm">Whatsapp</span>
                                </a>


                            </div>
                            <br>
                            <div class="form-group">
                            <?php if (@$tail->status == 'sold') {?>
                                <button class="cart btn btn-danger btn-block"  disabled="disabled"><i class="fa fa-times"></i> Sold Out</button>
                            <?php } else { ?>
                                <button type="submit" class="cart btn btn-success btn-block" data-produkid="<?php echo @$tail->id ?>" data-produkname="<?php echo @$tail->name ?>" data-produkprice="<?php echo @$tail->price ?>"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="my-4 col-md-12">
                        <table class="table table-striped" width="100%">
                            <tr>
                                <td>Stock</td>
                                <td><?php echo number_format(@$tail->stock, 0, '.', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Status Barang</td>
                                <?php switch (@$tail->status) {
                                    case 'ready':
                                       echo "<td><span class='badge badge-success'>Ready Stock</span>";
                                        break;
                                    
                                    default:
                                       echo "<td><span class='badge badge-danger'>Sold Out</span>";
                                        break;
                                } ?>
                            </tr>
                            <tr>
                                <td>Dilihat</td>
                                <td><?php echo number_format(@$tail->view, 0, '.', '.') ?></td>
                            </tr>
                        </table>
                        <div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Deskripsi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Ulasan</a>
                            </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab"><p><?php echo @$tail->description ?></p></div>
                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">...</div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <?php } ?>
        <?php } else { redirect('/','refresh'); } ?>
    </div>
</div>