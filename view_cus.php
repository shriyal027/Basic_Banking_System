<?php
						$conn = mysqli_connect("localhost", "root", "", "bank");
						$sql= "SELECT * FROM customer";
						$result = mysqli_query($conn, $sql);
						$conn->close();
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
		.table{
			margin-left: auto;
			margin-right: auto;
			width: 80%;
		}
		td ,th{
			color: #fff;
			font-size: 20px;
		}
		h1{

    margin: 0 auto;
 
    text-align: center;

		}
		.bg_img{
			height: 100%;
			background-image: url('Images/background.png');
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
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
	<!--body-->
	<div class="container-fluid ">
		<div class="row">
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
        <a href="cus_details.html" class="anchor">View Customers details</a>
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
		<h1 style="color:#fff;" class="typewriters p-3"><b>Customer Details</b></h1>
			<div class="col-lg-12 m-0 p-0 table-responsive ">
		
					<table class="table table-striped table-condensed table-bordered">
						<thead>
					<tr>
						<th scope="col" class="text-center py-2">Id</th>
						<th scope="col" class="text-center py-2">Name</th>
						<th scope="col" class="text-center py-2">Email</th>
						<th scope="col" class="text-center py-2">Balance</th>
					
					</tr>
					</thead>
					
             <tbody>
             	<?php
                while($rows=$result->fetch_assoc())
                {
             ?>
                         <tr>
                <th scope="row"><?php echo $rows['id'];?></th>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['email'];?></td>
                <td><?php echo $rows['balance'];?></td>
                
            </tr>

            <?php
                }
             ?>
             </tbody>
				</table>

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