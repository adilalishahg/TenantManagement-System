<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        select: true
    });
});
// $('#dataTable').DataTable({
// 	select: true
// });
</script>
<script src="assets/js/main/flats.js"></script>
<script src="assets/js/main/user.js"></script>
<script src="assets/js/user/custom.js"></script>
<script src="assets/js/user/flat.js"></script>
<script src="assets/js/user/dash_board.js"></script>
<script src="assets/js/tower.js"></script>

<script src=<?php echo base_url("assets/js/custom.js") ?>></script>
<script src=<?php echo base_url("assets/vendor/jquery/jquery.min.js") ?>></script>
<script src=<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>></script>

<!-- Core plugin JavaScript-->
<script src=<?php echo base_url("assets/vendor/jquery-easing/jquery.easing.min.js") ?>></script>

<!-- Custom scripts for all pages-->
<script src=<?php echo base_url("assets/js/sb-admin-2.min.js") ?>></script>

<!-- Page level plugins -->
<script src=<?php echo base_url("assets/vendor/chart.js/Chart.min.js") ?>></script>

<!-- Page level custom scripts -->
<script src=<?php echo base_url("assets/js/demo/chart-area-demo.js") ?>></script>
<script src=<?php echo base_url("assets/js/demo/chart-pie-demo.js") ?>></script>

<!-- Page level plugins -->
<script src=<?php echo base_url("assets/vendor/datatables/jquery.dataTables.min.js") ?>></script>
<script src=<?php echo base_url("assets/vendor/datatables/dataTables.bootstrap4.min.js") ?>></script>


<!-- Page level custom scripts -->
<!-- <script src=<?php echo base_url("assets/js/demo/datatables-demo.js") ?>></script> -->

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</body>


</html>