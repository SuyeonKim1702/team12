<!DOCTYPE html>
<html lang="ko">

<head>
<meta http-equiv="Content-Type"
content="text/html; charset=UTF-8" />
<title>Write or Edit a Review</title>
<link rel="stylesheet" href="review.css">
</head>

<body>
<script type="text/javascript" src="review.js"></script>

<div>

<form name="reviewform" class= "reviewform" method="post" action="show_review.php">

<!-- 전체 레이아웃 아직 적용 안함 -->
<!-- 분위기, 좌석갯수 태그 추가 -->
<!-- https://stackoverflow.com/questions/17541614/use-images-instead-of-radio-buttons -->
<!-- https://blogpack.tistory.com/695 -->
<div class="wrap">
    <h1>Review</h1>
    <form name="reviewform" class="reviewform" method="post" action="show_review.php">
        <input type="hidden" name="rate" id="rate" value="0"/>
        <h3>
          <?php
            echo "<font color=blue>";
            echo $_GET['cafe_name'];
            echo "</font>";
            echo "에 대한 솔직한 리뷰를 작성해주세요."; #카페이름 url 파라미터로 받기
          ?>
        </h3>
        <table class="review_tags">
          <tr><div id="review_tag1">
            <td><label class="category" for="price">가격</label></td>
            <td><label class="column">
              <input type="radio" name="price" value="cheap" checked>
              <img src="/images/저렴하다.png" width=60 height=30>
            </label>
            <label class="column">
              <input type="radio" name="price" value="reasonable">
              <img src="/images/보통.png" width=60 height=30>
            </label>
            <label class="column">
              <input type="radio" name="price" value="expensive">
              <img src="/images/비싸다.png" width=60 height=30>
            </label></td>
          </div></tr>
          <tr><div id="review_tag2">
            <td><label class="category" for="mood">분위기</label></td>
            <td><label class="column">
              <input type="radio" name="mood" value="quiet" checked>
              <img src="/images/조용하다.png" width=60 height=30>
            </label>
            <label class="column">
              <input type="radio" name="mood" value="normal">
              <img src="/images/보통.png" width=60 height=30>
            </label>
            <label class="column">
              <input type="radio" name="mood" value="noisy">
              <img src="/images/소란스럽다.png" width=60 height=30>
            </label></td>
          </div><tr>
          <tr><div id="review_tag3">
            <td><label class="category" for="seat">좌석 갯수</label></td>
            <td><label class="column">
              <input type="radio" name="seat" value="few" checked>
              <img src="/images/적다.png" width=60 height=30>
            </label>
            <label class="column">
              <input type="radio" name="seat" value="average">
              <img src="/images/보통.png" width=60 height=30>
            </label>
            <label class="column">
              <input type="radio" name="seat" value="many">
              <img src="/images/많다.png" width=60 height=30>
            </label></td>
          </div></tr>
        </table>

        <table class="review_rating">
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
        </table>
        <div class="review_contents">
            <div class="warning_msg">5자 이상으로 작성해 주세요.</div>
            <p><textarea name="description" placeholder="리뷰를 작성해주세요." rows="20" cols="70"></textarea></p>
        </div>
        <div class="cmd">
            <input type="button" name="save" id="save" value="등록">
            <input type="button" name="cancel" id="cancel" value="취소">
            <!-- 취소 기능 아직 안함 -->
        </div>
    </form>
</div>

<!-- 아직 안한 부분: 리뷰 리스트 - 리뷰 수정, 삭제 -->
<!--
리뷰 작성 시간 저장하기

<div>
<?php
echo date('Y-m-d H:i:s');
?>
</div>
 -->

</body>
</html>
