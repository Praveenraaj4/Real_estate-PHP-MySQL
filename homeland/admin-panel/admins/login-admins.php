<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php

//prevent direct to other pages when logged in

  if(isset($_SESSION['adminname'])){
    echo "<script> window.location.href='".ADMINURL."' </script>";
  }

    // check the data inserted using POST method
  if(isset($_POST['submit'])){

      //if any of this credentials empty it will show error

    if (empty($_POST['email']) OR empty($_POST['password'])){
        echo "<script> alert('credentials empty');</script>";
    } else {
    
        // get the info of the data inserted

      $email= $_POST['email'];
      $password= $_POST['password'];

        //query
        //grab info from the email provided

      $login = $conn->query("SELECT * FROM admins WHERE email='$email'");

      $login->execute();

        //fetch data
        $fetch = $login->fetch(PDO::FETCH_ASSOC);

        if($login->rowCount() > 0){
          // echo $login->rowCount();
          // echo "email is valid";

          //password verify used to dehash the password

          if(password_verify($password, $fetch['mypassword'])){
          
            $_SESSION['adminname'] = $fetch['adminname'];
            $_SESSION['email'] = $fetch['email'];
            $_SESSION['admin_id'] = $fetch['id'];
            
            echo "<script> window.location.href='".ADMINURL."' </script>"; // uses JS for going to inex.php

          }else {

            echo "<script> alert('email or password is wrong');</script>";
          }

        } else {
          echo "<script> alert('email or password  is wrong');</script>";
        }
      }
    }

?>

          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mt-5">Login</h5>

                  <form method="POST" class="p-auto" action="login-admins.php">

                      <!-- Email input -->
                      <div class="form-outline mb-4">
                        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                      
                      </div>

                      
                      <!-- Password input -->
                      <div class="form-outline mb-4">
                        <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                        
                      </div>



                      <!-- Submit button -->
                      <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                    
                    </form>

                </div>
          </div>

<?php require "../layouts/footer.php"; ?>