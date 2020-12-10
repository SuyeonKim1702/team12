<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/myStyle.css">
       

    </head>
    <body>
        <?php 


$pw = $_POST['pw'];
$email = $_POST['id'];


#db 연결 부분 
$conn = mysqli_connect(
    '15.165.124.76',
    'osp',
    '1234',
    'cagong');


   # 로그인 -> 사용자가 입력한 비밀번호랑 db에 있는 비밀번호랑 맞는지 확인해야 함
   $user = "SELECT password, nickname from user where email='{$email}';";

   $result = mysqli_query($conn, $user);

   $count = mysqli_num_rows($result);
  
   if($count == 0) {
        //알림창 띄우기
        echo "<script language=javascript> alert('해당 이메일로 가입한 정보가 없습니다.'); document.location.href = 'login.html'; </script>";
         
       
   }else{
    while($row1 = mysqli_fetch_assoc($result)){
        echo $row1['password'];       
        if($row1['password'] == $pw){  //로그인 성공
 
         session_start();
 
         $_SESSION['is_logged'] = 'Y';
         $_SESSION['nickname'] = $row1['nickname'];
         
         
     
 
 
 
         header('Location: index.php');
        }else{//로그인 실패
          
         //알림창 띄우기
         echo "<script language=javascript> alert('비밀번호가 틀렸습니다.'); document.location.href = 'login.html'; </script>";
         
     
         //header('Location: login.html');
         
     
         
 
        }
    }
   }



  



      
         ?>
        </body>
        </html>