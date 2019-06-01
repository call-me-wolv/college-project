<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../includes/style.css">
    <style>
        
body {
    font-family: Arial, Helvetica, sans-serif;
    background-image: url("../includes/alone-basket-carrots-1389103.jpg");
    background-size:cover;
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
    include '../includes/dblink.php';
    //enter code
    
    $city = $_POST['cityname'];
    $area = $_POST['areaname'];
    $sql = "select store_id,sname,saddress from store where scity='$city' and sarea='$area';";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table><tr><th>Store Id</th><th>Store Name</th><th>Store Address</th></tr>";
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["store_id"]. "</td><td>" . $row["sname"]. "</td><td>" . $row["saddress"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    

   $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
    ?>