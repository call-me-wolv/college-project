
<?php
include_once '../includes/dblink.php';
session_start();
unset($_SESSION['insert']);
unset($_SESSION['restock']);
unset($_SESSION['remove']);
echo "<h3 style='color:blue'>User Name</h3>".$_SESSION['user']."<br><br>";
echo "<h2 style='color:green'>Items Available</h3>";
// <!-- displaying table-->
     $sql = "select * from hub;";
     $result = mysqli_query($conn,$sql);
     if (mysqli_num_rows($result) > 0) {
         echo "<table><tr><th>Item Id</th><th>Name</th><th>Description</th><th>price/Kg</th><th>quantity(kg)</th></tr>";
         // output data of each row
         while($row = mysqli_fetch_assoc($result)) {
             echo "<tr><td>" . $row["item_id"]. "</td><td>" . $row["iname"]. "</td><td>" . $row["idesc"]. "</td>><td>" . $row["iprice"]. "</td><td>" . $row["iquantity"]. "</td></tr>";
         }
         echo "</table>";
     } else {
         echo "0 results";
     }




if(isset($_POST['itemname'])){
    
    
    $iname = $_POST['itemname'];
    $idesc = $_POST['itemdesc'];
    $iquan = $_POST['itemquan'];
    $iprice = $_POST['itemprice'];
  
    $sql = "select * from hub where iname='$iname';";
  
   $result = mysqli_query($conn,$sql);
   $resultCheck = mysqli_num_rows($result);
  //    $resultCheck = mysqli_num_rows($result);
  
  //    if($resultCheck > 0)
  //    {
    if($resultCheck < 1)
    {

    if(!is_string($iname) && !is_numeric($iprice) && !is_numeric($iquan)) {
          echo "<h4 style='color:red'>ERROR:<br>enter item name correctly<h4>";
      }
     else if(!is_numeric($iprice)) {
        echo "<h4 style='color:red'>ERROR:<br>enter item price format correctly<h4>";
     }
    else if(!is_numeric($iquan)) {
        echo "<h4 style='color:red'>ERROR:<br>enter item quantity format correctly<h4>";
    }
     else
      {
                   $_SESSION['insert'] = $iname;
                     $sql = "INSERT INTO hub(iname,idesc,iprice,iquantity) VALUES ('$iname','$idesc', '$iprice','$iquan');";
                     mysqli_query($conn,$sql);
                     header("Location: ../admin.php?login=success");
                      
                
      }
    }
    else {
       echo "<h2 style='color:red'>Item Name already present</h2>";
    }
}
?>

 <?php
    if(isset($_POST['itemid2'])){
        $itemid1 = $_POST['itemid2'];
        $sql = "select * from hub where item_id='$itemid1';";
  
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if(!is_numeric($itemid1)) {
            echo "<h4 style='color:red'>ERROR:<br>enter item id format correctly<h4>";
        }

       else if($resultCheck > 0)
        {
            
                          
                         $_SESSION['remove'] = $itemid1;
                           $sql = "delete from hub where item_id=$itemid1;";
                           mysqli_query($conn,$sql);
                           header("Location: ../admin.php?delete=success");
                            
                      
            
          }
          else {
             echo "<h2 style='color:red'>Item Does Not exist</h2>";
          }
      }

   
 ?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../includes/style.css">
    <style>
        body {
    font-family: Arial, Helvetica, sans-serif;
    background-image: url("../includes/close-up-color-confection-992815.jpg");
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
<a href="../admin.php?backfromHub">Go Back To Admin Page</a>                                                                                
<br>


    <h1>Admin Controls</h1>
    <div>
    <ul>
            <li>Add New Product</li>
            <div >
                    <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                      <div class="container">
                       
                        <input type="text" placeholder="Enter Item name" name="itemname" required>
                        <input type="text" placeholder="Enter Item Description" name="itemdesc" required>                                                                                                                           
                        <input type="text" placeholder="Enter Item quantity in kg" name="itemquan" required>                         
                        <input type="text" placeholder="Enter Item price per kg" name="itemprice" required>
                        
                        <button type="submit">Add</button> 
                      </div>
                      /Notice: Refresh page to view updates
                    </form>
                  </div>
<!-- restock backend-->
<?php

if(isset($_POST['itemid1'])){
    
    
    $itemid = $_POST['itemid1'];
    $iquan = $_POST['itemquan1'];
  
    $sql = "select * from hub where item_id='$itemid';";
  
   $result = mysqli_query($conn,$sql);
   $resultCheck = mysqli_num_rows($result);
   $row = mysqli_fetch_assoc($result);
  
  //    $resultCheck = mysqli_num_rows($result);
  
  //    if($resultCheck > 0)
  if(!is_numeric($itemid)) {
    echo "<h4 style='color:red'>ERROR:<br>enter item id format correctly<h4>";
 }
else if(!is_numeric($iquan)) {
    echo "<h4 style='color:red'>ERROR:<br>enter item quantity format correctly<h4>";
}
  //    {
    else if($resultCheck > 0)
    {

    // if(!is_string($iname) && !is_numeric($iprice) && !is_numeric($iquan)) {
    //       echo "<h4 style='color:red'>ERROR:<br>enter item name correctly<h4>";
    //   }
      
     
                     $new = $iquan + $row['iquantity'];
                     $_SESSION['restock'] = $itemid;
                     $sql = "update hub set iquantity = $new where item_id = $itemid;";
                     mysqli_query($conn,$sql);
                     header("Location: ../admin.php?login=success");
                      
                
      
    }
    else {
       echo "<h2 style='color:red'>Item Name Not exist</h2>";
    }
}
    

?>
            <li>Restock Hub</li>
            <div >
                    <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                      <div class="container">
                      <input type="text" placeholder="Enter Item Id" name="itemid1" required>
                       <input type="text" placeholder="Enter Quantity in kg" name="itemquan1" required>
                        <button type="submit">Restock</button> 
                      </div>
                      /Notice: Refresh page to view updates
                    </form>
                  </div>

                  <!--backend for remove-->


            <li>Remove Product</li>
            <div >
                    <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                      <div class="container">
                    
                        <input type="text" placeholder="Enter Item Id " name="itemid2" required>
                        <button type="submit">Delete</button> 
                      </div>
                      /Notice: Refresh page to view updates
                    </form>
                  </div>

              

        </ul>
</div>
<a href="../admin.php?backfromHub">Go Back To Admin Page</a>
</body>
</html>