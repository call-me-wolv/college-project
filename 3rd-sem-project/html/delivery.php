<?php
session_start();
unset($_SESSION['updateorderstatus']);
unset($_SESSION['updatedelstatus']);
unset($_SESSION['deliveryadded']);
unset($_SESSION['assigndel']);
if(isset($_SESSION['user'])){
include_once "../includes/dblink.php";
    echo "<h3 style='color:green'>Orders Accepted</h3>";
     $sql = "select * from orders;";
     $result = mysqli_query($conn,$sql);
     if (mysqli_num_rows($result) > 0) {
         echo "<table><tr><th>Order Id</th><th>Customer Id</th><th>Delivery Id</th><th>Status</th></tr>";
         // output data of each row
         while($row = mysqli_fetch_assoc($result)) {
             echo "<tr><td>" . $row["order_id"]. "</td><td>" . $row["customer_id"]. "</td><td>" . $row["delivery_id"]. "</td><td>" . $row["status"]. "</td></tr>";
         }
         echo "</table>";
     } else {
         echo "0 results";
     }
     //displaying deivery men table

     echo "<h3 style='color:green'>Delivery Men Status</h3>";
     $sql = "select * from delivery;";
     $result = mysqli_query($conn,$sql);
     if (mysqli_num_rows($result) > 0) {
         echo "<table><tr><th>Delivery Id</th><th>Name</th><th>Age</th><th>Status</th></tr>";
         // output data of each row
         while($row = mysqli_fetch_assoc($result)) {
             echo "<tr><td>" . $row["did"]. "</td><td>" . $row["dname"]. "</td><td>" . $row["dage"]. "</td><td>" . $row["dstatus"]. "</td></tr>";
         }
         echo "</table>";
     } else {
         echo "0 results";
     }
?>
 <?php
    if(isset($_POST['submit4'])){
       $delname = $_POST['delname1'];
       $delage = $_POST['delage1'];
       $delemail=$_POST['email'];
      
       if($delage>=18){
        $sql = "select * from delivery where dname='$delname' and dage='$delage';";
  
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if(!is_string($delname)) {
            echo "<h4 style='color:red'>ERROR:<br>enter name in string format <h4>";
        }
        else if(!is_numeric($delage)) {
            echo "<h4 style='color:red'>ERROR:<br>enter age in integer format <h4>";
        }


       else if($resultCheck < 1)
        {
            
                          
                         $_SESSION['deliveryadded'] = $delname;
                           $sql = "insert into delivery(demail,dname,dage,dstatus) values('$delemail','$delname',$delage,'avail');";
                          if( mysqli_query($conn,$sql)){
                           header("Location: ../admin.php?deladded=success");
                          }
                      
            
          }
          else {
             echo "<h2 style='color:red'>delivery already exist</h2>";
          }
      }
    
    else{
        echo "<p style='color:red'>ERROR:Age must  be greater or equal to 18</p>";
    }
}

   
 ?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../includes/style.css">
    <link rel="stylesheet" href="../includes/select.css">
    <style>
        body {
    font-family: Arial, Helvetica, sans-serif;
    background-image: url("../includes/chicken-eggs-color-concept-1556707.jpg");
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
<ul>
  
<?php
//assigning the delivery

if(isset($_POST['oid'])){
    
    
    $ordid = $_POST['oid'];
    $delyid = $_POST['delid'];
  
    
    $sql = "select * from orders where status='notdel' and order_id='$ordid' and delivery_id is null;";
   $result = mysqli_query($conn,$sql);
   $resultCheck = mysqli_num_rows($result);
   $row = mysqli_fetch_assoc($result);
  
  //    $resultCheck = mysqli_num_rows($result);
  
  // if($resultCheck > 0)
  if(!is_numeric($ordid)) {
    echo "<h4 style='color:red'>ERROR:<br>enter order id format correctly<h4>";
 }
else if(!is_numeric($delyid)) {
    echo "<h4 style='color:red'>ERROR:<br>enter delivery id format correctly<h4>";
}
  //    {
   else if($resultCheck > 0)
    {
        $_SESSION['assigndel']=$oid;
        $procsql="CALL `assigndel`($ordid,$delyid)";
        // $stmt=$conn->prepare($procsql);
        // $stmt->bindParam(':oid',$ordid);
        // $stmt->bindParam(':delid',$delyid);
        // $stmt->execute();
        mysqli_query($conn,$procsql);
        
        header("Location: ../admin.php?assigndel=success");

    // if(!is_string($iname) && !is_numeric($iprice) && !is_numeric($iquan)) {
    //       echo "<h4 style='color:red'>ERROR:<br>enter item name correctly<h4>";
    //   }
     
    //guru code mad illi
                
      
    }
    else {
       echo "<h2 style='color:red'>Order not present or order is already assigned</h2>";
    }
}

?>
               <li>Assign Delivery</li>
        <div >
                <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                  <div class="container">
                
                    <input type="text" placeholder="Enter Order Id " name="oid" required>
                    <input type="text" placeholder="Enter Delivery Id " name="delid" required>
                   
                    <button type="submit">Assign</button> 
                    <a href="../admin.php?backfromHub">Go Back To Admin Page</a>
                  </div>
                </form>
                
              </div>
              


  <!--updating status-->
<?php
if(isset($_POST['orderid'])){
  
    $orderid = $_POST['orderid'];
    $orderstatus = $_POST['orderstatus'];
  
    $sql = "select * from orders where order_id='$orderid';";
  
   $result = mysqli_query($conn,$sql);
   $resultCheck = mysqli_num_rows($result);
   $row = mysqli_fetch_assoc($result);
  
  //    $resultCheck = mysqli_num_rows($result);
  
  //    if($resultCheck > 0)
  if(!is_numeric($orderid)) {
    echo "<h4 style='color:red'>ERROR:<br>enter order id format correctly<h4>";
 }
else if(!is_string($orderstatus)) {
    echo "<h4 style='color:red'>ERROR:<br>enter status format(string) correctly<h4>";
}
  //    {
   else if($resultCheck > 0)
    {
      $_SESSION['updateorderstatus'] = $orderid;
      $sql = "update orders set status='$orderstatus' where order_id=$orderid";
      mysqli_query($conn,$sql);
      header("Location: ../admin.php?updatestatus=success");
    }
    else {
       echo "<h2 style='color:red'>Order not present</h2>";
    }
} 
?>


  <li>Update Delivery Status Of Order</li>
        <div >
        <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="container">
                
                    <input type="text" placeholder="Enter Order Id " name="orderid" required>
                    <div  class="custom-select">
                                <select name="orderstatus" style="width:200px">
                                    <option value="" required>Select Order Status</option>
                                    <option value="del" required>Delivered</option>
                                    <option value="notdel" required>Not Delivered</option>
                                </select>
                                </div>
                   
                    <button type="submit">Update</button> 
                    <a href="../admin.php?backfromHub">Go Back To Admin Page</a>
                  </div>
                </form>
              </div>


    <!--updating delivery status-->

  <?php
if(isset($_POST['submit33'])){
  
    $delid = $_POST['delid'];
    $delstatus = $_POST['delstatus'];
  
    $sql = "select * from delivery where did='$delid';";
  
   $result = mysqli_query($conn,$sql);
   $resultCheck = mysqli_num_rows($result);
   $row = mysqli_fetch_assoc($result);
  
  //    $resultCheck = mysqli_num_rows($result);
  
  //    if($resultCheck > 0)
  if(!is_numeric($delid)) {
    echo "<h4 style='color:red'>ERROR:<br>enter del id format correctly<h4>";
 }
else if(!is_string($delstatus)) {
    echo "<h4 style='color:red'>ERROR:<br>enter status format(string) correctly<h4>";
}
  //    {
   else if($resultCheck > 0)
    {
      $_SESSION['updatedelstatus'] = $delid;
      $sql = "update delivery set dstatus='$delstatus' where did=$delid";
      mysqli_query($conn,$sql);
      header("Location: ../admin.php?updatestatus=success");
    }
    else {
       echo "<h2 style='color:red'>Delivery Id not present</h2>";
    }
} 
?>
              <li>Update Delivery Men Status</li>
        <div >
                <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                  <div class="container">
                
                    <input type="text" placeholder="Enter Delivery Men  Id " name="delid" required>
                    <div  class="custom-select">
                                <select name="delstatus" style="width:200px">
                                    <option value="" required>Select Delivery Status</option>
                                    <option value="avail" required>Available</option>
                                    <option value="notavail" required>Not Available</option>
                                </select>

                                </div>
                   
                    <button type="submit" name="submit33">Update</button> 
                    <a href="../admin.php?backfromHub">Go Back To Admin Page</a>
                  </div>
                </form>
              </div>




               <li>Add New Delivery Men</li>
        <div >
        <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="container">
                
     
                    <input type="text" placeholder="Enter delivery name" name="delname1" required>
                    <input type="text" placeholder="Enter age" name="delage1" required>
                    <input type="text" placeholder="Enter Email Id" name="email" required>
                    
                    
                    <button type="submit" name="submit4">Add</button> 
                    <a href="../admin.php?backfromHub">Go Back To Admin Page</a>
                  </div>
                </form>
              </div>

         

    </ul>
    <script> 
        var x, i, j, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        for (i = 0; i < x.length; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 0; j < selElmnt.length; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var y, i, k, s, h;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                h = this.parentNode.previousSibling;
                for (i = 0; i < s.length; i++) {
                if (s.options[i].innerHTML == this.innerHTML) { 
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y = this.parentNode.getElementsByClassName("same-as-selected");
                    for (k = 0; k < y.length; k++) {
                    y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
            });
        }
        function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
        except the current select box:*/
        var x, y, i, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
            arrNo.push(i)
            } else {
            y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
            }
        }
        }
        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);
</script>

<?php
}
    else{
        echo "You are loged out login again to order <a href='../index.php' >Login</a>";
    }