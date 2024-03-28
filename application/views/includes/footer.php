<!-- Bootstrap Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabelDynamic"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modalBody">
				<!-- Content will be dynamically inserted here -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
    </div>
</div>

<!-- Bootstrap Modal -->
<!-- Flat Modal -->

<div class="modal fade" id="flatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Book This Flat</h5>
                <input type='hidden' name='booking_id' id='booking_id'>
                <input type='hidden' name='booker_name' id='booker_name'>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- Use a placeholder element to dynamically set the modal content -->
            <div class="modal-body" id="flatmodalContent"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" id="flatBookButton" href="#">Book</a>
            </div>
        </div>
    </div>
</div>
<!-- Flat Modal -->
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
	$('.datepicker').datepicker();
});
// $('#dataTable').DataTable({
// 	select: true
// });
</script>
<script src=<?php echo base_url("assets/js/main/flats.js") ?>></script>
<script src=<?php echo base_url("assets/js/main/user.js") ?>></script>
<script src="<?php echo base_url('assets/js/user/invoice_ajax.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/main/employee.js'); ?>"></script>
<script src=<?php echo base_url("assets/js/custom.js") ?>></script>
<script src=<?php echo base_url("assets/js/dash_board.js") ?>></script>
<script src=<?php echo base_url("assets/js/flat.js") ?>></script>
<script src=<?php echo base_url("assets/js/tower.js") ?>></script>
<script src=<?php echo base_url("assets/js/reports.js") ?>></script>


<script src=<?php echo base_url("assets/vendor/jquery/jquery.min.js") ?>></script>
<script src=<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>></script>
<!-- Include Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


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
