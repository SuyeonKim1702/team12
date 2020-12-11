<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>List of Cafes</title>
<link rel ="stylesheet" href ="review.css" type = "text/css">
<link rel = "stylesheet" href ="cafe_list.css" type = "text/css">

<link rel = "stylesheet" href="tag.php" type="text/css">
<script src= "https://kit.fontawesome.com/7b88aa951e.js" crossorigin="anonymous"></script>
<link rel= "preconnect" href="https://fonts.gstatic.com">
<link href= "https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
<?php

$conn = mysqli_connect(
  '15.165.124.76',
  'osp',
  '1234',
  'cagong');


$taglist = [1,2,3,4];
$keyword = $_POST['cafeName'];
if(strlen($keyword) == 0){
 
  //태그로 검색
}else{
  
  //카페 이름으로 검색
  $cafelist = "SELECT cafeIdx, cafename, availableSeat  FROM cafe WHERE cafename LIKE '%".$keyword."%' order by distance;";
  
}







?>
</head>

<body>

<div>
    <main class="pg-main">
        <div class = "top-container" >
            <div class="contents">
                <nav class="navbar">
                    <div class="nav-logo">
                        <i class="fas fa-coffee"></i>
                        <a href="">KAGONG</a>
                    </div>
                    <ul class="nav-menu">
                        <li><a href="login.html">로그인</a></li>
                        <li><a href="">회원가입</a></li>
                    </ul>
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
                    <a href="/">검색 결과</a>
                    <a href="/">카페 정보</a>
                    <a href="/">리뷰 목록</a>
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

          

while($row1 = mysqli_fetch_assoc($result)){
  
  $cafeidx = $row1['cafeIdx'];
  $cafeName = $row1['cafename'];
  $seat = $row1['availableSeat'];
  

  $hashtag = "SELECT h.hashtagIdx as hashtagIdx, hashtagName
  from hashtagList
  join hashtag h on hashtagList.hashtagIdx = h.hashtagIdx
  where cafeIdx={$cafeidx};";


$result2 = mysqli_query($conn, $hashtag);

$i = 0;
$tags = "";
while($row = mysqli_fetch_assoc($result2) and $i<5){


  $tags = $tags.'<p><input type="button" class="tags" name="tags" value="#'.$row['hashtagName'].'"></input> </p>';
  $i = $i+1;
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
      <div class="cafe_tags">'.$tags.'
      
      </div>
      <div class="seat_status">
        <p>
          <input type="button" class="seat_info_tag" name="seat_info_tag" value="'.$seat.'석"></input>
        </p>
      </div>
    </td>
  </tr>
</table>';

}

           

echo $data;
          ?>

          

          </div>
          <!-- 구현해야하는 부분: 좌석 입력하면 버튼 변화-->

        </div>
    </main>
</div>

</body>
</html>
