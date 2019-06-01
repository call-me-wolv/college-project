<?php
session_start();
if(isset($_SESSION['user'])){
echo "<h1 style='color:#2390fd'>Welcome</h1><h3 style='color:white'>".$_SESSION['user']."</h3><br><br>";
if(isset($_SESSION['op'])){
    echo "<b id='info-message' style='color:white;'>ORDER SUCCESSFULL</b><script>
    setTimeout(function(){
      document.getElementById('info-message').style.display = 'none';
    }, 6000);
  </script>";
}
if(isset($_SESSION['cancel'])){
    echo "<b id='info-message1' style='color:white;'>ORDER CANCELED</b><script>
    setTimeout(function(){
      document.getElementById('info-message1').style.display = 'none';
    }, 6000);
  </script>";
}
unset($_SESSION['op']);
unset($_SESSION['cancel']);

?>

<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../includes/select.css">
    <style>
        body {
    font-family: Arial, Helvetica, sans-serif;
    background-image: url("../includes/agriculture-close-up-cultivation-6427.jpg");
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
    li{
        color:white;
        font-family:verdana;
        font-size:18px;
    }
    
    </style>

   
      
    </head>
    <body >
        <br><a href="logout.php" >Logout</a>
        <h1>
           <b style='color:white'>Centralized Hub Management System</b>
        </h1>
        <ul >
            <!-- <li>check availablity</li> -->
            <!-- <div >
                    <form  action="includes/check_item.php" method="POST">
                      <div class="container">
                        <label for="uemail" ><b>Item name:</b></label>
                        <br>
                        <input type="text" placeholder="Enter Item name" name="iname" required>
                        <button type="submit">search</button> 
                      </div>
                    </form>
                  </div> -->
           
            <li>Find store address near you</li>
            <div  >
                    <form  action="../includes/find_store.php" method="POST">
                      <div class="container">
                       
                                <label for="uemail" s><b style='color:white;'>Select City Name:</b></label>
                                <br>
                                <div  class="custom-select">
                                <select name="cityname" style="width:200px">
                                    <option value="" required>Select City</option>
                                    <option value="bengaluru" required>Bengaluru</option>
                                  
                                    <option value="mysuru" required>mysuru</option>
                                </select>
                                </div>
                                <br><br>
                                <label for="uemail" s><b style='color:white;'>Select Area Name:</b></label>
                                <br>
                                <div  class="custom-select">
                                <select name="areaname">
                                    <option value="" required>Select Area</option>
                                    <option value="jayanagar" required>jayanagar</option>
                                    <option value="jpnagar" required>jpnagar</option>
                                    <option value="kuvempunagara" required>kuvempunagara</option>
                                    <option value="srinivaspura" required>srinivaspura</option>
                                    <option value="ameednagar" required>ameednagar</option>
                                </select>
                                    </div>
                                <button type="submit">search</button> 
                           
                      </div>
                    </form>
                  </div>

                  <li>Order Online</li>
                  <div >
                    <br>
                      <a href="../html/order.php" >ORDERS</a>   
                        </div>

        </ul>
    
       

    </body>

    
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
</html>
<?php
}

else{
    echo "You are loged out login again to order <a href='../index.php' >Login</a>";

}
?>