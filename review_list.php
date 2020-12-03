<!DOCTYPE html>
<html lang="ko">

<head>
<meta charset="UTF-8">
<title>List of Reviews</title>
<link rel="stylesheet" href="review_list.css">
<link rel = "stylesheet" href="review.css" type = "text/css">
<script src="https://kit.fontawesome.com/7b88aa951e.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">

<?php
$review_number = 3;
$user_name = array("공시생", "mina98", "먹짱123");
$user_image = array("images/사용자이미지2.png", "images/사용자이미지1.png", "images/사용자이미지1.png");
$upload_time = array("5일 전", "2일 전", "2시간 전");
$score = array(4, 3, 4);
$selectedtags = array(array("tags/붐비는.png", "tags/조용한.png", "tags/가격적당.png"),
array("tags/좌석많은.png", "tags/소란스러운.png", "tags/가격비쌈.png"),
array("tags/좌석많은.png","tags/소란스러운.png","tags/가격적당.png"));
$comment = array("주말에 이용했더니 사람이 많아서 10분정도 대기했습니다..! 그래도 조용하 가격도 적당해서 잘 이용했어요 ㅎㅎ 공부하기 좋은 카페 추천합니다!!",
"지금까지 잘 이용했는데 갑자기 가격을 올렸네요... 공사 중이라 그런지 너무 시끄럽고 어수선하기도 하고요... 앞으로는 잘 이용 안할 듯 합니다.",
"늘 다니던 독서실이 문을 닫아서 처음 방문했는데 좌석도 많고 가격도 합리적이여 좋았습니다. 다만 음악소리가  크고 소란스러워서 다소 어수선했습니다.");
$count=$review_number;
?>
</head>
<body>

<!-- 지금은 데이터를 배열(사용자리뷰 작성 시간순)로 저장했는데, 동적으로 값 전달 받아서 출력하도록 변경해야 함 -->
<!-- 전체 레이아웃 아직 적용 안함 -->
<!-- 자신의 글 수정, 삭제 가능하도록 변경헤야 함 -->
<!-- 검색창 추가 해야 함 -->
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
        <div class="bottom-container">
          <h1>Review List</h1>
          <h2>
            <?php echo $review_number."건의 방문자 평가";?>
            <button type="button" id="write_review" type="submit"><img id="write_review_btn" src="images/리뷰쓰기.png" width=90 height=30></button>
          </h2>

          <table class="review_list" width=600>
          <?php
              while(--$count>=0){
                print "<tr class='review'>";
                  print "<td width=120>";
                    print "<image class='user_img' src='".$user_image[$count]."' width=100 height=100>";
                    print "<p style='text-align:center;'>".$user_name[$count]."</p>";
                  print "</td>";
                  print "<td class='review_result'>";
                    print "<p class='upload_time'>".$upload_time[$count]."</p>";
                    print "<p class='rating_result'>";
                      print "<font size=7>".$score[$count]."</font>";
                      for($i=0; $i<3; $i++){
                        print "<img class='tag_result' src='".$selectedtags[$count][$i]."' height=30>";
                      }
                    print "</p>";
                    print "<p class='comment'>".$comment[$count]."</p>";
                  print "</td>";
                print "</tr>";
              }
          ?>
          </table>
        </div>
    </main>
</div>


</body>
</html>
