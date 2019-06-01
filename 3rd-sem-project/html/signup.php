
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="includes/style.css">
</head>
<body>

<h2>Modal Login Form</h2>
<li>
<!-- <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button> -->
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign up</button>
</li>
<!-- <div id="id01" class="modal">
  
  <form class="modal-content animate" action="/action_page.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div> -->

<!-- // sign up divison -->
<div id="id02" class="modal">
 <form class="modal-content animate" action="includes/signup.php" method="POST">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="suname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="suname"  required>

      <label for="suname"><b>Email</b></label>
      <input type="text" placeholder="Enter Username" name="semail" required>

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