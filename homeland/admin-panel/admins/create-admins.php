<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php

  //prevent direct to other pages when logged in

  if(!isset($_SESSION['adminname'])){
    echo "<script> window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
  }

    // check the data inserted using POST method
    if(isset($_POST['submit'])){

      //if any of this credentials empty it will show error
      if (empty($_POST['adminname']) OR empty($_POST['email']) OR empty($_POST['password'])){
        echo "<script> alert('some inputs are required');</script>";
      } else {
    
        // get the info of the data inserted
        $adminname= $_POST['adminname'];
        $email= $_POST['email'];
        $password= $_POST['password'];

        //create a table(users) into database with columns of admin_name,email,password
        $insert = $conn->prepare("INSERT INTO admins (adminname, email, mypassword) VALUES (:adminname, :email, :mypassword)");
        
        //more secure way to get/store the inputs
        $insert->execute([
          ':adminname' => $adminname,
          ':email' => $email,
          ':mypassword' => password_hash($password, PASSWORD_DEFAULT) //hashing the password for security
        ]);

        echo "<script> window.location.href='".ADMINURL."/admins/admins.php' </script>"; // uses JS for going to inex.php
      }

    }




?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="admin_name" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>

<?php require "../layouts/footer.php"; ?>
