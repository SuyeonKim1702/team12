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
ob_start(); // session 이용

//기본적으로 3명 정도 등록
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
          <br><br>
          <h2>
            <?php echo $review_number." 건의 방문자 평가";?>
            <span class="btn_wrap">
              <input type="button" class="button" id="write_review" onclick = "location.href='write_review.php'" value="리뷰쓰기" />
            </span>
          </h2>
          <table class="review_list" width=600>
          <?php

              while(--$idx>=0){

                print "<tr class='review'>";
                  print "<td width=120>";
                    print "<image class='user_img' src='".$user_image[$idx]."' width=100 height=100>";
                    print "<p style='text-align:center;'>".$user_name[$idx]."</p>";
                  print "</td>";
                  print "<td class='review_result'>";
                    print "<p>";
                    print "<span class='upload_time'>".$upload_time[$idx]."</span>";
                    // if($id == session_id){ //사용자의 리뷰이면 삭제 버튼 생성
                      print "<span class='manage' style='float: right; color:gray'>";


                        print "<span class='edit' style='margin-right:10px;'><a href='write_review.php'><i class='fas fa-edit'></i></a></span>";
                        // print "<span class='delete'><a href='#'><i class='fas fa-trash-alt'></i></a></span>";
                        // print "<span class='delete' ><i class='fas fa-trash-alt'></i></span>";

                        print "<input type='button' value='삭제' id='delete'>";
                      // 삭제 및 수정 기능 구현하기

                      print "</span>";
                    // }
                    print "</p>";
                    print "<p class='rating_result'>";
                      print "<i class='fas fa-star' style='font-size:1.75em'></i>";
                      print "<font size=7>".$score[$idx]."</font>"."<font size=6>".".0"."</font>";
                      for($i=0; $i<3; $i++){
                        print "<img class='tag_result' src='".$selectedtags[$idx][$i]."' height=30>";
                      }
                    print "</p>";
                    print "<p class='comment'>".$comment[$idx]."</p>";
                  print "</td>";
                print "</tr>";
              }
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
