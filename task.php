<?php

                        $conn = mysqli_connect("localhost", "root", "", "bank");
                        if(!$conn)
                        {
                            die("Could not connect to the database due to the following error --> ".mysqli_connect_error());
                        }


if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customer where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of customer from which the amount is to be transferred.

    $sql = "SELECT * from customer where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by customer
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE customer set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE customer set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='transaction_history.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Basic Banking System
    </title>
        <link rel="icon" type="icon" href="Images/favicon.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.css">
        <style type="text/css">
        body,html{
            height: 100%;
             font-family: "Times New Roman", Times, serif;
        }
            .bg_img
            {
            height: 100%;
            background-image: url('Images/background.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            }
            td ,th
            {
            color: #fff;
            font-size: 20px;
            }
            .table{
            margin-left: auto;
            margin-right: auto;
            width: 80%;
        }
        .tabletext{
            margin: 0 auto;

        }
        .anchor{
            background-color:#114566;
            color: #fff;
            font-family:'Fredoka One', cursive; 
            padding: 5px;
            border-radius: 5px;
            display: inline-block;
            text-align: center;
        }   
        .anchor:hover{
            color: #f4e4f5;
            background-color:#0d0b40;
        }
         a:link, a:visited {
        text-decoration: none;
        }
        </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12 col-md-12 m-0 p-0">
            <nav class="navbar navbar-expand-lg navbar m-0 p-3" style="background-color: #000;">
  <a class="navbar-brand" href="#">
    <img src="Images/logo.png" width="200px;"></a>
  <button class="navbar-toggler p-2" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <div class="hamburger-container">
    <span class="icon-bar bar1"></span>
    <span class="icon-bar bar2"></span>
    <span class="icon-bar bar3"></span>
    </div>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02">
    <form class="form-inline my-2 my-lg-0">
    <ul class="navbar-nav">
      <li class="nav-item active p-1">
       
    <a href="index.html" class="anchor">Home</a>
    
      </li>
      <li class="nav-item p-1">
      <a href="cus_details.php" class="anchor">View Customers details</a>
      </li>
      <li class="nav-item p-1" >
        <a href="transaction_history.php" class="anchor">Transaction history</a>
      </li>
    </ul>
    </form>
    
  </div>
</nav>
                
            </div>
            
        </div>
    

	<div class="row bg_img">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 "> 
        <h2 class="text-center pt-4" style="color : #FFFFFF"; style="font-style: bold";><b>Transfer Money</b></h2>
            <?php
                 $conn = mysqli_connect("localhost", "root", "", "bank");
                        if(!$conn)
                        {
                            die("Could not connect to the database due to the following error --> ".mysqli_connect_error());
                        }
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  customer where id= $sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
        <form method="post" name="tcredit" class="tabletext col-sm-6 " ><br>
        <div  class="col-lg-12 m-0 p-0 table-responsive ">
            <table class="table table-striped table-condensed table-bordered col-md-4">
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr>
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <label style="color : #fff;" >Transfer To:</label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
             $conn = mysqli_connect("localhost", "root", "", "bank");
                 if(!$conn)
                     {
                        die("Could not connect to the database due to the following error --> ".mysqli_connect_error());
                        }
                $sid=$_GET['id'];
                $sql = "SELECT * FROM customer where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
            <label style="color : #fff;">Amount:</label>
            <input type="number" class="form-control" name="amount" required>  
                <div class="text-center p-2" >
            <button class="btn mt-3 " name="submit" type="submit" id="myBtn" >Transfer</button>
            </div>
        </form>
    </div>
    </div>
</div>
    <footer class="text-center mt-5 py-2">
            <p>&copy 2021. Made by <b>SHRIYAL BHAWSAR</b> <br>THE SPARKS FOUNDATION</p>
    </footer>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(".navbar-toggler").on("click",function(){
        $(".bar1").toggleClass("bar1Active");
        $(".bar2").toggleClass("bar2Active");
        $(".bar3").toggleClass("bar3Active");

    })
    
</script>
</body>
</html>