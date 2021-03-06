<!DOCTYPE html>
<?php

session_start();
if(isset($_SESSION[ 'is_logged' ]) && $_SESSION[ 'is_logged' ] == 'Y'){
//로그인 되었을 경우 
$top = '<ul class="nav-menu">
<li><a href="logout.php">Log Out</a></li>
</ul>';

}else{
    $top = '<ul class="nav-menu">
<li><a href="login.html">Log In</a></li>
<li><a href="signin.html">Sign Up</a></li>
</ul>';

}


$conn = mysqli_connect(
    '15.165.124.76',
    'osp',
    '1234',
    'cagong');


$cafelist = "SELECT cafeIdx as cafeIdx, x, y, cafename, availableSeat
from cafe;";

$result = mysqli_query($conn, $cafelist);

$location = array();

while($row1 = mysqli_fetch_assoc($result)){
 $x = $row1['x'];
 $y = $row1['y'];
 $cafeName = $row1['cafename'];
 $seat = $row1['availableSeat'];


 array_push($location, array("x" => $x, "y" => $y, "cafeName" => $cafeName, "seat" => $seat));

 
}




?>


<head>
    <meta charset="UTF-8">
    <title>KAGONG</title>
    <link rel = "stylesheet" href="myStyle.css" type = "text/css">
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=16e368477251c61b33e8b365f4d7a601"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=APIKEY&libraries=LIBRARY"></script>
    <script src="https://kit.fontawesome.com/7b88aa951e.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
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
                        <h1>Cafe Review and Recommendation</h1>
                        <h1>Service for Kagong People</h1>
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
        </div>
        <div class="bottom-container_2">
            <!--    왼쪽 영역     -->
            <div class="bottom-left-container">
                <div class="intro">
                    <p>You can check nearby cafes
                    <p>and updated seat status
                    <p>based on your current location
                </div>
                <div class="pointerInfo">
                    <ul class="info-list">
                        <li><i class="fas fa-map-marker-alt" style="color:#FF3300"></i>:Almost full</li>
                        <li><i class="fas fa-map-marker-alt" style="color: #FFCC00"></i>:Usual</li>
                        <li><i class="fas fa-map-marker-alt" style="color:#009900"></i>:Enough</li>
                    </ul>
                </div>
            </div>
            <!-- 오른쪽 영역: 지도 -->
            <div class="bottom-right-container">
                <div id="map" style="width:620px;height:480px;"></div>
                <script type="text/javascript">
           var a = <?php echo json_encode($location);?>;


            var mapContainer = document.getElementById('map'), // 지도를 표시할 div
    mapOption = {
        center: new kakao.maps.LatLng(37.55708709545054, 126.94558145584872), // 지도의 중심좌표
        level: 2 // 지도의 확대 레벨
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
        </div>
    </main>

</div>
</body>
</html>








</html>







