<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/myStyle.css">
       

    </head>
    <body>
        <?php 



#db 연결 부분 

$index = $_GET['cafeIdx']; 
$path = 'seat.php?cafeIdx='.$index;
$conn = mysqli_connect(
    '15.165.124.76',
    'osp',
    '1234',
    'cagong');


    $cafeIdx = $index;
    $detailSeat = $_POST['detailseat'];




   
$seat = "UPDATE cafe
SET availableSeat = {$detailSeat}
 WHERE cafeIdx = {$cafeIdx};";

  if (!mysqli_query($conn,$seat)){
 die('Error: ' . mysqli_error($conn));
 }


  
 echo "<script>location.replace('cafe_info.php?cafeIdx=".$index."')</script>";
  



      
         ?>
        </body>
        </html>