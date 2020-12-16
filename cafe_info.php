<!DOCTYPE html>
<?php

session_start();
if(isset($_SESSION[ 'is_logged' ]) && $_SESSION[ 'is_logged' ] == 'Y'){
//로그인 되었을 경우
$top = '<ul class="nav-menu">
<li><a href="logout.php">로그아웃</a></li>
</ul>';

}else{
    $top = '<ul class="nav-menu">
<li><a href="login.html">로그인</a></li>
<li><a href="signin.html">회원가입</a></li>
</ul>';

}



$index = $_GET['cafeIdx'];
$path = 'seat.php?cafeIdx='.$index;
$review_path ='review_list.php?cafeIdx='.$index;

function phone_number_format($number)
{
    if(preg_match( '/(\d{3})(\d{4})(\d{4})$/', $number,  $matches))
    {
        return "{$matches[1]}-{$matches[2]}-{$matches[3]}";
    }
    else
    {
        return $number;
    }
}



  $conn = mysqli_connect(
    '15.165.124.76',
    'osp',
    '1234',
    'cagong');

    $info ="SELECT cafeIdx, cafename, availableSeat, tel, address
    from cafe
    where cafeIdx = {$index};";

    $hashtag = "SELECT h.hashtagIdx as hashtagIdx, hashtagName
    from hashtagList
    join hashtag h on hashtagList.hashtagIdx = h.hashtagIdx
    where cafeIdx ={$index}
    group by h.hashtagIdx;";

    $avg_rating = "SELECT AVG(totalRating) as rating
    from review
    where cafeIdx = {$index};";



$result = mysqli_query($conn, $info);

while($row1 = mysqli_fetch_assoc($result)){
  $cafeIdx = $row1['cafeIdx'];
  $cafeName = $row1['cafename'];
  $seat = $row1['availableSeat'];
  $tel = phone_number_format($row1['tel']);
  $address = $row1['address'];
}

$result = mysqli_query($conn, $hashtag);

$i = 0;
$tags = array();
while($row1 = mysqli_fetch_assoc($result)){
  array_push($tags, $row1['hashtagName']);

}


$result = mysqli_query($conn, $avg_rating);

while($row1 = mysqli_fetch_assoc($result)){
$cafeRating = $row1['rating'];
}




?>



<head>
  <meta charset="UTF-8">
  <title>Details about Cafe</title>
  <link rel= "stylesheet" href="review.css" type = "text/css">
  <link rel= "stylesheet" href="button.css" type = "text/css">
  <link rel = "stylesheet" href="tag.css" type="text/css">
  <link rel= "stylesheet" href="cafe_info.css" type = "text/css">
  <script src= "https://kit.fontawesome.com/7b88aa951e.js" crossorigin="anonymous"></script>
  <link rel= "preconnect" href = "https://fonts.gstatic.com">
  <link href= "https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
</head>

<body>

<div>
    <main class="pg-main">
        <div class = "top-container">
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
                    <a href="#">카페 정보</a>
                    <a href="<?php echo $review_path; ?>">리뷰 목록</a>
                </nav>
            </div>
        </div>
        <div class="bottom-container2">


          <figure class ="cafe_pictures">


            <div class="picture_panel">
                <img class="picture" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20200818_294%2F1597756409501puSKH_JPEG%2F4H8H3eCbJNhdXcCbCslhX6Li.jpg">
                <img class="picture" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20200818_23%2F15977564316905Gc94_JPEG%2FBxOawK_nf9WWb-UoQMbxrj5x.jpg">
                <img class="picture" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20200818_95%2F1597756431431rCKoz_JPEG%2FCQxJ0OGrnrxc2LHl-3BsMSBq.jpg">
            </div>

          </figure>


          <section id="main_section">
            <?$cafe_rating = sprintf('%0.1f', $cafeRating);?>
            <article>
              <span class="cafe_name"><?php echo $cafeName ?></span>
              <i class="fas fa-star" style="color:#ffcc00; font-size: 1.2em;"></i>
              <span style="color:#3597DB; font-size: 1.2em"><?php echo $cafe_rating ?></span>
              <span class="btn_wrap">
                <input type="button" class="button" id="write_review" onclick = "location.href='write_review.php?cafeIdx=<?php echo $index ?>'" value="리뷰쓰기" />
              </span>
            </article>

            <article>
                <!--tags-->
              <div class="info_tags">
                <?php
                  $tag ="";
                  for($i=0; $i<count($tags);$i=$i+1)
                  $tag= $tag.'<input type="button" class="tags" name="tags" value="#'.$tags[$i].'"></input>';


                  echo $tag;
                  ?>
              </div>

            </article>
            <article>
              <table class="cafe_infs">
                <tr class="inf">
                  <td class="row">주소</td>
                  <td><?php echo $address ?></td>
                </tr>
                <tr class="inf">
                  <td class="row">전화번호</td>
                  <td><?php echo $tel ?></td>
                </tr>
                <tr class="inf">
                  <td class="row">영업시간</td>
                  <td>매일 00:00 ~ 24:00</td>
                </tr>
              </table>
            </article>
          </section>

          <aside id="main_aside">
            <div id="current-seat">
              <p>현재 좌석 수: <?php echo $seat ?></p>
              <div class="btn_wrap">
                <input type="button" class="button" id="seatstatus_btn" onclick = "writeStatus();" value="좌석 정보 수정"/>
              </div>
            </div>
            <form class="set_seat" method="POST" action= <?php echo $path ?> name="setSeat" id="seat-box" style="display:none">
              <p>현재 카페의 자리 수는 어떤가요?</p>
              <p>
                <input type="radio" id="seat1" name="radio-group" checked>
                <label for="seat1">만석</label>
              </p>
              <p>
                <input type="radio" id="seat2" name="radio-group">
                <label for="seat2">보통</label>
              </p>
              <p>
                <input type="radio" id="seat3" name="radio-group">
                <label for="seat3">여유</label>
              </p>
              <br>
              <p>남은 자리수를 입력해주세요.<p>

              <input name="detailseat" id="detailseat" type="text">
              <div class="btn_wrap">
                <input type="button" class="button" id="upload_btn" type="submit"  onclick="uploadStatus();" value="등록"></input>
              </div>
              <!-- <form class = "main-searchbox" method = "POST" name="main-searchbox">
                  <input type="search" placeholder="카페 이름 또는 태그 설정" />
                  <button type = "submit"><i class="fas fa-search" style="color:white; font-size:20px;"></i></button>
              </form> -->
            </form>
          </aside>

        </div>
    </main>
</div>
<script>
    function writeStatus(){
      document.getElementById("seat-box").style.display = "block";
      document.getElementById("current-seat").style.display = "none";
    }
    function uploadStatus(){
      document.getElementById("seat-box").style.display = "none";
      document.getElementById("current-seat").style.display = "block";
      document.setSeat.submit();
    }
</script>


</body>
</html>
