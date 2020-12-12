
<!DOCTYPE html>
<html lang="ko">

<head>
<meta charset="UTF-8">
<title>Write or Edit a Review</title>
<link rel="stylesheet" href="review.css" type = "text/css">
<link rel="stylesheet" href="button.css" type = "text/css">
<script type="text/javascript" src="write_review.js"></script>

<script src="https://kit.fontawesome.com/7b88aa951e.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">

<?php
function submit_edit(){
  #db 연결 부분
  $conn = mysqli_connect(
    '15.165.124.76',
    'osp',
    '1234',
    'cagong');

  $modified_review = "UPDATE review
  SET reviewContent = '{$reviewContent}', price = {$price}, mood= {$mood}, seat = {$seat}, totalRating = {$totalRating}
  WHERE reviewIdx = {$reviewIdx};";
//변수 수정해야함 - 어떤식으로 db에 설정되어있는지 모르겠음
   if (!mysqli_query($conn,$sql)){
  die('Error: ' . mysqli_error($conn)); }
}
if(array_key_exists('edit', $_POST)){
  submit_edit();
}

?>
</head>

<body>

<!-- https://stackoverflow.com/questions/17541614/use-images-instead-of-radio-buttons -->
<!-- https://blogpack.tistory.com/695 -->

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
                <div class="main-content">
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

          <form name="reviewform" class="reviewform" method="post" action="review_list.php">
            <input type="hidden" name="id" value="review">
            <!-- 카페 정보창에서 db에서 찾은 cafe idx를 write_review 창에 넘겨준 값-->
            <input type="hidden" name="cafeIdx" value="<?=  $_SESSION['cafeIdx'] ?>">
            <!-- 로그인 시 설정된 User idx를 넘겨받음 -->
            <input type="hidden" name="userIdx" value="<?= $_SESSION['userIdx'] ?>">

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
                    <input type="radio" name="price" id="cheap" value="가격저렴">
                    <img src="/tags/저렴하다.png" height=30>
                  </label>
                  <label class="column">
                    <input type="radio" name="price" id="reasonable" value="가격적당">
                    <img src="/tags/보통.png" height=30>
                  </label>
                  <label class="column">
                    <input type="radio" name="price" id="expensive" value="가격비쌈">
                    <img src="/tags/비싸다.png" height=30>
                  </label></td>
              </div></tr>
              <tr><div id="review_tag2">
                <td><label class="category" for="mood">분위기</label></td>
                <td><label class="column">
                  <input type="radio" name="mood" id="quiet" value="조용한">
                  <img src="/tags/조용하다.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="mood" id="normal" value="적당한">
                  <img src="/tags/보통.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="mood" id="noisy" value="소란스러운">
                  <img src="/tags/소란스럽다.png" height=30>
                </label></td>
              </div></tr>
              <tr><div id="review_tag3">
                <td><label class="category" for="seat">좌석 갯수</label></td>
                <td><label class="column">
                  <input type="radio" name="seat" id="few" value="붐비는">
                  <img src="/tags/적다.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="seat" id="average" value="좌석보통">
                  <img src="/tags/보통.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="seat" id="many" value="좌석많은">
                  <img src="/tags/많다.png" height=30>
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
                <p><textarea name="description" placeholder="리뷰를 작성해주세요." rows="20" cols="70"></textarea></p>
            </div>

            <div class="cmd">
              <form class="btn_wrap" method="post">
                <input class="button" type="submit" name="edit" id="edit" value="수정">
              </form>
              <div class="btn_wrap">
                <input class="button" type="reset" name="cancel" id="cancel" value="취소" onclick="review_list.php">
              </div>
              <!-- 수정하면 db에 업로드하고, 취소하면 이때까지 수정한 것은 db에 업로드 되지 않게 하려함 -->
            </div>

          </form>
        </div>
    </main>
</div>

</body>
</html>