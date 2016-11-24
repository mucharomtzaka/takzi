<footer class="main-footer text-center">
    <?php echo $footer_title;?> All rights
    reserved.<br> <?php echo $name_company;?> &nbsp; &nbsp; Address: <?php echo $address_company;?>&nbsp; &nbsp; Contact :  <?php echo $contact_company;?>
  </footer>

</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('plugins/jQuery/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-session-timeout.js');?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>

<!-- FastClick -->
<script src="<?php echo base_url('plugins/fastclick/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('dist/js/app.min.js');?>"></script>
<script src="<?php echo base_url('plugins/ckeditor/ckeditor.js');?>"></script>
<script src="<?php echo base_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/tambahan.js');?>"></script>
<?php if($this->ion_auth->logged_in()){?>
<script>
$.sessionTimeout({
                      keepAliveUrl:'',
                      logoutUrl:"<?php echo base_url('auth/logout/timeout');?>",
                      warnAfter: 200000,
                      redirAfter: 300000,
                     /* onStart: function () {
                          $('.jumbotron').css('background', '#398439').find('p').addClass('hidden');
                          $('#fine').removeClass('hidden')
                      },
                      onWarn: function () {
                          $('.jumbotron').css('background', '#b92c28').find('p').addClass('hidden');
                          $('#warn').removeClass('hidden')
                      },*/
                      onRedir: function (opt) {
                          window.location = opt.logoutUrl;
                      }
        });
</script>
<?php } ?>
</body>
</html>
