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
  <link rel = "stylesheet" href="myStyle.css" type = "text/css">
  <link rel= "stylesheet" href="button.css" type = "text/css">
  <link rel = "stylesheet" href="tag.css" type="text/css">
  <link rel= "stylesheet" href="cafe_info.css" type = "text/css">
  <script src= "https://kit.fontawesome.com/7b88aa951e.js" crossorigin="anonymous"></script>
  <link rel= "preconnect" href = "https://fonts.gstatic.com">
  <link href= "https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
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
            <?php $cafe_rating = sprintf('%0.1f', $cafeRating);?>
            <article>
              <span class="cafe_name"><?php echo $cafeName; ?></span>
              <i class="fas fa-star" style="color:#ffcc00; font-size: 1.2em;"></i>
              <span style="color:#3597DB; font-size: 1.2em"><?php echo $cafe_rating; ?></span>
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
            <form class="set_seat" method="POST" action= "<?php echo $path; ?>" name="setSeat" id="seat-box" style="display:none">
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
