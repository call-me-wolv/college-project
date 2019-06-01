<?php
    include_once 'dblink.php';

    $name = $_POST['sname'];
    $email=$_POST['semail'];
    $pwd = $_POST['spwd'];
    $cpwd = $_POST['cpwd'];
    $city = $_POST['scity'];
    $area = $_POST['sarea'];
    $address = $_POST['saddress'];
    $phone = $_POST['sphone'];
    
    //validating input
    $s1 = "select 1 from customer where customer_id='$email';";
    
    $result=mysqli_query($conn,$s1);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck < 1)
    {

    if (empty($_POST["semail"])) {
        echo "Email is required";
      }
      else if(!is_numeric($phone)) {
          echo "enter phone number correctly";
      }
     else
      {
        
        // check if e-mail address is well-formed
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
         {
             echo "inside";
            if ($pwd == $cpwd)
                {

                     $sql = "INSERT INTO customer(customer_id,cname, customer_pwd,ccity,carea,caddress,cphone) VALUES ('$email','$name', '$pwd','$city','$area','$address','$phone');";
                     mysqli_query($conn,$sql);
                      header("Location: ../index.php?signup=success");
                 }
                 else
                 {
                     echo "Enter password correctly";
                 }
             
         }
        else
                {
                     echo "Enter Email in right Format";
                }
      }
    }
    else {
        echo "customer already registered enter new email id";
        echo "<br>click here to login again<head>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href='../includes/style.css'>
            <style>
    a:link, a:visited {
    background-color:bisque;
    color: red;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}


a:hover, a:active {
    background-color: green;
    color: white;
}</style>
        </head> <a href='../index.php' >TryLogin</a>";
    }
    


   

    // if ($pwd == $cpwd)
    // {

    // $sql = "INSERT INTO customer(customer_id,cname, customer_pwd,ccity,carea,caddress,cphone) VALUES ('$email','$name', '$pwd','$city','$area','$address','$phone');";
    // mysqli_query($conn,$sql);
    // header("Location: ../html/signupsuccess.php?signup=success");
    // }
    // else{
    //     header("Location: ../html/againsignup.php?signup=fail");
    // }

   function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}