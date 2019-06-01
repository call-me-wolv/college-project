<?php

$out = "";

if(isset($_POST['email'])){
  include_once 'includes/dblink.php';

  session_start();
  
  $email=$_POST['email'];
  $pwd = $_POST['pwd'];
  $_SESSION['user'] = $email;

  $sql = "select customer_pwd from customer where customer_id='$email';";

 $result = mysqli_query($conn,$sql);
//    $resultCheck = mysqli_num_rows($result);

//    if($resultCheck > 0)
//    {
    $row = mysqli_fetch_assoc($result);

    if($email == "admin" && $pwd == "admin"){
      header("Location: admin.php?login=success");
    }
      else if($row['customer_pwd'] == $pwd)
      {
          $out = "Success";
          
          header("Location: html/new.php?login=success");
      }
      else{
        echo "<h1 style='color:red'>Login fail</h1><br>";
      }
     
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
      body {
    font-family: Arial, Helvetica, sans-serif;
    background-image: url("./includes/bazaar-bottles-business-15964.jpg");
    background-size:cover;
}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
      </style>
</head>
<body>



<h2>Login Form</h2>
<li>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign up</button>
</li>
<div id="id01" class="modal">


     <form class="modal-content animate" action='<?php echo $_SERVER['PHP_SELF'];?>' method="POST">
   <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
     
    </div>

    <div class="container">
      <label for="uemail"><b>Email Id</b></label>
      <input type="text" placeholder="Enter Username" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pwd" required>
        
      <button type="submit">Login</button>
      
    </div>

       <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        
        </div> 
  </form>

</div>
</div>

<!-- // sign up divison -->
<div id="id02" class="modal">
 <form class="modal-content animate" action="includes/signup.php" method="POST">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      
    </div>

    <div class="container">
      <label for="sname"><b>Name</b></label>
      <input type="text" placeholder="Enter Name" name="sname"  required>

      <label for="suname"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="semail" required>

      <label for="suname"><b>City</b></label>
      <input type="text" placeholder="Enter City name" name="scity" required>

      <label for="suname"><b>Area</b></label>
      <input type="text" placeholder="Enter Area" name="sarea" required>

      <label for="suname"><b>Address</b></label>
      <input type="text" placeholder="Enter Address" name="saddress" required>

      <label for="suname"><b>Phone</b></label>
      <input type="text" placeholder="Enter Phone" name="sphone" required>

      <label for="spsw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="spwd" required>

       <label for="cpsw"><b>Password</b></label>
      <input type="password" placeholder="Confirm Password" name="cpwd" required>

      <button type="submit" name="submit" >Sign up</button>
     
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');
var modal1 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
   if (event.target == modal1) {
        modal1.style.display = "none";
    }
}

</script>

</body>
</html>