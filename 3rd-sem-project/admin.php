<?php
session_start();

if(isset($_SESSION['user'])){
echo "<h1 style='color:blue'>Welcome</h1><h3 style='color:black;'><b>".$_SESSION['user']."<b></h3><br><br>";

 if(isset($_SESSION['insert'])){
    echo "<b id='info-message' style='color:green;'>INSERTION SUCCESSFULL</b><script>
    setTimeout(function(){
      document.getElementById('info-message').style.display = 'none';
    }, 6000);
  </script>";
}
if(isset($_SESSION['restock'])){
    echo "<b id='info-message1' style='color:green;'>RESTOCK SUCCESSFULL</b><script>
    setTimeout(function(){
      document.getElementById('info-message1').style.display = 'none';
    }, 6000);
  </script>";
}
if(isset($_SESSION['remove'])){
    echo "<b id='info-message2' style='color:green;'>DELETION SUCCESSFULL</b><script>
    setTimeout(function(){
      document.getElementById('info-message2').style.display = 'none';
    }, 6000);
  </script>";
}
if(isset($_SESSION['updateorderstatus'])){
  echo "<b id='info-message3' style='color:green;'>ORDER STATUS UPDATED</b><script>
  setTimeout(function(){
    document.getElementById('info-message3').style.display = 'none';
  }, 6000);
</script>";
}
if(isset($_SESSION['updatedelstatus'])){
  echo "<b id='info-message4' style='color:green;'>DELIVERY MEN STATUS UPDATED</b><script>
  setTimeout(function(){
    document.getElementById('info-message4').style.display = 'none';
  }, 6000);
</script>";
}
 if(isset($_SESSION['deliveryadded'])){
  echo "<b id='info-message5' style='color:green;'>DELIVERY MEN ADDED</b><script>
  setTimeout(function(){
    document.getElementById('info-message5').style.display = 'none';
  }, 6000);
</script>";
}
if(isset($_SESSION['assigndel'])){
  echo "<b id='info-message6' style='color:green;'>DELIVERY MEN ASSIGNED</b><script>
  setTimeout(function(){
    document.getElementById('info-message6').style.display = 'none';
  }, 6000);
</script>";
}
 if(isset($_SESSION['rs'])){
  echo "<b id='info-message7' style='color:green;'>STOCK RESTOCKED</b><script>
  setTimeout(function(){
    document.getElementById('info-message7').style.display = 'none';
  }, 6000);
</script>";
}
// unsetting all the variables

unset($_SESSION['insert']);
unset($_SESSION['restock']);
unset($_SESSION['remove']);
unset($_SESSION['updateorderstatus']);
unset($_SESSION['updatedelstatus']);
unset($_SESSION['deliveryadded']);
unset($_SESSION['assigndel']);

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="includes/style.css">
    <style>
      body {
    font-family: Arial, Helvetica, sans-serif;
    background-image: url("./includes/beverage-brew-clean-877701.jpg");
    background-size:cover;
}
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
}

</style>
   
</head>
<body>
    <br><br>
    <a href="html/logout.php">Logout</a>
    <h1>Admin Controls</h1>
    <div>
    <ul>
            <li><a href="../project1/html/hub.php" >HUB Controls</a></li><br>
            <li><a href="../project1/html/store.php"> Stores Controls</a></li><br>
            <li><a href="../project1/html/delivery.php" > Delivery Controls</a></li><br>
            <li><a href="../project1/html/logs.php" > View Logs</a></li><br>

             

        </ul>
</div>
</body>
</html>
<?php
}
else{
    echo "You are loged out login again to order <a href='index.php' >Login</a>";

}
?>