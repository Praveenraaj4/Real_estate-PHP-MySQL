<?php require "../top/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php

    if(!isset($_SESSION['username'])){
      echo "<script>window.location.href='".APPURL."' </script>";
    }
    
    if(isset($_POST['submit'])){
        $prop_id = $_POST['prop_id'];
        $user_id = $_POST['user_id'];

        //create a table(favs) into database with columns of prop_id,useer_id
        $insert = $conn->prepare("INSERT INTO favs (prop_id, user_id) VALUES (:prop_id, :user_id)");
      
      //more secure way to get/store the inputs
        $insert->execute([
        ':prop_id' => $prop_id,
        ':user_id' => $user_id,

        ]);

      echo "<script> window.location.href='".APPURL."/property-details.php?id=$prop_id' </script>"; // uses JS for going to designated page
    }else{
      echo "<script> window.location.href='".APPURL."/404.php' </script>";
    }
    








?>