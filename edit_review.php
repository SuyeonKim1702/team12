
<!DOCTYPE html>
<html lang="ko">

<head>
<meta charset="UTF-8">
<title>Write or Edit a Review</title>
<link rel="stylesheet" href="button.css" type = "text/css">
<script type="text/javascript" src="write_review.js"></script>
<link rel = "stylesheet" href="myStyle.css" type = "text/css">


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



<?php


session_start();
if(isset($_SESSION[ 'is_logged' ]) && $_SESSION[ 'is_logged' ] == 'Y'){
//로그인 되었을 경우
$top = '<ul class="nav-menu">
<li><a href="logout.php">로그아웃</a></li>
</ul>';
}else{
  //로그인 안 되어있을 경우
  $top = '<ul class="nav-menu">
  <li><a href="login.html">로그인</a></li>
  <li><a href="signin.html">회원가입</a></li>
  </ul>';


}




$reviewIdx = $_GET['reviewIdx'];
$cafeIdx = $_GET['cafeIdx'];
$userIdx = $_GET['userIdx'];



  #db 연결 부분
  $conn = mysqli_connect(
    '15.165.124.76',
    'osp',
    '1234',
    'cagong');




  #리뷰 리스트 가져오는 부분 c.cafeIdx는 카페인덱스마다 바뀌어야 함
  $sql = "SELECT reviewIdx, reviewContent, price, mood, seat, totalRating
FROM review
where reviewIdx = {$reviewIdx};";

  $result = mysqli_query($conn, $sql);

  while($row1 = mysqli_fetch_assoc($result)){
   $reviewContent = $row1['reviewContent'];
   $price = $row1['price'];
   $mood = $row1['mood'];
   $seat = $row1['seat'];
   $totalRating = $row1['totalRating'];


  }

  $info ="SELECT cafename
  from cafe
  where cafeIdx = {$cafeIdx};";

$result = mysqli_query($conn, $info);

while($row1 = mysqli_fetch_assoc($result)){
 $cafe_name = $row1['cafename'];


 }



