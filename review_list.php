<!DOCTYPE html>
<html lang="ko">

<head>
<meta charset="UTF-8">
<title>List of Reviews</title>
<link rel = "stylesheet" href="review.css" type = "text/css">
<link rel = "stylesheet" href="button.css" type = "text/css">



<script src="https://kit.fontawesome.com/7b88aa951e.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">

<?php


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
  1 => "가격 비싼",
  2 => "가격 보통",
  3 => "저렴한",
];


#db 연결 부분 
$conn = mysqli_connect(
  '15.165.124.76',
  'osp',
  '1234',
  'cagong');



#작성한 리뷰 post 하는 부분    
$new_review = "INSERT INTO review (reviewContent, userIdx, cafeIdx, price, mood, seat, totalRating)
VALUES
('$reviewContent', $userIdx, $cafeIdx, $price, $mood, $seat, $totalRating);";

# if (!mysqli_query($conn,$sql)){
#die('Error: ' . mysqli_error($conn)); }


#작성한 리뷰 수정하는 부분
$modified_review = "UPDATE review
SET reviewContent = '{$reviewContent}', price = {$price}, mood= {$mood}, seat = {$seat}, totalRating = {$totalRating}
WHERE reviewIdx = {$reviewIdx};";

# if (!mysqli_query($conn,$sql)){
#die('Error: ' . mysqli_error($conn)); }

          
#작성한 리뷰 삭제하는 부분 

$deleted_review = "DELETE FROM review WHERE reviewIdx = {$reviewIdx};";
 # if (!mysqli_query($conn,$sql)){
#die('Error: ' . mysqli_error($conn)); }




#리뷰 개수 가져오는 부분 c.cafeIdx는 카페인덱스마다 바뀌어야 함
$sql1="SELECT count(*) as count
from review
join cafe c on review.cafeIdx = c.cafeIdx
where c.cafeIdx=2;";




#리뷰 리스트 가져오는 부분 c.cafeIdx는 카페인덱스마다 바뀌어야 함
  $sql2 = "SELECT reviewIdx, reviewContent,nickname, price, mood, seat, totalRating,CASE
  WHEN TIMESTAMPDIFF(MINUTE, review.createdAt, NOW()) <= 0 THEN '방금 전'
  WHEN TIMESTAMPDIFF(MINUTE, review.createdAt, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, review.createdAt, NOW()), '분 전')
  WHEN TIMESTAMPDIFF(HOUR, review.createdAt, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, review.createdAt, NOW()), '시간 전')
  WHEN TIMESTAMPDIFF(DAY, review.createdAt, NOW()) < 30 THEN CONCAT(TIMESTAMPDIFF(DAY, review.createdAt, NOW()), '일 전')
  ELSE CONCAT(TIMESTAMPDIFF(MONTH, review.createdAt, NOW()), '달 전')
END AS createdAt
FROM review
join cafe c on review.cafeIdx = c.cafeIdx
join user u on review.userIdx = u.userIdx
where c.cafeIdx = 2;";

  $result = mysqli_query($conn, $sql2);

  $cnt = mysqli_query($conn, $sql1);


  




#예전 코드                
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

// 새 리뷰 등록
if($_POST != null){

  session_start();
  $t1 = $_SESSION['upload_time']; //업로드 시간

  $t2 = new DateTime(); // 현재 시간
  $diff = $t2 -> diff($t1); // 시간 차이

  $year = $diff->format('%y'); //업로드 시간 현재 시간 차이 계산
  if($year == 0){
    $day = $diff->format('%d');
    if($day == 0){
      $hour = $diff->format('%h');
      if($hour == 0){
        $min = $diff->format('%m');
        $result_time ="{$min}분 전";
      }
      else{
        $result_time = "{$hour}시간 전";
      }

    }
    else{
      $result_time = "{$day}일 전";
    }
  }
  else{
    $result_time = "{$year}년 전";
  }

  // 별점 계산
  if(!empty($_POST['rating'])){
    $max = 0;
    foreach($_POST['rating'] as $check){
      if($max < $check) $max = $check;
    }
     $star_rate = $max;
  }

  // 로그인된 사용자로 설정하기
  $id = session_id(); // 사용자 id
  $new_user_name = "사용자 이름"; //
  $new_user_image = "images/사용자이미지1.png";

  // array_push로 새로운 리뷰 데이터 베열에 넣기
  array_push($user_name, $new_user_name); //로그인 된 이용자 이름
  array_push($user_image, $new_user_image); //로그인 된 이용자 이미지
  array_push($upload_time, $result_time);  //업로드 시간
  array_push($score, $star_rate); //별점
  array_push($selectedtags, array($_POST['price'], $_POST['mood'], $_POST['seat']));
  array_push($comment, $_POST['description']);


}

$review_number = count($user_name);
$idx = $review_number;


function delete() {
  global $idx;
    // if($id == session_id()){} //현재 사용자가 맞는지 확인
    unset($user_name[$idx]);
    unset($user_image[$idx]);
    unset($upload_time[$idx]);
    unset($score[$idx]);
    unset($selectedtags[$idx]);
    unset($comment[$idx]);


}
?>
<script language="javascript">
  var t = document.getElementByld('delete');
  function btn_listener(event){
    alert("버튼을 누르셨습니다.");
    <?delete();?>
    // window.onload = function(){
    //   if (location.href.indexOf('reloaded')==-1)
    //     location.replace(location.href+'?reloaded');
    // }
    if(self.name != "reload"){
      self.name = "reload";
      self.location.reload(true);
    }
    else self.name = "";
  }
  t.addEventListener('click', btn_listener);
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
          <br><br>
          <h2>
          <?php echo mysqli_fetch_assoc($cnt)['count']."건의 방문자 평가";?>
            <button type="button" id="write_review" type="submit"><img id="write_review_btn" src="images/리뷰쓰기.png" width=90 height=30></button>
          </h2>
          <table class="review_list" width=600>
          <?php


$review_list_html ="";
while($row1 = mysqli_fetch_assoc($result)){




$review_number = count($row1);
$user_name = $row1['nickname'];
$user_image = "images/사용자이미지2.png";
$upload_time = $row1['createdAt'];
$score =$row1['totalRating'];
$comment = $row1['reviewContent'];

$review_list_html = $review_list_html."<tr class='review'> <td width=120>
<image class='user_img' src='".$user_image."' width=100 height=100>
 <p style='text-align:center;'>".$user_name."</p>
 </td> <td class='review_result'>
 <p class='upload_time'>".$upload_time."</p>
 <p class='rating_result'>
   <font size=7>".$score."</font>
   <div>
   <div class='tag_result'>".$seat[$row1["seat"]]."</div>
   <div class='tag_result'>".$mood[$row1["mood"]]."</div>
   <div class='tag_result'>".$cost[$row1["price"]]."</div>
   </div>
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

<?php
session_unset();//세션 삭제됨
?>


</body>
</html>
