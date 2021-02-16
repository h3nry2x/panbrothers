</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-gradient-to-r from-gray-800 via-blue-600 to-green-300">
  <div class="container my-auto">
    <div class="copyright text-center my-auto text-white">
      <span>Copyright &copy; 2020. Point Of Sales <a href="<?php echo base_url(); ?>">Company</a>.</strong> All rights reserved.</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded bg-gradient-primary" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingin keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih <b>Keluar</b> untuk mengakhiri sesi.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-primary" href="<?php echo base_url() ?>Login/logout">Keluar</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() ?>assets/sbadmin2/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/chart.js/Chart.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/select2/js/select2.full.min.js"></script>

<!-- Sweetalert2 -->
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/sweetalert2/sweetalert2.min.js"></script>

<!-- Toastr -->
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/toastr/toastr.min.js"></script>

<!-- Barcode JS -->
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/jsbarcode/dist/JsBarcode.all.min.js"></script>

<!-- jQuery print -->
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/jqueryprint/dist/jQuery.print.min.js"></script>

<!-- jQuery Fullscreen -->
<script src="<?php echo base_url() ?>assets/sbadmin2/vendor/jqueryfullscreen/release/jquery.fullscreen.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url() ?>assets/sbadmin2/js/demo/chart-area-demo.js"></script>
<script src="<?php echo base_url() ?>assets/sbadmin2/js/demo/chart-pie-demo.js"></script>
<script type="text/javascript">
  $(function() {
    // check native support
    // $('#support').text($.fullscreen.isNativelySupported() ? 'supports' : 'doesn\'t support');

    // open in fullscreen
    $('#requestfullscreen').click(function() {
      $('#content-wrapper').fullscreen();
      return false;
    });

    // exit fullscreen
    $('#exitfullscreen').click(function() {
      $.fullscreen.exit();
      return false;
    });

    // document's event
    $(document).bind('fscreenchange', function(e, state, elem) {
      // if we currently in fullscreen mode
      if ($.fullscreen.isFullScreen()) {
        $('#requestfullscreen').hide();
        $('#exitfullscreen').show();
        $('#content-wrapper').addClass('overflow-auto');
      } else {
        $('#requestfullscreen').show();
        $('#exitfullscreen').hide();
        $('#content-wrapper').removeClass('overflow-auto');
      }

      // $('#state').text($.fullscreen.isFullScreen() ? '' : 'not');
    });
  });
</script>
</body>

</html>