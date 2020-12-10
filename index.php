<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION[ 'is_logged' ]) && $_SESSION[ 'is_logged' ] == 'Y'){
//로그인 되었을 경우 

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
                    <ul class="nav-menu">
                        <li><a href="login.html">로그인</a></li>
                        <li><a href="signin.html">회원가입</a></li>
                    </ul>
                </nav>
                <div class="main-content" >
                    <div class="title">
                        <h1>카공족을 위한</h1>
                        <h1>맞춤 카페 추천서비스</h1>
                    </div> 
                    <form class = "main-searchbox" method = "POST" name="main-searchbox">
                        <div style="display:flex">
                            <input type="search" placeholder="카페 이름 또는 태그 설정" onclick="drop()"/>
                            <button type = "submit" class = "search-btn"><i class="fas fa-search" style="color:white; font-size:20px;"></i></button>
                        </div>
                        <div id="drop-taglist" style="display:block;">
                            <button type="button" class="tag-btn" name="tag1" value="좌석 많은">#좌석많은</button>
                            <button type="button" class="tag-btn" name="tag2" value="24시간">#24시간</button>
                            <button type="button" class="tag-btn" name="tag3" value="조용한">#조용한</button>
                            <button type="button" class="tag-btn" name="tag4" value="와이파이">#와이파이</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="bottom-container">
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
            <div class="bottom-right-container">
                <div id="map" style="width:620px;height:480px;"></div>
                <script type="text/javascript" src = "homeMap.js"></script>
            </div>
        </div>
    </main>

</div>
</body>
</html>