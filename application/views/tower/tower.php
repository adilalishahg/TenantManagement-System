<?php include_once(APPPATH . "views/includes/header.php"); ?>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Sidebar -->
		<?php include_once(APPPATH . "views/includes/sidebar.php"); ?>
		<!-- End of Sidebar -->
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<!-- <?php print_r($users); ?> -->
				<!-- Topbar -->
				<?php include_once(APPPATH . "views/includes/navbar.php"); ?>
				<!-- End of Topbar -->
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<div class="row">


					</div>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- End of Main Content -->
			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; Your Website 2021</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
	<!-- Alert Modal-->

	<div class="modal fade" id="flatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Book This Flat</h5>
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
	<script>
		$(document).ready(function() {

			var clickedElementId;
			var user = <?php echo $_SESSION['user_id'] ?>;
			$('div').on('click', function() {
				// Use the 'this' keyword to reference the clicked element

				if ($(this).hasClass('flat')) {
					// Use the 'this' keyword to reference the clicked element
					clickedElementId = $(this).attr('id');
					var faltName = $(this).attr('data-name');

					var price = $(this).attr('data-price');

					// Set the modal content dynamically
					$('#flatmodalContent').text('Do You want to book flat: ' + faltName + ' of rent :' +
						price);

					// Show the modal
					$('#flatModal').modal('show');
				}
			});
			// Attach a function to the click event of the element with ID "flatBookButton"
			$('#flatBookButton').on('click', function() {
				// Add your custom function logic here
				console.log('Logout button clicked for element with ID:', clickedElementId);
				var extractedValue = clickedElementId.split('flat_')[1];
				var userName = $(this).attr('data-user');
				// Close the modal	
				bookFlat(extractedValue)
				// $('#flatModal').modal('hide');
			});

			function bookFlat(flatId) {
				$('#flatModal').modal('hide');

				var formData = {
					flatId: flatId,
					userId: user,
				}
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url(); ?>register_flat',
					data: formData,
					success: function(response) {
						// Handle successful submission (you can redirect or show a success message)
						swal("Flat Registered!", "Flat Registered Successfully!", "success");


					},
					error: function(xhr, status, error) {


						swal("Oops!", "Something went wrong", "error");



						var errors = JSON.parse(xhr.responseText);

						$('.error-message').html('');

						// Display errors for each field
						$.each(errors, function(key, value) {
							$('#' + key).next('.error-message').html(
								'<span class="text-danger">' + value + '</span>');
						});
					}
				});
			}


		});
	</script>


























	<?php include_once(APPPATH . "views/includes/footer.php"); ?>