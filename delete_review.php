<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/myStyle.css">
       
    </head>
    <body>
        <?php 





#db 연결 부분 
$reviewIdx = $_GET['reviewIdx'];
$index = $_GET['cafeIdx'];
$userIdx = $_GET['userIdx'];


$conn = mysqli_connect(
    '15.165.124.76',
    'osp',
    '1234',
    'cagong');





   
$new = "DELETE FROM review WHERE reviewIdx = {$reviewIdx};";

  if (!mysqli_query($conn,$new)){
 die('Error: ' . mysqli_error($conn));
 }


  
 echo "<script>location.replace('review_list.php?cafeIdx=".$index."')</script>";
  
      
         ?>
        </body>
        </html>