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
$cafe_name ="카페 비엔";
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
                    <li><a href="/">검색 결과</a></li>
                    <li><a href="/">카페 정보</a></li>
                    <li><a href="/">리뷰 목록</a></li>
                </nav>
            </div>
        </div>

        <div class="bottom-container">
          <h1>Review</h1>
          <form name="reviewform" class="reviewform" method="post" action="write_review.js">
            <input type="hidden" name="rate" id="rate" value="0"/>
            <h3>
              <?php
                echo "<font color=#ff9900>".$cafe_name."</font>"."에 대한 솔직한 리뷰를 작성해주세요.";
              ?>
            </h3>
            <table class="review_tags">
              <tr><div id="review_tag1">
                <td><label class="category" for="price">가격</label></td>
                <td><label class="column">
                    <input type="radio" name="price" value="cheap">
                    <img src="/tags/저렴하다.png" height=30>
                  </label>
                  <label class="column">
                    <input type="radio" name="price" value="reasonable">
                    <img src="/tags/보통.png" height=30>
                  </label>
                  <label class="column">
                    <input type="radio" name="price" value="expensive">
                    <img src="/tags/비싸다.png" height=30>
                  </label></td>
              </div></tr>
              <tr><div id="review_tag2">
                <td><label class="category" for="mood">분위기</label></td>
                <td><label class="column">
                  <input type="radio" name="mood" value="quiet">
                  <img src="/tags/조용하다.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="mood" value="normal">
                  <img src="/tags/보통.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="mood" value="noisy">
                  <img src="/tags/소란스럽다.png" height=30>
                </label></td>
              </div><tr>
              <tr><div id="review_tag3">
                <td><label class="category" for="seat">좌석 갯수</label></td>
                <td><label class="column">
                  <input type="radio" name="seat" value="few">
                  <img src="/tags/적다.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="seat" value="average">
                  <img src="/tags/보통.png" height=30>
                </label>
                <label class="column">
                  <input type="radio" name="seat" value="many">
                  <img src="/tags/많다.png" height=30>
                </label></td>
              </div></tr>
            </table>

            <div class="review_rating">
                <div class="warning_msg">별점을 선택해 주세요.</div>
                <div class="rating">
                    <!-- 해당 별점을 클릭하면 해당 별과 그 왼쪽의 모든 별의 체크박스에 checked 적용 -->
                    <label  id="starrate" class="category" for="rating">별점</label>
                    <input type="checkbox" name="rating" id="rating1" value="1" class="rate_radio" title="1점">
                    <label for="rating1"></label>
                    <input type="checkbox" name="rating" id="rating2" value="2" class="rate_radio" title="2점">
                    <label for="rating2"></label>
                    <input type="checkbox" name="rating" id="rating3" value="3" class="rate_radio" title="3점" >
                    <label for="rating3"></label>
                    <input type="checkbox" name="rating" id="rating4" value="4" class="rate_radio" title="4점">
                    <label for="rating4"></label>
                    <input type="checkbox" name="rating" id="rating5" value="5" class="rate_radio" title="5점">
                    <label for="rating5"></label>
                </div>
            </div>
            <div class="review_contents">
                <div class="warning_msg">5자 이상으로 작성해 주세요.</div>
                <p><textarea name="description" placeholder="리뷰를 작성해주세요." rows="20" cols="70"></textarea></p>
            </div>
            <div class="cmd">
              <div class="btn_wrap">
                <input class="button" type="button" name="save" id="save" value="등록">
              </div>
              <div class="btn_wrap">
                <input class="button" type="button" name="cancel" id="cancel" value="취소">
              </div>
                <!-- 취소 기능 아직 안함 -->
            </div>
          </form>
        </div>
    </main>
</div>

<!-- 아직 안한 부분: 리뷰 리스트 - 리뷰 수정, 삭제 -->

</body>
</html>
