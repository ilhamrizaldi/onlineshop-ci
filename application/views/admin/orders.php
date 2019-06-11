
<div class="content-wrapper">
    <section class="content-header">
        <h2>Data Orders</h2>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        Table
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <th>Invoice</th>
                                    <th>Pembeli</th>
                                    <th>Total Pembelian</th>
                                    <th>Catatan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                    <tbody>
                                    <?php if (count($trx) > 0) { ?>
                                    <?php foreach ($trx as $row) { ?>
                                        <tr>
                                        <td>
                                            <?php echo @$row->invoice ?>
                                        </td>
                                        <td>
                                            <?php echo @$row->customer ?>
                                        </td>
                                        <td>
                                             <?php echo number_format(@$row->total, 0, '.', '.') ?>
                                        </td>
                                        <td>
                                            <?php echo @$row->note ?>
                                        </td>
                                       <?php
                                            switch (@$row->status) {
                                                case 'waiting':
                                                    echo "<td><span class='label label-warning'>Menunggu Pembayaran</span></td>";
                                                    break;
                                                case 'paid':
                                                    echo "<td><span class='label label-success'>Pembayaran Berhasil</span></td>";
                                                    break;
                                                case 'shipped':
                                                    echo "<td><span class='label label-primary'>Pesanan anda sedang Dikirim</span></td>";
                                                    break;
                                                case 'canceled':
                                                    echo "<td><span class='label label-danger'>Pesanan anda dibatalkan</span></td>";
                                                    break;
                                                default:
                                                    echo "<td><span class='label label-warning'>Menunggu Pembayaran</span></td>";
                                                    break;
                                            }
                                        
                                       ?>
                                        <td>
                                            <center>
                                                <a href="<?php echo base_url('checkout/struk/'.@$row->invoice) ?>" class="label label-success"><i class="fa fa-print"></i></a>
                                                <a data-id="<?php echo @$row->invoice  ?>" class="view label label-primary" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                                                <a data-id="<?php echo @$row->invoice  ?>" class="delete label label-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                            </center>
                                        </td>
                                        </tr>
                                        <?php } ?>
                                <?php } else { ?>
                                        <tr>
                                        <td colspan='10' align='center'><small style='font-style: italic;'>Tidak ada data yang ditemukan</small></td>
                                        </tr>
                                <?php } ?>
                                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal Edit -->
    <div class="modal fade" id="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit data</h4>
              </div>
              <div class="modal-body">
              <?php echo form_open('', 'id="form-edit"') ?>
               <input type="hidden" name="invoice" id="invoice" >
                <div class="form-group">
                    <label for="">Status Pesanan</label>
                    <select name="status" id="status" class="form-control">
                        <option value=""></option>
                        <option value="waiting">Menunggu Pembayaran</option>
                        <option value="paid">Pembayaran Berhasil</option>
                        <option value="shipped">Pesanan anda sedang Dikirim</option>
                        <option value="canceled">Pesanan anda dibatalkan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Catatan</label>
                    <input type="text" name="note" id="note" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="edit btn btn-primary">Save changes</button>
              </div>
              <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/plugins/jquery/dist/jquery.min.js"></script>
<script>
    $('.view').on('click', function() {
            var id  = $(this).attr('data-id');
            $('#modal').modal({
                    backdrop: 'static',
                    show: true
            });
                $.ajax({
                    url: '<?php echo base_url('ajax/orders/preview/') ?>' + id,
                    dataType: 'json',
                    success:function(data) {
                        $('#invoice').val(data.invoice);
                        $('#status option:selected').text(data.status + ' ' + '(Selected)').val(data.status);
                        $('#note').val(data.note);
                    }, erorr:function(err){
                        console.log(err);
                    }
                })
        })
        $('.edit').on('click', function() {
            var form_data   = new FormData($('#form-edit')[0]);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('ajax/orders/edit')?>",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == false) {
                            swal(
                                'Error!',
                                (data.msg),
                                'error'
                            )                      
                        } else {
                            swal(
                                'Success',
                                (data.msg),
                                'success'
                            )
                        }
                        $('.edit').html("Simpan").removeAttr("disabled");
                        setTimeout(function() {location.reload(); }, 3000);
                    }, error: function() {
                        $('#form-ajax').html('<font color="red">Terjadi kesalahan, silakan refresh halaman ini.</font>');
                    }
                })
        })
        $('.delete').on('click', function() {
            var _token = '<?php echo $this->security->get_csrf_token_name()?>';
            var id  = $(this).attr('data-id');
            //console.log(id);
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url('ajax/orders/delete') ?>',
                    data: { _token: '<?php echo $this->security->get_csrf_hash() ?>', id: id },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == false) {
                            swal(
                                'Oopss!',
                                (data.msg),
                                'error'
                            )                      
                        } else {
                            swal(
                                'Success',
                                (data.msg),
                                'success'
                            ) 
                        }
                        setTimeout(function() {location.reload(); }, 3000);
                    }, error: function(err) {
                        console.log(err)
                    }
                });
        });
</script>
