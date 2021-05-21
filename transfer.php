<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="css/userstyle.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@100;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

.navbar-brand
{
    font-style: bold;
    font-size:65px; 
    color : blue;
    text-align: center;

}

.navbar
{
    display: flex;
justify-content: center;
	list-style: none;
	margin-top: 	0px;
	margin-left: 100px;
	text-align: center;
	padding-top: 50px;
}

.navbar li
{
	display: inline-block;
    text-align: center;
}


.navbar li a
{
	color: blue;
	text-decoration: none;
    margin-top:20px;
	padding: 5px ;
    margin-right: 180px  ;
	font-family: "Roboto", sans-serif;
	font-size: 15px;
    text-align: center;
}
 
.navbar li.nav-item a
{
	border: 1px solid white;
}

.navbar li a:hover 
{
	border: 1px solid yellow;
}


.main_div
{
    width:100%;
    height:100vh;
    background:white;
 
}
input
  {
      margin-top:10px;
      width:230px;
      height:40px;
      border-radius:10px;
      outline:none;
  }
 ::placeholder
 {
     padding:10px;
     
 }
button
{
    color:black;
    background:white;
    border-color:white;
   padding: 14px 20px;
  cursor: pointer;
  width: 100%;
    
}
button:hover
 {
     color:white;
     background:#4CAF50;
     border:none;
     opacity:0.8;
 }

 .card-body{
     background-color:cyan;
     color:black;
 }


 </style>
</head>
<body>
<div class="main_div">
 
     <div class="navbar navbar-expand-md">
   
      <a href="#" class="navbar-brand ">LIEFDE BANK</a>
      <button class="navbar-toggler  " type="button" data-toggle="collapse" data-target="#collapsenavbar">
      <span class="navbar-toggler-icon" ;"></span>
      </button>
     
       <div class="collapse navbar-collapse " id="collapsenavbar">
       <ul class="navbar-nav ml-auto">
              <li class="nav-item">
              <a href="index.php" class="nav-link ">HOME</a></li>

              <li class="nav-item">
                  <a href="customer.php" class="nav-link ">VIEW CUSTOMER</a></li>
             
               </ul>
        </div>
     </div>


     <div class="container">
        <div class="row">

          <div class="col-sm-4">
              <div class="card text-center" style="margin-top:76px;border-radius:10px;color:white" >
              <form method="POST">  
                                              
 <?php
include 'connection.php';
$ids=$_GET['idtransfer'];
$showquery="select * from `users` where id=($ids) ";
$showdata=mysqli_query($con,$showquery);
if (!$showdata) {
  printf("Error: %s\n", mysqli_error($con));
  exit();
}
$arrdata=mysqli_fetch_array($showdata);

?> 
                     
                    <div class="card-body" style="border-radius:20px;height:370px;"> 
                     
                    <h3>Transfer Details</h3>
                  


                        <label>Name</label>
                        <input type="text"  name="name1" value="<?php echo $arrdata['name']; ?>" required placeholder="Enter your name"/><br><br>
                        <label>Email</label>
                        <input type="text" name="email1" value="<?php echo $arrdata['email']; ?>" required placeholder="Enter email id"/><br><br>
                        <label>Amount</label>
                        <input type="text" name="amount1" value="" style="width:210px;" required placeholder="Enter amount"/><br><br>
                      
                    </div>

               </div>
          </div>
           
          <div class="col-sm-4">
              <div class="card text-center" style="margin-top:75px;height:370px;">
                   <div class="card-body">
                   <button  name="submit" style="margin-top:100px";>Proceed to Pay</button>
                  </div>
             </div>
          </div>

          <div class="col-sm-4">
                <div class="card text-center" style="border-radius:20px;margin-top:75px;height:370px;">
                   
                   <div class="card-body">
                   <h3>Transfer Details</h3>
                  
                        <label>Name</label>
                        <input type="text"  name="name2" value="" required placeholder="Enter your name"/><br><br>
                        <label>Email</label>
                        <input type="text" name="email2" value="" required placeholder="Enter email id"/><br><br>
                   
                 
              
                   </div>

               </div>
          </div>

       </div>
       
    </div>
</div>
</form> 
<?php

include 'connection.php';

if(isset($_POST['submit']))
{
    
  
    $Sender_name=$_POST['name1'];
    $Sender_email=$_POST['email1'];
    $Sender=$_POST['amount1'];
    $Receiver_name=$_POST['name2'];
    $Receiver_email=$_POST['email2'];
     
  

    $ids=$_GET['idtransfer'];
    $senderquery="select * from `users` where id=$ids ";
    $senderdata=mysqli_query($con,$senderquery);
  
    if (!$senderdata) {
     printf("Error: %s\n", mysqli_error($con));
    exit();
    }
    $arrdata=mysqli_fetch_array($senderdata);

    //receiverquery
    $receiverquery="select * from `users` where email='$Receiver_email' ";
    $receiver_data=mysqli_query($con,$receiverquery);
   
    if (!$receiver_data) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
    }
    $receiver_arr=mysqli_fetch_array($receiver_data);
    $id_receiver=$receiver_arr['id'];


    if($arrdata['balance'] >= $Sender)
    {
      $decrease_sender=$arrdata['balance'] - $Sender;
      $increase_receiver=$receiver_arr['balance'] + $Sender;
       $query="UPDATE `users` SET `id`=$ids,`balance`= $decrease_sender  where `id`=$ids ";
       $rec_query="UPDATE`users` SET `id`=$id_receiver,`balance`= $increase_receiver where  `id`=$id_receiver ";
       $res= mysqli_query($con,$query);
       $rec_res= mysqli_query($con,$rec_query);
      // $res_receiver=mysqli_query($con,$query_receiver);
       if($res && $rec_res)
      {
       ?>
       <script>
       swal("Done!", "Transaction Successful!", "success");
        </script> 
    
      <?php
   
      }
      else
      {
      ?>
           <script>
       swal("Error!", "Error Occured!", "error");
        </script> 

      <?php
      
      }
    }
  

  else
 {
  ?>
    <script>
       swal("Insufficient Balance", "Transaction Not  Successful!", "warning");
        </script> 
  <?php
   
 }
 
}
?>





</body>
</html>