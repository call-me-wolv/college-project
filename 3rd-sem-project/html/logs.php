<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../includes/style.css">
    <style>
        
body {
    font-family: Arial, Helvetica, sans-serif;
    background-image: url("../includes/beverage-brew-clean-877701.jpg");
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
        table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>
<?php
include_once '../includes/dblink.php';
session_start();
unset($_SESSION['insert']);
unset($_SESSION['restock']);
unset($_SESSION['remove']);
echo "<h3 style='color:blue'>User Name</h3>".$_SESSION['user']."<br><br>";
echo "<h2 style='color:green'>Items Available</h3>";
// <!-- displaying table-->
     $sql = "select * from logs where id!=1;";
     $result = mysqli_query($conn,$sql);
     if (mysqli_num_rows($result) > 0) {
         echo "<table><tr><th>Log Id</th><th>Order Id</th><th>Item Id</th><th>Quantity(kg)</th><th>Status</th></tr>";
         // output data of each row
         while($row = mysqli_fetch_assoc($result)) {
             echo "<tr><td>" . $row["id"]. "</td><td>" . $row["orderid"]. "</td><td>" . $row["itemid"]. "</td>><td>" . $row["quantity"]. "</td><td>" . $row["operation"]. "</td></tr>";
         }
         echo "</table>";
     } else {
         echo "0 results";
     }
?>