?>
<!-- 페이지 로딩 시 별점 초기화 -->
<!-- <script>
window.onload = function(){
    new Rating().setRate("<? echo $totalRating; ?>");
}
</script> -->



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
                <div class="main-content">
                    <div class="title">
                        <h1>카공족을 위한</h1>
                        <h1>맞춤 카페 추천서비스</h1>
                    </div>
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
            <div>
                <nav class = "nav_cafe">
                    <a href="/team12/cafe_list.php">검색 결과</a>
                    <a href="/team12/cafe_info.php?cafeIdx=<?echo $cafeIdx ?>">카페 정보</a>
                    <a href="/team12/review_list.php?cafeIdx=<?echo $cafeIdx ?>">리뷰 목록</a>
                </nav>
            </div>
        </div>

        <div class="bottom-container">

        <form name="reviewform" class="reviewform" method="post" action="modify_review.php?cafeIdx=<?php echo $cafeIdx?> ">
            <input type="hidden" name="reviewIdx" value="<?=  $reviewIdx ?>">
            <!-- 카페 정보창에서 db에서 찾은 cafe idx를 write_review 창에 넘겨준 값-->
            <input type="hidden" name="cafeIdx" value="<?=  $cafeIdx ?>">
            <!-- 로그인 시 설정된 User idx를 넘겨받음 -->
            <input type="hidden" name="userIdx" value="<?= $userIdx?>">

            <br><br>
            <h3>
              <?php
                echo "<font color=#ff9900>".$cafe_name."</font>"."에 대한 솔직한 리뷰를 작성해주세요.";
              ?>
            </h3>
            <br>

            <table class="review_tags">
              <tr><div id="review_tag1">
                <td><label class="category" for="price">가격</label></td>
                <td><label class="column">
                    <input type="radio" name="price" id="cheap" value="가격저렴"
                    <?php echo ($price == 1) ?  "checked" : "" ;  ?>>
                    <img src="https://ifh.cc/g/1pkryN.png" height=30>
                  </label>
                  <label class="column">
                    <input type="radio" name="price" id="reasonable" value="가격적당"
                    <?php echo ($price == 2) ?  "checked" : "" ;  ?>>
                    <img src="https://ifh.cc/g/3hVQWs.png" height=30>
                  </label>
                  <label class="column">
                    <input type="radio" name="price" id="expensive" value="가격비쌈"
                    <?php echo ($price == 3) ?  "checked" : "" ;  ?>>
                    <img src="https://ifh.cc/g/NJJRV4.png" height=30>
                  </label></td>
              </div></tr>
              <tr><div id="review_tag2">
                <td><label class="category" for="mood">분위기</label></td>
                <td><label class="column">
                  <input type="radio" name="mood" id="quiet" value="조용한"
                  <?php echo ($mood == 3) ?  "checked" : "" ;  ?>>
                  <img src="https://ifh.cc/g/8awCDu.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="mood" id="normal" value="적당한"
                  <?php echo ($mood == 2) ?  "checked" : "" ;  ?>>
                  <img src="https://ifh.cc/g/3hVQWs.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="mood" id="noisy" value="소란스러운"
                  <?php echo ($mood == 1) ?  "checked" : "" ;  ?>>
                  <img src="https://ifh.cc/g/ky4IYe.png" height=30>
                </label></td>
              </div></tr>
              <tr><div id="review_tag3">
                <td><label class="category" for="seat">좌석 갯수</label></td>
                <td><label class="column">
                  <input type="radio" name="seat" id="few" value="붐비는"
                  <?php echo ($seat == 1) ?  "checked" : "" ;  ?>>
                  <img src="https://ifh.cc/g/MhzAXQ.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="seat" id="average" value="좌석보통"
                  <?php echo ($seat == 2) ?  "checked" : "" ;  ?>>
                  <img src="https://ifh.cc/g/3hVQWs.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="seat" id="many" value="좌석많은"
                  <?php echo ($seat == 3) ?  "checked" : "" ;  ?>>
                  <img src="https://ifh.cc/g/81B96w.png" height=30>
                </label></td>
              </div></tr>
            </table>


            <div class="review_rating">
                <div class="warning_msg">별점을 선택해 주세요.</div>
                <div class="rating">
                    <!-- 해당 별점을 클릭하면 해당 별과 그 왼쪽의 모든 별의 체크박스에 checked 적용 -->

                    <label  id="starrate" class="category" for="rating">별점</label>
                    <input type="hidden" name="rate" id="rate" value="0"/>
                    <input type="checkbox" name="rating[]" id="rating1" value="1" class="rate_radio" title="1점">
                    <label for="rating1"></label>
                    <input type="checkbox" name="rating[]" id="rating2" value="2" class="rate_radio" title="2점">
                    <label for="rating2"></label>
                    <input type="checkbox" name="rating[]" id="rating3" value="3" class="rate_radio" title="3점" >
                    <label for="rating3"></label>
                    <input type="checkbox" name="rating[]" id="rating4" value="4" class="rate_radio" title="4점">
                    <label for="rating4"></label>
                    <input type="checkbox" name="rating[]" id="rating5" value="5" class="rate_radio" title="5점">
                    <label for="rating5"></label>
                </div>
            </div>

            <br>

            <div class="review_contents" name="reviewContent">
                <div class="warning_msg">5자 이상으로 작성해 주세요.</div>
                <p><textarea name="description" placeholder="리뷰를 작성해주세요." rows="20" cols="70"><?php echo $reviewContent; ?> </textarea></p>
            </div>

            <div class="cmd">
              <form class="btn_wrap" method="post" action='modify_review.php'>
                <input class="button" type="submit" name="edit" id="edit" value="수정">

              </form>
              <div class="btn_wrap">
                <input class="button" type="reset" name="cancel" id="cancel" value="취소" onclick="history.back(1)">
              </div>
              <!-- 수정하면 db에 업로드하고, 취소하면 이때까지 수정한 것은 db에 업로드 되지 않게 하려함 -->
            </div>

          </form>
        </div>
    </main>
</div>

</body>
</html>
