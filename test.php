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

        $sql2 = "SELECT * From cafe;";

        $result = mysqli_query($conn, $sql2);

        while($row1 = mysqli_fetch_assoc($result)){
           
            $a = $row1['cafename'];
            echo $a;
            }
           
           mysqli_close($conn);

      
         ?>
        </body>
        </html>