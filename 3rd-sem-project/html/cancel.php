<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../includes/style.css">
    <style>
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
<body><?php
    include_once '../includes/dblink.php';
    session_start();
    $user = $_SESSION['user'];
    //enter code 
    $sql1 = "select * from orders o,hub h where o.customer_id ='$user' and o.status='notdel' and o.item_id=h.item_id and order_date=curdate();";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_assoc($result1);

    if(isset($_POST['submit1'])){
       
        $n = $row1["order_id"];
        $s1 = "delete from orders where order_id='$n'";
      if(mysqli_query($conn,$s1)){
      
           echo "<script>alert(order canceled)</script>";
           $_SESSION['cancel']='yes';
        header("Location: new.php?order=success");
       
       }
    
    else{
        echo "Unable to cancel order";
    }
}


   
    

    $sql = "select * from orders o,hub h where o.customer_id ='$user' and o.status='notdel' and o.item_id=h.item_id and order_date=curdate();";
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table><tr><th>Order Id</th><th>Item Name</th><th>price</th><th>quantity(kg)</th><th>Date of order</th></tr>";
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["order_id"]. "</td><td>" . $row["iname"]. "</td><td>" . $row["price"]. "</td><td>" . $row["quantity"]. "</td><td>" . $row["order_date"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    

 
    ?>

   

      <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                      <div class="container">
                      
                        
                        
                        <button type="submit" name="submit1">Cancel</button> 
                      </div>
                      <a href="new.php?backfromorders">Go Back To Home Page</a>
                    </form>
                  