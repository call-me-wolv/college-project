<?php
include_once "../includes/dblink.php";
session_start();
    echo "<h3 style='color:white'>STORE AVAILABLE</h3>";
     $sql = "select * from store;";
     $result = mysqli_query($conn,$sql);
     if (mysqli_num_rows($result) > 0) {
         echo "<table><tr><th>Store Id</th><th>Store Name</th></tr>";
         // output data of each row
         while($row = mysqli_fetch_assoc($result)) {
             echo "<tr><td>" . $row["store_id"]. "</td><td>" . $row["sname"]. "</td></tr>";
         }
         echo "</table>";
     } else {
         echo "0 results";
     }
?>
<?php

if(isset($_POST['submit1'])){

    $storeid = $_POST['storeid'];
     $sql = "select * from store_items s,hub h where s.store_id=$storeid and s.item_id=h.item_id ;";
     $result = mysqli_query($conn,$sql);
     if(!is_numeric($storeid)) {
        echo "<h4 style='color:red'>ERROR:<br>enter Store id in integer format<h4>";
     }
     else if (mysqli_num_rows($result) > 0) {
         echo "<h3 style:'color:green'>STORE DETAILS :store id-".$_POST['storeid']."<br>";
         echo "<table><tr><th>Item Id</th><th>Name</th><th>Description</th><th>price</th><th>quantity(Kg)</th></tr>";
         // output data of each row
         while($row = mysqli_fetch_assoc($result)) {
             echo "<tr><td>" . $row["item_id"]. "</td><td>" . $row["iname"]. "</td><td>" . $row["idesc"]. "</td>><td>" . $row["iprice"]. "</td><td>" . $row["squantity"]. "</td></tr>";
         }
         echo "</table>";
     } else {
         echo "<br><b style='color:red'>Store id not present</b><br>";
     }
    }
   
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../includes/style.css">
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
body {
    font-family: Arial, Helvetica, sans-serif;
    background-image: url("../includes/bazaar-bottles-business-15964.jpg");
    background-size:cover;
}
</style>
</head>
<body>
    <br>
<a href="../admin.php?backfromHub">Go Back To Admin Page</a>
<ul>
       
       
        <li><b Style='color:white'>Display store Items</b></li>
        <div >
                <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                  <div class="container">
                    <input type="text" placeholder="Enter Store Id " name="storeid" required>
                    <button type="submit" name="submit1">Display</button> 
                    <a href="../admin.php?backfromHub">Go Back To Admin Page</a>
                  </div>
                  
                </form>
              </div>

<?php
if(isset($_POST['submit2'])){
$itemid=$_POST['itemid'];
$quan=$_POST['itemquan'];
$storeid = $_POST['storeid'];
$sql1="select * from store_items where store_id=$storeid and item_id=$itemid";
$res = mysqli_query($conn,$sql1);
$row = mysqli_fetch_assoc($res);
$new = $row['squantity']+$quan;
$org=$row['squantity'];

 $sql = "select * from store_items s,hub h where s.store_id=$storeid and s.item_id=h.item_id ;";
 $result = mysqli_query($conn,$sql);
 if(!is_numeric($storeid)) {
    echo "<h4 style='color:red'>ERROR:<br>enter Store id format correctly<h4>";
 }
 else if (mysqli_num_rows($result) > 0) {
    
     $procsql="CALL `restockstore`($itemid,$storeid,$new,$org)";
     // $stmt=$conn->prepare($procsql);
     // $stmt->bindParam(':oid',$ordid);
     // $stmt->bindParam(':delid',$delyid);
     // $stmt->execute();
    if(mysqli_query($conn,$procsql)){
  
    if($org>100){
        echo "<br><b style='color:red'>Can't add cause stock of more than 100kg is already present</b><br>";
      
     }
     else
     {
        $_SESSION['rs']=$storeid;
        header("Location: ../admin.php?assigndel=success");
     }
    }
     
    
 } else {
     echo "<br><b style='color:red'>Store id not present</b><br>";
 }
}
?>
<li>//Notice: Can't restock if store already have more than 100 kg of that item</li>
           <br>  
               <li><b Style='color:white'>Restock the Stores</b></li>
        <div >
                <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                  <div class="container">
                
                    <input type="text" placeholder="Enter Item Id " name="itemid" required>
                    <input type="text" placeholder="Enter Store Id " name="storeid" required>
                    <input type="text" placeholder="Enter Quantity in Kg" name="itemquan" required>
                    <button type="submit" name="submit2">Restock</button> 
                    <a href="../admin.php?backfromHub">Go Back To Admin Page</a>
                  </div>
                </form>
              </div>

         

    </ul>