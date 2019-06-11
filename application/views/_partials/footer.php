
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- SweetAlert2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
 
  <script>
    $('.cart').on('click', function() {
      var product_id      = $(this).data("produkid");
      var product_name    = $(this).data("produkname");
      var product_price   = $(this).data("produkprice");
      var quantity        = $('#' + product_id).val();
      var _token          = '<?php echo $this->security->get_csrf_token_name()?>';
        $.ajax({
          type: 'post',
          url: '<?php echo base_url('cart/add-cart') ?>',
          data: {_token: '<?php echo $this->security->get_csrf_hash() ?>', product_id: product_id, product_name: product_name, product_price: product_price, quantity: quantity},
          dataType: 'json',
          success: function(msg) {
            if (msg.status == false) {
                        swal(
                            'Error!',
                            (msg.alert),
                            'error'
                        )                      
                    } else {
                        swal(
                            'Success',
                            (msg.alert),
                            'success'
                        )
                    }
            setTimeout(function() {location.reload(); }, 3000);
          }, error: function(err) {
            console.log(err)
          }
        })
    })
    $('.delete-cart').on('click', function() {
      var row_id  = $(this).attr('id');
      //console.log(id);
        $.ajax({
          type: 'post',
          url: '<?php echo base_url('cart/delete') ?>',
          data: {_token : '<?php echo $this->security->get_csrf_hash() ?>', row_id: row_id},
          dataType: 'json',
          success: function(msg) {
            if (msg.status == false) {
                        swal(
                            'Error!',
                            (msg.alert),
                            'error'
                        )                      
                    } else {
                        swal(
                            'Success',
                            (msg.alert),
                            'success'
                        )
                    }
            setTimeout(function() {location.reload(); }, 3000);
          }, error: function(err){
            console.log(err)
          }
        })
    })
  </script>
</body>

</html>
