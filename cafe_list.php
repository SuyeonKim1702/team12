<title>List of Cafes</title>

<link rel = "stylesheet" href ="cafe_list.css" type = "text/css">
<link rel = "stylesheet" href="myStyle.css" type = "text/css">
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=16e368477251c61b33e8b365f4d7a601"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=APIKEY&libraries=LIBRARY"></script>

<link rel = "stylesheet" href="tag.css" type="text/css">
<script src= "https://kit.fontawesome.com/7b88aa951e.js" crossorigin="anonymous"></script>
<link rel= "preconnect" href="https://fonts.gstatic.com">
<link href= "https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
<script type="text/javascript" src="/test/wp-content/themes/child/script/jquery.jcarousel.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>





<script type = "text/javascript">

// 태그리스트 외의 영역 클릭시 태그리스트 숨김
$(document).mouseup(function (e) {
    var container = $("#drop-taglist");
    if (!container.is(e.target) && container.has(e.target).length === 0){
        container.css("display","none");
    }
});

//검색창 클릭시 태그리스트 펼침
function drop(){
    if( document.getElementById("drop-taglist").style.display =='none'){
        document.getElementById("drop-taglist").style.display ='block';
    }
}
//검색 버튼 클릭시 페이지 이동
function click_search(){
    var markersField = document.getElementById('markers');
    var markers = tagArr;
   markersField.value = JSON.stringify(markers);
   document.searchForm.submit();
}

</script>







