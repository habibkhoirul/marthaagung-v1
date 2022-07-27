</div>

</div>

    <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/js/jquery.js"><\/script>')</script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo base_url() ?>assets/js/moment.js"></script>
    <script src="<?php echo base_url() ?>/assets/select2/dist/js/select2.min.js"></script>
  
    <?php if(isset($tabel_plugin) && ($tabel_plugin == 1)) { ?>
    <script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>
    <?php } ?>

    <script>
      <?php if($this->session->flashdata('print_popup-jual')) { ?>
              window.open("<?php echo base_url().'Penjualan/nota/'.$this->session->flashdata('print_popup-jual')?>", width=330, height=330, left=100, top=25);
      <?php } 
            elseif ($this->session->flashdata('print_popup-beli')) { ?>
              window.open("<?php echo base_url().'Pembelian/nota/'.$this->session->flashdata('print_popup-beli')?>", width=330, height=330, left=100, top=25);
      <?php }
      ?>

      $(document).ready(function () {
          $('#sidebarCollapse').on('click', function () {
              $('#sidebar').toggleClass('active');
          });

          <?php if(isset($tabel_plugin) && ($tabel_plugin == 1)) { ?>
            $('#tabel').DataTable();
            $('#tabel2').DataTable();
          <?php } ?>

          <?php if(isset($date_plugin) && ($date_plugin == 1)) { ?>
            moment().locale();
            d = moment().format('YYYY-MM-DD');
            $('#tgl_now').val(d);
          <?php } ?>

          <?php if(isset($javascript) && ($javascript == 1)) { ?> 
            $('#uang_bayar').change(function(){
              tot=parseInt($('#hid_total').val());
              bay=parseInt($('#uang_bayar').val());
              kem=bay-tot;
              $('#kembalian').val(kem);
            });
          <?php }?>

          <?php if(isset($select2) && ($select2 == 1)) { ?>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
          <?php } ?>

          $(window).on('load resize', function() {
              if($(window).width() > 768) {
                  $('#sidebarToggler').hide();
                  $('#breadcumb').show();
              }else{
                  $('#sidebarToggler').show();
                  $('#breadcumb').hide();              }
          })

      });
    </script>
    
  </body>
</html>