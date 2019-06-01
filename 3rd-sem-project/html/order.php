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
    <h2 style="color:green">Items Available:</h2>
    <?php
    include '../includes/dblink.php';
    session_start();
    //enter code
    unset($_SESSION['op']);
    $user = $_SESSION['user'];
    $master = "select * from orders where customer_id='$user' and order_date=curdate()";
    $res=mysqli_query($conn,$master);
    if(mysqli_num_rows($res) <= 1){
    

    $sql = "select * from hub;";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table><tr><th>Item Id</th><th>Name</th><th>Description</th><th>price(per kg)</th><th>quantity(kg)</th></tr>";
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["item_id"]. "</td><td>" . $row["iname"]. "</td><td>" . $row["idesc"]. "</td>><td>" . $row["iprice"]. "</td><td>" . $row["iquantity"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    

   $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
    ?>
    <a href="new.php?backfromorders">Go Back To Home Page</a>

<?php
if(isset($_POST['submit1'])){
    $i1=$_POST['item1'];
    $q1=$_POST['quan1'];

    $sql1="select * from hub where item_id='$i1'";
    $sql2="select * from logs where item_id='$i1'";
$res1 = mysqli_query($conn,$sql1);
$row = mysqli_fetch_assoc($res1);
$quant=$row['iquantity'];

if(mysqli_num_rows($res1)>0){
    if(is_numeric($q1)) {
        $cid = $_SESSION['user'];
        
        $new = $quant-$q1;
        $price = $row['iprice'];
        if($new>=0){
        // echo "<h4 style='color:red'>ERROR:<br>enter quantity in integer format<h4>";
    $sql = "insert into orders(item_id,quantity,price,customer_id,order_date,status) values('$i1','$q1','$price','$cid',curdate(),'notdel')";
 $result = mysqli_query($conn,$sql);
 $sql2 = "update hub set iquantity='$new' where item_id=$i1";
 $result = mysqli_query($conn,$sql2);
 $p1 = "select orderid,operation from logs where id=1";
 $r11=mysqli_query($conn,$p1);
 $pr1=mysqli_fetch_assoc($r11);
 $n1=$pr1['operation'];
 $n2=$pr1['orderid'];
 $s22="update orders set price=$n1 where order_id=$n2";
 $result=mysqli_query($conn,$s22);

     $_SESSION['op']=$i1;
     header("Location: new.php?order=success");
    
        }
        else{
            echo "<br><h3 style='color:red'>stock unavailable</h3>";
        }
     
 } else {
     echo "<br><b style='color:red'>enter quantity in integer format</b><br>";
 }
}
else {
    echo "<br><b style='color:red'>item id is not present</b><br>";
}
}
if (mysqli_num_rows($res) == 0){

?>
    <h2>ORDER HERE:</h2>
<ul >
            <li>Enter Details:</li>
            <div >
                    <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                      <div class="container">
                        <label for="uemail" ><b>Item1:</b></label>
                        <br>
                        <input type="text" placeholder="Enter Item Id" name="item1" required>
                        <input type="text" placeholder="Enter Quantity" name="quan1" required>
                        
                        
                        <button type="submit" name="submit1">Order</button> 
                        <a href="new.php?backfromorders">Go Back To Home Page</a>
                      </div>
                    </form>
                  </div>
                  <?php
}
                  ?>
                  <form  action="cancel.php" method="POST">
                      <div class="container">
                      
                        
                        
                        <button type="submit" name="submit">Cancel Previous Orders</button> 
                      </div>
                    </form>
                  
           <?php
    }
    else
    {
            echo "NOTICE// Order per day is limited to one";
    }