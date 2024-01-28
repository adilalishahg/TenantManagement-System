<?php include_once("includes/header.php") ?>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post" action="<?php echo base_url(); ?>register">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="first_name" class="form-control form-control-user"
                                            id="exampleFirstName" placeholder="First Name"
                                            value="<?php echo set_value('first_name', isset($first_name) ? $first_name : ''); ?>">
                                        <?php echo form_error('first_name', '<span class="error">', '</span>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="last_name" class="form-control form-control-user"
                                            id="exampleLastName" placeholder="Last Name"
                                            <?php echo set_value('last_name', isset($last_name) ? $last_name : ''); ?>>
                                        <?php echo form_error('last_name', '<span class="error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user"
                                        id="exampleInputEmail" placeholder="Email Address"
                                        <?php echo set_value('email', isset($email) ? $email : ''); ?>>
                                    <?php echo form_error('email', '<span class="error">', '</span>'); ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="contactno" class="form-control form-control-user"
                                            id="exampleInputContact" placeholder="Contact Number"
                                            <?php echo set_value('contactno', isset($contactno) ? $contactno : ''); ?>>
                                        <?php echo form_error('contactno', '<span class="error">', '</span>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-select" id="role" name="role">
                                            <option value="">Select Role</option>
                                            <option value="1"
                                                <?php echo set_select('role', '1', isset($role) && $role == '1'); ?>>
                                                Admin</option>
                                            <option value="2"
                                                <?php echo set_select('role', '2', isset($role) && $role == '2'); ?>>
                                                Manager</option>
                                            <option value="3"
                                                <?php echo set_select('role', '3', isset($role) && $role == '3'); ?>>
                                                User</option>
                                        </select>
                                        <?php echo form_error('role', '<span class="error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                        <?php echo form_error('password', '<span class="error">', '</span>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="confirm_password"
                                            class="form-control form-control-user" id="exampleRepeatPassword"
                                            placeholder="Repeat Password">
                                        <?php echo form_error('confirm_password', '<span class="error">', '</span>'); ?>
                                    </div>
                                </div>
                                <button type="submit" name="submit" value="register"
                                    class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
									<i class="fab fa-google fa-fw"></i> Register with Google
								</a>
								<a href="index.html" class="btn btn-facebook btn-user btn-block">
									<i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
								</a> -->
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include_once("includes/footer.php"); ?>