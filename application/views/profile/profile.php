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

                <!-- Topbar -->
                <?php include_once(APPPATH . "views/includes/navbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-1">
                        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
                    </div>


                    <?php include_once(APPPATH . "views/profile/form.php"); ?>

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
    <?php include_once(APPPATH . "views/includes/footer.php"); ?>
    <script>
    $(document).ready(function() {
        console.log("sad")
        // const form = document.getElementsByClassName('user');
        const form = document.getElementById('user');

        const fileInput = document.getElementById('customFile2');
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const confirm_password = document.getElementById('confirm_password').value;
            const password = document.getElementById('password').value;
            const email = document.getElementById('email').value;
            const first_name = document.getElementById('first_name').value;
            const last_name = document.getElementById('last_name').value;
            const contactno = document.getElementById('contactno').value;
            // console.log(fileInput.files[0])

            const formData = new FormData();
            formData.append('image', fileInput.files[0]);
            formData.append('confirm_password', confirm_password);
            formData.append('password', password);
            formData.append('first_name', first_name);
            formData.append('email', email);
            formData.append('last_name', last_name);
            formData.append('contactno', contactno);
            // $.post('profile', formData, function(response) {
            // 		// Handle the response from the server
            // 		console.log(response);
            // 	})
            // 	.fail(function(error) {
            // 		// Handle errors
            // 		console.error('Error:', error);
            // 	});
            fetch('profile', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from PHP if needed
                    if (data.status == 'error') {
                        console.log(data.errors)
                        let newResponse = data.errors
                        $('.error').html('');

                        // Display errors next to respective form fields
                        Object.keys(newResponse).forEach(function(fieldName) {
                            var errorMessage = newResponse[fieldName];
                            console.log(errorMessage)
                            console.log(fieldName)
                            $('#' + fieldName + '_error').html('<span class="error">' +
                                errorMessage + '</span>');
                        });
                    }
                    if (data.status == 'success') {
                        $('.error').html('');
                        // $('.error').hide();
                        notification(message = data.message)

                        setTimeout(function() {
                            location.assign("<?php echo base_url(); ?>");
                        }, 1000);

                    }
                    if (data.status == 'img_error') {
                        // $('.error').html('');
                        // // $('.error').hide();
                        // console.log(data)
                        notification(message = data.errors)
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            // console.log(fileInput.files);
        })
    })
    </script>