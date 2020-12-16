<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>회원가입 성공 - KAGONG</title>
    <link rel="stylesheet" href="loginStyle.css" type="text/css">
    <script src="https://kit.fontawesome.com/7b88aa951e.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
    <script type="text/javascript">
        function sign_in(){

    </script>
</head>
<?php 

$nickname = $_POST['nickname'];
$pw = $_POST['pw'];
$email = $_POST['email'];


#db 연결 부분 
$conn = mysqli_connect(
    '15.165.124.76',
    'osp',
    '1234',
    'cagong');

    
$new_user = "INSERT INTO user (email, password, nickname)
VALUES
('$email', '$pw', '$nickname');";

if (!mysqli_query($conn,$new_user)){
die('Error: ' . mysqli_error($conn)); }


?>


<body>
    <div class = "main-container">
        <div class="main-wrap">
            <header>
                <div class="logo">
                    <i class="fas fa-coffee"></i>
                    <a href="index.php">KAGONG</a>
                </div>

                    <p style="font-size:32px; font-weight:bold; padding-top:10px;"> 회원가입을 축하합니다! </p>

                    <p>로그인하여 카공족들을 위한 카페 리뷰를 작성하고 좌석 정보를 공유해보세요!
                    <br>
                    <br>
                    <br>
                    <br>

                    <div class="click" style="text-align:left">
                         <a href="index.php" style="margin-right:10px;">홈으로 돌아가기</a>
                         <a href="login.html" >로그인 하기</a>
                    </div>

            </header>
        </div>
    </div>
</body>
</html>
