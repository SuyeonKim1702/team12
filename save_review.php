<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/myStyle.css">
       
    </head>
    <body>
        <?php 

$seat_ = [
    "붐비는" =>1,
    "좌석보통" =>2, 
    "좌석많은" =>3,
  ];
  
  $mood_ = [
   "소란스러운" => 1,
   "적당한" => 2,
   "조용한" => 3,
  ];
  
  $cost_ = [
   "가격비쌈" => 1,
    "가격적당" => 2,
    "가격저렴" =>3 ,
  ];



  if(!empty($_POST['rating'])){
    $max = 0;
    foreach($_POST['rating'] as $check){
      if($max < $check) $max = $check;
    }
     $star_rate = $max;
  }




#db 연결 부분 
$index = $_GET['cafeIdx'];
$userIdx = $_POST['userIdx'];

#$rate = $_POST['final_rate'];
$rate = $star_rate;
$desc = $_POST['description'];

$mood = $mood_[$_POST['mood']];
$price = $cost_[$_POST['price']];
$seat = $seat_[$_POST['seat']];


$conn = mysqli_connect(
    '15.165.124.76',
    'osp',
    '1234',
    'cagong');





   
$new = "INSERT INTO review (reviewContent, userIdx, cafeIdx, price, mood, seat, totalRating)
VALUES
('$desc', $userIdx, $index, $price, $mood, $seat, $rate);";

  if (!mysqli_query($conn,$new)){
 die('Error: ' . mysqli_error($conn));
 }


  
 echo "<script>location.replace('cafe_info.php?cafeIdx=".$index."')</script>";
  
      
         ?>
        </body>
        </html>