<?php require "../top/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php

//prevent direct to other pages when logged in

if(isset($_SESSION['username'])){
  header("location: ".APPURL."");
}

  // check the data inserted using POST method
  if(isset($_POST['submit'])){

    //if any of this credentials empty it will show error
    if (empty($_POST['username']) OR empty($_POST['email']) OR empty($_POST['password'])){
      echo "<script> alert('some inputs are required');</script>";
    } else {
  
      // get the info of the data inserted
      $username= $_POST['username'];
      $email= $_POST['email'];
      $password= $_POST['password'];

      //create a table(users) into database with columns of username,email,password
      $insert = $conn->prepare("INSERT INTO users (username, email, mypassword) VALUES (:username, :email, :mypassword)");
      
      //more secure way to get/store the inputs
      $insert->execute([
        ':username' => $username,
        ':email' => $email,
        ':mypassword' => password_hash($password, PASSWORD_DEFAULT) //hashing the password for security
      ]);

      echo "<script> window.location.href='".APPURL."/auth/login.php' </script>"; // uses JS for going to inex.php
    }

  }


?>
  
  
  <div class="site-wrap">


    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo APPURL; ?>/images/bg_image2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">Register</h1>
          </div>
        </div>
      </div>
    </div>
    

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
            <h3 class="h4 text-black widget-title mb-3">Register</h3>

            <form action="register.php" method="POST" class="form-contact-agent">

            <div class="form-group">
                <label for="email">Username</label>
                <input type="username" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"> <!--name method is used so that it refers to the POST data -->
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="phone" class="btn btn-primary" value="Register">
            </div>
            </form>
          </div>
         
        </div>
      </div>
 

<?php require "../top/footer.php"; ?>