<?php
session_start();
if(isset($_SESSION[ 'is_logged' ]) && $_SESSION[ 'is_logged' ] == 'Y'){
//로그인 되었을 경우
$top = '<ul class="nav-menu">
<li><a href="logout.php">로그아웃</a></li>
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
where cafeIdx={$cafeidx}
group by h.hashtagIdx;";

$result2 = mysqli_query($conn, $hashtag);
$i = 0;
$tags = "";
while($row = mysqli_fetch_assoc($result2) and $i<5){
$tags = $tags.'<input type="button" class="tags" name="tags" value="#'.$row['hashtagName'].'"></input><br>';
$i = $i+1;
}
if($seat<4){
  $seat_tag_color = "#E84139";
}
else if ($seat<=10) {
  $seat_tag_color = "#EAC645";
}
else{
  $seat_tag_color = "#55AC68";
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




?>


<script type="text/javascript">
function unknown(){
  alert("카페를 선택해주세요.");
}
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
                    <!--  검색창   -->
                    <form name="searchForm" class = "main-searchbox" action="cafe_list.php" onsubmit="click_search(); return false" method = "POST" >
                        <div style="display:flex;">
                            <input type="search" placeholder="Input cafe name or set tags" name="cafeName" id="cafeName" onclick="drop()"/>
                            <input type="hidden" id="markers" name="markers">
                            <input type="hidden" id="status" name="status" value="1">
                            <button type = "submit" class = "search-btn"><i class="fas fa-search" style="color:white; font-size:20px;"></i></button>
                        </div>
                        <div id="drop-taglist" style="display:none;">

                            <!--   태그   -->
                            <div class="taglist-bottom">
                                <button type="button" class="gray tag-btn" id="1" name="tags" value="좌석 많은">#좌석 많은</button>
                                <button type="button" class="gray tag-btn" id="2" name="tags" value="조용한" >#조용한</button>
                                <button type="button" class="gray tag-btn" id="3" name="tags" value="24시간 운영" >#24시간 운영</button>
                                <button type="button" class="gray tag-btn" id="4" name="tags" value="저렴한" >#저렴한</button>
                                <button type="button" class="gray tag-btn" id="5" name="tags" value="아늑한" >#아늑한</button>
                                <button type="button" class="gray tag-btn" id="6" name="tags" value="디저트 종류 다양" >#디저트 종류 다양</button>
                                <button type="button" class="gray tag-btn" id="7" name="tags" value="남/녀 화장실 분리" >#남/녀 화장실 분리</button>
                                <button type="button" class="gray tag-btn" id="8" name="tags" value="콘센트 많은" >#콘센트 많은</button>
                                <button type="button" class="gray tag-btn" id="9" name="tags" value="편한 의자" >#편한 의자</button>
                                <button type="button" class="gray tag-btn" id="10" name="tags" value="이벤트" >#이벤트</button>
                                <button type="button" class="gray tag-btn" id="11" name="tags" value="창문 넓은" >#창문 넓은</button>
                                <button type="button" class="gray tag-btn" id="12" name="tags" value="밝은 인테리어" >#밝은 인테리어</button>
                                <button type="button" class="gray tag-btn" id="13" name="tags" value="음악소리 작은" >#음악소리 작은</button>
                                <button type="button" class="gray tag-btn" id="14" name="tags" value="평점 높은" >#평점 높은</button>
                                <button type="button" class="gray tag-btn" id="15" name="tags" value="테이블 넓은" >#테이블 넓은</button>
                                <button type="button" class="gray tag-btn" id="16" name="tags" value="소란스러운" >#소란스러운</button>
                                <button type="button" class="gray tag-btn" id="17" name="tags" value="가격 적당" >#가격 적당</button>
                                <button type="button" class="gray tag-btn" id="18" name="tags" value="1인석" >#1인석</button>
                                <button type="button" class="gray tag-btn" id="19" name="tags" value="좌석 갯수 보통" >#좌석 갯수 보통</button>
                                <button type="button" class="gray tag-btn" id="20" name="tags" value="공간 넓은" >#공간 넓은</button>
                                <button type="button" class="gray tag-btn" id="21" name="tags" value="주차장 완비" >#주차장 완비</button>
                                <button type="button" class="gray tag-btn" id="22" name="tags" value="요새 뜨는" >#요새 뜨는</button>
                            </div>
                        </div>
                        <script>
                            //클릭된 태그의 id를 tagArr 배열에 저장/삭제, 색깔변경
                            var tagArr = [];
                           
                             $(document).ready(function () {
                                $("button").click(function () {
                                console.log('gkdkgdkgkdkgd');
                                        $(this).toggleClass('orange');
                                        $(this).toggleClass('gray');
                                        if (this.className == 'tag-btn orange') {
                                            tagArr.push(Number(this.id));
                                           
                                            
                                           
                                            console.log(tagArr);
                                        } else if (this.className == 'tag-btn gray') {
                                            const delNum = tagArr.indexOf(Number(this.id));

                                    
                                           
                                            console.log(tagArr);
                                            
                                        }
                                    }
                                );
                            });
                        </script>

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
          
          <div class="d">
                <div id="map" style="width:1250px;height:450px;"></div>

                <script type="text/javascript">
           var a = <?php echo json_encode($location);?>;


            var mapContainer = document.getElementById('map'), // 지도를 표시할 div
    mapOption = {
        center: new kakao.maps.LatLng(37.55708709545054, 126.94558145584872), // 지도의 중심좌표
        level: 4 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다




//마커 좌표위치,좌석정보,남은좌석 수,카페 이름을 데이터베이스에서 받아와서 데이터 배열생성(push);
var listData= a;


console.log("시행됨");


for (var i = 0; i < listData.length; i++) {
    var position = new kakao.maps.LatLng(listData[i].x, listData[i].y);
    if (listData[i].seat < 4) {
        var markerImage = new kakao.maps.MarkerImage('./images/marker_red.png', new kakao.maps.Size(37, 37));
        var marker = new kakao.maps.Marker({
            map: map,
            image: markerImage,
            position: position
        });
        marker.setMap(map);

    } else if (listData[i].seat >= 4 && listData[i].seat <= 10) {

        var markerImage = new kakao.maps.MarkerImage('./images/mark_yellow.png', new kakao.maps.Size(37, 37));
        var marker = new kakao.maps.Marker({
            map: map,
            image: markerImage,
            position: position
        });
        marker.setMap(map);
    } else {
        var markerImage = new kakao.maps.MarkerImage('./images/mark_green.png', new kakao.maps.Size(37, 37));
        var marker = new kakao.maps.Marker({
            map: map,
            image: markerImage,
            position: position
        });
        marker.setMap(map);
    }

    //윈도우 인포에 표시할 내용
    var content = '<div class="custom">' + listData[i].cafeName +
        '<div style="color:red; font-size:11px;text-align:left;padding-top:4px">' + ' 남은 좌석 수:' + listData[i].seat + '</div></div>';

    var infowindow = new kakao.maps.InfoWindow({
        content: content
    });

// 마커에 이벤트를 등록하는 함수 만들고 즉시 호출하여 클로저를 만듭니다
    (function (marker, infowindow) {
        // 마커에 mouseover 이벤트를 등록하고 마우스 오버 시 인포윈도우를 표시
        kakao.maps.event.addListener(marker, 'mouseover', function () {
            infowindow.open(map, marker);
        });

        // 마커에 mouseout 이벤트를 등록하고 마우스 아웃 시 인포윈도우를 닫습니다
        kakao.maps.event.addListener(marker, 'mouseout', function () {
            infowindow.close();
        });
    })(marker, infowindow);
}



            </script>



            </div>

            <br><br>
            <div class="cafe-container"> <?php echo $data; ?>
          <script type="text/javascript">
           var a = <?php echo json_encode($location);?>;
              console.log(a);
          </script>
          </div>
          <!-- 구현해야하는 부분: 좌석 입력하면 버튼 변화-->
        </div>
    </main> </div>
</body>
</html>