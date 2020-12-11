<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/myStyle.css">
       

    </head>
    <body>
        <?php 


     $conn = mysqli_connect(
        '15.165.124.76',
        'osp',
        '1234',
        'cagong');




   # 로그인 -> 사용자가 입력한 비밀번호랑 db에 있는 비밀번호랑 맞는지 확인해야 함 
   $id = "SELECT password
   from user
   where email = {$email};";
           mysqli_close($conn);

           

#카페 상세보기 화면
  $cafe_info ="SELECT password
  from user
  where email = 'td1702@naver.com';";  

  $hashtag_list ="SELECT password
  from user
  where email = 'td1702@naver.com';";

  $rating = "SELECT password
  from user
  where email = 'td1702@naver.com';";
         

      
         ?>
        </body>
        </html>