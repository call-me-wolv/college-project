<?php
    include_once 'dblink.php';

   
    $email=$_POST['email'];
    $pwd = $_POST['pwd'];

    $sql = "select customer_pwd from customer where customer_id='$email';";

   $result = mysqli_query($conn,$sql);
//    $resultCheck = mysqli_num_rows($result);

//    if($resultCheck > 0)
//    {
      $row = mysqli_fetch_assoc($result);

      if($email == "admin" && $pwd == "admin"){
        header("Location: ../admin.php?login=success");
      }
        else if($row['customer_pwd'] == $pwd)
        {

            header("Location: ../html/new.php?login=success");
        }
       
//    }
    // header("Location: ../index.php?signup=success");
   