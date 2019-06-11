<div class="content-wrapper">
    <section class="content-header">
        <h1>Input Brand</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">Input</div>
                    </div>
                    <div class="box-body">
                        <?php echo form_open('', 'id="form-input"') ?>
                         <!-- Col 1 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Brand Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Value</label>
                                    <input type="text" class="form-control" name="value">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" class="submit btn btn-primary btn-block">Tambah</button>
                                </div>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
          <!-- Table -->
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
    <div class="box-header">
        <div class="box-title">Table</div>
    </div>
    <div class="box-body">
        <div class="col-md-12 table-responsive">
            <table id="myTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name brand</th>
                        <th>Value</th>
                        <th><center>Action</center></th>
                    </tr>
                </thead>
                <tbody>
                <?php if (count($brand) > 0) { ?>
                        <?php foreach ($brand as $row) { ?>
                            <tr>
                            <td>
                                <?php echo @$row->name ?>
                            </td>
                            <td>
                                <?php echo @$row->value ?>
                            </td>
                            <td>
                                <center>
                                    <a data-id="<?php echo @$row->id  ?>" class="view label label-primary" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                                    <a data-id="<?php echo @$row->id  ?>" class="delete label label-danger" title="Delete"><i class="fa fa-trash"></i></a>
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
               <input type="hidden" name="id" id="id" >
                <div class="form-group">
                    <label for="">Name brand</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Value</label>
                    <input type="text" name="value" id="value" class="form-control">
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
     $('.submit').on('click', function() {
            $(this).html("Sedang mengupload...").attr("disabled", "disabled");
            var form_data = new FormData($('#form-input')[0]);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('ajax/brand/input')?>",
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
                    $('.submit').html("Simpan").removeAttr("disabled");
                    setTimeout(function() {location.reload(); }, 3000);
                }, error: function() {
                    $('#form-ajax').html('<font color="red">Terjadi kesalahan, silakan refresh halaman ini.</font>');
                }
            });
        });
        $('.view').on('click', function() {
            var id  = $(this).attr('data-id');
            $('#modal').modal({
                    backdrop: 'static',
                    show: true
            });
                $.ajax({
                    url: '<?php echo base_url('ajax/brand/preview/') ?>' + id,
                    dataType: 'json',
                    success:function(data) {
                        $('#id').val(data.id);
                        $('#name').val(data.name);
                        $('#value').val(data.value);
                    }, erorr:function(err){
                        console.log(err);
                    }
                })
        })
        $('.edit').on('click', function() {
            var form_data   = new FormData($('#form-edit')[0]);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('ajax/brand/edit')?>",
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
                    url: '<?php echo base_url('ajax/brand/delete') ?>',
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