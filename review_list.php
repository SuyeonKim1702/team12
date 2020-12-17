<!DOCTYPE html>
<html lang="ko">

<head>
<meta charset="UTF-8">
<title>List of Reviews</title>
<link rel = "stylesheet" href="myStyle.css" type = "text/css">
<link rel = "stylesheet" href="button.css" type = "text/css">
<link rel = "stylesheet" href="tag.css" type = "text/css">
<script src="https://kit.fontawesome.com/7b88aa951e.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
<script type="text/javascript" src="/test/wp-content/themes/child/script/jquery.jcarousel.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

<!-- 리뷰가 사용자 리뷰이면, 삭제 수정 버튼 나타나도록함-->
<style>
.manage{

}
</style>



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
$currentUser = $_SESSION['userIdx'];
$top = '<ul class="nav-menu">
<li><a href="logout.php">로그아웃</a></li>
</ul>';
}else{
  //로그인 안 되어있을 경우
  $currentUser = -1;
  $top = '<ul class="nav-menu">
  <li><a href="login.html">로그인</a></li>
  <li><a href="signin.html">회원가입</a></li>
  </ul>';


}



//카페 인덱스
 $index = $_GET['cafeIdx'];


$seat = [
  1 => "좌석 적은",
  2 => "좌석 적당",
  3 => "좌석 많은",
];

$mood = [
  1 => "소란스러운",
  2 => "무난한 소음",
  3 => "조용한",
];

$cost = [
  1 => "가격비싼",
  2 => "가격보통",
  3 => "가격저렴",
];


#db 연결 부분
$conn = mysqli_connect(
  '15.165.124.76',
  'osp',
  '1234',
  'cagong');



#리뷰 개수 가져오는 부분 c.cafeIdx는 카페인덱스마다 바뀌어야 함
$sql1="SELECT count(*) as count
from review
join cafe c on review.cafeIdx = c.cafeIdx
where c.cafeIdx=".$index.";";




#리뷰 리스트 가져오는 부분 c.cafeIdx는 카페인덱스마다 바뀌어야 함
  $sql2 = "SELECT reviewIdx, reviewContent,nickname, price, mood, seat, u.userIdx as userIdx, totalRating,CASE
  WHEN TIMESTAMPDIFF(MINUTE, review.createdAt, NOW()) <= 0 THEN '방금 전'
  WHEN TIMESTAMPDIFF(MINUTE, review.createdAt, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, review.createdAt, NOW()), '분 전')
  WHEN TIMESTAMPDIFF(HOUR, review.createdAt, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, review.createdAt, NOW()), '시간 전')
  WHEN TIMESTAMPDIFF(DAY, review.createdAt, NOW()) < 30 THEN CONCAT(TIMESTAMPDIFF(DAY, review.createdAt, NOW()), '일 전')
  ELSE CONCAT(TIMESTAMPDIFF(MONTH, review.createdAt, NOW()), '달 전')
END AS createdAt
FROM review
join cafe c on review.cafeIdx = c.cafeIdx
join user u on review.userIdx = u.userIdx
where c.cafeIdx = {$index};";

  $result = mysqli_query($conn, $sql2);

  $cnt = mysqli_query($conn, $sql1);




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
                    <a href="/team12/cafe_list.php">검색 결과</a>
                    <a href="/team12/cafe_info.php?cafeIdx=<?php echo $index ?>">카페 정보</a>
                    <a href="#">리뷰 목록</a>
                </nav>
            </div>
        </div>
        <div class="bottom-container">
          <br>
          <h2>
          <?php echo mysqli_fetch_assoc($cnt)['count']."건의 방문자 평가";?>
            <span class="btn_wrap">
              <input type="button" class="button" id="write_review" onclick = "location.href='write_review.php?cafeIdx=<?php echo $index ?>'" value="리뷰쓰기" />
            </span>
          </h2>

          <table class="review_list" width=600>
          <?php


$review_list_html ="";
while($row1 = mysqli_fetch_assoc($result)){


$review_number = count($row1);
$user_name = $row1['nickname'];
$user_image = "https://ifh.cc/g/9prJfA.png";
$upload_time = $row1['createdAt'];
$score =$row1['totalRating'];
$writer = $row1['userIdx'];
$comment = $row1['reviewContent'];
$reviewIdx = $row1['reviewIdx'];


$path='delete_review.php?cafeIdx='.$index.'&&reviewIdx='.$reviewIdx;


// 수정 삭제 버튼 html

if($currentUser == $writer ){
  $manage_review_html = "<span class='manage'>
  <form method='get' action='edit_review.php'>
    <input type='submit' class='button' id='edit_btn' value='수정'>
    <input type='hidden' name='reviewIdx' value=".$row1['reviewIdx'].">
    <input type='hidden' name='userIdx' value=".$currentUser.">
  <input type='hidden' name='cafeIdx' value=".$index.">
  </form>
  <form action='delete_review.php'>
  <input type='submit' class='button' id='delete_btn' value='삭제'>
  <input type='hidden' name='reviewIdx' value=".$row1['reviewIdx'].">
  <input type='hidden' name='userIdx' value=".$currentUser.">
  <input type='hidden' name='cafeIdx' value=".$index.">
  </form>

</span>";
}else{
  $manage_review_html = "";
}




$review_list_html = $review_list_html."<tr class='review'> <td width=120>
<image class='user_img' src='".$user_image."' width=100 height=100>
 <p style='text-align:center;'>".$user_name."</p>
 </td> <td class='review_result'><p>
 <span class='upload_time'>".$upload_time."</span>
 ".$manage_review_html."</p>
 <p>
    <span class='rating_result'><i class='fas fa-star' style='font-size:1.75em'></i>
    <font size=7>".$score."</font></span>
    <span class='tag_result'><input class='button' type='button' value='".$seat[$row1["seat"]]."'></span>
    <span class='tag_result'><input class='button' type='button' value='".$mood[$row1["mood"]]."'></span>
    <span class='tag_result'><input class='button' type='button' value='".$cost[$row1["price"]]."'></span>
</p>
<p class='comment'>".$comment."</p></td></tr>";




  }

 mysqli_close($conn);

 echo $review_list_html;

 ?>

          </table>
        </div>
    </main>
</div>


</body>
</html>
