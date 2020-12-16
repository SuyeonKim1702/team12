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
<!-- 리뷰가 사용자 리뷰이면, 삭제 수정 버튼 나타나도록함-->
<style>
.manage{

}
</style>

<?php


session_start();
if(isset($_SESSION[ 'is_logged' ]) && $_SESSION[ 'is_logged' ] == 'Y'){
//로그인 되었을 경우 
$currentUser = $_SESSION['userIdx'];
$top = '<ul class="nav-menu">
<li><a href="login.html">로그아웃</a></li>
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
//$index = $_SESSION['cafeIdx'];




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



#작성한 리뷰 post 하는 부분 - 원본
// $new_review = "INSERT INTO review (reviewContent, userIdx, cafeIdx, price, mood, seat, totalRating)
// VALUES
// ('$reviewContent', $userIdx, $cafeIdx, $price, $mood, $seat, $totalRating);";
//
//  if (!mysqli_query($conn,$sql)){
// die('Error: ' . mysqli_error($conn)); }

#작성한 리뷰 post 하는 부분 - 수정
// 별점 계산

#$reviewContent =$_POST['reviewContent'];
#$price = $_POST['price'];
#$mood = $_POST['mood'];
#$seat = $_POST['seat'];

#$new_review = "INSERT INTO review (reviewContent, userIdx, cafeIdx, price, mood, seat, totalRating)
#VALUES
#('$reviewContent', $currentUser, $index, $price, $mood, $seat, $star_rate);";

 #if (!mysqli_query($conn,$sql)){
#die('Error: ' . mysqli_error($conn)); }


#작성한 리뷰 수정하는 부분 - 원본
#$modified_review = "UPDATE review
#SET reviewContent = '{$reviewContent}', price = {$price}, mood= {$mood}, seat = {$seat}, totalRating = {$totalRating}
#WHERE reviewIdx = {$reviewIdx};";

# if (!mysqli_query($conn,$sql)){
#die('Error: ' . mysqli_error($conn)); }

#작성한 리뷰 수정하는 부분 - 원본
// $modified_review = "UPDATE review
// SET reviewContent = '{$reviewContent}', price = {$price}, mood= {$mood}, seat = {$seat}, totalRating = {$totalRating}
// WHERE reviewIdx = {$reviewIdx};";
//
//  if (!mysqli_query($conn,$sql)){
// die('Error: ' . mysqli_error($conn)); }


#작성한 리뷰 삭제하는 부분

// $deleted_review = "DELETE FROM review WHERE reviewIdx = {$reviewIdx};";
//  if (!mysqli_query($conn,$sql)){
// die('Error: ' . mysqli_error($conn)); }




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







#예전 코드
// $review_number = 3;
// $user_name = array("공시생", "mina98", "먹짱123");
// $user_image = array("images/사용자이미지2.png", "images/사용자이미지1.png", "images/사용자이미지1.png");
// $upload_time = array("5일 전", "2일 전", "2시간 전");
// $score = array(4, 3, 4);
// $selectedtags = array(array("tags/붐비는.png", "tags/조용한.png", "tags/가격적당.png"),
// array("tags/좌석많은.png", "tags/소란스러운.png", "tags/가격비쌈.png"),
// array("tags/좌석많은.png","tags/소란스러운.png","tags/가격적당.png"));
// $comment = array("주말에 이용했더니 사람이 많아서 10분정도 대기했습니다..! 그래도 조용하 가격도 적당해서 잘 이용했어요 ㅎㅎ 공부하기 좋은 카페 추천합니다!!",
// "지금까지 잘 이용했는데 갑자기 가격을 올렸네요... 공사 중이라 그런지 너무 시끄럽고 어수선하기도 하고요... 앞으로는 잘 이용 안할 듯 합니다.",
// "늘 다니던 독서실이 문을 닫아서 처음 방문했는데 좌석도 많고 가격도 합리적이여 좋았습니다. 다만 음악소리가  크고 소란스러워서 다소 어수선했습니다.");
// $count=$review_number;
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
                    <form class = "main-searchbox" method = "POST" name="main-searchbox">
                        <input type="search" placeholder="카페 이름 또는 태그 설정" />
                        <button type = "submit"><i class="fas fa-search" style="color:white; font-size:20px;"></i></button>
                    </form>
                </div>
            </div>
            <div>
                <nav class = "nav_cafe">
                    <a href="cafe_list.php">검색 결과</a>
                    <a href="/team12/cafe_info.php?cafeIdx=<?echo $index ?>">카페 정보</a>
                    <a href="">리뷰 목록</a>
                </nav>
            </div>
        </div>
        <div class="bottom-container">
          <h1>Review List</h1>
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
$writer = $row1['userIdx'];
$comment = $row1['reviewContent'];
$reviewIdx = $row1['reviewIdx'];


$path='delete_review.php?cafeIdx='.$index.'&&reviewIdx='.$reviewIdx;



// 수정 삭제 버튼 html

if($currentUser == $writer ){
  $manage_review_html = "<span class='manage' style='float: right;'>
  <form action='edit_review.php'>
    <input type='submit' class='button' value='수정' id='edit'>
    <input type='hidden' name='reviewIdx' value=".$row1['reviewIdx'].">
    <input type='hidden' name='userIdx' value=".$currentUser.">
  <input type='hidden' name='cafeIdx' value=".$index.">
  </form>
  <form action='delete_review.php'>
  <input type='submit' class='button' value='삭제' id='delete'>
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
 </td> <td class='review_result'>
 <span class='upload_time'>".$upload_time."</span>
 ".$manage_review_html."
 <p class='rating_result'>
   <font size=7>".$score."</font>
   <div>
   <span class='tag_result'><input type='button' value='".$seat[$row1["seat"]]."'></span>
   <span class='tag_result'><input type='button' value='".$mood[$row1["mood"]]."'></span>
   <span class='tag_result'><input type='button' value='".$cost[$row1["price"]]."'></span>
   </div>
</p>
<p class='comment'>".$comment."</p></td></tr>";




  }
//reviewIdx를 edit_review.php로 가져가고 싶은데 정보가 어떤 형식(변수)으로 주어진지 모르겠다.
//edit_review.php로 reviewIdx를 가져가서, reivew 정보를 html에 업로드할 수 있게 하려함.
 mysqli_close($conn);

 echo $review_list_html;

 ?>

          </table>
        </div>
    </main>
</div>


</body>
</html>
