<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<!------ Include the above in your HEAD tag ---------->
<!-- no additional media querie or css is required -->
<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <?php echo form_open('', 'id="form-login"') ?>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <button type="button" class="submit btn btn-primary btn-block">login</button>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- JQuery -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.js"></script>
<script>
    $('.submit').on('click', function() {
        var form_data = new FormData($('#form-login')[0]);
        $.ajax({
            type: 'post',
            url : '<?php echo base_url('login/process') ?>',
            data: form_data,
            processData : false,
            contentType: false,
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
                    setTimeout(function() {
                        window.location = '<?php echo base_url('administrator/') ?>';
                    }, 3000);
                }
                $('.submit').html("Login").removeAttr("disabled");
            }, error: function() {
                $('#form-login').html('<font color="red">Terjadi kesalahan, silakan refresh halaman ini.</font>');
            }
        })
    })
</script>