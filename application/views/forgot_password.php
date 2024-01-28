 <?php include_once("includes/header.php"); ?>

 <body class="bg-gradient-primary">

     <div class="container">

         <!-- Outer Row -->
         <div class="row justify-content-center">

             <div class="col-xl-10 col-lg-12 col-md-9">

                 <div class="card o-hidden border-0 shadow-lg my-5">
                     <div class="card-body p-0">
                         <!-- Nested Row within Card Body -->
                         <div class="row">
                             <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                             <div class="col-lg-6">
                                 <div class="p-5">
                                     <div class="text-center">
                                         <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                         <p class="mb-4">We get it, stuff happens. Just enter your email address
                                             below
                                             and we'll send you a link to reset your password!</p>
                                     </div>
                                     <form class="user" id="user" action="forgot" method="post">
                                         <div class="form-group">
                                             <input type="email" class="form-control form-control-user"
                                                 id="exampleInputEmail" aria-describedby="emailHelp"
                                                 placeholder="Enter Email Address...">
                                             <span id="email_error" class="error"></span>

                                         </div>
                                         <button type="submit" class="btn btn-primary btn-user btn-block">
                                             Reset Password
                                         </button>
                                     </form>
                                     <hr>
                                     <div class="text-center">
                                         <a class="small" href="register">Create an Account!</a>
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

         </div>







     </div>
     <?php include_once('includes/footer.php'); ?>
     <script>
     $(document).ready(function() {
         console.log("sad")
         // const form = document.getElementsByClassName('user');
         const form = document.getElementById('user');

         const fileInput = document.getElementById('customFile2');
         form.addEventListener('submit', (event) => {
             event.preventDefault();
             const email = document.getElementById('exampleInputEmail').value;


             // console.log(fileInput.files[0])

             const formData = new FormData();

             formData.append('email', email);



             fetch('forgot', {
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

                             $('#' + fieldName + '_error').html('<span class="error">' +
                                 errorMessage + '</span>');
                         });
                     }

                 })
                 .catch(error => {
                     console.error('Error:', error);
                 });

             // console.log(fileInput.files);
         })















     })
     </script>