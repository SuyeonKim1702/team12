<!DOCTYPE html>
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


<script type="text/javascript">
           var a = <?php echo json_encode($location);?>;


              console.log(a);


          </script>
   
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
                        <a href="index.html">KAGONG</a>
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
                        <div style="display:flex">
                            <input type="search" placeholder="카페 이름 입력 또는 태그 설정" name="cafeName" id="cafeName" onclick="drop()"/>
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
        <div class="bottom-container">
            <!--    왼쪽 영역     -->
            <div class="bottom-left-container">
                <div class="intro">
                    <p>회원님의 현재 위치를 기반으로
                    <p>주변의 카페 및 업데이트 된
                    <p>좌석 현황을 볼 수 있습니다.
                </div>
                <div class="pointerInfo">
                    <ul class="info-list">
                        <li><i class="fas fa-map-marker-alt" style="color:#FF3300"></i>:거의 만석</li>
                        <li><i class="fas fa-map-marker-alt" style="color: #FFCC00"></i>:보통</li>
                        <li><i class="fas fa-map-marker-alt" style="color:#009900"></i>:여유</li>
                    </ul>
                </div>
            </div>
            <!-- 오른쪽 영역: 지도 -->
            <div class="bottom-right-container">
                <div id="map" style="width:620px;height:480px;"></div>
                <script type="text/javascript" src = "homeMap.js"></script>
            </div>
        </div>
    </main>

</div>
</body>
</html>