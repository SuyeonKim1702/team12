<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>List of Cafes</title>
<link rel ="stylesheet" href ="review.css" type = "text/css">
<link rel = "stylesheet" href ="cafe_list.css" type = "text/css">

<link rel = "stylesheet" href="tag.css" type="text/css">
<script src= "https://kit.fontawesome.com/7b88aa951e.js" crossorigin="anonymous"></script>
<link rel= "preconnect" href="https://fonts.gstatic.com">
<link href= "https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
<?php

session_start();
if(isset($_SESSION[ 'is_logged' ]) && $_SESSION[ 'is_logged' ] == 'Y'){
//로그인 되었을 경우
$top = '<ul class="nav-menu">
<li><a href="login.html">로그아웃</a></li>
</ul>';

}else{
    $top = '<ul class="nav-menu">
<li><a href="login.html">로그인</a></li>
<li><a href="signin.html">회원가입</a></li>
</ul>';

}


$conn = mysqli_connect(
  '15.165.124.76',
  'osp',
  '1234',
  'cagong');



if(!isset($_POST['status'])){
  //네비게이션 바에서 넘어옴
  $keyword = $_SESSION['keyword'];
  $string = $_SESSION['string'];


}else{
  //검색해서 넘어옴
  $keyword = $_POST['cafeName'];
  $string = $_POST['markers'];
  $string = str_replace ("[", "(", $string);
  $string = str_replace ("]", ")", $string);

  $_SESSION['keyword'] = $keyword;
  $_SESSION['string'] = $string;

}


if(strlen($keyword) == 0){
  if(strlen($string)>2){
    $cafelist = "SELECT c.cafeIdx as cafeIdx, distance, c.cafename as cafename, x, y, availableSeat, count(hashtagIdx) as count from hashtagList
    join cafe c on hashtagList.cafeIdx = c.cafeIdx
    where hashtagIdx IN ".$string."
    group by c.cafeIdx
    order by count DESC, distance;";

  }else{
    $cafelist="";
  }


  //태그로 검색
}else{
  //카페 이름으로 검색
  $cafelist = "SELECT cafeIdx, cafename, availableSeat, x, y  FROM cafe WHERE cafename LIKE '%".$keyword."%' order by distance;";

}

?>

<script>
  $('.unknown').bind('click', function(){
    alert("카페를 선택해주세요.");
  });
</script>
</head>

<body>

<div>
    <main class="pg-main">
        <div class = "top-container" >
            <div class="contents">
                <nav class="navbar">
                    <div class="nav-logo">
                        <i class="fas fa-coffee"></i>
                        <a href="index.php">KAGONG</a>
                    </div>
                    <?php echo $top ?>
                </nav>
                <div class="main-content" >
                    <div class="title">
                        <h1>카공족을 위한</h1>
                        <h1>맞춤 카페 추천서비스</h1>
                    </div>
                    <form class = "main-searchbox" method = "POST" name="main-searchbox">
                        <input type="search" placeholder="카페 이름 또는 태그 설정" />
                        <button type = "submit"><i class="fas fa-search" style="color:white; font-size:20px;"></i></button>
                    </form>
                </div>
            </div>
            <div>
                <nav class = "nav_cafe">
                    <a href="#">검색 결과</a>
                    <a class='unknown'>카페 정보</a>
                    <a class='unknown'>리뷰 목록</a>

                </nav>
            </div>
        </div>
        <div class="bottom-container2">
          <h1>지도</h1>
          <!-- 검색된 카페 리스트 -->
          <div class="cafe-container">



 <?php
 $conn = mysqli_connect(
  '15.165.124.76',
  'osp',
  '1234',
  'cagong');

          $data="";
          $result = mysqli_query($conn, $cafelist);


$j = 0;

$location = array();

while($row1 = mysqli_fetch_assoc($result) and $j < 40){
  $j = $j +1;
  $cafeidx = $row1['cafeIdx'];
  $cafeName = $row1['cafename'];
  $seat = $row1['availableSeat'];

  //x -> 위도, y -> 경도
  $x = $row1['x'];
  $y = $row1['y'];


  array_push($location, array("x" => $x, "y" => $y, "cafeName" => $cafeName, "seat" => $seat));


  $hashtag = "SELECT h.hashtagIdx as hashtagIdx, hashtagName
  from hashtagList
  join hashtag h on hashtagList.hashtagIdx = h.hashtagIdx
  where cafeIdx={$cafeidx};";


$result2 = mysqli_query($conn, $hashtag);

$i = 0;
$tags = "";
while($row = mysqli_fetch_assoc($result2) and $i<5){


  $tags = $tags.'<input type="button" class="tags" name="tags" value="#'.$row['hashtagName'].'"></input><br>';
  $i = $i+1;
}

//좌석에 따라 색깔 정하기
if($seat==0){
  $seat_tag_color = "red";
}
else if ($seat<=10) {
  $seat_tag_color = "green";
}
else{
  $seat_tag_color = "yellow";
}

  $path=$cafeidx;

  $data=$data.' <table class="cafe_box" onclick="location.href=\'cafe_info.php?cafeIdx='.$path.'\'">
  <tr>
    <td class="cafe_box1">
      <div class="cafe_image">
        <img src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20200818_294%2F1597756409501puSKH_JPEG%2F4H8H3eCbJNhdXcCbCslhX6Li.jpg">
      </div>
      <label class="cafe_name">'.$cafeName.'<label>
    </td>
    <td class="cafe_box2">
      <span class="cafe_tags">'.$tags.'

      </span>
      <div class="seat_status">
          <input type="button" class="seat_info_tag" name="seat_info_tag" value="'.$seat.'석" style="background-color:'.$seat_tag_color.'"></input>
      </div>
    </td>
  </tr>
</table>';

}



echo $data;



          ?>
          <script type="text/javascript">
           var a = <?php echo json_encode($location);?>;


              console.log(a);


          </script>




          </div>
          <!-- 구현해야하는 부분: 좌석 입력하면 버튼 변화-->

        </div>
    </main>
</div>

</body>
</html>
