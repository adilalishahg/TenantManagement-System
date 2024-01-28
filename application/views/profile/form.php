<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
            <div class="col-lg-12">
                <div class="p-5">
                    <form class="user" id="user" method="post" action="<?php echo base_url(); ?>profile"
                        enctype="multipart/form-data">
                        <div class="form-row">



                            <!--Avatar-->
                            <div class="align-content-center container d-flex flex-column justify-content-center">
                                <div class="d-flex justify-content-center mb-4">
                                    <img id="selectedAvatar" name='profile_img'
                                        src=<?php echo ((isset($profile_img) && $profile_img != '') ? base_url() . $profile_img : 'https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg'); ?>
                                        class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;"
                                        alt="example placeholder" />
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="btn btn-primary btn-rounded">
                                        <label class="form-label text-white m-1" for="customFile2">Choose file</label>
                                        <input type="file" class="form-control d-none" id="customFile2"
                                            onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Image-->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail">First Name</label>
                                <input type="text"
                                    value=<?php echo set_value('first_name', isset($first_name) ? $first_name : ''); ?>
                                    name="first_name" class="form-control form-control-user" id="first_name"
                                    aria-describedby="first_nameHelp" placeholder="Enter First Name...">
                                <span id="first_name_error" class="error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword">Last Name</label>
                                <input type="text"
                                    value=<?php echo set_value('last_name', isset($last_name) ? $last_name : ''); ?>
                                    name="last_name" class="form-control form-control-user" id="last_name"
                                    placeholder="Last Name">
                                <span id="last_name_error" class="error"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail">Email</label>
                                <input type="email" name="email"
                                    value=<?php echo set_value('email', isset($email) ? $email : ''); ?>
                                    class="form-control form-control-user" id="email" aria-describedby="emailHelp"
                                    placeholder="Enter Email Address...">
                                <span id="email_error" class="error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword">Contact No:</label>
                                <input type="text" name="contactno" class="form-control form-control-user"
                                    id="contactno" placeholder="Contact Number"
                                    value=<?php echo set_value('contactno', isset($contact_no) ? $contact_no : ''); ?>>
                                <span id="contactno_error" class="error"></span>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword"> Password</label>
                                <input type="password" name="password" class="form-control form-control-user"
                                    id="password" placeholder="Password">
                                <span id="password_error" class="error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control form-control-user"
                                    id="confirm_password" placeholder="Repeat Password">
                                <span id="confirm_password_error" class="error"></span>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <button name="submit" value="save" class="btn btn-primary btn-user btn-block ">
                                    Save
                                </button>
                            </div>
                            <div class="form-group col-md-6">
                                <button name="reset" value="reset"
                                    onclick="location.href='<?php echo base_url(); ?>profile'"
                                    class="btn btn-danger btn-user btn-block ">
                                    Reset
                                </button>
                            </div>
                        </div>

                    </form>
                    <hr>

                </div>

            </div>
        </div>
    </div>
</div>
<script>
function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
            console.log(selectedImage);
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}
</script>