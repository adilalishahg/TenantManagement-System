<?php include_once("includes/header.php"); ?>
<script>
function formatTime(inputTime) {
    const date = new Date(inputTime);

    const options = {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    };

    return new Intl.DateTimeFormat('en-GB', options).format(date);
}
</script>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once("includes/sidebar.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include_once("includes/navbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid h-75">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            <?php echo (ucfirst($_SESSION['first_name']) . ' ' . ucfirst($_SESSION['last_name']) . ' '); ?>
                            Dashboard
                        </h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <?php //include_once("utils/cards.php"); 
					?>
                    <!-- Content Row -->

                    <div class="row h-100">

                        <!-- Basic Card Example -->
                        <div class="card shadow mb-4 h-4 w-100">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Your Booking Detail</h6>
                            </div>
                            <div class="card-body">

                                <!-- Pending Requests Card Example -->
                                <?php foreach ($booking as $book) { ?>
                                <div class=" col-6 mb-4" id="<?php echo 	$book['flat_id']; ?>">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                                        Rent : RS <?php echo $book['amount']; ?> </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> Booked At :
                                                        <?php
															$bookedTime = $book['created_at'];
															echo '<script>document.write(formatTime("' . $bookedTime . '"));calculateDays("' . $bookedTime . '");</script>';
															?></div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> Flat :
                                                        <?php if ($book['type'] == 'A') {
																echo '5 Star Room';
															} else {
																echo 'Classic Room';
															} ?>
                                                        <br />
                                                        This Month Passed Days :<?php echo $book['passedDays']; ?>
                                                        <br />
                                                        Your Spent Days :<?php echo $book['spentDays']; ?>
                                                        <br />
                                                        This Month Pending Days :<?php echo $book['pendingDays']; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <?php } ?>
                            </div>
                        </div>
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
    <?php include_once("includes/footer.php"); ?>